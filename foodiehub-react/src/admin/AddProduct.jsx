import { useState } from 'react';
import { useNavigate } from 'react-router-dom';

function AddProduct(){

    const navigate = useNavigate();

    const [name, setName] = useState('');
    const [category, setCategory] = useState('');
    const [price, setPrice] = useState('');
    const [stock, setStock] = useState('');
    const [image, setImage] = useState(null);

    const addProduct = async(e) => {

        e.preventDefault();

        const formData = new FormData();

        formData.append('name', name);
        formData.append('category', category);
        formData.append('price', price);
        formData.append('stock', stock);
        formData.append('image', image);

        const response = await fetch(

            'http://localhost/food-app/api/add-product.php',

            {

                method:'POST',
                body:formData

            }

        );

        const data = await response.json();

        alert(data.message);

        navigate('/admin/products');

    };

    return(

        <div className="container mt-5">

            <div className="card p-4">

                <h1 className="mb-4">

                    Add Product

                </h1>

                <form onSubmit={addProduct}>

                    <input

                    type="text"

                    placeholder="Product Name"

                    className="form-control mb-3"

                    onChange={(e)=>

                    setName(e.target.value)

                    }

                    required

                    />

                    <input

                    type="text"

                    placeholder="Category"

                    className="form-control mb-3"

                    onChange={(e)=>

                    setCategory(e.target.value)

                    }

                    required

                    />

                    <input

                    type="number"

                    placeholder="Price"

                    className="form-control mb-3"

                    onChange={(e)=>

                    setPrice(e.target.value)

                    }

                    required

                    />

                    <input

                    type="number"

                    placeholder="Stock"

                    className="form-control mb-3"

                    onChange={(e)=>

                    setStock(e.target.value)

                    }

                    required

                    />

                    <input

                    type="file"

                    className="form-control mb-4"

                    onChange={(e)=>

                    setImage(e.target.files[0])

                    }

                    required

                    />

                    <button

                    className="btn btn-success"

                    type="submit"

                    >

                        Add Product

                    </button>

                </form>

            </div>

        </div>

    )

}

export default AddProduct;
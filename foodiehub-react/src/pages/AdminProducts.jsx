import { useEffect, useState } from 'react';

function AdminProducts(){

    const [products, setProducts] = useState([]);

    const fetchProducts = () => {

        fetch('http://localhost/food-app/api/products.php')

        .then(res => res.json())

        .then(data => {

            console.log(data);

            setProducts(data);

        })

        .catch(error => {

            console.log(error);

        });

    };

    useEffect(() => {

        fetchProducts();

    }, []);

    const deleteProduct = async(id) => {

    const confirmDelete = window.confirm(
        "Delete this product?"
    );

    if(!confirmDelete) return;

    await fetch(

        `http://localhost/food-app/admin/delete-product.php?id=${id}`

    );

    fetchProducts();

};

    return(

        <div className="container mt-5">

            <div className="d-flex justify-content-between align-items-center mb-4">

                <h1>

                    Manage Products

                </h1>

                <a

href="/admin/add-product"

className="btn btn-dark"

>

    Add Product

</a>

            </div>

            <table className="table table-bordered">

                <thead className="table-dark">

                    <tr>

                        <th>ID</th>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Price</th>

                        <th>Category</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    {products.map(product => (

                        <tr key={product.id}>

                            <td>

                                {product.id}

                            </td>

                            <td>

                                <img

                                src={`http://localhost/food-app/assets/images/${product.image}`}

                                width="80"
                                
                                height="80"

                                style={{ objectFit: 'cover' }}

                                />

                            </td>

                            <td>

                                {product.name}

                            </td>

                            <td>

                                ₹{product.price}

                            </td>

                            <td>

                                {product.category}

                            </td>

                            <td>

                                <a

href={`http://localhost/food-app/admin/edit-product.php?id=${product.id}`}

className="btn btn-primary btn-sm me-2"

>

    Edit

</a>

                                <button

className="btn btn-danger btn-sm"

onClick={() => deleteProduct(product.id)}

>

    Delete

</button>

                            </td>

                        </tr>

                    ))}

                </tbody>

            </table>

        </div>

    )

}

export default AdminProducts;
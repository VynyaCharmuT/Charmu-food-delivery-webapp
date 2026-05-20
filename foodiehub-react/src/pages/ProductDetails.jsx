import { useEffect, useState, useContext } from 'react';

import { useParams } from 'react-router-dom';

import Navbar from '../components/Navbar';

import { CartContext } from '../context/CartContext';

function ProductDetails(){

    const { id } = useParams();

    const [product, setProduct] = useState(null);

    const { addToCart } = useContext(CartContext);

    useEffect(() => {

        fetch(`http://localhost/food-app/api/product.php?id=${id}`)

        .then(res => res.json())

        .then(data => {

            setProduct(data);

        });

    }, [id]);

    if(!product){

        return <h2>Loading...</h2>

    }

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="row">

                    <div className="col-md-6">

                        <img

                        src={`http://localhost/food-app/assets/images/${product.image}`}

                        className="img-fluid rounded shadow"

                        />

                    </div>

                    <div className="col-md-6">

                        <h1>

                            {product.name}

                        </h1>

                        <h3 className="text-warning">

                            ₹{product.price}

                        </h3>

                        <p className="mt-4">

                            {product.description}

                        </p>

                        <h5>

                            Ingredients:
                        </h5>

                        <p>

                            {product.ingredients}

                        </p>

                        <h5>

                            Allergens:
                        </h5>

                        <p>

                            {product.allergens}

                        </p>

                        <h5>

                            Serving Size:
                        </h5>

                        <p>

                            {product.serving_size}

                        </p>

                        <h5>

                            Rating:
                        </h5>

                        <p>

                            ⭐ {product.rating}

                        </p>

                        <button

                        className="btn btn-warning btn-lg mt-3"

                        onClick={() => addToCart(product)}

                        >

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default ProductDetails;
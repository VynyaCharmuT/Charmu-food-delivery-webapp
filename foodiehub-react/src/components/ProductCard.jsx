import { useContext } from 'react';

import { CartContext } from '../context/CartContext';

import { Link } from 'react-router-dom';

function ProductCard({ product }){

    const { addToCart } = useContext(CartContext);

    return(

        <div className="col-md-4 mb-4">

            <div className="card shadow border-0 h-100">

                <img
                src={`http://localhost/food-app/assets/images/${product.image}`}
                className="card-img-top"
                style={{
                    height:'250px',
                    objectFit:'cover'
                }}
                />

                <div className="card-body">

                    <h3>

                        {product.name}

                    </h3>

                    <h4 className="text-warning">

                        ₹{product.price}

                    </h4>

                    <Link

to={`/product/${product.id}`}

className="btn btn-dark w-100 mb-2"

>

    View Details

</Link>

<button

className="btn btn-warning w-100"

onClick={() => addToCart(product)}

>

    Add To Cart

</button> 

                </div>

            </div>

        </div>

    )

}

export default ProductCard;
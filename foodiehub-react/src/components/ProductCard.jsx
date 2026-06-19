import { useContext } from 'react';

import { CartContext } from '../context/CartContext';

import { Link } from 'react-router-dom';

function ProductCard({ product }){

    const { addToCart } = useContext(CartContext);

    return(

        <div className="col-md-4 mb-4">

            <div className="card shadow border-0 h-100 product-card">

                <img
src={`http://localhost/food-app/assets/images/${product.image}`}
className="card-img-top product-image"
style={{
    height:'250px',
    objectFit:'cover'
}}
/>

                <div className="card-body">

                    {product.name}

                    <h4
className="text-warning fw-bold"
style={{
textShadow:
"0 0 10px rgba(244,180,0,.6)"
}}
>

                        ₹{product.price}

                    </h4>

                    <Link

to={`/product/${product.id}`}

className="btn btn-dark w-100 mb-2 premium-btn"

>

    View Details

</Link>

<button

className="btn btn-warning w-100 premium-btn"

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
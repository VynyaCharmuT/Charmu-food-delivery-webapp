import { useContext } from 'react';

import Navbar from '../components/Navbar';

import { CartContext } from '../context/CartContext';

import { useNavigate } from 'react-router-dom';

function Cart(){

    const {

    cart,
    increaseQty,
    decreaseQty,
    grandTotal

} = useContext(CartContext);

const navigate = useNavigate();

const user = JSON.parse(

    localStorage.getItem('user')

);
    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <h1 className="mb-4">

                    Your Cart

                </h1>

                {cart.length === 0 ? (

                    <h4>

                        Cart is empty

                    </h4>

                ) : (

                    <div className="row">

                        {cart.map(item => (

                            <div
                            className="col-md-4 mb-4"
                            key={item.id}>

                                <div className="card shadow border-0">

                                    <img
                                    src={`http://localhost/food-app/assets/images/${item.image}`}
                                    className="card-img-top"
                                    style={{
                                        height:'250px',
                                        objectFit:'cover'
                                    }}
                                    />

                                    <div className="card-body">

                                        <h3>

                                            {item.name}

                                        </h3>

                                        <h4>

                                            ₹{item.price}

                                        </h4>

                                        <h5>

                                            Quantity:
                                            {item.quantity}

                                        </h5>

                                        <div className="d-flex gap-2 mt-3">

                                            <button

                                            className="btn btn-dark"

                                            onClick={() =>
                                            decreaseQty(item.id)}

                                            >

                                                -

                                            </button>

                                            <button

                                            className="btn btn-warning"

                                            onClick={() =>
                                            increaseQty(item.id)}

                                            >

                                                +

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        ))}

                    </div>

                )}


   <div className="mt-5">

    <h2>

        Grand Total:
        ₹{grandTotal}

    </h2>

    <button

    className="btn btn-warning mt-3"

    onClick={() => navigate('/checkout')}

    >

        Proceed To Checkout

    </button>

</div>

            </div>

        </div>

    )

}

export default Cart;
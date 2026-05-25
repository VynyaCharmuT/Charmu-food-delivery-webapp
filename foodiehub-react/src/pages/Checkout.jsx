import { useState, useContext } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

import { CartContext } from '../context/CartContext';

function Checkout(){

    const navigate = useNavigate();

    const { cart, grandTotal, setCart } = useContext(CartContext);

    const [address, setAddress] = useState('');

    const [phone, setPhone] = useState('');

    const [paymentMethod, setPaymentMethod] = useState('COD');

    const user = JSON.parse(

        localStorage.getItem('user')

    );

    const placeOrder = async () => {
        if(!address || !phone){

    alert("Please fill all details");

    return;

}

    try{

        console.log("PLACE ORDER STARTED");

        const response = await fetch(

        'http://localhost/food-app/api/place-order.php',

        {

            method:'POST',

            headers:{

                'Content-Type':'application/json'

            },

            body: JSON.stringify({

                user_id:user.id,
                total_amount:grandTotal,
                payment_method:paymentMethod,
                address,
                phone,
                cart

            })

        });

        console.log("RAW RESPONSE:", response);

        const text = await response.text();

        console.log("RAW TEXT:", text);

        const data = JSON.parse(text);

        console.log("FINAL DATA:", data);

        alert(data.message);

        setCart([]);

        navigate('/orders');

    }

    catch(error){

        console.log("FULL ERROR:", error);

    }

};

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="row justify-content-center">

                    <div className="col-md-6">

                        <div className="card shadow p-4">

                            <h2 className="mb-4">

                                Checkout

                            </h2>

                            <input

                            type="text"

                            className="form-control mb-3"

                            placeholder="Delivery Address"

                            onChange={(e)=>

                            setAddress(e.target.value)

                            }

                            />

                            <input

                            type="text"

                            className="form-control mb-3"

                            placeholder="Phone Number"

                            onChange={(e)=>

                            setPhone(e.target.value)

                            }

                            />

                            <select

                            className="form-control mb-4"

                            onChange={(e)=>

                            setPaymentMethod(e.target.value)

                            }

                            >

                                <option>

                                    COD

                                </option>

                                <option>

                                    UPI

                                </option>

                                <option>

                                    Card

                                </option>

                            </select>

                            <h3 className="mb-4">

                                Grand Total:
                                ₹{grandTotal}

                            </h3>

                            <button

                            className="btn btn-warning w-100"

                            onClick={placeOrder}

                            >

                                Place Order

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default Checkout;
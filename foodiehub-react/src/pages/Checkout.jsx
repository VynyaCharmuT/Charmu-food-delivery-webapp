import { useState, useContext, useEffect } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

import { CartContext } from '../context/CartContext';

function Checkout(){

    const navigate = useNavigate();

    const { cart, grandTotal, setCart } = useContext(CartContext);

    const [address, setAddress] = useState('');

    const [phone, setPhone] = useState('');

    const [paymentMethod, setPaymentMethod] = useState('COD');

    const [couponCode, setCouponCode] = useState('');
    
    const [discount, setDiscount] = useState(0);

    const [coupons,setCoupons] = useState([]);
    
    const [selectedCoupon,setSelectedCoupon] = useState(null);

    const user = JSON.parse(

        localStorage.getItem('user')

    );

    useEffect(() => {

    fetch(
        'http://localhost/food-app/api/get-coupons.php'
    )
    .then(res => res.json())
    .then(data => {

        console.log(data);

        setCoupons(data);

    });

}, []);

    const applyCoupon = async() => {

    const response = await fetch(

        `http://localhost/food-app/api/apply-coupon.php?code=${couponCode}`

    );

    const data = await response.json();

    if(data.error){

        alert(data.error);

        return;

    }

    const discountAmount =

        (grandTotal * data.discount_percentage) / 100;

    setDiscount(discountAmount);

    alert(
        `Coupon Applied! ${data.discount_percentage}% OFF`
    );

};

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

                            <h5 className="mb-3">
🎁 Available Coupons
</h5>

{
coupons.map(coupon => {

    const unlocked =
    grandTotal >= coupon.minimum_order;

    return(

        <div
        key={coupon.id}
        className="card p-3 mb-2"
        >

            <h6>
                {coupon.code}
            </h6>

            <p>
                {coupon.discount_percentage}% OFF
            </p>

            <p>
                Min Order ₹{coupon.minimum_order}
            </p>

            {

            unlocked

            ?

            <button

            className="btn btn-success btn-sm"

            onClick={() => {

                setCouponCode(
                    coupon.code
                );

            }}

            >

                Apply Coupon

            </button>

            :

            <button

            className="btn btn-secondary btn-sm"

            disabled

            >

                Add ₹{
                    coupon.minimum_order
                    -
                    grandTotal
                } more to unlock

            </button>

            }

        </div>

    );

})
}

                            <h5 className="mb-3">

🎁 Available Coupons

</h5>

                            <input

type="text"

className="form-control mb-3"

placeholder="Enter Coupon Code"

value={couponCode}

onChange={(e)=>
setCouponCode(e.target.value)
}

/>

<button

className="btn btn-info w-100 mb-3"

onClick={applyCoupon}

>

Apply Coupon

</button>

                            <h5>

Subtotal:
₹{grandTotal}

</h5>

<h5>

Discount:
₹{discount}

</h5>

{
discount > 0 && (

<p className="text-success fw-bold">

🎉 You Saved ₹{discount}

</p>

)
}

<h3 className="mb-4 text-success">

Final Total:
₹{grandTotal - discount}

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
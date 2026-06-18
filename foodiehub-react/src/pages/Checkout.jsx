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

    const [isPlacingOrder, setIsPlacingOrder] = useState(false);

    const [latitude,setLatitude] = useState(null);
    
    const [longitude,setLongitude] = useState(null);

    const [persons,setPersons] = useState(1);

    const [sauceQuantity,setSauceQuantity] = useState(0);

    const [beverageType,setBeverageType] = useState("Water");

    const [beverageQuantity,setBeverageQuantity] = useState(1);

    const [sideType,setSideType] = useState("None");

    const [sideQuantity,setSideQuantity] = useState(0);

    const user = JSON.parse(

        localStorage.getItem('user')

    );

    const freeSauces = persons * 2;

const extraSauces =
Math.max(
0,
sauceQuantity - freeSauces
);

const sauceCharge =
extraSauces * 2;

const beverageCharge =
beverageType === "Water"
?
0
:
beverageQuantity * 20;

const sideCharge =
sideQuantity * 30;

const addonTotal =
sauceCharge +
beverageCharge +
sideCharge;

    useEffect(() => {

    fetch(
        'http://localhost/food-app/api/get-coupons.php'
    )
    .then(res => res.json())
    .then(data => {

        console.log(data);

        setCoupons(data);

    });

navigator.geolocation.getCurrentPosition(

(position)=>{

setLatitude(position.coords.latitude);

setLongitude(position.coords.longitude);

}

);

}, []);


// ADD THIS ENTIRE BLOCK HERE

useEffect(()=>{

if(latitude && longitude){

fetch(
`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`
)

.then(res=>res.json())

.then(data=>{

if(data.display_name){

setAddress(data.display_name);

}

});

}

},[latitude,longitude]);

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
((grandTotal + addonTotal) *
data.discount_percentage) / 100;

    setDiscount(discountAmount);

    alert(
        `Coupon Applied! ${data.discount_percentage}% OFF`
    );

};

    const placeOrder = async () => {
        if(isPlacingOrder) return;

setIsPlacingOrder(true);
        if(!address || !phone){

    alert("Please fill all details");

    setIsPlacingOrder(false);

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
total_amount: grandTotal + addonTotal - discount,
payment_method:paymentMethod,
address,
phone,
latitude,
longitude,
persons,
sauceQuantity,
beverageType,
beverageQuantity,
sideType,
sideQuantity,
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
        
        setIsPlacingOrder(false);

        navigate('/orders');

    }

    catch(error){

        console.log("FULL ERROR:", error);

        setIsPlacingOrder(false);
        alert("An error occurred while placing the order. Please try again.");

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
value={address}
onChange={(e)=>setAddress(e.target.value)}
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

                            <h4 className="mb-3">

Add-ons

</h4>

<label>Serving Size</label>

<select
className="form-control mb-3"
value={persons}
onChange={(e)=>setPersons(Number(e.target.value))}
>
<option value="1">1 Person</option>
<option value="2">2 Persons</option>
<option value="3">3 Persons</option>
<option value="4">4 Persons</option>
</select>

<label>Sauce Packets</label>

<input
type="number"
min="0"
className="form-control mb-3"
value={sauceQuantity}
onChange={(e)=>setSauceQuantity(Number(e.target.value))}
/>

<label>Beverage</label>

<select
className="form-control mb-3"
value={beverageType}
onChange={(e)=>setBeverageType(e.target.value)}
>
<option>Water</option>
<option>Coke</option>
<option>Pepsi</option>
<option>Sprite</option>
<option>Fanta</option>
<option>Thums Up</option>
</select>

<label>Beverage Quantity</label>

<input
type="number"
min="0"
className="form-control mb-3"
value={beverageQuantity}
onChange={(e)=>setBeverageQuantity(Number(e.target.value))}
/>

<label>Side Dish</label>

<select
className="form-control mb-3"
value={sideType}
onChange={(e)=>setSideType(e.target.value)}
>
<option>None</option>
<option>French Fries</option>
<option>Garlic Bread</option>
<option>Chicken Nuggets</option>
<option>Onion Rings</option>
</select>

<label>Side Quantity</label>

<input
type="number"
min="0"
className="form-control mb-4"
value={sideQuantity}
onChange={(e)=>setSideQuantity(Number(e.target.value))}
/>

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
Add-ons:
₹{addonTotal}
</h5>

<p className="text-muted">

Free Sauces:
{freeSauces}

</p>

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
₹{
grandTotal
+
addonTotal
-
discount
}

</h3>

                            <button
    className="btn btn-warning w-100"
    onClick={placeOrder}
    disabled={isPlacingOrder}
>
    {
        isPlacingOrder
        ? "Placing Order..."
        : "Place Order"
    }
</button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default Checkout;
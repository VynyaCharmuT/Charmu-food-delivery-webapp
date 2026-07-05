import { useState, useContext, useEffect } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

import { CartContext } from '../context/CartContext';

import PaymentModal from "../components/PaymentModal";

import PaymentSuccess from "../components/PaymentSuccess";

function Checkout(){

    const navigate = useNavigate();

    const { cart, grandTotal, setCart } = useContext(CartContext);

    const [address, setAddress] = useState({

fullName:"",

phone:"",

houseNo:"",

street:"",

landmark:"",

city:"",

state:"",

pincode:""

});

    const [paymentMethod, setPaymentMethod] = useState('COD');

    const [upiId, setUpiId] = useState("");

    const [cardNumber, setCardNumber] = useState("");

    const [cardName, setCardName] = useState("");

    const [expiry, setExpiry] = useState("");

    const [cvv, setCvv] = useState("");

    const [selectedBank, setSelectedBank] = useState("");

    const [paymentDone, setPaymentDone] = useState(false);

    const [showOtp,setShowOtp]=useState(false);

    const [otp,setOtp]=useState("");

    const [generatedOtp,setGeneratedOtp]=useState("");

    const [processingPayment, setProcessingPayment] = useState(false);

    const [showPaymentModal,setShowPaymentModal]=useState(false);

    const [showSuccess,setShowSuccess]=useState(false);

    const [couponCode, setCouponCode] = useState('');
    
    const [discount, setDiscount] = useState(0);

    const [coupons,setCoupons] = useState([]);

    const [isPlacingOrder, setIsPlacingOrder] = useState(false);

    const [latitude,setLatitude] = useState(null);
    
    const [longitude,setLongitude] = useState(null);

    const [persons,setPersons] = useState(1);

    const [sauceQuantity,setSauceQuantity] = useState(0);

    const [beverageType,setBeverageType] = useState("Water");

    const [beverageQuantity,setBeverageQuantity] = useState(1);

    const [sideType,setSideType] = useState("None");

    const [sideQuantity,setSideQuantity] = useState(0);

    const handleAddressChange = (e) => {

setAddress({

...address,

[e.target.name]:e.target.value

});

};

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

setAddress(prev=>({

...prev,

street:data.display_name

}));

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

        if(paymentMethod !== "COD" && !paymentDone){

alert("Please complete the payment first.");

return;

}
        if(isPlacingOrder) return;

setIsPlacingOrder(true);
        if(

!address.fullName ||

!address.phone ||

!address.houseNo ||

!address.street ||

!address.city ||

!address.state ||

!address.pincode

){

    alert("Please fill all details");

    setIsPlacingOrder(false);

    return;

}

    try{

        console.log("PLACE ORDER STARTED");

        const fullAddress = `
${address.houseNo},
${address.street},
${address.landmark ? address.landmark + "," : ""}
${address.city},
${address.state}
- ${address.pincode}
`;

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
address: fullAddress,
phone: address.phone,
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

        setPaymentDone(false);

setShowOtp(false);

setOtp("");

setGeneratedOtp("");

setUpiId("");

setCardNumber("");

setCardName("");

setExpiry("");

setCvv("");

setSelectedBank("");

setShowSuccess(true);

        setShowSuccess(true);

    }

    catch(error){

        console.log("FULL ERROR:", error);

        setIsPlacingOrder(false);
        alert("An error occurred while placing the order. Please try again.");

    }

};

    return(

        <>

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="row">

    <div className="col-lg-7">

                        <div className="card shadow glass-card checkout-card p-4">

                            <h2>

📍 Delivery Details

</h2>

<p className="text-muted">

Fill your delivery information below.

</p>

<hr/>

<div className="row">

<div className="col-md-6">

<input
type="text"
name="fullName"
className="form-control premium-search mb-3"
placeholder="Full Name"
value={address.fullName}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="tel"
maxLength="10"
name="phone"
className="form-control premium-search mb-3"
placeholder="Phone Number"
value={address.phone}
onChange={(e)=>{

const value=e.target.value
.replace(/\D/g,"")
.substring(0,10);

setAddress({

...address,

phone:value

});

}}
/>

</div>

<div className="col-md-6">

<input
type="text"
name="houseNo"
className="form-control premium-search mb-3"
placeholder="House / Flat No."
value={address.houseNo}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="text"
name="street"
className="form-control premium-search mb-3"
placeholder="Street / Area"
value={address.street}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="text"
name="landmark"
className="form-control premium-search mb-3"
placeholder="Landmark"
value={address.landmark}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="text"
name="city"
className="form-control premium-search mb-3"
placeholder="City"
value={address.city}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="text"
name="state"
className="form-control premium-search mb-3"
placeholder="State"
value={address.state}
onChange={handleAddressChange}
/>

</div>

<div className="col-md-6">

<input
type="text"
maxLength="6"
name="pincode"
className="form-control premium-search mb-4"
placeholder="Pincode"
value={address.pincode}
onChange={(e)=>{

const value=e.target.value
.replace(/\D/g,"")
.substring(0,6);

setAddress({

...address,

pincode:value

});

}}
/>

</div>

</div>

<h4 className="mb-4">

💳 Choose Payment Method

</h4>

<div className="row g-3 mb-4">

<div className="col-md-6">

<div

className={`payment-card ${
paymentMethod==="COD" ? "active-payment" : ""
}`}

onClick={()=>{

setPaymentMethod("COD");

setPaymentDone(false);

}}

>

<h5>💵 Cash on Delivery</h5>

<p>Pay after your food arrives.</p>

</div>

</div>



<div className="col-md-6">

<div

className={`payment-card ${
paymentMethod==="UPI" ? "active-payment" : ""
}`}

onClick={() => {

setPaymentMethod("UPI");

setPaymentDone(false);

}}

>

<h5>📱 UPI</h5>

<p>

Google Pay • PhonePe • Paytm

</p>

</div>

</div>

<div className="col-md-6">

<div

className={`payment-card ${
paymentMethod==="Card" ? "active-payment" : ""
}`}

onClick={() => {

setPaymentMethod("Card");

setPaymentDone(false);

}}

>

<h5>💳 Credit / Debit Card</h5>

<p>Visa • Mastercard • RuPay</p>

</div>

</div>

<div className="col-md-6">

<div

className={`payment-card ${
paymentMethod==="Net Banking" ? "active-payment" : ""
}`}

onClick={() => {

setPaymentMethod("Net Banking");

setPaymentDone(false);

}}

>

<h5>🏦 Net Banking</h5>

<p>All Major Banks</p>

</div>

</div>

</div>

<p className="text-warning fw-bold">

Selected Payment: {paymentMethod}

</p>

{
paymentDone && (

<div className="alert alert-success mt-3">

✅ Payment Successful

</div>

)
}

{paymentMethod === "COD" && (

<div className="glass-card p-4 mb-4">

<h5>💵 Cash On Delivery</h5>

<p className="text-muted">

Pay when your order reaches your doorstep.

</p>

</div>

)}

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
className="form-control premium-search mb-4"
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

<p className="text-muted">

Free Sauces:
{freeSauces}

</p>

</div>

</div>   {/* closes col-lg-7 */}

<div className="col-lg-5">

<div
className="card shadow glass-card checkout-card summary-card p-4"
style={{
position:"sticky",
top:"100px"
}}
>   

<h3 className="mb-4">

🛒 Order Summary

</h3>

<h5 className="mb-3">

Items

</h5>

{

cart.map(item=>(

<div

key={item.id}

className="d-flex justify-content-between mb-2"

>

<div>

{item.name}

×

{item.quantity}

</div>

<div>

₹{item.price*item.quantity}

</div>

</div>

))

}

<hr/>

<h5>

Subtotal

<span className="float-end">

₹{grandTotal}

</span>

</h5>

<h5>

Add-ons

<span className="float-end">

₹{addonTotal}

</span>

</h5>

<h5>

Discount

<span className="float-end text-success">

-₹{discount}

</span>

</h5>

<hr/>

<p className="text-muted">

Delivery Fee

<span className="float-end">

FREE

</span>

</p>

<hr/>

<h3>

Total

<span className="float-end text-warning">

₹{grandTotal+addonTotal-discount}

</span>

</h3>

<button

className="btn btn-warning premium-btn w-100 mt-4"

onClick={()=>{

if(paymentMethod==="COD"){

placeOrder();

}
else{

setShowPaymentModal(true);

}

}}

disabled={isPlacingOrder}

>

{
isPlacingOrder
?
"Placing Order..."
:
paymentMethod==="COD"
?
"Place Order"
:
"Proceed to Payment"
}

</button>

                    </div>   {/* Summary Card */}

</div>   {/* col-lg-5 */}

</div>   {/* row */}

</div>   {/* container */}

</div>


<PaymentModal

show={showPaymentModal}

paymentMethod={paymentMethod}

paymentDone={paymentDone}

processingPayment={processingPayment}

setProcessingPayment={setProcessingPayment}

setPaymentDone={setPaymentDone}

upiId={upiId}

setUpiId={setUpiId}

cardNumber={cardNumber}

setCardNumber={setCardNumber}

cardName={cardName}

setCardName={setCardName}

expiry={expiry}

setExpiry={setExpiry}

cvv={cvv}

setCvv={setCvv}

selectedBank={selectedBank}

setSelectedBank={setSelectedBank}

total={grandTotal + addonTotal - discount}

showOtp={showOtp}

setShowOtp={setShowOtp}

otp={otp}

setOtp={setOtp}

generatedOtp={generatedOtp}

setGeneratedOtp={setGeneratedOtp}

onClose={(success)=>{

setShowPaymentModal(false);

if(success){

placeOrder();

}

}

}

/>

<PaymentSuccess

show={showSuccess}

onClose={()=>{

setShowSuccess(false);

setPaymentDone(false);

navigate("/order-success",{

state:{

amount:grandTotal + addonTotal - discount,

paymentMethod

}

});

}}

/>
</>
    );

}

export default Checkout;
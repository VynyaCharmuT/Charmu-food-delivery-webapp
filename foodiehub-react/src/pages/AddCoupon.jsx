import { useState } from 'react';

function AddCoupon(){

const [code,setCode] = useState('');
const [discount,setDiscount] = useState('');
const [minimum,setMinimum] = useState('');
const [expiry,setExpiry] = useState('');

const saveCoupon = async() => {

await fetch(
'http://localhost/food-app/api/add-coupon.php',
{
method:'POST',
headers:{
'Content-Type':'application/json'
},
body:JSON.stringify({
code,
discount_percentage:discount,
minimum_order:minimum,
expiry_date:expiry,
description:'FoodieHub Coupon'
})
}
);

alert("Coupon Added");

};

return(

<div className="container mt-5">

<h1>Add Coupon</h1>

<input
className="form-control mb-3"
placeholder="Coupon Code"
onChange={(e)=>setCode(e.target.value)}
/>

<input
className="form-control mb-3"
placeholder="Discount %"
onChange={(e)=>setDiscount(e.target.value)}
/>

<input
className="form-control mb-3"
placeholder="Minimum Order"
onChange={(e)=>setMinimum(e.target.value)}
/>

<input
type="date"
className="form-control mb-3"
onChange={(e)=>setExpiry(e.target.value)}
/>

<button
className="btn btn-success"
onClick={saveCoupon}
>
Save Coupon
</button>

</div>

)

}

export default AddCoupon;
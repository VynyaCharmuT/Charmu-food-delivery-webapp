import { useNavigate, useLocation } from "react-router-dom";

import Confetti from "react-confetti";

function OrderSuccess(){

const navigate = useNavigate();

const location = useLocation();

const {

orderId,

amount,

paymentMethod

} = location.state || {};

return(

    <>

    <Confetti
numberOfPieces={250}
recycle={false}
/>

<div className="container py-5">

<div className="row justify-content-center">

<div className="col-lg-6">

<div className="card glass-card p-5 text-center">

<div
style={{
fontSize:"80px"
}}
>

<div className="success-circle">

✔

</div>

</div>

<h2 className="mt-3">

Order Placed Successfully!

</h2>

<p className="text-muted">

Your delicious food is now being prepared.

</p>

<hr/>

<div className="mb-3">

<h5>

Order ID

</h5>

<p>

#{orderId || "N/A"}

</p>

</div>

<div className="mb-3">

<h5>

Payment Method

</h5>

<p>

{paymentMethod || "COD"}

</p>

</div>

<div className="mb-3">

<h5>

Amount Paid

</h5>

<p>

₹{amount || 0}

</p>

</div>

<div className="mb-3">

<h5>

Estimated Delivery

</h5>

<p>

25 - 35 Minutes

</p>

</div>

<button
className="btn btn-warning premium-btn mb-3"
onClick={()=>navigate("/orders")}
>

Track Order

</button>

<button
className="btn btn-outline-warning"
onClick={()=>navigate("/")}
>

Continue Shopping

</button>

</div>

</div>

</div>

</div>

</>

);

}

export default OrderSuccess;
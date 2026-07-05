import React from "react";

function PaymentModal({

show,

paymentMethod,

processingPayment,

setProcessingPayment,

paymentDone,

setPaymentDone,

showOtp,

setShowOtp,

otp,

setOtp,

generatedOtp,

setGeneratedOtp,

upiId,

setUpiId,

cardNumber,

setCardNumber,

cardName,

setCardName,

expiry,

setExpiry,

cvv,

setCvv,

selectedBank,

setSelectedBank,

total,

onClose

})
 {

    if(!show) return null;

    const completePayment = () => {

    setProcessingPayment(true);

    setTimeout(() => {

        setProcessingPayment(false);

        setPaymentDone(true);

        // Hide OTP after success
        setShowOtp(false);

        // Clear OTP fields
        setOtp("");

        setGeneratedOtp("");

        alert("✅ Payment Successful");

        onClose(true);

    }, 2000);

};

    return (

<div className="payment-overlay">

<div className="payment-modal glass-card p-4">

<div className="text-center mb-4">

<div
style={{
fontSize:"60px"
}}
>

{
paymentMethod==="UPI"
?
"📱"
:
paymentMethod==="Card"
?
"💳"
:
"🏦"
}

</div>

<h3 className="fw-bold">

{paymentMethod}

</h3>

<p className="text-muted">

Secure Payment Gateway

</p>

</div>

{
paymentMethod==="UPI" && (

<>

<div className="row text-center mb-4">

<div className="col">

<div className="glass-card p-3">

📱

Google Pay

</div>

</div>

<div className="col">

<div className="glass-card p-3">

💜

PhonePe

</div>

</div>

<div className="col">

<div className="glass-card p-3">

💙

Paytm

</div>

</div>

</div>

<input
className="form-control premium-search mb-3"
placeholder="example@upi"
value={upiId}
onChange={(e)=>setUpiId(e.target.value)}
/>

<button
className="btn btn-success w-100"
onClick={() => {

if(

!upiId.includes("@")

||

upiId.length<6

){

alert("Enter a valid UPI ID");

return;

}

completePayment();

}}
>

{
processingPayment
?

<>

<span
className="spinner-border spinner-border-sm me-2"
></span>

Processing Secure Payment...

</>

:

`Pay ₹${total}`
}
</button>

</>

)
}

{
paymentMethod==="Card" && (

<>

<div className="d-flex justify-content-end mb-2">

<span className="badge bg-primary me-2">

VISA

</span>

<span className="badge bg-danger me-2">

MasterCard

</span>

<span className="badge bg-success">

RuPay

</span>

</div>

<input
className="form-control premium-search mb-3"
placeholder="1234 5678 9012 3456"
maxLength={19}
value={cardNumber}
onChange={(e)=>{

let value=e.target.value
.replace(/\D/g,"")
.substring(0,16);

value=value.replace(

/(.{4})/g,

"$1 "

).trim();

setCardNumber(value);

}}
/>

<input
className="form-control premium-search mb-3"
placeholder="Card Holder Name"
value={cardName}
onChange={(e)=>setCardName(e.target.value)}
/>

<div className="row">

<div className="col-6">

<input
className="form-control premium-search"
placeholder="08/29"
value={expiry}
onChange={(e)=>{

let value=e.target.value;

if(value.length===2 && !value.includes("/")){

value=value+"/";

}

setExpiry(value);

}}
/>

</div>

<div className="col-6">

<input
className="form-control premium-search"
placeholder="123"
maxLength={3}
value={cvv}
onChange={(e)=>{

setCvv(

e.target.value.replace(/\D/g,"")

);

}}
/>

</div>

</div>

<br/>

{
showOtp && (

<div className="glass-card mt-4 p-4">

<h5>

Enter OTP

</h5>

<p>

Enter the 6-digit OTP.

</p>

<input

className="form-control premium-search mb-3"

value={otp}

onChange={(e)=>setOtp(e.target.value)}

placeholder="Enter OTP"

maxLength={6}

/>

<button

className="btn btn-success w-100"

onClick={()=>{

if(otp !== generatedOtp){

alert("Invalid OTP");

return;

}

completePayment();

}}

>

Verify OTP

</button>

</div>

)
}

<button
className="btn btn-success w-100"
onClick={() => {

if(cardNumber.replace(/\s/g,"").length !== 16){

alert("Invalid Card Number");

return;

}

if(cardName.trim()===""){

alert("Enter Card Holder Name");

return;

}

if(expiry.length!==5){

alert("Enter Expiry Date");

return;

}

if(!/^\d{3}$/.test(cvv)){

alert("Invalid CVV");

return;

}

const newOtp = Math.floor(
100000 + Math.random() * 900000
).toString();

setOtp("");

setGeneratedOtp(newOtp);

alert(`Demo OTP : ${newOtp}`);

setShowOtp(true);

}}
>

Generate OTP

</button>

</>

)
}

{
paymentMethod==="Net Banking" && (

<>

<div className="glass-card p-3 mb-3">

🏦

Choose your preferred bank

</div>

<select
className="form-select premium-search mb-3"
value={selectedBank}
onChange={(e)=>setSelectedBank(e.target.value)}
>

<option value="">Choose Bank</option>

<option>SBI</option>

<option>HDFC</option>

<option>ICICI</option>

<option>Axis</option>

</select>

<button
className="btn btn-success w-100"
onClick={() => {

if(selectedBank===""){

alert("Please select a bank");

return;

}

completePayment();

}}
>

{
processingPayment
?

<>

<span
className="spinner-border spinner-border-sm me-2"
></span>

Processing Secure Payment...

</>

:

"Continue"

}

</button>

</>

)
}

<button

className="btn btn-outline-warning mt-3 w-100"

onClick={() => onClose(false)}

>

Cancel

</button>

</div>

</div>

);

}

export default PaymentModal;
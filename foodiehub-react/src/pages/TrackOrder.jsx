import { useEffect, useState } from 'react';

import { useParams } from 'react-router-dom';

import Navbar from '../components/Navbar';

import LiveTrackingMap from "../components/LiveTrackingMap";

function TrackOrder(){

    const { id } = useParams();

    const [order, setOrder] = useState(null);

    const [orderItems,setOrderItems] = useState([]);

    useEffect(() => {

fetch(
`http://localhost/food-app/api/track-order.php?order_id=${id}`
)
.then(res => res.json())
.then(data => {

console.log(data);

setOrder(data);

});

fetch(
`http://localhost/food-app/api/get-delivery-agent.php?order_id=${id}`
)
.then(res => res.json())
.then(data => {

console.log(data);

setAgent(data);

fetch(
`http://localhost/food-app/api/get-order-items.php?order_id=${id}`
)
.then(res => res.json())
.then(data => {

console.log(data);

setOrderItems(data);

});

});

}, [id]);

    if(!order){

        return(

            <div>

                <Navbar />

                <h2 className="text-center mt-5">

                    Loading...

                </h2>

            </div>

        )

    }

    return(

        <div>

            <Navbar />

            <div className="mt-5">

    <div className="mb-4">
        ✅ Order Placed
    </div>

    <div className="mb-4">

        {
            [
                'Assigned To Delivery Agent',
                'Picked Up',
                'On The Way',
                'Delivered'
            ].includes(order.tracking_status)

            ?

            '✅ Assigned To Delivery Agent'

            :

            '⭕ Assigned To Delivery Agent'
        }

    </div>

    <div className="mb-4">

        {
            [
                'Picked Up',
                'On The Way',
                'Delivered'
            ].includes(order.tracking_status)

            ?

            '✅ Picked Up'

            :

            '⭕ Picked Up'
        }

    </div>

    <div className="mb-4">

        {
            [
                'On The Way',
                'Delivered'
            ].includes(order.tracking_status)

            ?

            '✅ On The Way'

            :

            '⭕ On The Way'
        }

    </div>

    <div className="mb-4">

    {
        order.tracking_status === 'Delivered'
        ?
        '✅ Delivered'
        :
        '⭕ Delivered'
    }

</div>

{
agent && (

<div
className="card shadow p-3 mb-4"
style={{
background:"#fff",
color:"#000",
border:"3px solid red"
}}
>

<h4>

🚴 Delivery Partner

</h4>

<p>

Name:
{agent.name}

</p>

<p>

Phone:
{agent.phone}

</p>

<p>

Vehicle:
{agent.vehicle_number}

</p>

</div>

)
}

<div className="card shadow-lg border-0 p-4 mb-4">

<h3 className="mb-3">
🧾 Order Details
</h3>

<hr />

<p>
<b>Order ID:</b> #{order.id}
</p>

<p>
<b>Total Amount:</b> ₹{order.total_amount}
</p>

<p>
<b>Payment Method:</b> {order.payment_method}
</p>

<p>
<b>Payment Status:</b>

<span
className={`badge ms-2 ${
order.payment_status === "Paid"
? "bg-success"
: "bg-warning text-dark"
}`}
>

{order.payment_status}

</span>

</p>

<p>

<b>Current Status:</b>

<span
className={`badge ms-2 ${
order.tracking_status === "Delivered"
? "bg-success"
: "bg-primary"
}`}
>

{order.tracking_status}

</span>

</p>

</div>

<div className="card shadow p-4 mb-4">

<h4 className="mb-3">

🍔 Ordered Items

</h4>

{
orderItems.map((item,index)=>(

<div
key={index}
className="d-flex justify-content-between border-bottom py-2"
>

<div>

<b>{item.name}</b>

<br/>

Qty: {item.quantity}

</div>

<div>

₹{
item.price * item.quantity
}

</div>

</div>

))
}

</div>

<div className="container mt-5">

    <h3>
        Live Delivery Tracking
    </h3>

    <p>

<b>Status:</b>

<span
className={`badge ms-2 ${
order.tracking_status === "Delivered"
? "bg-success"
: "bg-warning text-dark"
}`}
>

{order.tracking_status}

</span>

</p>

    <LiveTrackingMap orderId={id} />

</div>

</div>

</div>

    )

}

export default TrackOrder;
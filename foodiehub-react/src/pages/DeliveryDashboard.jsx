import { useEffect, useState } from 'react';

function DeliveryDashboard() {

  const [orders, setOrders] = useState([]);

  const [myDeliveries, setMyDeliveries] = useState([]);

  const user = JSON.parse(
    localStorage.getItem('user')
);

const acceptDelivery = async(orderId) => {

    await fetch(

        'http://localhost/food-app/api/accept-delivery.php',

        {

            method:'POST',

            headers:{
                'Content-Type':'application/json'
            },

            body: JSON.stringify({

                order_id: orderId,

                delivery_agent_id: user.id

            })

        }

    );

    await updateLocation(orderId);
window.location.reload();

};


    const updateStatus = async(orderId,status)=>{

    await fetch(

        'http://localhost/food-app/api/update-delivery-status.php',

        {

            method:'POST',

            headers:{
                'Content-Type':'application/json'
            },

            body: JSON.stringify({

                order_id: orderId,

                status: status

            })

        }

    );

    window.location.reload();

};

const updateLocation = async(orderId) => {

return new Promise((resolve, reject) => {

navigator.geolocation.getCurrentPosition(

async(position) => {

try{

await fetch(

'http://localhost/food-app/api/update-location.php',

{
method:'POST',

headers:{
'Content-Type':'application/json'
},

body:JSON.stringify({

order_id:orderId,
delivery_agent_id:user.id,
latitude:position.coords.latitude,
longitude:position.coords.longitude

})

}

);

resolve();

}
catch(error){

reject(error);

}

},

(error)=>{

reject(error);

}

);

});

};

  useEffect(() => {
    fetch(
      'http://localhost/food-app/api/get-available-orders.php'
    )
      .then(res => res.json())
      .then(data => setOrders(data));

      fetch(
    `http://localhost/food-app/api/get-my-deliveries.php?delivery_agent_id=${user.id}`
)
.then(res => res.json())
.then(data => setMyDeliveries(data));
  }, []);

  useEffect(()=>{

const interval = setInterval(()=>{

myDeliveries.forEach(order=>{

updateLocation(order.id);

});

},10000);

return ()=> clearInterval(interval);

},[myDeliveries]);

 return (
<div className="container mt-4">

<div className="bg-dark text-white p-4 rounded shadow mb-4">

<h2>
🚴 Delivery Partner Dashboard
</h2>

<p className="mb-0">
Manage deliveries in real time
</p>

</div>

<div className="row mb-4">

<div className="col-md-4">

<div className="card bg-warning shadow">

<div className="card-body">

<h6>Available Orders</h6>

<h2>{orders.length}</h2>

</div>

</div>

</div>

<div className="col-md-4">

<div className="card bg-success text-white shadow">

<div className="card-body">

<h6>Completed Deliveries</h6>

<h2>
{
myDeliveries.filter(
o => o.tracking_status === "Delivered"
).length
}
</h2>

</div>

</div>

</div>

<div className="col-md-4">

<div className="card bg-primary text-white shadow">

<div className="card-body">

<h6>Total Earnings</h6>

<h2>

₹{
myDeliveries.reduce(
(sum,o)=>
sum + Number(o.total_amount),
0
)
}

</h2>

</div>

</div>

</div>

</div>

    {/* Available Orders */}

    <h3 className="mb-4">

📦 Available Orders

</h3>

<div className="row">

{
orders.map(order => (

<div
className="col-md-6 mb-4"
key={order.id}
>

<div className="card shadow border-0 h-100">

<div className="card-body">

<h4>

Order #{order.id}

</h4>

<hr />

<p>

📍 {order.address}

</p>

<p>
🆔 Delivery ID: #{order.id}
</p>

<p>
📞 {order.phone}
</p>

<p>

💰 ₹{order.total_amount}

</p>

<button
className="btn btn-success w-100"
onClick={() =>
acceptDelivery(order.id)
}
>

Accept Delivery

</button>

</div>

</div>

</div>

))
}

</div>


    {/* My Deliveries */}

    <h3 className="mt-5 mb-4">

🚚 My Deliveries

</h3>

<div className="row">

{
myDeliveries.map(order => (

<div
className="col-md-6 mb-4"
key={order.id}
>

<div
className="card shadow border-0 h-100"
style={{
borderRadius:"20px"
}}
>

<div className="card-body">

<h4>

Order #{order.id}

</h4>

<hr />

<p>

📍 {order.address}

</p>

<p>

💰 ₹{order.total_amount}

</p>

<p>

<span
className={`badge ${
order.tracking_status === "Delivered"
? "bg-success"
: order.tracking_status === "On The Way"
? "bg-primary"
: order.tracking_status === "Picked Up"
? "bg-info"
: "bg-warning text-dark"
}`}
>
{order.tracking_status}

</span>

</p>

<div className="d-flex flex-wrap gap-2">

<button
className="btn btn-primary btn-sm"
onClick={() =>
updateStatus(
order.id,
"Picked Up"
)}
>
📦 Picked Up
</button>

<button
className="btn btn-warning btn-sm"
onClick={() =>
updateStatus(
order.id,
"On The Way"
)}
>
🚚 On The Way
</button>

<button
className="btn btn-success btn-sm"
onClick={() =>
updateStatus(
order.id,
"Delivered"
)}
>
✅ Delivered
</button>

<button
className="btn btn-info btn-sm"
onClick={() =>
updateLocation(order.id)
}
>
📍 Update Location
</button>

</div>

</div>

</div>

</div>

))
}

</div>

  </div>
);
}

export default DeliveryDashboard;
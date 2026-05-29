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

 return (
  <div className="container mt-5">

    <h1>Delivery Dashboard</h1>

    {/* Available Orders */}

    <h3 className="mt-4">
      Available Orders
    </h3>

    <table className="table table-bordered">

      <thead>
        <tr>
          <th>Order ID</th>
          <th>Address</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>

        {orders.map(order => (

          <tr key={order.id}>

            <td>{order.id}</td>

            <td>{order.address}</td>

            <td>₹{order.total_amount}</td>

            <td>

              <button
                className="btn btn-success"
                onClick={() => acceptDelivery(order.id)}
              >
                Accept Delivery
              </button>

            </td>

          </tr>

        ))}

      </tbody>

    </table>


    {/* My Deliveries */}

    <h3 className="mt-5">
      My Deliveries
    </h3>

    <table className="table table-bordered">

      <thead>

        <tr>

          <th>Order ID</th>

          <th>Address</th>

          <th>Total</th>

          <th>Status</th>

        </tr>

      </thead>

      <tbody>

        {myDeliveries.map(order => (

          <tr key={order.id}>

            <td>{order.id}</td>

            <td>{order.address}</td>

            <td>₹{order.total_amount}</td>

            <td>

{order.tracking_status}

<br/><br/>

<button
className="btn btn-primary btn-sm me-2"
onClick={() =>
updateStatus(
order.id,
'Picked Up'
)}
>
Picked Up
</button>

<button
className="btn btn-warning btn-sm me-2"
onClick={() =>
updateStatus(
order.id,
'On The Way'
)}
>
On The Way
</button>

<button
className="btn btn-success btn-sm"
onClick={() =>
updateStatus(
order.id,
'Delivered'
)}
>
Delivered
</button>

</td>

          </tr>

        ))}

      </tbody>

    </table>

  </div>
);
}

export default DeliveryDashboard;
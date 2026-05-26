import { useEffect, useState } from 'react';

function AdminOrders(){

    const [orders, setOrders] = useState([]);

    console.log(orders);

    const fetchOrders = () => {

        fetch(

        'http://localhost/food-app/admin/orders.php'

        )

        .then(res => res.json())

        .then(data => {

    console.log(data);

    setOrders(data);

});

    };

    useEffect(() => {

        fetchOrders();

    }, []);

    const updateStatus = async(orderId, status) => {

        await fetch(

        'http://localhost/food-app/admin/update-order.php',

        {

            method:'POST',

            headers:{

                'Content-Type':'application/json'

            },

            body: JSON.stringify({

                order_id:orderId,
                tracking_status:status

            })

        });

        fetchOrders();

    };

    return(

        <div className="container mt-5">

            <h1 className="mb-4">

                Admin Orders

            </h1>

            <table className="table table-bordered">

                <thead className="table-dark">

                    <tr>

                        <th>Order ID</th>

                        <th>User ID</th>

                        <th>Total</th>

                        <th>Payment</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    {orders.map(order => (

                        <tr key={order.id}>

                            <td>

                                {order.id}

                            </td>

                            <td>

                                {order.user_id}

                            </td>

                            <td>

                                ₹{order.total_amount}

                            </td>

                            <td>

                                {order.payment_method}

                            </td>

                            <td>

                                {order.tracking_status}

                            </td>

                            <td>

                                <div className="d-flex gap-2 flex-wrap">

                                    <button

                                    className="btn btn-primary btn-sm"

                                    onClick={() =>

                                    updateStatus(

                                    order.id,
                                    'Accepted'

                                    )

                                    }

                                    >

                                        Accept

                                    </button>

                                    <button

                                    className="btn btn-warning btn-sm"

                                    onClick={() =>

                                    updateStatus(

                                    order.id,
                                    'Preparing'

                                    )

                                    }

                                    >

                                        Preparing

                                    </button>

                                    <button

                                    className="btn btn-info btn-sm"

                                    onClick={() =>

                                    updateStatus(

                                    order.id,
                                    'Out For Delivery'

                                    )

                                    }

                                    >

                                        Out For Delivery

                                    </button>

                                    <button

                                    className="btn btn-success btn-sm"

                                    onClick={() =>

                                    updateStatus(

                                    order.id,
                                    'Delivered'

                                    )

                                    }

                                    >

                                        Delivered

                                    </button>

                                </div>

                            </td>

                        </tr>

                    ))}

                </tbody>

            </table>

        </div>

    )

}

export default AdminOrders;
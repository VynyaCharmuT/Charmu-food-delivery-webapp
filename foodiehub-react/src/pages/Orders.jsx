import { useEffect, useState } from 'react';

import Navbar from '../components/Navbar';

import { Link } from 'react-router-dom';

function Orders(){

    const [orders, setOrders] = useState([]);

    const user = JSON.parse(

        localStorage.getItem('user')

    );

    useEffect(() => {

        fetch(

        `http://localhost/food-app/api/get-orders.php?user_id=${user.id}`

        )

        .then(res => res.json())

        .then(data => setOrders(data));

    }, []);

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <h1 className="mb-4">

                    My Orders

                </h1>

                <div className="row">

                    {orders.map(order => (

                        <div

                        className="col-md-6 mb-4"

                        key={order.id}

                        >

                            <div className="card shadow border-0 p-4">

                                <h4>

                                    Order #{order.id}

                                </h4>

                                <h5>

                                    ₹{order.total_amount}

                                </h5>

                                <p>

                                    Payment:
                                    {order.payment_method}

                                </p>

                                <p>

                                    Status:
                                    {order.order_status}

                                </p>

                                <p>

                                    Tracking:
                                    {order.tracking_status}

                                </p>

                                <Link

                                to={`/track/${order.id}`}

                                className="btn btn-warning"

                                >

                                    Track Order

                                </Link>

                            </div>

                        </div>

                    ))}

                </div>

            </div>

        </div>

    )

}

export default Orders;
import { useEffect, useState } from 'react';

import { useNavigate } from "react-router-dom";

import { Link } from 'react-router-dom';

function MyOrders(){

    const [orders,setOrders] = useState([]);
    const navigate = useNavigate();

    const user = JSON.parse(
        localStorage.getItem('user')
    );

    useEffect(() => {

        fetch(
        `http://localhost/food-app/api/my-orders.php?user_id=${user.id}`
        )
        .then(res => res.json())
        .then(data => {

            setOrders(data);

        });

    }, []);

    return(

        <div className="container mt-5">

            <h1 className="mb-4">

                My Orders

            </h1>

            {orders.map(order => (

                <div
                key={order.id}
                className="card p-4 mb-3 shadow"
                >

                    <h5>

                        Order #{order.id}

                    </h5>

                    <p>

                        Status:
                        {order.tracking_status}

                    </p>

                    <p>

    Total:
    ₹{order.total_amount}

</p>

                    <div className="d-flex gap-2">

    <a
        href={`/track/${order.id}`}
        className="btn btn-primary"
    >
        Track Order
    </a>

    <a
        href={`/order-details/${order.id}`}
        className="btn btn-dark"
    >
        View Details
    </a>

    {
        order.tracking_status === "Delivered" && (
            <button
                className="btn btn-warning"
                onClick={() =>
                    navigate(`/add-review/${order.id}`)
                }
            >
                ⭐ Rate Order
            </button>
        )
    }

</div>

                </div>

            ))}

        </div>

    );

}

export default MyOrders;
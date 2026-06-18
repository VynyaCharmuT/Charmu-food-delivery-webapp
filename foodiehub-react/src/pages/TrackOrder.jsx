import { useEffect, useState } from 'react';

import { useParams } from 'react-router-dom';

import Navbar from '../components/Navbar';

import LiveTrackingMap from "../components/LiveTrackingMap";

function TrackOrder(){

    const { id } = useParams();

    const [order, setOrder] = useState(null);

    useEffect(() => {

        fetch(

        `http://localhost/food-app/api/track-order.php?order_id=${id}`

        )

        .then(res => res.json())

        .then(data => {

            console.log(data);

            setOrder(data);

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

<div className="mt-5">

    <h3>
        Live Delivery Tracking
    </h3>

    <p className="text-success">

Current Status:
{order.tracking_status}

</p>

    <LiveTrackingMap orderId={id} />

</div>

</div>

</div>

    )

}

export default TrackOrder;
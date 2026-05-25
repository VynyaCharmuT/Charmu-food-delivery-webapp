import { useEffect, useState } from 'react';

import { useParams } from 'react-router-dom';

import Navbar from '../components/Navbar';

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

            <div className="container mt-5">

                <div className="card shadow border-0 p-5">

                    <h1 className="mb-4">

                        Track Order #{order.id}

                    </h1>

                    <h3 className="mb-4">

                        Current Status:
                        {' '}
                        {order.tracking_status}

                    </h3>

                    <div className="mt-5">

                        <div className="mb-4">

                            ✅ Order Placed

                        </div>

                        <div className="mb-4">

                            {

                                ['Accepted','Preparing','Out For Delivery','Delivered']

                                .includes(order.tracking_status)

                                ?

                                '✅ Accepted'

                                :

                                '⭕ Accepted'

                            }

                        </div>

                        <div className="mb-4">

                            {

                                ['Preparing','Out For Delivery','Delivered']

                                .includes(order.tracking_status)

                                ?

                                '✅ Preparing'

                                :

                                '⭕ Preparing'

                            }

                        </div>

                        <div className="mb-4">

                            {

                                ['Out For Delivery','Delivered']

                                .includes(order.tracking_status)

                                ?

                                '✅ Out For Delivery'

                                :

                                '⭕ Out For Delivery'

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

                    </div>

                </div>

            </div>

        </div>

    )

}

export default TrackOrder;
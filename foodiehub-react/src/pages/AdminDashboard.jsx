import { useEffect, useState } from 'react';

function AdminDashboard(){

    console.log("NEW DASHBOARD LOADED");

    const [stats, setStats] = useState({});

    useEffect(() => {

        fetch(
            'http://localhost/food-app/api/admin-stats.php'
        )
        .then(res => res.json())
        .then(data => {

            console.log(data);

            setStats(data);

        });

    }, []);

    return(

        <div className="container mt-5">

            <h1 className="mb-5">

                Admin Dashboard

            </h1>

            <div className="row">

                <div className="col-md-3">

                    <div className="card p-4 shadow">

                        <h5>Total Products</h5>

                        <h2>

                            {stats.products}

                        </h2>

                    </div>

                </div>

                <div className="col-md-3">

                    <div className="card p-4 shadow">

                        <h5>Total Orders</h5>

                        <h2>

                            {stats.orders}

                        </h2>

                    </div>

                </div>

                <div className="col-md-3">

                    <div className="card p-4 shadow">

                        <h5>Total Users</h5>

                        <h2>

                            {stats.users}

                        </h2>

                    </div>

                </div>

                <div className="col-md-3">

                    <div className="card p-4 shadow">

                        <h5>Total Revenue</h5>

                        <h2>

                            ₹{stats.revenue}

                        </h2>

                    </div>

                </div>

            </div>

        </div>

    );

}

export default AdminDashboard;
import {
Chart as ChartJS,
CategoryScale,
LinearScale,
PointElement,
LineElement,
Title,
Tooltip,
Legend
} from 'chart.js';

import { Line } from 'react-chartjs-2';
import { useEffect, useState } from 'react';

ChartJS.register(
CategoryScale,
LinearScale,
PointElement,
LineElement,
Title,
Tooltip,
Legend
);

function AdminDashboard(){

    console.log("NEW DASHBOARD LOADED");

    const [stats, setStats] = useState({});

    const [chartData, setChartData] = useState(null);

    useEffect(() => {
        fetch(
'http://localhost/food-app/api/admin-stats.php'
)
.then(res => res.json())
.then(data => {

setStats(data);

}); 
        fetch(
'http://localhost/food-app/api/revenue-chart.php'
)
.then(res => res.json())
.then(data => {
console.log("REVENUE DATA", data);
setChartData({

labels: data.map(item => item.day),

datasets: [
{
label:'Revenue',
data: data.map(item => item.revenue),

borderColor: '#28a745',
backgroundColor: '#28a745',

borderWidth: 4,

pointBackgroundColor: '#198754',
pointBorderColor: '#198754',

pointRadius: 6,

tension: 0.4
}
]

});

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

            <div className="row mt-5">

    <div className="col-md-3">

        <a
        href="/admin/orders"
        className="btn btn-primary w-100"
        >
            Manage Orders
        </a>

    </div>

    <div className="col-md-3">

        <a
        href="/admin/products"
        className="btn btn-success w-100"
        >
            Manage Products
        </a>

    </div>

    <div className="col-md-3">

        <a
        href="/admin/payments"
        className="btn btn-warning w-100"
        >
            Payments
        </a>

    </div>

    <div className="col-md-3">

        <a
        href="/admin/coupons"
        className="btn btn-dark w-100"
        >
            Coupons
        </a>

    </div>

    <div className="card mt-5 p-4 shadow">

<h3 className="mb-4">

Revenue Trend

</h3>

{
chartData &&
<Line
data={chartData}
options={{
responsive:true,
plugins:{
legend:{
labels:{
color:'#000'
}
}
},
scales:{
x:{
ticks:{
color:'#000'
}
},
y:{
ticks:{
color:'#000'
}
}
}
}}
/>
}

</div>

</div>

        </div>

    );

}

export default AdminDashboard;
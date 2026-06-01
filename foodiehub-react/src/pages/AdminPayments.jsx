import { useEffect, useState } from 'react';

function AdminPayments(){

    const [payments,setPayments] = useState([]);

    useEffect(() => {

        fetch(
        'http://localhost/food-app/api/admin-payments.php'
        )
        .then(res => res.json())
        .then(data => {

            setPayments(data);

        });

    }, []);

    return(

        <div className="container mt-5">

            <h1 className="mb-4">

                Payments

            </h1>

            <table className="table table-bordered">

                <thead className="table-dark">

                    <tr>

                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    {payments.map(payment => (

                        <tr key={payment.id}>

                            <td>{payment.id}</td>

                            <td>{payment.user_id}</td>

                            <td>
                                ₹{payment.total_amount}
                            </td>

                            <td>
                                {payment.payment_method}
                            </td>

                            <td>
                                {payment.payment_status}
                            </td>

                        </tr>

                    ))}

                </tbody>

            </table>

        </div>

    )

}

export default AdminPayments;
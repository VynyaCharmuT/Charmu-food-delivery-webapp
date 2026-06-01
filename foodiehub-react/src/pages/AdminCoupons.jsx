import { useEffect, useState } from 'react';

function AdminCoupons(){

    const [coupons,setCoupons] = useState([]);

    const deleteCoupon = async(id)=>{

await fetch(
`http://localhost/food-app/api/delete-coupon.php?id=${id}`
);

window.location.reload();

};

    useEffect(() => {

        fetch(
        'http://localhost/food-app/api/get-coupons.php'
        )
        .then(res => res.json())
        .then(data => {

            setCoupons(data);

        });

    }, []);

    return(

        <div className="container mt-5">

            <h1 className="mb-4">

                Coupons

            </h1>

            <table className="table table-bordered">

                <thead className="table-dark">

                    <tr>

                        <th>Code</th>

                        <th>Discount</th>

                        <th>Minimum Order</th>

                        <th>Expiry</th>
                        
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    {coupons.map(coupon => (

                        <tr key={coupon.id}>

                            <td>{coupon.code}</td>

                            <td>
                                {coupon.discount_percentage}%
                            </td>

                            <td>
                                ₹{coupon.minimum_order}
                            </td>

                            <td>
                                {coupon.expiry_date}
                            </td>

                            <td>

<button
className="btn btn-danger btn-sm"
onClick={() => deleteCoupon(coupon.id)}
>
Delete
</button>

</td>

                        </tr>

                    ))}

                </tbody>

            </table>

        </div>

    )

}

export default AdminCoupons;
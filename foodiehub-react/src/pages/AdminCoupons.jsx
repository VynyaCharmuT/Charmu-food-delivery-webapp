import { useEffect, useState } from 'react';

function AdminCoupons(){

    const [showForm,setShowForm] = useState(false);
    const [coupons,setCoupons] = useState([]);
    const [code,setCode] = useState("");
    const [discountPercentage,setDiscountPercentage] = useState("");
    const [minimumOrder,setMinimumOrder] = useState("");
    const [expiryDate,setExpiryDate] = useState(""); 
    const [description,setDescription] = useState("");
    const [editingId,setEditingId] = useState(null);
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

    const addCoupon = async() => {

const url = editingId
?
'http://localhost/food-app/api/update-coupon.php'
:
'http://localhost/food-app/api/add-coupon.php';

const response = await fetch(
url,
{
method:'POST',
headers:{
'Content-Type':'application/json'
},
body:JSON.stringify({
id:editingId,
code,
discount_percentage:discountPercentage,
minimum_order:minimumOrder,
expiry_date:expiryDate,
description
})
}
);

const data = await response.json();

if(data.success){

if(editingId){
alert("Coupon Updated");
}else{
alert("Coupon Added");
}
window.location.reload();

}else{

if(editingId){
alert("Failed To Update Coupon");
}else{
alert("Failed To Add Coupon");
}

}

};

    return(

        <div className="container mt-5">

            <div className="d-flex justify-content-between align-items-center mb-4">

<h1>

Coupons

</h1>

<button
className="btn btn-warning fw-bold"
onClick={() =>
setShowForm(!showForm)
}
>

{
showForm
?
"Close"
:
"+ Add Coupon"
}

</button>

</div>

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
className="btn btn-primary btn-sm me-2"
onClick={() => {

setEditingId(coupon.id);

setCode(coupon.code);

setDiscountPercentage(
coupon.discount_percentage
);

setMinimumOrder(
coupon.minimum_order
);

setExpiryDate(
coupon.expiry_date
);

setDescription(
coupon.description || ""
);

setShowForm(true);

}}
>
Edit
</button>

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

            {
showForm && (

<div className="card p-4 mb-4">

<h4 className="mb-3">

{
editingId
?
"Edit Coupon"
:
"Add Coupon"
}

</h4>

<input
className="form-control mb-3"
placeholder="Coupon Code"
value={code}
onChange={(e)=>setCode(e.target.value)}
/>

<input
type="number"
className="form-control mb-3"
placeholder="Discount %"
value={discountPercentage}
onChange={(e)=>setDiscountPercentage(e.target.value)}
/>

<input
type="number"
className="form-control mb-3"
placeholder="Minimum Order"
value={minimumOrder}
onChange={(e)=>setMinimumOrder(e.target.value)}
/>

<input
type="date"
className="form-control mb-3"
value={expiryDate}
onChange={(e)=>setExpiryDate(e.target.value)}
/>

<input
className="form-control mb-3"
placeholder="Description"
value={description}
onChange={(e)=>setDescription(e.target.value)}
/>

<button
className="btn btn-success"
onClick={addCoupon}
>
{
editingId
?
"Update Coupon"
:
"Save Coupon"
}
</button>

</div>

)
}

        </div>

    )

}

export default AdminCoupons;
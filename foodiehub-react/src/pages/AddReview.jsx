import React, { useState } from "react";
import { useParams, useNavigate } from "react-router-dom";

const AddReview = () => {

    const { orderId } = useParams();

    const navigate = useNavigate();

    const [rating,setRating] = useState(5);
    const [review,setReview] = useState("");

    const user = JSON.parse(localStorage.getItem("user"));

    const submitReview = async () => {

        const response = await fetch(
    "http://localhost/food-app/api/submit-review.php",
            {
                method:"POST",
                headers:{
                    "Content-Type":"application/json"
                },
                body:JSON.stringify({
                    order_id:orderId,
                    user_id:user.id,
                    rating,
                    review
                })
            }
        );

        const data = await response.json();

        if(data.success){
            alert("Review Submitted");
            navigate("/orders");
        }
        else{
            alert(data.message);
        }
    };

    return (
        <div className="container mt-5">

            <h2>Rate Your Order</h2>

            <div className="mb-3">

                <label className="form-label">
                    Rating
                </label>

                <select
                    className="form-control"
                    value={rating}
                    onChange={(e)=>setRating(e.target.value)}
                >
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>

            </div>

            <div className="mb-3">

                <label className="form-label">
                    Review
                </label>

                <textarea
                    className="form-control"
                    rows="5"
                    value={review}
                    onChange={(e)=>setReview(e.target.value)}
                />

            </div>

            <button
                className="btn btn-success"
                onClick={submitReview}
            >
                Submit Review
            </button>

        </div>
    );
};

export default AddReview;
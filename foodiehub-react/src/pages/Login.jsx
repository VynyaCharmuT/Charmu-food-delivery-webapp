import { Link } from 'react-router-dom';

import { useState } from 'react';

import { useNavigate } from 'react-router-dom';

function Login(){

    const navigate = useNavigate();

    const [email, setEmail] = useState('');

    const [password, setPassword] = useState('');

    const [role, setRole] = useState('user');

    const handleLogin = async (e) => {

        e.preventDefault();

        const response = await fetch(

        'http://localhost/food-app/api/login.php',

        {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json'

            },

            body: JSON.stringify({

                email,
                password,
                role

            })

        });

const data = await response.json();

console.log("Login Response:", data);

        if(data.success){

    localStorage.setItem(
        "user",
        JSON.stringify(data.user)
    );

    console.log(
    JSON.parse(localStorage.getItem("user"))
);

    alert("Login Successful");

    if(data.user.role === "admin"){

        window.location.href = "/admin/dashboard";

    }
    else if(data.user.role === "delivery"){

        window.location.href = "/delivery/dashboard";

    }
    else{

        window.location.href = "/";

    }

}

        else{

            alert(data.message);

        }

    }

    return(

        <div>

            <div className="hero hero-fade p-5 text-center mb-5">

<h1>🍔 FoodieHub</h1>

<p>
Premium Food Delivery Experience
</p>

                <div className="row justify-content-center">

                    <div className="col-md-5">

                        <div className="card p-5 shadow glass-login">

                            <h2 className="mb-2 text-center">
    Welcome Back 👋
</h2>

<p className="text-center mb-4">
    Login to FoodieHub
</p>

                            <form onSubmit={handleLogin}>

                                <input

                                type="email"

                                className="form-control premium-search mb-3"

                                placeholder="Email"

                                onChange={(e)=>

                                setEmail(e.target.value)

                                }

                                />

                                <input

                                type="password"

                                className="form-control premium-search mb-3"

                                placeholder="Password"

                                onChange={(e)=>

                                setPassword(e.target.value)

                                }

                                />

                                <select

    className="form-select premium-search mb-3"

                                onChange={(e)=>

                                setRole(e.target.value)

                                }

                                >

                                    <option value="user">

                                        User

                                    </option>

                                    <option value="admin">

                                        Admin

                                    </option>

                                    <option value="delivery">

                                        Delivery Agent

                                    </option>

                                </select>

                                <button

className="btn btn-warning premium-btn w-100 py-3"

>

    Login

</button>

<div className="text-center mt-4">

    <hr />

    <p className="mb-2">

        New to FoodieHub?

    </p>

    <Link
        to="/register"
        className="btn btn-outline-warning"
    >

        Create Account

    </Link>

</div>

</form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default Login;
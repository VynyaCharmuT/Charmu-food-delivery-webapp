import { Link } from 'react-router-dom';

import { useState } from 'react';

import { useNavigate } from 'react-router-dom';

function Register(){

    const navigate = useNavigate();

    const [name, setName] = useState('');

    const [email, setEmail] = useState('');

    const [password, setPassword] = useState('');

    const [role, setRole] = useState('user');

    const handleRegister = async (e) => {

        e.preventDefault();

        const response = await fetch(

        'http://localhost/food-app/api/register.php',

        {

            method: 'POST',

            headers: {

                'Content-Type': 'application/json'

            },

            body: JSON.stringify({

    name,
    email,
    password,
    role

})

        });

        const text = await response.text();

console.log("PHP Response:", text);

try{

    const data = JSON.parse(text);

    alert(data.message);

    if(data.success){

        navigate("/login");

    }

}
catch(error){

    console.log(error);

    alert("Server Error. Check register.php");

}

    }

    return(

        <div>

            <div className="hero hero-fade p-5 text-center mb-5">

<h1>🍔 FoodieHub</h1>

<p>
Join FoodieHub and start ordering amazing food
</p>

                <div className="row justify-content-center">

                    <div className="col-md-5">

                        <div className="card p-5 shadow glass-login">

                            <h2 className="text-center mb-2">
    Create Account ✨
</h2>

<p className="text-center mb-4">
    Join the FoodieHub Family
</p>

                            <form
onSubmit={handleRegister}
autoComplete="off"
>

                                <input

                                type="text"

                                autoComplete="off"

                                className="form-select premium-search mb-3"

                                placeholder="Name"

                                onChange={(e)=>

                                setName(e.target.value)

                                }

                                />

                                <input

                                type="email"

                                autoComplete="off"

                                className="form-control premium-search mb-3"

                                placeholder="Email"

                                onChange={(e)=>

                                setEmail(e.target.value)

                                }

                                />

                                <input
type="password"
autoComplete="new-password"

                                className="form-control premium-search mb-3"

                                placeholder="Password"

                                onChange={(e)=>

                                setPassword(e.target.value)

                                }

                                />

                                <select

className="form-control premium-search mb-3"

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

                                    Register

                                </button>

                                <div className="text-center mt-4">

    <hr />

    <p className="mb-2">
        Already have an account?
    </p>

    <Link
        to="/login"
        className="btn btn-outline-warning"
    >
        Login Here
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

export default Register;
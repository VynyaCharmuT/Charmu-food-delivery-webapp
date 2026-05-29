import { useState } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

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

console.log("LOGIN RESPONSE:", data);

alert(JSON.stringify(data));

        if(data.success){

            localStorage.setItem(

                'user',

                JSON.stringify(data.user)

            );

            alert('Login Successful');

            if(data.user.role === 'admin'){

    navigate('/admin/dashboard');

}

else if(data.user.role === 'delivery'){

    navigate('/delivery/dashboard');

}

else{

    navigate('/');

}

        }

        else{

            alert(data.message);

        }

    }

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="row justify-content-center">

                    <div className="col-md-5">

                        <div className="card p-4 shadow">

                            <h2 className="mb-4">

                                Login

                            </h2>

                            <form onSubmit={handleLogin}>

                                <input

                                type="email"

                                className="form-control mb-3"

                                placeholder="Email"

                                onChange={(e)=>

                                setEmail(e.target.value)

                                }

                                />

                                <input

                                type="password"

                                className="form-control mb-3"

                                placeholder="Password"

                                onChange={(e)=>

                                setPassword(e.target.value)

                                }

                                />

                                <select

                                className="form-control mb-3"

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

                                className="btn btn-warning w-100"

                                >

                                    Login

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default Login;
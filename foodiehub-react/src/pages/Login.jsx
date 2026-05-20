import { useState } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

function Login(){

    const navigate = useNavigate();

    const [email, setEmail] = useState('');

    const [password, setPassword] = useState('');

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
                password

            })

        });

        const data = await response.json();

        if(data.success){

            localStorage.setItem(

                'user',

                JSON.stringify(data.user)

            );

            alert('Login Successful');

            navigate('/');

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
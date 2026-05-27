import { useState } from 'react';

import { useNavigate } from 'react-router-dom';

import Navbar from '../components/Navbar';

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

        const data = await response.json();

        alert(data.message);

        navigate('/login');

    }

    return(

        <div>

            <Navbar />

            <div className="container mt-5">

                <div className="row justify-content-center">

                    <div className="col-md-5">

                        <div className="card p-4 shadow">

                            <h2 className="mb-4">

                                Register

                            </h2>

                            <form onSubmit={handleRegister}>

                                <input

                                type="text"

                                className="form-control mb-3"

                                placeholder="Name"

                                onChange={(e)=>

                                setName(e.target.value)

                                }

                                />

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

                                    Register

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    )

}

export default Register;
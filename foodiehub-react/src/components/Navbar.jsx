import { Link, useNavigate } from 'react-router-dom';

function Navbar(){

    const navigate = useNavigate();

    const user = JSON.parse(

        localStorage.getItem('user')

    );

    const handleLogout = () => {

        localStorage.removeItem('user');

        alert('Logged Out');

        navigate('/login');

    }

    return(

        <nav className="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">

            <div className="container">

                <Link

                className="navbar-brand fw-bold text-warning fs-1"

                to="/"

                >

                    FoodieHub

                </Link>

                <button

                className="navbar-toggler"

                type="button"

                data-bs-toggle="collapse"

                data-bs-target="#navMenu"

                >

                    <span className="navbar-toggler-icon"></span>

                </button>

                <div

                className="collapse navbar-collapse"

                id="navMenu"

                >

                    <ul className="navbar-nav ms-auto">

                        <li className="nav-item">

                            <Link

                            className="nav-link"

                            to="/"

                            >

                                Home

                            </Link>

                        </li>

                        <li className="nav-item">

                            <Link

                            className="nav-link"

                            to="/cart"

                            >

                                Cart

                            </Link>

                        </li>

                        <li className="nav-item">

                            <Link

                            className="nav-link"

                            to="/orders"

                            >

                                Orders

                            </Link>

                        </li>

                        {user ? (

                            <>

                                <li className="nav-item">

                                    <span

                                    className="nav-link fw-bold"

                                    >

                                        Hi, {user.name}

                                    </span>

                                </li>

                                <li className="nav-item">

                                    <button

                                    className="btn btn-warning ms-2"

                                    onClick={handleLogout}

                                    >

                                        Logout

                                    </button>

                                </li>

                            </>

                        ) : (

                            <>

                                <li className="nav-item">

                                    <Link

                                    className="nav-link"

                                    to="/login"

                                    >

                                        Login

                                    </Link>

                                </li>

                                <li className="nav-item">

                                    <Link

                                    className="nav-link"

                                    to="/register"

                                    >

                                        Register

                                    </Link>

                                </li>

                            </>

                        )}

                    </ul>

                </div>

            </div>

        </nav>

    )

}

export default Navbar;
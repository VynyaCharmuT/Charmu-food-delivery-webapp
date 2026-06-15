import { Link, useNavigate } from 'react-router-dom';
import { useContext, useState } from 'react';
import { CartContext } from '../context/CartContext';

function Navbar(){

    const navigate = useNavigate();

    const { cart, grandTotal } = useContext(CartContext);

    const [showMiniCart, setShowMiniCart] = useState(false);

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

                <button

className="btn btn-outline-warning me-3"

onClick={() =>
setShowMiniCart(!showMiniCart)
}

>

Cart (

{cart.reduce(
(total,item)=>
total + item.quantity,
0
)}

)

</button>

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

            {
showMiniCart && (

<div

style={{
position:'fixed',
top:'0',
right:'0',
width:'350px',
height:'100vh',
background:'#fff',
padding:'20px',
boxShadow:'-5px 0 15px rgba(0,0,0,0.2)',
zIndex:'9999',
overflowY:'auto'
}}

>

<h3>Your Cart</h3>

<hr />

{
cart.length === 0
?

<p>Cart Empty</p>

:

<>
{
cart.map(item => (

<div
key={item.id}
className="mb-3"
>

<h6>{item.name}</h6>

<p>

Qty:
{item.quantity}

</p>

<p>

₹{
item.price *
item.quantity
}

</p>

<hr />

</div>

))
}

<h4>

Total:
₹{grandTotal}

</h4>

<Link

to="/cart"

className="btn btn-warning w-100"

onClick={() =>
setShowMiniCart(false)
}

>

Go To Cart

</Link>

</>
}

</div>

)
}

        </nav>

    )

}

export default Navbar;
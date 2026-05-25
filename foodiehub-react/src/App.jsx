import { BrowserRouter, Routes, Route } from 'react-router-dom';

import Home from './pages/Home';
import Cart from './pages/Cart';
import Orders from './pages/Orders';
import TrackOrder from './pages/TrackOrder';
import Login from './pages/Login';
import Register from './pages/Register';
import ProductDetails from './pages/ProductDetails';
import ProtectedRoute from './protected/ProtectedRoute';
import Checkout from './pages/Checkout';

function App(){

  return(

    <BrowserRouter>

      <Routes>

        <Route path="/" element={<Home />} />
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/orders" element={<Orders />} />
        <Route path="/track/:id" element={<TrackOrder />} />

<Route

path="/cart"

element={

<ProtectedRoute>

    <Cart />

</ProtectedRoute>

}

/>

<Route

path="/orders"

element={

<ProtectedRoute>

    <Orders />

</ProtectedRoute>

}

/>

<Route

path="/track-order"

element={

<ProtectedRoute>

    <TrackOrder />

</ProtectedRoute>

}

/>

        <Route path="/login" element={<Login />} />

        <Route path="/register" element={<Register />} />

        <Route path="/product/:id" element={<ProductDetails />} />

      </Routes>

    </BrowserRouter>

  )

}

export default App;
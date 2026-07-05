import { Navigate } from 'react-router-dom'; 
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
import AdminOrders from './pages/AdminOrders';
import AdminProducts from './pages/AdminProducts';
import AddProduct from './admin/AddProduct';
import AdminDashboard from './pages/AdminDashboard';
import DeliveryDashboard from './pages/DeliveryDashboard';
import AdminPayments from './pages/AdminPayments';
import AdminCoupons from './pages/AdminCoupons';
import AddReview from "./pages/AddReview";
import OrderSuccess from "./pages/OrderSuccess";

function App(){

  const user = JSON.parse(
    localStorage.getItem("user")
);

  return(

    <BrowserRouter>

      <Routes>

        <Route path="/"element={user?<Home />:<Navigate to="/login" />}/>
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/track/:id" element={<TrackOrder />} />
        <Route
path="/admin/orders"
element={
<ProtectedRoute>
<AdminOrders />
</ProtectedRoute>
}
/>

<Route
path="/admin/products"
element={
<ProtectedRoute>
<AdminProducts />
</ProtectedRoute>
}
/>

<Route
path="/admin/add-product"
element={
<ProtectedRoute>
<AddProduct />
</ProtectedRoute>
}
/>

<Route
path="/admin/dashboard"
element={
<ProtectedRoute>
<AdminDashboard />
</ProtectedRoute>
}
/>

<Route
path="/delivery/dashboard"
element={
<ProtectedRoute>
<DeliveryDashboard />
</ProtectedRoute>
}
/>

<Route
path="/admin/payments"
element={
<ProtectedRoute>
<AdminPayments />
</ProtectedRoute>
}
/>

<Route
path="/admin/coupons"
element={
<ProtectedRoute>
<AdminCoupons />
</ProtectedRoute>
}
/>
        <Route path="/add-review/:orderId" element={<AddReview />} />
        <Route path="/cart" element={<ProtectedRoute><Cart /></ProtectedRoute>} />
        <Route path="/orders" element={<ProtectedRoute><Orders /></ProtectedRoute>}/>
        <Route path="/track-order" element={<ProtectedRoute><TrackOrder /></ProtectedRoute>} />
        <Route path="/order-details/:id" element={<ProtectedRoute><TrackOrder /></ProtectedRoute>} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/product/:id" element={<ProductDetails />} />
        <Route
path="/order-success"
element={<OrderSuccess />}
/>

      </Routes>

    </BrowserRouter>

  )

}

export default App;
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

const user = JSON.parse(
localStorage.getItem("user")
);

function App(){

  return(

    <BrowserRouter>

      <Routes>

        <Route path="/"element={user?<Home />:<Navigate to="/login" />}/>
        <Route path="/checkout" element={<Checkout />} />
        <Route path="/track/:id" element={<TrackOrder />} />
        <Route path="/admin/orders" element={<AdminOrders />} />
        <Route path="/admin/products" element={<AdminProducts />} />
        <Route path="/admin/add-product" element={<AddProduct />} />
        <Route path="/admin/dashboard" element={<AdminDashboard />} />
        <Route path="/delivery/dashboard" element={<DeliveryDashboard />} />
        <Route path="/admin/payments" element={<AdminPayments />} />
        <Route path="/admin/coupons" element={<AdminCoupons />} />
        <Route path="/add-review/:orderId" element={<AddReview />} />
        <Route path="/cart" element={<ProtectedRoute><Cart /></ProtectedRoute>} />
        <Route path="/orders" element={<ProtectedRoute><Orders /></ProtectedRoute>}/>
        <Route path="/track-order" element={<ProtectedRoute><TrackOrder /></ProtectedRoute>} />
        <Route path="/order-details/:id" element={<ProtectedRoute><TrackOrder /></ProtectedRoute>} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/product/:id" element={<ProductDetails />} />

      </Routes>

    </BrowserRouter>

  )

}

export default App;
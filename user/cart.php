<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id,
               products.name,
               products.price,
               products.image,
               cart.quantity

        FROM cart

        JOIN products
        ON cart.product_id = products.id

        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$total = 0;

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="home.php">

FoodieHub

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navMenu">

<ul class="navbar-nav ms-auto align-items-center">

<li class="nav-item">

<a class="nav-link"
href="home.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link active"
href="cart.php">

<i class="fa-solid fa-cart-shopping"></i>

Cart

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="../logout.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-5">

<div>

<h1 class="fw-bold">

Your Cart

</h1>

<p class="text-muted">

Review your selected food items

</p>

</div>

</div>

<div class="row g-4">

<div class="col-lg-8">

<?php while($row = $result->fetch_assoc()) {

$item_total = $row['price'] * $row['quantity'];

$total += $item_total;

?>

<div class="product-card mb-4">

<div class="row g-0 align-items-center">

<div class="col-md-4">

<img src="../assets/images/<?php echo $row['image']; ?>"
style="
height:250px;
object-fit:cover;
width:100%;
">

</div>

<div class="col-md-8">

<div class="product-info">

<div class="d-flex justify-content-between">

<h3 class="fw-bold">

<?php echo $row['name']; ?>

</h3>

</div>

<h4 class="price my-3">

₹<?php echo $row['price']; ?>

</h4>

<div class="d-flex align-items-center gap-3 my-3">

<a href="decrease-qty.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-dark">

-

</a>

<span class="fw-bold">

<?php echo $row['quantity']; ?>

</span>

<a href="increase-qty.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-dark">

+

</a>

</div>

<p>

Total:
<strong>

₹<?php echo $item_total; ?>

</strong>

</p>

<a href="remove-cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger">

<i class="fa-solid fa-trash"></i>

Remove

</a>

</div>

</div>

</div>

</div>

<?php } ?>

</div>

<div class="col-lg-4">

<div class="card border-0 shadow-lg p-4"
style="border-radius:25px;">

<h3 class="fw-bold mb-4">

Order Summary

</h3>

<div class="d-flex justify-content-between mb-3">

<span>

Subtotal

</span>

<span>

₹<?php echo $total; ?>

</span>

</div>

<div class="d-flex justify-content-between mb-3">

<span>

Delivery

</span>

<span>

₹40

</span>

</div>

<hr>

<div class="d-flex justify-content-between mb-4">

<h4>

Total

</h4>

<h4>

₹<?php echo $total + 40; ?>

</h4>

</div>

<a href="checkout.php"
class="btn btn-main w-100">

Proceed To Checkout

</a>

</div>

</div>

</div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
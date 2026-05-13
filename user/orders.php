<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$current_orders = $conn->query(

    "SELECT *
     FROM orders

     WHERE user_id = $user_id
     AND tracking_status != 'Delivered'

     ORDER BY id DESC"

);

$previous_orders = $conn->query(

    "SELECT *
     FROM orders

     WHERE user_id = $user_id
     AND tracking_status = 'Delivered'

     ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

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
href="orders.php">

My Orders

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="cart.php">

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

My Orders

</h1>

<p class="text-muted">

Track and manage your food orders

</p>

</div>

</div>

<h3 class="fw-bold mb-4">

Current Orders

</h3>

<div class="row g-4 mb-5">

<?php while($row = $current_orders->fetch_assoc()) { ?>

<div class="col-lg-6">

<div class="card border-0 shadow-lg p-4"
style="border-radius:25px;">

<div class="d-flex justify-content-between align-items-center mb-3">

<h4 class="fw-bold">

Order #<?php echo $row['id']; ?>

</h4>

<span class="badge bg-warning text-dark p-2">

<?php echo $row['tracking_status']; ?>

</span>

</div>

<p>

<b>Total:</b>

₹<?php echo $row['total_amount']; ?>

</p>

<p>

<b>Estimated Delivery:</b>

<?php echo $row['estimated_delivery']; ?>

</p>

<p>

<b>Ordered On:</b>

<?php echo $row['created_at']; ?>

</p>

<div class="d-flex gap-3 mt-3">

<a href="track-order.php?id=<?php echo $row['id']; ?>"
class="btn btn-main">

Track Order

</a>

</div>

</div>

</div>

<?php } ?>

</div>

<h3 class="fw-bold mb-4">

Previous Orders

</h3>

<div class="row g-4">

<?php while($row = $previous_orders->fetch_assoc()) { ?>

<div class="col-lg-6">

<div class="card border-0 shadow-sm p-4"
style="border-radius:25px;
opacity:0.9;">

<div class="d-flex justify-content-between align-items-center mb-3">

<h4 class="fw-bold">

Order #<?php echo $row['id']; ?>

</h4>

<span class="badge bg-success p-2">

Delivered

</span>

</div>

<p>

<b>Total:</b>

₹<?php echo $row['total_amount']; ?>

</p>

<p>

<b>Delivered On:</b>

<?php echo $row['created_at']; ?>

</p>

<div class="d-flex gap-3 mt-3">

<a href="track-order.php?id=<?php echo $row['id']; ?>"
class="btn btn-outline-dark">

View Details

</a>

<a href="home.php"
class="btn btn-main">

Order Again

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
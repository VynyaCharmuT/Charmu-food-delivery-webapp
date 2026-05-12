<?php

session_start();

include '../includes/db.php';

$id = $_GET['id'];

$order = $conn->query(

    "SELECT *
     FROM orders
     WHERE id = $id"

);

$row = $order->fetch_assoc();

$status = $row['tracking_status'];

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Track Order</title>

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

</div>

</nav>

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">

Track Your Order

</h1>

<p class="text-muted">

Order #<?php echo $row['id']; ?>

</p>

</div>

<div class="card border-0 shadow-lg p-5"
style="border-radius:30px;">

<div class="tracking-step
<?php if($status == 'Order Placed' || $status == 'Preparing' || $status == 'Out For Delivery' || $status == 'Delivered') echo 'active'; ?>">

<div class="tracking-icon">

<i class="fa-solid fa-receipt"></i>

</div>

<h5>

Order Placed

</h5>

</div>

<div class="tracking-step
<?php if($status == 'Preparing' || $status == 'Out For Delivery' || $status == 'Delivered') echo 'active'; ?>">

<div class="tracking-icon">

<i class="fa-solid fa-kitchen-set"></i>

</div>

<h5>

Preparing

</h5>

</div>

<div class="tracking-step
<?php if($status == 'Out For Delivery' || $status == 'Delivered') echo 'active'; ?>">

<div class="tracking-icon">

<i class="fa-solid fa-motorcycle"></i>

</div>

<h5>

Out For Delivery

</h5>

</div>

<div class="tracking-step
<?php if($status == 'Delivered') echo 'active'; ?>">

<div class="tracking-icon">

<i class="fa-solid fa-circle-check"></i>

</div>

<h5>

Delivered

</h5>

</div>

</div>

<div class="card border-0 shadow-lg p-4 mt-5"
style="border-radius:25px;">

<h3 class="fw-bold mb-4">

Order Summary

</h3>

<p>

<b>Total Amount:</b>

₹<?php echo $row['total_amount']; ?>

</p>

<p>

<b>Payment Method:</b>

<?php echo $row['payment_method']; ?>

</p>

<?php if($row['cutlery_persons'] > 0) { ?>

<p>

<b>Cutlery Requested:</b>

For <?php echo $row['cutlery_persons']; ?> persons

</p>

<?php } ?>

<?php if($row['sauce_quantity'] > 0) { ?>

<p>

<b>Sauces:</b>

<?php echo $row['sauce_type']; ?>

x <?php echo $row['sauce_quantity']; ?>

</p>

<?php } ?>

<?php if($row['beverage_quantity'] > 0) { ?>

<p>

<b>Beverage:</b>

<?php echo $row['beverage_type']; ?>

x <?php echo $row['beverage_quantity']; ?>

</p>

<?php } ?>

<?php if($row['addon_charges'] > 0) { ?>

<p class="text-success fw-bold">

Add-on Charges:
₹<?php echo $row['addon_charges']; ?>

</p>

<?php } ?>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
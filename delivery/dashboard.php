<?php

session_start();

include '../includes/db.php';

$delivery_id = $_SESSION['user_id'];

$available_orders = $conn->query(
    "SELECT orders.*,
            users.name

     FROM orders

     JOIN users
     ON orders.user_id = users.id

     WHERE delivery_agent_id IS NULL
     AND order_status='Out For Delivery'"
);

$my_orders = $conn->query(
    "SELECT orders.*,
            users.name

     FROM orders

     JOIN users
     ON orders.user_id = users.id

     WHERE delivery_agent_id = $delivery_id"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Delivery Dashboard</title>

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
href="#">

FoodieHub Rider

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

<a class="nav-link active"
href="dashboard.php">

Dashboard

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

Delivery Dashboard

</h1>

<p class="text-muted">

Manage and track assigned deliveries

</p>

</div>

</div>

<hr>

<h3 class="fw-bold mb-4">

<i class="fa-solid fa-box-open text-primary"></i>

Available Orders

</h3>

<div class="table-responsive">

<table class="table modern-table align-middle">

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Add-ons</th>
<th>Action</th>

</tr>

<?php while($row = $available_orders->fetch_assoc()) { ?>

<tr>

<td>
#<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>

<?php if($row['beverage_quantity'] > 0) { ?>

<div class="mb-2">

🥤
<?php echo $row['beverage_type']; ?>

x <?php echo $row['beverage_quantity']; ?>

</div>

<?php } ?>

<?php if($row['sauce_quantity'] > 0) { ?>

<div class="mb-2">

🍅
<?php echo $row['sauce_type']; ?>

x <?php echo $row['sauce_quantity']; ?>

</div>

<?php } ?>

<?php if($row['cutlery_persons'] > 0) { ?>

<div>

🍴
<?php echo $row['cutlery_persons']; ?> persons

</div>

<?php } ?>

</td>

<td>

<a href="accept-order.php?id=<?php echo $row['id']; ?>"
class="btn btn-main">

Accept Delivery

</a>

</td>

</tr>

<?php } ?>

</table>
</div>

<hr>

<h3 class="fw-bold mb-4 mt-5">

<i class="fa-solid fa-motorcycle text-success"></i>

My Deliveries

</h3>

<div class="table-responsive">

<table class="table modern-table align-middle">

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Status</th>
<th>Add-ons</th>
<th>Actions</th>

</tr>

<?php while($row = $my_orders->fetch_assoc()) { ?>

<tr>

<td>
#<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>

<span class="badge bg-warning text-dark p-2">

<?php echo $row['tracking_status']; ?>

</span>

</td>

<td>

<?php if($row['beverage_quantity'] > 0) { ?>

<div class="mb-2">

🥤
<?php echo $row['beverage_type']; ?>

x <?php echo $row['beverage_quantity']; ?>

</div>

<?php } ?>

<?php if($row['sauce_quantity'] > 0) { ?>

<div class="mb-2">

🍅
<?php echo $row['sauce_type']; ?>

x <?php echo $row['sauce_quantity']; ?>

</div>

<?php } ?>

<?php if($row['cutlery_persons'] > 0) { ?>

<div>

🍴
<?php echo $row['cutlery_persons']; ?> persons

</div>

<?php } ?>

</td>

<td>

<a href="update-delivery.php?id=<?php echo $row['id']; ?>"
class="btn btn-dark">

Update Status

</a>

</td>

</tr>

<?php } ?>

</table>
</div>

<a href="../logout.php"
class="btn btn-danger mt-4 px-4 py-2">

Logout

</a>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
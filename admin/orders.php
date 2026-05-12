<?php

include '../includes/db.php';

$orders = $conn->query(
    "SELECT orders.*,
            users.name

     FROM orders

     JOIN users
     ON orders.user_id = users.id

     ORDER BY orders.id DESC"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Orders Management</title>

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
href="dashboard.php">

FoodieHub Admin

</a>

<div class="ms-auto">

<a href="dashboard.php"
class="btn btn-outline-dark">

Dashboard

</a>

</div>

</div>

</nav>

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-5">

<div>

<h1 class="fw-bold">

Orders Management

</h1>

<p class="text-muted">

Manage customer orders and delivery flow

</p>

</div>

</div>

<div class="table-responsive">

<table class="table modern-table align-middle">

<table class="table table-bordered bg-white">

<tr>

<th>Order ID</th>
<th>User</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
<th>Add-ons</th>
<th>Extras</th>
<th>Action</th>

</tr>

<?php while($row = $orders->fetch_assoc()) { ?>

<tr>

<td>
#<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
₹<?php echo $row['total_amount']; ?>
</td>

<td>
<?php echo $row['payment_method']; ?>
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

</td>

<td>

<?php if($row['cutlery_persons'] > 0) { ?>

<div class="mb-2">

🍴 Cutlery:
<?php echo $row['cutlery_persons']; ?>

</div>

<?php } ?>

<?php if($row['addon_charges'] > 0) { ?>

<div class="text-success fw-bold">

+₹<?php echo $row['addon_charges']; ?>

</div>

<?php } ?>

</td>

<td>

<a href="update-status.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary btn-sm">

Update Status

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
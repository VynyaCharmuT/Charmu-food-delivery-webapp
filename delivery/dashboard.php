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

<title>Delivery Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2>Delivery Dashboard</h2>

<hr>

<h3>Available Orders</h3>

<table class="table table-bordered bg-white">

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
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
₹<?php echo $row['total_amount']; ?>
</td>

<td>

<a href="accept-order.php?id=<?php echo $row['id']; ?>"
   class="btn btn-success btn-sm">

Accept Delivery

</a>

</td>

</tr>

<?php } ?>

</table>

<hr>

<h3>My Deliveries</h3>

<table class="table table-bordered bg-white">

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Status</th>
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
<?php echo $row['tracking_status']; ?>
</td>

<td>

<a href="update-delivery.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary btn-sm">

Update Status

</a>

</td>

</tr>

<?php } ?>

</table>

<a href="../logout.php"
   class="btn btn-danger">

Logout

</a>

</div>

</body>
</html>
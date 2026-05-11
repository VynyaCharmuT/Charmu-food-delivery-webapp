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

<title>Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2>All Orders</h2>

<table class="table table-bordered bg-white">

<tr>

<th>Order ID</th>
<th>User</th>
<th>Total</th>
<th>Payment</th>
<th>Status</th>
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
<?php echo $row['order_status']; ?>
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

</body>
</html>
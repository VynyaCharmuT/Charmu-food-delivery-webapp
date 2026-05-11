<?php

include '../includes/db.php';

$id = $_GET['id'];

if(isset($_POST['update'])) {

    $status = $_POST['status'];

    $conn->query(
        "UPDATE orders
         SET order_status='$status'
         WHERE id=$id"
    );

    header("Location: orders.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Update Status</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Update Order Status</h2>

<form method="POST">

<select name="status"
        class="form-control mb-3">

<option>
Order Placed
</option>

<option>
Preparing
</option>

<option>
Out For Delivery
</option>

<option>
Delivered
</option>

</select>

<button name="update"
        class="btn btn-success">

Update

</button>

</form>

</div>

</div>

</body>
</html>
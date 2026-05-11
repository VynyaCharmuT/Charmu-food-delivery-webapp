<?php

include '../includes/db.php';

$id = $_GET['id'];

if(isset($_POST['update'])) {

    $status = $_POST['status'];

    $conn->query(
        "UPDATE orders

         SET tracking_status='$status',
             order_status='$status'

         WHERE id='$id'"
    );

    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Update Delivery</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Update Delivery Status</h2>

<form method="POST">

<select name="status"
        class="form-control mb-3">

<option>
Preparing Food
</option>

<option>
Picked Up
</option>

<option>
On The Way
</option>

<option>
Near Delivery Location
</option>

<option>
Delivered
</option>

</select>

<button name="update"
        class="btn btn-success">

Update Status

</button>

</form>

</div>

</div>

</body>
</html>
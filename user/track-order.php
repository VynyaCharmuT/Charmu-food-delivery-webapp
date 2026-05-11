<?php

include '../includes/db.php';

$id = $_GET['id'];

$order = $conn->query(
    "SELECT * FROM orders
     WHERE id='$id'"
);

$row = $order->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

<title>Track Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<meta http-equiv="refresh" content="5">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-5 text-center">

<h1>Track Your Order</h1>

<hr>

<h3>

Order ID:
#<?php echo $row['id']; ?>

</h3>

<h2 class="text-primary mt-4">

<?php echo $row['tracking_status']; ?>

</h2>

<div class="progress mt-4" style="height:30px;">

<div class="progress-bar progress-bar-striped progress-bar-animated"
     style="width:100%">

Tracking Active

</div>

</div>

<p class="mt-4">

This page refreshes automatically every 5 seconds.

</p>

<a href="home.php"
   class="btn btn-primary mt-3">

Back To Home

</a>

</div>

</div>

</body>
</html>
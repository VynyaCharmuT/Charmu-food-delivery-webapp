<?php

include '../includes/db.php';

$id = $_GET['id'];

$order = $conn->query(
    "SELECT * FROM orders
     WHERE id=$id"
);

$row = $order->fetch_assoc();

if(isset($_POST['update'])) {

    $status =
    $_POST['status'];

    $estimated_delivery =
    $_POST['estimated_delivery'];

    $conn->query(
        "UPDATE orders

         SET
         order_status='$status',
         tracking_status='$status',
         estimated_delivery='$estimated_delivery'

         WHERE id=$id"
    );

    header("Location: orders.php");

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Update Status</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="row justify-content-center">

<div class="col-lg-6">

<div class="card border-0 shadow-lg p-5"
style="border-radius:25px;">

<h2 class="fw-bold mb-4">

Update Order Status

</h2>

<p class="text-muted mb-4">

Manage live tracking updates for customer orders

</p>

<form method="POST">

<label class="fw-bold mb-2">

Tracking Status

</label>

<select name="status"
class="form-control mb-4">

<option value="Order Placed">

Order Placed

</option>

<option value="Preparing">

Preparing

</option>

<option value="Out For Delivery">

Out For Delivery

</option>

<option value="Delivered">

Delivered

</option>

</select>

<label class="fw-bold mb-2">

Estimated Delivery Time

</label>

<input type="text"
name="estimated_delivery"
class="form-control mb-4"
placeholder="Example: 20-25 mins"
value="<?php echo $row['estimated_delivery']; ?>">

<button name="update"
class="btn btn-dark px-4 py-2 w-100">

<i class="fa-solid fa-pen"></i>

Update Tracking

</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>
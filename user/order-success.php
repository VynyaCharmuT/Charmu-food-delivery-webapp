<?php

$order_id = $_GET['id'];

?>

<!DOCTYPE html>
<html>

<head>

<title>Order Success</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5 text-center">

<div class="card shadow p-5">

<h1 class="text-success">

Order Placed Successfully

</h1>

<h3>

Your Order ID:
#<?php echo $order_id; ?>

</h3>

<a href="track-order.php?id=<?php echo $order_id; ?>"
   class="btn btn-success mt-3">

Track Order

</a>

<a href="home.php"
   class="btn btn-primary mt-3">

Continue Shopping

</a>

</div>

</div>

</body>
</html>
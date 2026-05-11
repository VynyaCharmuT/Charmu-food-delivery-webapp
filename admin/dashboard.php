<?php

session_start();

include '../includes/db.php';

$total_products = $conn->query(
    "SELECT COUNT(*) AS total FROM products"
)->fetch_assoc()['total'];

$total_orders = $conn->query(
    "SELECT COUNT(*) AS total FROM orders"
)->fetch_assoc()['total'];

$total_users = $conn->query(
    "SELECT COUNT(*) AS total FROM users
     WHERE role='user'"
)->fetch_assoc()['total'];

$total_sales = $conn->query(
    "SELECT SUM(total_amount) AS total FROM orders"
)->fetch_assoc()['total'];

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-light">

<div class="container-fluid">

<div class="row">

<div class="col-md-2 bg-dark text-white min-vh-100 p-3">

<h3>Admin Panel</h3>

<hr>

<a href="dashboard.php"
   class="btn btn-dark w-100 mb-2">

Dashboard

</a>

<a href="products.php"
   class="btn btn-dark w-100 mb-2">

Manage Products

</a>

<a href="orders.php"
   class="btn btn-dark w-100 mb-2">

View Orders

</a>

<a href="../logout.php"
   class="btn btn-danger w-100">

Logout

</a>

</div>

<div class="col-md-10 p-4">

<h2>Admin Dashboard</h2>

<div class="row mt-4">

<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>Total Products</h5>

<h2>
<?php echo $total_products; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>Total Orders</h5>

<h2>
<?php echo $total_orders; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>Total Users</h5>

<h2>
<?php echo $total_users; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="card shadow text-center p-3">

<h5>Total Sales</h5>

<h2>
₹<?php echo $total_sales ?? 0; ?>
</h2>

</div>

</div>

</div>

<div class="card shadow mt-5 p-4">

<h4>Sales Analytics</h4>

<canvas id="salesChart"></canvas>

</div>

</div>

</div>

</div>

<script>

const ctx = document.getElementById('salesChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: ['Products', 'Orders', 'Users'],

        datasets: [{

            label: 'Analytics',

            data: [

                <?php echo $total_products; ?>,

                <?php echo $total_orders; ?>,

                <?php echo $total_users; ?>

            ]

        }]

    }

});

</script>

</body>
</html>
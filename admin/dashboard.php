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

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<div class="container-fluid">

<div class="row">

<div class="col-lg-2 admin-sidebar min-vh-100 p-4">

<h2 class="text-white fw-bold mb-4">

FoodieHub

</h2>

<p class="text-light mb-5">

Admin Panel

</p>

<a href="dashboard.php"
class="sidebar-link active">

<i class="fa-solid fa-chart-line"></i>

Dashboard

</a>

<a href="products.php"
class="sidebar-link">

<i class="fa-solid fa-burger"></i>

Manage Products

</a>

<a href="orders.php"
class="sidebar-link">

<i class="fa-solid fa-box"></i>

View Orders

</a>

<a href="../logout.php"
class="sidebar-link logout-link">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</div>

<div class="col-lg-10 p-5">

<div class="d-flex justify-content-between align-items-center mb-5">

<div>

<h1 class="fw-bold">

Admin Dashboard

</h1>

<p class="text-muted">

Manage products, users, and orders efficiently

</p>

</div>

</div>

<div class="row g-4">

<div class="col-md-3">

<div class="admin-card">

<i class="fa-solid fa-burger fa-2x mb-3 text-warning"></i>

<h5>Total Products</h5>

<h2>
<?php echo $total_products; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="admin-card">

<i class="fa-solid fa-box fa-2x mb-3 text-primary"></i>

<h5>Total Orders</h5>

<h2>
<?php echo $total_orders; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="admin-card">

<i class="fa-solid fa-users fa-2x mb-3 text-success"></i>

<h5>Total Users</h5>

<h2>
<?php echo $total_users; ?>
</h2>

</div>

</div>

<div class="col-md-3">

<div class="admin-card">

<i class="fa-solid fa-indian-rupee-sign fa-2x mb-3 text-danger"></i>

<h5>Total Sales</h5>

<h2>
₹<?php echo $total_sales ?? 0; ?>
</h2>

</div>

</div>

</div>

<div class="card border-0 shadow-lg mt-5 p-5"
style="border-radius:25px;">

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
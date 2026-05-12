<?php

include '../includes/db.php';

$id = $_GET['id'];

$product = $conn->query("SELECT * FROM products WHERE id=$id");

$row = $product->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Product Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">
   <nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="home.php">

FoodieHub

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navMenu">

<ul class="navbar-nav ms-auto align-items-center">

<li class="nav-item">

<a class="nav-link"
href="home.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="cart.php">

Cart

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="../logout.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container py-5">

<div class="row g-5 align-items-center">

<div class="col-md-6">

<img src="../assets/images/<?php echo $row['image']; ?>"
class="img-fluid product-detail-img">

</div>

<div class="col-md-6">

<div class="col-md-6">

<div class="product-detail-card">

<div class="d-flex justify-content-between align-items-center mb-3">

<h1 class="fw-bold">

<?php echo $row['name']; ?>

</h1>

<span class="badge bg-warning text-dark fs-6">

⭐ <?php echo $row['rating']; ?>

</span>

</div>

<h2 class="price mb-4">

₹<?php echo $row['price']; ?>

</h2>

<p class="text-muted fs-5 mb-4">

<?php echo $row['description']; ?>

</p>

<div class="mb-4">

<h5 class="fw-bold">

Ingredients

</h5>

<p>

<?php echo $row['ingredients']; ?>

</p>

</div>

<div class="mb-4">

<h5 class="fw-bold">

Allergens

</h5>

<span class="badge bg-danger me-2">

<?php echo $row['allergens']; ?>

</span>

</div>

<div class="mb-4">

<h5 class="fw-bold">

Serving Size

</h5>

<p>

<?php echo $row['serving_size']; ?>

</p>

</div>

<div class="d-flex gap-3 mt-5">

<a href="add-cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-main btn-lg px-5">

<i class="fa-solid fa-cart-shopping"></i>

Add To Cart

</a>

<a href="home.php"
class="btn btn-outline-dark btn-lg px-5">

Continue Shopping

</a>

</div>

</div>

</div>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php

session_start();

include '../includes/db.php';

if(isset($_GET['category']) && $_GET['category'] != '') {

    $category = $_GET['category'];

    $products = $conn->query(
        "SELECT * FROM products
         WHERE category='$category'"
    );

}

elseif(isset($_GET['search'])) {

    $search = $_GET['search'];

    $products = $conn->query(
        "SELECT * FROM products
         WHERE name LIKE '%$search%'"
    );

}

else {

    $products = $conn->query("SELECT * FROM products");

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Food Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body class="bg-light">

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="#">

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

<i class="fa-solid fa-cart-shopping"></i>

Cart

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="orders.php">

My Orders

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

<section class="py-5 text-white"
style="
background:
linear-gradient(rgba(0,0,0,0.5),
rgba(0,0,0,0.5)),
url('../assets/images/banner.jpg');

background-size:cover;
background-position:center;
">

<div class="container">

<h1 class="display-4 fw-bold">

Discover Delicious Foods

</h1>

<p class="lead">

Hot meals, desserts, and combos delivered instantly.

</p>

</div>

</section>

<div class="container mt-4">

<h2 class="mb-4">
Recommended Foods & Combos
</h2>

<form method="GET"
class="mb-4">

<div class="input-group">

<span class="input-group-text bg-white border-0">

<i class="fa-solid fa-magnifying-glass"></i>

</span>

<input type="text"
name="search"
class="form-control form-control-lg border-0 shadow-sm"
placeholder="Search foods...">

</div>

</form>

<div class="mb-5">

<a href="?category=Cakes"
class="btn btn-outline-dark rounded-pill me-2">

Cakes

</a>

<a href="?category=Combos"
class="btn btn-outline-dark rounded-pill me-2">

Combos

</a>

<a href="?category=Pizza"
class="btn btn-outline-dark rounded-pill me-2">

Pizza

</a>

<a href="?category=Beverages"
class="btn btn-outline-dark rounded-pill">

Beverages

</a>

</div>

<div class="row g-4">

<?php while($row = $products->fetch_assoc()) { ?>

<div class="col-lg-3 col-md-6 col-sm-6 mb-4">

<div class="product-card">

<img src="../assets/images/<?php echo $row['image']; ?>">

<div class="product-info">

<div class="d-flex justify-content-between align-items-center mb-2">

<h4 class="product-title">

<?php echo $row['name']; ?>

</h4>

<span class="badge bg-warning text-dark">

⭐ <?php echo $row['rating']; ?>

</span>

</div>

<p class="text-muted">

<?php echo $row['description']; ?>

</p>

<p>

<strong>Serves:</strong>
<?php echo $row['serving_size']; ?>

</p>

<p>

<strong>Allergens:</strong>
<?php echo $row['allergens']; ?>

</p>

<div class="d-flex justify-content-between align-items-center mt-3">

<span class="price">

₹<?php echo $row['price']; ?>

</span>

</div>

<a href="product-details.php?id=<?php echo $row['id']; ?>"
class="btn btn-dark w-100 mt-3">

View Details

</a>

<a href="add-cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-main w-100 mt-2">

<i class="fa-solid fa-cart-plus"></i>

Add To Cart

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
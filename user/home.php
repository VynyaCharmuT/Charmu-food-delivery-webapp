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

<title>Food App</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

.card img{
    height:220px;
    object-fit:cover;
}

</style>

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">

<div class="container-fluid">

<span class="navbar-brand">
Food & Confectionaries
</span>

<a href="../logout.php" class="btn btn-danger">
Logout
</a>

</div>

</nav>

<div class="container mt-4">

<h2 class="mb-4">
Recommended Foods & Combos
</h2>

<form method="GET" class="mb-4">

<input type="text"
       name="search"
       class="form-control"
       placeholder="Search foods...">

</form>

<form method="GET" class="mb-4">

<select name="category"
        class="form-control"
        onchange="this.form.submit()">

<option value="">All Categories</option>
<option value="Cakes">Cakes</option>
<option value="Combos">Combos</option>

</select>

</form>

<div class="row">

<?php while($row = $products->fetch_assoc()) { ?>

<div class="col-md-3 mb-4">

<div class="card shadow">

<img src="../assets/images/<?php echo $row['image']; ?>"
     class="card-img-top">

<div class="card-body">

<h5>
<?php echo $row['name']; ?>
</h5>

<p>
₹<?php echo $row['price']; ?>
</p>

<p>
<?php echo $row['description']; ?>
</p>

<p>
<b>Serving:</b>
<?php echo $row['serving_size']; ?>
</p>

<p>
<b>Allergens:</b>
<?php echo $row['allergens']; ?>
</p>

<p>
⭐ <?php echo $row['rating']; ?>
</p>

<a href="product-details.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary w-100 mb-2">

View Details

</a>

<a href="add-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-success w-100">

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
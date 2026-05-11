<?php

include '../includes/db.php';

$id = $_GET['id'];

$product = $conn->query("SELECT * FROM products WHERE id=$id");

$row = $product->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>

<title>Product Details</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row">

<div class="col-md-6">

<img src="../assets/images/<?php echo $row['image']; ?>"
     class="img-fluid rounded shadow">

</div>

<div class="col-md-6">

<h2>
<?php echo $row['name']; ?>
</h2>

<h4 class="text-success">
₹<?php echo $row['price']; ?>
</h4>

<p>
<?php echo $row['description']; ?>
</p>

<p>
<b>Ingredients:</b>
<?php echo $row['ingredients']; ?>
</p>

<p>
<b>Allergens:</b>
<?php echo $row['allergens']; ?>
</p>

<p>
<b>Serving Size:</b>
<?php echo $row['serving_size']; ?>
</p>

<p>
⭐ <?php echo $row['rating']; ?>
</p>

<a href="add-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-success">

Add To Cart

</a>

</div>

</div>

</div>

</body>
</html>
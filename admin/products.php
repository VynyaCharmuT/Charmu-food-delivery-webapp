<?php

include '../includes/db.php';

$products = $conn->query(
    "SELECT * FROM products"
);

?>

<!DOCTYPE html>
<html>

<head>

<title>Manage Products</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="d-flex justify-content-between">

<h2>Manage Products</h2>

<a href="add-product.php"
   class="btn btn-success">

Add Product

</a>

</div>

<table class="table table-bordered mt-4 bg-white">

<tr>

<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Actions</th>

</tr>

<?php while($row = $products->fetch_assoc()) { ?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>

<img src="../assets/images/<?php echo $row['image']; ?>"
     width="80">

</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
₹<?php echo $row['price']; ?>
</td>

<td>
<?php echo $row['stock']; ?>
</td>

<td>

<a href="edit-product.php?id=<?php echo $row['id']; ?>"
   class="btn btn-primary btn-sm">

Edit

</a>

<a href="delete-product.php?id=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>
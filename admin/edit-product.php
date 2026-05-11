<?php

include '../includes/db.php';

$id = $_GET['id'];

$product = $conn->query(
    "SELECT * FROM products
     WHERE id = $id"
);

$row = $product->fetch_assoc();

if(isset($_POST['update'])) {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $conn->query(
        "UPDATE products

         SET name='$name',
             price='$price',
             stock='$stock'

         WHERE id=$id"
    );

    header("Location: products.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Edit Product</h2>

<form method="POST">

<input type="text"
       name="name"
       value="<?php echo $row['name']; ?>"
       class="form-control mb-3">

<input type="number"
       name="price"
       value="<?php echo $row['price']; ?>"
       class="form-control mb-3">

<input type="number"
       name="stock"
       value="<?php echo $row['stock']; ?>"
       class="form-control mb-3">

<button name="update"
        class="btn btn-primary">

Update Product

</button>

</form>

</div>

</div>

</body>
</html>
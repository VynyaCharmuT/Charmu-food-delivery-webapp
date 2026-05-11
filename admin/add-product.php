<?php

include '../includes/db.php';

if(isset($_POST['submit'])) {

    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $allergens = $_POST['allergens'];
    $serving_size = $_POST['serving_size'];
    $rating = $_POST['rating'];

    $image = $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../assets/images/".$image
    );

    $conn->query(
        "INSERT INTO products(
            name,
            category,
            price,
            stock,
            image,
            description,
            ingredients,
            allergens,
            serving_size,
            rating
        )

        VALUES(
            '$name',
            '$category',
            '$price',
            '$stock',
            '$image',
            '$description',
            '$ingredients',
            '$allergens',
            '$serving_size',
            '$rating'
        )"
    );

    header("Location: products.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow p-4">

<h2>Add Product</h2>

<form method="POST"
      enctype="multipart/form-data">

<input type="text"
       name="name"
       class="form-control mb-3"
       placeholder="Product Name"
       required>

<input type="text"
       name="category"
       class="form-control mb-3"
       placeholder="Category"
       required>

<input type="number"
       name="price"
       class="form-control mb-3"
       placeholder="Price"
       required>

<input type="number"
       name="stock"
       class="form-control mb-3"
       placeholder="Stock"
       required>

<input type="file"
       name="image"
       class="form-control mb-3"
       required>

<textarea name="description"
          class="form-control mb-3"
          placeholder="Description"></textarea>

<textarea name="ingredients"
          class="form-control mb-3"
          placeholder="Ingredients"></textarea>

<input type="text"
       name="allergens"
       class="form-control mb-3"
       placeholder="Allergens">

<input type="text"
       name="serving_size"
       class="form-control mb-3"
       placeholder="Serving Size">

<input type="number"
       step="0.1"
       name="rating"
       class="form-control mb-3"
       placeholder="Rating">

<button name="submit"
        class="btn btn-success">

Add Product

</button>

</form>

</div>

</div>

</body>
</html>
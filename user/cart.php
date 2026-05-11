<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id,
               products.name,
               products.price,
               products.image,
               cart.quantity

        FROM cart

        JOIN products
        ON cart.product_id = products.id

        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$total = 0;

?>

<!DOCTYPE html>
<html>

<head>

<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<h2>Your Cart</h2>

<table class="table table-bordered bg-white">

<tr>

<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>

</tr>

<?php while($row = $result->fetch_assoc()) {

$item_total = $row['price'] * $row['quantity'];

$total += $item_total;

?>

<tr>

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

<a href="decrease-qty.php?id=<?php echo $row['id']; ?>"
   class="btn btn-sm btn-danger">

-

</a>

<?php echo $row['quantity']; ?>

<a href="increase-qty.php?id=<?php echo $row['id']; ?>"
   class="btn btn-sm btn-success">

+

</a>

</td>

<td>
₹<?php echo $item_total; ?>
</td>

<td>

<a href="remove-cart.php?id=<?php echo $row['id']; ?>"
   class="btn btn-danger btn-sm">

Remove

</a>

</td>

</tr>

<?php } ?>

</table>

<h3 class="text-end">
Grand Total: ₹<?php echo $total; ?>
</h3>

<div class="text-end">

<a href="checkout.php"
   class="btn btn-primary">

Proceed To Checkout

</a>

</div>

</div>

</body>
</html>
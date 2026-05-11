<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id,
               products.name,
               products.price,
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

<title>Checkout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row">

<div class="col-md-7">

<div class="card shadow p-4">

<h3>Delivery Details</h3>

<form action="place-order.php" method="POST">

<input type="text"
       name="address"
       class="form-control mb-3"
       placeholder="Delivery Address"
       required>

<textarea name="instructions"
          class="form-control mb-3"
          placeholder="Special Instructions"></textarea>

<h5>Add-ons</h5>

<div class="form-check">

<input class="form-check-input"
       type="checkbox"
       name="cutlery">

<label class="form-check-label">
Need Cutlery
</label>

</div>

<div class="form-check">

<input class="form-check-input"
       type="checkbox"
       name="sauces">

<label class="form-check-label">
Extra Sauces
</label>

</div>

<div class="form-check mb-3">

<input class="form-check-input"
       type="checkbox"
       name="beverages">

<label class="form-check-label">
Add Beverage
</label>

</div>

<input type="text"
       name="coupon"
       class="form-control mb-3"
       placeholder="Coupon Code">

<select name="payment_method"
        class="form-control mb-3">

<option value="COD">
Cash On Delivery
</option>

<option value="UPI">
UPI
</option>

<option value="Card">
Card
</option>

</select>

<button class="btn btn-success w-100">
Place Order
</button>

</form>

</div>

</div>

<div class="col-md-5">

<div class="card shadow p-4">

<h3>Order Summary</h3>

<?php while($row = $result->fetch_assoc()) {

$item_total = $row['price'] * $row['quantity'];

$total += $item_total;

?>

<p>

<?php echo $row['name']; ?>

x <?php echo $row['quantity']; ?>

<span class="float-end">

₹<?php echo $item_total; ?>

</span>

</p>

<?php } ?>

<hr>

<h4>

Total

<span class="float-end">

₹<?php echo $total; ?>

</span>

</h4>

</div>

</div>

</div>

</div>

</body>
</html>
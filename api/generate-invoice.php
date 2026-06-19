<?php

include '../includes/db.php';

$order_id = $_GET['order_id'];

$order = $conn->query("
SELECT *
FROM orders
WHERE id='$order_id'
")->fetch_assoc();

$items = $conn->query("
SELECT oi.*, p.name
FROM order_items oi
JOIN products p
ON oi.product_id = p.id
WHERE oi.order_id='$order_id'
");

?>

<!DOCTYPE html>

<html>

<head>

<title>
Invoice #<?php echo $order_id; ?>
</title>

<style>

body{
font-family:Arial;
padding:40px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

th,td{
border:1px solid #ddd;
padding:10px;
}

</style>

</head>

<body>

<h1>FoodieHub Invoice</h1>

<hr>

<h3>
Order #<?php echo $order['id']; ?>
</h3>

<p>
Date:
<?php echo $order['created_at']; ?>
</p>

<p>
Payment:
<?php echo $order['payment_method']; ?>
</p>

<p>
Status:
<?php echo $order['payment_status']; ?>
</p>

<table>

<tr>

<th>Item</th>

<th>Qty</th>

<th>Price</th>

<th>Total</th>

</tr>

<?php

$grandTotal = 0;

while($item = $items->fetch_assoc()){

$total =
$item['price']
*
$item['quantity'];

$grandTotal += $total;

?>

<tr>

<td>
<?php echo $item['name']; ?>
</td>

<td>
<?php echo $item['quantity']; ?>
</td>

<td>
₹<?php echo $item['price']; ?>
</td>

<td>
₹<?php echo $total; ?>
</td>

</tr>

<?php } ?>

</table>

<h2>

Grand Total:
₹<?php echo $grandTotal; ?>

</h2>

</body>

</html>
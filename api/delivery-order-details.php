<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "

SELECT
order_items.*,
products.name,
products.price,
orders.address,
orders.phone,
orders.total_amount

FROM order_items

JOIN products
ON products.id = order_items.product_id

JOIN orders
ON orders.id = order_items.order_id

WHERE order_items.order_id='$order_id'

";

$result = $conn->query($sql);

$items = [];

while($row = $result->fetch_assoc()){

    $items[] = $row;

}

echo json_encode($items);

?>
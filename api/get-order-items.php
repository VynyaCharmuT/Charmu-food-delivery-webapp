<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "

SELECT
p.name,
oi.quantity,
p.price

FROM order_items oi

JOIN products p
ON oi.product_id = p.id

WHERE oi.order_id='$order_id'

";

$result = $conn->query($sql);

$items = [];

while($row = $result->fetch_assoc()){

$items[] = $row;

}

echo json_encode($items);

?>
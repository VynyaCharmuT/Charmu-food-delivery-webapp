<?php

include '../includes/db.php';

$id = $_GET['id'];

$order = $conn->query(

"SELECT tracking_status, estimated_delivery
 FROM orders
 WHERE id=$id"

);

$row = $order->fetch_assoc();

echo json_encode($row);

?>
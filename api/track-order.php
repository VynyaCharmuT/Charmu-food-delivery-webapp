<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "SELECT * FROM orders

WHERE id='$order_id'";

$result = $conn->query($sql);

$order = $result->fetch_assoc();

echo json_encode($order);

?>
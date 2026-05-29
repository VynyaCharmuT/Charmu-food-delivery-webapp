<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include '../includes/db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = $id";

$result = $conn->query($sql);

$product = $result->fetch_assoc();

echo json_encode($product);

?>
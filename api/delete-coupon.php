<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");

include '../includes/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM coupons WHERE id='$id'";

$result = $conn->query($sql);

echo json_encode([
    "success" => $result
]);
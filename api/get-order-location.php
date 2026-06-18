<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "
SELECT
latitude,
longitude
FROM orders
WHERE id='$order_id'
";

$result = $conn->query($sql);

echo json_encode(
    $result->fetch_assoc()
);

?>
<?php

header("Content-Type: application/json");

include '../includes/db.php';

$total =
$conn->query(
"SELECT COUNT(*) as total FROM orders"
)
->fetch_assoc()['total'];

$assigned =
$conn->query(
"SELECT COUNT(*) as total
FROM orders
WHERE tracking_status='Assigned To Delivery Agent'"
)
->fetch_assoc()['total'];

$ontheway =
$conn->query(
"SELECT COUNT(*) as total
FROM orders
WHERE tracking_status='On The Way'"
)
->fetch_assoc()['total'];

$delivered =
$conn->query(
"SELECT COUNT(*) as total
FROM orders
WHERE tracking_status='Delivered'"
)
->fetch_assoc()['total'];

echo json_encode([
'total'=>$total,
'assigned'=>$assigned,
'ontheway'=>$ontheway,
'delivered'=>$delivered
]);
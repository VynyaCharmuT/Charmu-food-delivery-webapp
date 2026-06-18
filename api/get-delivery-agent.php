<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET");
header("Content-Type: application/json");


include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "

SELECT
u.name,
u.phone,
u.vehicle_number

FROM orders o

JOIN users u
ON o.delivery_agent_id = u.id

WHERE o.id='$order_id'

";

$result = $conn->query($sql);

echo json_encode(
$result->fetch_assoc()
);
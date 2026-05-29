<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$delivery_agent_id = $_GET['delivery_agent_id'];

$sql = "
SELECT *
FROM orders
WHERE delivery_agent_id='$delivery_agent_id'
ORDER BY id DESC
";

$result = $conn->query($sql);

$orders = [];

while($row = $result->fetch_assoc()){

    $orders[] = $row;

}

echo json_encode($orders);

?>
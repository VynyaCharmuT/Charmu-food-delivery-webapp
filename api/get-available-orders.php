<?php

header("Access-Control-Allow-Origin: *");

include '../includes/db.php';

$sql = "

SELECT *

FROM orders

WHERE delivery_agent_id IS NULL

ORDER BY id DESC

";

$result = $conn->query($sql);

$orders = [];

while($row = $result->fetch_assoc()){

    $orders[] = $row;

}

echo json_encode($orders);
<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$sql = "

SELECT
DATE(created_at) as day,
SUM(total_amount) as revenue

FROM orders

GROUP BY DATE(created_at)

ORDER BY DATE(created_at)

";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){

    $data[] = $row;

}

echo json_encode($data);

?>
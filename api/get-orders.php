<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include '../includes/db.php';

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM orders

WHERE user_id='$user_id'

ORDER BY id DESC";

$result = $conn->query($sql);

$orders = [];

while($row = $result->fetch_assoc()){

    $orders[] = $row;

}

echo json_encode($orders);

?>
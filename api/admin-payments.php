<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$sql = "SELECT * FROM orders";

$result = $conn->query($sql);

$payments = [];

while($row = $result->fetch_assoc()){

    $payments[] = $row;

}

echo json_encode($payments);
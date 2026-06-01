<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$sql = "SELECT * FROM coupons";

$result = $conn->query($sql);

$coupons = [];

while($row = $result->fetch_assoc()){

    $coupons[] = $row;

}

echo json_encode($coupons);
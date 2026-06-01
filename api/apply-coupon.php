<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$code = $_GET['code'];

$sql = "SELECT * FROM coupons
        WHERE code='$code'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    echo json_encode(
        $result->fetch_assoc()
    );

}
else{

    echo json_encode([
        "error" => "Invalid Coupon"
    ]);

}
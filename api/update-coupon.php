<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

include '../includes/db.php';

$data = json_decode(
file_get_contents("php://input")
);

$id = $data->id;
$code = $data->code;
$discount = $data->discount_percentage;
$minimum = $data->minimum_order;
$expiry = $data->expiry_date;
$description = $data->description;

$sql = "

UPDATE coupons

SET

code='$code',
discount_percentage='$discount',
minimum_order='$minimum',
expiry_date='$expiry',
description='$description'

WHERE id='$id'

";

echo json_encode([
"success"=>$conn->query($sql)
]);
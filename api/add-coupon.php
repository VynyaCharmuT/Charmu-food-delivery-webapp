<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$code = $data->code;
$discount = $data->discount_percentage;
$minimum = $data->minimum_order;
$expiry = $data->expiry_date;
$description = $data->description;

$sql = "INSERT INTO coupons(

code,
discount_percentage,
minimum_order,
expiry_date,
description

)

VALUES(

'$code',
'$discount',
'$minimum',
'$expiry',
'$description'

)";

echo json_encode([
"success"=>$conn->query($sql)
]);
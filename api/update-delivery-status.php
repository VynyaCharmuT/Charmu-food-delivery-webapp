<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$order_id = $data->order_id;
$status = $data->status;

$sql = "UPDATE orders
        SET tracking_status='$status'
        WHERE id='$order_id'";

if($conn->query($sql)){

    echo json_encode([
        "success" => true
    ]);

}
else{

    echo json_encode([
        "success" => false
    ]);

}
?>
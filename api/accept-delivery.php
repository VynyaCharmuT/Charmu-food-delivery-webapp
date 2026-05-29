<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$order_id = $data->order_id;
$delivery_agent_id = $data->delivery_agent_id;

$sql = "UPDATE orders

SET delivery_agent_id='$delivery_agent_id',
tracking_status='Assigned To Delivery Agent'

WHERE id='$order_id'";

if($conn->query($sql)){

    echo json_encode([
        "success" => true
    ]);

}
else{

    echo json_encode([
        "success" => false,
        "message" => $conn->error
    ]);

}
?>
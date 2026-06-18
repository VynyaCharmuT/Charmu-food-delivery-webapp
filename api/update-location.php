<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));
echo json_encode([
    "success" => true
]);


$order_id = $data->order_id;
$delivery_agent_id = $data->delivery_agent_id;
$latitude = $data->latitude;
$longitude = $data->longitude;

$check = $conn->query("
SELECT id
FROM delivery_locations
WHERE order_id='$order_id'
");

if($check->num_rows > 0){

    $conn->query("
    UPDATE delivery_locations
    SET
    latitude='$latitude',
    longitude='$longitude',
    delivery_agent_id='$delivery_agent_id'
    WHERE order_id='$order_id'
    ");

}
else{

    $conn->query("
    INSERT INTO delivery_locations
    (
    order_id,
    delivery_agent_id,
    latitude,
    longitude
    )
    VALUES
    (
    '$order_id',
    '$delivery_agent_id',
    '$latitude',
    '$longitude'
    )
    ");

}

echo json_encode([
    "success" => true
]);

?>
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(
    file_get_contents("php://input"),
    true
);

$order_id = $data['order_id'];
$user_id = $data['user_id'];
$product_id = $data['product_id'] ?? 0;
$rating = $data['rating'];
$review = $data['review'];

$sql = "

INSERT INTO reviews
(
order_id,
user_id,
product_id,
rating,
review
)

VALUES
(
'$order_id',
'$user_id',
'$product_id',
'$rating',
'$review'
)

";

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
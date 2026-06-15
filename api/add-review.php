<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$order_id = $data['order_id'];
$user_id = $data['user_id'];
$rating = $data['rating'];
$review = $data['review'];

if($rating < 1 || $rating > 5){
    echo json_encode([
        "success" => false,
        "message" => "Invalid rating"
    ]);
    exit();
}

$sql = "INSERT INTO reviews(order_id,user_id,rating,review)
        VALUES(?,?,?,?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "iiis",
    $order_id,
    $user_id,
    $rating,
    $review
);

if($stmt->execute()){
    echo json_encode([
        "success" => true,
        "message" => "Review added successfully"
    ]);
}
else{
    echo json_encode([
        "success" => false,
        "message" => "Failed"
    ]);
}
?>
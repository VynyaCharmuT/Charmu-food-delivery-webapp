<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$product_id = $_GET['product_id'];

$sql = "

SELECT
reviews.*,
users.name

FROM reviews

JOIN users
ON users.id = reviews.user_id

WHERE product_id='$product_id'

ORDER BY reviews.id DESC

";

$result = $conn->query($sql);

$reviews = [];

while($row = $result->fetch_assoc()){

    $reviews[] = $row;

}

echo json_encode($reviews);

?>
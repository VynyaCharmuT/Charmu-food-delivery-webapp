<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$order_id = $_GET['order_id'];

$sql = "
SELECT *
FROM delivery_locations
WHERE order_id='$order_id'
LIMIT 1
";

$result = $conn->query($sql);

if($result->num_rows > 0){

    echo json_encode(
        $result->fetch_assoc()
    );

}
else{

    echo json_encode(null);

}

?>
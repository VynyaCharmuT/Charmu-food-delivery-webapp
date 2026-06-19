<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$user_id = $_GET['user_id'];

$sql = "

SELECT *
FROM notifications
WHERE user_id='$user_id'
ORDER BY created_at DESC

";

$result = $conn->query($sql);

$notifications = [];

while($row = $result->fetch_assoc()){

    $notifications[] = $row;

}

echo json_encode($notifications);

?>
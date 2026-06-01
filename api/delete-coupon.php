<?php

include '../includes/db.php';

$id = $_GET['id'];

$conn->query(
"DELETE FROM coupons WHERE id='$id'"
);

echo json_encode([
"success"=>true
]);
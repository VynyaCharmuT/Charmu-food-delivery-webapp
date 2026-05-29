<?php

header("Access-Control-Allow-Origin: *");

header("Content-Type: application/json");

include '../includes/db.php';

/* FETCH PRODUCTS */

$sql = "SELECT * FROM products";

$result = $conn->query($sql);

$products = [];

/* STORE PRODUCTS */

while($row = $result->fetch_assoc()){

    $products[] = $row;

}

/* RETURN JSON */

echo json_encode($products);

?>
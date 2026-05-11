<?php

include '../includes/db.php';

$id = $_GET['id'];

$conn->query(
    "UPDATE cart
     SET quantity = quantity + 1
     WHERE id = $id"
);

header("Location: cart.php");

?>
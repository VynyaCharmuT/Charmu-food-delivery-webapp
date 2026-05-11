<?php

include '../includes/db.php';

$id = $_GET['id'];

$conn->query(
    "UPDATE cart
     SET quantity = quantity - 1
     WHERE id = $id AND quantity > 1"
);

header("Location: cart.php");

?>
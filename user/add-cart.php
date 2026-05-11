<?php

session_start();

include '../includes/db.php';

if(!isset($_SESSION['user_id'])) {

    header("Location: ../login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];

$sql = "INSERT INTO cart(user_id, product_id, quantity)
VALUES('$user_id', '$product_id', 1)";

$conn->query($sql);

header("Location: cart.php");

?>
<?php

session_start();

include '../includes/db.php';

$order_id = $_GET['id'];

$delivery_id = $_SESSION['user_id'];

$conn->query(
    "UPDATE orders

     SET delivery_agent_id='$delivery_id'

     WHERE id='$order_id'"
);

header("Location: dashboard.php");

?>
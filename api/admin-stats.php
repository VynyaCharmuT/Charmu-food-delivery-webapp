<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include '../includes/db.php';

$totalProducts = $conn->query(
    "SELECT COUNT(*) AS total FROM products"
)->fetch_assoc()['total'];

$totalOrders = $conn->query(
    "SELECT COUNT(*) AS total FROM orders"
)->fetch_assoc()['total'];

$totalUsers = $conn->query(
    "SELECT COUNT(*) AS total FROM users
     WHERE role='user'"
)->fetch_assoc()['total'];

$totalRevenue = $conn->query(
    "SELECT SUM(total_amount) AS total
     FROM orders"
)->fetch_assoc()['total'];

echo json_encode([

    "products" => $totalProducts,

    "orders" => $totalOrders,

    "users" => $totalUsers,

    "revenue" => $totalRevenue ?? 0

]);
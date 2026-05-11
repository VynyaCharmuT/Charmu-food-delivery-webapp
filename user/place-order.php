<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$payment_method = $_POST['payment_method'];

$coupon = $_POST['coupon'];

$cart = $conn->query(
    "SELECT cart.product_id,
            cart.quantity,
            products.price

     FROM cart

     JOIN products
     ON cart.product_id = products.id

     WHERE cart.user_id = $user_id"
);

$total = 0;

$items = [];

while($row = $cart->fetch_assoc()) {

    $item_total = $row['price'] * $row['quantity'];

    $total += $item_total;

    $items[] = $row;
}

if($coupon != '') {

    $coupon_sql = $conn->query(
        "SELECT * FROM coupons
         WHERE code='$coupon'"
    );

    if($coupon_sql->num_rows > 0) {

        $coupon_data = $coupon_sql->fetch_assoc();

        $discount = $coupon_data['discount_percentage'];

        $total = $total - ($total * $discount / 100);
    }
}

$conn->query(
    "INSERT INTO orders(
        user_id,
        total_amount,
        payment_method,
        payment_status,
        order_status
    )

    VALUES(
        '$user_id',
        '$total',
        '$payment_method',
        'Pending',
        'Order Placed'
    )"
);

$order_id = $conn->insert_id;

foreach($items as $item) {

    $product_id = $item['product_id'];

    $quantity = $item['quantity'];

    $conn->query(
        "INSERT INTO order_items(
            order_id,
            product_id,
            quantity
        )

        VALUES(
            '$order_id',
            '$product_id',
            '$quantity'
        )"
    );
}

$conn->query(
    "DELETE FROM cart
     WHERE user_id = $user_id"
);

header("Location: order-success.php?id=$order_id");

?>
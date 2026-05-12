<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$payment_method = $_POST['payment_method'];

$coupon = $_POST['coupon'];

$cutlery_persons =
$_POST['cutlery_persons'] ?? 0;

$sauce_type =
$_POST['sauce_type'] ?? '';

$sauce_quantity =
$_POST['sauce_quantity'] ?? 0;

$beverage_type =
$_POST['beverage_type'] ?? '';

$beverage_quantity =
$_POST['beverage_quantity'] ?? 0;

$addon_charges = 0;

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

if($cutlery_persons > 2){

    $addon_charges +=
    ($cutlery_persons - 2) * 10;

}

if($sauce_quantity > 1){

    $addon_charges +=
    ($sauce_quantity - 1) * 20;

}

if($beverage_type == 'Coke'
|| $beverage_type == 'Pepsi'){

    $addon_charges +=
    40 * $beverage_quantity;

}

else if($beverage_type == 'Fresh Juice'){

    $addon_charges +=
    90 * $beverage_quantity;

}

else if($beverage_type == 'Cold Coffee'){

    $addon_charges +=
    120 * $beverage_quantity;

}

$total += $addon_charges;

$discount_amount = 0;

if($coupon != '') {

    $coupon_sql = $conn->query(
        "SELECT * FROM coupons
         WHERE code='$coupon'"
    );

    if($coupon_sql->num_rows > 0) {

        $coupon_data = $coupon_sql->fetch_assoc();

        $minimum_order =
            $coupon_data['minimum_order'];

        if($total >= $minimum_order) {

            $discount =
                $coupon_data['discount_percentage'];

            $discount_amount =
                ($total * $discount / 100);

            $total =
                $total - $discount_amount;

        }

        else {

            $_SESSION['coupon_error'] =
                "Minimum order amount for this coupon is ₹$minimum_order";

            header("Location: checkout.php");

            exit();

        }

    }

    else {

        $_SESSION['coupon_error'] =
            "Invalid Coupon Code";

        header("Location: checkout.php");

        exit();

    }

}

$conn->query(
    "INSERT INTO orders(
        user_id,
        total_amount,
        payment_method,
        payment_status,
        order_status,
        cutlery_persons,
        sauce_type,
        sauce_quantity,
        beverage_type,
        beverage_quantity,
        addon_charges
    )

    VALUES(
        '$user_id',
        '$total',
        '$payment_method',
        'Pending',
        'Order Placed',
        '$cutlery_persons',
        '$sauce_type',
        '$sauce_quantity',
        '$beverage_type',
        '$beverage_quantity',
        '$addon_charges'
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
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$user_id = $data->user_id;
$total_amount = $data->total_amount;
$payment_method = $data->payment_method;
$address = $data->address;
$phone = $data->phone;
$cart = $data->cart;

/* INSERT ORDER */

$sql = "INSERT INTO orders(

user_id,
total_amount,
payment_method,
payment_status,
order_status,
tracking_status,
address,
phone

)

VALUES(

'$user_id',
'$total_amount',
'$payment_method',
'Pending',
'Order Placed',
'Order Placed',
'$address',
'$phone'

)";

if($conn->query($sql)){

    $order_id = $conn->insert_id;

    /* INSERT ORDER ITEMS */

    if($cart && count($cart) > 0){

        foreach($cart as $item){

            $product_id = $item->id;
            $quantity = $item->quantity;
            $price = $item->price;

            $itemSql = "INSERT INTO order_items(

            order_id,
            product_id,
            quantity,
            price

            )

            VALUES(

            '$order_id',
            '$product_id',
            '$quantity',
            '$price'

            )";

            $conn->query($itemSql);

        }

    }

    die(json_encode([
    "success" => true,
    "message" => "Order Placed Successfully"
]));

}

else{

  die(json_encode([
    "success" => false,
    "message" => $conn->error
]));
}

exit;

?>
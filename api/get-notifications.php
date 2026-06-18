if($conn->query($sql)){

$getUser = $conn->query("
SELECT user_id
FROM orders
WHERE id='$order_id'
");

$user = $getUser->fetch_assoc();

$user_id = $user['user_id'];

$message = "";

if($status == "Picked Up"){

$message =
"📦 Your order has been picked up by the delivery partner.";

}
else if($status == "On The Way"){

$message =
"🚚 Your order is on the way.";

}
else if($status == "Delivered"){

$message =
"✅ Your order has been delivered successfully.";

}

if($message != ""){

$conn->query("
INSERT INTO notifications(
user_id,
message
)
VALUES(
'$user_id',
'$message'
)
");

}

echo json_encode([
"success"=>true
]);

}
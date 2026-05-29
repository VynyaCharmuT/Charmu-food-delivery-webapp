<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include '../includes/db.php';

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$stock = $_POST['stock'];

$image = $_FILES['image']['name'];

$tmp_name = $_FILES['image']['tmp_name'];

move_uploaded_file(

    $tmp_name,

    "../uploads/".$image

);

$sql = "INSERT INTO products(

name,
category,
price,
stock,
image

)

VALUES(

'$name',
'$category',
'$price',
'$stock',
'$image'

)";

if($conn->query($sql)){

    echo json_encode([

        "success" => true,
        "message" => "Product Added"

    ]);

}

else{

    echo json_encode([

        "success" => false,
        "message" => $conn->error

    ]);

}

?>
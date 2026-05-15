<?php

session_start();

include '../includes/db.php';

if(!isset($_SESSION['user_id'])){

    header("Location: ../login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

$product_id = $_GET['id'];

/* CHECK IF PRODUCT ALREADY EXISTS */

$check = $conn->query(

    "SELECT *
     FROM cart
     WHERE user_id='$user_id'
     AND product_id='$product_id'"

);

if($check->num_rows > 0){

    /* UPDATE QUANTITY */

    $conn->query(

        "UPDATE cart
         SET quantity = quantity + 1
         WHERE user_id='$user_id'
         AND product_id='$product_id'"

    );

}

else{

    /* INSERT NEW PRODUCT */

    $conn->query(

        "INSERT INTO cart(
            user_id,
            product_id,
            quantity
        )

        VALUES(
            '$user_id',
            '$product_id',
            1
        )"

    );

}

/* NO PAGE REDIRECT */

echo "success";

?>
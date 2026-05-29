<?php

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type");

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$name = $data->name;

$email = $data->email;

$password = password_hash(

    $data->password,

    PASSWORD_DEFAULT

);

$role = $data->role;

$sql = "INSERT INTO users(name, email, password, role)

VALUES('$name', '$email', '$password', '$role')";

if($conn->query($sql)){

    echo json_encode([
        "message" => "User Registered"
    ]);

}

else{

    echo json_encode([
        "message" => "Registration Failed"
    ]);

}

?>
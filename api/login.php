<?php

session_start();

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type");

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

if(!$data){
    echo json_encode([
        "success" => false,
        "message" => "No Data Received"
    ]);
    exit;
}

$email = $data->email ?? '';
$password = $data->password ?? '';
$role = $data->role ?? '';

$sql = "SELECT * FROM users
        WHERE email='$email'
        AND role='$role'";

$result = $conn->query($sql);

if($result->num_rows > 0){

    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];

        $_SESSION['role'] = $user['role'];

        $_SESSION['name'] = $user['name'];

        echo json_encode([

            "success" => true,

            "user" => [

                "id" => $user['id'],

                "name" => $user['name'],

                "email" => $user['email'],

                "role" => $user['role']

            ]

        ]);

    }

    else{

        echo json_encode([

            "success" => false,

            "message" => "Invalid Password"

        ]);

    }

}

else{

    echo json_encode([

        "success" => false,

        "message" => "User Not Found"

    ]);

}

?>
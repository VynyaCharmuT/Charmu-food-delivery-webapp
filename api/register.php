<?php

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Headers: Content-Type");

header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

header("Content-Type: application/json");

include '../includes/db.php';

$data = json_decode(file_get_contents("php://input"));

$data = json_decode(file_get_contents("php://input"));

if(!$data){

    echo json_encode([
        "success"=>false,
        "message"=>"No Data Received"
    ]);

    exit;
}

$name = $data->name;

$email = $data->email;

$password = password_hash(

    $data->password,

    PASSWORD_DEFAULT

);

$role = $data->role;

$sql = "INSERT INTO users(name, email, password, role)

VALUES('$name', '$email', '$password', '$role')";

try{

    if($conn->query($sql)){

        echo json_encode([
            "success"=>true,
            "message"=>"Registration Successful"
        ]);

    }

}
catch(mysqli_sql_exception $e){

    if(str_contains($e->getMessage(),"Duplicate")){

        echo json_encode([
            "success"=>false,
            "message"=>"Email already exists."
        ]);

    }
    else{

        echo json_encode([
            "success"=>false,
            "message"=>$e->getMessage()
        ]);

    }

}

?>
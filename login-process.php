<?php

session_start();

include 'includes/db.php';

$email = $_POST['email'];

$password = $_POST['password'];

$sql = $conn->query(

    "SELECT * FROM users
     WHERE email='$email'"
);

if($sql->num_rows > 0){

    $user = $sql->fetch_assoc();

    if($password == $user['password']){

        $_SESSION['user_id'] =
        $user['id'];

        $_SESSION['role'] =
        $user['role'];

        if($user['role'] == 'admin'){

            header(
                "Location: admin/dashboard.php"
            );

        }

        else if($user['role'] == 'delivery'){

            header(
                "Location: delivery/dashboard.php"
            );

        }

        else{

            header(
                "Location: user/home.php"
            );

        }

    }

    else{

        echo "Wrong Password";

    }

}

else{

    echo "User Not Found";

}

?>
<?php

session_start();

include '../includes/db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email'";

$result = $conn->query($sql);

if($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        if($user['role'] == 'admin') {

            header("Location: ../admin/dashboard.php");

        }

        elseif($user['role'] == 'delivery') {

            header("Location: ../delivery/dashboard.php");

        }

        else {

            header("Location: ../user/home.php");

        }

    } else {

        echo "Invalid Password";

    }

} else {

    echo "User Not Found";

}

?>
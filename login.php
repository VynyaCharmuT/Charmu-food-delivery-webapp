<?php

session_start();

include 'includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$email = $_POST['email'];

$password = $_POST['password'];

$sql = $conn->query(
"SELECT * FROM users
WHERE email='$email'
AND password='$password'"
);

if($sql->num_rows > 0){

$user = $sql->fetch_assoc();

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

exit();

}

else{

$error =
"Invalid Email Or Password";

}

}

?>
<!DOCTYPE html>
<html>

<head>

   <title>Login</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="/food-app/assets/css/style.css">


</head>

<body class="auth-body">

<div class="auth-container">

<div class="auth-left">

<div class="auth-content">

<h1>

Welcome Back

</h1>

<p>

Login to continue your premium food experience.

</p>

<div class="auth-features">

<div>

<i class="fa-solid fa-burger"></i>

Fresh Premium Food

</div>

<div>

<i class="fa-solid fa-motorcycle"></i>

Fast Delivery

</div>

<div>

<i class="fa-solid fa-gift"></i>

Exclusive Offers

</div>

</div>

</div>

</div>

<div class="auth-right">

<div class="auth-card">

<h2 class="mb-3">

Login

</h2>

<?php if(isset($error)) { ?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php } ?>

<p class="text-muted mb-4">

Access your FoodieHub account

</p>

<form method="POST">

<input type="email"
name="email"
class="auth-input"
placeholder="Enter Email"
required>

<input type="password"
name="password"
class="auth-input"
placeholder="Enter Password"
required>

<button class="btn btn-main auth-btn">

Login Now

</button>

</form>

<div class="auth-footer">

Don't have an account?

<a href="signup.php">

Create Account

</a>

</div>

</div>

</div>

</div>

</body>
</html>
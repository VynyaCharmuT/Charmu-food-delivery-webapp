<?php

include 'includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$name = $_POST['name'];

$email = $_POST['email'];

$password = $_POST['password'];

$role = $_POST['role'];

$conn->query(

"INSERT INTO users(
name,
email,
password,
role
)

VALUES(
'$name',
'$email',
'$password',
'$role'
)"

);

header(
"Location: login.php"
);

exit();

}

?>
<!DOCTYPE html>
<html>

<head>

    <title>Signup</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="assets/css/style.css">
</head>

<body class="auth-body">

<div class="auth-container">

<div class="auth-left signup-left">

<div class="auth-content">

<h1>

Join FoodieHub

</h1>

<p>

Create your account and enjoy modern food delivery.

</p>

<div class="auth-features">

<div>

<i class="fa-solid fa-pizza-slice"></i>

Trending Combos

</div>

<div>

<i class="fa-solid fa-percent"></i>

Coupon Rewards

</div>

<div>

<i class="fa-solid fa-star"></i>

Premium Experience

</div>

</div>

</div>

</div>

<div class="auth-right">

<div class="auth-card">

<h2 class="mb-3">

Create Account

</h2>

<p class="text-muted mb-4">

Start your FoodieHub journey

</p>

<form method="POST">

<input type="text"
name="name"
class="auth-input"
placeholder="Full Name"
required>

<input type="email"
name="email"
class="auth-input"
placeholder="Email Address"
required>

<input type="password"
name="password"
class="auth-input"
placeholder="Password"
required>
<select name="role"
class="auth-input"
required>

<option value="user">

User

</option>

<option value="delivery">

Delivery Agent

</option>

<option value="admin">

Admin

</option>

</select>

<button class="btn btn-main auth-btn">

Create Account

</button>

</form>

<div class="auth-footer">

Already have an account?

<a href="login.php">

Login

</a>

</div>

</div>

</div>

</div>

</body>
</html>
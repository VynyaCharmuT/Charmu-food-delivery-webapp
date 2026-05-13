<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>FoodieHub</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="assets/css/style.css">

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="#">

FoodieHub

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="navMenu">

<ul class="navbar-nav ms-auto align-items-center">

<li class="nav-item">

<a class="nav-link"
href="#home">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="#categories">

Categories

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="#offers">

Offers

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="login.php">

Login

</a>

</li>

<li class="nav-item">

<a href="signup.php"
class="btn btn-main ms-3">

Get Started

</a>

</li>

</ul>

</div>

</div>

</nav>

<!-- HERO -->

<section class="hero"
id="home">

<div class="container">

<div class="row align-items-center g-5">
<div class="col-lg-6">


<h1>

Delicious Food <br>
Delivered Fast

</h1>

<p>

Fresh meals, tasty desserts, amazing combos, and lightning-fast delivery right at your doorstep.

</p>

<div class="mt-4">

<a href="signup.php"
class="btn btn-main me-3">

Order Now

</a>

<a href="login.php"
class="btn btn-main">

Login

</a>
</div>
</div>
<div class="col-lg-6 d-flex justify-content-center align-items-center">

<div class="food-deck-container">

<div class="food-card active-card">

<img src="assets/images/pizza.jpg">

<div class="food-overlay">

<h3>Margherita Pizza</h3>

<p>
Loaded with mozzarella and Italian herbs.
</p>

<span>₹320</span>

</div>

</div>

<div class="food-card second-card">
    <img src="assets/images/burger.jpg">

<div class="food-overlay">

<h3>Classic Burger Combo</h3>

<p>
Grilled chicken burger with crispy fries.
</p>

<span>₹299</span>

</div>

</div>

<div class="food-card third-card">
<img src="assets/images/biryani.jpg">

<div class="food-overlay">
    <h3>Chicken Biryani</h3>

<p>
Fragrant rice cooked with tender chicken and spices.
</p>

<span>₹220</span>

</div>

</div>

<div class="food-card fourth-card">
    <img src="assets/images/cake.jpg">

<div class="food-overlay">

<h3>Chocolate Cake</h3>

<p>
Rich chocolate layered dessert.
</p>

<span>₹499</span>

</div>

</div>

<div class="food-card fifth-card">
    <img src="assets/images/icecream.jpg">

<div class="food-overlay">

<h3>Hazelnut Choco Chip Ice Cream</h3>

<p>
Fresh hazelnut choco chip ice cream scoops.
</p>

<span>₹120</span>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- CATEGORIES -->

<section class="py-5"
id="categories">

<div class="container">

<h2 class="section-title text-center">

Popular Categories

</h2>

<div class="row g-4">

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-pizza-slice fa-3x mb-3"></i>

<h4>

Pizza

</h4>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-burger fa-3x mb-3"></i>

<h4>

Burgers

</h4>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-ice-cream fa-3x mb-3"></i>

<h4>

Desserts

</h4>

</div>

</div>

<div class="col-md-3">

<div class="category-card">

<i class="fa-solid fa-mug-hot fa-3x mb-3"></i>

<h4>

Beverages

</h4>

</div>

</div>

</div>

</div>

</section>

<!-- FEATURED FOOD -->

<section class="py-5 bg-light">

<div class="container">

<h2 class="section-title text-center">

Trending Foods

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="product-card">

<img src="assets/images/pizza.jpg">

<div class="product-info">

<h4 class="product-title">

Cheese Pizza

</h4>

<p>

Loaded with cheese & fresh toppings

</p>

<div class="d-flex justify-content-between align-items-center">

<span class="price">

₹299

</span>

<a href="signup.php"
class="btn btn-main">

Order

</a>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="product-card">

<img src="assets/images/burger.jpg">

<div class="product-info">

<h4 class="product-title">

Burger Combo

</h4>

<p>

Burger, fries & cold drink combo

</p>

<div class="d-flex justify-content-between align-items-center">

<span class="price">

₹249

</span>

<a href="signup.php"
class="btn btn-main">

Order

</a>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="product-card">

<img src="assets/images/cake.jpg">

<div class="product-info">

<h4 class="product-title">

Chocolate Cake

</h4>

<p>

Rich chocolate layered dessert

</p>

<div class="d-flex justify-content-between align-items-center">

<span class="price">

₹399

</span>

<a href="signup.php"
class="btn btn-main">

Order

</a>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- WHY CHOOSE US -->

<section class="py-5">

<div class="container">

<h2 class="section-title text-center">

Why Choose Us

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="category-card">

<i class="fa-solid fa-truck-fast fa-3x mb-3"></i>

<h4>

Fast Delivery

</h4>

<p>

Quick and safe delivery within minutes.

</p>

</div>

</div>

<div class="col-md-4">

<div class="category-card">

<i class="fa-solid fa-star fa-3x mb-3"></i>

<h4>

Top Quality

</h4>

<p>

Fresh ingredients and premium food quality.

</p>

</div>

</div>

<div class="col-md-4">

<div class="category-card">

<i class="fa-solid fa-tags fa-3x mb-3"></i>

<h4>

Best Offers

</h4>

<p>

Amazing discounts and combo offers daily.

</p>

</div>

</div>

</div>

</div>

</section>

<!-- STATS -->

<section class="py-5 bg-dark text-white">

<div class="container">

<div class="row text-center">

<div class="col-md-3">

<h1>

500+

</h1>

<p>

Daily Orders

</p>

</div>

<div class="col-md-3">

<h1>

100+

</h1>

<p>

Food Items

</p>

</div>

<div class="col-md-3">

<h1>

50+

</h1>

<p>

Delivery Agents

</p>

</div>

<div class="col-md-3">

<h1>

10K+

</h1>

<p>

Happy Customers

</p>

</div>

</div>

</div>

</section>

<!-- TESTIMONIALS -->

<section class="py-5 bg-light">

<div class="container">

<h2 class="section-title text-center mb-5">

What Our Customers Say

</h2>

<div class="row g-4">

<div class="col-md-4">

<div class="testimonial-card">

<div class="mb-3">

⭐⭐⭐⭐⭐

</div>

<p>

Amazing food quality and super fast delivery!

</p>

<div class="d-flex align-items-center mt-4">

<div class="testimonial-avatar">

A

</div>

<div>

<h6 class="mb-0">

Aarav

</h6>

<small class="text-muted">

Regular Customer

</small>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="testimonial-card">

<div class="mb-3">

⭐⭐⭐⭐⭐

</div>

<p>

The checkout experience feels so smooth and modern.

</p>

<div class="d-flex align-items-center mt-4">

<div class="testimonial-avatar">

S

</div>

<div>

<h6 class="mb-0">

Sneha

</h6>

<small class="text-muted">

Food Blogger

</small>

</div>

</div>

</div>

</div>

<div class="col-md-4">

<div class="testimonial-card">

<div class="mb-3">

⭐⭐⭐⭐⭐

</div>

<p>

Best combo offers and beautiful app experience.

</p>

<div class="d-flex align-items-center mt-4">

<div class="testimonial-avatar">

R

</div>

<div>

<h6 class="mb-0">

Rahul

</h6>

<small class="text-muted">

Verified User

</small>

</div>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- FOOTER -->

<footer class="footer">

<div class="container">

<div class="row">

<div class="col-md-4">

<h3>

FoodieHub

</h3>

<p>

Modern Food Delivery & Confectionaries Platform.

</p>

</div>

<div class="col-md-4">

<h5>

Quick Links

</h5>

<ul class="list-unstyled">

<li>

<a href="login.php"
class="text-white text-decoration-none">

Login

</a>

</li>

<li>

<a href="signup.php"
class="text-white text-decoration-none">

Signup

</a>

</li>

</ul>

</div>

<div class="col-md-4">

<h5>

Follow Us

</h5>

<i class="fa-brands fa-instagram fa-2x me-3"></i>

<i class="fa-brands fa-facebook fa-2x me-3"></i>

<i class="fa-brands fa-x-twitter fa-2x"></i>

</div>

</div>

<hr class="mt-4">

<p class="text-center">

© 2026 FoodieHub. All Rights Reserved.

</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const cards = document.querySelectorAll('.food-card');

cards.forEach(card => {

card.addEventListener('click', () => {

const active = document.querySelector('.active-card');
const second = document.querySelector('.second-card');
const third = document.querySelector('.third-card');
const fourth = document.querySelector('.fourth-card');
const fifth = document.querySelector('.fifth-card');

active.className =
'food-card fifth-card';

second.className =
'food-card active-card';

third.className =
'food-card second-card';

fourth.className =
'food-card third-card';

fifth.className =
'food-card fourth-card';

});

});

</script>

</body>

</html>
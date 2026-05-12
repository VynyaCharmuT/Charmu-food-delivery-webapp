<?php

session_start();

include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id,
               products.name,
               products.price,
               cart.quantity

        FROM cart

        JOIN products
        ON cart.product_id = products.id

        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$total = 0;
$coupons = $conn->query(
    "SELECT * FROM coupons"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Checkout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="home.php">

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
href="home.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="cart.php">

Cart

</a>

</li>

<li class="nav-item">

<a class="nav-link active"
href="checkout.php">

Checkout

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="../logout.php">

Logout

</a>

</li>

</ul>

</div>

</div>

</nav>

<div class="container py-5">

<div class="d-flex justify-content-between align-items-center mb-5">

<div>

<h1 class="fw-bold">

Secure Checkout

</h1>

<p class="text-muted">

Complete your order and enjoy delicious food

</p>

</div>

</div>

<div class="row g-4">

<div class="col-md-7">

<div class="card border-0 shadow-lg p-5"
style="border-radius:25px;">

<h2 class="fw-bold mb-4">

Delivery Details

</h2>
<?php if(isset($_SESSION['coupon_error'])) { ?>

<div class="alert alert-danger mt-3">

<?php

echo $_SESSION['coupon_error'];

unset($_SESSION['coupon_error']);

?>

</div>

<?php } ?>

<form action="place-order.php" method="POST">

<input type="text"
       name="address"
       class="form-control form-control-lg mb-3"
       placeholder="Delivery Address"
       required>

<textarea name="instructions"
          class="form-control form-control-lg mb-3"
          placeholder="Special Instructions"></textarea>

<h5>Add-ons</h5>

<div class="card border-0 bg-light p-3 mb-3"
style="border-radius:20px;">

<div class="form-check mb-3">

<input class="form-check-input"
type="checkbox"
id="cutleryCheck"
name="cutlery">

<label class="form-check-label fw-bold"
for="cutleryCheck">

Need Cutlery

</label>

</div>

<div id="cutleryOptions"
style="display:none;">

<label class="mb-2">

Number of Persons

</label>

<input type="number"
name="cutlery_persons"
id="cutleryPersons"
class="form-control form-control-lg mb-3"
min="1"
value="1">

<div class="alert alert-info mb-0">

Free cutlery available within serving size.
Extra cutlery may include additional charges.

</div>

</div>

</div>

<div class="card border-0 bg-light p-3 mb-3"
style="border-radius:20px;">

<div class="form-check mb-3">

<input class="form-check-input"
type="checkbox"
id="sauceCheck"
name="sauces">

<label class="form-check-label fw-bold"
for="sauceCheck">

Extra Sauces

</label>

</div>

<div id="sauceOptions"
style="display:none;">

<label class="mb-2">

Select Sauce Type

</label>

<select name="sauce_type"
class="form-select form-select-lg mb-3">

<option value="Tomato Ketchup">

Tomato Ketchup

</option>

<option value="Garlic Mayo">

Garlic Mayo

</option>

<option value="Cheese Dip">

Cheese Dip

</option>

<option value="Spicy Dip">

Spicy Dip

</option>

</select>

<label class="mb-2">

Sauce Quantity

</label>

<input type="number"
name="sauce_quantity"
id="sauceQuantity"
class="form-control form-control-lg mb-3"
min="1"
value="1">

<div class="alert alert-warning mb-0">

Extra sauce quantities beyond complimentary limits
may include additional charges.

</div>

</div>

</div>

<div class="card border-0 bg-light p-3 mb-4"
style="border-radius:20px;">

<div class="form-check mb-3">

<input class="form-check-input"
type="checkbox"
id="beverageCheck"
name="beverages">

<label class="form-check-label fw-bold"
for="beverageCheck">

Add Beverage

</label>

</div>

<div id="beverageOptions"
style="display:none;">

<label class="mb-2">

Select Beverage

</label>

<select name="beverage_type"
id="beverageType"
class="form-select form-select-lg mb-3">

<option value="Water">

Water (Free)

</option>

<option value="Coke">

Coke (+₹40)

</option>

<option value="Pepsi">

Pepsi (+₹40)

</option>

<option value="Cold Coffee">

Cold Coffee (+₹120)

</option>

<option value="Fresh Juice">

Fresh Juice (+₹90)

</option>

</select>

<label class="mb-2">

Quantity

</label>

<input type="number"
name="beverage_quantity"
id="beverageQuantity"
class="form-control form-control-lg mb-3"
min="1"
value="1">

<div class="alert alert-primary mb-0">

Water is complimentary.
Premium beverages include additional charges.

</div>

</div>

</div>
<div class="card border-0 shadow-sm p-3 mb-4"
style="border-radius:20px;">

<h5 class="fw-bold mb-3">

Available Offers

</h5>

<div class="row g-3">

<?php while($coupon = $coupons->fetch_assoc()) { ?>

<div class="col-md-6">

<div class="border rounded p-3 h-100">

<h6 class="fw-bold text-primary">

<?php echo $coupon['code']; ?>

</h6>

<p class="mb-1">

<?php echo $coupon['description']; ?>

</p>

<small class="text-muted">

Minimum Order:
₹<?php echo $coupon['minimum_order']; ?>

</small>

</div>

</div>

<?php } ?>

</div>

</div>
<input type="text"
       name="coupon"
       class="form-control mb-3"
       placeholder="Coupon Code">

<select name="payment_method"
        class="form-select form-select-lg mb-4">

<option value="COD">
Cash On Delivery
</option>

<option value="UPI">
UPI
</option>

<option value="Card">
Card
</option>

</select>

<button class="btn btn-main w-100 py-3">
Place Order
</button>

</form>

</div>

</div>

<div class="col-md-5">

<div class="card border-0 shadow-lg p-5"
style="border-radius:25px;">

<h2 class="fw-bold mb-4">

Order Summary

</h2>

<?php while($row = $result->fetch_assoc()) {

$item_total = $row['price'] * $row['quantity'];

$total += $item_total;

?>

<div class="d-flex justify-content-between mb-3">

<?php echo $row['name']; ?>

x <?php echo $row['quantity']; ?>

<span class="float-end">

₹<?php echo $item_total; ?>

</span>

</div>

<?php } ?>

<hr>
<div id="addonSummary">

<p class="text-muted">

No add-on charges applied

</p>

</div>
<hr>

<div class="d-flex justify-content-between align-items-center">

<h3 class="fw-bold">

Total

<h3 class="price"
id="grandTotal">

₹<?php echo $total; ?>

</h3>

</div>

</div>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

const cutleryCheck =
document.getElementById('cutleryCheck');

const cutleryOptions =
document.getElementById('cutleryOptions');

cutleryCheck.addEventListener('change', function(){

    if(this.checked){

        cutleryOptions.style.display = 'block';

    }

    else{

        cutleryOptions.style.display = 'none';

    }

});

const sauceCheck =
document.getElementById('sauceCheck');

const sauceOptions =
document.getElementById('sauceOptions');

sauceCheck.addEventListener('change', function(){

    if(this.checked){

        sauceOptions.style.display = 'block';

    }

    else{

        sauceOptions.style.display = 'none';

    }

});
const beverageCheck =
document.getElementById('beverageCheck');

const beverageOptions =
document.getElementById('beverageOptions');

beverageCheck.addEventListener('change', function(){

    if(this.checked){

        beverageOptions.style.display = 'block';

    }

    else{

        beverageOptions.style.display = 'none';

    }

});

</script>
<script>

const baseTotal =
<?php echo $total; ?>;

const grandTotal =
document.getElementById('grandTotal');

const addonSummary =
document.getElementById('addonSummary');

function updateTotal(){

    let total = baseTotal;

    let summary = '';

    // CUTLERY

    if(cutleryCheck.checked){

        let persons =
        parseInt(cutleryPersons.value);

        if(persons > 2){

            let extra =
            persons - 2;

            let cutleryCharge =
            extra * 10;

            total += cutleryCharge;

            summary +=
            `<p>Extra Cutlery:
            +₹${cutleryCharge}</p>`;

        }

    }

    // SAUCES

    if(sauceCheck.checked){

        let qty =
        parseInt(
            document.getElementById('sauceQuantity').value
        );

        if(qty > 1){

            let sauceCharge =
            (qty - 1) * 20;

            total += sauceCharge;

            summary +=
            `<p>Extra Sauces:
            +₹${sauceCharge}</p>`;

        }

    }

    // BEVERAGES

    if(beverageCheck.checked){

        let beverage =
        document.getElementById('beverageType').value;

        let qty =
        parseInt(
            document.getElementById('beverageQuantity').value
        );

        let beveragePrice = 0;

        if(beverage == 'Coke'
        || beverage == 'Pepsi'){

            beveragePrice = 40;

        }

        else if(beverage == 'Fresh Juice'){

            beveragePrice = 90;

        }

        else if(beverage == 'Cold Coffee'){

            beveragePrice = 120;

        }

        let beverageCharge =
        beveragePrice * qty;

        total += beverageCharge;

        if(beverageCharge > 0){

            summary +=
            `<p>${beverage}:
            +₹${beverageCharge}</p>`;

        }

    }

    if(summary == ''){

        summary =
        '<p class="text-muted">No add-on charges applied</p>';

    }

    addonSummary.innerHTML =
    summary;

    grandTotal.innerHTML =
    `₹${total}`;

}

// EVENT LISTENERS

document.querySelectorAll(
'input, select'
).forEach(element => {

    element.addEventListener(
        'change',
        updateTotal
    );

});

updateTotal();

</script>
</body>
</html>
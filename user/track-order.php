<?php

session_start();

include '../includes/db.php';

$id = $_GET['id'];

$order = $conn->query(

    "SELECT *
     FROM orders
     WHERE id = $id"

);

$row = $order->fetch_assoc();

$status = $row['tracking_status'];

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Track Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://unpkg.com/leaflet/dist/leaflet.css"/>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<link rel="stylesheet"
href="../assets/css/style.css">

</head>

<body>

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand"
href="home.php">

FoodieHub

</a>

</div>

</nav>

<div class="container py-5">

<div class="text-center mb-5">

<h1 class="fw-bold">

Track Your Order

</h1>

<p class="text-muted mb-3">

Order #<?php echo $row['id']; ?>

</p>

<h4 class="fw-bold text-warning"
id="liveStatus">

<?php echo $status; ?>

</h4>

<div class="live-status-badge">

<?php echo $status; ?>

</div>

</div>

<div class="card border-0 shadow-lg p-5 tracking-container"
style="border-radius:30px;"
id="trackingContainer">

<div id="deliveryBike"
class="delivery-bike

<?php

if($status == 'Order Placed'){

echo 'bike-placed';

}

elseif($status == 'Preparing'){

echo 'bike-preparing';

}

elseif($status == 'Out For Delivery'){

echo 'bike-out';

}

elseif($status == 'Delivered'){

echo 'bike-delivered';

}

?>
">

<i class="fa-solid fa-motorcycle"></i>

</div>

<div id="stepPlaced"
class="tracking-step">

<div class="tracking-icon">

<i class="fa-solid fa-receipt"></i>

</div>

<h5>
Order Placed
</h5>

</div>

<div id="stepPreparing"
class="tracking-step">

<div class="tracking-icon">

<i class="fa-solid fa-kitchen-set"></i>

</div>

<h5>

Preparing

</h5>

</div>

<div id="stepOut"
class="tracking-step">

<div class="tracking-icon">

<i class="fa-solid fa-motorcycle"></i>

</div>

<h5>

Out For Delivery

</h5>

</div>

<div id="stepDelivered"
class="tracking-step">

<div class="tracking-icon">

<i class="fa-solid fa-circle-check"></i>

</div>

<h5>

Delivered

</h5>

</div>

</div>

<div class="card border-0 shadow-lg p-4 mt-5"
style="border-radius:25px;">

<h3 class="fw-bold mb-4">

Live Delivery Tracking

</h3>

<div id="deliveryMap"
style="height:400px;
border-radius:20px;">

</div>

</div>

<div class="card border-0 shadow-lg p-4 mt-5"
style="border-radius:25px;">

<h3 class="fw-bold mb-4">

Order Summary

</h3>

<p class="mb-4">

<div class="alert alert-warning border-0 shadow-sm mb-4"
style="border-radius:15px;">

<h5 class="fw-bold mb-2">

<i class="fa-solid fa-clock"></i>

Estimated Delivery Time

</h5>

<p class="mb-0 fs-5 fw-semibold"
id="liveETA">

</div>

<span id="liveETA">

<?php echo $row['estimated_delivery']; ?>

</span>

</p>

<p>

<b>Total Amount:</b>

₹<?php echo $row['total_amount']; ?>

</p>

<p>

<b>Payment Method:</b>

<?php echo $row['payment_method']; ?>

</p>

<?php if($row['cutlery_persons'] > 0) { ?>

<p>

<b>Cutlery Requested:</b>

For <?php echo $row['cutlery_persons']; ?> persons

</p>

<?php } ?>

<?php if($row['sauce_quantity'] > 0) { ?>

<p>

<b>Sauces:</b>

<?php echo $row['sauce_type']; ?>

x <?php echo $row['sauce_quantity']; ?>

</p>

<?php } ?>

<?php if($row['beverage_quantity'] > 0) { ?>

<p>

<b>Beverage:</b>

<?php echo $row['beverage_type']; ?>

x <?php echo $row['beverage_quantity']; ?>

</p>

<?php } ?>

<?php if($row['addon_charges'] > 0) { ?>

<p class="text-success fw-bold">

Add-on Charges:
₹<?php echo $row['addon_charges']; ?>

</p>

<?php } ?>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>

const orderId =
<?php echo $row['id']; ?>;

function loadTracking(){

fetch(
`tracking-status.php?id=${orderId}`
)

.then(response => response.json())

.then(data => {

document.getElementById(
"liveStatus"
).innerHTML =
data.tracking_status;

document.getElementById(
"liveETA"
).innerHTML =
data.estimated_delivery;

/* REMOVE ACTIVE */

document.getElementById(
"stepPlaced"
).classList.remove("active");

document.getElementById(
"stepPreparing"
).classList.remove("active");

document.getElementById(
"stepOut"
).classList.remove("active");

document.getElementById(
"stepDelivered"
).classList.remove("active");

const bike =
document.getElementById(
"deliveryBike"
);

/* ORDER PLACED */

if(data.tracking_status ==
"Order Placed"){

document.getElementById(
"stepPlaced"
).classList.add("active");

bike.className =
"delivery-bike bike-placed";

}

/* PREPARING */

else if(data.tracking_status ==
"Preparing"){

document.getElementById(
"stepPlaced"
).classList.add("active");

document.getElementById(
"stepPreparing"
).classList.add("active");

bike.className =
"delivery-bike bike-preparing";

}

/* OUT FOR DELIVERY */

else if(data.tracking_status ==
"Out For Delivery"){

document.getElementById(
"stepPlaced"
).classList.add("active");

document.getElementById(
"stepPreparing"
).classList.add("active");

document.getElementById(
"stepOut"
).classList.add("active");

bike.className =
"delivery-bike bike-out";

}

/* DELIVERED */

else if(data.tracking_status ==
"Delivered"){

document.getElementById(
"stepPlaced"
).classList.add("active");

document.getElementById(
"stepPreparing"
).classList.add("active");

document.getElementById(
"stepOut"
).classList.add("active");

document.getElementById(
"stepDelivered"
).classList.add("active");

bike.className =
"delivery-bike bike-delivered";

}

});

}

loadTracking();

setInterval(loadTracking, 3000);

</script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

<link rel="stylesheet"
href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>
<script>

/* MAP */

const map = L.map('deliveryMap')
.setView([17.3850, 78.4867], 13);

/* MAP LAYER */

L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
maxZoom: 19,
}
).addTo(map);

/* CUSTOMER LOCATION */

const customerMarker =
L.marker([17.3850, 78.4867])

.addTo(map)

.bindPopup(
'Delivery Destination'
)

.openPopup();

/* DELIVERY RIDER */

let riderLat = 17.3750;
let riderLng = 78.4767;

/* BIKE ICON */

const bikeIcon = L.icon({

iconUrl:
'https://cdn-icons-png.flaticon.com/512/2972/2972185.png',

iconSize: [45,45],

iconAnchor: [22,22]

});

/* RIDER MARKER */

const riderMarker =
L.marker(
[riderLat, riderLng],
{
icon: bikeIcon
}
)

.addTo(map)

.bindPopup(
'Delivery Rider'
);

/* ROUTE ENGINE */

const control = L.Routing.control({

waypoints: [

L.latLng(riderLat, riderLng),

L.latLng(17.3850, 78.4867)

],

routeWhileDragging: false,

draggableWaypoints: false,

addWaypoints: false,

show: false

})

.addTo(map);

/* MOVE RIDER */

function moveRider(){

riderLat += 0.001;

riderLng += 0.001;

/* MOVE MARKER */

riderMarker.setLatLng(
[riderLat, riderLng]
);

/* UPDATE ROUTE */

control.setWaypoints([

L.latLng(riderLat, riderLng),

L.latLng(17.3850, 78.4867)

]);

}

/* AUTO MOVE */

setInterval(moveRider, 3000);

/* LIVE ETA */

control.on('routesfound', function(e) {

const routes = e.routes;

const summary = routes[0].summary;

const minutes =
Math.round(summary.totalTime / 60);

document.getElementById(
"liveETA"
).innerHTML =
minutes + " mins";

});

</script>
</body>
</html>
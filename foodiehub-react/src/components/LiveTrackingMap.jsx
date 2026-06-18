import { useEffect, useState } from "react";

import {
MapContainer,
TileLayer,
Marker,
Popup,
Polyline
} from "react-leaflet";

import L from "leaflet";

import "leaflet/dist/leaflet.css";

delete L.Icon.Default.prototype._getIconUrl;

L.Icon.Default.mergeOptions({
iconRetinaUrl:
"https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png",

iconUrl:
"https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png",

shadowUrl:
"https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png"
});

const customerIcon = new L.Icon({
iconUrl:
"https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png",
shadowUrl:
"https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
iconSize:[25,41],
iconAnchor:[12,41]
});

const deliveryIcon = new L.Icon({
iconUrl:
"https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png",
shadowUrl:
"https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png",
iconSize:[25,41],
iconAnchor:[12,41]
});

function LiveTrackingMap({ orderId }) {

const [customerLocation, setCustomerLocation] =
useState(null);

const [deliveryLocation, setDeliveryLocation] =
useState(null);

const [distance,setDistance] =
useState(null);

const loadLocations = async () => {

try {

const customerRes = await fetch(
`http://localhost/food-app/api/get-order-location.php?order_id=${orderId}`
);

const customerData =
await customerRes.json();

if (
customerData?.latitude &&
customerData?.longitude
) {

setCustomerLocation([
parseFloat(customerData.latitude),
parseFloat(customerData.longitude)
]);

}

const deliveryRes = await fetch(
`http://localhost/food-app/api/get-delivery-location.php?order_id=${orderId}`
);

const deliveryData =
await deliveryRes.json();

if (
deliveryData?.latitude &&
deliveryData?.longitude
) {

setDeliveryLocation([
parseFloat(deliveryData.latitude),
parseFloat(deliveryData.longitude)
]);

if(
customerData?.latitude &&
customerData?.longitude
){

const km =
calculateDistance(

parseFloat(customerData.latitude),
parseFloat(customerData.longitude),

parseFloat(deliveryData.latitude),
parseFloat(deliveryData.longitude)

);

setDistance(
km.toFixed(2)
);

}

}

}
catch(error){

console.log(error);

}

};

const calculateDistance = (
lat1,
lon1,
lat2,
lon2
) => {

const R = 6371;

const dLat =
(lat2 - lat1) * Math.PI / 180;

const dLon =
(lon2 - lon1) * Math.PI / 180;

const a =
Math.sin(dLat/2) *
Math.sin(dLat/2)
+
Math.cos(lat1*Math.PI/180)
*
Math.cos(lat2*Math.PI/180)
*
Math.sin(dLon/2)
*
Math.sin(dLon/2);

const c =
2 *
Math.atan2(
Math.sqrt(a),
Math.sqrt(1-a)
);

return R * c;

};

useEffect(() => {

loadLocations();

const interval = setInterval(() => {

loadLocations();

}, 10000);

return () => clearInterval(interval);

}, []);

if(!customerLocation){

return <p>Loading Map...</p>;

}

return(

<div>

{
distance && (

<div
className="card p-3 mb-3 shadow"
>

<h5>
📍 Distance:
{distance} km
</h5>

<h5>
⏱ ETA:
{
Math.ceil(distance * 4)
}
 mins
</h5>

</div>

)
}

<MapContainer

center={customerLocation}

zoom={15}

style={{
height:"500px",
width:"100%"
}}

>

...

</MapContainer>

</div>

);

}

export default LiveTrackingMap;
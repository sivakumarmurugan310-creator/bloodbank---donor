<?php
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body {
    font-family: 'Segoe UI';
    background: url('assets/background.jpg') no-repeat center center fixed;
    background-size: cover;
    color: #fff;
}
.container { margin: 20px auto; padding: 20px; background: rgba(0,0,0,0.7); border-radius: 15px; max-width: 1200px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #fff; padding: 10px; text-align: center; }
th { background: #ff4b5c; }
button { padding: 5px 10px; border: none; border-radius: 8px; cursor: pointer; color: #fff; }
button.send { background: #1f8fff; }
button.remove { background: #ff4b5c; }
button.send:hover { background: #0b6ed1; }
button.remove:hover { background: #ff1f3a; }
#map { width: 100%; height: 400px; margin-top: 20px; border-radius: 15px; }
h2 { text-align: center; margin-bottom: 20px; }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR-API-KEY"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">
<h2>Admin Dashboard</h2>

<h3>Donors</h3>
<table>
<tr><th>Name</th><th>Phone</th><th>Alt Phone</th><th>Email</th><th>Blood Group</th><th>Actions</th></tr>
<?php
$res=$conn->query("SELECT * FROM donors ORDER BY id DESC");
while($row=$res->fetch_assoc()){
    echo "<tr>
    <td>{$row['name']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['alt_phone']}</td>
    <td>{$row['email']}</td>
    <td>{$row['blood_group']}</td>
    <td>
        <a href='remove_donor.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to remove this donor?');\">
            <button class='remove'>Remove</button>
        </a>
    </td>
    </tr>";
}
?>
</table>

<h3>Blood Requests</h3>
<table>
<tr><th>Blood Group</th><th>Phone</th><th>Priority</th><th>Notify</th><th>Remove</th></tr>
<?php
$res=$conn->query("SELECT * FROM requests ORDER BY id DESC");
while($row=$res->fetch_assoc()){
    echo "<tr>
    <td>{$row['blood_group']}</td>
    <td>{$row['phone']}</td>
    <td>{$row['priority']}</td>
    <td><a href='send_sms.php?phone={$row['phone']}&blood={$row['blood_group']}'><button class='send'>Send SMS</button></a></td>
    <td><a href='remove_request.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to remove this request?');\"><button class='remove'>Remove</button></a></td>
    </tr>";
}
?>
</table>

<h3>Live Donor Map</h3>
<div id="map"></div>

<script>
var map;
var markers = [];
var infoWindow = new google.maps.InfoWindow();

function initMap() {
    var center = {lat: 11.0168, lng: 76.9558}; // default center
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: center
    });
    fetchDonors(); // initial load
    setInterval(fetchDonors, 5000); // refresh every 5 seconds
}

function fetchDonors() {
    $.getJSON("get_donors.php", function(data){
        // Clear old markers
        for(var i=0;i<markers.length;i++){
            markers[i].setMap(null);
        }
        markers = [];

        // Add new markers
        data.forEach(function(donor){
            var marker = new google.maps.Marker({
                position: {lat: parseFloat(donor.latitude), lng: parseFloat(donor.longitude)},
                map: map,
                title: donor.name + " (" + donor.blood_group + ")"
            });

            marker.addListener('click', function(){
                infoWindow.setContent(marker.getTitle());
                infoWindow.open(map, marker);
            });

            markers.push(marker);
        });
    });
}

initMap();
</script>
</div>
</body>
</html>
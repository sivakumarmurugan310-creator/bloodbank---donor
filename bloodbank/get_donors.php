<?php
include 'db.php';
$res=$conn->query("SELECT name, blood_group as blood, latitude as lat, longitude as lng FROM donors");
$donors=[];
while($row=$res->fetch_assoc()){ $donors[]=$row; }
echo json_encode($donors);
?>
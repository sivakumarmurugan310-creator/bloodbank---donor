<?php include 'db.php'; ?>

<?php
function distance($lat1,$lon1,$lat2,$lon2){
    return 6371 * acos(
        cos(deg2rad($lat1))*cos(deg2rad($lat2)) *
        cos(deg2rad($lon2)-deg2rad($lon1)) + sin(deg2rad($lat1))*sin(deg2rad($lat2))
    );
}

function getCompatible($blood){
    $map = [
        "A+"=>["A+","A-","O+","O-"], 
        "A-"=>["A-","O-"], 
        "B+"=>["B+","B-","O+","O-"], 
        "B-"=>["B-","O-"], 
        "AB+"=>["ALL"], 
        "AB-"=>["A-","B-","AB-","O-"], 
        "O+"=>["O+","O-"], 
        "O-"=>["O-"]
    ];
    $blood = strtoupper(trim($blood));
    return $map[$blood] ?? ["ALL"];
}

if(isset($_POST['submit'])){
    $blood = strtoupper(trim($_POST['blood']));
    $phone = $_POST['phone'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];

    $rare = ["AB-","B-","O-"];
    $priority = in_array($blood,$rare)?"HIGH":"NORMAL";

    $conn->query("INSERT INTO requests(blood_group,phone,priority) VALUES('$blood','$phone','$priority')");

    $groups = getCompatible($blood);
    if($groups[0]=="ALL") $sql="SELECT * FROM donors";
    else $sql="SELECT * FROM donors WHERE blood_group IN ('".implode("','",$groups)."')";

    $res = $conn->query($sql);

    $count=0; $sms_sent="";
    while($row=$res->fetch_assoc()){
        $d = distance($lat,$lng,$row['latitude'],$row['longitude']);
        if($d <= 10){
            if($priority=="HIGH" || $count<5){
                $phone1=$row['phone']; $phone2=$row['alt_phone'];
                file_get_contents("send_sms.php?phone=$phone1&blood=$blood");
                if(!empty($phone2)) file_get_contents("send_sms.php?phone=$phone2&blood=$blood");
                $sms_sent .= $row['name']."<br>";
                $count++;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Request Blood</title>
<style>
body { font-family:'Segoe UI'; background:#f2f2f2; text-align:center; }
.container { margin:50px auto; padding:30px; width:300px; background:rgba(0,0,0,0.7); color:#fff; border-radius:15px; }
input { display:block; margin:10px auto; padding:10px; width:90%; border-radius:8px; border:none; }
button { padding:10px 20px; border:none; border-radius:8px; background:#ff4b5c; color:#fff; cursor:pointer; }
button:hover { background:#ff1f3a; }
</style>
</head>
<body>
<div class="container">
<h2>Request Blood</h2>
<form method="POST">
<input name="blood" placeholder="Blood Group" required>
<input name="phone" placeholder="Your Phone" required>
<input type="hidden" id="lat" name="lat">
<input type="hidden" id="lng" name="lng">
<button name="submit">Request</button>
</form>
<?php if(isset($sms_sent) && !empty($sms_sent)){ echo "<h3>SMS sent to:</h3>".$sms_sent; } ?>
<a href="index.php"><button>Back Home</button></a>
</div>
<script>
navigator.geolocation.getCurrentPosition(function(pos){
    document.getElementById("lat").value = pos.coords.latitude;
    document.getElementById("lng").value = pos.coords.longitude;
});
</script>
</body>
</html>
<?php include 'db.php'; ?>
<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $alt_phone = $_POST['alt_phone'];
    $email = $_POST['email'];
    $blood = strtoupper(trim($_POST['blood']));
    $pass = $_POST['password'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $conn->query("INSERT INTO donors(name,phone,alt_phone,email,blood_group,password,latitude,longitude)
    VALUES('$name','$phone','$alt_phone','$email','$blood','$pass','$lat','$lng')");
    $success="Registered Successfully! You can now login.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register Donor</title>
<style>
body{ font-family:'Segoe UI'; background:#000c; color:#fff; text-align:center; }
.container{margin:50px auto; padding:30px; width:350px; background:rgba(0,0,0,0.7); border-radius:15px;}
input{display:block;margin:10px auto;padding:10px;width:90%;border-radius:8px;border:none;}
button{padding:10px 20px;border:none;border-radius:8px;background:#ff4b5c;color:#fff;cursor:pointer;}
button:hover{background:#ff1f3a;}
</style>
</head>
<body>
<div class="container">
<h2>Donor Registration</h2>
<?php if(isset($success)) echo "<p style='color:lightgreen;'>$success</p>"; ?>
<form method="POST">
<input name="name" placeholder="Name" required>
<input name="phone" placeholder="Phone" required>
<input name="alt_phone" placeholder="Alternate Phone">
<input name="email" placeholder="Email" required>
<input name="blood" placeholder="Blood Group" required>
<input name="password" type="password" placeholder="Password" required>
<input type="hidden" id="lat" name="lat">
<input type="hidden" id="lng" name="lng">
<button name="submit">Register</button>
</form>
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
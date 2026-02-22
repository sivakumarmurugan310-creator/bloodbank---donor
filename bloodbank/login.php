<?php include 'db.php'; ?>
<?php
if(isset($_POST['login'])){
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    $res = $conn->query("SELECT * FROM donors WHERE phone='$phone' AND password='$pass'");
    if($res->num_rows > 0){
        $_SESSION['donor'] = $phone;
        header("Location: dashboard_donor.php");
    } else { $error="Invalid login!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Donor Login</title>
<style>
body{ font-family:'Segoe UI'; background:#000c; color:#fff; text-align:center; }
.container{margin-top:100px; display:inline-block; padding:30px; background:rgba(0,0,0,0.7); border-radius:15px;}
input{display:block; margin:10px auto; padding:10px; width:200px; border-radius:8px; border:none;}
button{padding:10px 20px; border:none; border-radius:8px; background:#ff4b5c; color:#fff; cursor:pointer;}
button:hover{background:#ff1f3a;}
</style>
</head>
<body>
<div class="container">
<h2>Donor Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
<input type="text" name="phone" placeholder="Phone" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<a href="index.php"><button>Back Home</button></a>
</div>
</body>
</html>
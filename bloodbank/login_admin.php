<?php include 'db.php'; ?>
<?php
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $res=$conn->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if($res->num_rows>0){
        $_SESSION['admin']=$username;
        header("Location: dashboard_admin.php");
    } else { $error="Invalid credentials!"; }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body{ font-family:'Segoe UI'; background:#000c; color:#fff; text-align:center; }
.container{margin-top:120px; display:inline-block; padding:30px; background:rgba(0,0,0,0.7); border-radius:15px;}
input{display:block;margin:10px auto;padding:10px;width:200px;border-radius:8px;border:none;}
button{padding:10px 20px;border:none;border-radius:8px;background:#ff4b5c;color:#fff;cursor:pointer;}
button:hover{background:#ff1f3a;}
</style>
</head>
<body>
<div class="container">
<h2>Admin Login</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>
<a href="index.php"><button>Back Home</button></a>
</div>
</body>
</html>
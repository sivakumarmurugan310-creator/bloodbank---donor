<?php
include 'db.php';
if(!isset($_SESSION['donor'])){ header("Location: login_donor.php"); exit; }
$donor_phone = $_SESSION['donor'];
$donor_res = $conn->query("SELECT * FROM donors WHERE phone='$donor_phone'");
$donor = $donor_res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Donor Dashboard</title>
<style>
body{ font-family:'Segoe UI'; background:#000c; color:#fff; text-align:center; }
.container{margin:30px auto; padding:20px; background:rgba(0,0,0,0.7); border-radius:15px; width:400px;}
input{display:block;margin:10px auto;padding:10px;width:90%;border-radius:8px;border:none;}
button{padding:10px 20px;border:none;border-radius:8px;background:#ff4b5c;color:#fff;cursor:pointer;}
button:hover{background:#ff1f3a;}
</style>
</head>
<body>
<div class="container">
<h2>Welcome <?php echo $donor['name']; ?></h2>

<h3>Update Profile</h3>
<form method="POST">
<input name="name" value="<?php echo $donor['name']; ?>" required>
<input name="alt_phone" value="<?php echo $donor['alt_phone']; ?>">
<input name="email" value="<?php echo $donor['email']; ?>" required>
<input name="password" type="password" placeholder="New Password">
<button name="update">Update</button>
</form>

<h3>Request Blood</h3>
<form method="POST">
<input name="blood" placeholder="Blood Group" required>
<button name="request">Request</button>
</form>

<a href="index.php"><button>Logout</button></a>
</div>

<?php
if(isset($_POST['update'])){
    $name=$_POST['name'];
    $alt=$_POST['alt_phone'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $sql="UPDATE donors SET name='$name', alt_phone='$alt', email='$email'";
    if($pass!="") $sql.=", password='$pass'";
    $sql.=" WHERE phone='$donor_phone'";
    $conn->query($sql);
    echo "<script>alert('Profile Updated!'); window.location='dashboard_donor.php';</script>";
}

if(isset($_POST['request'])){
    $blood=strtoupper(trim($_POST['blood']));
    $rare = ["AB-","B-","O-"];
    $priority = in_array($blood,$rare)?"HIGH":"NORMAL";
    $conn->query("INSERT INTO requests(blood_group,phone,priority) VALUES('$blood','$donor_phone','$priority')");
    echo "<script>alert('Blood Request Submitted!');</script>";
    // SMS integration can be added here
}
?>
</body>
</html>
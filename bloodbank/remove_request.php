<?php
include 'db.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("DELETE FROM requests WHERE id='$id'");
}

header("Location: dashboard_admin.php");
exit();
?>
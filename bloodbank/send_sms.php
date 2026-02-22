<?php
if(isset($_GET['phone']) && isset($_GET['blood'])){
    $phone=$_GET['phone'];
    $blood=$_GET['blood'];

    $msg="Blood Request for $blood. Please donate if available.";
    // Replace with your Fast2SMS API Key
    $apiKey="YOUR-KEY";

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.fast2sms.com/dev/bulkV2");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        "route" => "v3",
        "sender_id" => "FSTSMS",
        "message" => $msg,
        "language" => "english",
        "flash" => 0,
        "numbers" => $phone
    ]));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["authorization: $apiKey", "Content-Type: application/json"]);
    $response=curl_exec($ch);
    curl_close($ch);
    echo "<script>alert('SMS sent!'); window.location='dashboard_admin.php';</script>";
}
?>
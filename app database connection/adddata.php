<?php
include 'conn.php';

$message= mysqli_real_escape_string($conn,  $_POST['message']);
$rating=mysqli_real_escape_string($conn, $_POST['rating']);
$img_path='test';
$journey_id=1;
$vehicle_id=3116;
$lng=23.53;
$lat=12.23;

$conn->query("insert into reviews(message, rating, img_path, journey_id, vehicle_id, lat, lng) values('".$message."','".$rating."','".$img_path."','".$journey_id."','".$vehicle_id."','".$lat."','".$lng."')");
?>
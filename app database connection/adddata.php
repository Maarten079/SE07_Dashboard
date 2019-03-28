<?php
include 'conn.php';

$message= mysqli_real_escape_string($conn,  $_POST['message']);
$rating=mysqli_real_escape_string($conn, $_POST['rating']);
$img_path='test';
$vehicle_id=mysqli_real_escape_string($conn, $_POST['vehicle_id']);
$lng=23.53;
$lat=12.23;

$r = mysqli_query($conn, "SELECT journeynumber 
                          FROM `journeys`
                          WHERE vehicle_id = '$vehicle_id'
                          AND journey_date <= '2019-03-11 04:57:47'
                          LIMIT 1");

$journey_id = mysqli_fetch_array($r);

$journey_id = (string)$journey_id;

$conn->query("insert into reviews(message, rating, img_path, journey_id, vehicle_id, lat, lng) values('".$message."','".$rating."','".$img_path."','".$journey_id."','".$vehicle_id."','".$lat."','".$lng."')");
?>

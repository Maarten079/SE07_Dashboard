<?php
include 'conn.php';

$message=mysqli_real_escape_string($conn,  $_POST['message']);
$rating=mysqli_real_escape_string($conn, $_POST['rating']);
$img_path='test';
$vehicle_id=mysqli_real_escape_string($conn, $_POST['vehicle_id']);
$lng=23.53;
$lat=12.23;

$journey_query = mysqli_query($conn, "SELECT id 
                          FROM `journeys`
                          WHERE vehicle_id = '$vehicle_id'
                          AND journey_date <= CURRENT_TIMESTAMP
                          ORDER BY journey_date DESC
                          LIMIT 1");

$journey_id = mysqli_fetch_object($journey_query);

$journey_id = $journey_row['id'];

$conn->query("insert into reviews(message, rating, img_path, journey_id, vehicle_id, lat, lng) values('".$message."','".$rating."','".$img_path."','".$journey_id."','".$vehicle_id."','".$lat."','".$lng."')");
?>

<?php
include '../../Controller/roomcontroller.php';
$roomC = new roomcontroller(); 
$roomC->deleteRoom($_GET["roomNumber"]); 
header('Location: listrooms.php'); 
?>

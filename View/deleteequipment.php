<?php
include '../Control/equipmentmanagement.php'; 
$equipment = new equipmentmanagement();

$equipment->removeEquipment($_GET['eq_id']); 

echo "success";
header('Location: listEquipments.php');
?>
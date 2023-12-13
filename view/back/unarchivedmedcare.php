<?php 
include '../../Controller/MedC.php';
$med = new MedCont();
$med->unarchivemedcare($_GET['care_id']);
echo "success";
header('Location: listmedcare.php');
?>
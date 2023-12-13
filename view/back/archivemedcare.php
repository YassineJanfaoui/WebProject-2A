<?php 
include '../../Controller/MedC.php';
$c = new MedCont();
$c->archiveMedCare($_GET['care_id']);
echo "success";
header('Location: listMedcare.php');
?>


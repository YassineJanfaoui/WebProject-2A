<?php
include '../../Controller/MedC.php';
$MedC = new MedCont();
$MedC->deleteMedCare($_GET["care_id"]);
echo "success";
header('Location:listMedcare.php'); //hedhi maaneha bech trajaani ghadi
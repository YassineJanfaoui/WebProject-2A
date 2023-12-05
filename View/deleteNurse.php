<?php
include '../Controller/NurseC.php';
$NurseC = new NurseCont();
$NurseC->deletenurse($_GET["nurse_id"]);
echo "success";
header('Location:listNurse.php'); //hedhi maaneha bech trajaani ghadi
<?php
include '../../Controller/nursemedC.php';
$NursemedC = new NursemedCont();
$NursemedC->deletenursemed($_GET["care_id"]);
echo "success";
header('Location:listnursemed.php');
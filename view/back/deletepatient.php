<?php
include '../../Controller/patientcontroller.php';
$patientC = new PatientsController();
$patientC->deletePatient($_GET["id"]);
header('Location: listpatient.php');
?>

<?php // Delete a doctor
include '../Controller/DoctorController.php';
$doctorC = new DoctorC();
$doctorC->deleteDoctor($_GET['doctor_id']);
echo "success";
header('Location: listDoctors.php');

// localhost/ESPRIT/Project/View


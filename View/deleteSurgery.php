<?php
include '../Controller/SurgeryController.php';
$surgeryC = new SurgeryC();
$surgeryC->deleteSurgery($_GET['surgery_id']);
echo "success";
header('Location: listSurgeries.php');

// localhost/ESPRIT/Project/View
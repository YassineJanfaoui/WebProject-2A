<?php // Delete a doctor
include '../Control/billmanagement.php';
$bill = new billmanagement();
$bill->removeBill($_GET['patient_id']);
echo "success";
header('Location: listBills.php');
?>
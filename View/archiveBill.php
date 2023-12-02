<?php 
include '../Control/billmanagement.php';
$bill = new billmanagement();
$bill->archiveBill($_GET['bill_id']);
echo "success";
header('Location: listBills.php');
?>
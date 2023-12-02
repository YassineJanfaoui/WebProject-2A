<?php 
include '../Control/billmanagement.php';
$bill = new billmanagement();
$bill->unarchiveBill($_GET['bill_id']);
echo "success";
header('Location: listArchivedBills.php');
?>
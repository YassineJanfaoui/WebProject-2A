<?php 
include '../Control/billmanagement.php';
$bill = new billmanagement();
$bill->removeBill($_GET['bill_id']);
echo "success";
header('Location: listBills.php');
?>
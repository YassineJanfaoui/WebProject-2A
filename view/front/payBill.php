<?php 
include '../../controller/billmanagement.php';
$bill = new billmanagement();
$bill->payBill($_GET['bill_id']);
echo "success";
header('Location: bills.php');
?>
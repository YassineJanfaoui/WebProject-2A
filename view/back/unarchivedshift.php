<?php 
include '../../Controller/ShiftC.php';
$c = new shiftCont();
$c->unarchiveshift($_GET['shift_id']);
echo "success";
header('Location: listshift.php');
?>
<?php 
include '../../Controller/ShiftC.php';
$c = new shiftCont();
$c->archiveshift($_GET['shift_id']);
echo "success";
header('Location: listShift.php');
?>
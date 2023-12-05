<?php
include '../Controller/ShiftC.php';
$ShiftC = new shiftCont();
$ShiftC->deleteShift($_GET["shift_id"]);
echo "success";
header('Location:listShift.php');
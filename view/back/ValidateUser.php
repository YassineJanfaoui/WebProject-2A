<?php
include "../../Controller/userC.php";

$userC = new UserController();
$userC->unbanUser($_GET["id"]);
header("Location: http://localhost/ProjectWeb/View/index.php");
?>
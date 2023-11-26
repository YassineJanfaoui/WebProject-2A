<?php
session_start();
include "../Controller/UserC.php";
$c = new UserController();
echo $_GET["user_id"];
$c->unbanUser($_GET["user_id"]);
header('Location:ListUsers.php');
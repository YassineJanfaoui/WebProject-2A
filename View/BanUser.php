<?php
session_start();
include "../Controller/UserC.php";
$c = new UserController();
echo $_GET["user_id"];
$user = $c->checkUserID($_GET["user_id"]);
$c->banUser($_GET["user_id"]);
mail($user["email_address"], "Account Banned", "Your account has been banned by the admin.\nPlease contact the admin for more information.");
header('Location:ListUsers.php');

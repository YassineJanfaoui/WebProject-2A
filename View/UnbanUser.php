<?php
session_start();
include "../Controller/UserC.php";
$c = new UserController();
echo $_GET["user_id"];
$user = $c->checkUserID($_GET["user_id"]);
$c->unbanUser($_GET["user_id"]);
mail($user["email_address"], "Account Unbanned", "After careful consideration, your account has been unbanned by the admin.\nPlease contact the admin for more information.");
header('Location:ListUsers.php');
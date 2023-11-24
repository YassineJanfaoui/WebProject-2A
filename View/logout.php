<?php
//all necessary functions for a logout page
session_start();
session_destroy();
header("Location: index.php");
exit();
?>

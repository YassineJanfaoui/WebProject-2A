<?php
session_start();
include "../../Controller/FeedbackC.php";
$c = new FeedbackController();
echo $_GET["feedback_id"];
$c->removeFeedback($_GET["feedback_id"]);
header('Location:ListFeedback.php');


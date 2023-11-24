<?php
require "../Controller/FeedbackC.php";
$c = new FeedbackController();
$tab = $c->getAllFeedbacks();
session_start();
?>
<html>

<head>
    <title>list Feedback</title>
    <link rel="stylesheet" href="../styles/stylelistUsers.css" />
    <link rel="stylesheet" href="../styles/navbar.css" />
</head>

<body>
<div class="container">
        <header class="nav-down">
            <p>Admin Dashboard</p>
        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            <a href="ListFeedback.php">List Feedback</a>
            <a href="ListUsers.php">List Users</a>
            <a href="#">Add Doctor</a>
            <a href="#">Add Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
        </div>
    </div>
    <div class="main">
    <h1>Feedbacks</h1>
    <table>
        <tr>
            <th width = 55px>Feedback_Id</th>
            <th width = 55px>User_Id</th>
            <th>Description</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($tab as $feedback) {
        ?>
            <tr>
                <td><?php echo $feedback['feedback_id']; ?></td>
                <td><?php echo $feedback['user_id']; ?></td>
                <td><?php echo $feedback['description']; ?></td>
                <td><a href="RemoveFeedback.php?feedback_id=<?php echo $feedback['feedback_id'];?>">Remove</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../scripts/navbar.js"></script>

</html>
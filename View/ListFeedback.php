<?php
require "../Controller/FeedbackC.php";
session_start();
$c = new FeedbackController();
if (isset($_GET['search_user_id']) && !empty($_GET['search_user_id'])) {
    $tab = $c->getFeedbacksByUserId($_GET['search_user_id']);
} 
else if (isset($_GET['search_date']) && !empty($_GET['search_date'])) {
    $tab = $c->getFeedbacksbyDate($_GET['search_date']);
}
else
{
    $tab = $c->getAllFeedbacks();
}

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
            <p>Admin Dashboard - Welcome <?php echo $_SESSION["username"]?></p>
        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            <a href="ListFeedback.php">List Feedback</a>
            <a href="ListUsers.php">List Users</a>
            <a href="#">Add Doctor</a>
            <a href="#">Add Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
            <a style="color:green;" href="index.php">Go to HomePage</a>
        </div>
    </div>
    <div class="main">
        <h1>Feedbacks</h1>
        <div id="search">
        <form action=""  method="GET">
            <div id="searchBar">
            <label for="search_user_id">Search By User ID:</label>
            <input type="text" id="search_user_id" name="search_user_id">
            <input type="submit" value="Search">
            </div>
        </form>
        <form action=""  method="GET">
            <div id="searchBar">
            <label for="search_date">Search By Date added:</label>
            <input type="date" id="search_date" name="search_date">
            <input type="submit" value="Search">
            </div>
        </form>
        </div>
        <table>
            <tr>
                <th width=55px>Feedback_Id</th>
                <th width=55px>User_Id</th>
                <th>Description</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($tab as $feedback) {
            ?>
                <tr>
                    <td><?php echo $feedback['feedback_id']; ?></td>
                    <td><?php echo $feedback['user_id']; ?></td>
                    <td><?php echo $feedback['description']; ?></td>
                    <td><?php echo $feedback['date_added']; ?></td>
                    <td><a class="action" href="RemoveFeedback.php?feedback_id=<?php echo $feedback['feedback_id']; ?>">Remove</a></td>
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
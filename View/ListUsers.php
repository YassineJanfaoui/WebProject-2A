<?php
require "../Controller/UserC.php";
$c = new UserController();
$tab = $c->listUsers();
session_start();
?>
<html>

<head>
    <title>list Users</title>
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
    <h1>List of users</h1>
    <table>
        <tr>
            <th width = 55px>User_Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Type of user</th>
        </tr>
        <?php
        foreach ($tab as $user) {
        ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['family_name']; ?></td>
                <td><?php echo $user['email_address']; ?></td>
                <td><?php echo $user['contact_number']; ?></td>
                <td><?php echo $user['type']; ?></td>

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
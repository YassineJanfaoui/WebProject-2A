<?php
require "../Controller/UserC.php";
$c = new UserController();
$test = null;
if (isset($_GET["sort"]))
$test = $_GET["sort"];
$tab = $c->listUsers($test);
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
    <h1>List of users</h1>
    <table>
        <tr>
            <th width = 55px>User_Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th><a style=" text-decoration: none; color:#fff;" href=<?php
                        if ($test == "type") {
                            echo "\"ListUsers.php?sort=\"";
                        } else {
                            echo "\"ListUsers.php?sort=type\"";
                        }
                        ?>
            >Role</a></th>
            <th>status</th>
            <th>Ban User</th>
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
                <td><?php echo $user['enabled']; ?></td>
                <?php
                if ($user['enabled'] == 1) {
                    echo "<td><a class='action' href=\"BanUser.php?user_id=" . $user['user_id'] . "\">Ban</a></td>";
                } else {
                    echo "<td><a class='action' href=\"UnbanUser.php?user_id=" . $user['user_id'] . "\">Unban</a></td>";
                }
                ?>

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
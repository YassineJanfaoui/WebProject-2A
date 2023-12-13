<?php
require "../../Controller/UserC.php";
$c = new UserController();
$test = null;
if (isset($_GET["sort"]))
$test = $_GET["sort"];
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$tab = $c->listUsers($test, $currentPage, $itemsPerPage);
$totalUsers = $c->getTotalUsers();
$totalPages = ceil($totalUsers / $itemsPerPage);

session_start();
?>
<html>

<head>
    <title>list Users</title>
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
    <link rel="stylesheet" href="../../styles/navbar.css" />
</head>

<body>
<div class="container">
        <header class="nav-down">
            <p>Admin Dashboard - Welcome <?php echo $_SESSION["username"] ?></p>

        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            <?php if ($_SESSION['type'] == 'admin') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="ListFeedback.php">List Feedback</a>
                <a href="ListUsers.php">List Users</a>
                <a href="listDoctors.php">List Doctors</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="add_medicines.php">Manage medicines</a>
                <a href="medicines_list.php">View medicines</a>
                <div class="nurseSelect-div">
                    <select onchange="location = this.value;" class="nurseSelect">
                        <option value="Nurses" class="nurseSelect-option">Nurses Options</option>
                        <option value="listNurse.php" class="nurseSelect-option">List Nurses</option>
                        <option value="listShift.php" class="nurseSelect-option">List Nurses Shift</option>
                        <option value="listMedcare.php" class="nurseSelect-option">List Medical care</option>
                        <option value="listnursemed.php" class="nurseSelect-option">List Nurses Medical Care</option>
                        <option value="addMedcare.php" class="nurseSelect-option">Add Medical care</option>
                        <option value="addNurse.php" class="nurseSelect-option">Add Nurse</option>
                        <option value="addshift.php" class="nurseSelect-option">Assign Shift to Nurse</option>
                        <option value="addnursemed.php" class="nurseSelect-option">Assign Nurse to Med Care</option>
                    </select>
                </div>
                <a href="listBills.php">List Bills</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } elseif($_SESSION['type'] == 'doctor') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="medicines_list.php">View medicines</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } ?>

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
            <th><a style=" text-decoration: none; color:#fff;" href=<?php
                        if ($test == "enabled") {
                            echo "\"ListUsers.php?sort=\"";
                        } else {
                            echo "\"ListUsers.php?sort=enabled\"";
                        }
                        ?>
            >Enabled</a>
        </th>
            <th>Ban User</th>
        </tr>
        <?php
        foreach ($tab as $user) {
        ?>
            <tr <?php if($user['enabled'] == 0) echo "style='background-color:#ffe6e6;'";else echo "style='background-color:#e6ffe6;'";?> >
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
    <div id="paginationBlock">
            <?php
            $range = 2;
            $sortParams = "";
            if ($test == "type") {
                $sortParams = "&sort=type";
            }
            elseif ($test == "enabled") {
                $sortParams = "&sort=enabled";
            }

            if($totalPages > 1)
            {
            if ($currentPage > 1) {
            ?>
                <a class="pagination" href="ListUsers.php?page=<?php echo $currentPage - 1;echo $sortParams; ?>">Prev</a>
                <?php
            }
            for ($i = $currentPage - $range; $i < $currentPage; $i++) {
                if ($i > 0) {
                ?>
                    <a class="pagination" href="ListUsers.php?page=<?php echo $i;echo $sortParams; ?>"><?php echo $i; ?></a>
                <?php
                }
            }
            for ($i = $currentPage; $i <= $currentPage + $range && $i < $totalPages + 1; $i++) {
                ?>
                <a class="pagination" <?php if ($i == $currentPage) echo "style=text-decoration:underline;color:#8b0000;"; ?> href="ListUsers.php?page=<?php echo $i; echo $sortParams; ?>"><?php echo $i; ?></a>
            <?php
            }
            if ($currentPage < $totalPages) {
            ?>
                <a class="pagination" href="ListUsers.php?page=<?php echo $currentPage + 1;echo $sortParams; ?>">Next</a>
            <?php
            }
        }
            ?>

        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../scripts/navbar.js"></script>

</html>
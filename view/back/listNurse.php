<?php
session_start();
include "../../Controller/NurseC.php";
$c = new NurseCont();

if (isset($_POST['submit']) && !empty($_POST['search'])) {
    $tab = $c->listNursebyid($_POST['search']);
} elseif (isset($_POST['submit']) && !empty($_POST['search2'])) {
    $tab = $c->listNursebydepartment($_POST['search2']);
} else
    $tab = $c->listNurse();

?>

<html>

<head>
    <title>Nurse List</title>
    <link rel="stylesheet" href="../../styles/stylelistNurse.css" />
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
        </br>
        <br>
        <br>
        <h1>List of Nurses</h1>
        <form align="center" action="" method="POST">
            <b><label for="search_nav">Write Nurse ID</label></b>
            <input type="text" name="search" style="width:50%" placeholder="Search...">
            <input type="submit" name="submit" value="Search">
        </form>
        <form align="center" action="" method="POST">
            <b><label for="search_nav">Department</label></b>
            <select id="shift" name="search2">
                <option value="Deparment">-Department-</option>
                <option value="General">General</option>
                <option value="Pediatric">Pediatric</option>
                <option value="Cardiology">Cardiology</option>
                <option value="Orthopedic">Orthopedic</option>
                <option value="Neurology">Neurology</option>
            </select>

            <input type="submit" name="submit" value="Search">
        </form>
        <table>
            <tr>
                <th>Nurse Id </th>
                <th>First Name</th>
                <th>Last Name </th>
                <th>Department </th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($tab as $nurse) {
            ?>
                <tr>
                    <td><?php echo $nurse['nurse_id']; ?></td>
                    <td><?php echo $nurse['first_name']; ?></td>
                    <td><?php echo $nurse['last_name']; ?></td>
                    <td><?php echo $nurse['department']; ?></td>
                    <td><?php echo $nurse['phone_number']; ?></td>
                    <td><?php echo $nurse['email']; ?></td>
                    <td><?php echo $nurse['hire_date']; ?></td>
                    <td align="center">
                        <a href="deleteNurse.php?nurse_id=<?php echo $nurse['nurse_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../scripts/navbar.js"></script>
</body>

</html>
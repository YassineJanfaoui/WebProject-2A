<?php
session_start();
include "../../Controller/nursemedC.php";
$c = new NursemedCont();

if(isset($_POST['submit']) && !empty($_POST['search'])){
    $tab = $c->listNursemedbyid($_POST['search']);
}elseif(isset($_POST['submit']) && !empty($_POST['search2'])){
    $tab = $c->listNursemedcarebyid($_POST['search2']);
}else
$tab = $c->listNursemed();
?>

<html>
<head>
    <title>Nurse - Medical Care List</title>
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
    <h1>Nurses Medical Care</h1>
    <form align="center" action="" method="POST">
        <b><label for="search_nav">Write Nurse ID</label></b>
        <input type="number" name="search" placeholder="Search...">
        <input type="submit" name="submit" value="Search">
    </form> 
    <form align="center" action="" method="POST">
        <b><label for="search_nav">Write Care ID</label></b>
        <input type="number" name="search2" placeholder="Search...">
        <input type="submit" name="submit" value="Search">
    </form> 
    <table>
        <tr>
            <th>Nurse ID </th>
            <th>Nurse Name</th>
            <th>Care ID </th>
            <th>Patient Name </th>
            <th>Update </th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($tab as $nursemed) {
        ?>
            <tr>
                <td><?php echo $nursemed['nurse_id']; ?></td>
                <td><?php echo $nursemed['nurse_name']; ?></td>
                <td><?php echo $nursemed['care_id']; ?></td>
                <td><?php echo $nursemed['patient_name']; ?></td>
                <td align="center">
                <a href="updatenursemed.php?id=<?php echo $nursemed['nurse_id']; ?>">Update</a>
                </td>
                <td align="center">
                <a href="deletenursemed.php?care_id=<?php echo $nursemed['care_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>

</html>
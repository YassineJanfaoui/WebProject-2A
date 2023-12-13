<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipments List</title>
    <link rel="stylesheet" href="../../Assets/CSS Styles/listEquipment.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
</head>
    <?php
    session_start();
    include "../../controller/equipmentmanagement.php"; 
    $equipment = new EquipmentManagement();
    if(isset($_GET['eid'])&& !empty($_GET['eid'])){
        $equipmentList = $equipment->showEquipmentByEqId($_GET['eid']);
    }
    elseif(isset($_GET['min']) && isset($_GET['max']) && !empty($_GET['min']) && !empty($_GET['max'])){
        $equipmentList = $equipment->filterMinMax($_GET['min'],$_GET['max']);
    }
    else
    $equipmentList = $equipment->listEquipments();
    ?>
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
        <h1>List Equipment</h1>
    <form align="center" action="" method="GET">
        <b><label for="eid">Search by Equipment ID</label></b>
        <input type="text" id="eid" name="eid">
        <input type="submit" value="Search">
    </form>
    <form align="center" action="" method="GET">
        <b><label for="min">Filter equipment by price from</label></b>
        <input type="text" id="min" name="min">
        <b><label for="max">to</label></b>
        <input type="text" id="max" name="max">
        <input type="submit" value="Confirm">
    </form>
    <table>
        <thead>
            <tr>
                <th>Equipment Id</th>
                <th>Equipment Name</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>Purchase History</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipmentList as $equipment): ?>
                <tr>
                    <td><?= $equipment['eq_id'] ?></td>
                    <td><?= $equipment['eq_name'] ?></td>
                    <td><?= $equipment['eq_quantity'] ?></td>
                    <td><?= $equipment['eq_purchase_price'] ?></td>
                    <td><?= $equipment['eq_purchase_history'] ?></td>
                    <td><button type="button" onclick="window.location.href='deleteequipment.php?eq_id=<?php echo $equipment['eq_id']; ?>'">Delete</button></td>
                    <td><button type="button" onclick="window.location.href='updateequipment.php?eq_id=<?php echo $equipment['eq_id']; ?>'">Update</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div align="center"><button type="button" onclick="window.location.href='addEquipment.php';">Add an Equipment</button></div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../scripts/navbar.js"></script>
</body>
</html>

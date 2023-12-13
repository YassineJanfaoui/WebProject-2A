<?php
session_start();
require_once '../../controller/medicines_controller.php';
require_once '../../model/medicines_model.php';

$medicineModel = new MedicineModel();
$itemsPerPage = 15;
$totalMedicines = $medicineModel->getTotalMedicinesCount();
$totalPages = ceil($totalMedicines / $itemsPerPage);

// Get the current page number from the query string
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1
$page = min($page, $totalPages); // Ensure page doesn't exceed $totalPages

$medicines = $medicineModel->getMedicinesPaginated($page, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="../../assets/css/styles.css" />
    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
    <style>
        /* Overriding main-content style for this page */
        .main-content {
            justify-content: flex-start;
            padding-top: 50px;
            /* Aligns content to the top */
        }
    </style>
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
        <h1>Medicine List</h1>
        <table class="medicine-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach ($medicines as $medicine) : ?>
            <tr>
                <td><?= htmlspecialchars($medicine['med_id']); ?></td>
                <td><a href=" add_medicines.php?id=<?= htmlspecialchars($medicine['med_id']); ?>"><?= htmlspecialchars($medicine['med_name']); ?></a></td>
            <td><?= htmlspecialchars($medicine['med_quantity']); ?></td>
            <td><?= htmlspecialchars($medicine['purchase_price']); ?></td>
            <td><?= htmlspecialchars($medicine['selling_price']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        <div id="paginator">
            <a class="pagination-link" href="?page=<?php echo max(1, $page - 1); ?>">&lt;</a>
            <span class="current-page">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
            <a class="pagination-link" href="?page=<?php echo min($page + 1, $totalPages); ?>">&gt;</a>
        </div>
    </div>
</body>

</html>
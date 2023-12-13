<?php
session_start();
include "../../controller/patientcontroller.php";
include '../../model/patients.php';
$selectedDietType = 'all';
$selectedOrderOption = 1;
$roomnumber = NULL;
$searchByRoomAndDiet = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedDietType = isset($_POST['dietType']) ? $_POST['dietType'] : '';
    $selectedOrderOption = isset($_POST['orderOption']) ? $_POST['orderOption'] : '';

    if (isset($_POST['searchByRoom'])) {
        $roomnumber = isset($_POST['roomnumber']) ? $_POST['roomnumber'] : NULL;
        $searchByRoomAndDiet = isset($_POST['searchByRoomAndDiet']);
    }
}

$c = new PatientsController();

// Determine the current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Number of records to display per page
$recordsPerPage = 5;

// Calculate the starting record for the current page
$start = ($page - 1) * $recordsPerPage;


$patients = ($selectedDietType === 'all')
    ? $c->orederpatients($selectedOrderOption, $start, $recordsPerPage)
    : $c->filterAndOrderPatients($selectedDietType, $selectedOrderOption, $start, $recordsPerPage);


if (!is_null($roomnumber)) {
    if ($searchByRoomAndDiet) {
        $patients = $c->filterPatientsByRoomAndDiet($roomnumber, $selectedDietType, $start, $recordsPerPage);
    } else {
        $patients = $c->searchByRoom($roomnumber, $start, $recordsPerPage);
    }
}


$totalRecords = ($selectedDietType === 'all')
    ? $c->getTotalRecords()
    : $c->getFilteredTotalRecords($selectedDietType);


$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Patients</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .container2 {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 80%;
            width: 80%;
            position:relative;
            top:10px;
            left:120px;
            box-sizing: border-box;
        }

        h1 {
            color: #2B2D42;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #C0C0C0;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4F988D;
            color: #ffffff;
        }

        td {
            background-color: #ffffff;
            color: #333333;
        }

        .update-btn, .delete-btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 8px;
        }

        .update-btn {
            background-color: #2B2D42;
            color: #ffffff;
        }

        .delete-btn {
            background-color: #C0C0C0;
            color: #333333;
        }

       /* button {
            padding: 8px 16px;
            font-size: 14px;
            background-color: #4F988D;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
*/
        input[type="number"] {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #C0C0C0;
            border-radius: 5px;
            margin-right: 10px;
        }

        label {
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: #4F988D;
        }

        a:hover {
            text-decoration: underline;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            margin-right: 5px;
            padding: 5px 10px;
            background-color: #4F988D;
            color: #ffffff;
            border-radius: 5px;
            text-decoration: none;
        }

        .button {
    display: inline-block;
    padding: 8px 16px;
    font-size: 14px;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

/* Primary button style */
.primary-btn {
    background-color: #4F988D;
    color: #ffffff;
    border: none;
}

/* Secondary button style */
.secondary-btn {
    background-color: #2B2D42;
    color: #ffffff;
    border: none;
}

/* Tertiary button style */
.tertiary-btn {
    background-color: #C0C0C0;
    color: #333333;
    border: none;
}
    </style>
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
    <div class="container2">
        <h1 style="position:relative;top:25px;">List of Patients</h1>
        <a href="addPatient.php" style="text-decoration: none; color: #4F988D;">Add Patient</a>

        <form method="post" action="">
            <label for="dietType">Select Diet Type:</label>
            <select name="dietType" id="dietType" style="position:relative;left:500px;top:-20px;">
                <option value="all" <?= ($selectedDietType === 'all') ? 'selected' : ''; ?>>All</option>
                <option value="Full Liquid Diet" <?= ($selectedDietType === 'Full Liquid Diet') ? 'selected' : ''; ?>>Full Liquid Diet</option>
                <option value="Ketogenic Diet" <?= ($selectedDietType === 'Ketogenic Diet') ? 'selected' : ''; ?>>Ketogenic Diet</option>
            </select>

            <label for="orderOption">Order by:</label>
            <select name="orderOption" id="orderOption" style="position:relative;left:500px;top:-20px;">
                <option value="1" <?= ($selectedOrderOption == 1) ? 'selected' : ''; ?>>Room Number</option>
                <option value="2" <?= ($selectedOrderOption == 2) ? 'selected' : ''; ?>>Patient ID</option>
            </select>

            <button type="submit" class="button primary-btn">Filter</button>

            <label for="roomnumber">Search by Room Number:</label>
            <input type="number" id="roomnumber" name="roomnumber" pattern="[1-9][0-9]*" min="1">

            <!-- New option to include diet type in the search -->
            <label for="searchByRoomAndDiet">Include Diet Type:</label>
            <input type="checkbox" id="searchByRoomAndDiet" name="searchByRoomAndDiet">

            <input type="submit" name="searchByRoom" class="button primary-btn" value="Search by Room">
        </form>

        <table>
            <thead>
                <tr>
                    <th>Id Patient</th>
                    <th>Date of Birth</th>
                    <th>Medical Record</th>
                    <th>Emergency Contact Number</th>
                    <th>Type</th>
                    <th>Room Number</th>
                    <th>Nights Stayed</th>
                    <th>Diet Type</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($patients as $patient) { ?>
                    <tr>
                        <td><?= $patient['patient_id']; ?></td>
                        <td><?= $patient['date_of_birth']; ?></td>
                        <td><?= $patient['medical_record']; ?></td>
                        <td><?= $patient['emergency_contact_number']; ?></td>
                        <td><?= $patient['typep']; ?></td>
                        <td><?= $patient['room_number']; ?></td>
                        <td><?= $patient['nights_stayed']; ?></td>
                        <td><?= $patient['diet_type']; ?></td>
                        <td>
                            <a href="updatepatient.php?id=<?= $patient['patient_id']; ?>" class="update-btn">Update</a>
                        </td>
                        <td>
                            <a href="deletepatient.php?id=<?= $patient['patient_id']; ?>" class="delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div style="margin-top: 20px;">
        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a href="?page=<?= $i ?>" style="margin-right: 5px;"><?= $i ?></a>
        <?php } ?>
    </div>

    </div>
</body>
</html>

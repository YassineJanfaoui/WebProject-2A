<?php //Display the table of doctors
session_start();
include '../../controller/DoctorController.php';
$c = new DoctorC();
if(isset($_GET["doctor_id"]))
$table = $c->doctorconsultation($_GET["doctor_id"]); // Check function name "listDoctors" in DoctorController.php

?>
<html>
    <head>
        <style>
             .content-table {
                border-collapse: collapse;
                margin: 25px 0;
                font-size: 0.9em;
                width:80%;
                margin-left:10%;
            }

            .content-table thead tr {
                background-color: #2b2d42;
                color: #ffffff;
                text-align: left; 
                font-weight: bold;
            }

            .content-table th,
            .content-table td {
                padding: 10px 50px;
            }

            .content-table tr {
                border-bottom: 1px solid #c0c0c0;
            }

            .content-table tr:nth-of-type(even) {
                background-color: #f3f3f3;
            }

            .content-table tr:last-of-type {
                border-bottom: 2px solid #2b2d42;
            }

            .button {
                background-color: #c0c0c0;
                border-radius: 6px;
                color: #ffffff;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                margin-left:10%;
            }
            .button a{
                text-decoration: none;
            }
            .search {
                display: flex;
                margin: 20px;
                margin-left:20%;
            }
            * { box-sizing: border-box; }
            body {
            font: 16px Arial;
            }
            .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
            }
            input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
            }
            input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
            }
            input[type=submit] {
            background-color: DodgerBlue;
            color: #fff;
            }
            .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            /*position the autocomplete items to be the same width as the container:*/
            top: 100%;
            left: 0;
            right: 0;
            }
            .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
            }
            .autocomplete-items div:hover {
            /*when hovering an item:*/
            background-color: #e9e9e9;
            }
            .autocomplete-active {
            /*when navigating through the items using the arrow keys:*/
            background-color: DodgerBlue !important;
            color: #ffffff;
            }
        </style>
        <link rel="stylesheet" href="../../styles/navbar.css">
        <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
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
            <h1>Consultation</h1>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Room number</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
                if(isset($_GET["doctor_id"]))
                foreach ($table as $doctor) {
                ?>
                    <tr align="center">
                        <td><?php echo $doctor['patient_id']; ?></td>
                        <td><?php echo $doctor['room_number']; ?></td>
                        <td><?php echo $doctor['date']; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <h1>Surgery</h1>
            <?php if(isset($_GET["doctor_id"]))
             $table2 = $c->doctorsurgery($_GET["doctor_id"]); ?>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Room number</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
                if(isset($_GET["doctor_id"]))
                foreach ($table2 as $doctor2) {
                ?>
                    <tr align="center">
                        <td><?php echo $doctor2['patient_id']; ?></td>
                        <td><?php echo $doctor2['room_number']; ?></td>
                        <td><?php echo $doctor2['date']; ?></td>
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
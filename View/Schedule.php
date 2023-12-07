<?php //Display the table of doctors

include '../Controller/DoctorController.php';
$c = new DoctorC();
$table = $c->doctorconsultation($_GET["doctor_id"]); // Check function name "listDoctors" in DoctorController.php
?>
<html>
    <head>
        <style>
            .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px
            }

            .content-table thead tr {
                background-color: #2b2d42; 
                color: #ffffff;
                text-align: left; 
                font-weight: bold;
            }

            .content-table th,
            .content-table td {
                padding: 10px 100px;
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
            }
        </style>
        <link rel="stylesheet" href="../navbar.css">
    </head>
    <body>
        <div class="container">
                <header class="nav-down">
                    <p>Admin Dashboard</p>
                </header>
                <!-- Side navigation -->
                <div class="sidenav">
                    
                    <a href="#">List Feedback</a>
                    <a href="#">List Users</a>
                    <a href="listDoctors.php">Add Doctor</a>
                    <a href="#">Add Nurse</a>
                    <a href="listSurgeries.php">Add Surgery</a>
                </div>
        </div>
        <div class="main">
            <h2>Consultation</h2>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Room number</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
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
            <h2>Surgery</h2>
            <?php $table2 = $c->doctorsurgery($_GET["doctor_id"]); ?> 
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Patient</th>
                        <th>Room number</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <?php
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
        <script src="../navbar.js"></script>
    </body>
</html>
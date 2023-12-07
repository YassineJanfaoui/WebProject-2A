<?php // Display the table of surgeries
//
include '../Controller/SurgeryController.php';
$c = new SurgeryC();
$table = $c->listSurgeryDoctor($_POST['search']); // Check function name "listSurgeries" in SurgeryController.php
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
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Doctor_id</th>
                        <th>Patient_id</th>
                        <th>Room_number</th>
                        <th align="center">Date</th>
                        <th>Description</th>
                        <th>Surgery_price</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <?php
                foreach ($table as $surgery) {
                ?>
                    <tr align="center">
                        <td><?php echo $surgery['surgery_id']; ?></td>
                        <td><?php echo $surgery['doctor_id']; ?></td>
                        <td><?php echo $surgery['patient_id']; ?></td>
                        <td><?php echo $surgery['room_number']; ?></td>
                        <td><?php echo $surgery['date']; ?></td>
                        <td><?php echo $surgery['description']; ?></td>
                        <td><?php echo $surgery['surgery_price']; ?></td>
                        <td><a href="deleteSurgery.php?surgery_id=<?php echo $surgery['surgery_id']; ?>">Delete</a></td>
                        <td><a href="updateSurgery.php?surgery_id=<?php echo $surgery['surgery_id']; ?>&doctor_id=<?php echo $surgery['doctor_id']; ?>&patient_id=<?php echo $surgery['patient_id']; ?>&room_number=<?php echo $surgery['room_number']; ?>&date=<?php echo $surgery['date']; ?>&description=<?php echo $surgery['description']; ?>&surgery_price=<?php echo $surgery['surgery_price']; ?>">Update</a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <button class="button"><a href="addSurgery.php">Add Surgery</a></button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="../navbar.js"></script>
    </body>
</html>
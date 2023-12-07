<?php 

include '../Controller/DoctorController.php';
$c = new DoctorC();
$table = $c->listDoctorsbyspreciality($_POST['search']); 
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
        <form method ="POST" action="searchdoctor.php">
            <input type="text" name="search" placeholder="Search..">
            <input type="submit" name="submit" value="Search">
        </form>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Speciality</th>
                        <th>Schedule</th>
                        <th>Room_number</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <?php
                foreach ($table as $doctor) {
                ?>
                    <tr align="center">
                        <td><?php echo $doctor['doctor_id']; ?></td>
                        <td><?php echo $doctor['speciality']; ?></td>
                        <td><?php echo $doctor['schedule']; ?></td>
                        <td><?php echo $doctor['room_number']; ?></td>
                        <td><a href="deleteDoctor.php?doctor_id=<?php echo $doctor['doctor_id']; ?>">Delete</a></td>
                        <td><a href="updateDoctor.php?doctor_id=<?php echo $doctor['doctor_id']; ?>&speciality=<?php echo $doctor['speciality']; ?>&room_number=<?php echo $doctor['room_number']; ?>&schedule=<?php echo $doctor['schedule']; ?>">Update</a></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <button class="button"><a href="addDoctor.php">Add Doctor</a></button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="../navbar.js"></script>
    </body>
</html>
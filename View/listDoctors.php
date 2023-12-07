<?php //Display the table of doctors

include '../Controller/DoctorController.php';
$c = new DoctorC();
$table = $c->listDoctors(); // Check function name "listDoctors" in DoctorController.php
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
            .search {
                display: flex;
                margin: 20px;
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
            <div class="search">
                <div>
                    <form method ="POST" action="searchdoctor.php">
                        <input type="text" name="search" placeholder="Search..">
                        <input type="submit" name="submit" value="Search">
                    </form>
                </div>
                <div style="position:relative;left:40px;">
                    <!-- select menu sending you to page sortasc.php or sortdesc.php -->
                    <form method="POST" action="" id="sortForm">
                        <label for="dropdown">Sort doctor by speciality:</label>
                        <select id="dropdown" name="dropdown" onchange="redirectToPage()">
                        <option value="SortDoctorAsc.php">Sort Ascending Order</option>
                        <option value="SortDoctorDesc.php">Sort Descending Order</option>
                        </select>
                    </form>
                </div>
            </div>
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
                        <td><a href="Schedule.php?doctor_id=<?php echo $doctor['doctor_id']; ?>">View</a></td>
                        <td><?php echo $doctor['room_number']; ?></td>
                        <td><a id="delete" href="deleteDoctor.php?doctor_id=<?php echo $doctor['doctor_id']; ?>">Delete</a></td>
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
        <script>
            // delete color red
            $(document).ready(function(){
                $("#delete").click(function(){
                    $(this).css("color", "red");
                });
            });
            // Confirm delete
            $(document).ready(function(){
                $("#delete").click(function(){
                    if(!confirm("Are you sure you want to delete this doctor?"))
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                });
            });
            // select menu sending you to pages
            function redirectToPage() {
                var selectedOption = document.getElementById("dropdown").value;
                document.getElementById("sortForm").action = selectedOption;
                document.getElementById("sortForm").submit();
            }
        </script>
    </body>
</html>
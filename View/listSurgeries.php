<?php // Display the table of surgeries
//
include '../Controller/SurgeryController.php';
$c = new SurgeryC();
$table = $c->listSurgeries(); // Check function name "listSurgeries" in SurgeryController.php
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
                    <form method ="POST" action="searchsurgery.php">
                        <input type="text" name="search" placeholder="Search..">
                        <input type="submit" name="submit" value="Search Doctor">
                    </form>
                </div>
                <div  >
                    <form method ="POST" action="searchsurgeryP.php">
                        <input type="text" name="search" placeholder="Search..">
                        <input type="submit" name="submit" value="Search Patient">
                    </form>
                </div>
            </div>
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
                        <td class="surgeryDate"><?php echo $surgery['date']; ?></td>
                        <td><?php echo $surgery['description']; ?></td>
                        <td><?php echo $surgery['surgery_price']; ?></td>
                        <td><a id="delete" href="deleteSurgery.php?surgery_id=<?php echo $surgery['surgery_id']; ?>">Delete</a></td>
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
                    if(!confirm("Are you sure you want to delete this surgery?"))
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                });
            });
            // date color based on the date red for past and green for future and yellow for today
            // Get all elements with the class "surgeryDate"
            var surgeryDateElements = document.getElementsByClassName("surgeryDate");

            // Loop through each element
            for (var i = 0; i < surgeryDateElements.length; i++) {
                // Get the surgery date from PHP and convert it to a JavaScript Date object
                var surgeryDate = new Date(surgeryDateElements[i].textContent);

                // Get the current date
                var currentDate = new Date();

                // Set the time of both dates to midnight to compare only the dates
                surgeryDate.setHours(0, 0, 0, 0);
                currentDate.setHours(0, 0, 0, 0);

                // Compare dates and apply styles accordingly
                if (surgeryDate < currentDate) {
                    surgeryDateElements[i].style.color = "red"; // Past date
                } else if (surgeryDate > currentDate) {
                    surgeryDateElements[i].style.color = "green"; // Future date
                } else {
                    surgeryDateElements[i].style.color = "orange"; // Today's date
                }
            }
        </script>
    </body>
</html>
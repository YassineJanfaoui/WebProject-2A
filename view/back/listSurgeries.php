<?php // Display the table of surgeries
//
session_start();
include '../../controller/SurgeryController.php';
$c = new SurgeryC();
if (isset($_POST['searchd']) && !empty($_POST['searchd'])) {
    $table = $c->listSurgeryDoctor($_POST['searchd']);
} elseif (isset($_POST['searchp']) && !empty($_POST['searchp'])) {
    $table = $c->listSurgeryPatient($_POST['searchp']);
} else {
    $table = $c->listSurgeries();
}
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

            /*.content-table th,
            .content-table td {
                padding: 10px 50px;
            }*/

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
            <h1>Surgeries</h1>
            <div class="search">
                <div>
                    <form autocomplete="off" method ="POST" action="">
                        <div class="autocomplete">
                            <input id="myInput" type="text" name="searchd" placeholder="Doctor id...">
                        </div>    
                        <input type="submit" name="submit" value="Search">
                    </form>
                </div>
                <div style="position:relative;left:40px;">
                    <form autocomplete="off" method ="POST" action="">
                        <div class="autocomplete">
                            <input id="myInput2" type="text" name="searchp" placeholder="Patient id...">
                        </div>   
                        <input type="submit" name="submit" value="Search">
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
        <script src="../../scripts/navbar.js"></script>
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


            
            // Autocomplete search
            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp.addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false;}
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });
                /*execute a function presses a key on the keyboard:*/
                inp.addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                    } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                    } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                    }
                });
                function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/    
                x[currentFocus].classList.add("autocomplete-active");
                }
                function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
                }
                function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                    }
                }
                }
                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
                });
            }

            // Get the doctors and patients from PHP and convert them to a JavaScript array
            var doctors = <?php echo json_encode($c->listDoctors()); ?>;
            autocomplete(document.getElementById("myInput"), doctors);

            // Get the patients from PHP and convert them to a JavaScript array
            /* janfa maandich tableau patients donc juste bech njareb eli yemchi
            el autocomplete hawka ki yebda fama tableau khoudh ligne li taht hedhi mrigla
            w nahi el array example li bech nthabat bih
            el fonction khedmet maa ldocotrs donc systematiquement maa lpatients MERCI */

            var patients = <?php echo json_encode($c->listPatients()); ?>;
            autocomplete(document.getElementById("myInput2"), patients);

            
        </script>
    </body>
</html>
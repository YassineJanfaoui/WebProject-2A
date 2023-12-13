<?php //Display the table of doctors
session_start();
include '../../controller/DoctorController.php';
$c = new DoctorC();
if (isset($_POST["search"]) && !empty($_POST["search"]))
    $table = $c->listDoctorsbyspreciality($_POST['search']);
elseif (isset($_POST["sort"]) && !empty($_POST["sort"])) {
    if ($_POST["sort"] == "ASC")
        $table = $c->listDoctorsbysprecialityASC();
    else
        $table = $c->listDoctorsbysprecialityDESC();
} else
    $table = $c->listDoctors(); // Check function name "listDoctors" in DoctorController.php 
?>
<html>

<head>
    <style>
        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            width: 80%;
            margin-left: 10%;
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
            margin-left: 10%;
        }

        .button a {
            text-decoration: none;
        }

        .search {
            display: flex;
            margin: 20px;
            margin-left: 20%;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font: 16px Arial;
        }

        .autocomplete {
            /*the container must be positioned relative:*/
            position: relative;
            display: inline-block;
            top: 20px;
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
        <h1>Doctors</h1>
        <div class="search">
            <div>
                <form autocomplete="off" method="POST" action="">
                    <div class="autocomplete">
                        <input id="myInput" type="text" name="search" placeholder="Speciality..">
                    </div>
                    <input type="submit" name="submit" value="Search" style="position:relative;top:20px;">
                </form>
            </div>
            <div style="position:relative;left:40px;">
                <!-- select menu sending you to page sortasc.php or sortdesc.php -->
                <form method="POST" action="" id="sortForm">
                    <label for="dropdown">Sort doctor by speciality:</label>
                    <select id="dropdown" name="sort" onchange="submit()">
                        <option>Sort Order</option>
                        <option value="ASC">Sort Ascending Order</option>
                        <option value="DESC">Sort Descending Order</option>
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
                    <td id="speciality"><?php echo $doctor['speciality']; ?></td>
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
    <script src="../../scripts/navbar.js"></script>
    <script>
        // delete color red
        $(document).ready(function() {
            $("#delete").click(function() {
                $(this).css("color", "red");
            });
        });

        // Confirm delete
        $(document).ready(function() {
            $("#delete").click(function() {
                if (!confirm("Are you sure you want to delete this doctor?")) {
                    return false;
                } else {
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

        // extract specaialities from database to an array
        <?php $specialities = $c->listSpecialities(); ?>
        extractedSpecialities = <?php echo json_encode($specialities); ?>;

        // Autocomplete function
        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
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
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
        autocomplete(document.getElementById("myInput"), extractedSpecialities);
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../scripts/navbar.js"></script>
</body>

</html>
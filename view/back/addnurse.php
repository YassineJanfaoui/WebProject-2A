<?php
session_start();
include '../../Controller/NurseC.php';
include '../../Model/Nurse.php';
$error = "";
$nurse = null;

//create an instance of the controller
$NurseC = new NurseCont();
if (
    isset($_POST["nurse_id"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["department"]) &&
    isset($_POST["phone_number"]) &&
    isset($_POST["email"]) &&
    isset($_POST["hire_date"])
)
{
    if (
        !empty($_POST["nurse_id"]) &&
        !empty($_POST["first_name"]) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["department"]) &&
        !empty($_POST["phone_number"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["hire_date"]) 
    )
    {
        $nurse = new nurse(
            $_POST['nurse_id'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['department'],
            $_POST['phone_number'],
            $_POST['email'],
            $_POST['hire_date'],
        );
        $NurseC->addnurse($nurse);
        header('Location:listNurse.php');
    }
    else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nurse</title>
    <link rel="stylesheet" href="../../styles/styleAddNurse.css" />
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
    <div class="main">
        <center>
        <h2>Add nurse</h2></br>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
        
        <form action="" method="POST">
            <div class="row">
                <div class="col-25">
                <label for="nurse id" class="Input_title">Nurse ID:</label><br />
                </div>
                <div class="col-75">
                <input type="number" name="nurse_id" class="input_box" placeholder="Nurse ID here" id="nurse_id" required/><br />
                <span id="nurse_id_msg" class="error2"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="firstname" class="Input_title">First Name:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="first_name" class="input_box" placeholder="First Name here" id="first_name" required/><br />
                </div>
            </div>
            <span id="care_id_msg" class="error"></span>

            <div class="row">
                <div class="col-25">
                <label for="lastname" class="Input_title">Last Name:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="last_name" class="input_box" placeholder="Last Name here" id="last_name" required/><br />
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="phonenumber" class="Input_title">Phone Number:</label><br />
                </div>
                <div class="col-75">
                <input type="number" name="phone_number" class="input_box" placeholder="Phone Number here" id="phone_number" required/><br />
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="email" class="Input_title">Email:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="email" class="input_box" placeholder="Email here" id="email" required/><br />
                <span id="erreurEmail" style="color: red"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="department" class="Input_title">Deparment</label>
                </div>
                <div class="col-75">
                    <select id="shift" name="department">
                    <option value="General">General</option>
                    <option value="Pediatric">Pediatric</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Neurology">Neurology</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="hiredate" class="Input_title">Hire Date:</label><br />
                </div>
                <div class="col-75">
                <input type="date" name="hire_date" min="2023-0&-01" max="2024-12-30" class="input_box" id="hire_date" required/><br />
                </div>
            </div>



             <input type="submit" class="submit" value="Save">
             <input type="reset" class="submit"  value="Reset">
             
        </form>
        <script src="../../scripts/NurseControl.js"></script>
    </center>
</body>

<script src="navbar.js"></script>
</html>
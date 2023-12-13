<?php
session_start();
include '../../Controller/ShiftC.php';
include '../../Model/Shift.php';
$error = "";
$shift = null;

//create an instance of the controller
$ShiftC = new shiftCont();
if (
    isset($_POST["nurse_id"]) &&
    isset($_POST["nurse_name"]) &&
    isset($_POST["shift_date"]) &&
    isset($_POST["shift_type"])
)
{
    if (
        !empty($_POST["nurse_id"]) &&
        !empty($_POST["nurse_name"]) &&
        !empty($_POST["shift_date"]) &&
        !empty($_POST["shift_type"])
    )
    {
        $shift = new shift(
            null,
            $_POST['nurse_id'],
            $_POST['nurse_name'],
            $_POST['shift_date'],
            $_POST['shift_type']
        );
        $ShiftC->addshift($shift);
        //header('Location:listShift.php');
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
    <link rel="stylesheet" href="../../styles/styleAddShift.css" />
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
        <h2>Assign Shift</h2></br>
        </center>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
    <center>
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
                <label for="nursename" class="Input_title">Nurse Name:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="nurse_name" class="input_box" placeholder="Nurse Name here" id="nurse_name" required/><br />
                </div>
            </div>
            <span id="care_id_msg" class="error"></span>

            <div class="row">
                <div class="col-25">
                <label for="shiftdate" class="Input_title">Shift Date:</label><br />
                </div>
                <div class="col-75">
                <input type="date" name="shift_date" min="2023-11-01" max="2024-12-30" class="input_box" id="shift_date" required/><br />
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="shift type" class="Input_title">Shift</label>
                </div>
                <div class="col-75">
                    <select id="shift" name="shift_type">
                    <option value="Day">Day</option>
                    <option value="Night">Night</option>
                    <option value="Rest Day">Rest Day</option>
                    </select>
                </div>
            </div>

             <input type="submit" class="submit" value="Save">
             <input type="reset" class="submit"  value="Reset">
             
        </form>
        
        <script src="../../scripts/NurseControl.js"></script>
        <script src="navbar.js"></script>
    </center>
</body>


</html>
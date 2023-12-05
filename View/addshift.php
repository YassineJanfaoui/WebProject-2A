<?php
include '../Controller/ShiftC.php';
include '../Model/Shift.php';
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
        header('Location:listShift.php');
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
    <link rel="stylesheet" href="../styles/styleAddNurse.css" />
    <link rel="stylesheet" href="../styles/navbar.css" />
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
            <a href="listNurse.php">List Nurses</a>
            <a href="listShift.php">List Nurses Shift</a>
            <a href="listMedcare.php">List Medical care</a>
            <a href="addMedcare.php">Add Medical care</a>
            <a href="#">Add Doctor</a>
            <a href="addnurse.php">Add Nurse</a>
            <a href="addshift.php">Assign Shift to Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
        </div>
    </div>
    <div class="main">
        <h1><b>Shift</b></h1> </br>
        <h2>Assign Shift</h2></br>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
    <center>
        
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
        <script src="../scripts/NurseControl.js"></script>
    </center>
</body>

<script src="navbar.js"></script>
</html>
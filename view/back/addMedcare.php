<?php
session_start();
include '../../Controller/MedC.php';
include '../../Model/Med.php';
$error = "";
$Medcare = null;

//create an instance of the controller
$MedC = new MedCont();
if (
    isset($_POST["patient_id"]) &&
    isset($_POST["med_id"]) &&
    isset($_POST["dosage"]) &&
    isset($_POST["frequency"]) &&
    isset($_POST["patient_name"]) &&
    isset($_POST["medication_name"])
)
{
    if (
        !empty($_POST["patient_id"]) &&
        !empty($_POST["med_id"]) &&
        !empty($_POST["dosage"]) &&
        !empty($_POST["frequency"]) &&
        !empty($_POST["patient_name"]) &&
        !empty($_POST["medication_name"])
    )
    {
        $Medcare = new medical_care(
            null,
            $_POST['patient_id'],
            $_POST['patient_name'],
            $_POST['med_id'],
            $_POST['medication_name'],
            $_POST['dosage'],
            $_POST['frequency']
        );
        $MedC->addMedcare($Medcare);
        header('Location:listMedcare.php');
    }
    else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Medical Care</title>
    <link rel="stylesheet" href="../../styles/styleAddmedcare.css" />
    <link rel="stylesheet" href="../../styles/navbar.css" />
</head>

<body>
<div class="container">
        <header class="nav-down">
            <p>Admin Dashboard - Welcome <?php echo $_SESSION["username"] ?></p>

        </header>
        <!-- Side navigation -->
        <div class="sidenav">
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
        </div>
    </div>
    <div class="main" style="margin-right:10%;">
<center>
        <h1 style="margin-left:15%;"><b>Medical Care</b></h1> </br>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
        
        <form action="" method="POST">
            <label for="resident id" class="Input_title">Patient ID:</label><br />
            <input type="number" name="patient_id" class="input_box" placeholder="Patient ID here" id="patient_id" required/>
            <span id="patient_id_msg" class="error"></span>

            <label for="patient name" class="Input_title">Patient Name:</label><br />
            <input type="text" name="patient_name" class="input_box" placeholder="Patient Name here" id="patient_id" required/>

            <label for="med id" class="Input_title">Medication ID:</label><br />
            <input type="number" name="med_id" class="input_box" placeholder="Medication ID here" id="med_id" required/>
            <span id="med_id_msg" class="error"></span>
              
            <label for="medication name" class="Input_title">Medication Name:</label><br />
            <input type="text" name="medication_name" class="input_box" placeholder="Medication Name here" id="med_id" required/>

            <label for="dosage" class="Input_title">Dosage :</label><br />
            <input type="number" name="dosage" class="input_box" placeholder="Dosage here" id="dosage" required/><br />
            
            <label for="frequency" class="Input_title">Frequency :</label><br />
            <input type="number" name="frequency" class="input_box" placeholder="Frequency here" id="frequency" required/><br />
            
            <input type="submit" class="submit" value="Save">
            <input type="reset" class="submit" value="Reset">
            
        </form>
        <script src="../../scripts/MedControl.js"></script>
    </center>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="navbar.js"></script>
</html>
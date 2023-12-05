<?php

include '../Controller/MedC.php';
include '../Model/Med.php';
$error = "";
$Medcare = null;
//create an instance of the controller
$MedC = new MedCont();


if (
    isset($_POST["patient_id"]) &&
    isset($_POST["med_id"]) &&
    isset($_POST["dosage"]) &&
    isset($_POST["frequency"])
) {
    if (
        !empty($_POST["patient_id"]) &&
        !empty($_POST["med_id"]) &&
        !empty($_POST["dosage"]) &&
        !empty($_POST["frequency"]) 
    ) {
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }
        $Medcare = new medical_care(
            null,
            $_POST['patient_id'],
            $_POST['med_id'],
            $_POST['dosage'],
            $_POST['frequency']
        );
        var_dump($Medcare);
        
        $MedC->updateMedcare($Medcare, $_POST['care_id']);

        header('Location:listMedcare.php');
    } else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Medical Care</title>
    <link rel="stylesheet" href="../styles/styleAddmedcare.css" />
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
            <a href="listMedcare.php">List Medical care</a>
            <a href="addMedcare.php">Add Medical care</a>
            <a href="updateMedcare.php">Update Medical care</a>
            <a href="#">Add Doctor</a>
            <a href="addnurse.php">Add Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
        </div>
    </div>
    <div class="main">
</br>
</br>
</br>
    
        <h1><b>Medical Care</b></h1> </br>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
        <center>
        <form action="" method="POST">
            <label for="resident id" class="Input_title">Patient ID:</label><br />
            <input type="number" name="patient_id" class="input_box" placeholder="Patient ID here" id="patient_id" /><br />

            <label for="med id" class="Input_title">Medication ID:</label><br />
            <input type="number" name="med_id" value="<?php echo $_POST['med_id'] ?>" class="input_box" placeholder="Medication ID here" id="med_id" /><br />
              
            <label for="dosage" class="Input_title">Dosage :</label><br />
            <input type="number" name="dosage" value="<?php echo $_POST['dosage'] ?>" readonly class="input_box" placeholder="Dosage here" id="dosage" /><br />
            
            <label for="frequency" class="Input_title">Frequency :</label><br />
            <input type="number" name="frequency" value="<?php echo $_POST['frequency'] ?>" readonly class="input_box" placeholder="Frequency here" id="frequency" /><br />
            
            <input type="submit" class="submit" value="Save">
            <input type="reset" class="submit" value="Reset">
            
        </form>
        <script src="../scripts/MedControl.js"></script>
    </center>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="navbar.js"></script>
</html>
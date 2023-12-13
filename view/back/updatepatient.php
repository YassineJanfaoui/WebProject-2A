<?php
session_start();
include '../../Controller/patientcontroller.php';
include '../../model/patients.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientId = $_POST["patientId"];
    $newDateOfBirth = $_POST["newDateOfBirth"];
    $newMedicalRecord = $_POST["newMedicalRecord"];
    $newEmergencyContactNumber = $_POST["newEmergencyContactNumber"];
    $newTypep = $_POST["newTypep"];
    $newRoomNumber = $_POST["newRoomNumber"];
    $newNightsStayed = $_POST["newNightsStayed"];
    $newDietType = $_POST["newDietType"];

    $updatedPatient = new Patients($patientId, $newDateOfBirth, $newMedicalRecord, $newEmergencyContactNumber, $newTypep, $newRoomNumber, $newNightsStayed, $newDietType);

    $PatientsController = new PatientsController();

    $PatientsController->updatePatient($updatedPatient, $patientId);

    header("Location: listpatient.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link rel="stylesheet" href="../../styles/navbar.css">
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
    <div class="main" style="margin-top:10%;margin-left:25%">
    <h2>Update Patient Information</h2>
    <?php
    if (isset($_GET["id"])) {
        $patientId = $_GET["id"];
        echo "Patient ID: " . $patientId; // Debug statement

        $PatientsController = new PatientsController();

        $currentPatient = $PatientsController->showPatient($patientId);
        // var_dump($currentPatient); // Debug statement

        if ($currentPatient) {
    ?>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="patientId" value="<?php echo $currentPatient['patient_id']; ?>">
                <label for="newDateOfBirth">New Date of Birth:</label>
                <input type="text" name="newDateOfBirth" value="<?php echo $currentPatient['date_of_birth']; ?>" required><br>
                <label for="newMedicalRecord">New Medical Record:</label>
                <input type="text" name="newMedicalRecord" value="<?php echo $currentPatient['medical_record']; ?>" required><br>
                <label for="newEmergencyContactNumber">New Emergency Contact Number:</label>
                <input type="text" name="newEmergencyContactNumber" value="<?php echo $currentPatient['emergency_contact_number']; ?>" required><br>
                <label for="newTypep">New Typep:</label>
                <input type="text" name="newTypep" value="<?php echo $currentPatient['typep']; ?>" required><br>
                <label for="newRoomNumber">New Room Number:</label>
                <input type="number" name="newRoomNumber" value="<?php echo $currentPatient['room_number']; ?>" pattern="[1-9][0-9]*" min="1" required><br>
                <label for="newNightsStayed">New Nights Stayed:</label>
                <input type="number" name="newNightsStayed" value="<?php echo $currentPatient['nights_stayed']; ?>" pattern="[1-9][0-9]*" min="1" required><br>
                <label for="newDietType">New Diet Type:</label>
                <input type="text" name="newDietType" value="<?php echo $currentPatient['diet_type']; ?>" required><br>
                <input type="submit" value="Update Patient">
            </form>

    <?php
        } else {
            echo "Patient not found.";
        }
    } else {
        echo "Patient ID not provided.";
    }
    ?>
    </div>


</body>

</html>
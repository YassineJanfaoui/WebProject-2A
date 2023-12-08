<?php
include '../Controller/patientcontroller.php';
include '../model/patients.php';

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
</head>
<body>
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
    <input type="number" name="newRoomNumber" value="<?php echo $currentPatient['room_number']; ?>"   pattern="[1-9][0-9]*" min="1" required><br>
    <label for="newNightsStayed">New Nights Stayed:</label>
    <input type="number" name="newNightsStayed" value="<?php echo $currentPatient['nights_stayed']; ?>"  pattern="[1-9][0-9]*" min="1" required><br>
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


</body>
</html>

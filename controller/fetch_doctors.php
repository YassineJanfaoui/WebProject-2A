<?php
require_once("../../config.php");

if (isset($_POST['specialty'])) {
    $specialty = $_POST['specialty'];
    $pdo = config::getConnexion();

    // Include doctor_id in the SELECT statement
    $stmt = $pdo->prepare("
        SELECT IMG,doctor_id
        FROM doctor 
        WHERE speciality = :specialty
    ");
    $stmt->execute(['specialty' => $specialty]);
    $doctor = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($doctor) > 0) {
        echo '<option value="">Select Doctor</option>';
        foreach ($doctor as $doctor) {
            $fullName = htmlspecialchars($doctor['IMG']);
            echo "<option value='" . $doctor['doctor_id'] . "'>" . $fullName . "</option>";
        }
    } else {
        echo "<option value=''>No doctor found</option>";
    }
}
?>

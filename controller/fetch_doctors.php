<?php
require_once("../config/config.php");

if (isset($_POST['specialty'])) {
    $specialty = $_POST['specialty'];
    $pdo = config::getConnection();

    // Include doctor_id in the SELECT statement
    $stmt = $pdo->prepare("
        SELECT d.doctor_id, u.first_name, u.family_name
        FROM doctors d 
        JOIN users u ON d.doctor_id = u.user_id 
        WHERE d.doctor_specialty = :specialty
    ");
    $stmt->execute(['specialty' => $specialty]);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($doctors) > 0) {
        echo '<option value="">Select Doctor</option>';
        foreach ($doctors as $doctor) {
            $fullName = htmlspecialchars($doctor['first_name']) . ' ' . htmlspecialchars($doctor['family_name']);
            echo "<option value='" . $doctor['doctor_id'] . "'>" . $fullName . "</option>";
        }
    } else {
        echo "<option value=''>No doctors found</option>";
    }
}
?>

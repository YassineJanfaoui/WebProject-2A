<?php
require_once '../model/consultation_model.php'; // Adjust path as necessary

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_id = $_POST['doctor'];
    $day = $_POST['day'];
    $time = $_POST['time'];
    $consultation_date = date('Y-m-d', strtotime($day));
    $patient_id = 4; // Replace with actual patient ID

    $consultationModel = new ConsultationModel();

    try {
        $consultationModel->saveConsultation($doctor_id, $consultation_date, $time, $patient_id);
        echo "Appointment saved successfully";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

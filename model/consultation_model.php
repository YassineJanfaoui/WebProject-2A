<?php
require_once '../config/config.php';

class ConsultationModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = config::getConnection();
    }

    public function saveConsultation($doctor_id, $consultation_date, $consultation_time, $patient_id) {
        // Retrieve the office for the selected doctor
        $officeQuery = $this->pdo->prepare("SELECT office FROM doctors WHERE doctor_id = :doctor_id");
        $officeQuery->execute([':doctor_id' => $doctor_id]);
        $officeResult = $officeQuery->fetch(PDO::FETCH_ASSOC);

        if (!$officeResult) {
            throw new Exception("Office for the selected doctor not found.");
        }

        $consultation_room = $officeResult['office'];

        // Insert consultation into the database
        $sql = "INSERT INTO consultations (doctor_id, consultation_date, consultation_time, patient_id, consultation_room) VALUES (:doctor_id, :consultation_date, :consultation_time, :patient_id, :consultation_room)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':doctor_id' => $doctor_id,
            ':consultation_date' => $consultation_date,
            ':consultation_time' => $consultation_time,
            ':patient_id' => $patient_id, // Replace with actual patient ID
            ':consultation_room' => $consultation_room
        ]);

        return true;
    }
}

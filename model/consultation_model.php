<?php
require_once '../../config.php';

class ConsultationModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function saveConsultation($doctor_id, $consultation_date, $consultation_time, $patient_id) {
        // Retrieve the room_number for the selected doctor
        $room_numberQuery = $this->pdo->prepare("SELECT room_number FROM doctors WHERE doctor_id = :doctor_id");
        $room_numberQuery->execute([':doctor_id' => $doctor_id]);
        $room_numberResult = $room_numberQuery->fetch(PDO::FETCH_ASSOC);

        if (!$room_numberResult) {
            throw new Exception("Office for the selected doctor not found.");
        }

        $consultation_room = $room_numberResult['room_number'];

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

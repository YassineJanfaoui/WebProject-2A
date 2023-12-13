<?php
// doctor_model.php
require_once '../../config.php'; // Adjust the path as necessary

class DoctorModel
{
    public function getDoctors()
    {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT doctor_id, IMG AS doctor_name FROM doctor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDoctorsBySpecialty($specialty)
    {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT doctor_id, IMG AS doctor_name FROM doctor WHERE speciality = :specialty");
        $stmt->bindParam(':specialty', $specialty, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

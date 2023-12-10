<?php
// doctor_model.php
require_once '../config/config.php'; // Adjust the path as necessary

class DoctorModel
{
    public function getDoctors()
    {
        $pdo = config::getConnection();
        $stmt = $pdo->prepare("SELECT doctor_id, CONCAT(first_name, ' ', family_name) AS doctor_name FROM doctors JOIN users ON doctors.doctor_id = users.user_id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getDoctorsBySpecialty($specialty)
    {
        $pdo = config::getConnection();
        $stmt = $pdo->prepare("SELECT doctors.doctor_id, CONCAT(users.first_name, ' ', users.family_name) AS doctor_name FROM doctors JOIN users ON doctors.doctor_id = users.user_id WHERE doctors.doctor_specialty = :specialty");
        $stmt->bindParam(':specialty', $specialty, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

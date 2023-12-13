<?php
// ../../model/specialty_model.php
require_once '../../config.php'; // Adjust the path as necessary

class SpecialtyModel
{
    public function getSpecialties()
    {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT DISTINCT speciality FROM doctor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Additional method in SpecialtyModel.php
    public function getDoctorsBySpecialty($specialty)
    {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("SELECT first_name FROM doctor INNER JOIN users ON doctor.doctor_id = users.user_id WHERE speciality = :specialty");
        $stmt->bindParam(':specialty', $specialty, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

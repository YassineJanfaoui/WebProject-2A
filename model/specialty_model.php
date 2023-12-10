<?php
// ../model/specialty_model.php
require_once '../config/config.php'; // Adjust the path as necessary

class SpecialtyModel
{
    public function getSpecialties()
    {
        $pdo = config::getConnection();
        $stmt = $pdo->prepare("SELECT DISTINCT doctor_specialty FROM doctors");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Additional method in SpecialtyModel.php
    public function getDoctorsBySpecialty($specialty)
    {
        $pdo = config::getConnection();
        $stmt = $pdo->prepare("SELECT first_name FROM doctors INNER JOIN users ON doctors.doctor_id = users.user_id WHERE doctor_specialty = :specialty");
        $stmt->bindParam(':specialty', $specialty, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

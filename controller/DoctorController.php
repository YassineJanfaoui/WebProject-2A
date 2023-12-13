<?php

require_once '../../config.php';
class DoctorC // class Doctor Controller
{
    public function listDoctors()
    {
        $sql = "SELECT * FROM doctor"; // Check the table name "doctor"
        $db = config::getConnexion();
        try {
            $list = $db->query($sql); // query for selection for display
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Select all specialities from doctor in an array
    function listSpecialities()
    {
        $sql = "SELECT speciality FROM doctor";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            $list = $list->fetchAll();
            $specialities = array();
            foreach ($list as $speciality) {
                array_push($specialities, $speciality['speciality']);
            }
            return $specialities;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function listDoctorsbyspreciality($speciality)
    {
        $sql = "SELECT * FROM doctor WHERE speciality = :speciality;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':speciality', $speciality);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // sort doctors acending order by speciality
    function listDoctorsbysprecialityASC()
    {
        $sql = "SELECT * FROM doctor ORDER BY speciality ASC;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // sort doctors decending order by speciality
    function listDoctorsbysprecialityDESC()
    {
        $sql = "SELECT * FROM doctor ORDER BY speciality DESC;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function doctorconsultation($doctor_id)
    {
        $sql = "SELECT room_number, patient_id, date FROM consultations WHERE doctor_id = :doctor_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':doctor_id', $doctor_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function doctorsurgery($doctor_id)
    {
        $sql = "SELECT room_number, patient_id, date FROM surgery WHERE doctor_id = :doctor_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':doctor_id', $doctor_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteDoctor ($doctor_id)
    {
        $sql = "DELETE FROM doctor WHERE doctor_id= :doctor_id"; 
        $db = config::getConnexion();
        $req = $db->prepare($sql); // prepare for manipulation 
        $req->bindValue(':doctor_id', $doctor_id);
        try {
            $req->execute();
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function addDoctor($doctor)
    {
        $sql = "INSERT INTO doctor VALUES (:doctor_id, :speciality, :schedule, :room_number,:IMG)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'doctor_id' => $doctor->getDoctor_id(),
                'speciality' => $doctor->getSpeciality(),
                'schedule' => $doctor->getSchedule(),
                'room_number' => $doctor->getRoom_number(),
                'IMG' => $doctor->getIMG()
            ]);
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());   
        }
    }

    function updateDoctor($doctor)
    {
        $sql = "UPDATE doctor SET speciality = :speciality, schedule = :schedule, room_number = :room_number WHERE doctor_id = :doctor_id";
        $db = config::getConnexion();
    
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'doctor_id' => $doctor->getDoctor_id(),
            'speciality' => $doctor->getSpeciality(),
            'schedule' => $doctor->getSchedule(),
            'room_number' => $doctor->getRoom_number(),
        ]);
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }
    }
}
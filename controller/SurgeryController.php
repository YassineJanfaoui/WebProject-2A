<?php

require '../../config.php';
class SurgeryC // class Surgery Controller
{
    public function listSurgeries() 
    {
        $sql = "SELECT * FROM surgery"; // Check the table name "surgery"
        $db = config::getConnexion();
        try {
            $list = $db->query($sql); // query for selection for display
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Select all doctor ids from doctor in an array
    function listDoctors()
    {
        $sql = "SELECT doctor_id FROM doctor;";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            $list = $list->fetchAll();
            $doctors = array();
            foreach ($list as $doctor) {
                array_push($doctors, $doctor['doctor_id']);
            }
            return $doctors;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Select all patient ids from patient in an array
    function listPatients()
    {
        $sql = "SELECT patient_id FROM surgery;";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            $list = $list->fetchAll();
            $patients = array();
            foreach ($list as $patient) {
                array_push($patients, $patient['patient_id']);
            }
            return $patients;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function listSurgeryDoctor($doctor_id)
    {
        $sql = "SELECT * FROM surgery WHERE doctor_id = :doctor_id;";
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

    function listSurgeryPatient($patient_id)
    {
        $sql = "SELECT * FROM surgery WHERE patient_id = :patient_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':patient_id', $patient_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteSurgery ($surgery_id)
    {
        $sql = "DELETE FROM surgery WHERE surgery_id= :surgery_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql); // prepare for manipulation
        $req->bindValue(':surgery_id', $surgery_id);
        try {
            $req->execute();
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function getRoom()
    {
        $sql = "SELECT room_number FROM rooms WHERE status = 0 LIMIT 1;";
        $db = config::getConnexion();
        $list = $db->prepare($sql);
        try {
            
            $list->execute();
            $req = $list->fetchAll(PDO::FETCH_ASSOC);
            $room = "No room available";
            // Check if a room is found
            if (!empty($req)) {
                // Assuming you want the first room in the result set
                foreach ($req as $row) {
                    $room = $row['room_number'];
                } return $room;
            } else {
                // No available rooms
                return null;
            }
        } catch (PDOException $e) {
            // Log or handle the error as needed
            die('Error:' . $e->getMessage());
        }
    }

    function addSurgery($surgery)
    {
        $sql = "INSERT INTO surgery VALUES (NULL, :doctor_id, :patient_id, :room_number, :date, :description, :surgery_price)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'doctor_id' => $surgery->getDoctor_id(),
                'patient_id' => $surgery->getPatient_id(),
                'room_number' => $surgery->getRoom_number(),
                'date' => $surgery->getDate(),
                'description' => $surgery->getDescription(),
                'surgery_price' => $surgery->getSurgery_price(),
            ]);
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());   
        }
    }

    function updateSurgery($surgery)
    {
        $sql = "UPDATE surgery SET doctor_id = :doctor_id, patient_id = :patient_id, room_number = :room_number, date = :date, description = :description, surgery_price = :surgery_price WHERE surgery_id = :surgery_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute([
                'surgery_id' => $surgery->getSurgery_id(),
                'doctor_id' => $surgery->getDoctor_id(),
                'patient_id' => $surgery->getPatient_id(),
                'room_number' => $surgery->getRoom_number(),
                'date' => $surgery->getDate(),
                'description' => $surgery->getDescription(),
                'surgery_price' => $surgery->getSurgery_price()
            ]);
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
}
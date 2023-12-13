<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

require_once '../../config.php';


class PatientsController
{
    public function listDiets()
    {
        $db = config::getConnexion();
        $sql = "SELECT type_name FROM diet_type";
        try {
            $diets = $db->query($sql);
            return $diets;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listPatients()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM patients";
        try {
            $patients = $db->query($sql);
            return $patients;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    public function listsomePatients()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM users WHERE user_id NOT IN (SELECT patient_id FROM patients)";
        try {
            $patients = $db->query($sql);
            return $patients;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deletePatient($id)
    {
        $sql = 'DELETE FROM patients WHERE patient_id = :id';
        $db = Config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(":id", $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die("Error:" . $e->getMessage());
        }
    }


    public function addPatient($patient)
    {
        $sql = "INSERT INTO patients
        VALUES (:patientId, :dateOfBirth, :medicalRecord, :emergencyContactNumber, :typep, :roomNumber, :nightsStayed, :dietType)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'patientId' => $patient->getPatientId(),
                'dateOfBirth' => $patient->getdate_of_birth(),
                'medicalRecord' => $patient->getmedical_record(),
                'emergencyContactNumber' => $patient->getemergency_contact_number(),
                'typep' => $patient->gettypep(),
                'roomNumber' => $patient->getroom_number(),
                'nightsStayed' => $patient->getnights_stayed(),
                'dietType' => $patient->getdiet_type(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showpatient($id)
    {
        $sql = "SELECT * FROM patients WHERE patient_id = :id";
        $db = Config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(":id", $id);
            $query->execute();
            $patient = $query->fetch();
            return $patient;
        } catch (Exception $e) {
            // Log or handle the error appropriately
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatePatient($patient, $patientId)
{
    try {
        $db = config::getConnexion();
        $query = $db->prepare(
            'UPDATE patients SET 
                date_of_birth = :dateOfBirth, 
                medical_record = :medicalRecord,
                emergency_contact_number = :emergencyContactNumber,
                typep = :typep,
                room_number = :roomNumber,
                nights_stayed = :nightsStayed,
                diet_type = :dietType
            WHERE patient_id = :patientId'
        );

        $query->execute([
            'patientId' => $patientId,
            'dateOfBirth' => $patient->getdate_of_birth(),
            'medicalRecord' => $patient->getmedical_record(),
            'emergencyContactNumber' => $patient->getemergency_contact_number(),
            'typep' => $patient->gettypep(),
            'roomNumber' => $patient->getroom_number(),
            'nightsStayed' => $patient->getnights_stayed(),
            'dietType' => $patient->getdiet_type(),
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


public function get_user($user_id) {
    try {
    $pdo = config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM users WHERE user_id = :id");
    $query->execute(['id' => $user_id]);
    return $query->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
    }
    
    public function displayuser() {
    try {
    $pdo = config::getConnexion();
    $query = $pdo->prepare("SELECT * FROM patients");
    $query->execute();
    return $query->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
    }
    }

    
   

    public function orederpatients($choose, $start, $recordsPerPage)
    {
        $db = config::getConnexion();
        if ($choose == 1) {
            $sql = "SELECT * FROM patients ORDER BY room_number LIMIT $start, $recordsPerPage";
        }

        if ($choose == 2) {
            $sql = "SELECT * FROM patients ORDER BY patient_id LIMIT $start, $recordsPerPage";
        }

        try {
            $patients = $db->query($sql);
            return $patients;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function filterAndOrderPatients($dietType, $choose, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM patients WHERE diet_type = ?";

        switch ($choose) {
            case 1:
                $sql .= " ORDER BY room_number";
                break;
            case 2:
                $sql .= " ORDER BY patient_id";
                break;
          

            default:
              
                break;
        }

        $sql .= " LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $dietType, PDO::PARAM_STR);
            $stmt->execute();
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $patients;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function searchByRoom($roomNumber, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM patients WHERE room_number = :roomnumber LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':roomnumber', $roomNumber, PDO::PARAM_INT);
            $stmt->execute();
            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $patients;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function filterPatientsByRoomAndDiet($roomNumber, $dietType, $start, $recordsPerPage)
    {
        $db = config::getConnexion();

        $sql = "SELECT * FROM patients WHERE room_number = ?";

        if ($dietType !== 'all') {
            $sql .= " AND diet_type = ?";
        }

        $sql .= " LIMIT $start, $recordsPerPage";

        try {
            $stmt = $db->prepare($sql);

            if ($dietType !== 'all') {
                $stmt->bindParam(1, $roomNumber, PDO::PARAM_INT);
                $stmt->bindParam(2, $dietType, PDO::PARAM_STR);
            } else {
                $stmt->bindParam(1, $roomNumber, PDO::PARAM_INT);
            }

            $stmt->execute();

            $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $patients;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



public function verifyPatientPassword($patientId, $password)
{
    try {
        $db = Config::getConnexion();
        $query = $db->prepare("SELECT password FROM users WHERE user_id = :patientId");
        $query->bindValue(":patientId", $patientId);
        $query->execute();
        $user = $query->fetch();

        if ($user && $password == $user['password']) {
            return true; // Passwords match
        } else {
            return false; // Passwords do not match
        }
    } catch (PDOException $e) {
        error_log('Error: ' . $e->getMessage());
        return false;
    }
}



public function getFilteredTotalRecords($dietType)
    {
        $db = config::getConnexion();

        $sql = "SELECT COUNT(*) as total FROM patients";

        // If a specific diet type is provided, add a WHERE clause
        if ($dietType !== 'all') {
            $sql .= " WHERE diet_type = :dietType";
        }

        try {
            $stmt = $db->prepare($sql);

            
            if ($dietType !== 'all') {
                $stmt->bindParam(':dietType', $dietType, PDO::PARAM_STR);
            }

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row['total'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }




public function sendEmail($name, $email, $subject, $message)
    {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'medokh493@gmail.com';
            $mail->Password = 'lheb yqnl dtiz zeuj';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';

            // Recipient settings
            $mail->addAddress($email);
            $mail->setFrom('medokh493@gmail.com', $name);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = nl2br($message); // Convert newlines to HTML line breaks

            $mail->send();
            return true; // Email sent successfully
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return false; // Email sending failed
        }
    }

    

    public function pagination($page = 1, $recordsPerPage = 5)
    {
        $db = config::getConnexion();
        $start = ($page - 1) * $recordsPerPage;

        $sql = "SELECT * FROM patients LIMIT $start, $recordsPerPage";

        try {
            $patients = $db->query($sql);
            return $patients;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getTotalRecords()
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) as total FROM patients";

        try {
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return $row['total'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

}






?>

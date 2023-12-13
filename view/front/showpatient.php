<?php
session_start();
include "../../controller/patientcontroller.php";
include '../../model/patients.php';

require_once __DIR__ . '/../../vendor/autoload.php';

use TCPDF as TCPDF;

$patientInfo = null;



    $patientId = $_SESSION["user_id"];
    $password = $_SESSION["password"];

    if (is_numeric($patientId)) {
        $patientController = new PatientsController();


        if ($patientController->verifyPatientPassword($patientId, $password)) {

            $patientInfo = $patientController->showPatient($patientId);
        } else {
            $errorMsg = "Incorrect password.";
        }
    }

    if ($patientInfo) {
        try {
            // Create a new PDF document
            $pdf = new TCPDF();

            // Set document information
            $pdf->SetCreator('Your Name');
            $pdf->SetAuthor('Your Name');
            $pdf->SetTitle('Patient Information');

            // Add a page
            $pdf->AddPage();

            // Set font
            $pdf->SetFont('helvetica', '', 12);

            // Add patient information to the PDF
            $pdf->Cell(0, 10, 'Patient Information', 0, 1, 'C');
            foreach ($patientInfo as $key => $value) {
                $pdf->Cell(0, 10, ucfirst(str_replace('_', ' ', $key)) . ": " . $value, 0, 1);
            }

            // Output PDF to the browser or save to a file
            $pdf->Output('patient_information.pdf', 'I');

            // Terminate the script to prevent HTML output after the PDF
            exit;
        } catch (Exception $e) {
            // Log the error
            error_log('PDF Generation Error: ' . $e->getMessage());
            echo 'Failed to generate PDF. Please try again later.';
        }
    }
    if ($patientInfo) {
        echo "<h3>Patient Information:</h3>";
        echo "Patient ID: " . $patientInfo['patient_id'] . "<br>";
        echo "Date of Birth: " . $patientInfo['date_of_birth'] . "<br>";
        echo "Medical Record: " . $patientInfo['medical_record'] . "<br>";
        echo "Emergency Contact Number: " . $patientInfo['emergency_contact_number'] . "<br>";
        echo "Typep: " . $patientInfo['typep'] . "<br>";
        echo "Room Number: " . $patientInfo['room_number'] . "<br>";
        echo "Nights Stayed: " . $patientInfo['nights_stayed'] . "<br>";
        echo "Diet Type: " . $patientInfo['diet_type'] . "<br>";
    }

?>


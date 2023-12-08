<?php
include "../controller/patientcontroller.php";
include '../model/patients.php';

require_once __DIR__ . '/../vendor/autoload.php';

use TCPDF as TCPDF;

$patientInfo = null;


ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $patientId = $_POST["patient_id"];
    $password = $_POST["password"];

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
            $pdf->Output(__DIR__ . '/patient_information.pdf', 'I');

            // Terminate the script to prevent HTML output after the PDF
            exit;
        } catch (Exception $e) {
            // Log the error
            error_log('PDF Generation Error: ' . $e->getMessage());
            echo 'Failed to generate PDF. Please try again later.';
        }
    }
}

// Clean the output buffer
ob_end_clean();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Patient Information</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #2B2D42;
        }

        h2 {
            color: #4F988D;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2B2D42;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #2B2D42;
        }

        input[type="submit"] {
            background-color: #4F988D;
            color: #f4f4f4;
            cursor: pointer;
        }

        h3 {
            color: #4F988D;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Enter Patient ID to Display Information</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="patient_id">Patient ID:</label>
        <input type="text" name="patient_id" id="patient_id" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Display Information">


    </form>

    <?php
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

</body>

</html>

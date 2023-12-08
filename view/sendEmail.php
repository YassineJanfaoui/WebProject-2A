<?php
include "../controller/patientcontroller.php";
include '../model/patients.php';

$patientInfo = null;
$errorMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted
    $patientId = $_POST["patient_id"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $password = $_POST["password"];

    if (is_numeric($patientId)) {
        $patientController = new PatientsController();

        // Check if the patient_id and password match
        if ($patientController->verifyPatientPassword($patientId, $password)) {
            // If the passwords match, retrieve patient information
            $patientInfo = $patientController->showPatient($patientId);
        } else {
            $errorMsg = "Incorrect password.";
        }

        if ($patientInfo) {
            // Send email with patient information
            $emailSubject = "Patient Information";
            $emailMessage = "Patient ID: " . $patientInfo['patient_id'] . "\n"
                . "Date of Birth: " . $patientInfo['date_of_birth'] . "\n"
                . "Medical Record: " . $patientInfo['medical_record'] . "\n"
                . "Emergency Contact Number: " . $patientInfo['emergency_contact_number'] . "\n"
                . "Typep: " . $patientInfo['typep'] . "\n"
                . "Room Number: " . $patientInfo['room_number'] . "\n"
                . "Nights Stayed: " . $patientInfo['nights_stayed'] . "\n"
                . "Diet Type: " . $patientInfo['diet_type'];

            $patientController->sendEmail($name, $email, $emailSubject, $emailMessage);
            header("Location: ./response.php");
        } else {
            $errorMsg = "Patient does not exist or incorrect password.";
        }
    } else {
        $errorMsg = "Invalid patient ID. Please enter a numeric value.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>phpEmail</title>

    <!-- Include external CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/rizalcss@2.0.9/css/cdn.rizal.css" integrity="sha256-0vFAs0ft9ykF6DOLV4g0iRVz5hJ+V7HvY5fZapVeUD0=" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script defer src="https://kit.fontawesome.com/1e8d61f212.js"></script>

    <!-- Internal CSS for styling -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            display: grid;
            gap: 10px;
            max-width: 400px;
            width: 100%;
        }

        label {
            color: #007bff;
        }

        .primary-button {
            background-color: #007bff;
        }

        .primary-button-icon {
            color: #ffffff;
        }

        .color_white {
            color: #ffffff;
        }

        .background_color_primary {
            background-color: #007bff;
        }

        .font_size_medium {
            font-size: 16px;
        }

        .border_radius_secondary {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <form class="center_absolute display_grid" action="" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Name" autocomplete="off" id="name">

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email" autocomplete="off" id="email">

        <label for="patient_id">Patient ID:</label>
        <input type="text" name="patient_id" id="patient_id" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="send" class="primary-button background_color_primary font_size_medium color_white border_radius_secondary">
            Send <i class="fa-solid fa-paper-plane primary-button-icon"></i>
        </button>

        <?php if ($errorMsg) { ?>
            <p style="color: red;"><?php echo $errorMsg; ?></p>
        <?php } ?>
    </form>

    <script defer src="https://cdn.jsdelivr.net/npm/rizalcss@2.0.9/js/components.min.js" integrity="sha256-3UCSBV90gv8A+IA1iZst64qLbw7u9y2Y6JbfRa21tKw=" crossorigin="anonymous"></script>
</body>
</html>

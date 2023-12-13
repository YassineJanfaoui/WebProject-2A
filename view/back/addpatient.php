<?php
session_start();
include '../../Controller/patientcontroller.php';
include "../../controller/roomcontroller.php";
include '../../model/patients.php';
include '../../controller/UserC.php';

$error = "";

// create patient
$patient = null;


$patientsController = new PatientsController();
$roomC = new RoomController();
$tab = $patientsController->listsomePatients();
$diets = $patientsController->listDiets();
$rooms = $roomC->listRooms();
if (
    isset($_POST["patient_id"]) &&
    isset($_POST["date_of_birth"]) &&
    isset($_POST["medical_record"]) &&
    isset($_POST["emergency_contact_number"]) &&
    isset($_POST["typep"]) &&
    isset($_POST["room_number"]) &&
    isset($_POST["nights_stayed"]) &&
    isset($_POST["diet_type"])
) {
    if (
        !empty($_POST['patient_id']) &&
        !empty($_POST['date_of_birth']) &&
        !empty($_POST["medical_record"]) &&
        !empty($_POST["emergency_contact_number"]) &&
        !empty($_POST["typep"]) &&
        !empty($_POST["room_number"]) &&
        !empty($_POST["nights_stayed"]) &&
        !empty($_POST["diet_type"])
    ) {
        $patient = new Patients(
            $_POST['patient_id'],
            $_POST['date_of_birth'],
            $_POST['medical_record'],
            $_POST['emergency_contact_number'],
            $_POST['typep'],
            $_POST['room_number'],
            $_POST['nights_stayed'],
            $_POST['diet_type']
        );
        $patientsController->addPatient($patient);
        header('Location:successmessage.php');
    } else {
        $error = "Missing information";
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            color: #2B2D42;
            margin-bottom: 20px;
        }

        form {
            margin-top: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        td {
            padding: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin-right: 8px;
        }

        input[type="submit"] {
            background-color: #4F988D;
            color: #ffffff;
        }

        input[type="reset"] {
            background-color: #C0C0C0;
            color: #333333;
        }

        #error {
            color: red;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <div class="container">
        <a href="listpatient.php" style="text-decoration: none; color: #2B2D42;">Back to List</a>
        <hr>
        <h1>Add Patient</h1>

        <div id="error"><?php echo $error; ?></div>

        <form action="" method="POST">
            <table>

                <tr>
                    <td><label for="patient_id">Patient ID:</label></td>
                    <td>
                        <select name="patient_id" id="patient_id" require>
                            <?php
                            foreach ($tab as $t) {
                                if ($t['type'] != 'patient') {
                                    continue;
                                }
                            ?>
                                
                                <option value="<?php echo $t['user_id']; ?>"><?php echo $t['user_id']."({$t['first_name']} {$t['family_name']})"; ?></option>
                            <?php
                            }
                            ?>
                        <span id="erreurPatientId" style="color: red"></span>
                    </td>

                </tr>

                <tr>
                    <td><label for="date_of_birth">Date of Birth:</label></td>
                    <td>
                        <input type="date" id="date_of_birth" name="date_of_birth" />
                        <span id="erreurDateOfBirth" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="medical_record">Medical Record:</label></td>
                    <td>
                        <input type="text" id="medical_record" name="medical_record" minlength="4" />
                        <span id="erreurMedicalRecord" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="emergency_contact_number">Emergency Contact Number:</label></td>
                    <td>
                        <input type="number" id="emergency_contact_number" name="emergency_contact_number" pattern="[1-9][0-9]*" min="1" require />
                        <span id="erreurEmergencyContactNumber" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="typep">Typep:</label></td>
                    <td>
                        <select name="typep" id="typep">
                            <option value="patient">patient</option>
                            <option value="inpatient">inpatient</option>
                        </select>
                        <span id="erreurTypep" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="room_number">Room Number:</label></td>
                    <td>
                        <select name="room_number" id="room_number">
                            <?php
                            foreach ($rooms as $r) {
                            ?>
                                <option value="<?php echo $r['room_number']; ?>"><?php echo $r['room_number']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span id="erreurRoomNumber" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nights_stayed">Nights Stayed:</label></td>
                    <td>
                        <input type="number" id="nights_stayed" name="nights_stayed" pattern="[1-9][0-9]*" min="1" />
                        <span id="erreurNightsStayed" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="diet_type">Diet Type:</label></td>
                    <td>
                        <select name="diet_type" id="diet_type">
                            <?php
                            foreach ($diets as $d) {
                            ?>
                                <option value="<?php echo $d['type_name']; ?>"><?php echo $d['type_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <span id="erreurDietType" style="color: red"></span>
                    </td>
                </tr>

                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
</body>

</html>
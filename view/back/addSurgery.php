<?php
session_start();
include '../../controller/SurgeryController.php';
include '../../controller/doctorcontroller.php';
include '../../controller/patientcontroller.php';
include '../../controller/roomcontroller.php';
include '../../model/Surgery.php';
$error = "";
$surgery = null;

// create an instance of the controller
$surgeryC = new SurgeryC();
$doctorC = new DoctorC();
$patientC = new PatientsController();
$roomC = new RoomController();
$room = $surgeryC->getRoom();
if (
    isset($_POST["doctor_id"]) &&
    isset($_POST["patient_id"]) &&
    isset($_POST["room_number"]) &&
    isset($_POST["date"]) &&
    isset($_POST["description"]) &&
    isset($_POST["surgery_price"])
) {
    if (
        !empty($_POST["doctor_id"]) &&
        !empty($_POST["patient_id"]) &&
        !empty($_POST["room_number"]) &&
        !empty($_POST["date"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["surgery_price"])
    ) {
        $surgery = new surgery(
            NULL,
            $_POST['doctor_id'],
            $_POST['patient_id'],
            $_POST['room_number'],
            $_POST['date'],
            $_POST['description'],
            $_POST['surgery_price']
        );
        $surgeryC->addSurgery($surgery);
        header('Location: listSurgeries.php');
    } else
        $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Surgery</title>
    <style>
        body {
            background-color: #c0c0c0;
            font-family: 'Nunito', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #2b2d42;
        }

        .bigger-input {
            width: 300px;
            height: 100px;
        }
        
        input[type="text"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #4f988d;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #2b2d42;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2b2d42;
        }

        p {
            color: #2b2d42;
            margin-top: 10px;
        }
    </style>
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>
<body>
<div class="container">
        <header class="nav-down">
            <p>Admin Dashboard - Welcome <?php echo $_SESSION["username"] ?></p>

        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            <?php if ($_SESSION['type'] == 'admin') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="ListFeedback.php">List Feedback</a>
                <a href="ListUsers.php">List Users</a>
                <a href="listDoctors.php">List Doctors</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="add_medicines.php">Manage medicines</a>
                <a href="medicines_list.php">View medicines</a>
                <div class="nurseSelect-div">
                    <select onchange="location = this.value;" class="nurseSelect">
                        <option value="Nurses" class="nurseSelect-option">Nurses Options</option>
                        <option value="listNurse.php" class="nurseSelect-option">List Nurses</option>
                        <option value="listShift.php" class="nurseSelect-option">List Nurses Shift</option>
                        <option value="listMedcare.php" class="nurseSelect-option">List Medical care</option>
                        <option value="listnursemed.php" class="nurseSelect-option">List Nurses Medical Care</option>
                        <option value="addMedcare.php" class="nurseSelect-option">Add Medical care</option>
                        <option value="addNurse.php" class="nurseSelect-option">Add Nurse</option>
                        <option value="addshift.php" class="nurseSelect-option">Assign Shift to Nurse</option>
                        <option value="addnursemed.php" class="nurseSelect-option">Assign Nurse to Med Care</option>
                    </select>
                </div>
                <a href="listBills.php">List Bills</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } elseif($_SESSION['type'] == 'doctor') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="medicines_list.php">View medicines</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } ?>

        </div>
    </div>
    <div class="main">
        <form method="POST" action="" onsubmit="return validate()">
            <table>
                <tr>
                    <td><label for="doctor_id">Doctor ID</label></td>
                    <td><select name="doctor_id" id="doctor_id">
                        <option value="" disabled selected>Select a doctor</option>
                        <?php
                        foreach ($doctorC->listDoctors() as $doctor) {
                            echo "<option value='" . $doctor['doctor_id'] . "'>" . $doctor['doctor_id'] . " - " . $doctor['first_name'] . " " . $doctor['last_name'] . "</option>";
                        }
                        ?>
                    </select></td>
                <tr>
                    <td><label for="patient_id">Patient ID</label></td>
                    <td><select name="patient_id" id="patient_id">
                        <option value="" disabled selected>Select a patient</option>
                        <?php
                        foreach ($patientC->listPatients() as $patient) {
                            echo "<option value='" . $patient['patient_id'] . "'>" . $patient['patient_id'] . " - " . $patient['first_name'] . " " . $patient['last_name'] . "</option>";
                        }
                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="room_number">Room Number</label></td>
                    <td><select name="room_number" id="room_number">
                        <option value="" disabled selected>Select a room</option>
                        <?php
                        foreach ($roomC->listRooms() as $room) {
                            echo "<option value='" . $room['room_number'] . "'>" . $room['room_number'] . " - " . $room['status'] . "</option>";
                        }
                        ?>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="date">Date</label></td>  <td><input type="date" name="date" id="date"></td>
                </tr>
                <tr>
                    <td><label for="description">Description</label></td>  <td><input type="text" name="description" id="description"></td>
                </tr>
                <tr>
                    <td><label for="surgery_price">Surgery Price</label></td>  <td><input type="text" name="surgery_price" id="surgery_price"></td>
                </tr>
                <tr>
                    <td colspan="4"><input type="submit" value="Validate"></td>
                </tr>
            </table>
        </form>
        <p align="center"><?php echo $error; ?></p>
    </div>
    <script>
        function validate() {
            clearErrorMessages();
            var idD = document.getElementById("doctor_id");
            var idP = document.getElementById("patient_id");
            var rn = document.getElementById("room_number");
            var pr = document.getElementById("surgery_price");
            if (validatePr(pr)) {
                return true;
            }
            else
                return false;
        }
        function clearErrorMessages() {
            var errorMessages = document.querySelectorAll("span");
            for (var i = 0; i < errorMessages.length; i++) {
                errorMessages[i].remove();
            }
        }

        // event listener khir
        function validatePr(pr) {
            if (isNaN(pr.value)) {
                pr.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect price</span>"); // display error message
                return false;
            }
            return true;
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../scripts/navbar.js"></script>
</body>
</html>
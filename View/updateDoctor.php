<?php
include '../Controller/DoctorController.php';
include '../Model/Doctor.php';
$error = "";
$doctor = null;

// create an instance of the controller
$doctorC = new DoctorC();
if (
    isset($_POST["doctor_id"]) &&
    isset($_POST["speciality"]) &&
    isset($_POST["schedule"]) &&
    isset($_POST["room_number"]))
{
    if (
        !empty($_POST["doctor_id"]) &&
        !empty($_POST["speciality"]) &&
        !empty($_POST["schedule"]) &&
        !empty($_POST["room_number"]))
    {
        $doctor = new doctor(
            $_POST['doctor_id'],
            $_POST['speciality'],
            $_POST['schedule'],
            $_POST['room_number']);
        $doctorC->updateDoctor($doctor);
        header('Location: listDoctors.php');
    } else
        $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Doctor</title>
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
    <link rel="stylesheet" href="../navbar.css">
</head>
    <body>
    <div class="container">
            <header class="nav-down">
                <p>Admin Dashboard</p>
            </header>
            <!-- Side navigation -->
            <div class="sidenav">
                        
                <a href="#">List Feedback</a>
                <a href="#">List Users</a>
                <a href="listDoctors.php">Add Doctor</a>
                <a href="#">Add Nurse</a>
                <a href="listSurgeries.php">Add Surgery</a>
            </div>
    </div>
    <div class="main">
        <form method = "POST" action = "" onsubmit="return validate()">
            <table>
                <tr>
                    <td><label for="doctor_id">Doctor Id</label></td>  <td><input type="text" name="doctor_id" id="doctor_id" value="<?php echo $_GET["doctor_id"]?>"></td>
                </tr>
                <tr>
                    <td><label for="speciality">Speciality</label></td>   <td><input type="text" name="speciality" id="speciality" value="<?php echo $_GET["speciality"]?>"></td>
                </tr>
                <tr>
                    <td><label for="schedule">Schedule</label></td>   <td><input type="text" name="schedule" id="schedule" value="<?php echo $_GET["schedule"]?>" readonly></td>
                </tr>
                <tr>
                    <td><label for="room_number">Room Number</label></td>              <td><input type="text" name="room_number" id="room_number" value="<?php echo $_GET["room_number"]?>"></td>
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
            var id = document.getElementById("doctor_id");
            var sp = document.getElementById("speciality");
            var rn = document.getElementById("room_number");
            if (validateid(id) && validateRN(rn) && validateSp(sp)) {
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

        function validateid(id) {
            if (id.value.length != 4) { // test the value of the input 
                id.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect id</span>"); // display error message
                return false;
            }
            return true;
        }

        function validateSp(sp){
            for (var i = 0; i < sp.value.length; i++) {
                if (sp.value[i].toUpperCase() > 'Z' || sp.value[i].toUpperCase() < 'A') {
                    sp.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect speciality</span>"); // display error message
                    return false;
                }
            }
            return true;
        }

        function validateRN(rn) {
            
            if (rn.value.length != 4) { // test the value of the input 
                rn.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect room number</span>"); // display error message
                return false;
            } 
            return true;
        }  
    </script>
    </body>
</html>

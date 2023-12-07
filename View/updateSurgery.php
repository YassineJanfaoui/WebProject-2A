<?php
include '../Controller/SurgeryController.php';
include '../Model/Surgery.php';
$error = "";
$surgery = null;

// create an instance of the controller
$surgeryC = new SurgeryC();
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
            $_GET['surgery_id'],
            $_POST['doctor_id'],
            $_POST['patient_id'],
            $_POST['room_number'],
            $_POST['date'],
            $_POST['description'],
            $_POST['surgery_price']
        );
        $surgeryC->updateSurgery($surgery);
        header('Location: listSurgeries.php');
    } else
        $error = "Missing information";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Surgery</title>
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
            width: 300px:
            height: 100px:
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
        <form method="POST" action="" onsubmit="return validate()">
            <table>
                <tr>
                    <td><label for="doctor_id">Doctor Id</label></td>  <td><input type="text" name="doctor_id" id="doctor_id"></td>
                </tr>
                <tr>
                    <td><label for="patient_id">Patient Id</label></td>  <td><input type="text" name="patient_id" id="patient_id"></td>
                </tr>
                <tr>
                    <td><label for="room_number">Room Number</label></td>  <td><input type="text" value="<?php echo $room ?>" name="room_number" id="room_number"></td>
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
            if (validateId(idD) && validateid(idP) && validateRN(rn) && validatePr(pr)) {
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

        function validateId(idD) {
            if (idD.value.length != 4) { // test the value of the input 
                idD.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect id</span>"); // display error message
                return false;
            }
            return true;
        }

        function validateid(idP){
            if (idP.value.length != 4) { // test the value of the input 
                idP.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect id</span>"); // display error message
                return false;
            }
            return true;
        }

        function validateRN(rn) {
            
            if (rn.value.length != 4 && rn.value != "No room available") { // test the value of the input 
                rn.insertAdjacentHTML("afterend", "<span style='color:red;'>Incorrect room number</span>"); // display error message
                return false;
            }
            return true;
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
    <script src="../navbar.js"></script>
</body>
</html>
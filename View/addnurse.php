<?php
include '../Controller/NurseC.php';
include '../Model/Nurse.php';
$error = "";
$nurse = null;

//create an instance of the controller
$NurseC = new NurseCont();
if (
    isset($_POST["nurse_id"]) &&
    isset($_POST["first_name"]) &&
    isset($_POST["last_name"]) &&
    isset($_POST["department"]) &&
    isset($_POST["phone_number"]) &&
    isset($_POST["email"]) &&
    isset($_POST["hire_date"])
)
{
    if (
        !empty($_POST["nurse_id"]) &&
        !empty($_POST["first_name"]) &&
        !empty($_POST["last_name"]) &&
        !empty($_POST["department"]) &&
        !empty($_POST["phone_number"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["hire_date"]) 
    )
    {
        $nurse = new nurse(
            $_POST['nurse_id'],
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['department'],
            $_POST['phone_number'],
            $_POST['email'],
            $_POST['hire_date'],
        );
        $NurseC->addnurse($nurse);
        header('Location:listNurse.php');
    }
    else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nurse</title>
    <link rel="stylesheet" href="../styles/styleAddNurse.css" />
    <link rel="stylesheet" href="../styles/navbar.css" />
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
            <a href="listNurse.php">List Nurses</a>
            <a href="listShift.php">List Nurses Shift</a>
            <a href="listMedcare.php">List Medical care</a>
            <a href="addMedcare.php">Add Medical care</a>
            <a href="#">Add Doctor</a>
            <a href="addnurse.php">Add Nurse</a>
            <a href="addshift.php">Assign Shift to Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
        </div>
    </div>
    <div class="main">
        <h1><b>Nurse</b></h1> </br>
        <h2>Add nurse</h2></br>
        <hr>
        <div id="error">
            <?php echo $error; ?>
        </div>
    <center>
        
        <form action="" method="POST">
            <div class="row">
                <div class="col-25">
                <label for="nurse id" class="Input_title">Nurse ID:</label><br />
                </div>
                <div class="col-75">
                <input type="number" name="nurse_id" class="input_box" placeholder="Nurse ID here" id="nurse_id" required/><br />
                <span id="nurse_id_msg" class="error2"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="firstname" class="Input_title">First Name:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="first_name" class="input_box" placeholder="First Name here" id="first_name" required/><br />
                </div>
            </div>
            <span id="care_id_msg" class="error"></span>

            <div class="row">
                <div class="col-25">
                <label for="lastname" class="Input_title">Last Name:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="last_name" class="input_box" placeholder="Last Name here" id="last_name" required/><br />
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="phonenumber" class="Input_title">Phone Number:</label><br />
                </div>
                <div class="col-75">
                <input type="number" name="phone_number" class="input_box" placeholder="Phone Number here" id="phone_number" required/><br />
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="email" class="Input_title">Email:</label><br />
                </div>
                <div class="col-75">
                <input type="text" name="email" class="input_box" placeholder="Email here" id="email" required/><br />
                <span id="erreurEmail" style="color: red"></span>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="department" class="Input_title">Deparment</label>
                </div>
                <div class="col-75">
                    <select id="shift" name="department">
                    <option value="General">General</option>
                    <option value="Pediatric">Pediatric</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Neurology">Neurology</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <label for="hiredate" class="Input_title">Hire Date:</label><br />
                </div>
                <div class="col-75">
                <input type="date" name="hire_date" min="2023-0&-01" max="2024-12-30" class="input_box" id="hire_date" required/><br />
                </div>
            </div>



             <input type="submit" class="submit" value="Save">
             <input type="reset" class="submit"  value="Reset">
             
        </form>
        <script src="../scripts/NurseControl.js"></script>
    </center>
</body>

<script src="navbar.js"></script>
</html>
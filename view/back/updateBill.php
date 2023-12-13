<?php
session_start();
include '../../controller/billmanagement.php';
include '../../model/billinfo.php';
$error = "";
$b = new BillManagement();

if (
    isset($_POST["consultation_price"]) &&
    isset($_POST["surgery_price"]) &&
    isset($_POST["total_stay_price"]) &&
    isset($_POST["medication_cost"])
) {
    /*if (
        !empty($_POST["consultation_price"]) &&
        !empty($_POST["surgery_price"]) &&
        !empty($_POST["total_stay_price"]) &&
        !empty($_POST["medication_cost"])
    ) {*/
        

        $b->modifyBill(
            $_GET["bill_id"],
            $_POST["consultation_price"],
            $_POST["surgery_price"],
            $_POST["total_stay_price"],
            $_POST["medication_cost"],
        );

        header('Location: listBills.php');
        exit(); 
    /*} else {
        $error = "Missing information";
    }*/
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update a bill</title>
    <link rel="stylesheet" href="../../Assets/CSS Styles/addBill.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
    <script lang="javascript" src="../../Assets/JavaScript Scripts/updatebill.js"></script>
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

    <main style="margin-top:10%;margin-left:25%">
        <a href="listBills.php">Check Clinic Bill History</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form  align="center" action="" method="POST" onsubmit="return letThrough()">
            <label for="consultation_price">Consultation Price :</label>
            <input type="text" id="consultation_price" name="consultation_price" value="<?php echo $_GET["consultation_price"]?>"><br>
            <label for="surgery_price">Surgery Price :</label>
            <input type="text" id="surgery_price" name="surgery_price" value="<?php echo $_GET["surgery_price"]?>"><br>
            <label for="total_stay_price">Total Stay Price :</label>
            <input type="text" id="total_stay_price" name="total_stay_price" value="<?php echo $_GET["total_stay_price"]?>"><br>
            <label for="medication_cost">Medication Cost :</label>
            <input type="text" id="medication_cost" name="medication_cost" value="<?php echo $_GET["medication_cost"]?>"><br>
            
            <button type="submit">Submit</button>
        </form>
    </main>
    
</body>
</html>
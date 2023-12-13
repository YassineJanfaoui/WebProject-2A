<?php
session_start();
include '../../controller/equipmentmanagement.php';
include '../../model/equipmentinfo.php';

$error = "";

$equipmentManager = new EquipmentManagement();

if (isset($_POST["eq_name"])) {
    if (!empty($_POST['eq_name'])) {
        $eq_name = $_POST['eq_name'];

        $eq_quantity = isset($_POST['eq_quantity']) ? $_POST['eq_quantity'] : 0;
        $eq_purchase_price = isset($_POST['eq_purchase_price']) ? $_POST['eq_purchase_price'] : 0;
        $eq_purchase_history = isset($_POST['eq_purchase_history']) ? $_POST['eq_purchase_history'] : null;

        $equipmentManager->addEquipment($eq_name, $eq_quantity, $eq_purchase_price, $eq_purchase_history);
        header('Location: listequipments.php');
        exit();
    } else {
        $error = "Equipment Name is required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Equipment</title>
    <link rel="stylesheet" href="../../Assets/CSS Styles/addEquipment.css">
    <script src="../../Assets/JavaScript Scripts/formValidation.js"></script>
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
    <link rel="stylesheet" href="../../styles/navbar.css" />
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
        <h1>Add Equipment</h1>
        <a href="listequipments.php" style="margin-left:10%;">Check Equipment List</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form align="center" action="" method="POST" onsubmit="return validateEquipmentForm()" style="width:80%;margin-left:10%;">
            <label for="eq_name">Equipment Name :</label>
            <input type="text" id="eq_name" name="eq_name">

            <label for="eq_quantity">Quantity :</label>
            <input type="number" id="eq_quantity" name="eq_quantity">

            <label for="eq_purchase_price">Purchase Price :</label>
            <input type="number" id="eq_purchase_price" name="eq_purchase_price">

            <label for="eq_purchase_history">Purchase History :</label>
            <input type="date" id="eq_purchase_history" name="eq_purchase_history">

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
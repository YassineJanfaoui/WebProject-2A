<?php
session_start();
include "../../controller/roomcontroller.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $roomNumber = $_POST["roomNumber"];
    $newStatus = $_POST["newStatus"];
    $newcapacity = $_POST["newcapacity"];
    $newPricePerNight = $_POST["newPricePerNight"];

   
    $updatedRoom = new rooms($roomNumber, $newStatus, $newcapacity, $newPricePerNight);

  
    $roomController = new roomcontroller();


    $roomController->updateRoom($updatedRoom, $roomNumber);

   
    header("Location: listrooms.php"); 
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
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
    <div class="main" style="margin-top:10%;margin-left:25%">
    <h2>Update Room Information</h2>
    <?php
   
    if (isset($_GET["roomNumber"])) {
        $roomNumber = $_GET["roomNumber"];

       
        $roomController = new roomcontroller();

        
        $currentRoom = $roomController->showRoom($roomNumber);

       
        if ($currentRoom) {
            ?>
            <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <input type="hidden" name="roomNumber" value="<?php echo $currentRoom['room_number']; ?>">


                <label for="newcapacity">newcapacity:</label>
                <input type="text" name="newcapacity" value="<?php echo $currentRoom['capacity']; ?>" required><br>

                <label for="newStatus">New Status:<?php echo " now is: ".$currentRoom['status']; ?></label><br>
                <!--<input type="text" name="newStatus" value="" required><br>-->
                <select name="newStatus" id="status">
                            <option value="empty">empty</option>
                            <option value="full">full</option>
                            <option value="non-empty">non-empty</option>
                        </select><br>

                <label for="newPricePerNight">New Price Per Night:</label>
                <input type="number" name="newPricePerNight" value="<?php echo $currentRoom['price_per_night']; ?>" required><br>



                <input type="submit" value="Update Room">
            </form>
            <?php
        } else {
            echo "Room not found.";
        }
    } else {
        echo "Room number not provided.";
    }
    ?>
    </div>
</body>
</html>

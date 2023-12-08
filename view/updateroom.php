<?php
include "../controller/roomcontroller.php";

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
</head>
<body>
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

                <label for="newStatus">New Status:</label>
                <input type="text" name="newStatus" value="<?php echo $currentRoom['status']; ?>" required><br>

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
</body>
</html>

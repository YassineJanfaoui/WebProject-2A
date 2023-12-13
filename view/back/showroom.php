<?php
session_start();
include "../../controller/roomcontroller.php";

$roomInfo = null; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $roomNumber = $_POST["room_number"];

    
    if (is_numeric($roomNumber)) {
      
        $roomsController = new roomcontroller();

        $roomInfo = $roomsController->showRoom($roomNumber);
    } else {
     
        echo "Invalid room number. Please enter a numeric value.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Room Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #2B2D42;
        }

        h2 {
            color: #4F988D;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #2B2D42;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #2B2D42;
        }

        input[type="submit"] {
            background-color: #4F988D;
            color: #f4f4f4;
            cursor: pointer;
        }

        h3 {
            color: #4F988D;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <h2>Enter Room Number to Display Information</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="room_number">Room Number:</label>
        <input type="text" name="room_number" id="room_number" required>
        <input type="submit" value="Display Information">
    </form>

    <?php
    // Display room information if available
    if ($roomInfo) {
        echo "<h3>Room Information:</h3>";
        echo "Room Number: " . $roomInfo['room_number'] . "<br>";
        echo "Status: " . $roomInfo['status'] . "<br>";
        echo "capacity: " . $roomInfo['capacity'] . "<br>";
        echo "Price Per Night: " . $roomInfo['price_per_night'] . "<br>";
    }
    ?>

</body>

</html>

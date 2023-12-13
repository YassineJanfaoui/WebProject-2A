<?php
session_start();
include '../../Controller/roomcontroller.php';


$error = "";


$room = null;


$roomcontroller = new roomcontroller();

if (
    isset($_POST["room_number"]) &&
    isset($_POST["status"]) &&
    isset($_POST["capacity"]) &&
    isset($_POST["price_per_night"])
) {
    if (
        !empty($_POST["room_number"]) &&
        !empty($_POST["status"]) &&
        !empty($_POST["capacity"]) &&
        !empty($_POST["price_per_night"])
    ) {
        $room = new rooms(
            $_POST["room_number"],
            $_POST["status"],
            $_POST["capacity"],
            $_POST["price_per_night"]
        );
        $roomcontroller->addRoom($room);
        header('Location: successmessage2.php');
    } else {
        $error = "Missing information";
    }
}

?>
<html lang="en">

<head>

</head>
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
        <a href="listrooms.php" style="text-decoration: none; color: #2B2D42;">Back to List</a>
        <hr>

        <h1>Add Room</h1>

        <div id="error"><?php echo $error; ?></div>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="room_number">Room Number:</label></td>
                    <td>
                        <input type="number" id="room_number" name="room_number" pattern="[1-9][0-9]*" min="1" />
                        <span id="erreurRoomNumber" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="status">Status:</label></td>
                    <td>
                        <select name="status" id="status">
                            <option value="empty">empty</option>
                            <option value="full">full</option>
                            <option value="non-empty">non-empty</option>



                        </select>
                        <span id="erreurStatus" style="color: red"></span>
                    </td>
                </tr>

                <tr>
                    <td><label for="capacity">capacity:</label></td>
                    <td>
                        <input type="number" id="capacity" name="capacity" min="0" max="3" required />
                        <span id="erreurcapacity" style="color: red"></span>
                    </td>
                </tr>


                <tr>
                    <td><label for="price_per_night">Price Per Night:</label></td>
                    <td>
                        <input type="number" id="price_per_night" name="price_per_night" pattern="[1-9][0-9]*" min="1" required />
                        <span id="erreurPricePerNight" style="color: red"></span>
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
    </div>
</body>

</html>
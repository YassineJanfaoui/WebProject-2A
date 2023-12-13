<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
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
        .success-message {
            color: #333333;
            font-size: 18px;
            margin-bottom: 30px;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            color: #ffffff;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }
        .button-show-list {
            background-color: #4F988D;
        }
        .button-add-patient {
            background-color: #2B2D42;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Success!</h1>
        <p class="success-message">Your request was successful.</p>
        <div class="button-container">
        <a href="listpatient.php" class="button button-show-list">Show List of Patients</a>
            <a href="addPatient.php" class="button button-add-patient">Add New Patient</a>
        </div>
    </div>
</body>
</html>

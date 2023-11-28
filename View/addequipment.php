<?php
include '../Control/equipmentmanagement.php'; 
include '../Model/equipmentinfo.php'; 

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
    <link rel="stylesheet" href="../Assets/CSS Styles/addEquipment.css">
    <script src="../Assets/JavaScript Scripts/formValidation.js"></script>
</head>
<body>
    <header>
        <h1>Add Equipment</h1>
    </header>

    <main>
        <a href="listequipments.php">Check Equipment List</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form align="center" action="" method="POST" onsubmit="return validateEquipmentForm()">
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
    </main>
</body>
</html>

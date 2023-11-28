<?php
include '../Control/equipmentmanagement.php'; 
include '../Model/equipmentinfo.php';

$error = "";
$equipment = null;
$equipmentManager = new EquipmentManagement();

if (
    isset($_POST["eq_name"]) &&
    isset($_POST["eq_quantity"]) &&
    isset($_POST["eq_purchase_price"]) &&
    isset($_POST["eq_purchase_history"])
) {
    if (
        !empty($_POST["eq_name"]) &&
        !empty($_POST["eq_quantity"]) &&
        !empty($_POST["eq_purchase_price"]) &&
        !empty($_POST["eq_purchase_history"])
    ) {
        $equipment = new Equipment(
            $_GET["eq_id"],
            $_POST["eq_name"],
            $_POST["eq_quantity"],
            $_POST["eq_purchase_price"],
            $_POST["eq_purchase_history"]
        );

        $equipmentManager->modifyEquipment(
            $_GET["eq_id"],
            $equipment->getEquipmentName(),
            $equipment->getQuantity(),
            $equipment->getPurchasePrice(),
            $equipment->getPurchaseHistory()
        );

        header('Location: listEquipments.php');
        exit();
    } else {
        $error = "Missing information";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Equipment</title>
    <link rel="stylesheet" href="../Assets/CSS Styles/addEquipment.css"> 
    <script src="../Assets/JavaScript Scripts/formValidation.js"></script>
</head>
<body>

    <header>
        <h1>Update Equipment</h1>
    </header>

    <main>
        <a href="listequipments.php">Check Equipment List</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form align="center" action="" method="POST" onsubmit="return validateEquipmentForm()">

            <label for="eq_name">Equipment Name :</label>
            <input type="text" id="eq_name" name="eq_name" required><br>
            
            <label for="eq_quantity">Quantity :</label>
            <input type="text" id="eq_quantity" name="eq_quantity"><br>
            
            <label for="eq_purchase_price">Purchase Price :</label>
            <input type="text" id="eq_purchase_price" name="eq_purchase_price"><br>
            
            <label for="eq_purchase_history">Purchase History :</label>
            <input type="date" id="eq_purchase_history" name="eq_purchase_history"><br>
            
            <button type="submit">Submit</button>
        </form>
    </main>
    
</body>
</html>

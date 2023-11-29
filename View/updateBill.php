<?php
include '../Control/billmanagement.php';
include '../Model/billinfo.php';
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
    <link rel="stylesheet" href="../Assets/CSS Styles/addBill.css">
    <script lang="javascript" src="../Assets/JavaScript Scripts/updatebill.js"></script>
</head>
<body>

    <header>
        <h1>Update a bill</h1>
    </header>

    <main>
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
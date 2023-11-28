<?php
include '../Control/billmanagement.php';
include '../Model/billinfo.php';
//changes
$error = "";

$b = new BillManagement();

if (isset($_POST["id_patient"])) {
    if (!empty($_POST['id_patient'])) {
        $id_patient = $_POST['id_patient'];

        
        if (is_numeric($id_patient)) {
            $b->addBill($id_patient);
            header('Location: listBills.php');
            exit(); 
        } else {
            $error = "Invalid patient ID format";
        }
    } else {
        $error = "Patient ID is required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a bill</title>
    <link rel="stylesheet" href="../Assets/CSS Styles/addBill.css">
</head>
<body>
    <header>
        <h1>Add a bill</h1>
    </header>

    <main>
        <a href="listBills.php">Check Clinic Bill History</a>
        <hr>

        <div id="error">
            <?php echo $error; ?>
        </div>

        <form align="center" action="" method="POST">
            <label for="patient_id">Patient ID :</label>
            <input type="text" id="patient_id" name="id_patient">
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>


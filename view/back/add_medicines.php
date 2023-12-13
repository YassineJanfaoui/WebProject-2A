<?php
session_start();
// view/add_medicines.php
require_once '../../controller/medicines_controller.php';
require_once '../../model/medicines_model.php';

$errors = [];
$medicineDetails = null;
$response = handleFormSubmission();
$errors = $response['errors'];
$successMessage = $response['successMessage'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $errors = updateMedicine();
    } elseif (isset($_POST['delete'])) {
        $errors = deleteMedicine();
    } else {
        addMedecine($_POST['name'], $_POST['quantity'], $_POST['purchase_price'], $_POST['selling_price']);
    }
}

// Check if an ID is passed to edit a medicine
if (isset($_GET['id'])) {
    $medicineModel = new MedicineModel();
    $medicineDetails = $medicineModel->getMedicineById($_GET['id']);
}
else
{
    $medicineDetails = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="../../assets/css/styles.css" />
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

    <div class="main-content">
        <!-- Check for errors -->
        <?php if (!empty($errors)) : ?>
            <div class="error-messages">
                <?php foreach ($errors as $error) : ?>
                    <p><?= htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- The form for adding a medicine -->
        <form action="" method="post" class="form-container">
            <input type="hidden" name="med_id" value="<?= $medicineDetails['med_id'] ?? '' ?>">

            <label for="name">Medicine Name:</label>
            <input type="text" id="name" name="name" value="<?= $medicineDetails['med_name'] ?? '' ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?= $medicineDetails['med_quantity'] ?? '' ?>" required>

            <label for="purchase_price">Purchase Price:</label>
            <input type="number" id="purchase_price" name="purchase_price" value="<?= $medicineDetails['purchase_price'] ?? '' ?>" required>

            <label for="selling_price">Selling Price:</label>
            <input type="number" id="selling_price" name="selling_price" value="<?= $medicineDetails['selling_price'] ?? '' ?>" required>

            <?php if ($medicineDetails) : ?>
                <input type="submit" name="update" value="Update">
            <?php else : ?>
                <input type="submit" name="add" value="Add Medicine">
            <?php endif; ?>

            <?php if ($medicineDetails) : ?>
                <form action="add_medicines.php" method="post">
                    <input type="hidden" name="med_id" value="<?= htmlspecialchars($medicineDetails['med_id']); ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            <?php endif; ?>
        </form>

    </div>

</body>

</html>
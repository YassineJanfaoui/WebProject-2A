<?php
// view/add_medicines.php
require_once '../controller/medicines_controller.php';
require_once '../model/medicines_model.php';

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
        $response = handleMedicineAddition();
        $errors = $response['errors'];
        $successMessage = $response['successMessage'];
    }
}

// Check if an ID is passed to edit a medicine
if (isset($_GET['id'])) {
    $medicineModel = new MedicineModel();
    $medicineDetails = $medicineModel->getMedicineById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>

<body>
    <div class="navbar">
        <ul>
            <li><a href="add_medicines.php">Manage medicines</a></li>
            <li><a href="medicines_list.php">View medicines</a></li>
            <li><a href="consultations_scheduling.php">Consultations</a></li>
        </ul>
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
        <form action="add_medicines.php" method="post" class="form-container">
            <input type="hidden" name="med_id" value="<?= $medicineDetails['med_id'] ?? '' ?>">

            <label for="name">Medicine Name:</label>
            <input type="text" id="name" name="name" value="<?= $medicineDetails['med_name'] ?? '' ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?= $medicineDetails['med_quantity'] ?? '' ?>" required>

            <label for="purchase_price">Purchase Price:</label>
            <input type="number" id="purchase_price" name="purchase_price" value="<?= $medicineDetails['purchase_price'] ?? '' ?>" required>

            <label for="selling_price">Selling Price:</label>
            <input type="number" id="selling_price" name="selling_price" value="<?= $medicineDetails['selling_price'] ?? '' ?>" required>
           
            <?php if ($medicineDetails): ?>
                <input type="submit" name="update" value="Update">
            <?php else: ?>
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
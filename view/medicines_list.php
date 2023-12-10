<?php
require_once '../controller/medicines_controller.php';
require_once '../model/medicines_model.php';

$medicineModel = new MedicineModel();
$itemsPerPage = 15;
$totalMedicines = $medicineModel->getTotalMedicinesCount();
$totalPages = ceil($totalMedicines / $itemsPerPage);

// Get the current page number from the query string
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Ensure page is at least 1
$page = min($page, $totalPages); // Ensure page doesn't exceed $totalPages

$medicines = $medicineModel->getMedicinesPaginated($page, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
    <link rel="stylesheet" href="../assets/css/styles.css" />
    <style>
        /* Overriding main-content style for this page */
        .main-content {
            justify-content: flex-start;
            padding-top: 50px;
            /* Aligns content to the top */
        }
    </style>
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
        <h1>Medicine List</h1>
        <table class="medicine-table"">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Purchase Price</th>
                    <th>Selling Price</th>
                </tr>
            </thead>
            
            <tbody>
            <?php foreach ($medicines as $medicine) : ?>
            <tr>
                <td><?= htmlspecialchars($medicine['med_id']); ?></td>
                <td><a href=" add_medicines.php?id=<?= htmlspecialchars($medicine['med_id']); ?>"><?= htmlspecialchars($medicine['med_name']); ?></a></td>
            <td><?= htmlspecialchars($medicine['med_quantity']); ?></td>
            <td><?= htmlspecialchars($medicine['purchase_price']); ?></td>
            <td><?= htmlspecialchars($medicine['selling_price']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
        <div id="paginator">
            <a class="pagination-link" href="?page=<?php echo max(1, $page - 1); ?>">&lt;</a>
            <span class="current-page">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>
            <a class="pagination-link" href="?page=<?php echo min($page + 1, $totalPages); ?>">&gt;</a>
        </div>
    </div>
</body>

</html>
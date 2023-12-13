<?php
// controller/medicines_controller.php
require_once '../../model/medicines_model.php';
require_once '../../config.php';

function addMedecine($name, $quantity, $purchase_price, $selling_price)
{
    $db = config::getConnexion();
    $sql = "INSERT INTO medicines (med_name, med_quantity, purchase_price, selling_price,purchase_history) VALUES (:name, :quantity, :purchase_price, :selling_price,:purchase_history)";
    $date = date("Y-m-d");
    $query = $db->prepare($sql);
    $query->bindValue(':name', $name);
    $query->bindValue(':quantity', $quantity);
    $query->bindValue(':purchase_price', $purchase_price);
    $query->bindValue(':selling_price', $selling_price);
    $query->bindValue(':purchase_history', $date);
    try {
        $query->execute();
    } catch (PDOException $e) {
        die('Error:' . $e->getMessage());
    }

}
function handleFormSubmission()
{
    $medicineModel = new MedicineModel();
    $errors = [];
    $successMessage = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['add'])) {
            // Adding a new medicine
            $errors = handleMedicineAddition();
            if (empty($errors)) {
                $successMessage = "Medicine added successfully.";
            }
        } elseif (isset($_POST['update'])) {
            // Updating an existing medicine
            $errors = updateMedicine();
            if (empty($errors)) {
                $successMessage = "Medicine updated successfully.";
            }
        } elseif (isset($_POST['delete'])) {
            // Deleting a medicine
            $errors = deleteMedicine();
            if (empty($errors)) {
                $successMessage = "Medicine deleted successfully.";
            }
        }
    }

    return ['errors' => $errors, 'successMessage' => $successMessage];
}

function handleMedicineAddition()
{
    $medicineModel = new MedicineModel();
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST['name']);
        $quantity = trim($_POST['quantity']);
        $purchase_price = trim($_POST['purchase_price']);
        $selling_price = trim($_POST['selling_price']);

        // Validation checks
        if ($medicineModel->doesMedicineExist($name)) {
            $errors[] = "A medicine with this name already exists.";
        }

        if (empty($name)) {
            $errors[] = "Medicine name is required.";
        } elseif (!preg_match("/[a-zA-Z]+/", $name)) {
            $errors[] = "Medicine name must include at least one letter.";
        }

        if (empty($quantity) || $quantity < 0) {
            $errors[] = "Quantity cannot be empty or negative.";
        }

        if (empty($purchase_price) || $purchase_price < 0) {
            $errors[] = "Purchase price cannot be empty or negative.";
        }

        if (empty($selling_price) || $selling_price < 0) {
            $errors[] = "Selling price cannot be empty or negative.";
        }

        if (empty($errors)) {
            $result = $medicineModel->addMedicine($name, $quantity, $purchase_price, $selling_price);

            if ($result) {
                header("Location: medicines_list.php");
                exit();
            } else {
                $errors[] = "There was a problem adding the medicine.";
            }
        }
    }

    return $errors;
}


function updateMedicine()
{
    $medicineModel = new MedicineModel();
    $errors = [];

    if (isset($_POST['update'])) {
        // Retrieve form data
        $id = $_POST['med_id'];
        $name = trim($_POST['name']);
        $quantity = trim($_POST['quantity']);
        $purchase_price = trim($_POST['purchase_price']);
        $selling_price = trim($_POST['selling_price']);

        if (empty($name)) {
            $errors[] = "Medicine name is required.";
        } elseif (!preg_match("/[a-zA-Z]+/", $name)) {
            $errors[] = "Medicine name must include at least one letter.";
        }

        if (empty($quantity) || $quantity < 0) {
            $errors[] = "Quantity cannot be negative.";
        }

        if (empty($purchase_price) || $purchase_price < 0) {
            $errors[] = "Purchase price cannot be empty or negative.";
        }

        if (empty($selling_price) || $selling_price < 0) {
            $errors[] = "Selling price cannot be empty or negative.";
        }

        if (empty($errors)) {
            $result = $medicineModel->updateMedicine($id, $name, $quantity, $purchase_price, $selling_price);

            if ($result) {
                // Success logic, like redirecting to medicines list
                header("Location: medicines_list.php");
                exit;
            } else {
                $errors[] = "There was a problem updating the medicine.";
            }
        }
    }

    return $errors;
}

function deleteMedicine()
{
    $medicineModel = new MedicineModel();
    $errors = [];

    if (isset($_POST['delete'])) {
        $id = $_POST['med_id'];

        $result = $medicineModel->deleteMedicine($id);

        if ($result) {
            // Success logic, like redirecting to medicines list
            header("Location: medicines_list.php");
            exit;
        } else {
            $errors[] = "There was a problem deleting the medicine.";
        }
    }

    return $errors;
}

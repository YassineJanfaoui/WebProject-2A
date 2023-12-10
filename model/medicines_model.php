<?php

require_once '../config/config.php';
$errors = handleMedicineAddition();

class MedicineModel
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = config::getConnection();
    }

    public function addMedicine($name, $quantity, $purchase_price, $selling_price)
    {
        $purchase_history = date('Y-m-d H:i:s'); // Current date and time

        try {
            $sql = "INSERT INTO medicines (med_name, med_quantity, purchase_price, selling_price, purchase_history) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$name, $quantity, $purchase_price, $selling_price, $purchase_history]);
        } catch (PDOException $e) {
            // Handle error
            return false;
        }
    }

    public function doesMedicineExist($name)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM medicines WHERE med_name = ?");
        $stmt->execute([$name]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function getAllMedicines()
    {
        $stmt = $this->pdo->query("SELECT * FROM medicines");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMedicineById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM medicines WHERE med_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMedicine($id, $name, $quantity, $purchase_price, $selling_price)
    {
        $sql = "UPDATE medicines SET med_name = ?, med_quantity = ?, purchase_price = ?, selling_price = ? WHERE med_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $quantity, $purchase_price, $selling_price, $id]);
    }

    public function deleteMedicine($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM medicines WHERE med_id = ?");
        return $stmt->execute([$id]);
    }

    public function getMedicinesPaginated($page, $itemsPerPage = 15)
    {
        $offset = ($page - 1) * $itemsPerPage;
        $sql = "SELECT * FROM medicines LIMIT :offset, :itemsPerPage";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalMedicinesCount()
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM medicines");
        return $stmt->fetchColumn();
    }
}

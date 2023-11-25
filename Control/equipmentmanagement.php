<?php
require '../config.php';

class EquipmentManagement {
    public function listEquipment() {
        $sql = "SELECT * FROM equipment";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            return $list;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addEquipment($eq_name, $eq_quantity, $eq_purchase_price, $eq_purchase_history) {
        $db = config::getConnexion();
        $sql = "INSERT INTO equipment (eq_name, eq_quantity, eq_purchase_price, eq_purchase_history) 
                VALUES (:eq_name, :eq_quantity, :eq_purchase_price, :eq_purchase_history)";
        $query = $db->prepare($sql);
        $query->bindValue(':eq_name', $eq_name);
        $query->bindValue(':eq_quantity', $eq_quantity);
        $query->bindValue(':eq_purchase_price', $eq_purchase_price);
        $query->bindValue(':eq_purchase_history', $eq_purchase_history);
        try {
            $query->execute();
        } catch (Exception $e) {
            echo "ERROR" . $e->getMessage();
        }
    }

    public function removeEquipment($eq_id) {
        $db = config::getConnexion();
        $sql = "DELETE FROM equipment WHERE eq_id = :eq_id";
        $query = $db->prepare($sql);
        $query->bindValue(':eq_id', $eq_id);
        try {
            $query->execute();
        } catch (Exception $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    public function modifyEquipment($eq_id, $eq_name, $eq_quantity, $eq_purchase_price, $eq_purchase_history) {
        $db = config::getConnexion();
        $sql = "UPDATE equipment SET eq_name = :eq_name, eq_quantity = :eq_quantity, 
                eq_purchase_price = :eq_purchase_price, eq_purchase_history = :eq_purchase_history 
                WHERE eq_id = :eq_id";
        $query = $db->prepare($sql);
        $query->bindValue(':eq_id', $eq_id);
        $query->bindValue(':eq_name', $eq_name);
        $query->bindValue(':eq_quantity', $eq_quantity);
        $query->bindValue(':eq_purchase_price', $eq_purchase_price);
        $query->bindValue(':eq_purchase_history', $eq_purchase_history);
        try {
            $query->execute();
        } catch (Exception $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }
}
?>

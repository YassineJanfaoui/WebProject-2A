<?php
require '../../config.php';

class EquipmentManagement {
    public function listEquipments(){
        $sql = "SELECT * FROM equipment;";
        $db = config::getConnexion();
        $list=$db->prepare($sql);
        try{
            $list->execute();
            $res=$list->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch (Exception $e){
            die('Error: '.$e->getMessage());
        }
    }
    public function howManyEquipmentRows(){
        $sql = "SELECT COUNT(*) AS nb FROM equipment;";
        $db = config::getConnexion();
        
        try {
            $query = $db->query($sql);  
            $value = $query->fetchColumn();  
    
            return $value;
        } catch(Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function showEquipmentByEqId($eq_id) {
        $sql = "SELECT * FROM equipment WHERE eq_id = :eq_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':eq_id', $eq_id);
    
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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
    public function filterMinMax($min,$max){
        $sql="SELECT * FROM equipment WHERE eq_purchase_price BETWEEN :min AND :max;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':min',$min);
        $query->bindValue(':max',$max);
        try{
            $query->execute();
            $res=$query->fetchALL();
            return $res;
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    
}
?>
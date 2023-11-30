<?php 
require '../config.php';
class BillManagement{ 
    public function listBills($nb){
        $sql = "SELECT * FROM billing LIMIT :nb , 4 ;";
        $db = config::getConnexion();
        $list=$db->prepare($sql);
        $list->bindValue(':nb',$nb*4,PDO::PARAM_INT);
        try{
            $list->execute();
            $res=$list->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch (Exception $e){
            die('Error: '.$e->getMessage());
        }
    }
    public function showBillByPatientId($patient_id) {
        $sql = "SELECT * FROM billing WHERE patient_id = :patient_id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':patient_id', $patient_id);
    
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    
    
    }
    public function getIncome() {
        $sql = "SELECT * FROM billing WHERE paid_status=1";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $money = 0; 
            foreach ($result as $content) {
                $money += $content['total_amount'];
            }
            return $money;
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
    }
    
    public function getExpenses() {
        $sql = "SELECT * FROM equipment";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $money = 0; 
            foreach ($result as $content) {
                $money += $content['eq_purchase_price'];
            }
            return $money;
        } catch (PDOException $e) {
            echo "Error" . $e->getMessage();
        }
    }
    
    public function addBill($patient_id){
        $sql="INSERT INTO billing (patient_id, bill_type, consultation_price, surgery_price, total_stay_price, medication_cost, total_amount)
        SELECT
            p.patient_id,
            'Consultation + Surgery' AS bill_type,
            c.consultation_price,
            s.surgery_price,
            r.price_per_night * p.nights_stayed AS total_stay_price,
            COALESCE(SUM(mc.frequency * m.selling_price), 0) AS medication_cost,
            c.consultation_price + s.surgery_price + r.price_per_night * p.nights_stayed + COALESCE(SUM(mc.frequency * m.selling_price), 0) AS total_amount
        FROM consultations c
        JOIN patients p ON c.patient_id = p.patient_id
        JOIN surgeries s ON c.patient_id = s.patient_id
        JOIN rooms r ON s.room_number = r.room_number
        LEFT JOIN medical_care mc ON c.patient_id = mc.patient_id
        LEFT JOIN medicines m ON mc.medicine_id = m.medicine_id
        WHERE c.patient_id = :patient_id
        GROUP BY p.patient_id, c.consultation_price, s.surgery_price, r.price_per_night, p.nights_stayed;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':patient_id',$patient_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "ERROR".$e->getMessage();
        }
    }
    public function removeBill($bill_id){
        $sql = "DELETE FROM billing WHERE bill_id = :bill_id";
        $db = config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':bill_id',$bill_id);

        try{
            $query->execute();
        }
        catch(Exception $e){
            die('ERROR: '.$e->getMessage());

        }
    }
    public function modifyBill($bill_id, $consultation_price, $surgery_price, $total_stay_price, $medication_cost){
        $sql = "UPDATE billing 
                SET consultation_price = :consultation_price,
                    surgery_price = :surgery_price,
                    total_stay_price = :total_stay_price,
                    medication_cost = :medication_cost,
                    total_amount = :consultation_price + :surgery_price + :total_stay_price + :medication_cost
                WHERE bill_id = :bill_id";

        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':bill_id', $bill_id);
        $query->bindValue(':consultation_price', $consultation_price);
        $query->bindValue(':surgery_price', $surgery_price);
        $query->bindValue(':total_stay_price', $total_stay_price);
        $query->bindValue(':medication_cost', $medication_cost);

        try{
            $query->execute();
        }
        catch(Exception $e){
            die('ERROR: '.$e->getMessage());
        }
    }
    public function payBill($bill_id){
        $sql="UPDATE billing SET paid_status=1 WHERE bill_id=:bill_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(":bill_id",$bill_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function filterByPaid(){
        $sql="SELECT * FROM billing WHERE paid_status=1;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        try{
            $query->execute();
            $res=$query->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function filterByUnpaid(){
        $sql="SELECT * FROM billing WHERE paid_status=0;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        try{
            $query->execute();
            $res=$query->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function howManyRows(){
        $sql="SELECT COUNT(*) AS nb FROM billing;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        try{
            $query->execute();
            $res=$query->fetchALL(PDO::FETCH_ASSOC);
            $value=0;
            foreach($res as $row){
                $value=$row['nb'];
            }
            return $value;
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
}
?>
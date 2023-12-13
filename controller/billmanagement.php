<?php 
require_once '../../config.php';
class BillManagement{ 
    public function listBills($nb){
        $sql = "SELECT * FROM billing WHERE archived=0 LIMIT :nb , 4 ;";
        $db = config::getConnexion();
        $list=$db->prepare($sql);
        $list->bindValue(':nb',$nb*4, PDO::PARAM_INT);
        try{
            $list->execute();
            $res=$list->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch (Exception $e){
            die('Error: '.$e->getMessage());
        }
    }
    public function listArchivedBills($nb){
        $sql = "SELECT * FROM billing WHERE archived=1 LIMIT :nb , 4 ;";
        $db = config::getConnexion();
        $list=$db->prepare($sql);
        $list->bindValue(':nb',$nb*4, PDO::PARAM_INT);
        try{
            $list->execute();
            $res=$list->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch (Exception $e){
            die('Error: '.$e->getMessage());
        }
    }
    public function showBillByPatientId($name) {
        $sql="SELECT * FROM billing WHERE patient_id = :first_name;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':first_name', $name);
    
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
            sur.surgery_price,
            r.price_per_night * p.nights_stayed AS total_stay_price,
            COALESCE(SUM(mc.frequency * m.selling_price), 0) AS medication_cost,
            c.consultation_price + sur.surgery_price + r.price_per_night * p.nights_stayed + COALESCE(SUM(mc.frequency * m.selling_price), 0) AS total_amount
        FROM consultations c
        JOIN patients p ON c.patient_id = p.patient_id
        JOIN surgery sur ON c.patient_id = sur.patient_id
        JOIN rooms r ON sur.room_number = r.room_number
        LEFT JOIN medical_care mc ON c.patient_id = mc.patient_id
        LEFT JOIN medicines m ON mc.med_id = m.med_id
        WHERE c.patient_id = :patient_id
        GROUP BY p.patient_id, c.consultation_price, sur.surgery_price, r.price_per_night, p.nights_stayed;";
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
    public function filterByPaid($nb){
        $sql="SELECT * FROM billing WHERE paid_status=1 AND archived=0 LIMIT :nb, 4;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':nb',$nb*4, PDO::PARAM_INT);
        try{
            $query->execute();
            $res=$query->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function filterByUnpaid($nb){
        $sql="SELECT * FROM billing WHERE paid_status=0; AND archived=0 LIMIT :nb, 4;";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':nb',$nb*4, PDO::PARAM_INT);
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
        $sql="SELECT COUNT(*) AS nb FROM billing WHERE archived=0;";
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
    public function howManyArchivedRows(){
        $sql="SELECT COUNT(*) AS nb FROM billing WHERE archived=1;";
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
    
    public function archiveBill($bill_id){
        $sql="UPDATE billing SET archived=1 WHERE bill_id=:bill_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':bill_id',$bill_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function unarchiveBill($bill_id){
        $sql="UPDATE billing SET archived=0 WHERE bill_id=:bill_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':bill_id',$bill_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
    public function getMailAndName($id) {
        $sql = "SELECT email_address, first_name, family_name FROM users WHERE user_id=:id";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        
        try {
            $query->execute();
            $res = $query->fetch(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function sortByTotalAmountAsc($archived,$nb) {
        $sql = "SELECT * FROM billing WHERE archived= :archived ORDER BY total_amount ASC LIMIT :nb, 4";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':archived', $archived);
        $query->bindValue(':nb', $nb*4, PDO::PARAM_INT);
        try {
            $query->execute();
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }

    public function sortByTotalAmountDesc($archived, $nb) {
        $sql = "SELECT * FROM billing WHERE archived=:archived ORDER BY total_amount DESC LIMIT :nb, 4";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':archived', $archived);
        $query->bindValue(':nb', $nb*4, PDO::PARAM_INT);
        try {
            $query->execute();
            $res = $query->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        } catch (Exception $e) {
            echo "Error" . $e->getMessage();
        }
    }
    
}
?>
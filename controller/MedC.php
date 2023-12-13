<?php
require_once '../../config.php';
class MedCont
{
    public function listMedcare()
    {
        $sql = "SELECT * FROM medical_care WHERE archived=0";
        $db = config::getConnexion();
        try
        {
            $list = $db->query($sql);
            return $list;
        } 
        catch (Exception $e)
        {
            die('Error:' . $e->getMessage());
        }  
    }

    public function listArchivedMedcare(){
        $sql = "SELECT * FROM medical_care WHERE archived=1";
        $db = config::getConnexion();
        $list=$db->prepare($sql);
        //$list->bindValue(':nb',$nb*4,PDO::PARAM_INT);
        try{
            $list->execute();
            $res=$list->fetchALL(PDO::FETCH_ASSOC);
            return $res;
        }
        catch (Exception $e){
            die('Error: '.$e->getMessage());
        }
    }

    function deletemedcare ($id) 
    {
        $sql = "DELETE FROM medical_care WHERE care_id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql); 
        $req->bindValue(':id', $id); 
        try 
        {
            $req->execute();
        } catch (Exception $e)
        {
            die('Error:' . $e->getMessage());
        }
    }

    function addmedcare ($med)
    {
        $sql = "INSERT INTO medical_care
        VALUES (NULL, :patient_id, :patient_name, :med_id, :medecine_name, :dosage, :frequency)";
        $db = config::getConnexion();
        try
        {
            $query = $db->prepare($sql);
            $query->execute([ 
                'patient_id' => $med->getpatient_id(), 
                'patient_name' => $med->getpatient_name(),
                'med_id' => $med->getmed_id(), 
                'medecine_name' =>$med->getmedecine_name(),
                'dosage' => $med->getdosage(),
                'frequency' => $med->getfrequency(),
            ]);
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function archiveMedCare($care_id){
        $sql="UPDATE medical_care SET archived=1 WHERE care_id=:care_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':care_id',$care_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }

    public function unarchivemedcare($care_id){
        $sql="UPDATE medical_care SET archived=0 WHERE care_id=:care_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':care_id',$care_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }

    function listMedcarebyid($care_id)
    {
        $sql = "SELECT * FROM medical_care WHERE care_id = :care_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':care_id', $care_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function listpatientdetails($patient_id)
    {
        $sql = "SELECT * FROM medical_care WHERE patient_id = :patient_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':patient_id', $patient_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

}
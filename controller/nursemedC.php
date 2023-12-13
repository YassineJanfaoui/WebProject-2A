<?php
require_once '../../config.php';
class NursemedCont 
{
    public function listNursemed()
    {
        $sql = "SELECT * FROM nursemed"; 
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

    function deletenursemed ($id) 
    {
        $sql = "DELETE FROM nursemed WHERE care_id = :id";
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

    function addnursemed ($nursemed)
    {
        $sql = "INSERT INTO nursemed VALUES (:nurse_id, :nurse_name, :care_id, :patient_name)";
        $db = config::getConnexion();
        try
        {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nurse_id' => $nursemed->getnurse_id(), 
                'nurse_name' => $nursemed->getnurse_name(),
                'care_id' => $nursemed->getcare_id(),
                'patient_name' => $nursemed->getpatient_name()
            ]);
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updatenursemed($new,$nurse_id, $nurse_name)
    {   
        $sql = 'UPDATE nursemed SET 
            nurse_id = :new, 
            nurse_name = :nurse_name
            WHERE nurse_id= :nurse_id' ;
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        $query->bindValue(':nurse_id', $nurse_id);
        $query->bindValue(':nurse_name', $nurse_name);
        $query->bindValue(':new', $new);
        try{
            $query->execute();
        }
        catch(Exception $e){
            die('ERROR: '.$e->getMessage());
        }
    }
    
    function listNursemedbyid($nurse_id)
    {
        $sql = "SELECT * FROM nursemed WHERE nurse_id = :nurse_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':nurse_id', $nurse_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } 
        catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function listnursemedcarebyid($care_id)
    {
        $sql = "SELECT * FROM nursemed WHERE care_id = :care_id;";
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

}
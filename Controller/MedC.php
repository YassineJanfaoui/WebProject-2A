<?php
require_once '../config.php';
class MedCont
{
    public function listMedcare()
    {
        $sql = "SELECT * FROM medical_care"; 
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
        VALUES (NULL, :patient_id, :med_id, :dosage, :frequency)";
        $db = config::getConnexion();
        try
        {
            $query = $db->prepare($sql);
            $query->execute([ 
                'patient_id' => $med->getpatient_id(), 
                'med_id' => $med->getmed_id(), 
                'dosage' => $med->getdosage(),
                'frequency' => $med->getfrequency(),
            ]);
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
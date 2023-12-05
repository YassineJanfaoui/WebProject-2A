<?php
require_once '../config.php';
class shiftCont 
{
    public function listShift()
    {
        $sql = "SELECT * FROM shift"; 
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

    function deleteshift ($id) 
    {
        $sql = "DELETE FROM shift WHERE shift_id = :id";
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

    function addshift ($shift)
    {
        $sql = "INSERT INTO shift VALUES (NULL, :nurse_id, :nurse_name, :shift_date, :shift_type)";
        $db = config::getConnexion();
        try
        {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nurse_id' => $shift->getnurse_id(), 
                'nurse_name' => $shift->getnurse_name(),
                'shift_date' => $shift->getshift_date(),
                'shift_type' => $shift->getshift_type(),
            ]);
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }
    

}
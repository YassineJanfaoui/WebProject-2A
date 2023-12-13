<?php
require_once '../../config.php';
class shiftCont 
{
    public function listShift()
    {
        $sql = "SELECT * FROM shift WHERE archived=0"; 
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

    public function listArchivedshift(){
        $sql = "SELECT * FROM shift WHERE archived=1"; 
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
        $sql = "INSERT INTO shift (shift_id,nurse_id,nurse_name,shift_date,shift_type) VALUES (NULL, :nurse_id, :nurse_name, :shift_date, :shift_type)";
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

    function listShiftbynurseid($nurse_name)
    {
        $sql = "SELECT * FROM shift WHERE nurse_name = :nurse_name;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':nurse_name', $nurse_name);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function listArchivedShifts()
    {
        $sql = "SELECT * FROM shift WHERE archived=1";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            $list = $list->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function listnursename()
    {
        $sql = "SELECT nurse_name FROM shift";
        $db = config::getConnexion();
        try {
            $list = $db->query($sql);
            $list = $list->fetchAll();
            $names = array();
            foreach ($list as $name) {
                array_push($names, $name['nurse_name']);
            }
            return $names;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    public function archiveshift($shift_id){
        $sql="UPDATE shift SET archived=1 WHERE shift_id=:shift_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':shift_id',$shift_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }

    public function unarchiveshift($shift_id){
        $sql="UPDATE shift SET archived=0 WHERE shift_id=:shift_id";
        $db=config::getConnexion();
        $query=$db->prepare($sql);
        $query->bindValue(':shift_id',$shift_id);
        try{
            $query->execute();
        }
        catch(Exception $e){
            echo "Error".$e->getMessage();
        }
    }
}
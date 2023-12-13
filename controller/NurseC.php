<?php
require_once '../../config.php';
class NurseCont 
{
    public function listNurse()
    {
        $sql = "SELECT * FROM nurses"; 
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

    function deletenurse ($id) 
    {
        $sql = "DELETE FROM nurses WHERE nurse_id = :id";
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

    function addnurse ($nurse)
    {
        $sql = "INSERT INTO nurses VALUES (:nurse_id, :first_name, :last_name, :department, :phone_number, :email, :hire_date)";
        $db = config::getConnexion();
        try
        {
            $query = $db->prepare($sql);
            $query->execute([ 
                'nurse_id' => $nurse->getnurse_id(), 
                'first_name' => $nurse->getfirstname(),
                'last_name' => $nurse->getlastname(),
                'department' => $nurse->getdepartment(),
                'phone_number' => $nurse->getphonenumber(),
                'email' => $nurse->getemail(),
                'hire_date' => $nurse->gethiredate(),
            ]);
        }
        catch (Exception $e)
        {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function listNursebyid($nurse_id)
    {
        $sql = "SELECT * FROM nurses WHERE nurse_id = :nurse_id;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':nurse_id', $nurse_id);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function listNursebydepartment($department)
    {
        $sql = "SELECT * FROM nurses WHERE department = :department;";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':department', $department);
            $query->execute();
            $list = $query->fetchAll();
            return $list;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }

}
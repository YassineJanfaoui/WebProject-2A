<?php
require "../config.php";
require "../Model/UserModel.php";
class UserController
{
    public function listUsers($sort = null)
    {
        $db = config::getConnexion();
        if ($sort == null) {
            $sql = "SELECT * FROM users";
        } else {
            $sql = "SELECT * FROM users ORDER BY type";
        }
        try {
            $result = $db->query($sql);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function banUser($id)
    {
        $sql = "UPDATE users SET enabled = 0 WHERE user_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id
            ]);
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function unbanUser($id)
    {
        $sql = "UPDATE users SET enabled = 1 WHERE user_id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id
            ]);
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function addUser($user)
    {
        $sql = "INSERT into users VALUES (NULL,:username,:password,:first_name,:family_name,:email_address,:contact_number,'patient',1)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'first_name' => $user->getFirstName(),
                'family_name' => $user->getFamilyName(),
                'email_address' => $user->getEmailAddress(),
                'contact_number' => $user->getContactNumber()
            ]);
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getUser($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'username' => $username
            ]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $user = new User($result["user_id"], $result["username"], $result["password"], $result["first_name"], $result["family_name"], $result["email_address"], $result["contact_number"],$result["type"],$result["enabled"]);
                return $user;
            } else {
                return null;
            }
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
}

<?php
require "../config.php";
class FeedbackController
{
    public function getAllFeedbacks()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM feedbacks";
        try {
            $result = $db->query($sql);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function addFeedback($feedback)
    {
        $sql = "INSERT into feedbacks VALUES (NULL,:user_id,:description)";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $feedback->getUserID(),
                'description' => $feedback->getDescription(),
            ]);
        }
        catch(Exception $e){
            die("ERROR: " . $e->getMessage());
        }
    }
    public function RemoveFeedback($id)
    {
        $db = config::getConnexion();
        $sql = "DELETE FROM feedbacks WHERE feedback_id = :id";
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);
        try {
            $req->execute();
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function checkUserID($user_id)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':user_id', $user_id);
            $req->execute();
            $user = $req->fetch();
            if ($user) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
}

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
    public function getFeedbacksByUserId($user_id)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM feedbacks WHERE user_id = :user_id";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }

    public function getFeedbacksbyDate($date)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM feedbacks WHERE date_added = :date_added";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':date_added', $date);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function addFeedback($feedback)
    {
        $sql = "INSERT into feedbacks VALUES (NULL,:user_id,:description,:date_added)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $feedback->getUserID(),
                'description' => $feedback->getDescription(),
                'date_added' => $feedback->getDateAdded()
            ]);
        } catch (Exception $e) {
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

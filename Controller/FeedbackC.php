<?php
require_once "../config.php";
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

    public function getFeedbacksbyReview($review)
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM feedbacks WHERE review = :review";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':review', $review);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getPositiveFeedbacks()
    {
        $db = config::getConnexion();
        $sql = "SELECT * FROM feedbacks WHERE review >3";
        try {
            $result = $db->query($sql);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function addFeedback($feedback)
    {
        $sql = "INSERT into feedbacks VALUES (NULL,:user_id,:description,:date_added,:review)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'user_id' => $feedback->getUserID(),
                'description' => $feedback->getDescription(),
                'date_added' => $feedback->getDateAdded(),
                'review' => $feedback->getReview()
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
    
}

<?php
require_once "../../config.php";
class FeedbackController
{
    public function getAllFeedbacks2()
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
    public function getAllFeedbacks($sort,$page = 1, $itemsPerPage = 20)
    {
        $db = config::getConnexion();
        $offset = ($page - 1) * $itemsPerPage;
        if($sort == "ASC")
        $sql = "SELECT * FROM feedbacks ORDER BY review ASC LIMIT $offset, $itemsPerPage";
        else
        $sql = "SELECT * FROM feedbacks ORDER BY review DESC LIMIT $offset, $itemsPerPage";
        try {
            $result = $db->query($sql);
            return $result;
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getTotalFeedbacks()
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM feedbacks";
        try {
            $result = $db->query($sql);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return $row['total'];
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getTotalFeedbacksByUsername($username)
    {
        $db = config::getConnexion();
        $userQuery = "SELECT user_id FROM users WHERE username = :username LIMIT 1";
        try {
            $stmtUser = $db->prepare($userQuery);
            $stmtUser->bindParam(':username', $username);
            $stmtUser->execute();
            $userResult = $stmtUser->fetch(PDO::FETCH_ASSOC);
            if ($userResult) {
                $user_id = $userResult['user_id'];
                $sql = "SELECT COUNT(*) AS total FROM feedbacks WHERE user_id = :user_id";
                $stmtFeedbacks = $db->prepare($sql);
                $stmtFeedbacks->bindParam(':user_id', $user_id);
                $stmtFeedbacks->execute();
                $result = $stmtFeedbacks->fetch(PDO::FETCH_ASSOC);
                return $result['total'];
            } else {
                return 0;
            }
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getTotalFeedbacksbyDate($date)
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM feedbacks WHERE date_added = :date_added";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':date_added', $date);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getTotalFeedbacksbyReview($review)
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) AS total FROM feedbacks WHERE review <= :review";
        try {
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':review', $review);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            die("ERROR: " . $e->getMessage());
        }
    }
    public function getFeedbacksByUsername($username, $sort,$page = 1, $itemsPerPage = 20)
{
    $db = config::getConnexion();
    $offset = ($page - 1) * $itemsPerPage;
    $userQuery = "SELECT user_id FROM users WHERE username = :username LIMIT 1";

    try {
        $stmtUser = $db->prepare($userQuery);
        $stmtUser->bindParam(':username', $username);
        $stmtUser->execute();
        $userResult = $stmtUser->fetch(PDO::FETCH_ASSOC);
        if ($userResult) {
            $user_id = $userResult['user_id'];
            if($sort == "ASC")
            $sql = "SELECT * FROM feedbacks WHERE user_id = :user_id ORDER BY review ASC LIMIT $offset, $itemsPerPage";
            else
            $sql = "SELECT * FROM feedbacks WHERE user_id = :user_id ORDER BY review DESC LIMIT $offset, $itemsPerPage";
            $stmtFeedbacks = $db->prepare($sql);
            $stmtFeedbacks->bindParam(':user_id', $user_id);
            $stmtFeedbacks->execute();
            $result = $stmtFeedbacks->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
        } else {
            return array();
        }
    } catch (Exception $e) {
        die("ERROR: " . $e->getMessage());
    }
}

    public function getFeedbacksbyDate($date, $sort,$page = 1, $itemsPerPage = 20)
    {
        $db = config::getConnexion();
        $offset = ($page - 1) * $itemsPerPage;
        if($sort == "ASC")
        $sql = "SELECT * FROM feedbacks WHERE date_added = :date_added ORDER BY review ASC LIMIT $offset, $itemsPerPage";
        else
        $sql = "SELECT * FROM feedbacks WHERE date_added = :date_added ORDER BY review DESC LIMIT $offset, $itemsPerPage";
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

    public function getFeedbacksbyReview($review, $sort, $page = 1, $itemsPerPage = 20)
    {
        $db = config::getConnexion();
        $offset = ($page - 1) * $itemsPerPage;
        if($sort == "ASC")
        $sql = "SELECT * FROM feedbacks WHERE review <= :review ORDER BY review ASC LIMIT $offset, $itemsPerPage";
        else
        $sql = "SELECT * FROM feedbacks WHERE review <= :review ORDER BY review DESC LIMIT $offset, $itemsPerPage";
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

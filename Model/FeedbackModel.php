<?php
class Feedback
{
    private ?int $feedback_id = null;
    private ?int $user_id = null;
    private ?string $description = null;
    private ?string $date_added = null;


    public function __construct($u = null, $id, $desc, $date = null)
    {
        $this->user_id = $id;
        $this->description = $desc;
        $this->feedback_id = $u;
        $this->date_added = $date;
    }

    public function getDateAdded()
    {
        return $this->date_added;
    }
    public function getFeedbackID()
    {
        return $this->feedback_id;
    }
    public function getUserID()
    {
        return $this->user_id;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setFeedbackID($u)
    {
        return $this->feedback_id = $u;
    }
    public function setUserID($id)
    {
        return $this->user_id = $id;
    }
    public function setDescription($desc)
    {
        return $this->description = $desc;
    }
   
    
}

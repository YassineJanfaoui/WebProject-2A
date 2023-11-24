<?php
class Feedback
{
    private ?int $feedback_id = null;
    private ?int $user_id = null;
    private ?string $description = null;


    public function __construct($u = null, $id, $desc)
    {
        $this->user_id = $id;
        $this->description = $desc;
        $this->feedback_id = $u;
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

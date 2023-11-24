<?php
class User
{
    private ?int $user_id = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?string $first_name = null;
    private ?string $family_name = null;
    private ?string $email_address = null;
    private ?string $contact_number = null;
    private ?string $type = null;

    public function __construct($id,$u,$p, $fn, $ln, $e, $c,$t)
    {
        $this->user_id = $id;
        $this->username = $u;
        $this->password = $p;
        $this->first_name = $fn;
        $this->family_name = $ln;
        $this->email_address = $e;
        $this->contact_number = $c; 
        $this->type = $t;
    }
    public function getUserID()
    {
        return $this->user_id;
    }
    public function getRole()
    {
        return $this->type;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getFirstName()
    {
        return $this->first_name;
    }
    public function getFamilyName()
    {
        return $this->family_name;
    }
    public function getEmailAddress()
    {
        return $this->email_address;
    }
    public function getContactNumber()
    {
        return $this->contact_number;
    }
    public function setUsername($u)
    {
        return $this->username = $u;
    }
    public function setPassword($p)
    {
        return $this->password = $p;
    }
    public function setFirstName($fn)
    {
        return $this->first_name = $fn;
    }
    public function setFamilyName($ln)
    {
        return $this->family_name = $ln;
    }
    public function setEmailAddress($e)
    {
        return $this->email_address = $e;
    }
    public function setContactNumber($c)
    {
        return $this->contact_number = $c;
    }
    
}

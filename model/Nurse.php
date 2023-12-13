<?php
class nurse 
{
    private ?int $nurse_id;
    private ?string $first_name;
    private ?string $last_name;
    private ?string $department;
    private ?int $phone_number; 
    private ?string $email;
    private ?string $hire_date;

    public function __construct(int $nurse_id, string $first_name, string $last_name, string $department, int $phone_number, string $email, string $hire_date)
    {
        $this->nurse_id = $nurse_id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->department = $department;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->hire_date = $hire_date;
    }

    // nurse id set and get
    public function setnurse_id($nurse_id)
    {
        return $this->nurse_id=$nurse_id;
    }
    public function getnurse_id()
    {
        return $this->nurse_id;
    }
    

    // first_name set and get
    public function getfirstname()
    {
        return $this->first_name;
    }
    public function setfirstname($first_name)
    {
        return $this->first_name=$first_name;
    }

    // last_name set and get
    public function setlastname($last_name)
    {
        return $this->last_name=$last_name;
    }
    public function getlastname()
    {
        return $this->last_name;
    }

    // department set and get
    public function setdepartment($department)
    {
        return $this->department=$department;
    }
    public function getdepartment()
    {
        return $this->department;
    }

    // phone_number set and get
    public function setphonenumber($phone_number)
    {
        return $this->phone_number=$phone_number;
    }
    public function getphonenumber()
    {
        return $this->phone_number;
    }

    // email set and get
    public function setemail($email)
    {
        return $this->email=$email;
    }
    public function getemail()
    {
        return $this->email;
    }

    // hire_date set and get
    public function sethiredate($hire_date)
    {
        return $this->hire_date=$hire_date;
    }
    public function gethiredate()
    {
        return $this->hire_date;
    }

}
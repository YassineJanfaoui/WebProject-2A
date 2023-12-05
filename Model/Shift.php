<?php
class shift 
{
    private ?int $shift_id;
    private ?int $nurse_id;
    private ?string $nurse_name;
    private ?string $shift_date;
    private ?string $shift_type;

    public function __construct($shift_id=null, int $nurse_id, string $nurse_name, string $shift_date, string $shift_type)
    {
        $this->shift_id = $shift_id;
        $this->nurse_id = $nurse_id;
        $this->nurse_name = $nurse_name;
        $this->shift_date = $shift_date;
        $this->shift_type = $shift_type;
    }

    // shift id get
    public function getshift_id()
    {
        return $this->shift_id;
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
    
    // nurse_name set and get
    public function getnurse_name()
    {
        return $this->nurse_name;
    }
    public function setnurse_name($nurse_name)
    {
        return $this->nurse_name=$nurse_name;
    }

    // shift_date set and get
    public function setshift_date($shift_date)
    {
        return $this->shift_date=$shift_date;
    }
    public function getshift_date()
    {
        return $this->shift_date;
    }

    // shift_type set and get
    public function setshift_type($shift_type)
    {
        return $this->shift_type=$shift_type;
    }
    public function getshift_type()
    {
        return $this->shift_type;
    }


}
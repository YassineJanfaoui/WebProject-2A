<?php
class nursemed
{
    private ?int $nurse_id;
    private ?string $nurse_name;
    private ?int $care_id;
    private ?string $patient_name;

    public function __construct(int $nurse_id, string $nurse_name, int $care_id, string $patient_name)
    {
        $this->nurse_id = $nurse_id;
        $this->nurse_name = $nurse_name;
        $this->care_id = $care_id;
        $this->patient_name = $patient_name;
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

    // care_id set and get
    public function setcare_id($care_id)
    {
        return $this->care_id=$care_id;
    }
    public function getcare_id()
    {
        return $this->care_id;
    }

    // patient_name set and get
    public function setpatient_name($patient_name)
    {
        return $this->patient_name=$patient_name;
    }
    public function getpatient_name()
    {
        return $this->patient_name;
    }

}
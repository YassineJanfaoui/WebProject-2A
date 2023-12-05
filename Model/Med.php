<?php
class medical_care
{
    private ?int $care_id;
    private ?int $patient_id;
    private ?int $med_id;
    private ?int $dosage;
    private ?int $frequency;

    public function __construct($care_id=null, int $patient_id, int $med_id, int $dosage, int $frequency)
    {
        $this->care_id = $care_id;
        $this->patient_id = $patient_id;
        $this->med_id = $med_id;
        $this->dosage = $dosage;
        $this->frequency = $frequency;
    }

    // care id get
    public function getcare_Id()
    {
        return $this->care_id;
    }

    // patient id set and get
    public function setpatient_id($patient_id)
    {
        return $this->patient_id=$patient_id;
    }
    public function getpatient_id()
    {
        return $this->patient_id;
    }

    // medecine id set and get
    public function setmed_id($med_id)
    {
        return $this->med_id=$med_id;
    }
    public function getmed_id()
    {
        return $this->med_id;
    }

    // dosage set and get
    public function setdosage($dosage)
    {
        return $this->dosage=$dosage;
    }
    public function getdosage()
    {
        return $this->dosage;
    }
    
    // frequency set and get
    public function getfrequency()
    {
        return $this->frequency;
    }
    public function setfrequency($frequency)
    {
        return $this->frequency=$frequency;
    }
}
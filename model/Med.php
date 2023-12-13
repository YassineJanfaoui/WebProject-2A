<?php
class medical_care
{
    private ?int $care_id;
    private ?int $patient_id;
    private ?string $patient_name;
    private ?int $med_id;
    private ?string $medecine_name;
    private ?int $dosage;
    private ?int $frequency;

    public function __construct($care_id=null, int $patient_id, string $patient_name, int $med_id, string $medecine_name, int $dosage, int $frequency)
    {
        $this->care_id = $care_id;
        $this->patient_id = $patient_id;
        $this->patient_name = $patient_name;
        $this->med_id = $med_id;
        $this->medecine_name = $medecine_name;
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

    // patient name set and get
    public function setpatient_name($patient_name)
    {
        return $this->patient_name=$patient_name;
    }
    public function getpatient_name()
    {
        return $this->patient_name;
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

    // medecine name set and get
    public function setmedecine_name($medecine_name)
    {
        return $this->medecine_name=$medecine_name;
    }
    public function getmedecine_name()
    {
        return $this->medecine_name;
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
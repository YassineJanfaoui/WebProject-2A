<?php

class Patients
{
    private ?int $patient_id;
    private string $date_of_birth;
    private string $medical_record;
    private string $emergency_contact_number;
    private string $typep;
    private int $room_number;
    private int $nights_stayed;
    private string $diet_type;

    public function __construct(?int $patient_id, string $date_of_birth, string $medical_record, string $emergency_contact_number, string $typep, int $room_number, int $nights_stayed, string $diet_type)
    {
        $this->patient_id = $patient_id;
        $this->date_of_birth = $date_of_birth;
        $this->medical_record = $medical_record;
        $this->emergency_contact_number = $emergency_contact_number;
        $this->typep = $typep;
        $this->room_number = $room_number;
        $this->nights_stayed = $nights_stayed;
        $this->diet_type = $diet_type;
    }

    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function setPatientId($patient_id)
    {
        return $this->patient_id = $patient_id;
    }

    // ... (Getter and setter methods for other properties)

    public function getdate_of_birth()
    {
        return $this->date_of_birth;
    }
    public function setdate_of_birth($date_of_birth)
    {
        return $this->date_of_birth=$date_of_birth;
    }
//
    public function getmedical_record()
    {
        return $this->medical_record;
    }
    public function setmedical_record($medical_record)
    {
        return $this->medical_record=$medical_record;
    }
//
    public function getemergency_contact_number()
    {
        return $this->emergency_contact_number;
    }
    public function setemergency_contact_number($emergency_contact_number)
    {
        return $this->emergency_contact_number=$emergency_contact_number;
    }
//
    public function gettypep()
    {
        return $this->typep;
    }
    public function settypep($typep)
    {
        return $this->typep=$typep;
    }
//
    public function getroom_number()
    {
        return $this->room_number;
    }
    public function setroom_number($room_number)
    {
        return $this->room_number=$room_number;
    }
//
    public function getnights_stayed()
    {
        return $this->nights_stayed;
    }
    public function setnights_stayed($nights_stayed)
    {
        return $this->nights_stayed=$nights_stayed;
    }
    //
    public function getdiet_type()
    {
        return $this->diet_type;
    }
    public function setdiet_type($diet_type)
    {
        return $this->diet_type=$diet_type;
    }
}



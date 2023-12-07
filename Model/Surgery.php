<?php
class surgery
{
    private ?string $surgery_id;
    private ?string $doctor_id;
    private ?string $patient_id;
    private ?string $room_number;
    private ?string $date;
    private ?string $description;
    private ?float $surgery_price;

    public function __construct($surgery_id=null, string $doctor_id, string $patient_id, string $room_number, string $date, string $description, float $surgery_price)
    {
        $this->surgery_id = $surgery_id;
        $this->doctor_id = $doctor_id;
        $this->patient_id = $patient_id;
        $this->room_number = $room_number;
        $this->date = $date;
        $this->description = $description;
        $this->surgery_price = $surgery_price;
    }

    public function showSurgery()
    {
        echo "Surgery: " . $this->surgery_id . "|" . $this->doctor_id . "|" . $this->patient_id . "|" . $this->room_number . "|" . $this->date . "|" . $this->description . "|" . $this->surgery_price . "<br>";
    }

    // Surgery_id get 
    public function getSurgery_id()
    {
        return $this->surgery_id;
    }

    // Doctor_id get and set
    public function getDoctor_id()
    {
        return $this->doctor_id;
    }
    public function setDoctor_id($doctor_id)
    {
        return $this->doctor_id=$doctor_id;
    }

    // Patient_id get and set
    public function getPatient_id()
    {
        return $this->patient_id;
    }
    public function setPatient_id($patient_id)
    {
        return $this->patient_id=$patient_id;
    }

    // Room_number get and set
    public function getRoom_number()
    {
        return $this->room_number;
    }
    public function setRoom_number($room_number)
    {
        return $this->room_number=$room_number;
    }

    // Date get and set
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        return $this->date=$date;
    }

    // Description get and set
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        return $this->description=$description;
    }

    // Surgery_price get and set
    public function getSurgery_price()
    {
        return $this->surgery_price;
    }
    public function setSurgery_price($surgery_price)
    {
        return $this->surgery_price=$surgery_price;
    }
    

}
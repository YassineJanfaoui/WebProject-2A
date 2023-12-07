<?php // set the class docotr with its functions
    class doctor
{
    private ?string $doctor_id;
    private ?string $speciality;
    private ?string $schedule;
    private ?string $room_number;
    private ?string $IMG;

    public function __construct($doctor_id=null, string $speciality, string $schedule, string $room_number, string $IMG=null)
    {
        $this->doctor_id = $doctor_id;
        $this->speciality = $speciality;
        $this->schedule = $schedule;
        $this->room_number = $room_number;
        $this->IMG = $IMG;
    }

    public function showDoctor()
    {
        echo "Doctor: " . $this->doctor_id . "|" . $this->speciality . "|" . $this->schedule . "|" . $this->room_number . "<br>";
    }

    // Id get and set
    public function getDoctor_id()
    {
        return $this->doctor_id;
    }
    public function setDoctor_id($doctor_id)
    {
        return $this->doctor_id=$doctor_id;
    }

    // Speciality get and set
    public function getSpeciality()
    {
        return $this->speciality;
    }
    public function setSpeciality($speciality)
    {
        return $this->speciality=$speciality;
    }

    // Schedule get and set
    public function getSchedule()
    {
        return $this->schedule;
    }
    public function setSchedule($schedule)
    {
        return $this->schedule=$schedule;
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
    // IMG get and set
    public function getIMG()
    {
        return $this->IMG;
    }
    public function setIMG($IMG)
    {
        return $this->IMG=$IMG;
    }
    

}
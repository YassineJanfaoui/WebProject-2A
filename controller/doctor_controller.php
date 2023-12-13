<?php
// doctor_controller.php
require_once '../../model/doctor_model.php'; // Adjust the path as necessary

class DoctorController {
    private $model;

    public function __construct() {
        $this->model = new DoctorModel();
    }

    public function getDoctors() {
        return $this->model->getDoctors();
    }
    
    // Additional method in SpecialtyController.php
    public function getDoctorsBySpecialty($specialty)
    {
        return $this->model->getDoctorsBySpecialty($specialty);
    }
}
?>

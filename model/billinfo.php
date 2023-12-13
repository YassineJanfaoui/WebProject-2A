<?php
class bill {
    public $bill_id;
    public $patient_id;
    public $bill_type;
    public $consultation_price;
    public $surgery_price;
    public $total_stay_price;
    public $medication_cost;
    public $total_amount;
    public $paid_status;
    
    public function __construct($bill_id, $patient_id, $bill_type, $consultation_price, $surgery_price,$total_stay_price,$medication_cost,$total_amount,$paid_status) {
        $this->bill_id = $bill_id;
        $this->patient_id = $patient_id;
        $this->bill_type = $bill_type;
        $this->consultation_price = $consultation_price;
        $this->surgery_price = $surgery_price;
        $this->total_stay_price = $total_stay_price;
        $this->medication_cost = $medication_cost;
        $this->total_amount = $total_amount;
        $this->paid_status=$paid_status;
    }
    public function show() {
        echo "<table border='1'>
            <tr>
                <th>Bill Id</th>
                <th>Patient Id</th>
                <th>Bill Type</th>
                <th>Consultation Price</th>
                <th>Surgery Price</th>
                <th>Total Stay Price</th>
                <th>Medication Price</th>
                <th>Total Amount</th>
            </tr>
            <tr>
                <td>{$this->bill_id}</td>
                <td>{$this->patient_id}</td>
                <td>{$this->bill_type}</td>
                <td>{$this->consultation_price}</td>
                <td>{$this->surgery_price}</td>
                <td>{$this->total_stay_price}</td>
                <td>{$this->medication_cost}</td>
                <td>{$this->total_amount}</td>
            </tr>
        </table>";
    }
    public function getPatient_id()
    {
        return $this->patient_id;
    }
    public function getBillId(){
        return $this->bill_id;
    }
    public function getConsultationPrice(){
        return $this->consultation_price;
    }
    public function getSurgeryPrice(){
        return $this->surgery_price;
    }
    public function getTotalStayPrice(){
        return $this->total_stay_price;
    }
    public function getMedicationCost(){
        return $this->medication_cost;
    }
    
}
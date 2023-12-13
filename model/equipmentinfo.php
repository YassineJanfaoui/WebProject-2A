<?php
class Equipment {
    public $eq_id;
    public $eq_name;
    public $eq_quantity;
    public $eq_purchase_price;
    public $eq_purchase_history;

    public function __construct($eq_id, $eq_name, $eq_quantity, $eq_purchase_price, $eq_purchase_history) {
        $this->eq_id = $eq_id;
        $this->eq_name = $eq_name;
        $this->eq_quantity = $eq_quantity;
        $this->eq_purchase_price = $eq_purchase_price;
        $this->eq_purchase_history = $eq_purchase_history;
    }

    public function show() {
        echo "<table border='1'>
            <tr>
                <th>Equipment Id</th>
                <th>Equipment Name</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>Purchase History</th>
            </tr>
            <tr>
                <td>{$this->eq_id}</td>
                <td>{$this->eq_name}</td>
                <td>{$this->eq_quantity}</td>
                <td>{$this->eq_purchase_price}</td>
                <td>{$this->eq_purchase_history}</td>
            </tr>
        </table>";
    }

    public function getEquipmentId() {
        return $this->eq_id;
    }

    public function getEquipmentName() {
        return $this->eq_name;
    }

    public function getQuantity() {
        return $this->eq_quantity;
    }

    public function getPurchasePrice() {
        return $this->eq_purchase_price;
    }

    public function getPurchaseHistory() {
        return $this->eq_purchase_history;
    }
}
?>
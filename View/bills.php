<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="../Assets/CSS Styles/bills.css">
</head>
<body>
    <header>
        <h1>Billing</h1>
    </header>
    <nav>
        <a href="#">Appointment</a>
        <a href="#">Feedback</a>
        <a href="#">Billing</a>
    </nav>
    <div class="container" align="center">
        <?php 
            include "../Control/billmanagement.php";
            $b = new BillManagement();
            $tab = $b->showBillByPatientId(2);
        ?>
        <table>
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Patient ID</th>
                <th>Bill Type</th>
                <th>Consultation Price</th>
                <th>Surgery Price</th>
                <th>Total Stay Price</th>
                <th>Medication Price</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $bill):
                if($bill['paid_status']==0){ ?>
                <tr>
                    <td><?= $bill['bill_id'] ?></td>
                    <td><?= $bill['patient_id'] ?></td>
                    <td><?= $bill['bill_type'] ?></td>
                    <td><?= $bill['consultation_price'] ?></td>
                    <td><?= $bill['surgery_price'] ?></td>
                    <td><?= $bill['total_stay_price'] ?></td>
                    <td><?= $bill['medication_cost'] ?></td>
                    <td><?= $bill['total_amount'] ?></td>
                    <td class="action-buttons">
                        <button type="button" onclick="window.location.href='payBill.php?bill_id=<?= $bill['bill_id']; ?>'">Pay</button>
                    </td>
                </tr>
            <?php } endforeach; ?>
        </tbody>
        </table>
        <h5><a href="">Go back to home page</a></h5>

        
    </div>
</body>
</html>

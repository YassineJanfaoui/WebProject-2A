<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills List</title>
    <link rel="stylesheet" href="../Assets/CSS Styles/listBills.css">
</head>
<body align="center">

    <header>
        Bills of patient with ID <?php echo $_GET['pid']?>
    </header>

    <?php
    include "../Control/billmanagement.php";
    $b = new BillManagement();
    $tab = $b->showBillByPatientId($_GET['pid']);
    ?>
    <table>
        <thead>
            <tr>
                <th>Bill Id</th>
                <th>Patient Id</th>
                <th>Bill Type</th>
                <th>Consultation Price</th>
                <th>Surgery Price</th>
                <th>Total Stay Price</th>
                <th>Medication Price</th>
                <th>Total Amount</th>
                <th>Paid Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tab as $bill): ?>
                <tr>
                    <td><?= $bill['bill_id'] ?></td>
                    <td><?= $bill['patient_id'] ?></td>
                    <td><?= $bill['bill_type'] ?></td>
                    <td><?= $bill['consultation_price'] ?></td>
                    <td><?= $bill['surgery_price'] ?></td>
                    <td><?= $bill['total_stay_price'] ?></td>
                    <td><?= $bill['medication_cost'] ?></td>
                    <td><?= $bill['total_amount'] ?></td>
                    <td><?= $bill['paid_status'] ?></td>
                    <td><button type="button" onclick="window.location.href='deleteBill.php?patient_id=<?php echo $bill['patient_id']; ?>'">Delete</button></td>
                    <td><button type="button" onclick="window.location.href='updateBill.php?bill_id=<?php echo $bill['bill_id']; ?>&consultation_price=<?php echo $bill['consultation_price']; ?>&surgery_price=<?php echo $bill['surgery_price']; ?>&total_stay_price=<?php echo $bill['total_stay_price']; ?>&medication_cost=<?php echo $bill['medication_cost']; ?>'">Update</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div align="center"><a href="listbills.php">Return to bill list</a></div>
</body>
</html>

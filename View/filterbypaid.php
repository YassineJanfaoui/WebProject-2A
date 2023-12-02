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
        Bills
    </header>

    <?php
    
    include "../Control/billmanagement.php";
    $b = new BillManagement();
    $tab = $b->filterByPaid();
    ?>
    
    <form align="center" action="listBillById.php" method="GET">
        <b><label for="search_nav">Search by patient ID</label></b>
        <input type="text" id="pid" name="pid">
        <input type="submit" value="Search">
    </form>
    <form align="center">
        <select id="filter" onchange=filterOnDemand()>
            <option selected="Sort by" disabled>Sort by</option>
            <option value="taasc">Total amount (low to high)</option>
            <option value="tadesc">Total amount (high to low )</option>
        </select>
        <label for="filter">Filter by</label>
        <button type="button" name="filter" onclick="window.location.href='filterbypaid.php';">Paid bills</button>
        <button type="button" onclick="window.location.href='filterbyunpaid.php';">Unpaid bills</button>
    </form>
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
                    <td><button type="button" onclick="window.location.href='deleteBill.php?bill_id=<?php echo $bill['bill_id']; ?>'">Delete</button></td>
                    <td><button type="button" onclick="window.location.href='updateBill.php?bill_id=<?php echo $bill['bill_id']; ?>&consultation_price=<?php echo $bill['consultation_price']; ?>&surgery_price=<?php echo $bill['surgery_price']; ?>&total_stay_price=<?php echo $bill['total_stay_price']; ?>&medication_cost=<?php echo $bill['medication_cost']; ?>'">Update</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <button type="button" onclick="window.location.href='listBills.php'">Return</button>

    <!-- Include the script at the end of the body or use DOMContentLoaded -->
    <script lang="javascript" src="../Assets/JavaScript Scripts/filter.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipments List</title>
    <link rel="stylesheet" href="listEquipment.css"> 
</head>
<body>

    
    <?php
    include "../Control/equipmentmanagement.php"; 
    $equipment = new EquipmentManagement(); 
    $equipmentList = $equipment->showEquipmentByEqId($_GET['eid']);
    if($equipmentList==null){
        echo "There is no equipments with ID".$_GET['eid'];
    }


    ?>
    <header>
        Equipment with ID <?php echo $_GET['eid'] ?>
    </header>
    <table>
        <thead>
            <tr>
                <th>Equipment Id</th>
                <th>Equipment Name</th>
                <th>Quantity</th>
                <th>Purchase Price</th>
                <th>Purchase History</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipmentList as $equipment): ?>
                <tr>
                    <td><?= $equipment['eq_id'] ?></td>
                    <td><?= $equipment['eq_name'] ?></td>
                    <td><?= $equipment['eq_quantity'] ?></td>
                    <td><?= $equipment['eq_purchase_price'] ?></td>
                    <td><?= $equipment['eq_purchase_history'] ?></td>
                    <td><button type="button" onclick="window.location.href='deleteequipment.php?eq_id=<?php echo $equipment['eq_id']; ?>'">Delete</button></td>
                    <td><button type="button" onclick="window.location.href='updateequipment.php?eq_id=<?php echo $equipment['eq_id']; ?>'">Update</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div align="center"><a href="listEquipments.php">Return to equipment list</a></div>
</body>
</html>

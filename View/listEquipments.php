<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipments List</title>
    <link rel="stylesheet" href="../Assets/CSS Styles/listEquipment.css"> 
</head>
<body>

    <header>
        Equipment
    </header>
    
    <?php
    include "../Control/equipmentmanagement.php"; 
    $equipment = new EquipmentManagement(); 
    $equipmentList = $equipment->listEquipment(); 
    ?>
    <form align="center" action="listEqById.php" method="GET">
        <b><label for="search_nav">Search by Equipment ID</label></b>
        <input type="text" id="eid" name="eid">
        <input type="submit" value="Search">
    </form>
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
    <div align="center"><a href="addEquipment.php">Add an equipment</a></div>
</body>
</html>

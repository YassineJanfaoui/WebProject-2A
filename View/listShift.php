<?php
include "../Controller/ShiftC.php";
$c = new shiftCont();
$tab = $c->listShift();
?>

<html>
<head>
    <title>Shift Schedule</title>
    <link rel="stylesheet" href="../styles/stylelistNurse.css" />
    <link rel="stylesheet" href="../styles/navbar.css" />
</head>

<body>
    <div class="container">
        <header class="nav-down">
            <p>Admin Dashboard</p>

        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            
            <a href="#">List Feedback</a>
            <a href="#">List Users</a>
            <a href="listNurse.php">List Nurses</a>
            <a href="listShift.php">List Nurses Shift</a>
            <a href="listMedcare.php">List Medical care</a>
            <a href="addMedcare.php">Add Medical care</a>
            <a href="#">Add Doctor</a>
            <a href="addnurse.php">Add Nurse</a>
            <a href="addshift.php">Assign Shift to Nurse</a>
            <a href="#">Confirm Surgery</a>
            <a href="#">Assign Schedule</a>
        </div>
    </div>
    <div class="main">
</br>
    <h1>List of Nurses Shift</h1>
    <table>
        <tr>
            <th>Nurse Id </th>
            <th>Nurse Name</th>
            <th>Shift Date </th>
            <th>Shift Type </th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($tab as $shift) {
        ?>
            <tr>
                <td><?php echo $shift['nurse_id']; ?></td>
                <td><?php echo $shift['nurse_name']; ?></td>
                <td><?php echo $shift['shift_date']; ?></td>
                <td><?php echo $shift['shift_type']; ?></td>
                <td align="center">
                <a href="deleteshift.php?shift_id=<?php echo $shift['shift_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>

</html>
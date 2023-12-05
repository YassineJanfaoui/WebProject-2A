<?php
include "../Controller/NurseC.php";
$c = new NurseCont();
$tab = $c->listNurse();
?>

<html>
<head>
    <title>Nurse List</title>
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
    <h1>List of Nurses</h1>
    <table>
        <tr>
            <th>Nurse Id </th>
            <th>First Name</th>
            <th>Last Name </th>
            <th>Department </th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Hire Date</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($tab as $nurse) {
        ?>
            <tr>
                <td><?php echo $nurse['nurse_id']; ?></td>
                <td><?php echo $nurse['first_name']; ?></td>
                <td><?php echo $nurse['last_name']; ?></td>
                <td><?php echo $nurse['department']; ?></td>
                <td><?php echo $nurse['phone_number']; ?></td>
                <td><?php echo $nurse['email']; ?></td>
                <td><?php echo $nurse['hire_date']; ?></td>
                <td align="center">
                <a href="deleteNurse.php?nurse_id=<?php echo $nurse['nurse_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>

</html>
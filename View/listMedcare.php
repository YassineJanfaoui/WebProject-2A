<?php
include "../Controller/MedC.php";
$c = new MedCont();
$tab = $c->listMedcare();
?>

<html>
<head>
    <title>Medical Care List</title>
    <link rel="stylesheet" href="../styles/stylelistMedcare.css" />
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
    <h1>List of Medical Care</h1>
    <table>
        <tr>
            <th>Care Id </th>
            <th>Patient Id</th>
            <th>Medecine Id</th>
            <th>Dosage</th>
            <th>Frequency</th>
            <th>Delete</th>
        </tr>
        <?php
        foreach ($tab as $medical_care) {
        ?>
            <tr>
                <td><?php echo $medical_care['care_id']; ?></td>
                <td><?php echo $medical_care['patient_id']; ?></td>
                <td><?php echo $medical_care['med_id']; ?></td>
                <td><?php echo $medical_care['dosage']; ?></td>
                <td><?php echo $medical_care['frequency']; ?></td>
                <td align="center">
                <a href="deleteMedCare.php?care_id=<?php echo $medical_care['care_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>

</html>
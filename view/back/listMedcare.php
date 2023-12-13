<?php
session_start();
include "../../Controller/MedC.php";
$c = new MedCont();
$archived = 0;
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $tab = $c->listMedcarebyid($_POST['search']);
} elseif (isset($_POST['submit']) && !empty($_POST['submit']) && $archived == 0) {
    $archived = $_POST['submit'];
    $tab = $c->listArchivedMedcare();
} else
    $tab = $c->listMedcare();
?>

<html>

<head>
    <title>Medical Care List</title>
    <link rel="stylesheet" href="../../styles/stylelistMedcare.css" />
    <link rel="stylesheet" href="../../styles/navbar.css" />
</head>

<body>
<div class="container">
        <header class="nav-down">
            <p>Admin Dashboard - Welcome <?php echo $_SESSION["username"] ?></p>

        </header>
        <!-- Side navigation -->
        <div class="sidenav">
            <?php if ($_SESSION['type'] == 'admin') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="ListFeedback.php">List Feedback</a>
                <a href="ListUsers.php">List Users</a>
                <a href="listDoctors.php">List Doctors</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="add_medicines.php">Manage medicines</a>
                <a href="medicines_list.php">View medicines</a>
                <div class="nurseSelect-div">
                    <select onchange="location = this.value;" class="nurseSelect">
                        <option value="Nurses" class="nurseSelect-option">Nurses Options</option>
                        <option value="listNurse.php" class="nurseSelect-option">List Nurses</option>
                        <option value="listShift.php" class="nurseSelect-option">List Nurses Shift</option>
                        <option value="listMedcare.php" class="nurseSelect-option">List Medical care</option>
                        <option value="listnursemed.php" class="nurseSelect-option">List Nurses Medical Care</option>
                        <option value="addMedcare.php" class="nurseSelect-option">Add Medical care</option>
                        <option value="addNurse.php" class="nurseSelect-option">Add Nurse</option>
                        <option value="addshift.php" class="nurseSelect-option">Assign Shift to Nurse</option>
                        <option value="addnursemed.php" class="nurseSelect-option">Assign Nurse to Med Care</option>
                    </select>
                </div>
                <a href="listBills.php">List Bills</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } elseif($_SESSION['type'] == 'doctor') { ?>
                <a href="aAdminHomePage.php">Admin HomePage</a>
                <a href="listSurgeries.php">List Surgeries</a>
                <a href="listRooms.php">List Rooms</a>
                <a href="listpatient.php">List Patients</a>
                <a href="medicines_list.php">View medicines</a>
                <a href="listEquipments.php">List Equipments</a>
                <hr>
                <a style="color:green;" href="../front/index.php">Go to HomePage</a>
            <?php } ?>

        </div>
    </div>
    <div class="main">
        </br>
        <br>
        <br>
        <h1>List of Medical Care</h1>
        <center>
            <form method="POST" action="">
                <button type="submit" name="submit" value="<?php if($archived == 0) echo 1; else echo 0; ?>" class="button button2"><?php if($archived == 0) echo "Archived Med Care"; else echo "Unarchived Med Care"; ?></button>
            </form>
        </center>
        <form align="center" action="" method="POST">
            <b><label for="search_nav">Write Care ID</label></b>
            <input type="number" name="search" placeholder="Search...">
            <input type="submit" name="submit" value="Search">
        </form>
        <table>
            <tr>
                <th>Care Id </th>
                <th>Patient Id</th>
                <th>Patient Name</th>
                <th>Medecine Id</th>
                <th>Medecine Name</th>
                <th>Dosage</th>
                <th>Frequency</th>
                <th>Archive</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($tab as $medical_care) {
            ?>
                <tr>
                    <td><?php echo $medical_care['care_id']; ?></td>
                    <td><?php echo $medical_care['patient_id']; ?></td>
                    <td><?php echo $medical_care['patient_name']; ?></td>
                    <td><?php echo $medical_care['med_id']; ?></td>
                    <td><?php echo $medical_care['medecine_name']; ?></td>
                    <td><?php echo $medical_care['dosage']; ?></td>
                    <td><?php echo $medical_care['frequency']; ?></td>
                    <?php if ($medical_care['archived'] == 0) { ?>
                        <td><button type="button" onclick="window.location.href='archivemedcare.php?care_id=<?php echo $medical_care['care_id']; ?>'">Archive</button></td>
                    <?php } else { ?>
                        <td><button type="button" onclick="window.location.href='unarchivedmedcare.php?care_id=<?php echo $medical_care['care_id']; ?>'">Unarchive</button></td>
                    <?php } ?>
                   
                    <td align="center">
                        <a href="deleteMedCare.php?care_id=<?php echo $medical_care['care_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../scripts/navbar.js"></script>
</body>

</html>
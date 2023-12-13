<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bills List</title>


    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
    <link rel="stylesheet" href="../../Assets/CSS Styles/listBills.css">

</head>
<?php
session_start();
function getpagenbprevious($cpn, $enrg)
{
    if ($enrg->howManyRows() != 0) {

        if ($enrg->howManyRows() % 4 == 0) {
            if ($cpn == (floor($enrg->howManyRows() / 4) - 1)) {
                return $cpn;
            } else {
                return $cpn + 1;
            }
        } else {
            if ($cpn == (floor($enrg->howManyRows() / 4))) {
                return $cpn;
            } else {
                return $cpn + 1;
            }
        }
    }
    return 0;
}
function getpagenblast($enrg)
{
    if ($enrg->howManyRows() != 0) {
        if ($enrg->howManyRows() % 4 == 0) {
            return floor($enrg->howManyRows() / 4) - 1;
        } else {
            return floor($enrg->howManyRows() / 4);
        }
    } else {
        return 0;
    }
}
function statusColour($status)
{
    if ($status == 1) {
        return "green";
    } else {
        return "red";
    }
}
?>

<body align="center">

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
            <?php } elseif ($_SESSION['type'] == 'doctor') { ?>
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

    <?php
    if (isset($_GET['pagenb'])) {
        $pagenb = $_GET['pagenb'];
    } else {
        $pagenb = 0;
    }
    include "../../controller/billmanagement.php";
    $b = new BillManagement();
    $archived = 0;
    if (isset($_GET['filter']) && !empty($_GET['filter'])) {
        if ($_GET['filter'] == "paid") {
            $archived = 0;
            $tab = $b->filterByPaid($pagenb); // Add $pagenb as the argument
        } else {
            $archived = 0;
            $tab = $b->filterByUnpaid($pagenb); // Add $pagenb as the argument
        }
    } elseif (isset($_GET['pid']) && !empty($_GET['pid'])) {
        $archived = 0;
        $tab = $b->showBillByPatientId($_GET['pid']);
    } elseif (isset($_GET['archived']) && !empty($_GET['archived'])) {
        if ($_GET['archived'] == 1) {
            $archived = 1;
            $tab = $b->listArchivedBills($pagenb);
        } else {
            $archived = 0;
            $tab = $b->listBills($pagenb);
        }
    } elseif (isset($_GET['sorting']) && !empty($_GET['sorting'])) {
        if ($_GET['sorting'] == "taasc") {
            $tab = $b->sortByTotalAmountAsc($archived, $pagenb); // Add $pagenb as the second argument
        } else {
            $tab = $b->sortByTotalAmountDesc($archived, $pagenb); // Add $pagenb as the second argument
        }
    } else {
        $tab = $b->listBills($pagenb);
    }
    ?>
    <div class="main">
        <h1>Bills List</h1>
        <div id="FormDiv">
            <form align="center" action="" method="GET" style="position:relative;left:350px;margin-bottom:20px;">
                <b><label for="search_nav">Search by patient name</label></b>
                <input type="number" id="pid" name="pid">
                <input type="submit" value="Search">
            </form>
            <form align="center" method="GET" action="" id="SortForm" style="position:relative;left:100px;margin-bottom:20px;top:20px;">
                <select id="filter" name="sorting" onchange=submitForm()>
                    <option selected="Sort by" disabled>Sort by</option>
                    <option value="taasc">Total amount (low to high)</option>
                    <option value="tadesc">Total amount (high to low )</option>
                </select>
                <div style="position:relative;margin-bottom:20px;top:20px;">
                    <label for="filter">Filter by</label>
                    <button type="submit" name="filter" value="paid">Paid bills</button>
                    <button type="submit" name="filter" value="unpaid">Unpaid bills</button>
                </div>
            </form>
        </div>
        <form action="" method="GET">
            <button type="submit" name="archived" value="<?php if ($archived == 0) {
                                                                echo "1";
                                                            } else {
                                                                echo "0";
                                                            } ?>" style="position:relative;left:100px;margin-bottom:20px;top:20px;"><?php if ($archived == 0) {
                                                                                                                                        echo "Show archived bills";
                                                                                                                                    } else {
                                                                                                                                        echo "Show unarchived bills";
                                                                                                                                    } ?></button>
        </form>
        <table class="list">
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tab as $bill) : ?>
                    <tr>
                        <td><?= $bill['bill_id'] ?></td>
                        <td><?= $bill['patient_id'] ?></td>
                        <td><?= $bill['bill_type'] ?></td>
                        <td><?= $bill['consultation_price'] ?></td>
                        <td><?= $bill['surgery_price'] ?></td>
                        <td><?= $bill['total_stay_price'] ?></td>
                        <td><?= $bill['medication_cost'] ?></td>
                        <td><?= $bill['total_amount'] ?></td>
                        <td style="background-color: <?php echo statusColour($bill['paid_status']) ?> ;"><?= $bill['paid_status'] ?></td>
                        <td><button type="button" onclick="window.location.href='deleteBill.php?bill_id=<?php echo $bill['bill_id']; ?>'">Delete</button></td>
                        <td><button type="button" onclick="window.location.href='updateBill.php?bill_id=<?php echo $bill['bill_id']; ?>&consultation_price=<?php echo $bill['consultation_price']; ?>&surgery_price=<?php echo $bill['surgery_price']; ?>&total_stay_price=<?php echo $bill['total_stay_price']; ?>&medication_cost=<?php echo $bill['medication_cost']; ?>'">Update</button></td>
                        <?php
                        if ($bill['archived'] == 0) {
                            echo "<td><button type='button' onclick='window.location.href=\"archiveBill.php?bill_id=" . $bill['bill_id'] . "\"'>Archive</button></td>";
                        } else {
                            echo "<td><button type='button' onclick='window.location.href=\"unarchiveBill.php?bill_id=" . $bill['bill_id'] . "\"'>Unarchive</button></td>";
                        }
                        ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button type="button" onclick="window.location.href='addBill.php';">Add a bill</button>
        <table class="table-pagination">
            <thead>
                <tr>
                    <th>
                        <button type="button" onclick="window.location.href='listBills.php'">First</button>
                    </th>
                    <th>
                        <button type="button" onclick="window.location.href='listBills.php?<?php echo http_build_query(array_merge($_GET, ['pagenb' => ($pagenb == 0) ? 0 : ($pagenb - 1)])); ?>'">Previous</button>
                    </th>
                    <th>
                        <?php echo $pagenb + 1 ?>
                    </th>
                    <th>
                        <button type="button" onclick="window.location.href='listBills.php?<?php echo http_build_query(array_merge($_GET, ['pagenb' => getpagenbprevious($pagenb, $b)])); ?>'">Next</button>
                    </th>
                    <th>
                        <button type="button" onclick="window.location.href='listBills.php?<?php echo http_build_query(array_merge($_GET, ['pagenb' => getpagenblast($b)])); ?>'">Last</button>
                    </th>
                    </th>
            </thead>
        </table>
    </div>

    <!-- Include the script at the end of the body or use DOMContentLoaded -->
    <script lang="javascript" src="../../Assets/JavaScript Scripts/filter.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../scripts/navbar.js"></script>
    <script>
        function submitForm() {
            // Get the form element
            var form = document.getElementById("SortForm");

            // Submit the form
            form.submit();
        }
    </script>
</body>

</html>
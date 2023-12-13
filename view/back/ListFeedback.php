<?php
require "../../Controller/FeedbackC.php";
require "../../Controller/UserC.php";
session_start();
$c = new FeedbackController();
$userC = new UserController();
$test = null;
if (isset($_GET["sort"]))
$test = $_GET["sort"];
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if (isset($_GET['search_username']) && !empty($_GET['search_username'])) {
    $tab = $c->getFeedbacksByUsername($_GET['search_username'],$test, $currentPage, $itemsPerPage);
    $totalFeedbacks = $c->getTotalFeedbacksByUsername($_GET['search_username']);
} elseif (isset($_GET['search_date']) && !empty($_GET['search_date'])) {
    $tab = $c->getFeedbacksbyDate($_GET['search_date'],$test, $currentPage, $itemsPerPage);
    $totalFeedbacks = $c->getTotalFeedbacksbyDate($_GET['search_date']);
} elseif (isset($_GET['rating'])) {
    $tab = $c->getFeedbacksbyReview($_GET['rating'],$test, $currentPage, $itemsPerPage);
    $totalFeedbacks = $c->getTotalFeedbacksbyReview($_GET['rating']);
} else {
    $tab = $c->getAllFeedbacks($test,$currentPage, $itemsPerPage);
    $totalFeedbacks = $c->getTotalFeedbacks();
}
$totalPages = ceil($totalFeedbacks / $itemsPerPage);
?>
<html>

<head>
    <title>list Feedback</title>
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
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
        <h1>Feedbacks</h1>
        <div id="search">
            <form action="" method="GET">
                <div id="searchBar">
                    <label for="search_username">Search By Username:</label>
                    <input type="text" id="search_user_id" name="search_username">
                    <input type="submit" value="Search">
                </div>
            </form>
            <form action="" method="GET">
                <div id="searchBar">
                    <label for="search_date">Search By Date added:</label>
                    <input type="date" id="search_date" name="search_date">
                    <input type="submit" value="Search">
                </div>
            </form>
            <form action="" method="GET" id="rangeSearchForm">
                <label for="search_rating">Search By Rating:</label>
                <div id="searchRating">
                    <input type="range" min="0" max="5" value="<?php echo isset($_GET['rating']) ? $_GET['rating'] : 0; ?>" name="rating" list="tickmarks" onchange=" submitForm();">

                </div>
                <datalist id="tickmarks">
                        <option value="0" label="0">
                        <option value="1" label="1">
                        <option value="2" label="2">
                        <option value="3" label="3">
                        <option value="4" label="4">
                        <option value="5" label="5">
                    </datalist>

            </form>
            <a style="text-decoration:none;color:#c0c0c0;" href="ListFeedback.php"><button id="resetButton" class="button-4">Reset</button></a>
        </div>
        <table>
            <tr>
                <th width=55px>Feedback_Id</th>
                <th width=55px>Username</th>
                <th width=55px><a style=" text-decoration: none; color:#fff;" href=<?php
                        if ($test == "ASC") {
                            if (isset($_GET['search_username'])) {
                                echo "\"ListFeedback.php?sort=DESC&search_username=" . $_GET['search_username'] . "\"";
                            } elseif (isset($_GET['search_date'])) {
                                echo "\"ListFeedback.php?sort=DESC&search_date=" . $_GET['search_date'] . "\"";
                            } elseif (isset($_GET['rating'])) {
                                echo "\"ListFeedback.php?sort=DESC&rating=" . $_GET['rating'] . "\"";
                            } else {
                                echo "\"ListFeedback.php?sort=DESC\"";
                            }
                        } else {
                            if (isset($_GET['search_username'])) {
                                echo "\"ListFeedback.php?sort=ASC&search_username=" . $_GET['search_username'] . "\"";
                            } elseif (isset($_GET['search_date'])) {
                                echo "\"ListFeedback.php?sort=ASC&search_date=" . $_GET['search_date'] . "\"";
                            } elseif (isset($_GET['rating'])) {
                                echo "\"ListFeedback.php?sort=ASC&rating=" . $_GET['rating'] . "\"";
                            } else {
                                echo "\"ListFeedback.php?sort=ASC\"";
                            }
                        }
                        ?>
            >Rating</a>
                <th>Description</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($tab as $feedback) {
                $user = $userC->checkUserID($feedback['user_id']);
            ?>
                <tr>
                    <td><?php echo $feedback['feedback_id']; ?></td>
                    <td><?php echo $user["username"]; ?></td>
                    <td><?php echo $feedback['review'] . " stars"; ?></td>
                    <td><?php echo $feedback['description']; ?></td>
                    <td><?php echo $feedback['date_added']; ?></td>
                    <td><a class="action" href="RemoveFeedback.php?feedback_id=<?php echo $feedback['feedback_id']; ?>">Remove</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <div id="paginationBlock">
            <?php
            $range = 2;
            $searchParams = "";
            if (isset($_GET['search_username'])) {
                $searchParams .= "&search_username=" . $_GET['search_username'];
            } elseif (isset($_GET['search_date'])) {
                $searchParams .= "&search_date=" . $_GET['search_date'];
            } elseif (isset($_GET['rating'])) {
                $searchParams .= "&rating=" . $_GET['rating'];
            }
            if ($totalPages > 1) {
                if ($currentPage > 1) {
            ?>
                    <a class="pagination" href="ListFeedback.php?page=<?php echo $currentPage - 1;
                                                                        echo $searchParams; ?>">Prev</a>
                    <?php
                }
                for ($i = $currentPage - $range; $i < $currentPage; $i++) {
                    if ($i > 0) {
                    ?>
                        <a class="pagination" href="ListFeedback.php?page=<?php echo $i;
                                                                            echo $searchParams; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                }
                for ($i = $currentPage; $i <= $currentPage + $range && $i < $totalPages + 1; $i++) {
                    ?>
                    <a class="pagination" <?php if ($i == $currentPage) echo "style=text-decoration:underline;color:#8b0000;"; ?> href="ListFeedback.php?page=<?php echo $i;
                                                                                                                                                                echo $searchParams; ?>"><?php echo $i; ?></a>
                <?php
                }
                if ($currentPage < $totalPages) {
                ?>
                    <a class="pagination" href="ListFeedback.php?page=<?php echo $currentPage + 1;
                                                                        echo $searchParams; ?>">Next</a>
            <?php
                }
            }
            ?>

        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="../../scripts/navbar.js"></script>
<script>
function updateTextInput(val) {
    document.getElementById('ratingDisplay').innerText = val;
}

function submitForm() {
    document.getElementById('rangeSearchForm').submit();
}
</script>

</html>
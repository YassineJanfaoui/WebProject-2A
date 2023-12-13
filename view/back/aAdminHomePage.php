<?php
session_start();

require "../../controller/UserC.php";
require "../../controller/FeedbackC.php";
$userC = new UserController();
$feedbackC = new FeedbackController();
$feedbacks = $feedbackC->getAllFeedbacks2();
$feedbacksCount = $feedbackC->getTotalFeedbacks();

$dataPoints = array();

$review0 = 0;
$review1 = 0;
$review2 = 0;
$review3 = 0;
$review4 = 0;
$review5 = 0;
foreach ($feedbacks as $feedback) {
    if ($feedback['review'] == 1) {
        $review1++;
    } elseif ($feedback['review'] == 2) {
        $review2++;
    } elseif ($feedback['review'] == 3) {
        $review3++;
    } elseif ($feedback['review'] == 4) {
        $review4++;
    } elseif ($feedback['review'] == 5) {
        $review5++;
    } else {
        $review0++;
    }
}
$dataPoints = array(
    array("label" => "0", "y" => ($review0 / $feedbacksCount) * 100),
    array("label" => "1", "y" => ($review1 / $feedbacksCount) * 100),
    array("label" => "2", "y" => ($review2 / $feedbacksCount) * 100),
    array("label" => "3", "y" => ($review3 / $feedbacksCount) * 100),
    array("label" => "4", "y" => ($review4 / $feedbacksCount) * 100),
    array("label" => "5", "y" => ($review5 / $feedbacksCount) * 100)
);

include "../../controller/billmanagement.php";
$b = new BillManagement();
$income = $b->getIncome();
$expenses = $b->getExpenses();
function statusColour($status)
{
    if ($status >= 0) {
        return "green";
    } else {
        return "red";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>list Users</title>
    <link rel="stylesheet" href="../../styles/statistics.css" />
    <link rel="stylesheet" href="../../styles/stylelistUsers.css" />
    <link rel="stylesheet" href="../../styles/navbar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <script>
        window.onload = function() {
            const xValues = ["Income", "Expenses"];
            const yValues = [<?php echo $income ?>, <?php echo $expenses ?>];
            const barColors = ["#4F988D", "#2B2D42"];
            var chart = new CanvasJS.Chart("myChart", {
                backgroundColor: "transparent",
                animationEnabled: true,
                title: {
                    text: "income vs expenses"
                },
                data: [{
                    type: "pie",
                    dataPoints: [{
                            label: xValues[0],
                            y: yValues[0],
                            color: barColors[0]
                        },
                        {
                            label: xValues[1],
                            y: yValues[1],
                            color: barColors[1]
                        }
                    ]
                }]
            });
            chart.render();
            var chart = new CanvasJS.Chart("chartContainer1", {
                backgroundColor: "transparent",
                animationEnabled: true,
                title: {
                    text: "Feedbacks"
                },
                subtitles: [{
                    text: "Total Feedbacks: <?php echo $feedbacksCount ?>"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]

            });
            chart.render();
            var elementsToRemove = document.getElementsByClassName('canvasjs-chart-credit');
            var elementsArray = Array.from(elementsToRemove);
            elementsArray.forEach(function(element) {
                element.remove();
            });
        }
    </script>
    <script>

    </script>



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
        <h1>Statistics</h1>
        <div id="stats">
            <div id="chartContainer1" class="chartContainer"></div>
            <div id="myChart" class="chartContainer"></div>

        </div>
        <div style="margin-top:35%;margin-left:5%;">
            <table>
                <thead>
                    <tr>
                        <th>Clinic billing income</th>
                        <th>Equipment expenses</th>
                        <th>Net profit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $income ?></td>
                        <td><?php echo $expenses ?></td>
                        <td style="background-color: <?php echo statusColour($income - $expenses) ?> ;"><?php echo ($income - $expenses) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


    </div>

</body>

</html>
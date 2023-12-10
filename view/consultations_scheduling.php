<?php
require_once '../config/config.php'; // Adjust the path as necessary
require_once '../controller/fetch_doctors.php'; // Adjust the path as necessary

try {
    $pdo = config::getConnection(); // This is how you get the PDO object from your config class
    $stmt = $pdo->query("SELECT DISTINCT doctor_specialty FROM doctors"); // Fetch distinct specialties
    $specialties = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetching data as an associative array
} catch (PDOException $e) {
    // Handle any errors here
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultations</title>
    <link rel="stylesheet" href="../assets/css/styles.css" />
    <style>
        /* Overriding main-content style for this page */
        .main-content {
            justify-content: flex-start;
            padding-top: 90px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>
    <div class="navbar">
        <ul>
            <li><a href="add_medicines.php">Manage medicines</a></li>
            <li><a href="medicines_list.php">View medicines</a></li>
            <li><a href="consultations_scheduling.php">Consultations</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="dropdown-container">
            <div class="dropdown-wrapper">
                <select name="specialty" id="specialty" onchange="FetchDoctors(this.value)">
                    <option value="">Select Specialty</option>
                    <?php foreach ($specialties as $specialty) : ?>
                        <option value="<?= htmlspecialchars($specialty['doctor_specialty']); ?>"><?= htmlspecialchars($specialty['doctor_specialty']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="dropdown-wrapper">
                <select name="doctor" id="doctor" onchange="doctorSelected(this)" disabled>
                    <option value="">Select Doctor</option>
                    <!-- Doctors will be populated here by AJAX -->
                </select>
            </div>
        </div>

        <div class="table-container">
            <table class="schedule-table">
                <!-- Table headers -->
                <thead>
                    <tr>
                        <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) : ?>
                            <th><?= htmlspecialchars($day); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <!-- Table body -->
                <tbody>
                    <?php for ($hour = 9; $hour <= 16; $hour++) : ?>
                        <?php if ($hour != 12 && $hour != 13) : // Exclude lunch hours 
                        ?>
                            <tr>
                                <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day) : ?>
                                    <td class="time-slot non-clickable" data-day="<?= htmlspecialchars($day); ?>" data-time="<?= str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00"; ?>">
                                        <?= str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00"; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/script.js"></script>
</body>

</html>
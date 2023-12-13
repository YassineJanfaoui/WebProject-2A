<?php
session_start();
require_once '../../config.php'; // Adjust the path as necessary
require_once '../../controller/fetch_doctors.php'; // Adjust the path as necessary

try {
    $pdo = config::getConnexion(); // This is how you get the PDO object from your config class
    $stmt = $pdo->query("SELECT DISTINCT speciality FROM doctor"); // Fetch distinct specialties
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
    <link rel="stylesheet" href="../../assets/css/styles.css" />
    <link rel="stylesheet" href="../../assets/css/maicons.css">
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../../assets/css/theme.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->
</head>

<body>
    <header>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 text-sm">
                        <div class="site-info">
                            <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
                            <span class="divider">|</span>
                            <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right text-sm">
                        <div class="social-mini-button">
                            <a href="#"><span class="mai-logo-facebook-f"></span></a>
                            <a href="#"><span class="mai-logo-twitter"></span></a>
                            <a href="#"><span class="mai-logo-dribbble"></span></a>
                            <a href="#"><span class="mai-logo-instagram"></span></a>
                        </div>
                    </div>
                </div> <!-- .row -->
            </div> <!-- .container -->
        </div> <!-- .topbar -->
        <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-primary">Freud Clinic</a>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="AddFeedback.php">Feedback</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="doctors.php">Doctors</a>
            </li>
            <?php
            if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
              echo '<li class="nav-item"><a class="btn btn-primary ml-lg-3" href="login.php">Login / Register</a></li>';
            } else {
              if ($_SESSION["type"] == "admin" || $_SESSION["type"] == "doctor") {
                echo '<li class="nav-item"><a class="nav-link" href="../back/aadminhomepage.php">Welcome: ';
                echo $_SESSION["username"];
                echo '</a></li>';
                echo '<li class="nav-item"><a class="btn btn-primary ml-lg-3" href="logout.php">LogOut</a></li>';
              } else {
                echo '<li class="nav-item"><select onchange="location = this.value;" style="border: none !important;outline: none !important;background-color: #ffffff;color:#c0c0c0;">';
                echo '<option style="color:#c0c0c0;" disabled selected>Welcome: '.$_SESSION["username"].'</option>';
                echo '<option value="med.php" style="color:#c0c0c0;">Medical Care</option>';
                echo '<option value="consultations_scheduling.php" style="color:#c0c0c0;">Schedule a consultation</option>';
                echo '<option value="showpatient.php" style="color:#c0c0c0;">Your information</option>';
                echo '</select></li>';
                echo '<li class="nav-item"><a class="nav-link" href="bills.php">Payment';
                echo '</a></li>';
                echo '<li class="nav-item"><a class="btn btn-primary ml-lg-3" href="logout.php">LogOut</a></li>';
              }
            }
            ?>


          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
    </header>

    <div class="page-section">
        <div class="container">
            <div class="row">
                <div class="dropdown-container">
                    <div class="dropdown-wrapper">
                        <select name="specialty" id="specialty" onchange="FetchDoctors(this.value)">
                            <option value="">Select Specialty</option>
                            <?php foreach ($specialties as $specialty) : ?>
                                <option value="<?= htmlspecialchars($specialty['speciality']); ?>"><?= htmlspecialchars($specialty['speciality']); ?></option>
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
    </div>
    <script src="../../assets/js/jquery-3.5.1.min.js"></script>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>

<script src="../../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../../assets/vendor/wow/wow.min.js"></script>

<script src="../../assets/js/theme.js"></script>
    <script src="../../assets/js/script.js"></script>
</body>

</html>
<?php
session_start();
include "../../controller/billmanagement.php";
$b = new BillManagement();
$tab = $b->showBillByPatientId($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Freud Health - Medical Center HTML5 Template</title>
  <link rel="stylesheet" href="../../assets/css/maicons.css">
  <link rel="stylesheet" href="../../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../../assets/css/theme.css">

  <link rel="stylesheet" href="../../Assets/Css Styles/payment.css">
  <link rel="stylesheet" href="../../Assets/CSS Styles/bills.css">
</head>

<body>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +216 71 505 200</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> freud-clinic@mail.com</a>
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

  <div class="page-banner overlay-dark bg-image" style="background-image: url(../../Assets/Img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Payment</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Set up payment method</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->
  <div class="container-bills" align="center">

    <table>
      <thead>
        <tr>
          <th>Bill ID</th>
          <th>Patient ID</th>
          <th>Bill Type</th>
          <th>Consultation Price</th>
          <th>Surgery Price</th>
          <th>Total Stay Price</th>
          <th>Medication Price</th>
          <th>Total Amount</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tab as $bill) :
          if ($bill['paid_status'] == 0) { ?>
            <tr>
              <td><?= $bill['bill_id'] ?></td>
              <td><?= $bill['patient_id'] ?></td>
              <td><?= $bill['bill_type'] ?></td>
              <td><?= $bill['consultation_price'] ?></td>
              <td><?= $bill['surgery_price'] ?></td>
              <td><?= $bill['total_stay_price'] ?></td>
              <td><?= $bill['medication_cost'] ?></td>
              <td><?= $bill['total_amount'] ?></td>
              <td class="action-buttons">
                <button type="button" onclick="window.location.href='payBill.php?bill_id=<?= $bill['bill_id']; ?>'">Pay</button>
              </td>
            </tr>
        <?php }
        endforeach; ?>
      </tbody>
    </table>
  </div>

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">Editorial Team</a></li>
            <li><a href="#">Protection</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>More</h5>
          <ul class="footer-menu">
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Advertise</a></li>
            <li><a href="#">Join as Doctors</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Our partner</h5>
          <ul class="footer-menu">
            <li><a href="#">Freud-Fitness</a></li>
            <li><a href="#">Freud-Drugs</a></li>
            <li><a href="#">Freud-Live</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">Cité la gazelle, Rue de la jeunsesse, 2083 Ariana</p>
          <a href="#" class="footer-link">+216 71 505 200</a>
          <a href="#" class="footer-link">freud-clinic@mail.com</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">Copyright &copy; 2023 <a href="https://macodeid.com/" target="_blank">MACode ID</a>. All rights reserved</p>
    </div>
  </footer>

  <script src="../../Assets/JavaScript Scripts/jquery-3.5.1.min.js"></script>

  <script src="../../Assets/JavaScript Scripts/bootstrap.bundle.min.js"></script>

  <script src="../../Assets/vendor/owl-carousel/JavaScript Scripts/owl.carousel.min.js"></script>

  <script src="../../Assets/vendor/wow/wow.min.js"></script>

  <script src="../../Assets/JavaScript Scripts/theme.js"></script>
</body>

</html>
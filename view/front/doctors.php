<?php
session_start();
include "../../controller/DoctorController.php";
$doctorC = new DoctorC();
$listDoctors = $doctorC->listDoctors();
$num = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Freud Clinic</title>

  <link rel="stylesheet" href="../../assets/css/maicons.css">

  <link rel="stylesheet" href="../../assets/css/bootstrap.css">

  <link rel="stylesheet" href="../../assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../../assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../../assets/css/theme.css">
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

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

  <div class="page-banner overlay-dark bg-image" style="background-image: url(../../assets/img/bg_image_1.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Doctors</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Our Doctors</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section bg-light">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">

          <div class="row">
            <?php
            
            foreach ($listDoctors as $doctor) {
            if($num<7)
            {
              if($doctor["IMG"]!=null)
              {
            echo '<div class="col-md-6 col-lg-4 py-3 wow zoomIn">
              <div class="card-doctor">
                <div class="header">
                  <img src="../../assets/img/doctors/'.$doctor["IMG"].'.jpg" alt="">
                  <div class="meta">
                    <a href="#"><span class="mai-call"></span></a>
                    <a href="#"><span class="mai-logo-whatsapp"></span></a>
                  </div>
                </div>
                <div class="body">
                  <p class="text-xl mb-0">'.$doctor["IMG"].'</p>
                  <span class="text-sm text-grey">'.$doctor["speciality"].'</span>
                </div>
              </div>
            </div>';
            $num++;
              }
            }
            }
            ?>

          </div>

        </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->


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
            <li><a href="listUsers.php">Go to Dashboard</a></li>
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
            <li><a href="#">One-Fitness</a></li>
            <li><a href="#">One-Drugs</a></li>
            <li><a href="#">One-Live</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Contact</h5>
          <p class="footer-link mt-2">351 Willow Street Franklin, MA 02038</p>
          <a href="#" class="footer-link">701-573-7582</a>
          <a href="#" class="footer-link">healthcare@temporary.net</a>

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

      <p id="copyright">Copyright &copy; 2020 <a href="https://macodeid.com/" target="_blank">MACode ID</a>. All right reserved</p>
    </div>
  </footer>

<script src="../../assets/js/jquery-3.5.1.min.js"></script>

<script src="../../assets/js/bootstrap.bundle.min.js"></script>

<script src="../../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../../assets/vendor/wow/wow.min.js"></script>

<script src="../../assets/js/theme.js"></script>
  
</body>
</html>
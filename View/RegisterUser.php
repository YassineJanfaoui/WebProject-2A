<?php
require "../controller/UserC.php";
$error = "";
$user = null;
$userC = new UserController();
$to = null;
$subject = "Thank You.";


if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["first_name"]) && isset($_POST["family_name"]) && isset($_POST["email_address"]) && isset($_POST["contact_number"])) //input control
{
  if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["first_name"]) && !empty($_POST["family_name"]) && !empty($_POST["email_address"]) && !empty($_POST["contact_number"])) {

    $user = new User(null, $_POST["username"], $_POST["password"], $_POST["first_name"], $_POST["family_name"], $_POST["email_address"], $_POST["contact_number"], "patient", null);    //adding values to new user object
    $userC->addUser($user);

    session_start();
    $user = $userC->getUser($_POST["username"]);
    $_SESSION["user_id"] = $user->getUserID();
    $_SESSION["username"] = $user->getUsername();
    $_SESSION["type"] = $user->getRole();

    $to = $_POST["email_address"];
    $message = "Thank You".$_POST["first_name"]." for putting your trust in us and joining freud clinic.\n
    We will try our best to provide you with the best service possible.\n
    We hope you have a great day.\n
    -Freud Clinic Team";
    $headers = "From: no-reply@gmail.com" . "\r\n" .
      "Reply-To: " . $to . "\r\n";
    $mailSuccess = mail($to, $subject, $message, $headers);
    if ($mailSuccess) {
      echo "Email sent successfully";
    } else {
      echo "Email sending failed";
    }

    header('Location:index.php');

  } else {
    $error = "Missing information";
  }
} ?>



<!DOCTYPE html>
<html>

<head>
  <title>Freud Clinic</title>
  <link rel="stylesheet" href="../assets/css/maicons.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
  <link rel="stylesheet" href="../assets/css/theme.css">
  <link rel="stylesheet" href="../styles/styleAddUser.css" />
</head>

<body>
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
        <a class="navbar-brand" href="index.php"><span class="text-primary">One</span>-Health</a>

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
              echo '<li class="nav-item"><a class="nav-link" href="#">username:';
              echo $_SESSION["username"];
              echo '</a></li>';
              echo '<li class="nav-item"><a class="btn btn-primary ml-lg-3" href="logout.php">LogOut</a></li>';
            }
            ?>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
  <h1 id="formTitle">Register new User</h1>
  <form action="" method="POST" id="form">
    <label for="name" class="Input_title">First name:</label><br />
    <input type="text" name="first_name" class="input_box" placeholder="Your first name here" id="fn" required /><br />

    <label for="name" class="Input_title">Family name:</label><br />
    <input type="text" name="family_name" class="input_box" placeholder="Your family name here" id="ln" required /><br />

    <label for="name" class="Input_title">Username:</label><br />
    <input type="text" name="username" class="input_box" placeholder="Your username here" id="username" required />
    <span id="password-message" class="error"></span><br />

    <label for="name" class="Input_title">Password:</label><br />
    <input type="password" name="password" class="input_box" placeholder="Your password here" id="password" required />
    <span id="confirm-message" class="error"></span><br />

    <label for="name" class="Input_title">Confirm Password:</label><br />
    <input type="password" name="ConfirmPassword" class="input_box" placeholder="Confirm your password here" id="confirm" required />
    <span id="email-message" class="error"></span><br />

    <label for="name" class="Input_title">Email address:</label><br />
    <input type="text" name="email_address" class="input_box" placeholder="Your email address here" id="email" required />
    <span id="phone-message" class="error"></span><br />


    <label for="name" class="Input_title">Contact number:</label><br />
    <input type="text" name="contact_number" class="input_box" placeholder="Your contact number here" id="num" required /><br />

    <input type="submit" name="submit" id="submit" value="Register" />
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

        <p id="copyright">Copyright &copy; 2020 <a href="https://macodeid.com/" target="_blank">MACode ID</a>. All right
          reserved</p>
      </div>
    </footer>
    <script src="../scripts/UserControl.js"></script>
</body>



</html>
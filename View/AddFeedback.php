<?php
include "../Controller/FeedbackC.php";
include "../Model/FeedbackModel.php";
include "../Controller/UserC.php";
$error = "";
$success = 0;
$feedback = null;
$num = 0;
$feedbackC = new FeedbackController();
$userC = new UserController();
$positive = $feedbackC->getPositiveFeedbacks();
session_start();

if (isset($_SESSION["user_id"]) && isset($_POST["description"]) && isset($_POST["stars"])) //input control
{
    if (!empty($_SESSION["user_id"]) && !empty($_POST["description"]) ) {
      if ($userC->checkUserID($_SESSION["user_id"])!=null)
      {
        $date = date('Y-m-d');
        $feedback = new Feedback(null, $_SESSION["user_id"], $_POST["description"],$date,$_POST["stars"]);    //adding values to new feedback object
        $feedbackC->addfeedback($feedback);
        $success = 1;
      }
      else
      {
        $error = "User ID not found";
        $success = 0;
      }
    } else {
        $error = "Missing information";
        $success = 0;
    }
} 

?>




<!DOCTYPE html>
<html>

<head>
    <title>Freud Clinic</title>
    <link rel="stylesheet" href="../assets/css/maicons.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/owl-carousel/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="../assets/css/theme.css">
    <link rel="stylesheet" href="../styles/styleFeedback.css" />
</head>

<body>
  <div class="overlay" id="blur">
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
if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]))
{
  echo '<li class="nav-item"><a class="btn btn-primary ml-lg-3" href="login.php">Login / Register</a></li>';
}
else
{
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
    <h1 id="formTitle">Feedback</h1><br>
    <form action="" method="POST">
        <label for="name" id="nameTitle">User_id:</label>
        <?php
        if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]))
        {
          echo '<span id="user_id">You must be logged in.</span></br>';
          echo '<label  id="nameTitle" style="position:relative;top:15px;">Reviews from other users:</label>
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-10">
      
                <div class="row">';
                  foreach($positive as $feedback)
                  {
                    if ($num == 6)
                    {
                      break;
                    }
                    echo '
                    <div class="col-md-6 col-lg-4 py-3 wow zoomIn">
              <div class="card-doctor">
                <div class="body">
                  <p class="text-xl mb-0">'.$userC->checkUserID($feedback["user_id"])["username"].'</p>
                  <p class="text-xl mb-0">'.$feedback["review"].' stars</p>
                  <span class="text-sm text-grey">'.$feedback["description"].'</span>
                </div>
              </div>
            </div>';
                  }
                  
               echo '</div>
      
              </div>
            </div>
          </div> <!-- .container -->
        ';
        }
        else
        {
          echo '<span id="user_id">' . $_SESSION["user_id"] . '</span></br></br>';
          echo '<label for="review" id="reviewTitle">Review:</label><br />';
          echo '<div class="rating">
          <label>
          <input type="hidden" name="stars" value=0 />
          </label>
          <label>
          <input type="radio" name="stars" value=1 />
          <span class="icon">★</span>
        </label>
        <label>
          <input type="radio" name="stars" value=2 />
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        <label>
          <input type="radio" name="stars" value=3 />
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        <label>
          <input type="radio" name="stars" value=4 />
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label>
        <label>
          <input type="radio" name="stars" value=5 />
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
          <span class="icon">★</span>
        </label></div>
        <br />';
          echo '<label for="feedback" id="feedbackTitle">Feedback:</label><br />
          <textarea name="description" id="description" rows="5" cols="20" placeholder="Comments Here" required></textarea><br />
          <input type="submit" name="submit" id="submit" value="Submit Feedback" />';
        }

        ?>
    </form>
    </div>
    <span id="error"><?php echo $error; ?></span>
    <?php
    /*if($success == 1)
    {
      echo "<div id='popup active'>
      <h2>Feedback added successfully</h2>
      <a href='AddFeedback.php'><button id='closePopup' onclick=''>Close</button></a>
      </div>
      <script>
      var blur = document.getElementById('blur');
      blur.classList.toggle('active');
      </script>
      ";
    }*/?>
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
  
  
</body>
</html>
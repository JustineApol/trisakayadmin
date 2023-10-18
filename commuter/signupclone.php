<?php
session_start();
if (isset($_SESSION['Email_Session'])) {
  header("Location: signupcommuter.php");
  die();
}
include('config.php');

$msg = "";
$Error_Pass = "";
$password_error = "";

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['full_name']);
  $email = mysqli_real_escape_string($conn, $_POST['Email']);
  $password = mysqli_real_escape_string($conn, md5($_POST['Password']));
  $confirm_password = mysqli_real_escape_string($conn, md5($_POST['Conf-Password']));
  $Code = mysqli_real_escape_string($conn, md5(rand()));

  // Validate password
  $password_error = validatePassword($password);

  if ($password_error) {
    $msg = "<div class='alert alert-danger'>{$password_error}</div>";
  } elseif ($password !== $confirm_password) {
    $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match</div>";
    $Error_Pass = 'style="border: 1px solid red; box-shadow: 0px 1px 11px 0px red; height: 82px;"';
  } else {
    $Password = mysqli_real_escape_string($conn, md5($password));

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM com_sign_up where email='{$email}'")) > 0) {
      $msg = "<div class='alert alert-danger'>This Email:'{$email}' has already been registered.</div>";
    } else {
      $query = "INSERT INTO com_sign_up(`full_name`, `email`, `Password`, `CodeV`) values('$name','$email','$Password','$Code')";
      $result = mysqli_query($conn, $query);

      if ($result) {
        // Create an instance; passing `true` enables exceptions
        // ... Rest of the email sending logic ...
        $msg = "<div class='alert alert-info'>We've sent a Verification Link to your Email Address</div>";
      } else {
        $msg = "<div class='alert alert-danger'>Something went wrong</div>";
      }
    }
  }
}

function validatePassword($password) {
  if (strlen($password) < 8 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[^a-zA-Z\d]/', $password)) {
    return 'Password must be at least 8 characters long and include a mix of letters, numbers, and special characters.';
  }
  return null;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>TriSakay Commuter Sign up </title>
  <meta name="viewport" content="width=device-width,
      initial-scale=1.0" />
  <link rel="stylesheet" href="css/signup.css" />
</head>

<style>
  body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    /* Specify your desired font */
  }

  .background-section {
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    position: relative;
    width: 100%;
    height: 110vh;
    /* Adjust the height as needed */
  }

  .container {
    background-color: transparent;

    padding: 20px;
    margin: 20px;
    max-width: 400px;

    position: relative;
    z-index: 1;
    /* Place the form on top of the background */
  }

  img.trisakay {
    margin-left: 1px;
    margin-bottom: 25px;
    display: block;
  }

  .alert-danger {
    background-color: #6089D5;
    color: #fff;
  }

  .alert-info {
    background-color: #6089D5;
    color: #fff;
  }

  p {
    color: white;
    margin-bottom: 10px;
  }

  a {
    color: white;
  }

  .form-submit-btn {
    margin-right: 35px;
    border-radius: 20px;
  }

  .form-title {
    margin-right: 35px;
  }
  .btn{
    
  }
</style>

<body>
  <div class="background-svg">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
      <defs>
        <linearGradient id="bg">
          <stop offset="0%" style="stop-color:rgba(130, 158, 249, 0.06)"></stop>
          <stop offset="50%" style="stop-color:rgba(76, 190, 255, 0.6)"></stop>
          <stop offset="100%" style="stop-color:rgba(115, 209, 72, 0.2)"></stop>
        </linearGradient>
        <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
  s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
      </defs>
      <g>
        <use xlink:href='#wave' opacity=".3">
          <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
            values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
            repeatCount="indefinite" />
        </use>
        <use xlink:href='#wave' opacity=".6">
          <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
            values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
            repeatCount="indefinite" />
        </use>
        <use xlink:href='#wave' opacty=".9">
          <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
            values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
            repeatCount="indefinite" />
        </use>
      </g>
    </svg>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
      width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
        <defs>
          <linearGradient id="bg">
            <stop offset="0%" style="stop-color:rgba(130, 158, 249, 0.06)"></stop>
            <stop offset="50%" style="stop-color:rgba(76, 190, 255, 0.6)"></stop>
            <stop offset="100%" style="stop-color:rgba(115, 209, 72, 0.2)"></stop>
          </linearGradient>
          <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
  s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
        </defs>
        <g>
          <use xlink:href='#wave' opacity=".3">
            <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="10s" calcMode="spline"
              values="270 230; -334 180; 270 230" keyTimes="0; .5; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
              repeatCount="indefinite" />
          </use>
          <use xlink:href='#wave' opacity=".6">
            <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="8s" calcMode="spline"
              values="-270 230;243 220;-270 230" keyTimes="0; .6; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
              repeatCount="indefinite" />
          </use>
          <use xlink:href='#wave' opacty=".9">
            <animateTransform attributeName="transform" attributeType="XML" type="translate" dur="6s" calcMode="spline"
              values="0 230;-140 200;0 230" keyTimes="0; .4; 1" keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
              repeatCount="indefinite" />
          </use>
        </g>
      </svg>
    </svg>

    <div class="container">
      <img class="trisakay" src="img/trisakay1.png" height="100" width="320" class="responsive">

      <h1 class="form-title">Commuter Sign Up</h1>
      <form action="" method="POST" class="sign-up-form">
        <?php echo $msg ?>
        <div class="main-user-info">

          <div class="user-input-box">
            <label for="username">Full Name</label>
            <input type="text" name="full_name" placeholder="Full Name" value="<?php if (isset($_POST['full_name'])) {
              echo $name;
            } ?>" required />
          </div>
          <div class="user-input-box">
            <label for="">Email</label>
            <input type="email" name="Email" placeholder="Email" value="<?php if (isset($_POST['Email'])) {
              echo $email;
            } ?>" required />
          </div>
          <div class="user-input-box <?php echo $password_error ? 'has-error' : ''; ?>">
    <label for="Password">Password</label>
    <input type="password" name="Password" placeholder="Password" required />
    <?php if ($password_error) { ?>
        
    <?php } ?>
</div>
          <div class="user-input-box" <?php echo $Error_Pass ?>>
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="Conf-Password" placeholder="Confirm Password" required />
          </div>
          <p> Sign Up as: <a href="signupdriver.php">Driver</a>
          <p> Already have an account? <a href="../index.php">Login</a></p>
        </div>
        <div class="form-submit-btn">
          <input type="submit" value="Sign up" class="btn" name="submit">
        </div>

      </form>
    </div>

</body>

</html>
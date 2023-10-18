<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the form data and sanitize it
    $FirstName = filter_var($_POST["FirstName"], FILTER_SANITIZE_STRING);
    $LastName = filter_var($_POST["LastName"], FILTER_SANITIZE_STRING);
    $Email = filter_var($_POST["Email"], FILTER_SANITIZE_EMAIL);
    $Toda = filter_var($_POST["Toda"], FILTER_SANITIZE_STRING);
    $TerminalNumber = filter_var($_POST["TerminalNumber"], FILTER_SANITIZE_STRING);
    $datetime = $_POST["datetime"]; // You may want to validate the date format
    
    // Hash and salt the password
    $Password = password_hash($_POST["Password"], PASSWORD_DEFAULT);

    // Database credentials
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "maps";

    // Create a database connection
    $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    // Check for connection errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert the data into the database using a prepared statement
    $sql = "INSERT INTO `dispatcher`(`FirstName`, `LastName`, `Email`, `TODA`, `DateCreated`, `Password`)  VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssss", $FirstName, $LastName, $Email, $Toda, $datetime, $Password);
        
        if ($stmt->execute()) {
            echo "Driver Added Successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Error: Unable to prepare the statement.";
    }

    // Close the database connection
    $mysqli->close();
}
?>

<?php
echo '<style>
    .trisakay {
        position: absolute;
        top: -100px; /* Adjust this value to move the image vertically */
        left: 120px; /* Adjust this value to move the image horizontally */
    }
</style>';
echo '<img class="trisakay" src="trisakay1.png" height="100" width="350" class="responsive">';
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
    overflow-x: hidden;
    justify-content: center;
    align-items: center;
    display: flex;
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
    margin: 10px;
    max-width: 650px;
    position: relative;
    /* Place the form on top of the background */
    display: flex;
    flex-direction: column;
    justify-content: center;
       
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
 





.form-title{
    font-size: 26px;
    font-weight: 600;
    text-align: center;
    padding-bottom: 6px;
    color: white;
    text-shadow: 2px 2px 2px black;
    border-bottom: solid 1px white;
}

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}

.user-input-box:nth-child(2n){
    justify-content: end;
}

.user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 50%;
    padding-bottom: 15px;
}

.user-input-box label{
    width: 95%;
    color: white;
    font-size: 20px;
    font-weight: 400;
    margin: 5px 0;
}

.user-input-box input{
    height: 40px;
    width: 95%;
    border-radius: 7px;
    outline: none;

    padding: 0 10px;
}


.form-submit-btn{
    margin-top: 40px;
}

.form-submit-btn input{
    display: block;
    width: 100%;
    margin-top: 10px;
    font-size: 20px;
    padding: 10px;
    border:none;
    border-radius: 3px;
   
    
}

.form-submit-btn input:hover{
    background: #3b8875;
    color: #fff;
}
svg {
    position: absolute;
    top: 0;
    left: 0;
width: 100%;
height: 100%;
    box-sizing: border-box;
    display: block;
    background-color: white;
background-image: linear-gradient(to bottom, #3b8875, #0e4166);
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
      <img class="trisakay" src="trisakay1.png" height="100" width="350" class="responsive">
      <h1 class="form-title">Add Dispatcher</h1>
      <form action="" method="POST" class="sign-up-form">
        <div class="main-user-info">
          <div class="user-input-box">
          <input type="text" name="FirstName" id="FirstName" required>
            <label for="FirstName">First Name</label>
          </div>
          <div class="user-input-box">
          <input type="LastName" name="LastName" id="LastName" required>
            <label for="LastName">Last Name</label>
          </div>
          <div class="user-input-box">
          <input type="Email" name="Email" id="Email" required>
                        <label for="email">Email</label>
          </div>
          <div class="user-input-box">
          <input type="Text" name="Toda" id="Toda" required>
                        <label for="Toda">Toda</label>
          </div>
          <div class="user-input-box">
          <input type="password" name="Password" id="Password" required>
                        <label for="Password">Password</label>
          </div>
          <div class="user-input-box">
          <input type="text" name="TerminalNumber" id="TerminalNumber" required>
                        <label for="TerminalNumber">Terminal Number</label>
          </div>
          <input type="hidden" name="datetime" value="<?php echo date('Y-m-d H:i:s'); ?>" />
        </div>
        <div class="form-submit-btn">
          <input type="submit" id="login" name="login" value="Submit" class="btn">
        </div>

      </form>
    </div>

</body>

</html>
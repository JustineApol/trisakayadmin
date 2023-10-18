<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\src\SMTP;
 use PHPMailer\PHPMailer\Exception;
 
session_start();
include_once('conn1.php');

if(isset($_REQUEST['login']))
{
  $email = $_REQUEST['email'];
  $select_query = mysqli_query($conn,"select * from admin where email='$email'");
  $res = mysqli_num_rows($select_query);
  if($res>0)
  {
    $data = mysqli_fetch_array($select_query);
    $name = $data['name'];
    $_SESSION['name'] = $name;
    $otp = rand(10000, 99999);   //Generate OTP
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    
    $message = '<div>
     <p>Use this OTP Code to access Trisakay Admin System.</p>
     <br>
     <p>Your OTP is: <b>'.$otp.'</b></p>
     <br>
     <p>If you did not request OTP, no further action is required.</p>
    </div>';
   
    require 'vendor/autoload.php';
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Your SMTP server address
    $mail->SMTPAuth = true;
    $mail->Username = 'trisakay977@gmail.com';
    $mail->Password = 'grintluwuzhcpelt';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587; 
$mail->FromName = "Trisakay";
$mail->AddAddress($email);
$mail->Subject = "OTP";
$mail->isHTML( TRUE );
$mail->Body =$message;

if($mail->send())
{
  $insert_query = mysqli_query($conn,"insert into admin_otp_checker set otp='$otp', is_expired='0'");
  header('location:otpverify.php');
}
else
{
  $msg = "Email not delivered";
}
}
  else
  {
    $msg = "Invalid Email";
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../css/index1.css">
  <title>Trisakay | Admin Login</title>

</head>
<style>
  svg {
    display: block;
    margin: 0 auto;
}
</style>
<body>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="300" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
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
				<animateTransform
          attributeName="transform"
          attributeType="XML"
          type="translate"
          dur="10s"
          calcMode="spline"
          values="270 230; -334 180; 270 230"
          keyTimes="0; .5; 1"
          keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
			</use>
			<use xlink:href='#wave' opacity=".6">
				<animateTransform
          attributeName="transform"
          attributeType="XML"
          type="translate"
          dur="8s"
          calcMode="spline"
          values="-270 230;243 220;-270 230"
          keyTimes="0; .6; 1"
          keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
			</use>
			<use xlink:href='#wave' opacty=".9">
				<animateTransform
          attributeName="transform"
          attributeType="XML"
          type="translate"
          dur="6s"
          calcMode="spline"
          values="0 230;-140 200;0 230"
          keyTimes="0; .4; 1"
          keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
          repeatCount="indefinite" />
			</use>
		</g>
	</svg>

    <section>
        <div class="form-box">
            <div class="form-value">
            <form method="POST">
            <img class="trisakay" src="../#6089D5img/trisakay1.png" height="115">   
                    <h2>Admin Log In</h2>
                    
                    <div class="inputbox">
                        <input type="email" name="email" id="email" required>
                        <label for="email">Email</label>
                    </div>
                    <button type="submit" id="login" name="login" value="Submit" class="btn btn-success">Get OTP</button>
                   
                  </div> 
                  
               </div>
             </section>
             
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

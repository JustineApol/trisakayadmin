<?php
session_start();
if (empty($_SESSION['name'])) {
    header('location:index.php');
}
include_once('conn.php');
$msg = ""; // Initialize error message

if (isset($_POST['otp_verify'])) {
    $otp = $_POST['otp'];

    // Debug statements
    echo "Entered OTP: $otp<br>";
    echo "Current Time: " . date('Y-m-d H:i:s') . "<br>";

    // Retrieve the create_at value from the database result
    $select_query = mysqli_query($conn, "SELECT * FROM admin_otp_checker WHERE otp='$otp' AND is_expired!=1 AND NOW() <= DATE_ADD(create_at, INTERVAL 5 MINUTE)");

    if ($select_query) {
        $data = mysqli_fetch_assoc($select_query); // Fetch the row from the result

        if ($data !== null) { // Check if $data is not null
            $create_at = $data['create_at']; // Retrieve the create_at value

            echo "Expiry Time: " . date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime($create_at))) . "<br>";

            $count = mysqli_num_rows($select_query);
            if ($count > 0) {
                $update_query = mysqli_query($conn, "UPDATE admin_otp_checker SET is_expired=1 WHERE otp='$otp'");
                header('location:propose_farematrix.php');
                exit();
            } else {
                $msg = "Invalid OTP!";
            }
        } else {
            $msg = "Invalid OTP!";
        }
    } else {
        $msg = "Database error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/index1.css">
  <title>Trisakay | Admin Login</title>
  
</head>
<body>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
		xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
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
            <form method="POST" autocomplete="">
            <img class="trisakay" src="img/trisakay1.png" height="115">   
                    <h2>OTP Verification</h2>

                    <div class="inputbox">
                        <input type="text" name="otp" id="otp" required>
                        <label for="">OTP</label>
                    </div>
                    <button type="submit" id="submit" name="otp_verify" value="Submit">Confirm</button>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

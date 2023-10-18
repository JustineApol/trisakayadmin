<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $toda = $_POST["Toda"];
    $datetime = $_POST["datetime"];

    // Connect to the database (replace with your database credentials)
    $mysqli = new mysqli("localhost", "root", "", "maps");

    // Check for connection errors
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Insert the data into the database
    $sql = "INSERT INTO dispatcher (FirstName, LastName, Email, Password, TODA, datetime) VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $password, $toda, $datetime);
        
        if ($stmt->execute()) {
            echo "Driver Added Successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }

    // Close the database connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/index1.css">
  <title>Trisakay | Add Dispatcher</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
*{
    margin: 0;
    padding: 0;
    font-family: 'poppins',sans-serif;
}
section{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100%;
    
}


.form-box{
    position: relative;
    width: 450px;
    height: 500px;
    background: transparent;
    border: 5px solid rgba(255,255,255,0.5);
    border-radius: 10px;
    backdrop-filter: blur(15px);
    display: flex;
    justify-content: center;
    align-items: center;

}
h2{
    font-size: 2em;
    color: #fff;
    text-align: center;
}
.inputbox{
    position: relative;
    margin: 30px 0;
    width: 340px;
    border-bottom: 2px solid #fff;
}
.inputbox label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}
input:focus ~ label,
input:valid ~ label{
top: -5px;
}
.inputbox input {
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;
}

button{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background: #fff;
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1em;
    font-weight: 600;
}
img{
    margin-bottom: 30%;
}
.inputbox1{
    position: relative;
    margin: 30px 0;
    width: 335px;
    border-bottom: 2px solid #fff;
}
.inputbox1 label{
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    transition: .5s;
}
input:focus ~ label,
input:valid ~ label{
top: -5px;
}
.inputbox1 input {
    width: 100%;
    height: 50px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1em;
    padding:0 35px 0 5px;
    color: #fff;   
}
img{
    margin-bottom: 10%;
}
.svg-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Adjust the height as needed */
    z-index: -1; /* Ensure the SVG is rendered behind the content */
    background-image: linear-gradient(to bottom, #3b8875, #0e4166);

  }
  
</style>
<body>
<div class="svg-container">
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
    </div>

    <section>
        <div class="form-box">
            <div class="form-value">
            <form method="POST">
            <img class="trisakay" src="img/trisakay1.png" height="115">   
                    <h2>Add Dispatcher</h2>

                    <div class="inputbox">
                        <input type="text" name="FirstName" id="FirstName" required>
                        <label for="FirstName">First Name</label>
                    </div>
                    <div class="inputbox">
                        <input type="LastName" name="LastName" id="LastName" required>
                        <label for="LastName">Last Name</label>
                    </div>
                    <div class="inputbox">
                        <input type="email" name="email" id="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="Password" id="Password" required>
                        <label for="Password">Password</label>
                    </div>
                    <div class="inputbox">
                        <input type="text" name="Toda" id="Toda" required>
                        <label for="Toda">Toda</label>
                    </div>

                    <input type="hidden" name="datetime" value="<?php echo date('Y-m-d H:i:s'); ?>" />

                    <button type="submit" id="login" name="login" value="Submit" class="btn btn-success">Add Account</button>
                   
                  </div> 
                  
               </div>
             </section>
             
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
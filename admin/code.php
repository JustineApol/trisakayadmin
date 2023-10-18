<?php
session_start();
require 'conn.php';

    if (isset($_POST['propose_fare'])) {
        $fare_id = mysqli_real_escape_string($conn, $_POST['fare_id']);
        $propose_fare = mysqli_real_escape_string($conn, $_POST['propose_fare']);
        $date_proposed = mysqli_real_escape_string($conn, $_POST['date_proposed']);
        $proposed_by = mysqli_real_escape_string($conn, $_POST['proposed_by']);
        $ip_address = mysqli_real_escape_string($conn, $_POST['ip_address']);


        $query = "INSERT INTO propose_farematrix (propose_fare,date_proposed,proposed_by,ip_address) 
    VALUES (' $propose_fare',' $date_proposed','$proposed_by','$ip_address'";

        $query_run = mysqli_query($conn, $query);
        if ($query_run) {
            $_SESSION['message'] = "Driver Created Successfully";
            header("Location: home.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Driver Not Created";
            header("Location: create_driver.php");
            exit(0);
        }
    }

if (isset($_POST['login'])){
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

     $select = mysqli_query($conn, "SELECT * FROM admin WHERE admin_name ='$admin_name' AND admin_password = '$admin_password' ");
     $row = mysqli_fetch_array($select);

     if(is_array($row)){
        $_SESSION["admin_name"] = $row['admin_name'];
        $_SESSION["admin_password"] = $row['admin_password'];    
     }else{
        echo '<script type ="text/javascript">';
        echo 'alert("Invalid Username or Password")';
        echo 'window.location.href = "index.php"';
        echo '</script>';
     }
}


//-----------------------------------------INSERT MO MUNA SYA SA ARCHIVE MO NA TABLE---------------------------------------------------
if(isset($_POST['#']))
{
    $driver_id = $_POST['driver_id'];
    $driver_firstname = $_POST['driver_firstname'];
    $driver_middlename = $_POST['driver_middlename'];
    $driver_lastname = $_POST['driver_lastname'];
    $driver_contactnumber = $_POST['driver_contactnumber'];
    $chasis_number = $_POST['chasis_number'];
    $body_number = $_POST['body_number'];
    $reference_number = $_POST['reference_number'];
    $model_of_motor = $_POST['model_of_motor'];
    $year_model = $_POST['year_model'];
    $color = $_POST['color'];
    $toda = $_POST['toda'];
    
    
    $query = "INSERT INTO archive_driver (driver_id, driver_firstname, driver_middlename, driver_lastname, driver_contactnumber, chasis_number, reference_number, model_of_motor, year_model, color, toda) 
    VALUES (:driver_id, :driver_firstname, :driver_middlename, :driver_lastname, :driver_contactnumber, :chasis_number, :reference_number, :model_of_motor, :year_model, :color, :toda)";
    $query_run = $conn->prepare($query);
    
    $data = [
        ':driver_id' => $driver_id,
        ':driver_firstname' => $driver_firstname,
        ':driver_middlename' => $driver_middlename,
        ':driver_lastname' => $driver_lastname,
        ':driver_contactnumber' => $driver_contactnumber,
        ':chasis_number' => $chasis_number,
        ':reference_number' => $reference_number,
        ':model_of_motor' => $model_of_motor,
        ':color' => $color,
        ':toda' => $toda,
    ];
$query_execute = $query_run->execute($data);

if($query_execute)
{
    $_SESSION['message'] = "Added Successfully";
    header('Location: read.php');
    exit(0);
}
else
{
    $_SESSION['message'] = "Not Added";
    header('Location: add.php');
    exit(0);


if(isset($_POST['#']))
{
    $driver_id = $_POST['driver_id'];

    $query = "DELETE FROM driver WHERE driver . driver_id = :driver_id LIMIT 1";

    $query_run = $conn->prepare($query);

    $data = [
        ':driver_id' => $driver_id,
    ];
    $query_execute = $query_run->execute($data);

    if($query_execute)
    {
        header('Location: read.php');
        $_SESSION['message'] = "Deleted Successfully";        
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Not Deleted";
        header('Location: read.php');
        exit(0);
    }
}

}
}

?>
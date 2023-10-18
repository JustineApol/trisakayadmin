<?php
    include('conn.php');
    if (isset($_POST['submit'])) {
        $admin_name = $_POST['user'];
        $admin_password = $_POST['pass'];

        $sql = "SELECT * FROM admin where admin_name = '$username' and password = '$password'";  
        $result = mysqli_query($conn, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        
        if($count == 1){  
            header("Location: index.php");
        }  
        else{  
            echo  '<script>
                        window.location.href = "index.php";
                        alert("Login failed. Invalid username or password!!")
                    </script>';
        }     
    }
    ?>
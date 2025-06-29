<?php
//session_start();

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "hospital_db";
//$conn = mysqli_connect($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
//}

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // $email = $_POST['email'] ?? '';
    //$password = $_POST['password'] ?? '';

   // $sql = "SELECT * FROM patients WHERE email='$email'";
   // $result = mysqli_query($conn, $sql);

   // if (mysqli_num_rows($result) > 0) {
       // $row = mysqli_fetch_assoc($result);

        //if ($password === $row['password']) {
         //   $_SESSION['p_id'] = $row['p_id'];
           // $_SESSION['role'] = $row['role'];
            //if ($row['role'] == 'patient') {
              // header("Location: patient_dashboard.php");
              //  exit();
           // } elseif ($row['role'] == 'doctor') {
               // header("Location: doctor_dashboard.php");
               // exit();
            //} elseif ($row['role'] == 'admin') {
              // header("Location: admin_dashboard.php");
              //  exit();
            //}
       // } else {
         //   echo "Invalid password!";
        //}
  // } else {
      // echo "Invalid email!";
   // }
//} else {
   // header("Location: login.php");
   // exit();
//}


//include 'hospital.db'; // database connection file
session_start();
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $role = '';
    $row = [];

    // Try patients table
    $sql = "SELECT * FROM patients WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role = 'patients';
    } else {
        // Try doctors table
        $sql = "SELECT * FROM doctor WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $role = 'doctor';
        } else {
            // Try admin table
            $sql = "SELECT * FROM admin WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $role = 'admin';
            }
        }
    }

    // If user found in any table
    if (!empty($row)) {
        if ($password == $row['password']) { // Plain text comparison
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            // Redirect based on role
            switch ($role) {
                case 'patients':
                    $_SESSION['p_id'] = $row['p_id']; // adjust field if needed
                    header("Location: patient_dashboard.php");
                    break;
                case 'doctor':
                    $_SESSION['D_id'] = $row['D_id']; // adjust field if needed
                    $_SESSION['D_name'] = $row['D_name'];
                    header("Location: doctor_dashboard.php");
                    break;
                case 'admin':
                    $_SESSION['admin_id'] = $row['admin_id']; // adjust field if needed
                    header("Location: admin_dashboard.php");
                    break;
            }
            exit();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid email!";
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<?php
error_reporting(0);
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get doctor ID from URL parameter
//$D_id = $_GET['D_id'];
if (isset($_SESSION['D_id'])) {
    $D_id = $_SESSION['D_id'];
} else {
    echo "Session not set. Please login again.";
    exit();
}
// Fetch doctor details from database
$sql = "SELECT * FROM doctor WHERE D_id = $D_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output doctor details
    while($row = $result->fetch_assoc()) {
       $name = $row['name'];
        $age = $row['age'];
        $contactno = $row['contactno'];
         $email = $row['email'];
          $gender = $row['gender'];
          $specialization = $row['specialization'];
        $password = $row['password'];
    }
} else {
    echo "No doctor found!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="profile-container">
        <h1>Doctor Profile</h1>
        <div class="profile-details">
            <h2><?php echo $name; ?></h2>
            <p><strong>age:</strong> <?php echo $age; ?></p>
            <p><strong>contactno:</strong> <?php echo $contactno; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>gender:</strong> <?php echo $gender; ?></p>
            <p><strong>specialization:</strong> <?php echo $specialization; ?></p>
            <p><strong>password:</strong> <?php echo $password; ?></p>
            
        </div>
        <a href="appointment.php?doctor_id=<?php echo $doctor_id; ?>" class="btn">Book an Appointment</a>
    </div>

</body>
</html>
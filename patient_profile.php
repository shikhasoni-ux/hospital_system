
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();

}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Session se p_id lena
if (isset($_SESSION['p_id'])) {
    $p_id = $_SESSION['p_id'];
} else {
    echo "Session not set. Please login again.";
    exit();
}

// SQL query
$sql = "SELECT * FROM patients WHERE p_id = '$p_id'";
$result = mysqli_query($conn, $sql);

echo "<h3>My Profile</h3>";

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo "<p><strong>Name:</strong> " . $row['p_name'] . "</p>";
    echo "<p><strong>Gender:</strong> " . $row['gender'] . "</p>";
    echo "<p><strong>Age:</strong> " . $row['age'] . "</p>";
    echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
    echo "<p><strong>Phone:</strong> " . $row['phoneno'] . "</p>";
    echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
    echo "<p><strong>Patient History:</strong> " . $row['patient_history'] . "</p>";
} else {
    echo "Profile not found!";
}

mysqli_close($conn);
?>
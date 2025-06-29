<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital_db";

// Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connection OK<br>";

// Get data from form
$name = $_POST['name'];
$phone = $_POST['phone'];
$appointmentDate = $_POST['appointment_date'];
$consultation = isset($_POST['consultation'] )? 500 : 0;
$tests = isset($_POST['tests'] )? 0 : 0;
$medicines = isset($_POST['medicines']) ? 0 : 0;
$emergency = isset($_POST['emergency_charge']) ? 300 : 0;
$paymentMethod = $_POST['payment_method'];
$onlineMethod = isset($_POST['online_method']) ? $_POST['online_method'] : 'N/A';

// Calculate total
$total = $consultation + $tests + $medicines + $emergency;

// SQL Query
$sql = "INSERT INTO patient_billing 
(name, phone, appointment_date, consultation, tests, medicines, emergency_charge, payment_method, online_method) 
VALUES 
('$name', '$phone', '$appointmentDate', '$consultation', '$tests', '$medicines', '$emergency', '$paymentMethod', '$onlineMethod')";

// Insert and check
if ($conn->query($sql) === TRUE) {
    echo "Payment recorded successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
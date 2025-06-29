<?php
$conn = mysqli_connect("localhost", "root", "", "hospital_db");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?> // database connection

$query = "SELECT * FROM appointments"; // apni table ka naam daaliye
$result = mysqli_query($conn, $query);

echo "<table border="1">
<tr><th>Patient id</th><th>Date</th><th>Status</th><th>Action</th></tr>";

while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['p_id']."</td>";
    echo "<td>".$row['Date']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>";
    if ($row['status'] == 'pending') {
    echo "<form method='POST' action='update_appointment.php'>";
    echo "<input type='hidden' name='a_id' value='" . $row["id"] . "'>";
    echo "<input type='submit' name='confirm' value='Mark Complete'>";
    echo "</form>";
}
    echo "</td></tr>";
}
echo "</table>";
?>
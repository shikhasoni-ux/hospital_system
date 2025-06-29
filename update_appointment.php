<?php
include('db_connect.php');

if (isset($_POST['confirm'])) {
    $id = $_POST['a_id'];

    $query = "UPDATE appointments SET status='complete' WHERE id='$id'";
    mysqli_query($conn, $query);

    header("Location: admin_appointments.php"); // wapas page pe bhej do
}
?>
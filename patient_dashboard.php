
<?php
session_start();
if (!isset($_SESSION['p_id'])) {
    header("Location: login_process.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Patient Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #003b5b;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
        }
        .sidebar a:hover {
            text-decoration: underline;
        }
        .content {
            flex-grow: 1;
            padding: 30px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Welcome, <?php echo $_SESSION['p_name'] ?? 'Patients'; ?></h4>
        <hr>
        <a href="?page=profile">My Profile</a>
        <a href="?page=appointments">Appointments</a>
        <a href="?page=room">Room</a>
        <a href="?page=status">Status</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Content Area -->
    <div class="content">
        <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                if ($page == 'profile') {
                    include 'patient_profile.php';
                } elseif ($page == 'appointments') {
                    include 'appointmentbook.php';
                } elseif ($page == 'room') {
                    include 'room.php';
                } elseif ($page == 'status'){
                    include 'viewappointment.php';
                }else{
                    echo "<h5>Page not found.</h5>";
                }
            } else {
                echo "<h3>Welcome to your dashboard!</h3><p>Select an option from sidebar.</p>";
            }
        ?>
    </div>

</body>
</html>


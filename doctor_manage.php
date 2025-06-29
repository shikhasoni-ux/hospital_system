<?php
$conn = new mysqli("localhost", "root", "", "hospital_db");

// Delete
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM doctor WHERE D_id=" . $_GET['delete']);
    header("Location: doctor_manage.php");
    exit;
}

// Edit
$edit = null;
if (isset($_GET['edit'])) {
    $res = $conn->query("SELECT * FROM doctor WHERE D_id=" . $_GET['edit']);
    $edit = $res->fetch_assoc();
}

// Insert / Update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['D_id'])) {
        $stmt = $conn->prepare("UPDATE doctor SET D_name=?, specialization=?, phone=?, email=?, address=?, password=? WHERE D_id=?");
        $stmt->bind_param("ssssssi", $_POST['D_name'], $_POST['specialization'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['password'], $_POST['D_id']);
    } else {
        $stmt = $conn->prepare("INSERT INTO doctor (D_name, specialization, phone, email, address, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $_POST['D_name'], $_POST['specialization'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['password']);
    }
    $stmt->execute();
    header("Location: doctor_manage.php");
    exit;
}

$doctors = $conn->query("SELECT * FROM doctor");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3><?= $edit ? 'Update' : 'Add' ?> Doctor</h3>
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="D_id" value="<?= $edit['D_id'] ?? '' ?>">

                <div class="mb-3">
                    <label>Doctor Name</label>
                    <input type="text" name="D_name" class="form-control" value="<?= $edit['D_name'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label>Specialization</label>
                    <input type="text" name="specialization" class="form-control" value="<?= $edit['specialization'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label>Phone</label>
                    <input type="text" name="contactno" class="form-control" value="<?= $edit['contactno'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $edit['email'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?= $edit['address'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?= $edit['password'] ?? '' ?>" required>
                </div>

                <button type="submit" class="btn btn-primary"><?= $edit ? 'Update' : 'Add' ?> Doctor</button>
                <a href="doctor_manage.php" class="btn btn-secondary">Reset</a>
            </form>
        </div>
    </div>

    <div class="mt-4 card shadow">
        <div class="card-header bg-dark text-white">
            <h4>Doctor List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Name</th><th>Specialization</th><th>Phone</th><th>Email</th><th>Address</th><th>Password</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row = $doctors->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['D_name'] ?></td>
                        <td><?= $row['specialization'] ?></td>
                        <td><?= $row['contactno'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><?= $row['password'] ?></td>
                        <td>
                            <a href="?edit=<?= $row['D_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $row['D_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this doctor?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
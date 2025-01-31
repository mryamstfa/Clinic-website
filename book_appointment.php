<?php
include('db_config.php');

$sql = "SELECT DoctorID, D_Name FROM Doctor";
$result = $conn->query($sql);
$doctors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

// Get the message from the query string
$error = isset($_GET['error']) ? $_GET['error'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style1.css">
    <script>
        // Show alert box if there's an error or success message
        window.onload = function() {
            <?php if ($error): ?>
                alert("Error: <?= $error ?>");
            <?php elseif ($success): ?>
                alert("Success: <?= $success ?>");
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="image/logo2.jpg" alt="Logo">
            </div>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a class="active" href="book_appointment.php">Appointment</a></li>
                <li><a href="page2.php">Drugs</a></li>
            </ul>
        </nav>
    </header>
    <img src="image/background.jpg" alt="background">
    <div class="overlay"></div>
    <div class="appointment-form">
        <h1><span>BOOK</span> APPOINTMENT</h1>
        <form id="appointmentForm" action="save_appointment.php" method="POST">
            <div class="form-group">
                <label for="patient-name">Patient Name</label>
                <input type="text" name="patient_name" id="patient-name" placeholder="Enter Patient Name" required>
            </div>
            <div class="form-group">
                <label for="patient-email">Patient Email</label>
                <input type="email" name="patient_email" id="patient-email" placeholder="Enter Patient Email" required>
            </div>
            <div class="form-group">
                <label for="patient-phone">Patient Phone</label>
                <input type="text" name="patient_phone" id="patient-phone" placeholder="Enter Patient Phone" required>
            </div>
            <div class="form-group">
                <label for="doctor-name">Doctor's Name</label>
                <select name="doctor_id" id="doctor-name" required>
                    <option value="">Select Doctor</option>
                    <?php foreach ($doctors as $doctor): ?>
                        <option value="<?= $doctor['DoctorID'] ?>"><?= htmlspecialchars($doctor['D_Name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="appointment-date">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment-date" required>
            </div>
            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>
</html>

<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];

    $sql = "SELECT AppointmentID, P_Phone, Doctor_ID, AppointmentDate
            FROM Appointment
            WHERE AppointmentID = $appointmentID";
    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_assoc($result);

    if (!$booking) {
        echo "Booking not found.";
        exit;
    }

    $phone = $booking['P_Phone'];
    $doctorID = $booking['Doctor_ID'];
    $appointmentDate = $booking['AppointmentDate'];
} else {
    echo "Invalid appointment ID.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPhone = $_POST['P_Phone'];
    $newDoctorID = $_POST['Doctor_ID'];
    $newAppointmentDate = $_POST['AppointmentDate'];

    $sql = "UPDATE Appointment
            SET P_Phone = '$newPhone', Doctor_ID = $newDoctorID, AppointmentDate = '$newAppointmentDate'
            WHERE AppointmentID = $appointmentID";

    if (mysqli_query($conn, $sql)) {
        header("Location: view_booking_history.php?status=updated");
    } else {
        echo "Error updating booking: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="POST">
            <label for="P_Phone">Patient Phone:</label>
            <input type="text" id="P_Phone" name="P_Phone" value="<?php echo $phone; ?>" required>

            <label for="Doctor_ID">Doctor:</label>
            <select id="Doctor_ID" name="Doctor_ID" required>
                <?php
                $doctorQuery = "SELECT DoctorID, D_Name FROM Doctor";
                $doctorResult = mysqli_query($conn, $doctorQuery);
                while ($doctor = mysqli_fetch_assoc($doctorResult)) {
                    echo "<option value='" . $doctor['DoctorID'] . "' " . ($doctor['DoctorID'] == $doctorID ? 'selected' : '') . ">" . $doctor['D_Name'] . "</option>";
                }
                ?>
            </select>

            <label for="AppointmentDate">Appointment Date:</label>
            <input type="date" id="AppointmentDate" name="AppointmentDate" value="<?php echo $appointmentDate; ?>" required>

            <button type="submit">Update Booking</button>
        </form>
    </div>
</body>
</html>

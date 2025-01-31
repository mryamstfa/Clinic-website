<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];

    $sql = "DELETE FROM Appointment WHERE AppointmentID = $appointmentID";

    if (mysqli_query($conn, $sql)) {

        header("Location: view_booking_history.php?status=success");
    } else {

        header("Location: view_booking_history.php?status=error");
    }
} else {

    header("Location: view_booking_history.php?status=error");
}
?>

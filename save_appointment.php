<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patientName = $_POST['patient_name'];
    $patientEmail = $_POST['patient_email'];
    $patientPhone = $_POST['patient_phone'];
    $doctorID = $_POST['doctor_id'];
    $appointmentDate = $_POST['appointment_date'];

    if (empty($patientName) || empty($patientEmail) || empty($patientPhone) || empty($doctorID) || empty($appointmentDate)) {
        header("Location: book_appointment.php?error=All fields are required.");
        exit();
    }

    $stmt = $conn->prepare("SELECT PatientID FROM Patient WHERE P_Name = ? AND P_Email = ? AND P_ContactNumber = ?");
    $stmt->bind_param("sss", $patientName, $patientEmail, $patientPhone);
    $stmt->execute();
    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if (!$patient) {
        header("Location: book_appointment.php?error=Patient not found or details do not match.");
        exit();
    }

    $patientID = $patient['PatientID'];

    $stmt = $conn->prepare("SELECT * FROM Appointment WHERE Patient_ID = ? AND AppointmentDate = ?");
    $stmt->bind_param("is", $patientID, $appointmentDate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: book_appointment.php?error=You already have an appointment on this date.");
        exit();
    } else {
        $sql = "INSERT INTO Appointment (Patient_ID, P_Phone, Doctor_ID, AppointmentDate, App_Status) 
                VALUES (?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isis", $patientID, $patientPhone, $doctorID, $appointmentDate);

        if ($stmt->execute()) {
            header("Location: book_appointment.php?success=Your appointment has been successfully booked!");
            exit();
        } else {
            header("Location: book_appointment.php?error=Error booking appointment.");
            exit();
        }
    }
}
?>

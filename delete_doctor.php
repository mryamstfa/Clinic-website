<?php
include('db_config.php');
if (isset($_GET['id']) && is_numeric($_GET['id'])) 
{
    $doctor_id = $_GET['id'];

    $stmt1 = $conn->prepare("DELETE FROM appointment WHERE Doctor_ID = ?");
    $stmt1->bind_param("i", $doctor_id);
    $stmt1->execute();
    $stmt1->close();

    $stmt2 = $conn->prepare("DELETE FROM Doctor WHERE DoctorID = ?");
    $stmt2->bind_param("i", $doctor_id);
    
    if ($stmt2->execute())
    {
        header("Location: view_doctor.php?message=Doctor deleted successfully");
        exit();
    } else {
        echo "Error deleting doctor: " . $conn->error;
    }
    $stmt2->close();
} else {
    echo "Invalid doctor ID.";
}
?>

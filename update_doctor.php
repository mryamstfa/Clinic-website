<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $doctor_id = $_GET['id'];
    
    $sql = "SELECT * FROM Doctor WHERE DoctorID = '$doctor_id'";
    $result = $conn->query($sql);
    $doctor = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $d_name = $_POST['D_Name'];
    $specialization = $_POST['Specialization'];
    $contact_number = $_POST['D_ContactNumber'];
    $email = $_POST['D_Email'];
    $availability = $_POST['D_Availability'];
    $consultation_fee = $_POST['ConsultationFee'];

    $sql = "UPDATE Doctor SET 
            D_Name='$d_name', 
            Specialization='$specialization', 
            D_ContactNumber='$contact_number', 
            D_Email='$email', 
            D_Availability='$availability', 
            ConsultationFee='$consultation_fee' 
            WHERE DoctorID='$doctor_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_doctor.php?message=Doctor updated successfully");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Doctor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Update Doctor Details</h2>
        <form method="POST">
            <input type="text" name="D_Name" value="<?php echo $doctor['D_Name']; ?>" required>
            <input type="text" name="Specialization" value="<?php echo $doctor['Specialization']; ?>" required>
            <input type="text" name="D_ContactNumber" value="<?php echo $doctor['D_ContactNumber']; ?>">
            <input type="email" name="D_Email" value="<?php echo $doctor['D_Email']; ?>">
            <textarea name="D_Availability"><?php echo $doctor['D_Availability']; ?></textarea>
            <input type="number" name="ConsultationFee" value="<?php echo $doctor['ConsultationFee']; ?>" required>
            <button type="submit">Update Doctor</button>
        </form>
    </div>
</body>
</html>

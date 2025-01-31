<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $medical_history = $_POST['medical_history'];

    if (empty($name) || empty($dob) || empty($gender) || empty($contact)) {
        echo "Name, Date of Birth, Gender, and Contact are required.";
        exit();
    }

    $sql = "INSERT INTO Patient (P_Name, P_DateOfBirth, Gender, P_ContactNumber, P_Email, P_Address, MedicalHistory) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $name, $dob, $gender, $contact, $email, $address, $medical_history);

    if ($stmt->execute()) {

        header("Location: view_patient.php?message=Patient added successfully");
        exit();
    } else {
        echo "Error adding patient: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="css/stylepa.css">
</head>
<body>
    <div class="container">
        <h2>Add New Patient</h2>
        <form action="add_patient.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label for="contact">Contact Number:</label>
            <input type="text" name="contact" id="contact" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email">

            <label for="address">Address:</label>
            <textarea name="address" id="address"></textarea>

            <label for="medical_history">Medical History:</label>
            <textarea name="medical_history" id="medical_history"></textarea>

            <button type="submit" class="form-btn">Add Patient</button>
        </form>
    </div>
</body>
</html>

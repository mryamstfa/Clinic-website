<?php
include('db_config.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $patient_id = $_POST['patient_id'];
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

    $sql = "UPDATE Patient 
            SET P_Name = ?, P_DateOfBirth = ?, Gender = ?, P_ContactNumber = ?, P_Email = ?, P_Address = ?, MedicalHistory = ?
            WHERE PatientID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $name, $dob, $gender, $contact, $email, $address, $medical_history, $patient_id);

    if ($stmt->execute()) {
        header("Location: view_patient.php?message=Patient updated successfully");
        exit();
    } else {
        echo "Error updating patient: " . $conn->error;
    }
} else {

    if (isset($_GET['id'])) {
        $patient_id = $_GET['id'];

        $sql = "SELECT * FROM Patient WHERE PatientID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $patient_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $patient = $result->fetch_assoc();
        } else {
            echo "Patient not found.";
            exit();
        }
    } else {
        echo "No patient ID provided.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient</title>
    <link rel="stylesheet" href="css/stylepa.css">
</head>
<body>
    <div class="container">
        <h2>Update Patient</h2>
        <form action="update_patient.php" method="POST">
            <input type="hidden" name="patient_id" value="<?php echo htmlspecialchars($patient['PatientID']); ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($patient['P_Name']); ?>" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($patient['P_DateOfBirth']); ?>" required>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male" <?php if ($patient['Gender'] === 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($patient['Gender'] === 'Female') echo 'selected'; ?>>Female</option>
                <option value="Other" <?php if ($patient['Gender'] === 'Other') echo 'selected'; ?>>Other</option>
            </select>

            <label for="contact">Contact Number:</label>
            <input type="text" name="contact" id="contact" value="<?php echo htmlspecialchars($patient['P_ContactNumber']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($patient['P_Email']); ?>">

            <label for="address">Address:</label>
            <textarea name="address" id="address"><?php echo htmlspecialchars($patient['P_Address']); ?></textarea>

            <label for="medical_history">Medical History:</label>
            <textarea name="medical_history" id="medical_history"><?php echo htmlspecialchars($patient['MedicalHistory']); ?></textarea>

            <button type="submit" class="form-btn">Update Patient</button>
        </form>
    </div>
</body>
</html>

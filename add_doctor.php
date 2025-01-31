<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $d_name = $_POST['D_Name'];
    $specialization = $_POST['Specialization'];
    $contact_number = $_POST['D_ContactNumber'];
    $email = $_POST['D_Email'];
    $availability = $_POST['D_Availability'];
    $consultation_fee = $_POST['ConsultationFee'];
    $d_image = '';

    if (isset($_FILES['D_Image']) && $_FILES['D_Image']['error'] == 0) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["D_Image"]["name"]);
        if (move_uploaded_file($_FILES["D_Image"]["tmp_name"], $target_file)) {
            $d_image = basename($_FILES["D_Image"]["name"]);
        }
    }

    $sql = "INSERT INTO Doctor (D_Name, Specialization, D_ContactNumber, D_Email, D_Availability, ConsultationFee, D_Image) 
            VALUES ('$d_name', '$specialization', '$contact_number', '$email', '$availability', '$consultation_fee', '$d_image')";

    if ($conn->query($sql) === TRUE) {
        header("Location: view_doctor.php?message=New doctor added successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Doctor Details</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="D_Name" placeholder="Doctor Name" required>
            <input type="text" name="Specialization" placeholder="Specialization" required>
            <input type="text" name="D_ContactNumber" placeholder="Contact Number">
            <input type="email" name="D_Email" placeholder="Email">
            <textarea name="D_Availability" placeholder="Availability"></textarea>
            <input type="number" name="ConsultationFee" placeholder="Consultation Fee">
            <input type="file" name="D_Image" accept="image/*">
            <button type="submit">Add Doctor</button>
        </form>
    </div>
</body>
</html>
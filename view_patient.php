<?php
include('db_config.php');
$sql = "SELECT * FROM Patient";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patients</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Patient Records</h2>
        <div class="button-container">
            <a href="add_patient.php" class="form-btn">Add New Patient</a>
            <a href="dashboard.php" class="form-btn dashboard-btn">Dashboard</a>
            <a href="book_appointment.php" class="form-btn">Book Appointment</a> 
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Medical History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['PatientID']; ?></td>
                            <td><?php echo htmlspecialchars($row['P_Name']); ?></td>
                            <td><?php echo htmlspecialchars($row['P_DateOfBirth']); ?></td>
                            <td><?php echo htmlspecialchars($row['Gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['P_ContactNumber']); ?></td>
                            <td><?php echo htmlspecialchars($row['P_Email']); ?></td>
                            <td><?php echo htmlspecialchars($row['P_Address']); ?></td>
                            <td><?php echo htmlspecialchars($row['MedicalHistory']); ?></td>
                            <td>
                                <a href="update_patient.php?id=<?php echo $row['PatientID']; ?>" class="form-btn">Edit</a>
                                <a href="delete_patient.php?id=<?php echo $row['PatientID']; ?>" class="form-btn danger" onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9">No patients found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

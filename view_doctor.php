<?php
include('db_config.php');
$sql = "SELECT * FROM Doctor";
$result = $conn->query($sql);
?>
<?php
if (isset($_GET['message'])) {
    echo "<p style='color: green;'>" . htmlspecialchars($_GET['message']) . "</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Doctors</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <h2>View Doctors</h2>
        
        <div class="button-container">
        <a href="add_doctor.php" class="form-btn">Add New Doctor</a>
        <a href="dashboard.php" class="form-btn dashboard-btn">Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Specialization</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Availability</th>
                    <th>Consultation Fee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>".$row["D_Name"]."</td>
                            <td>".$row["Specialization"]."</td>
                            <td>".$row["D_ContactNumber"]."</td>
                            <td>".$row["D_Email"]."</td>
                            <td>".$row["D_Availability"]."</td>
                            <td>".$row["ConsultationFee"]."</td>
                            <td>
                                <a href='update_doctor.php?id=".$row["DoctorID"]."'>Edit</a> | 
                                <a href='delete_doctor.php?id=".$row["DoctorID"]."' onclick='return confirmDelete()'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No doctors found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

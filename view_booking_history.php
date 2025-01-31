<?php
include('db_config.php');

$sql = "SELECT AppointmentID, P_Name AS PatientName, P_Phone, D_Name AS DoctorName, AppointmentDate, App_Status
        FROM Appointment 
        JOIN Doctor ON Appointment.Doctor_ID = Doctor.DoctorID
        JOIN Patient ON Appointment.Patient_ID = Patient.PatientID";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmDelete(appointmentID) {
            var result = confirm("Are you sure you want to delete this booking?");
            if (result) {
                window.location.href = "delete_book.php?id=" + appointmentID;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Booking History</h1>
        
        <div class="button-container">
            <a href="dashboard.php" class="form-btn dashboard-btn">Dashboard</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Phone</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Status</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . $row['AppointmentID'] . "</td>
                                <td>" . $row['PatientName'] . "</td>
                                <td>" . $row['P_Phone'] . "</td>
                                <td>" . $row['DoctorName'] . "</td>
                                <td>" . $row['AppointmentDate'] . "</td>
                                <td>" . $row['App_Status'] . "</td>
                                <td>
                                    <a href='#' class='delete-btn' onclick='confirmDelete(" . $row['AppointmentID'] . ")'>Delete</a>
                                    <a href='edit_book.php?id=" . $row['AppointmentID'] . "' class='edit-btn'>Edit</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No booking history found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

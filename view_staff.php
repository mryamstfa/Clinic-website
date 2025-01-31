<?php
include('db_config.php');
$sql = "SELECT * FROM Staff";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staff</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>View Staff</h2>
        <div class="button-container">
        <a href="add_staff.php" class="form-btn">Add New Staff</a>
        <a href="dashboard.php" class="form-btn dashboard-btn">Dashboard</a>
        </div>        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Specialization</th>
                    <th>Hire Date</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>".$row["St_first_name"]."</td>
                            <td>".$row["St_last_name"]."</td>
                            <td>".$row["St_role"]."</td>
                            <td>".$row["specialization_St"]."</td>
                            <td>".$row["St_hire_date"]."</td>
                            <td>".$row["St_phone"]."</td>
                            <td>".$row["St_email"]."</td>
                            <td>
                                <a href='update_staff.php?id=".$row["staff_id"]."'>Edit</a> | 
                                <a href='delete_staff.php?id=".$row["staff_id"]."'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No staff found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
include('db_config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $first_name = $_POST['St_first_name'];
    $last_name = $_POST['St_last_name'];
    $role = $_POST['St_role'];
    $specialization = $_POST['specialization_St'];
    $hire_date = $_POST['St_hire_date'];
    $phone = $_POST['St_phone'];
    $email = $_POST['St_email'];
    $address = $_POST['St_address'];
    $schedule = $_POST['St_schedule'];
    $salary = $_POST['St_salary'];

    $sql = "INSERT INTO Staff (St_first_name, St_last_name, St_role, specialization_St, St_hire_date, St_phone, St_email, St_address, St_schedule, St_salary) 
            VALUES ('$first_name', '$last_name', '$role', '$specialization', '$hire_date', '$phone', '$email', '$address', '$schedule', '$salary')";

    if ($conn->query($sql) === TRUE) {

        header("Location: view_staff.php");
        exit; 
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
    <title>Add Staff</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Staff Details</h2>
        <form id="addStaffForm" method="POST">
            <input type="text" name="St_first_name" id="St_first_name" placeholder="First Name" required>
            <input type="text" name="St_last_name" placeholder="Last Name" required>
            <input type="text" name="St_role" placeholder="Role" required>
            <input type="text" name="specialization_St" placeholder="Specialization">
            <input type="date" name="St_hire_date" placeholder="Hire Date" required>
            <input type="text" name="St_phone" placeholder="Phone Number">
            <input type="email" name="St_email" placeholder="Email">
            <textarea name="St_address" placeholder="Address"></textarea>
            <textarea name="St_schedule" placeholder="Schedule"></textarea>
            <input type="number" name="St_salary" placeholder="Salary">
            <button type="submit">Add Staff</button>
        </form>
    </div>
</body>
</html>

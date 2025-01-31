<?php
include('db_config.php');
if (isset($_GET['id'])) 
{
    $staff_id = $_GET['id'];
    
    $sql = "SELECT * FROM Staff WHERE staff_id = '$staff_id'";
    $result = $conn->query($sql);
    $staff = $result->fetch_assoc();
}

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

    $sql = "UPDATE Staff SET 
        St_first_name='$first_name', 
        St_last_name='$last_name', 
        St_role='$role', 
        specialization_St='$specialization', 
        St_hire_date='$hire_date', 
        St_phone='$phone', 
        St_email='$email', 
        St_address='$address', 
        St_schedule='$schedule', 
        St_salary='$salary' 
        WHERE staff_id='$staff_id'";

    if ($conn->query($sql) === TRUE) 
    {

        header("Location: view_staff.php");
        exit;
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
    <title>Update Staff</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Update Staff Details</h2>
        <form method="POST">
            <input type="text" name="St_first_name" value="<?php echo $staff['St_first_name']; ?>" required>
            <input type="text" name="St_last_name" value="<?php echo $staff['St_last_name']; ?>" required>
            <input type="text" name="St_role" value="<?php echo $staff['St_role']; ?>" required>
            <input type="text" name="specialization_St" value="<?php echo $staff['specialization_St']; ?>">
            <input type="date" name="St_hire_date" value="<?php echo $staff['St_hire_date']; ?>" required>
            <input type="text" name="St_phone" value="<?php echo $staff['St_phone']; ?>">
            <input type="email" name="St_email" value="<?php echo $staff['St_email']; ?>">
            <textarea name="St_address"><?php echo $staff['St_address']; ?></textarea>
            <textarea name="St_schedule"><?php echo $staff['St_schedule']; ?></textarea>
            <input type="number" name="St_salary" value="<?php echo $staff['St_salary']; ?>">
            <button type="submit">Update Staff</button>
        </form>
    </div>
</body>
</html>

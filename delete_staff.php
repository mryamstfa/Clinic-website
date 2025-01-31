<?php
include('db_config.php');
if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];
    $sql = "DELETE FROM Staff WHERE staff_id = '$staff_id'";
    if ($conn->query($sql) === TRUE) 
    {
        header("Location: view_staff.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

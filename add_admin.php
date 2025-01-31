<?php
include('db_config.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_username = $_POST['username'];
    $admin_password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
  
    $insertAdminSql = "INSERT INTO vaildstater (login_ID, username_P, password_P) VALUES (2, ?, ?)";
    $stmt = $conn->prepare($insertAdminSql);
    $stmt->bind_param("ss", $admin_username, $admin_password);

    if ($stmt->execute()) {
        echo "<script>
                alert('Admin added successfully.');
                window.location.href = 'admin_dashboard.php'; // Redirect to the admin dashboard after success
              </script>";
    } else {
        echo "<script>
                alert('Error: Could not add admin. Please try again.');
                window.location.href = 'admin_dashboard.php'; // Redirect to the admin dashboard after error
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>

<form action="add_admin.php" method="POST">
    <label for="username">Username: </label>
    <input type="text" name="username" required><br>
    
    <label for="password">Password: </label>
    <input type="password" name="password" required><br>
    
    <input type="submit" value="Add Admin">
</form>

<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "loasd";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = $_POST['uname'];
    $psw = $_POST['psw'];

    $stmt = $conn->prepare("SELECT password_P FROM vaildstater WHERE username_P = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();

        if (password_verify($psw, $hashedPassword)) {
            echo json_encode(["status" => "success", "message" => "Login successful"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Username not found"]);
    }

    $stmt->close();
}
$conn->close();
?>

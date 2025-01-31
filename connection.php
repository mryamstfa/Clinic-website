<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "loasd";

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$sql = "SELECT * FROM patient"; 
$result = $conn->query($sql);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($data);

$conn->close();
?>

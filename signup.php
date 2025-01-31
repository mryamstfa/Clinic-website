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

    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $psw = password_hash($_POST['psw'], PASSWORD_DEFAULT); 
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contactNumber = $_POST['contactNumber'];
    $address = $_POST['address'];
    $medicalHistory = $_POST['medicalHistory'];

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("INSERT INTO Patient (P_Email, P_Name, P_DateOfBirth, Gender, P_ContactNumber, P_Address, MedicalHistory) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $email, $uname, $dob, $gender, $contactNumber, $address, $medicalHistory);

        if ($stmt->execute()) {
            $patientID = $stmt->insert_id;

            $loginStmt = $conn->prepare("INSERT INTO vaildstater (login_ID, username_P, password_P) VALUES (?, ?, ?)");
            $loginStmt->bind_param("iss", $patientID, $uname, $psw);

            if ($loginStmt->execute()) {
                $conn->commit();
                echo json_encode(["status" => "success", "message" => "User registered successfully"]);
            } else {
                throw new Exception("Error inserting login credentials: " . $loginStmt->error);
            }

            $loginStmt->close();
        } else {
            throw new Exception("Error inserting patient details: " . $stmt->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}

$conn->close();
?>

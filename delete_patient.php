<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $patient_id = $_GET['id']; 

    $conn->begin_transaction();

    try {
        $checkValidstaterSql = "SELECT COUNT(*) AS count FROM vaildstater WHERE login_ID = ?";
        $checkValidstaterStmt = $conn->prepare($checkValidstaterSql);
        $checkValidstaterStmt->bind_param("i", $patient_id);
        $checkValidstaterStmt->execute();
        $result = $checkValidstaterStmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {

            $deleteValidstaterSql = "DELETE FROM vaildstater WHERE login_ID = ?";
            $deleteValidstaterStmt = $conn->prepare($deleteValidstaterSql);
            $deleteValidstaterStmt->bind_param("i", $patient_id);
            $deleteValidstaterStmt->execute();

            if ($deleteValidstaterStmt->affected_rows === 0) {
                throw new Exception("Failed to delete login details for PatientID: " . $patient_id);
            }
        }

        $deletePatientSql = "DELETE FROM Patient WHERE PatientID = ?";
        $deletePatientStmt = $conn->prepare($deletePatientSql);
        $deletePatientStmt->bind_param("i", $patient_id);
        $deletePatientStmt->execute();

        if ($deletePatientStmt->affected_rows === 0) {
            throw new Exception("Failed to delete patient record for PatientID: " . $patient_id);
        }

        $conn->commit();

        echo "<script>
                alert('Patient and login details deleted successfully.');
                window.location.href = 'view_patient.php';
              </script>";
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>
                alert('Error: " . addslashes($e->getMessage()) . "');
                window.location.href = 'view_patient.php';
              </script>";
        exit();
    } finally {
        if (isset($checkValidstaterStmt)) $checkValidstaterStmt->close();
        if (isset($deleteValidstaterStmt)) $deleteValidstaterStmt->close();
        if (isset($deletePatientStmt)) $deletePatientStmt->close();
    }
} else {
    echo "<script>
            alert('No Patient ID provided.');
            window.location.href = 'view_patient.php';
          </script>";
    exit();
}

?>

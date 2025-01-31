<?php
include('db_config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $inventory_id = $_POST['inventory_id'];
    $sql = "DELETE FROM Inventory WHERE inventory_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $inventory_id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
}
?>

<?php
include('db_config.php');
$sql = "SELECT * FROM Inventory WHERE quantity_inv > 0";
$result = $conn->query($sql);

$inventory = [];

while ($row = $result->fetch_assoc()) {
    $inventory[] = $row;
}

echo json_encode($inventory);
?>

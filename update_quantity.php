<?php
include('db_config.php');
$data = json_decode(file_get_contents("php://input"), true);
$itemId = $data['itemId'];
$sql = "SELECT quantity_inv FROM Inventory WHERE inventory_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $itemId);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();

if ($item && $item['quantity_inv'] > 0) 
{
    $updateSql = "UPDATE Inventory SET quantity_inv = quantity_inv - 1 WHERE inventory_id = ?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("i", $itemId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update inventory.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Out of stock.']);
}
?>

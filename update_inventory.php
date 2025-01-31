<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory_id = $_POST['inventory_id'];
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $expiration_date = $_POST['expiration_date'];
    $item_price = $_POST['item_price'];

    $target_dir = "inventory image/";  
    $image_url = $_POST['existing_image'];  

    if (!empty($_FILES['item_image']['name'])) {
        $target_file = $target_dir . basename($_FILES['item_image']['name']);
        move_uploaded_file($_FILES['item_image']['tmp_name'], $target_file);
        $image_url = $target_file;
    }

    $sql = "UPDATE Inventory 
            SET item_name_inv = ?, quantity_inv = ?, expiration_date_inv = ?, item_price = ?, image_url = ?
            WHERE inventory_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisisi", $item_name, $quantity, $expiration_date, $item_price, $image_url, $inventory_id);

    if ($stmt->execute()) {
        header("Location: view_inventory.php?message=Inventory updated successfully");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {

    if (isset($_GET['id'])) {
        $inventory_id = $_GET['id'];
        $sql = "SELECT * FROM Inventory WHERE inventory_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $inventory_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $inventory = $result->fetch_assoc();
        } else {
            echo "Inventory item not found.";
            exit();
        }
    } else {
        echo "No inventory ID provided.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Inventory</title>
    <link rel="stylesheet" href="css/styleinv.css">
</head>
<body>
    <div class="container">
        <h2>Update Inventory Item</h2>
        <form action="update_inventory.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="inventory_id" value="<?php echo htmlspecialchars($inventory['inventory_id']); ?>">
            
            <label for="item_name">Item Name:</label>
            <input type="text" name="item_name" id="item_name" value="<?php echo htmlspecialchars($inventory['item_name_inv']); ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($inventory['quantity_inv']); ?>" required>

            <label for="expiration_date">Expiration Date:</label>
            <input type="date" name="expiration_date" id="expiration_date" value="<?php echo htmlspecialchars($inventory['expiration_date_inv']); ?>" required>

            <label for="item_price">Price:</label>
            <input type="number" name="item_price" id="item_price" value="<?php echo htmlspecialchars($inventory['item_price']); ?>" required>

            <label for="item_image">Item Image:</label>
            <input type="file" name="item_image" id="item_image">
            <input type="hidden" name="existing_image" value="<?php echo $inventory['image_url']; ?>">
            <img src="<?php echo $inventory['image_url']; ?>" alt="Current Image" width="100"><br>

            <button type="submit" class="form-btn">Update Item</button>
        </form>
    </div>
</body>
</html>

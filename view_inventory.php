<?php
include('db_config.php');
$sql = "SELECT * FROM Inventory";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inventory</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirmDelete(inventoryId, row) {
            if (confirm("Are you sure you want to delete this item?")) {
                const formData = new FormData();
                formData.append('inventory_id', inventoryId);

                fetch('delete_inventory.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data === 'success') {
                        alert('Item deleted successfully');
                        row.remove(); 
                    } else {
                        alert('Error deleting item');
                    }
                })
                .catch(error => {
                    alert('Request failed');
                });
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>View Inventory</h2>
        <div class="button-container">
        <a href="add_inventory.php" class="form-btn">Add New Inventory</a>
        <a href="dashboard.php" class="form-btn dashboard-btn">Dashboard</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Expiration Date</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr id='row_".$row["inventory_id"]."'>
                            <td><img src='".$row["image_url"]."' alt='Image' width='50'></td>
                            <td>".$row["item_name_inv"]."</td>
                            <td>".$row["quantity_inv"]."</td>
                            <td>".$row["expiration_date_inv"]."</td>
                            <td>".$row["item_price"]."</td>
                            <td>
                                <a href='update_inventory.php?id=".$row["inventory_id"]."'>Edit</a> | 
                                <a href='#' onclick='confirmDelete(".$row["inventory_id"].", this.parentElement.parentElement)'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No inventory found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

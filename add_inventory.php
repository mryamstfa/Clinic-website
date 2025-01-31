<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name_inv'];
    $quantity = $_POST['quantity_inv'];
    $expiration_date = $_POST['expiration_date_inv'];
    $item_price = $_POST['item_price_inv'];

    $target_dir = "inventory image/"; 
    $target_file = $target_dir . basename($_FILES["image_inv"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image_inv"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image_inv"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image_inv"]["tmp_name"], $target_file)) {
            $image_url = $target_file; 
        } else {
            echo "Sorry, there was an error uploading your file.";
            $image_url = "inventory image/default.png";
        }
    } else {
        $image_url = "inventory image/default.png";
    }

    $sql = "INSERT INTO Inventory (item_name_inv, quantity_inv, expiration_date_inv, item_price, image_url) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisis", $item_name, $quantity, $expiration_date, $item_price, $image_url);

    if ($stmt->execute()) 
    {
        header("Location: view_inventory.php?message=Item added successfully");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Add Inventory Item</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="item_name_inv" placeholder="Item Name" required>
            <input type="number" name="quantity_inv" placeholder="Quantity" required>
            <input type="date" name="expiration_date_inv" required>
            <input type="number" name="item_price_inv" placeholder="Item Price" required>
            
            <label for="image_inv">Upload Image:</label>
            <input type="file" name="image_inv" accept="image/*" required>

            <button type="submit">Add Inventory</button>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs</title>
    <link rel="stylesheet" href="shared.css">
    <link rel="stylesheet" href="page2.css">
</head>
<body>
    <?php include('navbar.html'); ?>

    <div class="cart-container">
        <button id="cartButton" onclick="redirectToCart()">
            <img src="images/grocery-store.png" alt="Cart" class="cart-logo">
            <span id="cartCount">0</span>
        </button>
    </div>

    <div class="search-container">
        <input type="text" id="Searchbar" placeholder="Search drugs..." onkeyup="filterItems()">
    </div>

    <div id="druglist">
        <?php
        include('db_config.php');
        $sql = "SELECT * FROM Inventory WHERE quantity_inv > 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "
                <div id='drugitem' data-name='{$row['item_name_inv']}'>
                    <img src='{$row['image_url']}' alt='{$row['item_name_inv']}'>
                    <p id='drugname'>{$row['item_name_inv']}</p>
                    <p>Price: {$row['item_price']}</p>
                    <div id='buttonsforitem'>
                        <button onclick='addToCart({$row['inventory_id']}, \"{$row['item_name_inv']}\", {$row['item_price']})'>Add to Cart</button>
                    </div>
                </div>";
            }
        } else {
            echo "<p class='no-drugs-message'>No drugs available.</p>";
        }
        ?>
    </div>
    <script src="page2.js"></script>
</body>
</html>

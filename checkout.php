<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <h1>Checkout</h1>
    <div id="checkoutItems">
        <!-- Checkout items will be dynamically populated here -->
    </div>

    <form id="checkoutForm" action="process_payment.php" method="POST">
        <h2>Payment Information</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="example@example.com" required>

        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>

        <div class="form-row">
            <div>
                <label for="expiryDate">Expiration Date:</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>
            </div>
            <div>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" required>
            </div>
        </div>

        <button type="submit" id="confirmPurchaseButton">Confirm Purchase</button>
    </form>

    <script>
        // Retrieve the message from the URL query parameter
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        // If a message exists, display it as an alert
        if (message) {
            alert(decodeURIComponent(message));
        }

        // Render cart items
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const checkoutItemsContainer = document.getElementById('checkoutItems');

        function renderCheckoutItems() {
            checkoutItemsContainer.innerHTML = '';
            let subtotal = 0;

            if (cart.length > 0) {
                cart.forEach((item, index) => {
                    subtotal += item.price * item.quantity;

                    const checkoutItem = document.createElement('div');
                    checkoutItem.classList.add('checkout-item');
                    checkoutItem.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" />
                        <div class="checkout-details">
                            <p><strong>Name:</strong> ${item.name}</p>
                            <p><strong>Price:</strong> $${item.price.toFixed(2)}</p>
                            <p><strong>Quantity:</strong> ${item.quantity}</p>
                        </div>
                    `;
                    checkoutItemsContainer.appendChild(checkoutItem);
                });

                const shipping = 5.00;
                const total = subtotal + shipping;

                const totalContainer = document.createElement('div');
                totalContainer.classList.add('total-container');
                totalContainer.innerHTML = `
                    <p><strong>Total:</strong> $${total.toFixed(2)}</p>
                `;
                checkoutItemsContainer.appendChild(totalContainer);
            } else {
                checkoutItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
            }
        }

        renderCheckoutItems();
    </script>
</body>
</html>

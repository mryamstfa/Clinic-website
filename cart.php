<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOUR CART</title>
    <link rel="stylesheet" href="cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> <!-- Add Google Fonts -->
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f0f4f8, #d9e4f2);
            color: #333;
            min-height: 100vh; 
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
            font-size: 2.5rem;
            font-family: 'Roboto', sans-serif; 
            font-weight: 700; 
            letter-spacing: 2px;
            text-transform: uppercase; 
        }

        #cartContainer {
            display: flex;
            justify-content: space-between;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        #cartItems {
            flex: 1;
            margin-right: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 15px; 
            border-bottom: 1px solid #eee; 
        }

        .cart-item:last-child {
            border-bottom: none; 
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-details {
            flex: 1;
            margin-left: 20px;
        }

        .cart-details p {
            margin: 5px 0;
            font-size: 1rem;
            color: #333;
        }

        .cart-details p strong {
            color: rgb(98, 185, 225);
        }

        .quantity-bar {
            display: flex;
            align-items: center;
        }

        .quantity-bar button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity-bar button:disabled {
            background-color: rgb(77, 150, 199);
            cursor: not-allowed;
        }

        .quantity-bar button:hover {
            background-color: rgb(80, 156, 206);
        }

        .quantity-bar span {
            margin: 0 10px;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .cart-actions button {
            background-color: white;
            color: #e74c3c; 
            border: 2px solid #e74c3c;
            padding: 8px 12px;
            border-radius: 50%; 
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            width: 40px; 
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cart-actions button:hover {
            background-color: #e74c3c; 
            color: white; 
        }

        #summaryContainer {
            width: 300px;
        }

        #cartSummary {
            background-color: #ffffff; 
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        #cartSummary p {
            margin: 12px 0;
            font-weight: 600;
            color: #333;
        }

        #cartSummary p strong {
            color: #3498db;
        }

        #checkoutButton {
            background-color: #2ecc71;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        #checkoutButton:hover {
            background-color: #27ae60;
        }

        #backToDrugs {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #3498db; 
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        #backToDrugs:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            #cartContainer {
                flex-direction: column;
            }

            #summaryContainer {
                width: 100%;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <h1>YOUR CART</h1>
    <div id="cartContainer">
        <div id="cartItems">
        </div>

        <div id="summaryContainer">
            <div id="cartSummary">
                <p><strong>Subtotal:</strong> $0.00</p>
                <p><strong>Shipping:</strong> $0.00</p>
                <p><strong>Total:</strong> $0.00</p>
                <button id="checkoutButton" onclick="checkout()">Checkout</button>
            </div>

            <a id="backToDrugs" href="page2.php">Back to Drugs</a>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartItemsContainer = document.getElementById('cartItems');
        const cartSummary = document.getElementById('cartSummary');

        function renderCart() {
            cartItemsContainer.innerHTML = '';
            let subtotal = 0;

            if (cart.length > 0) {
                cart.forEach((item, index) => {
                    subtotal += item.price * item.quantity;

                    const cartItem = document.createElement('div');
                    cartItem.classList.add('cart-item');
                    cartItem.innerHTML = `
                        <img src="${item.image || 'images/default-placeholder.png'}" alt="${item.name}" />
                        <div class="cart-details">
                            <p><strong>Name:</strong> ${item.name}</p>
                            <p><strong>Price:</strong> $${item.price}</p>
                            <div class="quantity-bar">
                                <button onclick="updateQuantity(${index}, -1)" ${item.quantity === 1 ? 'disabled' : ''}>-</button>
                                <span class="quantity-value">${item.quantity}</span>
                                <button onclick="updateQuantity(${index}, 1)">+</button>
                            </div>
                        </div>
                        <div class="cart-actions">
                            <button onclick="deleteItem(${index})">×</button>
                        </div>
                    `;
                    cartItemsContainer.appendChild(cartItem);
                });
                const shippingCost = 5.00;
                const total = subtotal + shippingCost;

                cartSummary.innerHTML = `
                    <p><strong>Subtotal:</strong> $${subtotal.toFixed(2)}</p>
                    <p><strong>Shipping:</strong> $${shippingCost.toFixed(2)}</p>
                    <p><strong>Total:</strong> $${total.toFixed(2)}</p>
                    <button id="checkoutButton" onclick="checkout()">Checkout</button>
                `;
            } else {
                cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
                cartSummary.innerHTML = `
                    <p><strong>Subtotal:</strong> $0.00</p>
                    <p><strong>Shipping:</strong> $0.00</p>
                    <p><strong>Total:</strong> $0.00</p>
                    <button id="checkoutButton" onclick="checkout()">Checkout</button>
                `;
            }

            localStorage.setItem('cart', JSON.stringify(cart));
        }
         
        function updateQuantity(index, delta) {
            cart[index].quantity += delta;
            if (cart[index].quantity <= 0) {
                cart[index].quantity = 1;
            }
            renderCart();
        }

        function deleteItem(index) {
            cart.splice(index, 1);
            renderCart();
        }

        function checkout() 
        {
    if (cart.length === 0) {
        alert('Your cart is empty.');
        return;
    }

    window.location.href = 'checkout.php';
}

        renderCart();
    </script>
</body>
</html>
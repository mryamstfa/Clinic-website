function checkout() {
    if (cart.length === 0) {
        alert('Your cart is empty.');
        return;
    }

    fetch('update_quantities_on_checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ cart: cart }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Thank you for your purchase!');
            cart = []; 
            localStorage.removeItem('cart'); 
            renderCart(); 
        } else {
            alert('Failed to complete the checkout. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred during checkout.');
    });
}
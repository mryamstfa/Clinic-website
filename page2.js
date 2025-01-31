let cart = JSON.parse(localStorage.getItem('cart')) || [];

function addToCart(itemId, itemName, itemPrice) {
    fetch('update_quantity.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ itemId: itemId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const imageUrl = document.querySelector(`[data-name="${itemName}"] img`).src;

            const existingItem = cart.find(item => item.id === itemId);
            if (existingItem) {
                existingItem.quantity += 1; 
            } else {
               
                cart.push({
                    id: itemId,
                    name: itemName,
                    price: itemPrice,
                    quantity: 1,
                    image: imageUrl
                });
            }

           
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`${itemName} added to the cart!`);
            updateCartCount();
        } else {
            alert(`Failed to add ${itemName} to the cart. OUT OF STOCK.`);
        }
    })
    .catch(error => {
        console.error("Error adding to cart: ", error);
    });
}

function updateCartCount() {
    const cartCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    document.getElementById('cartCount').textContent = cartCount;
}

function redirectToCart() {
    window.location.href = 'cart.php';
}

function filterItems() {
    const searchInput = document.getElementById('Searchbar').value.toLowerCase();
    const drugItems = document.querySelectorAll('#drugitem');
    drugItems.forEach(item => {
        const drugName = item.querySelector('#drugname').textContent.toLowerCase();
        item.style.display = drugName.includes(searchInput) ? 'block' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
});
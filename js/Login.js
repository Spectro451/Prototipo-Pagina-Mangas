// Función para mostrar/ocultar el formulario de login
const loginToggle = document.getElementById('login-toggle');
const loginContainer = document.getElementById('login-container');

// Mostrar u ocultar el formulario de login
loginToggle.addEventListener('click', function() {
    loginContainer.classList.toggle('hidden');
});

// Función para mostrar/ocultar el carrito
const cartToggle = document.getElementById('cart-toggle');
const cartContainer = document.getElementById('cart-container');

// Mostrar u ocultar el carrito
cartToggle.addEventListener('click', function() {
    cartContainer.classList.toggle('hidden');
});

// Función para agregar un artículo al carrito (puedes agregar más funciones para añadir productos)
function addToCart(productName, price) {
    const cartItems = document.getElementById('cart-items');
    const totalPrice = document.getElementById('total-price');

    const newItem = document.createElement('li');
    newItem.textContent = `${productName} - $${price}`;
    cartItems.appendChild(newItem);

    // Actualizar el total
    let currentTotal = parseFloat(totalPrice.textContent);
    currentTotal += price;
    totalPrice.textContent = currentTotal.toFixed(2);
}
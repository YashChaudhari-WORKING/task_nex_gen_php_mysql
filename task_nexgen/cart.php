<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 20px;
}

.cart-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: auto;
}

.cart {
    flex: 1 1 60%;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin-right: 20px;
}

.title {
    margin-bottom: 20px;
}

h4 {
    font-size: 24px;
}

.text-muted {
    font-size: 14px;
}

#cart-items {
    margin-bottom: 20px;
}

.card {
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 15px;
}

.card img {
    max-width: 100%;
    border-radius: 5px;
}

.main {
    display: flex;
    align-items: center;
}

.quantity-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.quantity-controls a {
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #007bff;
    border-radius: 5px;
    color: #007bff;
    margin: 0 5px;
}

.quantity-controls a:hover {
    background-color: #007bff;
    color: white;
}

.summary {
    flex: 1 1 35%;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.summary h5 {
    font-size: 24px;
}

.row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.col {
    flex: 1;
    padding: 5px;
}

.btn {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 100%;
}

.btn:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .cart-container {
        flex-direction: column;
    }

    .cart {
        margin-right: 0;
        margin-bottom: 20px;
    }

    .summary {
        margin-bottom: 0;
    }

    h4, h5 {
        font-size: 20px;
    }

    .btn {
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    h4, h5 {
        font-size: 18px;
    }

    .btn {
        padding: 8px 16px;
    }
}
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                    <div class="col text-right text-muted" id="cart-count-container">0 items</div>
                </div>
            </div>
            <div id="cart-items"></div>
            <div class="back-to-shop">
                <a href="#">&leftarrow;</a><span class="text-muted">Back to shop</span>
            </div>
        </div>

        <div class="summary">
            <h5><b>Summary</b></h5>
            <hr>
            <div class="row">
                <div class="col" style="padding-left: 0;">ITEMS <span id="total-items">0</span></div>
                <div class="col text-right"><span id="total-price">€ 0.00</span></div>
            </div>
            <div class="row">
                <div class="col">TOTAL PRICE</div>
                <div class="col text-right" id="final-price">€ 0.00</div>
            </div>
            <button class="btn">CHECKOUT</button>
        </div>
    </div>

    <script>
    function loadCartItems() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartContainer = document.getElementById('cart-items');
        const totalItems = document.getElementById('total-items');
        const totalPrice = document.getElementById('total-price');
        const cartCountContainer = document.getElementById('cart-count-container');
        let totalAmount = 0;

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p>Your cart is empty</p>';
            totalItems.textContent = '0';
            totalPrice.textContent = '€ 0.00';
            cartCountContainer.textContent = '0 items';
        } else {
            const cartIds = cart.map(item => item.id);
            fetch(`fetch_cart.php?ids=${cartIds.join(',')}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        cartContainer.innerHTML = `<p>Error: ${data.error}</p>`;
                    } else {
                        data.forEach(product => {
                            const cartItem = cart.find(item => item.id === product.id);
                            const cartItemDiv = document.createElement('div');
                            cartItemDiv.classList.add('card');
                            cartItemDiv.dataset.id = product.id;

                            cartItemDiv.innerHTML = `
                                <div class="row main align-items-center">
                                    <div class="col-3"><img class="img-fluid" src="${product.img}" alt="${product.title}" data-price="${product.price}"></div>
                                    <div class="col-6">
                                        <div class="row text-muted">${product.category}</div>
                                        <div class="row">${product.title}</div>
                                    </div>
                                    <div class="col-2 quantity-controls">
                                        <a href="#" class="border" data-action="decrease" data-id="${product.id}">-</a>
                                        <a href="#" class="border">${cartItem.count}</a>
                                        <a href="#" class="border" data-action="increase" data-id="${product.id}">+</a>
                                    </div>
                                    <div class="col-2 price">€ <span class="item-price">${(product.price * cartItem.count).toFixed(2)}</span> <span class="close">&#10005;</span></div>
                                </div>
                            `;
                            cartContainer.appendChild(cartItemDiv);
                            totalAmount += product.price * cartItem.count;
                        });

                        totalItems.textContent = cart.length;
                        totalPrice.textContent = `€ ${totalAmount.toFixed(2)}`;
                        cartCountContainer.textContent = `${cart.length} items`;

                        const shippingCost = 5.00;
                        const finalPrice = totalAmount + shippingCost;
                        document.getElementById('final-price').textContent = `€ ${finalPrice.toFixed(2)}`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching cart items:', error);
                    cartContainer.innerHTML = '<p>There was an error loading your cart.</p>';
                });
        }
    }

    document.addEventListener('click', function(event) {
        if (event.target.tagName === 'A' && (event.target.dataset.action === 'increase' || event.target.dataset.action === 'decrease')) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const productId = event.target.dataset.id;
            const action = event.target.dataset.action;
            const cartItem = cart.find(item => item.id === productId);

            if (action === 'increase') {
                cartItem.count += 1;
            } else if (action === 'decrease' && cartItem.count > 1) {
                cartItem.count -= 1;
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            const cartItemDiv = document.querySelector(`[data-id="${productId}"]`);
            const quantityControl = cartItemDiv.querySelector('.quantity-controls');
            const priceElement = cartItemDiv.querySelector('.item-price');

            quantityControl.children[1].textContent = cartItem.count;
            priceElement.textContent = (cartItem.count * parseFloat(cartItemDiv.querySelector('img').dataset.price)).toFixed(2);

            const totalItems = document.getElementById('total-items');
            const totalPrice = document.getElementById('total-price');
            let totalAmount = 0;
            document.querySelectorAll('.card').forEach(item => {
                const price = item.querySelector('.item-price').textContent;
                totalAmount += parseFloat(price);
            });
            totalItems.textContent = cart.length;
            totalPrice.textContent = `€ ${totalAmount.toFixed(2)}`;

            const shippingCost = 5.00;
            const finalPrice = totalAmount + shippingCost;
            document.getElementById('final-price').textContent = `€ ${finalPrice.toFixed(2)}`;
        }
    });

    loadCartItems();
    </script>
</body>
</html>

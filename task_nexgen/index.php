<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Info Lookup</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="top_pro.css">
    <link rel="stylesheet" href="card_layout.css">
</head>

<body>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index.php"><img src="https://th.bing.com/th?id=OIP.htTB7sCOTHa0m5NzCJbrSAHaFj&w=288&h=216&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="RedStore" width="125px" /></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="product.html">Products</a></li>
                    <li><a href="account.html">Log In</a></li>
                </ul>
            </nav>
            <a href="cart.php" class="cart-icon" style="position: relative; display: inline-block;">
                <img src="https://i.ibb.co/PNjjx3y/cart.png" alt="Cart" width="30px" height="30px" />
                <span id="cart-count" style="position: absolute; top: -5px; right: -5px; background-color: red; color: white; font-size: 12px; font-weight: bold; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">0</span>
            </a>
        </div>
    </div>

    <script>
        function updateCartCount() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartCount = document.getElementById('cart-count');
            const totalCount = cart.length;

            if (totalCount > 0) {
                cartCount.textContent = totalCount;
                cartCount.style.display = 'flex';
            } else {
                cartCount.style.display = 'none';
            }
        }

        updateCartCount();
    </script>

    <div class="slider-wrapper">
        <div class="slider">
            <div class="item">
                <figure>
                    <img src="data:image/jpeg;base64,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" alt="Nike" data-fetch-priority="high">
                    <figcaption>
                        <h4>Best Laptop Shop</h4>
                        <p>Whats Wait Expolre Now...</p>
                        <a href="https://nike.co.uk">Visit Site</a>
                    </figcaption>
                </figure>
            </div>
        </div>
        <button class="btn-prev">◀</button>
        <button class="btn-next">▶</button>
        <div class="range">
            <input type="range" min="1" max="3" step="1" value="1" />
        </div>
    </div>

    <h1 class="title-shop">Best Seller</h1>
    <div id="top-product-list" class="product-list-container">Loading products...</div>

    <script>
        fetch('fetch_top_products.php')
            .then(response => response.json())
            .then(data => {
                const productList = document.querySelector('#top-product-list');

                if (data.error) {
                    productList.innerHTML = `<p class="error-message">Error: ${data.error}</p>`;
                } else {
                    productList.innerHTML = '';
                    data.forEach(product => {
                        const productItem = document.createElement('div');
                        productItem.className = 'product-card';
                        productItem.innerHTML = `
                            <img class="product-image" src="${product.img}" alt="${product.title}">
                            <h2 class="product-title">${product.title}</h2>
                            <p class="product-description">${product.description}</p>
                            <div class="product-footer">
                                <p class="product-price">$${product.price}</p>
                            </div>
                        `;
                        productItem.addEventListener('click', () => {
                            window.location.href = `product_detailed.php?id=${product.id}`;
                        });
                        productList.appendChild(productItem);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching products:', error);
            });
    </script>

    <h1 class="title-shop">Best Laptop Deals</h1>

    <main class="main bd-grid" id="laptop-product-list">Loading products...</main>

    <script>
        fetch('laptop.php')
            .then(response => response.json())
            .then(data => {
                const productList = document.getElementById('laptop-product-list');

                if (data.error) {
                    productList.innerHTML = `<p class="error-message">Error: ${data.error}</p>`;
                } else {
                    productList.innerHTML = '';

                    data.forEach(product => {
                        const productItem = document.createElement('article');
                        productItem.className = 'card';
                        productItem.innerHTML = `
                            <div class="card__img">
                                <img src="${product.img}" alt="${product.title}">
                            </div>
                            <div class="card__name">
                                <p>${product.short_description}</p>
                            </div>
                             <h3>${product.title}</h3>
                            <div class="card__precis">
                                <div class="card__price-cart">
                                    <span class="card__preci card__preci--now">$${product.price}</span>
                                </div>
                            </div>
                        `;

                        productItem.addEventListener('click', () => {
                            window.location.href = `product_detailed.php?id=${product.id}`;
                        });

                        productList.appendChild(productItem);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                const productList = document.getElementById('laptop-product-list');
                productList.innerHTML = `<p class="error-message">Failed to load products.</p>`;
            });
    </script>

    <script src="function.js"></script>
</body>

</html>

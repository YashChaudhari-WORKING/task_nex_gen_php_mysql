<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="detailed.css">
</head>
<body>
<main>
<div class="card">
  <div class="card__title">
    <div class="icon">
      <a href="#"><i class="fa fa-arrow-left"></i></a>
    </div>
    <h3>Product Details</h3>
  </div>
  <div id="product-details" class="card__body">
    Loading product details...
  </div>
  <div class="card__footer" id="product-footer">
   
  </div>
</div>

<script>
  const params = new URLSearchParams(window.location.search);
  const productId = params.get('id');


  if (productId) {
    fetch(`fetch_detailed.php?id=${productId}`) 
        .then(response => response.json()) 
        .then(data => {
            const productDetails = document.querySelector('#product-details');
            const productFooter = document.querySelector('#product-footer');

            if (data.error) {
                productDetails.innerHTML = `<p class="error-message">Error: ${data.error}</p>`;
            } else {
            
                productDetails.innerHTML = `
                    <div class="half">
                        <div class="featured_text">
                            <h1>${data.title}</h1>
                            <p class="sub">${data.category || "Product Category"}</p>
                            <p class="price">$${data.price}</p>
                        </div>
                        <div class="image">
                            <img src="${data.img}" alt="${data.title}">
                        </div>
                    </div>
                    <div class="half">
                        <div class="description">
                            <p>${data.description}</p>
                        </div>
                        <span class="stock">
                            <i class="fa fa-pen"></i> ${data.stock ? "In stock" : "Out of stock"}
                        </span>
                    </div>
                `;

                productFooter.innerHTML = `
                    <div class="recommend">
                        <p>Recommended by</p>
                        <h3>${data.recommendation || "Professional"}</h3>
                    </div>
                    <div class="action">
                        <button type="button" id="add-to-cart">Add to cart</button>
                    </div>
                `;

          
                document.getElementById('add-to-cart').addEventListener('click', () => {
                    let cart = JSON.parse(localStorage.getItem('cart')) || [];

                   
                    const existingProduct = cart.find(item => item.id === productId);

                    if (existingProduct) {
                       
                        existingProduct.count += 1;
                    } else {
                     
                        cart.push({ id: productId, count: 1 });
                    }

                   
                    localStorage.setItem('cart', JSON.stringify(cart));

                   
                    alert('Item added to cart');
                });
            }
        })
        .catch(error => console.error('Error fetching product details:', error));
} else {
    document.querySelector('#product-details').innerHTML = '<p>Error: No product selected</p>';
}
</script>

</main>
<script src="detailed.js"></script>
</body>
</html>

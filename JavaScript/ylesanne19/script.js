document.addEventListener("DOMContentLoaded", () => {
    const productsContainer = document.getElementById("products");

    function fetchProducts() {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "https://dummyjson.com/products", true);
  
      xhr.onload = function () {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          renderProducts(response.products);
        } else {
          console.error("Failed to fetch products");
        }
      };
  
      xhr.onerror = function () {
        console.error("An error occurred during the request");
      };
  
      xhr.send();
    }
  
    function renderProducts(products) {
      productsContainer.innerHTML = products
        .map(
          (product) => `
          <div class="card">
            <img src="${product.thumbnail}" class="card-img-top" alt="${product.title}">
            <div class="card-body">
              <h5 class="card-title">${product.title}</h5>
              <p class="card-text">${product.price}€</p>
              <button class="btn btn-primary">Add to cart</button>
            </div>
          </div>
        `
        )
        .join("");
    }
  
    fetchProducts();
  });
  
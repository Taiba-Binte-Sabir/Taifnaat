// =====================
// GLOBAL CART SYSTEM
// =====================
let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartBadge();
}

function updateCartBadge() {
  const badge = document.querySelector(".badge");
  if (badge) {
    let totalQty = cart.reduce((sum, item) => sum + item.quantity, 0);
    badge.innerText = totalQty;
  }
}

function addToCart(name, price, image) {
  let product = cart.find(item => item.name === name);

  if (product) {
    product.quantity++;
  } else {
    cart.push({ name, price, image, quantity: 1 });
  }

  saveCart();
  Swal.fire({
  title: "Added!",
  text: "Product added to cart 🛒",
  icon: "success",
  iconColor: "black",

  timer: 1500,
  showConfirmButton: false,
  confirmButtonColor:"#000"

});
}

// =====================
// ATTACH BUTTONS (ALL PAGES)
// =====================
function setupAddToCartButtons() {
  const buttons = document.querySelectorAll(".product-btn, .card-button");

  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      let parent = btn.closest(".product-card") || btn.closest(".card");

      let name = parent.querySelector(".product-title, .text-title")?.innerText;
      let priceText = parent.querySelector(".price")?.innerText || "Rs 0";
      let image = parent.querySelector("img")?.src;

      let price = parseInt(priceText.replace(/[^0-9]/g, "")) || 0;

      addToCart(name, price, image);
    });
  });
}

// =====================
// CART PAGE
// =====================
function loadCartPage() {
  const container = document.querySelector(".container");
  if (!container) return;

  const emptyDiv = document.querySelector(".empty-cart");
  const summary = document.querySelector(".summary");

  let existingList = document.getElementById("cart-items");

  if (!existingList) {
    let list = document.createElement("div");
    list.id = "cart-items";
    container.insertBefore(list, summary);
  }

  const cartItemsDiv = document.getElementById("cart-items");
  cartItemsDiv.innerHTML = "";

  if (cart.length === 0) {
    emptyDiv.style.display = "block";
    summary.style.display = "none";
    return;
  }

  emptyDiv.style.display = "none";
  summary.style.display = "block";

  let subtotal = 0;

  cart.forEach((item, index) => {
    subtotal += item.price * item.quantity;

    cartItemsDiv.innerHTML += `
      <div style="border-bottom:1px solid #ffffff; padding:10px;">
        <img src="${item.image}" width="60" style="display:block; margin:10px auto;">
        <h4 style="color:white">${item.name}</h4>
        <p style="color:white">Rs ${item.price}</p>
        <button style="background:white; color:black; border:1px solid black; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="changeQty(${index}, -1)">-</button>
        <span style="color:white;">${item.quantity}</span>
        <button style="background:white; color:black; border:1px solid black; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="changeQty(${index}, 1)">+</button>
        <button style="background:white; color:black; border:1px solid black; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="removeItem(${index})">Remove</button>
      </div>
    `;
  });

  let delivery = subtotal > 0 ? 200 : 0;
  let total = subtotal + delivery;
document.getElementById("subtotal").innerText = "Rs " + subtotal;
document.getElementById("delivery").innerText = "Rs " + delivery;
document.getElementById("total").innerText = "Rs " + total;
}

function changeQty(index, change) {
  cart[index].quantity += change;

  if (cart[index].quantity <= 0) {
    cart.splice(index, 1);
  }

  saveCart();
  loadCartPage();
}

function removeItem(index) {
  cart.splice(index, 1);
  saveCart();
  loadCartPage();
}

// =====================
// CHECKOUT
// =====================
function setupCheckout() {
  const btn = document.querySelector(".checkout");
  if (!btn) return;

  btn.addEventListener("click", () => {
 btn.addEventListener("click", () => {
  window.location.href = "checkout.html";
});
   
  });
}

// =====================
// FEEDBACK FORM
// =====================
function setupFeedback() {
  const form = document.querySelector(".contact-box form");
  if (!form) return;

  form.addEventListener("submit", function(e) {
    e.preventDefault();

    Swal.fire({
  title: "Thank You 💖",
  text: "Your feedback has been sent!",
  icon: "success",
  iconColor: "black",
  confirmButtonText: "OK",
  confirmButtonColor: "#000"
});
    form.reset();
  });
}

// =====================
// SEARCH SYSTEM
// =====================
function setupSearch() {
  const input = document.getElementById("search-input");
  if (!input) return;

  input.addEventListener("keyup", () => {
    let value = input.value.toLowerCase();

    let products = document.querySelectorAll(
      ".product-card, .card-wrapper"
    );

    products.forEach(item => {
      let text = item.innerText.toLowerCase();

      if (value === "") {
        item.style.display = "";
      } else {
        item.style.display = text.includes(value) ? "" : "none";
      }
    });
  });
}
// =====================
// INIT
// =====================
document.addEventListener("DOMContentLoaded", () => {
  updateCartBadge();
  setupAddToCartButtons();
  loadCartPage();
  setupCheckout();
  setupFeedback();
  setupSearch();
});
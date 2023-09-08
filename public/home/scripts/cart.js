// Collecting DOM Elements

// get minus btn from dom
const productAmountBtns = document.querySelectorAll(".amount-btn");

// get cards delete icon from dom
const cardsDeleteIcon = document.querySelectorAll(".cart-x-icon-container");

// amount of product
const productAmountNumber = document.querySelectorAll(".product-amount-number");

// total price element on checkout btn
const totalPriceElement = document.querySelector(".checkout-btn-price");

// set chekcout price on checkout btn
function setCheckoutTotalPrice() {
  // get all prices from dom
  const productPrices = document.querySelectorAll(".cart-product-price");
  // total price of products
  let totalPrice = 0;

  // for each loop on product prices to update price on ui
  productPrices.forEach((price) => {
    // total price of products
    totalPrice = totalPrice + +price.innerText;
    // update total price element
    totalPriceElement.innerText = `$ ${totalPrice.toFixed(2)}`;
  });

  // check if there are no products and set total price to 0
  if (productPrices.length === 0) totalPriceElement.innerText = "$ 0.00";
}

// forEach on delete icons on cards
cardsDeleteIcon.forEach((icon) => {
  icon.addEventListener("click", removeProductFromCart);
});

// remove product from card
function removeProductFromCart(e) {
  e.target.parentElement.parentElement.parentElement.remove();

  // update total price on check out btn
  setCheckoutTotalPrice();
}

// change amount and price on products function
function changeAmount(e) {
  // select parent element of clicked element
  const parent = e.target.closest(".cart");

  // get the amount of products of the clicked element
  let number = parent.querySelector(".product-amount-number");

  // check if the clicked btn is plus or minus
  if (e.target.classList.contains("product-amount-minus-btn")) {
    +number.innerText--;
  } else {
    +number.innerText++;
  }

  // make sure to don't have minus amount of products
  if (+number.innerText < 0) number.innerText = 0;

  // get product price element from dom
  let productPriceElement = parent.querySelector(".cart-product-price");

  // get initial price of product
  const initialPrice = +productPriceElement.dataset.price;

  // update product price on click
  productPriceElement.innerText = (initialPrice * +number.innerText).toFixed(2);

  // update total price on check out btn
  setCheckoutTotalPrice();
}

// set total price on load
document.addEventListener("DOMContentLoaded", setCheckoutTotalPrice);

// btn click event
productAmountBtns.forEach((btn) => {
  btn.addEventListener("click", changeAmount);
});

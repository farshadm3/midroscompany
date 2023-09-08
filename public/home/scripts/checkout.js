// collecting DOM Elements

// checkout btn
const checkoutBtn = document.querySelector(".checkout-btn-section-container");

// checkoout menu close btn
const checkoutCloseIcon = document.querySelector(".checkout-x-icon");

const checkoutContainer = document.querySelector(".checkout-section-container");

//functions

// hide checkout
function hideCheckout() {
  // remove active class from checkout section
  checkoutContainer.classList.remove("active-checkout-section-container");

  // remove overlay
  document.querySelector(".overlay").classList.remove("active-overlay");
}

// show checkout
function showCheckout() {
  // add active class to checkout section
  checkoutContainer.classList.add("active-checkout-section-container");

  // add overlay
  document.querySelector(".overlay").classList.add("active-overlay");
}

// event listeners

// checkout btn click event
checkoutBtn.addEventListener("click", showCheckout);

// checkout close icon click event
checkoutCloseIcon.addEventListener("click", hideCheckout);

// clicking outside checkout closes it
document.addEventListener("click", function (e) {
  const checkoutSection = document.querySelector(".section-checkout");

  if (!checkoutSection.contains(e.target)) {
    hideCheckout();
  }
});

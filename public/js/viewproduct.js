let qty = document.querySelector(".qty");

const incQty = () => {
  qty.innerText = parseInt(qty.innerHTML) + 1;
};

const decQty = () => {
  if (qty.innerHTML != 1) {
    qty.innerText = parseInt(qty.innerHTML) - 1;
  }
};

cart = getCart();

let addToCartBtn = document.querySelector(".add-to-cart");
addToCartBtn.addEventListener('click', () => {
  let productId = addToCartBtn.getAttribute("data-id");
  let price = parseInt(document.querySelector(".discounted-price span").innerText);
  let size = document.querySelector("#size").value;
  //let colour = document.querySelector("");
  //let discount = document.querySelector("");
  let quantity = parseInt(document.querySelector(".qty").innerText);
  let fullImgUrl = document.querySelector('.product-detail-container img').src;

  let imgUrl = fullImgUrl.split('/').slice(6).join('/');
  addToCart({ productId, size, colour: "Red", price, discount: 0, quantity, imgUrl});
});

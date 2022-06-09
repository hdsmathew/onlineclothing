<?php

  include_once "../config/Database.php";
  include_once "../models/Product.php";

  $database = new Database();
  $db = $database->connect();

  $productModel = new Product($db);

  // Product to view
  $productModel->productId = $_GET['productId'] or die("No product specified");
  $productModel->readSingle();

  $discountedPrice = (1 - $productModel->discount / 100) * $productModel->unitPrice;
  $actualPrice = !empty($productModel->discount) ? "<span class='actual-price'>Rs {$productModel->unitPrice}</span>" : "";
  $discount = !empty($productModel->discount) ? "{$productModel->discount}% OFF" : "";

  $productDetails = <<<HTML
    <div class="row g-4">
      <div class="col-md-6 col-lg-5">
        <img class="product-detail-image" src="img/{$productModel->imgUrl}" width="350" alt="">
      </div>
      <div class="col-md-6 col-lg-7">
        <div class="product-detail-desc">
          <h1>{$productModel->prodName}</h1>
          <div class="star-rating d-flex gap-1 mt-1">
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-solid fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <p>(7)</p>
          </div>
          <h4>Details:</h4>
          <p>{$productModel->prodDesc}</p>
          <p>{$actualPrice}<span class="discounted-price">Rs <span>{$discountedPrice}</span></span>{$discount}</p>
          <div class="quantity d-flex align-items-center">
            <h3>Quantity</h3>
            <p class="quantity-desc">
              <span class="minus" onclick="decQty()">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                  <path d="M872 474H152c-4.4 0-8 3.6-8 8v60c0 4.4 3.6 8 8 8h720c4.4 0 8-3.6 8-8v-60c0-4.4-3.6-8-8-8z"></path>
                </svg>
              </span>
              <span class="num qty">1</span>
              <span class="plus" onclick="incQty()">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" t="1551322312294" viewBox="0 0 1024 1024" version="1.1" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><defs></defs>
                  <path d="M474 152m8 0l60 0q8 0 8 8l0 704q0 8-8 8l-60 0q-8 0-8-8l0-704q0-8 8-8Z"></path><path d="M168 474m8 0l672 0q8 0 8 8l0 60q0 8-8 8l-672 0q-8 0-8-8l0-60q0-8 8-8Z"></path>
                </svg>
              </span>
            </p>
          </div>
          <div class="select-size d-flex">
            <h3>Select Size</h3>
            <select name="size" id="size">
              <option value="S">Small</option>
              <option value="M">Medium</option>
              <option value="L">Large</option>
            </select>
          </div>
          <div class="buttons d-flex gap-4">
            <button class="add-to-cart" type="button" data-id="{$productModel->productId}">Add to Cart</button>
            <button class="buy-now" type="button">Buy Now</button>
          </div>
        </div>            
      </div>
    </div>
  HTML;

  // Suggestions
  $products = $productModel->read($productModel->categoryName)->fetchAll(PDO::FETCH_ASSOC);

  foreach ($products as $product) {
    $discountTag = !empty($product['discount']) ? "<span class='discount-tag'>{$product['discount']}% off</span>" : "";

    $suggestions .= <<<HTML
      <div class="product-card d-flex flex-column">
        <div class="product-image">
          {$discountTag}
          <a href="viewproduct.php?productId={$product['productId']}">
            <img src="img/{$product['imgUrl']}" alt="" class="card-img-top">
          </a>
        </div>
        <div class="card-body">
          <h5>Hoodie</h5>
          <p class="product-short-desc">{$product['prodDesc']}</p>
          <span class="price">Rs {$product['unitPrice']}</span>
        </div>
      </div>
    HTML;
  }

  $suggestionsMarquee = <<<HTML
    <div class="marquee">
      <div class="product-container-marquee track d-flex justify-content-center mt-5">
        <!-- Product Cards -->
        {$suggestions}
      </div>
    </div> 
  HTML;

  include_once "templates/_viewproduct.php";

?>
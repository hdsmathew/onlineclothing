<?php 

  include_once "../config/Database.php";

  $database = new Database();
  $db = $database->connect();

  // Trending Products
  $trendingQuery = "SELECT product.productId, prodName, prodDesc, product.unitPrice, product.discount, picture AS imgUrl, COUNT(orderitems.productId)
                  FROM product INNER JOIN orderitems ON product.productId = orderitems.productId
                  GROUP BY product.productId, prodName, prodDesc, product.unitPrice, product.discount, picture
                  ORDER BY COUNT(orderitems.productId) DESC
                  LIMIT 10;";

  $trendingProducts = "";
  $products = $db->query($trendingQuery)->fetchAll(PDO::FETCH_ASSOC);
  foreach ($products as $product) {
    $discountTag = !empty($product['discount']) ? "<span class='discount-tag'>{$product['discount']}% off</span>" : "";

    $trendingProducts .= <<<HTML
      <div class="product-card d-flex flex-column">
        <div class="product-image">
          {$discountTag}
          <a href="viewproduct.php?productId={$product['productId']}">
            <img src="img/{$product['imgUrl']}" alt="" class="card-img-top">
          </a>
        </div>
        <div class="card-body">
          <h5>{$product['prodName']}</h5>
          <p class="product-short-desc">{$product['prodDesc']}</p>
          <span class="price">Rs {$product['unitPrice']}</span>
        </div>
      </div>
    HTML;    
  }

  // Suggestions
  $suggestionsQuery = "SELECT productId, prodName, prodDesc, unitPrice, discount, picture AS imgUrl
                      FROM product INNER JOIN category ON product.categoryId = category.categoryId
                      WHERE categoryName = 'Jean';";

  $suggestions = "";
  $suggestionsMarquee = "";
  $products = $db->query($suggestionsQuery)->fetchAll(PDO::FETCH_ASSOC);
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
          <h5>{$product['prodName']}</h5>
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

  include_once "templates/_index.php";

?>
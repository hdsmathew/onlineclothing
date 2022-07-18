<?php 

  require_once "BaseRestHandler.php";
  require_once('../config/Database.php');
  require_once('../models/Product.php');

  class ProductRestHandler extends BaseRestHandler {

    public function read($categoryName = "%", $gender = "%") {
      // Set db connection
      $database = new Database();
      $db = $database->connect();

      // Instantiate product model
      $productModel = new Product($db);

      // Query product
      $result = $productModel->read($categoryName, $gender);

      if ($result->rowCount() > 0) { // product found
        $productArr = array();
        $productArr['data'] = array();

        $products = $result->fetchAll(PDO::FETCH_ASSOC);

        forEach($products as $productRow) {
          // Assign field value to variable named after field name
          extract($productRow);

          $product = array(
            'productId' => $productId,
            'prodDesc' => $prodDesc,
            'prodName' => $prodName,
            'unitPrice' => $unitPrice,
            'discount' => $discount,
            'imgUrl' => $imgUrl,
            'categoryName' => $categoryName
          );

          array_push($productArr['data'], $product);
        }

        $statusCode = 200;
        $productArr['status'] = "success";
        $productArr['message'] = "Products Found";

      } else {
        // No Products
        $productArr['data'] = null;
        $statusCode = 404;
        $productArr['status'] = "fail";
        $productArr['message'] = "No Product Found";
      }

      $requestContentType = "application/json";
		  $this->setHttpHeaders($requestContentType, $statusCode);

      echo json_encode($productArr);
    }

    public function readSingle($id) {
      // Set db connection
      $database = new Database();
      $db = $database->connect();

      // Instantiate product model
      $productModel = new Product($db);

      // ProductId to read; else die()
      $productModel->productId = $id;
      $productModel->readSingle();

      $productArr['data'] = array(
      'productId' => $productModel->productId,
      'prodDesc' => $productModel->prodDesc,
      'prodName' => $productModel->prodName,
      'unitPrice' => $productModel->unitPrice,
      'discount' => $productModel->discount,
      'imgUrl' => $productModel->imgUrl,
      'categoryName' => $productModel->categoryName
      );

      $statusCode = 200;
      $productArr['status'] = "success";
      $productArr['message'] = "Product Found";
      if (!isset($productArr['data']['prodName'])) {
        $productArr['data'] = null;
        $statusCode = 404;
        $productArr['status'] = "fail";
        $productArr['message'] = "No Product Found";
      }

      $requestContentType = "application/json";
		  $this->setHttpHeaders($requestContentType, $statusCode);

      echo json_encode($productArr);
    }

    public function create() {
      // Set db connection
      $database = new Database();
      $db = $database->connect();

      // Instantiate product model
      $productModel = new Product($db);

      $newProductData = json_decode( file_get_contents('php://input') );

      // Set New Product details
      $productModel->prodName = $newProductData->prodName;
      $productModel->prodDesc = $newProductData->prodDesc;
      $productModel->unitPrice = $newProductData->unitPrice;
      $productModel->discount = $newProductData->discount;
      $productModel->imgUrl = $newProductData->imgUrl;
      $productModel->categoryId = $newProductData->categoryId;
      $productModel->colour = $newProductData->colour;
      $productModel->size = $newProductData->size;
      $productModel->stockLevel = $newProductData->stockLevel;

      $statusCode = 200;
      $result['status'] = "success";
      $result['message'] = "Product Created";
      if (!$productModel->update()) {
        $statusCode = 500;
        $result['status'] = "fail";
        $result['message'] = "Product Cannot Be Created";
      }

      $requestContentType = "application/json";
		  $this->setHttpHeaders($requestContentType, $statusCode);

      echo json_encode($result);
    }

    public function update() {
      // Set db connection
      $database = new Database();
      $db = $database->connect();

      // Instantiate product model
      $productModel = new Product($db);

      $newProductData = json_decode( file_get_contents('php://input') );

      // Set New Product details
      $productModel->productId = $newProductData->productId;
      $productModel->prodName = $newProductData->prodName;
      $productModel->prodDesc = $newProductData->prodDesc;
      $productModel->unitPrice = $newProductData->unitPrice;
      $productModel->discount = $newProductData->discount;
      $productModel->imgUrl = $newProductData->imgUrl;
      $productModel->categoryId = $newProductData->categoryId;
      $productModel->colour = $newProductData->colour;
      $productModel->size = $newProductData->size;
      $productModel->stockLevel = $newProductData->stockLevel;

      $statusCode = 200;
      $result['status'] = "success";
      $result['message'] = "Product Updated";
      if (!$productModel->update()) {
        $statusCode = 500;
        $result['status'] = "fail";
        $result['message'] = "Product Cannot Be Updated";
      }

      $requestContentType = "application/json";
		  $this->setHttpHeaders($requestContentType, $statusCode);

      echo json_encode($result);
    }

    public function delete() {
      // Set db connection
      $database = new Database();
      $db = $database->connect();

      // Instantiate product model
      $productModel = new Product($db);

      $productData = json_decode( file_get_contents('php://input') );

      // Set New Product details
      $productModel->productId = $productData->productId;

      $statusCode = 200;
      $result['status'] = "success";
      $result['message'] = "Product Deleted";
      if (!$productModel->update()) {
        $statusCode = 500;
        $result['status'] = "fail";
        $result['message'] = "Product Cannot Be Deleted";
      }

      $requestContentType = "application/json";
		  $this->setHttpHeaders($requestContentType, $statusCode);

      echo json_encode($result);
    }

  }

?>
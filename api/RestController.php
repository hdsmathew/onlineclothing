<?php

  require_once "ProductRestHandler.php";

  $requestMethod = $_SERVER['REQUEST_METHOD'];
  $resource = $_GET['resource'] ?? "";
  $resourceId = $_GET['id'] ?? "";

  switch ($resource) {
    case "product":
      $productHandler = new ProductRestHandler();

      switch ($requestMethod) {
        case "GET":
          $category = $_GET['category'] ?? "%";
          $gender = $_GET['gender'] ?? "%";

          if (empty($resourceId)) {
            $productHandler->read($category, $gender);
          } else {
            $productHandler->readSingle($resourceId);
          }
          break;

        case "POST":
          $productHandler->create();
          break;  

        case "PUT":
          $productHandler->update();
          break;
         
        case "DELETE":
          $productHandler->delete();
          break;  
        }
      break;
  
    default:  
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StylishWear</title>

  <!-- Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap">
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- custom css -->
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/marquee.css">
  <link rel="stylesheet" href="css/productCard.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white"></nav>

  <!-- Hero Section -->
  <header class="container-fluid">
    <img id="hero-img" src="img/hero.png" alt="Hero Image">
    <div class="hero-heading container d-flex justify-content-center align-items-center flex-column">
      <p class="heading">Wear Stylish</p>
      <p class="sub-heading typewrite" data-period="2000" data-type='["smart", "casual", "cool"]'>
        <span class="word"></span>
        <span class="spinner spinner-grow spinner-grow-sm spinner-blue mb-1 me-2"></span>
      </p>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    <div class="container my-0 mx-auto">
      <!-- Trending Products -->
      <h2>Trending Products</h2>
      <div class="marquee">
        <div class="product-container-marquee track d-flex justify-content-center mt-5">
          <?= $trendingProducts; ?>
        </div>
      </div>
      <!-- Collections -->
      <div class="row g-3">
        <div class="col-md-6">
          <a href="searchproduct.php?gender=women" class="collection">
            <img src="img/women-collection.png" alt="">
            <p class="collection-title">Women<br>Apparels</p>
          </a>
        </div>
        <div class="col-md-6">
          <a href="searchproduct.php?gender=men" class="collection">
            <img src="img/men-collection.png" alt="">
            <p class="collection-title">Men<br>Apparels</p>
          </a>
        </div>
      </div>
      <!-- Suggestions -->
      <h2>You may also like</h2>
      <?= $suggestionsMarquee; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="container-fluid footer-container d-flex flex-column align-items-center justify-content-center"></footer>


  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- FA Icons -->
  <script src="https://kit.fontawesome.com/6df1b567fb.js" crossorigin="anonymous"></script>
  <!-- custom js -->
  <script src="js/index.js"></script>
  <script src="js/nav.js"></script>
  <script src="js/cart.js"></script>
  <script src="js/footer.js"></script>
</body>
</html>
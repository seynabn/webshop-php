<?php
require_once("models/Database.php");
function NavComponent()
{
  $database = new Database();
  $categories = $database->getAllCategories();
 
  $q = $_GET["q"] ?? "";


  ?>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="/">SuperShoppen</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

     <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">


      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown text-center">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kategorier</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/allproducts">All Products</a></li>
              <?php foreach ($categories as $genres) {
                // länken går till våran category.php och id:et vill
                ?>
                <li><a class="dropdown-item" 
                                        href="Category?id=<?php echo $genres->id; ?>">
                                        <?php echo $genres->name;?>
                                        </a>
                                    </li>
                                <?php 
                                }
                                ?>

            </ul>

          </li>

          <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Create account</a></li>




        </ul>

        <!-- SEARCH -->
  <form method="GET" action="search" class="d-flex justify-content-center my-2">
    <input type="text" name="q" class="form-control" placeholder="Sök efter bok">
  </form>

      <form class="d-flex justify-content-center">

          <button class="btn btn-outline-dark" type="button">
            <i class="bi-cart-fill me-1"></i>
            Cart
            <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
          </button>
        </form>

      </div>
    </div>
  </nav>






  <?php

}
?>
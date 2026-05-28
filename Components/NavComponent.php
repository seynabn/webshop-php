<?php
require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");
function NavComponent()
{
  $database = new Database();
  $auth = $database->getUsersDatabase()->getAuth();
  $categories = $database->getAllCategories();

// cart
  $cart = new Cart($database, session_id());
  $q = $_GET["q"] ?? "";


  ?>



  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
      <a class="navbar-brand" href="/">Bok Shoppen</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">


        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown text-center">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Kategorier</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/allproducts">Alla Böcker</a></li>
              <?php foreach ($categories as $genres) {
                // länken går till våran category.php och id:et vill
                ?>
                <li><a class="dropdown-item" href="Category?id=<?php echo $genres->id; ?>">
                    <?php echo $genres->name; ?>
                  </a>
                </li>
              <?php
              }
              ?>

            </ul>

          </li>

          <?php if ($auth->isLoggedIn()): ?>

            <li class="nav-item">
              <span class="nav-link">
                Konto: <?php echo $auth->getEmail(); ?>
              </span>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/logout">Logga Ut</a>
            </li>

          <?php else: ?>

            <li class="nav-item">
              <a class="nav-link" href="/accountlogin">Logga In</a>
            </li>

          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="/accountregister">Skapa konto</a></li>




        </ul>

        <!-- SEARCH -->
        <form method="GET" action="search" class="d-flex justify-content-center my-2">
          <input type="text" name="q" class="form-control" placeholder="Sök efter bok...">
        </form>

        <form class="d-flex justify-content-center m-2">
              <a class="btn btn-outline-dark " href="/viewcart">
                Varukorg

             <!-- här idag -->
            <i class="bi-cart-fill me-1"><span class="badge bg-dark text-white ms-1 rounded-pill" id="cartItemCount">
               
            </span></i>
       
           
    
            </a>
        </form>

      </div>
    </div>
  </nav>






  <?php

}
?>
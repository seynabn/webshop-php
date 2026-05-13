<?php
ob_start();// startar en outpurt buffering,
session_start();// startar en ny session eller återuppta en existerande session.
// session_id()- hämtar den nuvarande sessionens-id. används för att spåra och hantera sessions på ett unikt sätt.
// alla besökare får ett unikt session id- och de fixar php-åt oss.

// index kommer att bli vår grund sida- vi kommer att skapa globala variabeler här
require_once("Utils/Router.php");// laddar router klassen



// MAPPA URL MOT KOD - ÄR VAD EN ROUTER GÖR.
$router = new Router();


$router->addRoute("/", function () {
  require_once(__DIR__ . "/Pages/index.php");
});


$router->addRoute("/productPage", function () {
  require_once(__DIR__ . "/Pages/productPage.php");
});


$router->addRoute("/admin", function () {
  require_once(__DIR__ . "/Pages/admin.php");
});

$router->addRoute("/admin/edit", function () {
  require_once(__DIR__ . "/Pages/edit.php");
});

$router->addRoute("/admin/new", function () {
  require_once(__DIR__ . "/Pages/new.php");
});

$router->addRoute("/Category", function () {
  require_once(__DIR__ . "/Pages/CategoryPage.php");
});

$router->addRoute("/search", function () {
  require_once(__DIR__ . "/Pages/search.php");
});

$router->addRoute("/allproducts", function () {
require_once(__DIR__ . "/Pages/allproducts.php");
});

$router->addRoute("/accountlogin", function () {
require_once(__DIR__ . "/Pages/AccountLogIn.php");
});

$router->addRoute('/logout', function () {
    require_once(__DIR__ . "/Pages/LogOut.php");
});

$router->addRoute('/accountregister', function () {
    require_once(__DIR__ . "/Pages/AccountRegister.php");
});

// cart
$router->addRoute("/addtocart", function () {
  require_once(__DIR__ . "/Pages/AddToCart.php");
});

// cart
$router->addRoute("/viewcart", function () {
  require_once(__DIR__ . "/Pages/viewCart.php");
});

$router->addRoute("/checkout", function () {
  require_once(__DIR__ . "/Pages/checkout.php");
});

$router->addRoute('/removeFromCart', function () { // Betyder ta bort EN 
        require_once( __DIR__ .'/Pages/removeFromCart.php');
    });

    
$router->dispatch();

?>
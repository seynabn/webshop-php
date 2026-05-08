<?php

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

$router->dispatch();

?>
<?php

require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");




$database = new Database();
$cart = new Cart($database, session_id());

echo json_encode([
    "cartItems" => $cart->getItems(),
    "cartTotalPrice" => $cart->getTotalPrice()
]);


?>
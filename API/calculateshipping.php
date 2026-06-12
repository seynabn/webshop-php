<?php



require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");

$database = new Database();
$cart = new cart($database, session_id());
$ruleId = $_GET["id"];



$freightRule = $database->getFreightRule($ruleId);
$freightCost = $cart->calculateShippingCost($freightRule);



echo json_encode([

  "cartItems" => $cart->getItems(),
  "cartTotalPrice" => $cart->getTotalPrice() + $freightCost,
  "cartTotalWeight" => $cart->getTotalWeight(),
  "freightCost" => $freightCost

]);
?>
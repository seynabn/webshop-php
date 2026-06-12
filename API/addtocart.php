





<?php

require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");

$productIdToAddToCart = $_GET['id'];

$database = new Database();
$cart = new Cart($database, session_id());

// in princip = insert or update cartitem set 
//  = quantity + 1 where sessionId = session_id and productId = $productIdToAddToCart
// inte bara i databasen utan även i cartItems arrayen i Cart klassen
$cart->addItem($productIdToAddToCart, 1);

$cart = new Cart($database, session_id());

$freightRuleId = $_GET['ruleId'] ?? null;
if ($freightRuleId && $freightRuleId!='null') {
    $freightRule = $database->getFreightRule($freightRuleId);
    $freightCost = $cart->calculateFreightCost($freightRule);

} else {
    $freightCost = 0;
}



echo json_encode([
  'success' => true,
  'message' => "Product $productIdToAddToCart added to cart",
  'cartItemCount' => $cart->getItemsCount(),
 "cartItems" => $cart->getItems(),
  "cartTotalPrice" => $cart->getTotalPrice() + $freightCost,
  "cartTotalWeight" => $cart->getTotalWeight(),
  "freightCost" => $freightCost
]);


?>
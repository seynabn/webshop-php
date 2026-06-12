<?php
require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");



$database=new Database();
$cart=new Cart($database,session_id());

$freightRuleId = $_GET['ruleId'] ?? null;
if ($freightRuleId) {
    $freightRule = $database->getFreightRule($freightRuleId);
    $freightCost = $cart->calculateFreightCost($freightRule);

} else {
    $freightCost = 0;
}


$database = new Database();
$cart = new Cart($database, session_id());




echo json_encode([
    "cartItems" => $cart->getItems(),
    "cartTotalPrice" => $cart->getTotalPrice() + $freightCost,
    "cartTotalWeight" => $cart->getTotalWeight(),
    "freightCost" => $freightCost



]);


?>
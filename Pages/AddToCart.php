<?php
require_once("models/Cart.php");
require_once("models/CartItem.php");
require_once("models/Database.php");

$database = new Database();

$productId = $_GET['id'] ?? "";
$fromPage = urldecode($_GET['fromPage'] ?? "/");

$cart = new Cart($database, session_id());

$cart->addItem($productId, 1);

header("Location: $fromPage");
exit;



?>

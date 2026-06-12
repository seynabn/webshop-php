

<!-- 
 När Stripe säger:

Att betalning lyckades omredigeras användaren hit.(checkoutsucess-sidan)

Varukorgen töms:
$cart->clearCart();

Sedan visas:
Tack för din beställning! -->



<?php

require_once("models/Database.php");
require_once("models/Cart.php");

require_once("components/NavComponent.php");
require_once("components/HeadComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/RegisterComponent.php");
require_once("components/FooterComponent.php");


// TÖMMA SHOPPING CART


$database = new Database();

$userId = null;

if ($database->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $database->getUsersDatabase()->getAuth()->getUserId();
}

$cart = new Cart($database, session_id(), $userId);

$cart->clearCart();


?>

<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>


  <?php NavComponent(); ?>


  <?php HeaderComponent(); ?>

  <div class="m-40" >
<h1> Tack för din beställning!!</h1>
</div>


 





  <!-- FOOTER -->
  <?php
  FooterComponent();
  ?>

</body>

</html>





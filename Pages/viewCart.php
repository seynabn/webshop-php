<?php
ob_start();
require_once("models/Book.php");
require_once("models/Database.php");


require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/FooterComponent.php");


$database = new Database();
$cart = new Cart($database, session_id());
$cartItems = $cart->getItems();
$antalICart= $cart->getItemsCount();

?>




<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

  <?php NavComponent(); ?>

  <?php HeaderComponent(); ?>

  <section class="py-5">

    <div class="container">

      <h1>Varukorg</h1>

      <table class="table">

        <thead>

          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
          </tr>

        </thead>

        <tbody id="cartItem">

         

        </tbody> 

      </table>

      <tr>
        <td colspan="3">
          Total:
        </td>
        <td id="cartTotalPrice"><?php echo $cart->getTotalPrice(); ?> SEK</td>
        <tfoot>

        <td><a href="/checkout" class="btn btn-success">Checkout</a></td>
      </tr>
      </tfoot>
     </table>

        <script>
            // när sidan laddas så rendera cart items i tabellen
            document.addEventListener("DOMContentLoaded", async function() {
                const data = await fetchCartItems();
                drawCart(data.cartItems, data.cartTotalPrice);
            });
        </script>





    </div>

  </section>

  <?php FooterComponent(); ?>

</body>

</html>
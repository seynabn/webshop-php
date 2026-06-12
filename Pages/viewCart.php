<?php
ob_start();
require_once("models/Book.php");
require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");

require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/FooterComponent.php");


$database = new Database();
$cart = new Cart($database, session_id());
$freightRules = $database->getAllFreightRules();


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

        <tbody id="cartItems"></tbody>

        <tfoot>


          <form method="post" action="/checkout">
            <label for="shippingZone">Fraktzon</label>

            <select name="shippingZone" id="freightRulesSelect" class="form-select">

              <option value="">Välj frakt alternativ</option>
              <?php
              $freightRules = $database->getAllFreightRules();
              foreach ($freightRules as $rule) {
                echo "<option value='$rule->id'>$rule->zone_name - $rule->base_fee kr + $rule->weight_modifier kr/kg</option>";
              }
              ?> ?>
            </select>

          </form>
                     <!-- du kan ta bort denna totalen då den blir den totala summan av fraktkostnad + produkttotalen -->
          <tr>
            <td colspan="3">
              TOTAL:
            </td>
            <td id="cartTotalPrice"><?php echo $cart->getTotalPrice(); ?> SEK</td>


          <tr>
            <td colspan="3">
              FRAKT:
            </td>

            <td id="freightCost">0 SEK</td>
          </tr>

          <tr>
            <td colspan="3">
              FRAKT + PRODUKT:
            </td>
            <td id="grandTotal">
              <?= $cart->getTotalPrice(); ?> SEK
            </td>
          </tr>


        </tfoot>






      </table>




      <td><a onclick="onPay()" class="btn btn-success mt-3">Betala</a></td>
      </tr>

    </div>

  </section>

  <?php FooterComponent(); ?>

  <script>
    // när sidan laddas så rendera cart items i tabellen
    document.addEventListener("DOMContentLoaded", async function () {
      const data = await fetchCartItems();
      drawCart(data.cartItems, data.cartTotalPrice, data.cartTotalWeight, data.freightCost);
    });


    const freightRulesSelect = document.getElementById('freightRulesSelect');
    freightRulesSelect.addEventListener('change', function () {
      const selectedFreightRuleId = this.value;

      if (selectedFreightRuleId) {
        fetch(`/calculateShipping?id=${selectedFreightRuleId}`)
          .then(response => response.json())
          .then(data => {
            drawCart(data.cartItems, data.cartTotalPrice, data.cartTotalWeight, data.freightCost);
          });
      }

    });

   function onPay(){
                const selectedRulesId =   freightRulesSelect.value; // den valda
                // vi ska sätta url till /checkout?ruleid=<deb valda ruleidt>
                const url = '/checkout?ruleid=' + selectedRulesId;
                window.location = url;
            }


  </script>

</body>

</html>
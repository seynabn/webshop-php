<?php
ob_start();

require_once("models/Database.php");
require_once("models/Cart.php");
require_once("models/CartItem.php");

require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/FooterComponent.php");

$database = new Database();

$userId = null;

$auth = $database->getUsersDatabase()->getAuth();

if ($auth->isLoggedIn()) {
    $userId = $auth->getUserId();
}

$cart = new Cart($database, session_id(), $userId);

$cartItems = $cart->getItems();

$totalPrice = $cart->getTotalPrice();
?>

<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

<?php NavComponent(); ?>
<?php HeaderComponent(); ?>

<div class="container mt-5">

    <h1 class="mb-4">Checkout</h1>

    <?php if (count($cartItems) === 0): ?>

        <div class="alert alert-warning">
            Din varukorg är tom.
        </div>

    <?php else: ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th>Pris</th>
                    <th>Antal</th>
                    <th>Totalt</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($cartItems as $item): ?>

                <tr>
                  
                    <td><?php echo $item->productName; ?></td>
                    <td><?php echo $item->productPrice; ?> SEK</td>
                    <td><?php echo $item->quantity; ?></td>
                    <td><?php echo $item->rowPrice; ?> SEK</td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>

        <h3 class="mb-4">
            Totalsumma: <?php echo $totalPrice; ?> SEK
        </h3>

        <form method="POST">

            <div class="mb-3">
                <input
                    type="text"
                    name="fullname"
                    class="form-control"
                    placeholder="Fullständigt namn"
                    required
                >
            </div>

            <div class="mb-3">
                <input
                    type="text"
                    name="address"
                    class="form-control"
                    placeholder="Adress"
                    required
                >
            </div>

            <div class="mb-3">
                <input
                    type="text"
                    name="city"
                    class="form-control"
                    placeholder="Stad"
                    required
                >
            </div>

            <div class="mb-3">
                <input
                    type="text"
                    name="postalcode"
                    class="form-control"
                    placeholder="Postnummer"
                    required
                >
            </div>

            <button class="btn btn-dark btn-lg">
                Slutför köp
            </button>

        </form>

    <?php endif; ?>

</div>

<?php FooterComponent(); ?>

</body>
</html>
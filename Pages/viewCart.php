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

  ?>




<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

<?php NavComponent(); ?>

<?php HeaderComponent(); ?>

<section class="py-5">

<div class="container">

<h1>Your Cart</h1>

<table class="table">

<thead>

<tr>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
</tr>

</thead>

<tbody>

<?php foreach($cartItems as $item): ?>

<tr>

<td>
<?php echo $item->productName; ?>
</td>

<td>
<?php echo $item->productPrice; ?> SEK
</td>

<td>
<?php echo $item->quantity; ?>
</td>

<td>
<?php echo $item->rowPrice; ?> SEK
</td>
     <td>
                       

        <a href="/addToCart?productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-primary">+</a>                                            
                                    <a href="/removeFromCart?productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-danger">-</a>                                            
                                    <a href="/removeFromCart?removeCount=<?php echo $item->quantity ?>&productId=<?php echo $item->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>" class="btn btn-danger">DELETE ALL</a>  
                                    
                                    </td>
</tr>

<?php endforeach; ?>

</tbody>

</table>

<h3>
Total:
<?php echo $cart->getTotalPrice(); ?> SEK
</h3>





</div>

</section>

<?php FooterComponent(); ?>

</body>
</html>
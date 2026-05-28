<?php
ob_start();
require_once("models/Book.php");
require_once("models/Database.php");
require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/ProductComponent.php");
require_once("components/FooterComponent.php");



$database = new Database();

//hämta id från url
$id = $_GET["id"] ?? null;

// säkerhet om inget id finns.
if (!$id) {
  die("kunde inte hämta denna produkt");
}

$book = $database->getBook($id);
?>


<!-- $id=$_GET["id"];
echo "du klickade på  en product: " . $id;



$database=new Database();




?> -->

<!-- SKRIVER UT ALLA PRODUCTER I DOMEN. -->
<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

<?php NavComponent(); ?>
<?php HeaderComponent(); ?>

<section class="py-5">
  <div class="container px-4 px-lg-5 my-5">

    <div class="row gx-4 gx-lg-5 align-items-center">

      <!-- IMAGE -->
      <div class="col-md-6">
        <img class="card-img-top mb-5 mb-md-0 rounded" src="<?php echo $book->image ?>" alt="">
      </div>

      <!-- INFO -->
      <div class="col-md-6">

        <!-- TITLE -->
        <h1 class="display-5 fw-bolder"><?php echo $book->title ?></h1>

        <!-- AUTHOR -->
        <p class="lead text-muted"><?php echo $book->author ?></p>

        <!-- PRICE -->
        <div class="fs-3 mb-3">
          <span><?php echo $book->price ?> kr</span>
        </div>

        <!-- DESCRIPTION -->
        <p class="lead"><?php echo $book->description ?></p>

        <!-- STOCK -->
        <p class="text-muted">I lager: <?php echo $book->stock ?></p>



        
        <!-- BUTTON -->
        <div class="d-flex">
             <a class="btn btn-dark flex-shrink-0" onclick="addToCart(<?php echo $book->id; ?>)">
                        Add to cart!
                    </a>
        </div>

        <!-- BACK -->
        <div class="mt-4">
          <a href="/" class="btn btn-outline-secondary">← Tillbaka</a>
        </div>

      </div>
    </div>

  </div>
</section>
 <div class="d-flex justify-content-center gap-3 mt-4">
<h2 class="fw-bolder mb-4">Liknande produkter</h2>
</div>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
  <?php foreach ($database->getPopularBooks() as $book): ?>
    <?php ProductComponent($book); ?>
  <?php endforeach; ?>
</div>

<?php FooterComponent(); ?>

</body>
</html>
<?php
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


<!DOCTYPE html>
<html lang="en">

<?php HeadComponent();?>

<body>

  <!--  NAVIGATION -->
<?php NavComponent();?>

<!--  HEADER -->
<?php headerComponent(); ?>

  <div>

    <!-- IMAGE -->
    <img src="<?php echo $book->image ?>" alt="">
    <!-- TITLE -->
    <h1><?php echo $book->title ?></h1>
    <!-- AUTHOR -->
    <p><?php echo $book->author ?></p>
    <!-- PRICE -->
    <h2><?php echo $book->price ?></h2>
    <!-- DESCRIPTION -->
    <p><?php echo $book->description ?></p>
    <!-- BUTTON -->
    <button>add to cart.</button>
    <br><br>

    <a href="/"> back to shop</a>

  </div>
  <?php FooterComponent();?>

</body>

</html>
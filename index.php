<!-- DENNA FIL HÄMTAR DATA FRÅN OBJEKTET -->


<?php
// Hämtar header och product componenterna.
require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/ProductComponent.php");
require_once("components/FooterComponent.php");



// Laddar in Book-klassen (model för en bok)
require_once("models/Book.php");

// Laddar in Database-klassen (hanterar kopplingen till MySQL)
require_once("models/Database.php");




// Skapar ett nytt Database-objekt (öppnar PDO-connection)
$database = new Database();

// När vi gör en sökningen så gör detta:
$q = $_GET["q"] ?? "";
// om en sökning görs: kör funktionen: searchBooks och jämnför sökningeb med q och det objekt vi har i databasen.
if ($q) {
    $books = $database->searchBooks($q);
    // om inget skrivs in i sökrutan visa/hämta alla böcker.
} else {
    $books = $database->getAllBooks();
}


?>



<!DOCTYPE html>
<html lang="en">

<?php  HeadComponent();?>

<body>

<!-- NAV -->
<?php NavComponent();?>

<!-- HEADER -->
<!-- HEADER -->
<?php HeaderComponent(); ?>

<section class="py-5">
<div class="container px-4 px-lg-5 mt-5">

<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

<!-- slut här -->

<!-- PRODUCTS CARDS-->
<?php foreach ($books as $book): ?>
    <?php ProductComponent($book); ?>
<?php endforeach; ?>

</div>
</div>
</section>

<!-- FOOTER -->
<?php
FooterComponent();
?>

</body>
</html>
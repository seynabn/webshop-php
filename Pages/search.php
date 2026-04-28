<?php
require_once ("models/Category.php");
require_once ("models/Database.php");
require_once ("models/Book.php");
require_once ("components/FooterComponent.php");
require_once ("components/HeadComponent.php");
require_once ("components/HeaderComponent.php");
require_once ("components/NavComponent.php");
require_once ("components/ProductComponent.php");



$searchWord = $_GET["q"] ?? "";

$database = new Database();
$books = $database->searchBooks($searchWord);


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
<h1> seach resultes for: <?php echo $searchWord?></h1>
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
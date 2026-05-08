<?php
ob_start();
require_once("models/Category.php");
require_once("models/Database.php");
require_once("models/Book.php");
require_once("components/FooterComponent.php");
require_once("components/HeadComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/NavComponent.php");
require_once("components/ProductComponent.php");
require_once("components/SortComponent.php");



$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;


$sort = $_GET["sort"] ?? "title";
$order = $_GET["order"] ?? "asc";
$selectedOption = $sort . '-' . $order;
$searchWord = $_GET["q"] ?? "";
$database = new Database();
$books = $database->searchBooks($searchWord, $sort, $order, $limit, $offset);


?>

<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

    <!-- NAV -->
    <?php NavComponent(); ?>

    <!-- HEADER -->
    <!-- HEADER -->
    <?php HeaderComponent(); ?>
    <h1> seach resultes for: <?php echo $searchWord ?></h1>
    <section class="py-5">
        <?php SortComponent($selectedOption); ?>
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <!-- slut här -->

                <!-- PRODUCTS CARDS-->
                <?php foreach ($books as $book): ?>
                    <?php ProductComponent($book); ?>
                <?php endforeach; ?>

            </div>
        </div>
        	<div>
	    <a href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&q=<?php echo urlencode($searchWord); ?>">föregånde</a>
	
	    <span>Sida <?php echo $page; ?></span>
	
	  <a href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>&q=<?php echo urlencode($searchWord); ?>">nästa</a>
</div>
    </section>

    <!-- FOOTER -->
    <?php
    FooterComponent();
    ?>

</body>

</html>
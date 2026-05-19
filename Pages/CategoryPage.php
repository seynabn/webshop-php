<?php
ob_start();
require_once("models/Category.php");
require_once("models/Database.php");
require_once("components/ProductComponent.php");
require_once("components/HeadComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/NavComponent.php");
require_once("components/FooterComponent.php");
require_once("components/SortComponent.php");

// för sorterings dropdown för category-page
$sort = $_GET["sort"] ?? "title";
$order = $_GET["order"] ?? "asc";
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$selectedOption = $sort . '-' . $order;
$database = new Database();
$categoryId = $_GET["id"] ?? null;
$theCategory = $database->getCategory($categoryId);
if (!$theCategory) {
    die("Kategorin finns inte");
}
$books = $database->getBooksForCategory($categoryId, $sort, $order, $limit, $offset);
// $allCategories = $database->getBooksForCategory();

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
     <div class="d-flex justify-content-center gap-3 mt-4">
    <h1><?php echo $theCategory->name ?></h1>
   </div>
    
    <?php SortComponent($selectedOption); ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <!-- slut här -->

                <!-- PRODUCTS CARDS-->
                <?php foreach ($books as $book): ?>
                    <?php ProductComponent($book); ?>
                <?php endforeach; ?>

            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">

            <?php if($page > 1): ?>
    <a class="btn btn-dark" 
    href="?id=<?php echo $categoryId; ?>&page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">
        ⬅️ Föregånde
    </a>
    <?php endif; ?>

<span class="align-self-center">
    Sida <?php echo $page; ?>
</span>

    <a class="btn btn-dark"
     href="?id=<?php echo $categoryId; ?>&page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">
        Nästa ➡️
    </a>
</div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php
    FooterComponent();
    ?>

</body>
</html>



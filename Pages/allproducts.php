

<?php
ob_start();
// Hämtar header och product componenterna.
require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/ProductComponent.php");
require_once("components/FooterComponent.php");
require_once("components/SortComponent.php");



// Laddar in Book-klassen (model för en bok)
require_once("models/Book.php");

// Laddar in Database-klassen (hanterar kopplingen till MySQL)
require_once("models/Database.php");

// Skapar ett nytt Database-objekt (öppnar PDO-connection)
$sort = $_GET["sort"] ?? "title";
$order = $_GET["order"] ?? "asc";

$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$selectedOption = $sort . '-' . $order;
$database = new Database();
$books = $database->getAllBooks(
  $sort,
  $order,
  $limit,
  $offset
);


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
    <h1>Alla böcker.</h1>
  </div>
  <?php SortComponent($selectedOption) ?>
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

        <?php if ($page > 1): ?>
          <a class="btn btn-dark"
            href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">
            ⬅️ Föregånde
          </a>
        <?php endif; ?>

        <span class="align-self-center">
          Sida <?php echo $page; ?>
        </span>

        <a class="btn btn-dark"
          href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">
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
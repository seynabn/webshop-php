<?php
require_once("models/Book.php");
require_once("models/Database.php");


require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/FooterComponent.php");


$database = new Database();
$sort = $_GET["sort"] ?? "title";
$order = $_GET["order"] ?? "asc";
$books = $database->getAllBooks($sort, $order);



?>

<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>
    <!-- Navigation-->
    <?php NavComponent(); ?>
    <!-- Header-->
    <?php HeaderComponent(); ?>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <table class="table">
                <thead>
                    <th>
                        <a href="admin.php?sort=title&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Title
                        <a href="admin.php?sort=title&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin.php?sort=price&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Price
                        <a href="admin.php?sort=price&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin.php?sort=stock&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Stock
                        <a href="admin.php?sort=stock&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin.php?sort=category&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Genre
                        <a href="admin.php?sort=category&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>
                </thead>

                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book->title; ?></td>
                            <td><?php echo $book->price; ?></td>
                             <td><?php echo $book->stock; ?></td>
                            <td><?php echo $book->genre; ?></td>
                          
                            <td>
                                <a href="edit.php?id=<?= $book->id ?>">Edit</a>
                                <a href="delete.php?id=<?= $book->id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </div>
    </section>
    <!-- Footer-->
    <?php FooterComponent(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>
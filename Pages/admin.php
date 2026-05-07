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
$page = $_GET['page'] ?? 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$books = $database->getAllBooks($sort, $order, $limit, $offset);




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
                        <a href="admin?sort=title&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Title
                        <a href="admin?sort=title&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin?sort=title&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Description
                        <a href="admin?sort=title&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin?sort=price&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Price
                        <a href="admin?sort=price&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin?sort=stock&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Stock
                        <a href="admin?sort=stock&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>

                    <th>
                        <a href="admin?sort=category&order=asc">
                            <i class="bi bi-sort-up"></i>
                        </a>
                        Genre
                        <a href="admin?sort=category&order=desc">
                            <i class="bi bi-sort-down"></i>
                        </a>
                    </th>
                </thead>

                <tbody>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?php echo $book->title; ?></td>
                            <td><?php echo $book->description; ?></td>
                            <td><?php echo $book->price; ?></td>
                            <td><?php echo $book->genre; ?></td>
                            <td><?php echo $book->stock; ?></td>


                            <td>
                                <a href="/admin/edit?id=<?php echo $book->id ?>" class="btn btn-primary mb-1">EDIT</a>
                                <a href="/admin/new?id=<?php echo $book->id ?>" class="btn btn-primary mt-1">CREATE</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
        	<div>
	    <a href="?page=<?php echo $page - 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">⬅️ Prev</a>
	
	    <span>Sida <?php echo $page; ?></span>
	
	    <a href="?page=<?php echo $page + 1; ?>&sort=<?php echo $sort; ?>&order=<?php echo $order; ?>">Next ➡️</a>
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
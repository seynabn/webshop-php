<?php
require_once("models/Book.php");
require_once("models/Database.php");
require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/ProductComponent.php");
require_once("components/FooterComponent.php");
require_once("models/Category.php");
require_once("utils/validator.php");// STEG ETT




// //hämta id från url
//  $id = $_GET["id"]; - behövs inte för att de kmr skapas ett nytt id anyways.
$database = new Database();
$book = new Book();
$allCategories = $database->getAllCategories();
$v = new Validator($_POST);// STEG 1: SKAPA EN VALIDATOR.



// SKILJA PÅ VISA OCH SPARA:

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// HAR MAN SUBMITTAT FORM??
  //spara
  //ta data från form och dspara i databasen
  $book->title = $_POST['title'];
  $book->genre_id = $_POST['genre_id'];
  $book->description = $_POST['description'];
  $book->price = $_POST['price'];
  $book->stock = $_POST['stock'];
  $book->author = $_POST['author'];



  // STEG 3; VALIDERINGS REGLER.
  $v->field('title')->required()->alpha_num([' '])->min_len(3)->max_len(50);
  $v->field('author')->required()->alpha_num([' '])->min_len(3)->max_len(50);

  $v->field('stock')->required()->numeric()->min_val(0);
  $v->field('price')->required()->numeric()->min_val(0);



  //4. VALIDERING
  if ($v->is_valid()) {
    $database->createProduct($book);
    header("Location: /admin"); // Hoppa till denna sida = redirect
    exit; // KLAR KÖR INTE MER I DENNA FIL
  }



echo 'du har skapat en ny product';


}



?>


<!-- $id=$_GET["id"];
echo "du klickade på en product: " . $id;

?> -->

<!-- SKRIVER UT ALLA PRODUCTER I DOMEN. -->
<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

  <!--  NAVIGATION -->
  <?php NavComponent(); ?>

  <!--  HEADER -->
  <?php headerComponent(); ?>

  <div>

    <section class="py-5">
  <div class="container px-4 px-lg-5">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="card shadow border-0 rounded-4 p-4">

          <h1 class="fw-bold mb-4 text-center">Create New Product</h1>

          <form method="POST">

            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control"
               value="<?php echo $_POST['title'] ?? '' ?>"
              <span class="text-danger"> <?php echo $v->get_error_message('title'); ?></span>
            </div>

            <div class="mb-3">
              <label class="form-label">Category</label>
              <select name="genre_id" class="form-select">
                <?php foreach ($allCategories as $category): ?>
                  <option value="<?php echo $category->id; ?>">
                    <?php echo $category->name; ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="4"><?php echo $book->description; ?></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label">Author</label>
              <input type="text" name="author" class="form-control"
                value="<?php echo $book->author ?>">
              <span class="text-danger"><?php echo $v->get_error_message('author'); ?></span>
            </div>

            <div class="mb-3">
              <label class="form-label">Price</label>
              <input type="number" name="price" class="form-control"
                value="<?php echo $book->price ?>">
              <span class="text-danger"><?php echo $v->get_error_message('price'); ?></span>
            </div>

            <div class="mb-4">
              <label class="form-label">Stock</label>
              <input type="number" name="stock" class="form-control"
                value="<?php echo $book->stock ?>">
              <span class="text-danger"><?php echo $v->get_error_message('stock'); ?></span>
            </div>

            <div class="d-grid gap-2">
              <button class="btn btn-dark btn-lg">Create Product</button>
              <a href="/admin" class="btn btn-outline-secondary">Cancel</a>
            </div>

          </form>

        </div>

      </div>
    </div>

  </div>
</section>
  <?php FooterComponent(); ?>

</body>

</html>
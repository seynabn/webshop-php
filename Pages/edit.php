<?php
require_once("models/Book.php");
require_once("models/Database.php");
require_once("models/Category.php");
require_once("components/HeadComponent.php");
require_once("components/NavComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/ProductComponent.php");
require_once("components/FooterComponent.php");
require_once("utils/validator.php");// STEG 1 importera validator filen.




//hämta id från url
$id = $_GET['id'];
$database = new Database();
$book = $database->getBook($id);
$v = new Validator($_POST);// STEG 2: SKAPA EN VALIDATOR.




// SKILJA PÅ VISA OCH SPARA:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {// HAR MAN SUBMITTAT FORM??
  //spara
  //ta data från form och dspara i databasen
  $book->title = $_POST['title'];
  $book->description = $_POST['description'];
  $book->genre_id = $_POST['genre'];
  $book->price = $_POST['price'];
  $book->stock = $_POST['stock'];
  $book->author = $_POST['author'];
  $database->saveProduct($book);
  header('Location:/admin');// hoppa till denna sida- redirect.
  exit;// klar kör inget mer, när detta har körts,

  // STEG 3; VALIDERINGS REGLER.
  $v->field('title')->required()->alpha_num([' '])->min_len(3)->max_len(50);
  $v->field('stock')->required()->numeric()->min_val(0);
  $v->field('price')->required()->numeric()->min_val(0);


  //4. VALIDERING
  if ($v->is_valid()) {
    $database->saveProduct($product);
    header("Location: /admin"); // Hoppa till denna sida = redirect
    exit; // KLAR KÖR INTE MER I DENNA FIL
  }






}

echo "Du klickade på Product id: " . $id;

?>


<!-- $id=$_GET["id"];
echo "du klickade på en product: " . $id;

?> -->

<!-- SKRIVER UT ALLA PRODUCTER I DOMEN. -->
<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

<?php NavComponent(); ?>
<?php HeaderComponent(); ?>

<section class="py-5">
  <div class="container px-4 px-lg-5">

    <div class="row justify-content-center">
      <div class="col-lg-8">

        <div class="card shadow border-0 rounded-4 p-4">

          <h1 class="fw-bold mb-4 text-center">Edit Product</h1>

          <div class="text-center mb-4">
            <img src="<?php echo $book->image ?>" class="img-fluid rounded" style="max-height:300px;">
          </div>

          <form method="POST">

            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title"
                value="<?php echo $book->title ?>">
              <span class="text-danger"><?php echo $v->get_error_message('title'); ?></span>
            </div>

            <div class="mb-3">
              <label for="genre" class="form-label">Genre</label>
              <select name="genre" id="genre" class="form-select">
                <?php
                $allCategories = $database->getAllCategories();
                foreach ($allCategories as $category) {
                ?>
                  <option value="<?php echo $category->id; ?>"
                    <?php echo $book->genre_id == $category->id ? 'selected' : ''; ?>>
                    <?php echo $category->name; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="4"><?php echo $book->description; ?></textarea>
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" class="form-control" id="price" name="price"
                value="<?php echo $book->price ?>">
              <span class="text-danger"><?php echo $v->get_error_message('price'); ?></span>
            </div>

            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" class="form-control" id="stock" name="stock"
                value="<?php echo $book->stock ?>">
              <span class="text-danger"><?php echo $v->get_error_message('stock'); ?></span>
            </div>

            <div class="mb-4">
              <label for="author" class="form-label">Author</label>
              <input type="text" class="form-control" id="author" name="author"
                value="<?php echo $book->author ?>">
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-dark btn-lg">
                Save Changes
              </button>

              <a href="/admin" class="btn btn-outline-secondary">
                Cancel
              </a>
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
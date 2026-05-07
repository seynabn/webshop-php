<?php
function ProductComponent($book)
{
?>
    <div class="col mb-5">
        <div class="card h-100">

            <img class="card-img-top" src="<?php echo $book->image; ?>" alt="<?php echo $book->title; ?>" />

            <div class="card-body p-4">
                <div class="text-center">

                    <h5 class="fw-bolder"><?php echo $book->title; ?></h5>
                    <div>SEK <?php echo $book->price; ?></div>

                </div>
            </div>

            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <a class="btn btn-outline-dark mt-auto" href="productPage?id=<?php echo $book->id; ?>">
                        View options
                    </a>
                </div>
            </div>

        </div>
    </div>
<?php
}
?>
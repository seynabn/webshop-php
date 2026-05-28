<?php
function ProductComponent($book)
{
    ?>
    <div class="col mb-5">
        <div class="card h-100">
            <a class="text-decoration-none text-black" href="productPage?id=<?php echo $book->id; ?>">



                <img class="card-img-top" src="<?php echo $book->image; ?>" alt="<?php echo $book->title; ?>" />

                <div class="card-body p-4">
                    <div class="text-center">

                        <h5 class="fw-bolder"><?php echo $book->title; ?></h5>
                        <div><?php echo $book->price; ?>kr</div>

                    </div>
                </div>

                <div class="card-footer p-2 pt-0 border-top-0 bg-transparent">
                    <div class="d-flex justify-content-center gap-1">




                        <a class="btn btn-outline-dark" onclick="addToCart(<?php echo $book->id; ?>)">
                            Lägg i varukorg!
                        </a>




                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
}
?>
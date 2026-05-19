<?php

function LogInComponent($message = "")
{
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h2>
                            <i class="fa fa-user-circle"></i>
                            Logga in
                        </h2>

                        <p class="text-muted">
                            Välkommen tillbaka!
                        </p>

                    </div>

                    <?php if ($message): ?>

                        <div class="alert alert-danger">
                            <?php echo $message; ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <input
                                name="email"
                                class="form-control form-control-lg"
                                type="email"
                                placeholder="Fyll i din Email"
                            >

                        </div>

                        <div class="mb-4">

                            <input
                                name="password"
                                class="form-control form-control-lg"
                                type="password"
                                placeholder="Fyll i lösenord"
                            >

                        </div>

                        <button class="btn btn-light btn-dark w-100">

                            <i class="fa fa-sign-in"></i>
                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php
}
?>
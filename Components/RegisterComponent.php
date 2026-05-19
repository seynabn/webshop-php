
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
                            Login
                        </h2>

                        <p class="text-muted">
                            Welcome back
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
                                placeholder="Enter Your Email"
                            >

                        </div>

                        <div class="mb-4">

                            <input
                                name="password"
                                class="form-control form-control-lg"
                                type="password"
                                placeholder="Enter Your Password"
                            >

                        </div>

                        <button class="btn btn-danger btn-lg w-100">

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



<?php

function RegisterComponent(
    $email,
    $password,
    $passwordRepeat,
    $name,
    $streetaddress,
    $postalCode,
    $city,
    $v,
    $message = ""
)
{
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h2>
                            <i class="fa fa-user-plus"></i>
                            Registrering
                        </h2>

                        <p class="text-muted">
                            Skapa ett nytt konto!
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
                                value="<?php echo $email; ?>"
                                name="email"
                                class="form-control form-control-lg"
                                type="email"
                                placeholder="Skriv in email..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('email'); ?>
                            </small>

                        </div>

                        <div class="mb-3">

                            <input
                                name="password"
                                class="form-control form-control-lg"
                                type="password"
                                placeholder="Skapa ett lösenord..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('password'); ?>
                            </small>

                        </div>

                        <div class="mb-3">

                            <input
                                name="passwordRepeat"
                                class="form-control form-control-lg"
                                type="password"
                                placeholder="Repetera lösenord..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('passwordRepeat'); ?>
                            </small>

                        </div>

                        <div class="mb-3">

                            <input
                                value="<?php echo $name; ?>"
                                name="name"
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Fyll i namn..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('name'); ?>
                            </small>

                        </div>

                        <div class="mb-3">

                            <input
                                value="<?php echo $streetaddress; ?>"
                                name="street"
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Fyll i adress..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('street'); ?>
                            </small>

                        </div>

                        <div class="mb-3">

                            <input
                                value="<?php echo $postalCode; ?>"
                                name="postal"
                                class="form-control form-control-lg"
                                type="text"
                                placeholder=" Postkod..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('postal'); ?>
                            </small>

                        </div>

                        <div class="mb-4">

                            <input
                                value="<?php echo $city; ?>"
                                name="city"
                                class="form-control form-control-lg"
                                type="text"
                                placeholder="Stad..."
                            >

                            <small class="text-danger">
                                <?php echo $v->get_error_message('city'); ?>
                            </small>

                        </div>

                        <button class="btn btn-light btn-dark w-100">

                            <i class="fa fa-user-plus"></i>
                            Skapa konto

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


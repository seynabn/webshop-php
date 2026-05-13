<?php

session_start();

ob_start();

require_once("vendor/autoload.php");
require_once("models/Database.php");

require_once("components/NavComponent.php");
require_once("components/HeadComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/LogInComponent.php");
require_once("components/FooterComponent.php");

$message = "";

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {

        $database
            ->getUsersDatabase()
            ->getAuth()
            ->login($email, $password);

        header("Location: /");
        exit;

    } catch (\Delight\Auth\InvalidEmailException $e) {

        $message = "Fel användarnamn eller lösenord";

    } catch (\Delight\Auth\InvalidPasswordException $e) {

        $message = "Fel användarnamn eller lösenord";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php HeadComponent(); ?>

<body>

    <?php NavComponent(); ?>
    <?php HeaderComponent(); ?>



    <?php LogInComponent($message); ?>

    <?php FooterComponent(); ?>

</body>

</html>
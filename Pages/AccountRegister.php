<?php
session_start();


ob_start(); // för cookies och sessions.

require_once("vendor/autoload.php");
require_once("models/Database.php");
require_once("models/UserDatabase.php");
require_once("utils/validator.php");

require_once("components/NavComponent.php");
require_once("components/HeadComponent.php");
require_once("components/HeaderComponent.php");
require_once("components/RegisterComponent.php");
require_once("components/FooterComponent.php");

// $newId == 3
// Lagra 
$database = new Database();
# trick to execute 1st time, but not 2nd so you don't have an inf loop

$v = new Validator($_POST);

$database = new Database();
$email = "";
$password = "";
$passwordRepeat = "";
$name = "";
$streetaddress = "";
$postalCode = "";
$city = "";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dom har tryckt på knappen, validera och registrera
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $name = $_POST['name'];
    $streetaddress = $_POST['street'];
    $postalCode = $_POST['postal'];
    $city = $_POST['city'];

    // todo add 
    $v->field('email')->required()->email();
    $v->field('password')->required()->min_len(8)->max_len(20);
    $v->field('passwordRepeat')->equals($password);

    $v->field('name')->required()->min_len(3)->max_len(50);
    $v->field('street')->required()->min_len(3)->max_len(50);
    $v->field('postal')->required()->max_len(10);
    $v->field('city')->required()->max_len(50);

    //
    if ($v->is_valid()) {
        try {
            $userid = $database->getUsersDatabase()->getAuth()->register($email, $password, $email);
            // insert into user details table with $userid and other details
            $database->getUsersDatabase()->addUserDetails($userid, $name, $streetaddress, $postalCode, $city);
            header("Location: /accountlogin");
            exit;
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $message = "User already exists";
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $message = "Invalid email";
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $message = "Too many requests, please try again later";
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<?php HeadComponent()?>
<body>
   <?php NavComponent(); ?>
  <?php HeaderComponent()?>

  

    <?php RegisterComponent($email,
    $password,
    $passwordRepeat,
    $name,
    $streetaddress,
    $postalCode,
    $city,
    $v); ?>

    <?php FooterComponent(); ?>
  
</body>
</html>
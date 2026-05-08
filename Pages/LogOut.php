<?php

session_start();

require_once("models/Database.php");

$database = new Database();

$database
    ->getUsersDatabase()
    ->getAuth()
    ->logOut();

header("Location: /");
exit;
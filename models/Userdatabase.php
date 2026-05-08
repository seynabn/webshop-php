<?php
require_once('vendor/autoload.php');
require_once("models/Database.php");
 
class UserDatabase {
    private $pdo;
    private $auth;
 
    function getAuth(){
      return $this->auth;
    }
    function __construct($pdo) {
        $this->pdo = $pdo;
        $this->auth = new \Delight\Auth\Auth($pdo);
    }
 
    function setupUsers(){
    }
    
    
    
    function seedUsers(){
        if($this->pdo->query("select * from users where email='seynab.nur@hotmail.com'")->rowCount() == 0){
            $userId = $this->auth->admin()->createUser("seynab.nur@hotmail.com", "Hejsan123", "seynab.nur@hotmail.com");    
        }
    }
    
}
 
?>
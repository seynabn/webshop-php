<?php
require_once("vendor/autoload.php");
require_once("models/Category.php");
require_once("models/Book.php");



class Database
{
  public $pdo; // HÅLLER DATABASKOPPLINGEN

  function __construct()
  {
    //LADDA .ENV-FILEN
    //__DIR__ ÄR EN GLOBAL NÅNTING SOM ANVÄNDS SOM EN SÖKVÄG/PATH FÖR ATT HITTA FILEN DÄR .ENV FINNS.
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();

    // DATABAS-INSTÄLLNINGAR
    $host = $_ENV['DATABASE_HOST'];
    $db = $_ENV['DATABASE_NAME'];
    $user = $_ENV['DATABASE_USER'];
    $pass = $_ENV['DATABASE_PASS'];
    $port = $_ENV['DATABASE_PORT'];

    // DSN= CONNECTION STRING FÖR MYSQL
    $dsn = "mysql:host=$host;port=$port;dbname=$db";

    // SKAPAR PDO-CONNECTION (KOPPLAR TILL DATABASEN)
    $this->pdo = new PDO($dsn, $user, $pass);
  }

  function getAllBooks($sort="title",$order= "asc")
  {
    // tillåtna kolumner och ordning
    $allowedSort=["title","price","stock","genre"];
    $allowedOrder=["asc","desc"];

    //skydd mot sql injektion
  

    if(!in_array($sort, $allowedSort)){
      $sort= "title";
    }
    if(!in_array($order, $allowedOrder)){
      $order= "asc";
    }


    // SQL-FRÅGA SOM HÄMTAR ALLA BÖCKER
    $query = $this->pdo->query("
            SELECT books.*,
                
                 -- Skapar en fake bild baserat på bok titeln
                CONCAT(
                    'https://dummyimage.com/450x300/000/fff&text=',
                    REPLACE(title, ' ', '+')
                ) AS image
                , genres.name as genre
            FROM books join genres on books.genre_id = genres.id
            ORDER BY $sort $order
           
        ");




    // GÖR VARJE RAD TILL ETT BOK-OBJECT
    return $query->fetchAll(PDO::FETCH_CLASS, "Book");
    // istället för en array får man:
    //$book->title
    //$book->price

  }

  // HÄMTA EN BOK
  function getBook($id)
  {

    $query = $this->pdo->prepare("SELECT * FROM books WHERE id = :id");
    $query->execute(['id' => $id]);
    $query->setFetchMode(PDO::FETCH_CLASS, 'Book');
    //TA SQL FRÅGA OCH KÖR I SQL
    // OMVANDLA SVARET TILL ETT(1) BOOK-OBJEKT.
    return $query->fetch();
  }

  function searchBooks($q)
  {
    $query = $this->pdo->prepare("
    SELECT 
    id,
    title,
    author,
    price,
    description,
    stock,
    CONCAT(
                'https://dummyimage.com/450x300/000/fff&text=',
                REPLACE(title, ' ', '+')
            ) AS image
        FROM books
        WHERE title LIKE :q OR author LIKE :q
    ");

    $query->execute([
      'q' => "%$q%"
    ]);

    return $query->fetchAll(PDO::FETCH_CLASS, "Book");
  }

  // SORTERAR MEST POPULÄRA PRODUKTER.
 function getPopularBooks(){
  $query = $this->pdo->query("SELECT id, genre_id, description, title,stock FROM books order by product_popularity Desc limit 0,10 ");
  $books=$query->fetchAll(PDO::FETCH_CLASS,"book");// klassnamnet.
  return $books;
 }

 //rätt
 function getAllCategories()
    {
        $query = $this->pdo->query("SELECT id, name FROM genres");
        $genre = $query->fetchAll(PDO::FETCH_CLASS, "Category");
        return $genre;
    }

    //rätt
    function getCategory($id){
      $query = $this->pdo->prepare("SELECT * FROM genres WHERE id = :id");
      $query->execute(["id"=> $id]);
      $query->setFetchMode(PDO::FETCH_CLASS, "Category");
      return $query->fetch();
    }

 function getBooksForCategory($categoryId){
     $query = $this->pdo->prepare("SELECT id ,genre_id,description, title,price,stock,
     CONCAT(
                    'https://dummyimage.com/450x300/000/fff&text=',
                    REPLACE(title, ' ', '+')
                ) AS image FROM books WHERE genre_id=:categoryId");
        $query->execute(['categoryId' => $categoryId]);
        $genre = $query->fetchAll(PDO::FETCH_CLASS, "Book"); // KLASSNAMNET!!!
        return $genre;
    }


  }

?>
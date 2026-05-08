<?php
require_once("vendor/autoload.php");
require_once("models/Category.php");
require_once("models/Book.php");
require_once("models/UserDatabase.php");



class Database
{
  public $pdo; // HÅLLER DATABASKOPPLINGEN - PHP DATA OBJECTS 
  // MAN ANVÄNDER METODER SOM: QUERY() OCH PREPARE() FÖR ATT INTERAGERA MED DATABASEN.

  // INLOGGNING FUNKTIONEN.
   private $usersDatabase;
  function getUsersDatabase()
  {
    return $this->usersDatabase;
  }
  //........
  function __construct()
  {
    //LADDA .ENV-FILEN
    //__DIR__:  DIRECTION- ÄR EN GLOBAL NÅNTING SOM ANVÄNDS SOM EN SÖKVÄG/PATH FÖR ATT HITTA FILEN DÄR .ENV FINNS.
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
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

    // INLOGGNING 
     $this->usersDatabase = new UserDatabase($this->pdo);
    $this->usersDatabase->setupUsers();
    $this->usersDatabase->seedUsers();
  }

  function getAllBooks($sort = "title", $order = "asc", $limit = 10, $offset = 0)
  {
    // tillåtna kolumner och ordning
    $allowedSort = ["title", "price", "stock", "genre"];
    $allowedOrder = ["asc", "desc"];

    //skydd mot sql-injektion

    if (!in_array($sort, $allowedSort)) {
      $sort = "title";
    }
    if (!in_array($order, $allowedOrder)) {
      $order = "asc";
    }


    // SQL-FRÅGA SOM HÄMTAR ALLA BÖCKER
    $query = $this->pdo->prepare("
            SELECT books.*,
                
                 -- Skapar en fake bild baserat på bok titeln
                CONCAT(
                    'https://dummyimage.com/450x300/000/fff&text=',
                    REPLACE(title, ' ', '+')
                ) AS image
                , genres.name as genre
            FROM books join genres on books.genre_id = genres.id
            ORDER BY $sort $order LIMIT :limit OFFSET :offset
           
        ");
    $query->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
    $query->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $query->execute();


    // SKILLANDEN MELLAN QUERY OCH PREPARE:
    // QUERY: kör en sql-direkt, bra när man inte har input från användaren.- dåligt: risk för SQL-injection.
    // PREPARE: förbereder SQL, är säkrare och tar input.
    // datat skickas separat och PHP-skyddar dig automatiskt från injection, för att de behandlar saker som text, medan query retunerar alla böcker.
    // man bör använda prepare() och INTE query.





    // GÖR VARJE RAD TILL ETT BOK-OBJECT
    return $query->fetchAll(PDO::FETCH_CLASS, "Book");
    // istället för en array får man:
    //$book->title
    //$book->price

  }

  // HÄMTA EN BOK UTIFRÅN ID.
  function getBook($id)
  {
    $query = $this->pdo->prepare("
        SELECT books.*,
        CONCAT(
            'https://dummyimage.com/450x300/000/fff&text=',
            REPLACE(books.title, ' ', '+')
        ) AS image,
        genres.name as genre
        FROM books
        JOIN genres ON books.genre_id = genres.id
        WHERE books.id = :id
    ");

    $query->execute(['id' => $id]);
    $query->setFetchMode(PDO::FETCH_CLASS, 'Book');

    return $query->fetch();
  }
  // SÖK BÖCKER
  function searchBooks($q, $sort, $order, $limit = 10, $offset = 0)
  {
    // sql injection - vid sort/order by
    $allowedSort = ['title', 'author', 'price'];
    $allowedOrder = ['asc', 'desc'];

    $sort = in_array($sort, $allowedSort) ? $sort : 'title';
    $order = in_array($order, $allowedOrder) ? $order : 'asc';

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
ORDER BY $sort $order 
LIMIT :limit OFFSET :offset
");

// bind alla parametrar
$query->bindValue(':q', "%$q%", PDO::PARAM_STR);
$query->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
$query->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

$query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS, "Book");
  }




  // SORTERAR MEST POPULÄRA PRODUKTER.
  function getPopularBooks()
  {
    $query = $this->pdo->query("SELECT id, genre_id, description, title,stock,
    CONCAT(
                'https://dummyimage.com/450x300/000/fff&text=',
                REPLACE(title, ' ', '+')
            ) AS image
       FROM books order by product_popularity Desc limit 0,10
     ");
    $books = $query->fetchAll(PDO::FETCH_CLASS, "book");// klassnamnet.
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
  function getCategory($id)
  {
    $query = $this->pdo->prepare("SELECT * FROM genres WHERE id = :id");
    $query->execute(["id" => $id]);
    $query->setFetchMode(PDO::FETCH_CLASS, "Category");
    return $query->fetch();
  }

  function getBooksForCategory($categoryId, $sort, $order,  $limit = 10, $offset = 0)
  {
    // sql injection - vid sort/order by
    $allowedSort = ['title', 'price'];
    $allowedOrder = ['asc', 'desc'];

    $sort = in_array($sort, $allowedSort) ? $sort : 'title';
    $order = in_array($order, $allowedOrder) ? $order : 'asc';

    $query = $this->pdo->prepare("SELECT id ,genre_id,description, title,price,stock,
     CONCAT(
                    'https://dummyimage.com/450x300/000/fff&text=',
                    REPLACE(title, ' ', '+')
                ) AS image FROM books WHERE genre_id=:categoryId ORDER BY $sort $order LIMIT :limit OFFSET :offset
           ");

          // bind ALLA parametrar
    $query->bindValue(':categoryId', (int)$categoryId, PDO::PARAM_INT);
    $query->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $query->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $query->execute();

    return $query->fetchAll(PDO::FETCH_CLASS, "Book");

  }

  // CRUD
  function saveProduct($book)
  {
    //update
    $query = $this->pdo->prepare("update books set title=:title, description=:description, price=:price, stock=:stock, author=:author, genre_id=:genre_id where id=:id");
    $query->execute([
      "title" => $book->title,
      "genre_id" => $book->genre_id,
      "description" => $book->description,
      "price" => $book->price,
      "stock" => $book->stock,
      "author" => $book->author,
      "id" => $book->id
    ]);

  }

  function createProduct($book)
  {
    //update
    $query = $this->pdo->prepare("insert into books (title, description, price, stock, author, genre_id) values(:title,:description,:price,:stock,:author,:genre_id)");
    $query->execute([
      "title" => $book->title,
      "genre_id" => $book->genre_id,
      "description" => $book->description,
      "price" => $book->price,
      "stock" => $book->stock,
      "author" => $book->author,
    ]);

  }

 

}

?>


<?php

class Book
{
    public $product_popularity;
    public $id;        // unikt ID från databasen
    public $title;     // boktitel
    public $author;    // författare
    public $price;     // pris
    public $genre_id;

    public $genre;
    public $stock; // när boken skapades
    public $description; // beskrivning
    public $image;      // bild (skapas i SQL)

    public $weight; //bokens vikt

}
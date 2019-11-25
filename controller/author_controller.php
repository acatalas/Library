<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/db_files/db.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/classes/location.php");
class AuthorController
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    function getAuthorIdByName(string $name, string $surname)
    {
        $sql_author = "SELECT author_id
            FROM author 
            WHERE author.name = '$name' 
                AND author.surname = '$surname'";

        //make query & get results
        $result = $this->conn->query($sql_author);

        //fetch resulting rows as an array
        $author = $result->fetch_array(MYSQLI_ASSOC);

        //Free result
        $result->free();

        return $author['author_id'];
    }

    function insertAuthor($author)
    {
        $sql_author = "INSERT INTO author(name, surname) 
            VALUES ('{$author->getName()}', '{$author->getSurname()}')";
        
        $this->conn->query($sql_author);

        return $this->conn->insert_id;
    }
    
    function insertBookAuthor(int $book_id, int $author_id){
        $sql_book_author = "INSERT INTO book_author(book_id, author_id) VALUES ($book_id, $author_id)";
        echo $sql_book_author;
        $this->conn->query($sql_book_author);
    }

    function updateBookAuthor(int $book_id, int $author_id){
        $sql_book_author = "UPDATE book_author SET author_id = $author_id WHERE book_id = $book_id";
        $this->conn->query($sql_book_author);
    }

    function getAuthorOfBook(int $book_id){
        $sql_author = "SELECT author.author_id, name, surname 
                        FROM author JOIN book_author 
                            ON author.author_id = book_author.author_id 
                        WHERE book_id = $book_id";
        
        $result = $this->conn->query($sql_author);
        
        $author = $result->fetch_array(MYSQLI_ASSOC);

        $result->free();
        
        $authorObj = new Author($author['name'], $author['surname']);
        $authorObj->setId($author['author_id']);

        return $authorObj;
    }
}

<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/db_files/db.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/classes/book.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/classes/location.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/classes/author.php");
class BookController
{

    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getBookById($id)
    {
        $sql_book = "SELECT book.isbn, book.title, author.name, author.surname, 
                        book.editorial, book.published_on, book.language, location.location_id, location.floor, location.room, location.module, location.shelf
                            FROM book 
                                JOIN book_author ON book.book_id = book_author.book_id 
                                JOIN author ON book_author.author_id = author.author_id
                                JOIN location ON book.location_id = location.location_id
                            WHERE book.book_id = $id";

        //make query & get results
        if ($result = $this->conn->query($sql_book)) {
            /* obtener un array asociativo */
            while ($row = $result->fetch_assoc()) {
                $book = new Book($id, $row['isbn'], $row['title'], new Author($row['name'], $row['surname']), $row['editorial'], $row['language'], $row['published_on']);
                //$book->setBookStatus($row['book_status']);
                //if($row['image'] != null){
                //    $book->setImage($row['image']);
                //}
                $location = new Location($row['location_id'], $row['floor'], $row['room'], $row['shelf'], $row['module']);
                $book->setLocation($location);
            }
        }
        $result->free();
        return $book;
    }

    public function getAllBooks()
    {
        $sql_books = "SELECT book.book_id, book.isbn, book.title, author.name, author.surname, book.editorial, book.language, book.published_on, book.book_status, book.image,
            reservation.real_final_date
                FROM book JOIN book_author ON book.book_id = book_author.book_id 
                JOIN author ON book_author.author_id = author.author_id 
                LEFT JOIN reservation ON reservation.book_id = book.book_id";
        $books = [];
        //make query & get results
        if ($result = $this->conn->query($sql_books)) {
            /* obtener un array asociativo */
            while ($row = $result->fetch_assoc()) {
                $book = new Book($row['book_id'], $row['isbn'], $row['title'], new Author($row['name'], $row['surname']), $row['editorial'], $row['language'], $row['published_on']);
                $book->setBookStatus($row['book_status'])->setImage($row['image']);
                $book->setLocation(new Location($row['location_id'], $row['floor'], $row['room'], $row['shelf'], $row['module']));
                $book->setImage($row['image']);
                $books[] = $book;
            }
        }

        $result->free();

        return $books;
    }

    public function getAllBooksWithFilter($text)
    {
        $sql_books = "SELECT book.book_id, book.isbn, book.title, author.name, author.surname, book.editorial, book.language, book.published_on, book.book_status, book.image,
        reservation.real_final_date
            FROM book JOIN book_author ON book.book_id = book_author.book_id 
            JOIN author ON book_author.author_id = author.author_id 
            LEFT JOIN reservation ON reservation.book_id = book.book_id
            WHERE title LIKE '%$text%'";
        $books = [];
        //make query & get results
        if ($result = $this->conn->query($sql_books)) {
            /* obtener un array asociativo */
            while ($row = $result->fetch_assoc()) {
                $book = new Book($row['book_id'], $row['isbn'], $row['title'], new Author($row['name'], $row['surname']), $row['editorial'], $row['language'], $row['published_on']);
                $book->setBookStatus($row['book_status'])->setImage($row['image']);
                $books[] = $book;
            }
        }
        $result->free();

        return $books;
    }

    function insertBook(Book $book)
    {
        $sql_book_insert = "INSERT INTO book(isbn, title, editorial, language, published_on, image, location_id)
        VALUES('{$book->getIsbn()}', '{$book->getTitle()}', '{$book->getEditorial()}', '{$book->getLanguage()}', 
            {$book->getPublishedOn()}, '{$book->getImage()}', {$book->getLocation()->getLocationId()})";
        
        $this->conn->query($sql_book_insert);

        return $this->conn->insert_id;        
    }

    function updateBook($book)
    {
        $sql_book_update =
            "UPDATE book
            SET isbn = '{$book->getIsbn()}', title = '{$book->getTitle()}', 
            editorial = '{$book->getEditorial()}', language = '{$book->getLanguage()}', 
            published_on = {$book->getPublishedOn()}, location_id = {$book->getLocation()->getLocationId()}
            WHERE book_id = {$book->getId()}";

        $this->conn->query($sql_book_update);
    }

    function setBookStatus($book_id, $status)
    {
        $sql_book_status = "UPDATE book SET book_status = $status WHERE book_id = $book_id";
        $this->conn->query($sql_book_status);
    }

    function deleteBook($book_id)
    {
        $sql_delete_book = "DELETE FROM book WHERE book_id = $book_id";
        $this->conn->query($sql_delete_book);
    }
}

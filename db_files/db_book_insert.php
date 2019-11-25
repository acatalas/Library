<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/classes/constants.php');
include(ABS_DIR . '/controller/location_controller.php');
include(ABS_DIR . '/controller/book_controller.php');
include(ABS_DIR . '/controller/author_controller.php');

$floor = $_POST['floor']; $room = $_POST['room']; $module = $_POST['module']; $shelf = $_POST['shelf'];
$author_name = $_POST['name']; $author_surname = $_POST['surname'];

$locationController = new LocationController();
$location_id = $locationController->getLocationId($floor, $room, $module, $shelf);

if ($location_id > 0) {
    $authorController = new AuthorController();
    $author_id = $authorController->getAuthorIdByName($author_name, $author_surname);
    //If author does not exist, inserts the author in the DB and saves the id
    if ($author_id < 1) {
        $author_id = $authorController->insertAuthor(new Author($name, $surname));
    }

    $bookController = new BookController();

    $book = new Book(0, $isbn, $title, null, $editorial, $language, $publication_year);
    $book->setLocation(new Location($location_id, $floor, $room, $shelf, $module));
    $book->setImage($fileName);

    $book_id = $bookController->insertBook($book);

    $authorController->insertBookAuthor($book_id, $author_id);

    echo ("<span class='green-text content'>Book inserted!</span>");
} else {
    echo ("<span class='red-text content'>Location does not exist</span>");
}

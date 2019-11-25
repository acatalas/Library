<?php
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/location_controller.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/author_controller.php");
require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/book_controller.php");
$locationController = new LocationController();
$authorController = new AuthorController();
$bookController = new BookController();

$location_id = $locationController->getLocationId($_POST['floor'], $_POST['room'], $_POST['module'], $_POST['shelf']);

//If the location exists
if ($location_id > 0) {
    //Get author that was inputted by user from the database
    $newAuthorId = $authorController->getAuthorIdByName($_POST['name'], $_POST['surname']);

    //if new author does not exist, insert it and update book_author
    if ($newAuthorId < 1) {
        $author_id = $authorController->insertAuthor(new Author($_POST['name'], $_POST['surname']));
        $authorController->updateBookAuthor(intval($_POST['id']), intval($author_id));
        echo "Creating author";
        //If author exists, get author from database
    } else {
        $oldAuthor = $authorController->getAuthorOfBook(intval($_POST['id']));

        //If the author of the book on the DB is not the same as the author passed by POST
        if ($oldAuthor->getName() != $_POST['name'] || $oldAuthor->getSurname() != $_POST['surname']) {
            $authorController->updateBookAuthor(intval($_POST['id']), intval($newAuthorId));
        }
    }

    $book = new Book(
        $_POST['id'],
        $_POST['isbn'],
        $_POST['title'],
        new Author($_POST['name'], $_POST['surname']),
        $_POST['editorial'],
        $_POST['language'],
        $_POST['publication_year']
    );

    $book->setLocation(new Location($location_id, $_POST['floor'], $_POST['room'], $_POST['module'], $_POST['shelf']));

    //Update book
    $bookController->updateBook($book);
}
header("Location: /library/index.php");

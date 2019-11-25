<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/classes/constants.php');
include(ABS_DIR . "/controller/book_controller.php");

$title = $_GET['title'] ?? '';
$bookController = new BookController();
$books = $bookController->getAllBooksWithFilter($title);

//Generates the reservation state message
function generateReservationStatus($book)
{
    //if the book is currently available
    if ($book->getBookStatus() == 1) {
        return "<a href='/library/forms/form_book_borrow.php?id={$book->getId()}&title={$book->getTitle()}&name={$book->getAuthor()->getName()}&surname={$book->getAuthor()->getSurname()}&isbn={$book->getIsbn()}'>Borrow</a>";
    } else {
        if ($_SESSION['role'] == "ADMIN") {
            return "<a href='/library/forms/form_book_return.php?id={$book->getId()}'>Return</a>";
        } else if ($_SESSION['role'] == "USER") {
            return "<span>Book is currently borrowed</span>";
        }
    }
}
?>
<div class="content">
    <?php if (count($books) > 0) : ?>
        <div class="book-list">
            <?php foreach ($books as $book) : ?>
                <div class="book">
                    <div class="book-info">
                        <?php if ($book->getImage() != null || $book->getImage() != '') : ?>
                            <img src="<?php echo '/library/img/books/' . $book->getImage() ?>" alt="Book">
                        <?php else: ?>
                            <img src="/library/img/books/default.png" alt="Book">
                        <?php endif;?>
                        <p><b><?php echo $book->getTitle() . "</b> by " . $book->getAuthor()->getName() . " " . $book->getAuthor()->getSurname() ?></p>
                        <p><b>ISBN:</b> <?php echo $book->getIsbn(); ?></p>
                        <p>Editorial: <?php echo $book->getEditorial(); ?></p>
                        <p>Published On: <?php echo $book->getPublishedOn(); ?></p>
                        <p>Language: <?php echo $book->getLanguage(); ?></p>
                    </div>
                    <div class="book-links">
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') : ?>
                            <a href=<?php echo "/library/forms/form_book_update.php?id=" . $book->getId(); ?>>Update</a>
                            <a href=<?php echo "/library/db_files/db_book_delete.php?id=" . $book->getId(); ?>>Delete</a>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['role'])) : ?>
                            <?php echo generateReservationStatus($book); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : echo 'No books found'; ?>
    <?php endif; ?>
</div>
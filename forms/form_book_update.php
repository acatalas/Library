<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/header.php'); ?>
<?php
if (isset($_GET['id'])) {
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/book_controller.php");
    $bookController = new BookController();
    $book = $bookController->getBookById($_GET['id']);
}
?>

<div class="content form-left">
    <h2>Update a book</h2>
    <form method="POST" action="">
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="<?php echo $book->getTitle() ?? '' ?>"><br>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" value="<?php echo $book->getAuthor()->getName() ?? '' ?>">
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname" value="<?php echo $book->getAuthor()->getSurname()  ?? '' ?>"><br>
        <label for="isbn">ISBN: </label>
        <input type="text" name="isbn" id="isbn" value="<?php echo $book->getIsbn()  ?? '' ?>"><br>
        <label for="editorial">Editorial: </label>
        <input type="text" name="editorial" id="editorial" value="<?php echo $book->getEditorial() ?? '' ?>"><br>
        <label for="publication_year">Publication year: </label>
        <input type="text" name="publication_year" id="publication_year" value="<?php echo $book->getPublishedOn() ?? '' ?>"><br>
        <label for="language">Language: </label>
        <input type="text" name="language" id="language" value="<?php echo $book->getLanguage() ?? '' ?>"><br>
        <p>Location</p>
        <label for="floor">Floor: </label>
        <select name="floor" id="floor">
            <option value="1" <?php echo $book->getLocation()->getFloor() == 1 ? "selected = 'selected'" : '' ?>>1</option>
            <option value="2" <?php echo $book->getLocation()->getFloor() == 2 ? "selected = 'selected'" : '' ?>>2</option>
        </select>
        <label for="room">Room: </label>
        <select name="room" id="room">
            <option value="1" <?php echo $book->getLocation()->getRoom() == 1 ? "selected = 'selected'" : '' ?>>1</option>
            <option value="2" <?php echo $book->getLocation()->getRoom() == 2 ? "selected = 'selected'" : '' ?>>2</option>
        </select>
        <label for="module">Module: </label>
        <select name="module" id="module">
            <option value="1" <?php echo $book->getLocation()->getModule() == 1 ? "selected = 'selected'" : '' ?>>1</option>
            <option value="2" <?php echo $book->getLocation()->getModule() == 2 ? "selected = 'selected'" : '' ?>>2</option>
            <option value="3" <?php echo $book->getLocation()->getModule() == 3 ? "selected = 'selected'" : '' ?>>3</option>
        </select>
        <label for="shelf">Shelf: </label>
        <select name="shelf" id="shelf">
            <option value="1" <?php echo $book->getLocation()->getShelf() == 1 ? "selected = 'selected'" : '' ?>>1</option>
            <option value="2" <?php echo $book->getLocation()->getShelf() == 2 ? "selected = 'selected'" : '' ?>>2</option>
            <option value="3" <?php echo $book->getLocation()->getShelf() == 3 ? "selected = 'selected'" : '' ?>>3</option>
            <option value="4" <?php echo $book->getLocation()->getShelf() == 4 ? "selected = 'selected'" : '' ?>>4</option>
        </select><br>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? 0 ?>">
        <input type="submit" name="book_update" value="Update">
    </form>
</div>
<?php if(isset($_POST['book_update'])){include($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db_book_update.php'); } ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/footer.php'); ?>
<?php include('./templates/header.php'); ?>
<?php
//Error array
$errors = array('title' => '', 'author' => '', 'publication_year' => '', 'language' => '');

//Variable declaration
$title = $author = $publication_year = $language = '';
if (isset($_POST['submit'])) {
    if (empty($_POST['title'])) {
        $errors['title'] = 'The title is required';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['title'])) {
        $errors['title'] = 'The title is required';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['title'])) {
        $errors['title'] = 'The title is required';
    } else {
        $title = $_POST['title'];
    }

    if (empty($_POST['title'])) {
        $errors['title'] = 'The title is required';
    } else {
        $title = $_POST['title'];
    }
}
?>
<div class="content">
    <h2>Insert a new book</h2>
    <form method="POST" action="">
        <label for="title">Title: </label>
        <input type="text" name="title" id="title"><br>
        <p>Author</p>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name">
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname"><br>
        <label for="isbn">ISBN: </label>
        <input type="text" name="isbn" id="isbn"><br>
        <label for="editorial">Editorial: </label>
        <input type="text" name="editorial" id="editorial"><br>
        <label for="publication_year">Publication year: </label>
        <input type="text" name="publication_year" id="publication_year"><br>
        <label for="language">Language: </label>
        <input type="text" name="language" id="language"><br>
        <p>Location</p>
        <label for="floor">Floor: </label>
        <select name="floor" id="floor">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <label for="room">Room: </label>
        <select name="room" id="room">
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <label for="module">Module: </label>
        <select name="module" id="module">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select>
        <label for="shelf">Shelf: </label>
        <select name="shelf" id="shelf">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select><br>
        <input type="submit" name="book_insert" value="Insert">
    </form>
</div>
<?php if(isset($_POST['book_insert'])){include('./db_files/db_book_insert.php');}?>
<?php include('./templates/footer.php'); ?>
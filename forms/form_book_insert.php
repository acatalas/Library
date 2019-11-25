<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/classes/constants.php');
require_once(ABS_DIR . '/templates/header.php'); 
require_once(ABS_DIR . '/classes/FormValidator.php');?>
<?php
//Error array
$errors = array('title' => '', 'name' => '', 'publication_year' => '', 'language' => '', 'isbn' => '', 'editorial' => '', 'image' => '', 'location' => '');
//Variable declaration
$title = $name = $surname = $editorial = $publication_year = $language = '';
$location_error = '';
$fileName = '';

/*if (isset($_POST['book_insert'])) {
    if (empty($_POST['title'])) {
        $errors['title'] = 'The title is required';
    } else {
        $title = htmlspecialchars(trim($_POST['title']));
    }
    if (empty($_POST['name'])) {
        $errors['name'] = 'The name is required';
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    if (empty($_POST['isbn'])) {
        $errors['isbn'] = 'The ISBN is required';
    } else if (!isValidISBN(trim($_POST['isbn']))) {
        $errors['isbn'] = "{$_POST['isbn']} is not a valid ISBN";
    } else {
        $isbn = trim($_POST['isbn']);
    }
    if (empty($_POST['editorial'])) {
        $errors['editorial'] = 'The editorial is required';
    } else {
        $editorial = htmlspecialchars(trim($_POST['editorial']));
    }

    if (empty($_POST['publication_year'])) {
        $errors['publication_year'] = 'The publication year is required';
    } else if (!is_numeric($_POST['publication_year'])) {
        $errors['publication_year'] = "{$_POST['publication_year']} is not a valid year";
    } else {
        $publication_year = $_POST['publication_year'];
    }

    if (empty($_POST['language'])) {
        $errors['language'] = 'The language is required';
    } else {
        $language = htmlspecialchars(trim($_POST['language']));
    }

    if (!empty($_FILES['image']['name']) && ($_FILES['image']['type'] != "image/png" && $_FILES['image']['type'] != "image/jpeg")) {
        $errors['image'] = "Not a valid image format. Please insert a .png or .jpeg file";
    }
    if ($_FILES['image']['size'] > 5000000) { //5 MB
        $errors['image'] = "Image is too big.";
    }

    $surname = htmlspecialchars(trim($_POST['surname']));
}*/

function isValidISBN(string $isbn)
{
    if (strlen($isbn) == 10 || strlen($isbn) == 13) {
        return true;
    } else {
        return false;
    }
}
?>
<div class="content form-left">
    <h2>Insert a new book</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <div class="row">
            <label for="title">Title: </label>
            <input type="text" name="title" id="title" value="<?php echo $_POST['title'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['title'] ?></p>
        <div class="row">
            <label for="name">Name: </label>
            <input type="text" name="name" id="name" value="<?php echo $_POST['name'] ?? '' ?>">
        </div>
        <p></p>
        <div class="row">
            <label for="surname">Surname: </label>
            <input type="text" name="surname" id="surname" value="<?php echo $_POST['surname'] ?? '' ?>">
        </div>
        <p class="input-error red-text"><?php echo $errors['name'] ?></p>
        <div class="row">
            <label for="isbn">ISBN: </label>
            <input type="text" name="isbn" id="isbn" value="<?php echo $_POST['isbn'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['isbn'] ?></p>
        <div class="row">
            <label for="editorial">Editorial: </label>
            <input type="text" name="editorial" id="editorial" value="<?php echo $_POST['editorial'] ?? '' ?>">
        </div>
        <p class="input-error red-text"><?php echo $errors['editorial'] ?></p>
        <div class="row">
            <label for="publication_year">Publication year: </label>
            <input type="text" name="publication_year" id="publication_year" value="<?php echo $_POST['publication_year'] ?? '' ?>">
        </div>
        <p class="input-error red-text"><?php echo $errors['publication_year'] ?></p>
        <div class="row">
            <label for="language">Language: </label>
            <input type="text" name="language" id="language" value="<?php echo $_POST['language'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['language'] ?></p>
        <div class="row">
            <label for="">Image: </label>
            <input type="file" name="image" />
        </div>
        <p class="red-text input-error"><?php echo $errors['image'] ?></p>
        <p>Location</p>
        <div class="row">
            <label for="floor">Floor: </label>
            <select name="floor" id="floor">
                <option value="1" <?php if (isset($_POST['floor']) && $_POST['floor'] == 1) echo 'selected' ?>>1</option>
                <option value="2" <?php if (isset($_POST['floor']) && $_POST['floor'] == 2) echo 'selected' ?>>2</option>
            </select>
            <label for="room">Room: </label>
            <select name="room" id="room">
                <option value="1" <?php if (isset($_POST['room']) && $_POST['room']) echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_POST['room']) && $_POST['room']) echo 'selected'; ?>>2</option>
            </select>
            <label for="module">Module: </label>
            <select name="module" id="module">
                <option value="1" <?php if (isset($_POST['module']) && $_POST['module'] ==  1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_POST['module']) && $_POST['module'] ==  2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if (isset($_POST['module']) && $_POST['module'] ==  3) echo 'selected'; ?>>3</option>
            </select>
            <label for="shelf">Shelf: </label>
            <select name="shelf" id="shelf">
                <option value="1" <?php if (isset($_POST['shelf']) && $_POST['shelf'] ==  1) echo 'selected'; ?>>1</option>
                <option value="2" <?php if (isset($_POST['shelf']) && $_POST['shelf'] ==  2) echo 'selected'; ?>>2</option>
                <option value="3" <?php if (isset($_POST['shelf']) && $_POST['shelf'] ==  3) echo 'selected'; ?>>3</option>
                <option value="4" <?php if (isset($_POST['shelf']) && $_POST['shelf'] ==  4) echo 'selected'; ?>>4</option>
            </select>
        </div>
        <input type="submit" name="book_insert" value="Insert">
    </form>
</div>
<?php if (isset($_POST['book_insert']) /*&& !array_filter($errors)*/) {
    //$BookValidator = new BookValidator($_POST);
    //echo "P";
    //print_r($BookValidator->validateForm());
    $fields = new FormField('name', 'Alejandra', [FormValidator::$REQUIRED]);

    $formValidator = new FormValidator($fields);

    if(!empty($_FILES['image']['name'])){
        $fileName = uniqid(rand(), true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $destFolder = ABS_DIR . '/img/books/';
        //move_uploaded_file($_FILES['image']['tmp_name'], $destFolder . $fileName);
    }

    //include(ABS_DIR . '/db_files/db_book_insert.php');
} ?>
<?php include(ABS_DIR . '/templates/footer.php'); ?>
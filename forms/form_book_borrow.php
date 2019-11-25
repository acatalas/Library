<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/header.php'); ?>
<?php if (isset($_GET['id'])) {
    $dateError = '';
    if (isset($_POST['book_borrow'])) {
        if ($_POST['initialDate'] < date("Y-n-d")) {
            $dateError = "Cannot borrow a book in the past! Use today's date or a future date";
        }
    }
}
?>
<div class="content form-left">
    <h2>Borrow a book</h2>
    <p><?php echo "{$_GET['title']} by {$_GET['name']} {$_GET['surname']} ({$_GET['isbn']})" ?></p>
    <form method="POST" action="">
        <div class="row">
            <label for="date">Borrow date: </label>
            <input type="date" name="initialDate" id="date"><br>
        </div>
        <p class="input-error red-text"><?php echo $dateError ?></p>
        <div class="row">
            <input type="hidden" name="book_id" value="<?php echo $_GET['id'] ?>">
            <input type="submit" value="Borrow" name="book_borrow">
        </div>
    </form>
</div>
<?php if (isset($_POST['book_borrow'])) {
    include($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db_book_borrow.php');
} ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/footer.php'); ?>
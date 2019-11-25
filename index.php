<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/header.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/forms/form_book_select.php'); ?>
<?php if(isset($_GET['book_select'])){include($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db_book_select.php');}?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/footer.php'); ?>
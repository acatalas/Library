<?php include('./templates/header.php'); ?>
<?php include('./form_book_select.php'); ?>
<?php if(isset($_GET['book_select'])){include('./db_files/db_book_select.php');}?>
<?php include('./templates/footer.php'); ?>
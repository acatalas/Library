<?php
if(isset($_GET['id'])){
    include($_SERVER['DOCUMENT_ROOT'] . '/library/controller/book_controller.php');
    $bookController = new BookController();
    $bookController->deleteBook($_GET['id']);
}
header('Location: '. $_SERVER['DOCUMENT_ROOT'] . '/library/index.php');
?>
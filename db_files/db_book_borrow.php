<?php
if ($dateError == '' && isset($_SESSION['member_id'])) {
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/reservation_controller.php");
    require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . "/library/controller/book_controller.php");
    
    $reservationController = new ReservationController();
    $bookController = new BookController();
    
    $reservationController->addReservation($_POST['book_id'], $_SESSION['member_id'], $_POST['initialDate']);
    $bookController->setBookStatus($_POST['book_id'], 0);
    
    echo "<p>Book reserved!</p> 
            <p>You can come pick it up on {$_POST['initialDate']} and you must return it by " . date('Y-m-d', strtotime("{$_POST['initialDate']} + 1 month")) . "</p>";
}

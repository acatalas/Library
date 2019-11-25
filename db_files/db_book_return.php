<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/library/controller/reservation_controller.php");
    $reservationController = new ReservationController();
    $reservationController->removeReservation($_POST['book_id']);
    if($_POST['penalty'] > 0){
        include($_SERVER['DOCUMENT_ROOT'] . "/library/controller/user_controller.php");
        $userController = new UserController();
        $userController->givePenaltyToUser($_POST['user_id'], $_POST['penalty']);
    }
?>
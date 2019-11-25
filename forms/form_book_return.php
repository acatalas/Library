<?php include($_SERVER['DOCUMENT_ROOT'] . "/library/classes/constants.php");
        include(ABS_DIR . '/templates/header.php');?>
<div class="content">
<?php if(isset($_GET['id'])): ?>
<?php
    include($_SERVER["DOCUMENT_ROOT"] . "/library/controller/reservation_controller.php");
    $book_id = $_GET['id'];
    $reservationController = new ReservationController();
    $user = $reservationController->getUserOfReservation($book_id);
    $reservation = $reservationController->getReservationByBook($book_id);
?>
<p>User <?php echo "{$user->getName()} {$user->getSurname()} borrowed this book on the {$reservation->getIntialDate()}." ?></p>
<?php
    $bookLate = Reservation::isBookLate($reservation->getFinalDate(), date("Y-m-d"));
    if($bookLate){
        $daysLate = Reservation::dateDiff($reservation->getFinalDate(), date("Y-m-d"));
        echo "<p>The book is $daysLate days late</p>";
        echo "<p>The user will recieve a penalty of 5 days</p>";
    } else {
        echo "The book is on time";
    } ?>
<form method="POST" action="" class="m0">
    <input type="hidden" name="book_id" value="<?php echo $_GET['id']?>">
    <input type="hidden" name="user_id" value="<?php echo $user->getId()?>">
    <input type="hidden" name="penalty" value="<?php echo ($bookLate ? $daysLate : 0) ?>">
    <input type="submit" name ="book_return" value="Return" class="m0">
</form>
<?php if(isset($_GET['book_return'])){include($_SERVER["DOCUMENT_ROOT"]. "/library/db_files/db_book_return.php");} ?>
<?php endif; ?>
</div>
<?php include(ABS_DIR . '/templates/footer.php'); ?>


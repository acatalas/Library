<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/library/db_files/db.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/library/classes/user.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/library/classes/reservation.php");
class ReservationController
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function addReservation($book_id, $member_id, $initialDate)
    {
        $finalDate = date('Y-m-d', strtotime("{$_POST['initialDate']} + 1 month"));

        $sql_reservation = "INSERT INTO reservation(book_id, member_id, initial_date, final_date)
            VALUES($book_id, $member_id, '$initialDate', '$finalDate')";

        $this->conn->query($sql_reservation);
    }

    public function getUserOfReservation($book_id){
        $sql_user_of_reservation = "SELECT member.member_id, name, surname, email, phone, address
                                    FROM member JOIN reservation 
                                    ON member.member_id = reservation.member_id
                                    WHERE reservation.book_id = $book_id";

        $result = $this->conn->query($sql_user_of_reservation);
        
        //fetch resulting rows as an array
        $user = $result->fetch_array(MYSQLI_ASSOC);

        //Free result
        $result->free();

        $userObj = new User($user['name'], $user['surname'], $user['email']);
        $userObj->setId($user['member_id']);
        $userObj->setPhoneNumber($user['phone']);
        $userObj->setAddress($user['address']);

        return $userObj;
    }

    public function getReservationByBook($book_id){
        $sql_reservation = "SELECT reservation_id, book_id, member_id, initial_date, final_date, real_final_date
                            FROM reservation
                            WHERE book_id = $book_id";

        $result = $this->conn->query($sql_reservation);

        $reservation = $result->fetch_array(MYSQLI_ASSOC);

        $result->free();

        $reservationObj = new Reservation($reservation['reservation_id'], $reservation['member_id'], $reservation['book_id']);
        $reservationObj->setInitialDate($reservation['initial_date']);
        $reservationObj->setFinalDate($reservation['final_date']);
        $reservationObj->setRealFinalDate($reservation['real_final_date']);

        return $reservationObj;
    }

    public function removeReservation($book_id){
        $sql_reservation = 
            "INSERT INTO reservation_log (book_id, member_id, initial_date, final_date, real_final_date)
                SELECT reservation.book_id, reservation.member_id, reservation.initial_date, reservation.final_date, DATE(now())
                FROM reservation 
                WHERE book_id = $book_id;
            DELETE FROM reservation WHERE book_id = $book_id;";
        
        $this->conn->query($sql_reservation);
    }
}

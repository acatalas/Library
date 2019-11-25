<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/library/db_files/db.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/library/classes/user.php");
class UserController
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getUserById($user_id){
        $sql_user = "SELECT name, surname, email, phone, address
            FROM member WHERE member_id = '$user_id'";
        
        $result = $this->conn->query($sql_user);

        //fetch resulting rows as an array
        $user = $result->fetch_array(MYSQLI_ASSOC);

        //Free result
        $result->free();

        $userObj = new User($user['name'], $user['surname'], $user['email']);
        $userObj->setPhone($user['phone']);
        $userObj->setAddress($user['address']);

        return $userObj;
    }

    public function givePenaltyToUser($user_id, $penalty){
        $sql_user_penalty = "UPDATE member SET penalty = $penalty WHERE member_id = $user_id";
        $this->conn->query($sql_user_penalty);
    }
}

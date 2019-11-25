<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/library/classes/location.php');
class LocationController
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    function getLocationId(int $floor, int $room, int $module, int $shelf)
    {
        $sql_location = "SELECT location_id
            FROM location 
            WHERE location.floor = '$floor' 
                AND location.room = '$room'
                AND location.module = '$module'
                AND location.shelf = '$shelf'";

        $result = $this->conn->query($sql_location);

        $location_id = $result->fetch_array(MYSQLI_NUM);

        $result->free();

        return $location_id[0];
    }
}

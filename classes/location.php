<?php
    class Location {
        private $locationId;
        private $floor;
        private $room;
        private $shelf;
        private $module;
        
        function __construct($locationId, $floor, $room, $shelf, $module)
        {
            $this->locationId = $locationId;
            $this->floor = $floor;
            $this->room = $room;
            $this->shelf = $shelf;
            $this->module = $module;
        }

        function getLocationId(){
            return $this->locationId;
        }

        function getFloor(){
            return $this->floor;
        }

        function getRoom(){
            return $this->room;
        }

        function getShelf(){
            return $this->shelf;
        }

        function getModule(){
            return $this->module;
        }
        

    }
?>
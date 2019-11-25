<?php
    class Reservation{
        private $reservation_id;
        private $member_id;
        private $book_id;
        private $initialDate;
        private $finalDate;
        private $realFinalDate;

        public function __construct($reservation_id, $member_id, $book_id)
        {
            $this->reservation_id = $reservation_id;
            $this->member_id = $member_id;
            $this->book_id = $book_id;
        }

        public function setInitialDate($date){
            $this->initialDate = $date;
        }

        public function setFinalDate($date){
            $this->finalDate = $date;
        }

        public function setRealFinalDate($date){
            $this->realFinalDate = $date;
        }

        public function getIntialDate(){
            return $this->initialDate;
        }

        public function getFinalDate(){
            return $this->finalDate;
        }

        public function getRealFinalDate(){
            return $this->realFinalDate;
        }

        public static function isBookLate($finalDate, $actualDate){
            return strtotime($finalDate) < strtotime($actualDate);
        }

        public static function dateDiff($finalDate, $actualDate){
            return floor((strtotime($actualDate) - strtotime($finalDate)) / 86400);
        }
    }
?>
<?php

    class Author{
        private $author_id;
        private $name;
        private $surname;

        public function __construct($name, $surname)
        {
            $this->name = $name;
            $this->surname = $surname;
        }

        public function setId($id){
            $this->author_id = $id;
            return $this;
        }

        public function setSurname($surname){
            $this->surname = $surname;
            return $this;
        }

        public function getId(){
            return $this->author_id;
        }

        public function getName(){
            return $this->name;
        }

        public function getSurname(){
            return $this->surname;
        }
    }

?>
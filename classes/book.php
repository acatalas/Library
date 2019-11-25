<?php 
    class Book {
        private $id;
        private $isbn;
        private $title;
        private $author;
        private $editorial;
        private $language;
        private $publishedOn;
        private $image;
        private $bookStatus;
        private $location;

        function __construct($id, $isbn, $title, $author, $editorial, $language, $publishedOn)
        {
            $this->id = $id;
            $this->isbn = $isbn;
            $this->title = $title;
            $this->author = $author;
            $this->editorial = $editorial;
            $this->language = $language;
            $this->publishedOn = $publishedOn;
        }

        function setImage($image){
            $this->image = $image;
            return $this;
        }
        
        function setBookStatus($bookStatus){
            $this->bookStatus = $bookStatus;
            return $this;
        }

        function setLocation($location){
            $this->location = $location;
            return $this;
        }

        function getId(){
            return $this->id;
        }

        function getIsbn(){
            return $this->isbn;
        }

        function getTitle(){
            return $this->title;
        }

        function getAuthor(){
            return $this->author;
        }

        function getEditorial(){
            return $this->editorial;
        }

        function getLanguage(){
            return $this->language;
        }

        function getPublishedOn(){
            return $this->publishedOn;
        }

        function getImage(){
            return $this->image;
        }

        function getBookStatus(){
            return $this->bookStatus;
        }

        function getLocation(){
            return $this->location;
        }
    }
?>
<?php
class BookValidator{
    private $post_data;
    private $errors = [];
    private static $required_fields = ['title', 'name', 'isbn', 'editorial', 'publication_year', 'language', 'image'];
    
    public function __construct($post_data)
    {
        $this->post_data = $post_data;
    }

    public function validateForm(){
        foreach(self::$required_fields as $field){
            if(!array_key_exists($field, $this->post_data)){
                trigger_error($field . ' is not present in array');
                return;
            }
        }

        $this->validateNotEmpty('title', $this->post_data['title']);
        
        if($this->validateNotEmpty('name', $this->post_data['name'])){
            $this->validateOnlyLetters('name', $this->post_data['name']);
        }

        if(!empty($this->post_data['surname'])){
            $this->validateOnlyLetters('surname', $this->post_data['surname']);
        }

        if($this->validateNotEmpty('isbn', $this->post_data['isbn'])){
            $this->validateISBN($this->post_data['isbn']);
        }

        if($this->validateNotEmpty('editorial', $this->post_data['editorial'])){
            $this->validate
        }
        





        return $this->errors;
        
    }

    private function validateNotEmpty($key, $value){
        if(trim(empty($value))){
            $this->addError($key, "The $key is required");
            return false;
        }
        return true;
    }

    private function validateOnlyLetters($key, $value){
        if(!preg_match_all('/^([A-z]+\s)*[A-z]+$/', trim($value))){
            $this->addError($key, "$key can only container letters and whitespaces");
            return false;
        }
        return true;
    }

    private function validateAlphanumeric($key, $value){
        if(!preg_match_all('/^([A-z0-9]+\s)*[A-z0-9]+$/', trim($value))){
            $this->addError($key, "$key can only container letters, numbers and whitespaces");
            return false;
        }
        return true;
    }

    private function validateISBN($isbn){
        if (strlen($isbn) != 10 && strlen($isbn) != 13) {
            $this->addError('isbn', "$isbn is not a valid ISBN");
            return false;
        }
        return true;
    }

    private function addError($key, $value){
        $this->errors[$key] = $value;
    }
}

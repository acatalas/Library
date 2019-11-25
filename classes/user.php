<?php
class User {
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phoneNumber;
    private $address;
    private $password;
    private $role;

    public function __construct($name, $surname, $email)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setPhoneNumber($phoneNumber){
        $this->phoneNumber = $phoneNumber; 
    }

    public function setAddress($address){
        $this->address = $address; 
    }

    public function setPassword($password){
        $this->password = $password; 
    }

    public function setRole($role){
        $this->role = $role; 
    }

}
?>
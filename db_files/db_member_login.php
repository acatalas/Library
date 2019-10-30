<?php
    if(isset($_POST['member_login'])){
        include('./db_connect.php');

        if(password_verify($password, $hashed_password)) {}
    }

    function getPassword($email){
        $sql_password = "SELECT password FROM member WHERE email = '$email'";
    }
?>
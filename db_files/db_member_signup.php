<?php
if (isset($_POST['member_signup'])) {
    include('./db_connect.php');

    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    addUser($_POST['name'], 
        $_POST['surname'], 
        $_POST['email'], 
        $hashed_password, 
        $_POST['phone'], 
        "{$_POST['street']}, {$_POST['city']}");
}

function addUser($name, $surname, $email, $password, $phone, $address)
{
    global $conn;

    $sql_user = "INSERT INTO member(name, surname, email, password, phone, address)
            VALUES('$name', '$surname', '$email', '$password', '$phone', '$address')";

    if (!mysqli_query($conn, $sql_user)) {
        echo 'query error: ' . mysqli_error($conn);
    } else {
        echo 'Welcome' . $name;
    }
}

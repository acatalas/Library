<?php
if (isset($_POST['member_signup']) && !array_filter($errors)) {
    include('./db_files/db_connect.php');

    if (emailExists(mysqli_escape_string($conn, $_POST['email']))) {
        echo "<span class='red-text'>USER ALREADY EXISTS</span>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        addUser(
            mysqli_escape_string($conn, $name),
            mysqli_escape_string($conn, $surname),
            mysqli_escape_string($conn, $email),
            mysqli_escape_string($conn, $hashed_password),
            mysqli_escape_string($conn, $phone),
            mysqli_escape_string($conn, "$street, $city")
        );
        $_SESSION["name"] = $name;
    }
}

function emailExists($email)
{
    global $conn;

    $sql_email = "SELECT COUNT(member_id) FROM member WHERE email = '$email'";

    //make query & get results
    $result = mysqli_query($conn, $sql_email);

    //fetch resulting rows as an array
    $emailCount = mysqli_fetch_array($result);

    //Free result
    mysqli_free_result($result);

    return $emailCount[0] > 0;
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

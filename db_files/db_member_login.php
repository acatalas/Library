<?php
if (isset($_POST['member_login']) && !array_filter($errors)) {
    include($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db_connect.php');
    $db_member = getMember($email);
    if($db_member['password'] == ''){
        echo "<p class='red-text'>User does not exist</p>";
    } else {
        if(password_verify($password, $db_member['password'])){
            echo ("<p>Logged in!</p>");
            $_SESSION['name'] = $db_member['name'];
            $_SESSION['member_id'] = $db_member['member_id'];
            $_SESSION['role'] = $db_member['role'];
        } else {
            echo ("<p class='red-text'>Incorrect password</p>");
        }
    }
}

function getMember($email)
{
    global $conn;
    $sql_member = "SELECT member_id, password, name, role FROM member WHERE email = '$email'";

    //make query & get results
    $result = mysqli_query($conn, $sql_member);

    //fetch resulting rows as an array
    $member = mysqli_fetch_assoc($result);

    //Free result
    mysqli_free_result($result);

    return $member;
    
}

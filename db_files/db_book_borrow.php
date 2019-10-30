<?php
if (isset($_POST['book_borrow'])) {
    include('./db_connect.php');
    if(($user_id = getUserId($_POST['email'])) > 0){
        insertReservation($user_id);
        header("Location: /library/index.php");
    } else {
        echo("No user found with that username");
    }
}

function getUserId($email)
{
    global $conn;

    $sql_user = "SELECT member_id
            FROM member 
            WHERE email = '$email'";

    //make query & get results
    $result = mysqli_query($conn, $sql_user);

    //fetch resulting rows as an array
    $user_id = mysqli_fetch_array($result);

    //Free result
    mysqli_free_result($result);

    return $user_id[0];
}

function insertReservation($memberId){
    global $conn;
    $finalDate = date('Y-m-d', strtotime("{$_POST['initialDate']} + 1 month"));

    $sql_reservation = "INSERT INTO reservation(book_id, member_id, initial_date, final_date)
        VALUES({$_POST['book_id']}, $memberId, '{$_POST['initialDate']}', '$finalDate')";

    if (!mysqli_query($conn, $sql_reservation)) {
        echo 'query error: ' . mysqli_error($conn);
    }
}

?>

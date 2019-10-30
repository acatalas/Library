<?php

if (isset($_POST['id'])) {
    include('./db_connect.php');
    //If the location exists
    if (($location_id = getLocationId($_POST['floor'], $_POST['room'], $_POST['module'], $_POST['shelf'])) > 0) {
        //Get new author from database
        $newAuthor = getAuthor($_POST['name'], $_POST['surname']);
        if ($newAuthor['author_id'] < 1) {  //if new author does not exist, insert it and update book_author
            $author_id = insertAuthor($_POST['name'], $_POST['surname']);
            updateAuthorBook(intval($_POST['id']), intval($author_id));
        } else { //If author exists, get old author 
            $oldAuthor = getAuthorOfBook($_POST['id']);
            //Check if old author is the same as new
            if($oldAuthor['name'] != $_POST['name'] || $oldAuthor['surname'] != $_POST['surname']){
                updateAuthorBook(intval($_POST['id']), intval($newAuthor['author_id']));
                echo 'AUTHOR UPDATED';
            }
        }

        //Update book
        updateBook($_POST['id'], $_POST['isbn'], $_POST['title'], $_POST['editorial'], $_POST['language'], 
            $_POST['publication_year'], $location_id);
    }
    mysqli_close($conn);
    header("Location: /library/index.php");
}

function getLocationId(int $floor, int $room, int $module, int $shelf)
{
    global $conn;
    $sql_location = "SELECT location_id
            FROM location 
            WHERE location.floor = '$floor' 
                AND location.room = '$room'
                AND location.module = '$module'
                AND location.shelf = '$shelf'";

    //make query & get results
    $result = mysqli_query($conn, $sql_location);

    //fetch resulting rows as an array
    $location_id = mysqli_fetch_array($result);

    //Free result
    mysqli_free_result($result);

    return $location_id[0];
}

function getAuthorOfBook(int $book_id){
    global $conn;
    //Query author
    $sql_author = "SELECT author.author_id, name, surname 
        FROM author 
        JOIN book_author 
            ON author.author_id = book_author.book_id 
        WHERE book_id = $book_id";

    echo $sql_author;

    //make query & get results
    $result = mysqli_query($conn, $sql_author);

    //fetch resulting rows as an array
    $author = mysqli_fetch_assoc($result);

    //Free result
    mysqli_free_result($result);

    return $author;
}

function getAuthor(string $name, string $surname)
{
    global $conn;
    //Query author
    $sql_author = "SELECT author_id, name, surname 
            FROM author 
            WHERE author.name = '$name' 
                AND author.surname = '$surname'";

    //make query & get results
    $result = mysqli_query($conn, $sql_author);

    //fetch resulting rows as an array
    $author = mysqli_fetch_assoc($result);

    //Free result
    mysqli_free_result($result);

    return $author;
}

function insertAuthor(string $name, string $surname)
{
    global $conn;
    $sql_author = "INSERT INTO author(name, surname) 
        VALUES ('$name', '$surname')";
    if (!mysqli_query($conn, $sql_author)) {
        echo 'query error: ' . mysqli_error($conn);
    } else {
        return mysqli_insert_id($conn);
    }
}

function updateAuthorBook(int $book_id, int $author_id) {
    global $conn;
    $sql_book_author = "UPDATE book_author SET author_id = $author_id WHERE book_id = $book_id";
    echo $sql_book_author;
    if (!mysqli_query($conn, $sql_book_author)) {
        echo 'query error: ' . mysqli_error($conn);
    } else {
        echo 'Updated author book';
    }
}


function updateBook(
    int $book_id,
    string $isbn,
    string $title,
    string $editorial,
    string $language,
    int $published_on,
    int $location_id
) {
    global $conn;
    $sql_book_update = "UPDATE book
        SET isbn = '$isbn', title = '$title', editorial = '$editorial', language = '$language', 
        published_on = $published_on, location_id = $location_id
        WHERE book_id = $book_id";
    if (!mysqli_query($conn, $sql_book_update)) {
        echo 'query error: ' . mysqli_error($conn);
    } else {
        return mysqli_insert_id($conn);
    }
}

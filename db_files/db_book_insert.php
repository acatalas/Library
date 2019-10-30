<?php
if (isset($_POST['book_insert'])) {
    include('./db_files/db_connect.php');
    if (($location_id = getLocationId( //If location exists
        $_POST['floor'],
        $_POST['room'],
        $_POST['module'],
        $_POST['shelf']
    )) > 0) {    
        //If author does not exist, inserts the author in the DB and saves the id
        if (($author_id = getAuthorId($_POST['name'], $_POST['surname'])) < 1) {
            $author_id = insertAuthor($_POST['name'], $_POST['surname']);
        }
        //Inserts the book into the DB
        insertBook(
            $_POST['isbn'],
            $_POST['title'],
            $_POST['editorial'],
            $_POST['language'],
            intval($_POST['publication_year']),
            (int) $location_id,
            (int) $author_id
        );
        echo("<span class='green-text content'>Book inserted!</span>");
    } else {
        echo ("<span class='red-text content'>LOCATION DOES NOT EXIST</span>");
    }
    mysqli_close($conn);
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

function getAuthorId(string $name, string $surname)
{
    global $conn;
    //Query for author id
    $sql_author = "SELECT author_id 
            FROM author 
            WHERE author.name = '$name' 
                AND author.surname = '$surname'";

    //make query & get results
    $result = mysqli_query($conn, $sql_author);

    //fetch resulting rows as an array
    $author_id = mysqli_fetch_array($result);

    //Free result
    mysqli_free_result($result);

    //echo "Author id is " . $author_id[0];

    return $author_id[0];
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

function insertBook(
    string $isbn,
    string $title,
    string $editorial,
    string $language,
    int $published_on,
    int $location_id,
    int $author_id
) {
    global $conn;
    $sql_book_insert = "INSERT INTO 
        book(isbn, title, editorial, language, published_on, location_id)
        VALUES('$isbn', '$title', '$editorial', '$language', $published_on, $location_id)";
    if (!mysqli_query($conn, $sql_book_insert)) {
        echo 'query error: ' . mysqli_error($conn);
    } else {
        $book_id = mysqli_insert_id($conn);
    }
    $sql_book_author_insert = "INSERT INTO
        book_author(book_id, author_id) 
        VALUES($book_id, $author_id)";

    if (!mysqli_query($conn, $sql_book_author_insert)) {
        echo 'query error: ' . mysqli_error($conn);
    }
}

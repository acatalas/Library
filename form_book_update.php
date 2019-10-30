<?php
    if(isset($_GET['id'])){
        include('./db_files/db_connect.php');
        $sql = "SELECT book.isbn, book.title, 
                        author.name, author.surname, 
                        book.editorial, book.published_on, book.language, 
                        location.floor, location.room, location.module, location.shelf
            FROM book JOIN book_author ON book.book_id = book_author.book_id 
                    JOIN author ON book_author.author_id = author.author_id
                    JOIN location ON book.location_id = location.location_id
            WHERE book.book_id = {$_GET['id']}";
  
    //make query & get results
    $result = mysqli_query($conn, $sql);
        
    //fetch resulting rows as an array
    $book = mysqli_fetch_assoc($result);

    //Free result
    mysqli_free_result($result);

    //Close database
    mysqli_close($conn);
    }
?>

<h2>Insert a new book</h2>
    <form method="POST" action="./db_files/db_book_update.php">
        <label for="title">Title: </label>
        <input type="text" name="title" id="title" value="<?php echo $book['title'] ?? '' ?>"><br>
        <p>Author</p>
        <label for="name">Name: </label>
        <input type="text" name="name" id="name" value="<?php echo $book['name'] ?? '' ?>">
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname" value="<?php echo $book['surname'] ?? '' ?>"><br>
        <label for="isbn">ISBN: </label>
        <input type="text" name="isbn" id="isbn" value="<?php echo $book['isbn'] ?? '' ?>"><br>
        <label for="editorial">Editorial: </label>
        <input type="text" name="editorial" id="editorial" value="<?php echo $book['editorial'] ?? '' ?>"><br>
        <label for="publication_year">Publication year: </label>
        <input type="text" name="publication_year" id="publication_year" value="<?php echo $book['published_on'] ?? '' ?>"><br>
        <label for="language">Language: </label>
        <input type="text" name="language" id="language" value="<?php echo $book['language'] ?? '' ?>"><br>
        <p>Location</p>
        <label for="floor">Floor: </label>
        <select name="floor" id="floor">
            <option value="1" <?php echo $book['floor'] == 1 ? "selected = 'selected'" : ''?>>1</option>
            <option value="2" <?php echo $book['floor'] == 2 ? "selected = 'selected'" : ''?>>2</option>
        </select>
        <label for="room">Room: </label>
        <select name="room" id="room">
            <option value="1" <?php echo $book['room'] == 1 ? "selected = 'selected'" : ''?>>1</option>
            <option value="2" <?php echo $book['room'] == 2 ? "selected = 'selected'" : ''?>>2</option>
        </select>
        <label for="module">Module: </label>
        <select name="module" id="module">
            <option value="1" <?php echo $book['module'] == 1 ? "selected = 'selected'" : ''?>>1</option>
            <option value="2" <?php echo $book['module'] == 2 ? "selected = 'selected'" : ''?>>2</option>
            <option value="3" <?php echo $book['module'] == 3 ? "selected = 'selected'" : ''?>>3</option>
        </select>
        <label for="shelf">Shelf: </label>
        <select name="shelf" id="shelf">
            <option value="1" <?php echo $book['shelf'] == 1 ? "selected = 'selected'" : ''?>>1</option>
            <option value="2" <?php echo $book['shelf'] == 2 ? "selected = 'selected'" : ''?>>2</option>
            <option value="3" <?php echo $book['shelf'] == 3 ? "selected = 'selected'" : ''?>>3</option>
            <option value="4" <?php echo $book['shelf'] == 4 ? "selected = 'selected'" : ''?>>4</option>
        </select><br>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?? 0 ?>">
        <input type="submit" name="book_update" value="Update">
    </form>
<?php
include('./db_files/db_connect.php');
$title = $_GET['title'] ?? '';
$sql = "SELECT book.book_id, book.isbn, book.title, author.name, author.surname, book.editorial, book.language, reservation.initial_date, reservation.final_date, reservation.real_final_date
                FROM book JOIN book_author ON book.book_id = book_author.book_id 
                JOIN author ON book_author.author_id = author.author_id 
                LEFT JOIN reservation ON reservation.book_id = book.book_id
                WHERE title LIKE '%$title%'
                    AND (reservation.initial_date >= 
                        ANY(SELECT MAX(reservation.initial_date) 
                            FROM reservation 
                            WHERE reservation.book_id = book.book_id)
                    OR book.book_id NOT IN (SELECT book_id FROM reservation))";

//make query & get results
$result = mysqli_query($conn, $sql);

//fetch resulting rows as an array
$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

//Free result
mysqli_free_result($result);

//Close database
mysqli_close($conn);

//Generates the reservation state message
function generateReservationStatus($book)
{
    //if the book has never been borrowed, or it has been returned
    if ($book['initial_date'] == null || $book['real_final_date'] != null) {
        return "<a href='/library/form_book_borrow.php?id={$book['book_id']}&title={$book['title']}&name={$book['name']}&surname={$book['surname']}&isbn={$book['isbn']}'>Reservar</a>";
    
    //if the book has been borrowed and not returned
    } else if ($book['initial_date'] != null && $book['real_final_date'] == null) {
        //Checks if it is late
        if ($book['final_date'] < date("Y-n-d")) {
            return "<span class='red-text'>BOOK IS LATE</span>";
        } else {
            return "<span class='yellow-text'>BOOK IS CURRENTLY BORROWED</span>";
        }
    }
}
?>
<div class="content">
    <?php if (count($books) > 0) : foreach ($books as $book) : ?>
            <div class="book-list-item">
                <?php echo "<b>{$book['title']}</b> by {$book['name']} {$book['surname']}<br>ISBN: {$book['isbn']}<br>Editorial: {$book['editorial']}<br>Language: {$book['language']}" ?>
            </div>
            <div class="book-list-links">
                <a href=<?php echo "/library/form_book_update.php?id={$book['book_id']}" ?>>Update</a>
                <a href=<?php echo "/library/db_files/db_book_delete.php?id={$book['book_id']}" ?>>Delete</a>
                <?php echo generateReservationStatus($book); ?>
            </div>
    <?php endforeach;
    else : echo 'No books found';
    endif; ?>
</div>
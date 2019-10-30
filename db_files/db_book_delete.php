<?php
echo $_GET['id'];
if(isset($_GET['id'])){
    
    include('./db_connect.php');
    $sql_book_delete = "DELETE FROM book
       WHERE book_id = {$_GET['id']}";
    if (!mysqli_query($conn, $sql_book_delete)) {
        echo 'query error: ' . mysqli_error($conn);
    } 
    mysqli_close($conn);
}
header("Location: /library/index.php");
?>
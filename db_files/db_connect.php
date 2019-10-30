<?php
    $conn = mysqli_connect('localhost', 'root', 'twinkle11', 'library');

    if(!$conn) {
        echo 'Connection error: ' . mysqli_connect_error();
    }
?>
<?php 
    session_start();
    session_unset();
    header("Location: /library/index.php");
?>
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Library</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/library/css/styles.css">
</head>

<body>
    <header>
        <h1><a href="/library/index.php">Library</a></h1>
    </header>
    <nav>
        <ul>
            <li><a href="/library/index.php">HOME</a></li>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'ADMIN') : ?>
                <li><a href="/library/forms/form_book_insert.php">Insert book</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['name'])) : ?>
                <li class='nav-item-right'><a href='/library/forms/form_member_logout.php'>Log out</a></li>
                <li class='nav-item-right'><span>Hello, <?php echo "{$_SESSION['name']}" ?></span></li>
            <?php else : ?>
                <li class='nav-item-right'><a href='/library/forms/form_member_login.php'>Log in</a></li>
            <?php endif; ?>
        </ul>
    </nav>
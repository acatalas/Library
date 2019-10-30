<?php include('./templates/header.php'); ?>
<div class="content">
<?php if(isset($_GET['id'])): ?>
    <h2>Borrow a book</h2>
    <p><?php echo "{$_GET['title']} by {$_GET['name']} {$_GET['surname']} ({$_GET['isbn']})"?>
    <form method="POST" action="./db_files/db_book_borrow.php">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name"><br>
        <label for="surname">Surname: </label>
        <input type="text" name="surname" id="surname"><br>
        <label for="email">Email: </label>
        <input type="text" name="email" id="email"><br>
        <label for="date">Borrow date: </label>
        <input type="date" name="initialDate" id="date"><br>
        <input type="hidden" name="book_id" value="<?php echo $_GET['id']?>">
        <input type="submit" value="Borrow" name="book_borrow">
    </form>
<?php else: ?>
    
<?php endif; ?>
</div>
<?php include('./templates/footer.php'); ?>

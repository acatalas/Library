<?php include('./templates/header.php') ?>
<div class="content">
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Log in" name="member_login">
    </form>
    <p><a href="./form_member_signup.php">Don't have an account? Sign up!</a></p>
</div>
<?php include('./templates/footer.php') ?>
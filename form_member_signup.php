<?php include('./templates/header.php') ?>
<div class="content">
    <form action="./db_files/db_member_signup.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>
        <label for="surname">Surname:</label>
        <input type="text" name="surname" id="surname"><br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone"><br>
        <label for="street">Street:</label>
        <input type="text" name="street" id="street"><br>
        <label for="city">City:</label>
        <input type="text" name="city" id="city"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        <label for="">Password:</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Sign up" name="member_signup">
    </form>
    <p><a href="./form_member_login.php">Already have an account? Log in!</a></p>
</div>
<?php include('./templates/footer.php') ?>
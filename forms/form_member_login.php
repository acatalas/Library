<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/header.php') ?>
<?php 
    $errors = array('email' => '', 'password' => '');
    $email = $password = '';
    if(isset($_POST['member_login'])){
        if(empty(trim($_POST['password']))){
            $errors['password'] = "Password can't be empty";
        } else {
            $password = $_POST['password'];
        }
        if(empty(trim($_POST['email']))){
            $errors['email'] = "The email address is required";
        } else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email'])){
            $errors['email'] = "Email address is not valid";
        } else {
            $email = $_POST['email'];
        }
    }
?>
<div class="content form-center">
    <h2>Log in</h2>
    <form action="" method="POST">
        <div class="row">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['email'] ?></p>
        <div class="row">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '' ?>">
        </div>
        <div class="row">
            <input type="submit" value="Log in" name="member_login">
        </div>
        <p class="red-text input-error"><?php echo $errors['password'] ?></p>
    </form>
    <p class="text-center"><a href=<?php echo $_SERVER['DOCUMENT_ROOT'] . '/library/forms/form_member_signup.php'?>>Don't have an account? Sign up!</a></p>
    <?php if (isset($_POST['member_login'])) {
        include($_SERVER['DOCUMENT_ROOT'] . '/library/db_files/db_member_login.php');
        header("Location: /library/index.php");
    } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/footer.php') ?>
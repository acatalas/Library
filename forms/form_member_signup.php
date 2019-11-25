<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/header.php') ?>
<?php 
    $errors = array('name' => '', 'surname' => '', 'phone' => '', 'street' => '', 'city' => '', 'email' => '', 'password' => '');
    $name = $surname = $phone = $street = $city = $email = $password = '';
    if(isset($_POST['member_signup'])){
        if(empty(trim($_POST['name']))){
            $errors['name'] = "The name field is required";
        } else {
            $name = htmlspecialchars(trim($_POST['name']));
        }
        if(empty(trim($_POST['surname']))){
            $errors['surname'] = "The surname field is required";
        } else {
            $surname = htmlspecialchars(trim($_POST['surname']));
        }
        if(empty(trim($_POST['phone']))){
            $errors['phone'] = "The phone field is required";
        } else if(!is_numeric(trim($_POST['phone']))){
            $errors['phone'] = "Not a valid phone number";
        } else {
            $phone = htmlspecialchars(trim($_POST['phone']));
        }
        if(empty(trim($_POST['city']))){
            $errors['city'] = "The city field is required";
        } else {
            $city = htmlspecialchars(trim($_POST['city']));
        }
        if(empty(trim($_POST['street']))){
            $errors['street'] = "The street field is required";
        } else {
            $street = htmlspecialchars(trim($_POST['street']));
        }
        if(empty(trim($_POST['email']))){
            $errors['email'] = "The email address is required";
        } else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $_POST['email'])){
            $errors['email'] = "Email address is not valid";
        } else {
            $email = $_POST['email'];
        }
        echo strlen($_POST['password']);
        if(empty(trim($_POST['password']))){
            $errors['password'] = "The password field is required";
        } else if(strlen(trim($_POST['password'])) < 5) {
            $errors['password'] = "The password must be at least 5 characters long";
        } else {
            $password = htmlspecialchars(trim($_POST['password']));
        }
    }
?>
<div class="content form-center">
    <h2>Sign up</h2>
    <form action="" method="POST">
        <div class="row">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $_POST['name'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['name'] ?></p>
        <div class="row">
            <label for="surname">Surname:</label>
            <input type="text" name="surname" id="surname" value="<?php echo $_POST['surname'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['surname'] ?></p>
        <div class="row">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="<?php echo $_POST['phone'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['phone'] ?></p>
        <div class="row">
            <label for="street">Street:</label>
            <input type="text" name="street" id="street" value="<?php echo $_POST['street'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['street'] ?></p>
        <div class="row">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="<?php echo $_POST['city'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['city'] ?></p>
        <div class="row">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['email'] ?></p>
        <div class="row">
            <label for="">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $_POST['password'] ?? '' ?>">
        </div>
        <p class="red-text input-error"><?php echo $errors['password'] ?></p>
        <div class="row">
            <input type="submit" value="Sign up" name="member_signup">
        </div>
    </form>
    <p class="text-center"><a href="./form_member_login.php">Already have an account? Log in!</a></p>
    <?php if (isset($_POST['member_signup'])) {
        include('./db_files/db_member_signup.php');
    } ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/library/templates/footer.php') ?>
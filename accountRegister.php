<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED);
include_once('Models/UserDatabase.php');
include_once('Models/Database.php');
include_once('Utils/Validator.php');
# trick to execute 1st time, but not 2nd so you don't have an inf loop


$v = new Validator($_POST);

$database = new Database();
$email = "";
$password = "";
$passwordRepeat = "";
$name = "";
$streetaddress = "";
$postalCode = "";
$city = "";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Dom har tryckt på knappen, validera och registrera
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['passwordRepeat'];
    $name = $_POST['name'];
    $streetaddress = $_POST['streetaddress'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];

    // todo add 
    $v->field('email')->required()->email();
    $v->field('password')->required()->min_len(8)->max_len(20);
    $v->field('passwordRepeat')->equals($password);

    $v->field('name')->required()->min_len(3)->max_len(50);
    $v->field('streetaddress')->required()->min_len(3)->max_len(50);
    $v->field('postalCode')->required()->max_len(10);
    $v->field('city')->required()->max_len(50);

    //

    if ($v->is_valid()) {
        try {
            $userid = $database->getUsersDatabase()->getAuth()->register($email, $password, $email);
            // insert into user details table with $userid and other details
            $database->getUsersDatabase()->addUserDetails($userid, $streetaddress, $name, $postalCode, $city);
            header("Location: /accountLogin.php");
            exit;
        } catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $message = "User already exists";
        } catch (\Delight\Auth\InvalidEmailException $e) {
            $message = "Invalid email";
        } catch (\Delight\Auth\TooManyRequestsException $e) {
            $message = "Too many requests, please try again later";
        } catch (\Delight\Auth\InvalidPasswordException $e) {
            $message = "Invalid password";
        }

    } else {
        $message = "Please fix the errors";
    }


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="row">
        <?php if ($message): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <section class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <p class="text-lg font-semibold">User<strong>&nbsp;REGISTER</strong></p>
            <form method="POST">
                <input value="<?php echo $email; ?>" class="input border border-gray-300 rounded-md p-2" type="text"
                    placeholder="Enter Your Email" name="email">
                <?php echo $v->get_error_message('email'); ?>
                <br />
                <br />
                <input value="<?php echo $password; ?>" class="input border border-gray-300 rounded-md p-2"
                    type="password" placeholder="Enter Your Password" name="password">
                <?php echo $v->get_error_message('password'); ?>
                <br />
                <br />
                <input value="<?php echo $passwordRepeat; ?>" class="input border border-gray-300 rounded-md p-2"
                    type="password" placeholder="Repeat Password" name="passwordRepeat">
                <?php echo $v->get_error_message('passwordRepeat'); ?>
                <br />
                <br />
                <input value="<?php echo $name; ?>" class="input border border-gray-300 rounded-md p-2" type="text"
                    placeholder="Name" name="name">
                <?php echo $v->get_error_message('name'); ?>
                <br />
                <br />
                <input value="<?php echo $streetaddress; ?>" class="input border border-gray-300 rounded-md p-2"
                    type="text" placeholder="Street address" name="streetaddress">
                <?php echo $v->get_error_message('streetaddress'); ?>
                <br />
                <br />
                <input value="<?php echo $postalCode; ?>" class="input border border-gray-300 rounded-md p-2"
                    type="text" placeholder="Postal code" name="postalCode">
                <?php echo $v->get_error_message('postalCode'); ?>
                <br />
                <br />
                <input value="<?php echo $city; ?>" class="input border border-gray-300 rounded-md p-2" type="text"
                    placeholder="City " name="city">
                <?php echo $v->get_error_message('city'); ?>
                <br />
                <br />
                <button type="submit" class="newsletter-btn border border-gray-300 rounded-md p-2 hover:bg-gray-200"><i
                        class="fa fa-envelope"></i>
                    Register</button>
            </form>
    </div>
    </div>
    </section>

</body>

</html>
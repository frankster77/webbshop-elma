<?php
ob_start();
error_reporting(E_ALL & ~E_DEPRECATED);
include_once('Models/Database.php');
# trick to execute 1st time, but not 2nd so you don't have an inf loop

$message = "";
$database = new Database();

$auth = $database->getUsersDatabase()->getAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $auth->login($email, $password);

        $_SESSION['email'] = $email;

        header("Location: /");
        exit;

    } catch (\Delight\Auth\InvalidEmailException $e) {
        $message = "Fel användarnamn eller lösenord";
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $message = "Fel användarnamn eller lösenord";
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
    <p>
    <div class="row">

        <div class="row">
            <?php
            echo $message;
            ?>
            <section class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
                <p class="text-lg font-semibold">User<strong>&nbsp;LOGIN</strong></p>
                <form method="post">
                    <input class="input border border-gray-300 rounded-md p-2" type="email" name="email"
                        placeholder="Enter Your Email">
                    <br />
                    <br />
                    <input class="input border border-gray-300 rounded-md p-2" type="password" name="password"
                        placeholder="Enter Your Password">
                    <br />
                    <br />
                    <button class="newsletter-btn border border-gray-300 rounded-md p-2 hover:bg-gray-200"><i
                            class="fa fa-envelope"></i> Login</button>
                </form>
                <a href="">Lost password?</a>
        </div>
        </section>

        </p>
</body>

</html>
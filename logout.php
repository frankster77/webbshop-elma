<?php
session_start();

require_once 'Models/Database.php';

$database = new Database();
$auth = $database->getUsersDatabase()->getAuth();

try {
    $auth->logOut(); // loggar ut via Delight\Auth
} catch (Exception $e) {
    // om något går fel, ignorerar vi det
}

// rensa session helt
$_SESSION = [];
session_unset();
session_destroy();

// tillbaka till startsidan
header("Location: /");
exit;
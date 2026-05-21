<?php
session_start();

require_once 'Models/Database.php';

$database = new Database();
$auth = $database->getUsersDatabase()->getAuth();

try {
    $auth->logOut();
} catch (Exception $e) {

}


$_SESSION = [];
session_unset();
session_destroy();


header("Location: /");
exit;
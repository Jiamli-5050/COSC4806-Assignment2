<?php
session_start();
if (!($_SESSION['auth'] ?? false)) {
    header('Location: login.php');
    exit;
}
require_once('user.php');
echo "<h1>Welcome, {$_SESSION['user']}!</h1>";
echo "<p><a href='logout.php'>Log out</a></p>";

$user = new User();
echo "<pre>";
print_r($user->get_all_users());
?>
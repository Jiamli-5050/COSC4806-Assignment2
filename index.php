<?php
session_start();
if (!($_SESSION['auth'] ?? false)) {
    header('Location: login.php');
    exit;
} // if the user is not logged in, send them to the login page
require_once('user.php');
echo "<h1>Welcome, {$_SESSION['user']}!</h1>";
echo "<p><a href='logout.php'>Log out</a></p>"; // let users log out

$user = new User();
echo "<pre>";
print_r($user->get_all_users()); // print all users
?>
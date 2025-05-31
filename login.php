<?php

// connect to the user.php
require_once('user.php');     
session_start();                

// once they log in, send them home
if (isset($_SESSION['auth'])) {
    header('Location: /');
    exit;
}

// 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['uname'] ?? '');   
    $p = $_POST['password'] ?? '';      
    $user = new User();

    // if the user/pass matches, send them to the next location
    if ($user->authenticate($u, $p)) {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $u;
        header('Location: /');
        exit;
    }
    // if the information they gave doesnt work, show them 
    $err = 'Invalid credentials.';
}


$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<?php
    if ($msg)        echo "<p style='color:green'>$msg</p>"; // if success
    if (isset($err)) echo "<p style='color:red'>$err</p>";   // if failure
?>
<form method="post">
  <label>Username</label>

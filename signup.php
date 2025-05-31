<?php
require_once('user.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['uname'] ?? '');
    $p = $_POST['password'] ?? '';
    $user = new User();

    if ($user->register($u, $p)) { // if the user is registered, send them to the login page
        header('Location: login.php?msg=Account created, log in!');
        exit;
    }
    $err = 'Signup failed (name already taken or weak password).';// if the user is not registered, show them
}
?>
<!DOCTYPE html><html><head><title>Sign Up</title></head><body>
<h2>Create account</h2>
<?php if (isset($err)) echo "<p style='color:red'>$err</p>"; ?>
<form method="post">
  <label>Username</label><input name="uname" required><br>
  <label>Password</label><input type="password" name="password" required><br>
  <button>Sign Up</button>
    <!-- password must be at  8+ characters long, one or more uppercase letter, one ore more lowercase letter, and one number -->
</form>
<a href="login.php">I already have an account</a> //
</body></html>
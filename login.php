<?php
require_once('user.php');
session_start(); // start the session

if (isset($_SESSION['auth'])) {
    header('Location: /'); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['uname'] ?? '');
    $p = $_POST['password'] ?? '';
    $user = new User(); // create a new user object

    if ($user->authenticate($u, $p)) {
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $u;
        header('Location: /'); exit;
    }
    $err = 'Invalid credentials.'; // if the user is not authenticated, show them
}
$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html><html><head><title>Login</title></head><body>
<h2>Login</h2>
<?php
  if ($msg)   echo "<p style='color:green'>$msg</p>";
  if (isset($err)) echo "<p style='color:red'>$err</p>";
?>
<form method="post">
  <label>Username</label><input name="uname" required><br>
  <label>Password</label><input type="password" name="password" required><br>
  <button>Login</button> 
</form>
<a href="signup.php">Create an account</a>
</body></html>

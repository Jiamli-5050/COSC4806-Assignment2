<?php
session_start();
session_destroy();
header('Location: login.php?msg=Logged out'); // let users log out
exit;
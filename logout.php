<?php
session_start();

// HAPUS SEMUA SESSION
$_SESSION = [];
session_unset();
session_destroy();

// HAPUS COOKIE REMEMBER ME
setcookie("login", "", time() - 3600, "/");

// REDIRECT KE LOGIN
header("Location: login.php");
exit();
?>
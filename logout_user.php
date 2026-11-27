<?php
// File: logout_user.php
// Logout Peserta (User)

session_start();

// Hapus semua data session user
unset($_SESSION['user_logged_in']);
unset($_SESSION['user_id']);
unset($_SESSION['user_nama']);
unset($_SESSION['user_email']);

session_destroy();

header('Location: login.php');
exit;
?>

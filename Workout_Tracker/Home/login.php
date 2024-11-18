<?php
// Misalnya, setelah pengguna berhasil login
session_start();
// Set session user_id dan user_name setelah login berhasil
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];  // Menyimpan nama pengguna di session
?>

<?php
// Mulai session
session_start();

// Hapus semua session yang ada
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman utama setelah logout
header("Location: ../"); // Path menuju index.php di root folder
exit();
?>

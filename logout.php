<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: index.html"); // Arahkan kembali ke halaman utama
exit();
?>

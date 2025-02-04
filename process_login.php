<?php
// Mulai sesi untuk menyimpan informasi login pengguna
session_start();

// Contoh pengguna yang disimpan di database (array sederhana untuk ilustrasi)
$users = [
    ['email' => 'user@example.com', 'password' => 'password123'] // Password ini harus di-hash di aplikasi nyata
];

// Ambil data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Fungsi sederhana untuk mencocokkan email dan password
function authenticate($email, $password, $users) {
    foreach ($users as $user) {
        // Memeriksa apakah email cocok
        if ($user['email'] === $email) {
            // Memeriksa apakah password cocok (jangan lupa menggunakan password_hash dan password_verify untuk keamanan!)
            if ($user['password'] === $password) {
                return true;
            }
        }
    }
    return false;
}

// Autentikasi pengguna
if (authenticate($email, $password, $users)) {
    // Set session jika login berhasil
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    
    // Redirect ke halaman dashboard atau halaman utama setelah login
    header("Location: dashboard.php");
    exit;
} else {
    // Jika gagal login, kembalikan ke halaman login dengan pesan kesalahan
    header("Location: login.html?error=invalid_credentials");
    exit;
}
?>

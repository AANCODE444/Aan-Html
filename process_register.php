<?php
// Mulai sesi untuk menyimpan informasi register pengguna
session_start();

// Koneksi ke database (sesuaikan dengan detail koneksi Anda)
$host = 'localhost';
$dbname = 'nama_database'; // Ganti dengan nama database Anda
$username = 'root';        // Ganti dengan username database Anda
$password = '';            // Ganti dengan password database Anda

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode ke exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}

// Ambil data dari form pendaftaran
$name = $_POST['name'];
$email = $_POST['email'];
$plain_password = $_POST['password'];

// Hash password untuk keamanan
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Periksa apakah email sudah terdaftar
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->rowCount() > 0) {
    // Jika email sudah terdaftar, kembalikan ke halaman register dengan pesan kesalahan
    header("Location: register.html?error=email_exists");
    exit;
}

// Jika email belum terdaftar, simpan data pengguna ke database
$stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
if ($stmt->execute([$name, $email, $hashed_password])) {
    // Jika pendaftaran berhasil, set session dan arahkan ke halaman login atau dashboard
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header("Location: dashboard.php");
    exit;
} else {
    // Jika terjadi kesalahan, kembalikan ke halaman register
    header("Location: register.html?error=registration_failed");
    exit;
}
?>

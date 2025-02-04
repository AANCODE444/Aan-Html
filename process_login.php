<?php
// Sambungkan ke database
$host = 'localhost';
$user = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda
$dbname = 'smm_global_dunia'; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$email = $_POST['email'];
$password = $_POST['password'];

// Periksa apakah email terdaftar
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Periksa password
    if (password_verify($password, $row['password'])) {
        // Mulai sesi
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        header("Location: index.html"); // Arahkan ke halaman utama
        exit();
    } else {
        echo "Password salah! <a href='login.html'>Coba lagi</a>";
    }
} else {
    echo "Email tidak terdaftar! <a href='register.html'>Daftar di sini</a>";
}

$conn->close();
?>

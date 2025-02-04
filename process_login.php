<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the posted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Dummy validation for the email and password (replace with real DB validation)
    // For now, we check if the email and password match a predefined value
    $valid_email = "user@example.com"; // Replace with real email
    $valid_password = "password123"; // Replace with real password (hashed ideally)

    if ($email === $valid_email && $password === $valid_password) {
        // Login successful, create session
        $_SESSION['user'] = $email;
        header("Location: dashboard.php"); // Redirect to the dashboard or logged-in area
        exit();
    } else {
        // Invalid credentials, show an error message
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - SMM Global Dunia</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 90%;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
      color: #3498db;
    }

    input[type="email"], input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      background: #3498db;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background: #2980b9;
    }

    .register-link {
      margin-top: 10px;
      display: block;
      color: #555;
      text-decoration: none;
    }

    .register-link:hover {
      text-decoration: underline;
    }

    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <?php if (isset($error_message)): ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="process_login.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <a href="register.html" class="register-link">Belum punya akun? Daftar di sini</a>
  </div>
</body>
</html>

<?php
session_start();
include 'config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check_user_query = "SELECT * FROM User WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($check_user_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];
        header('location: index.php');
    } else {
        echo "Thông tin đăng nhập không chính xác";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        width: 300px;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-container form {
        width: 100%;
    }

    .login-container label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .login-container input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .login-container input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form action="login.php" method="POST">
            <label for="username">Tên đăng nhập:</label><br>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Mật khẩu:</label><br>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Đăng nhập">
        </form>
    </div>
</body>

</html>
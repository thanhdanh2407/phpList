<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location: login.php');
    exit();
}

include 'config/connect.php';

if (isset($_POST['submit'])) {

    $ma_nv = $_POST['ma_nv'];
    $ten_nv = $_POST['ten_nv'];
    $phai = $_POST['phai'];
    $noi_sinh = $_POST['noi_sinh'];
    $ma_phong = $_POST['ma_phong'];
    $luong = $_POST['luong'];


    $sql = "INSERT INTO NHANVIEN (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong)
            VALUES ('$ma_nv', '$ten_nv', '$phai', '$noi_sinh', '$ma_phong', $luong)";

    if ($conn->query($sql) === TRUE) {
        header('location: index.php');
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Nhân Viên Mới</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .container {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    form {
        width: 100%;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>Thêm Nhân Viên Mới</h1>
        <form action="" method="POST">
            <label for="ma_nv">Mã Nhân Viên:</label>
            <input type="text" id="ma_nv" name="ma_nv">

            <label for="ten_nv">Tên Nhân Viên:</label>
            <input type="text" id="ten_nv" name="ten_nv">

            <label for="phai">Giới Tính:</label>
            <input type="text" id="phai" name="phai">

            <label for="noi_sinh">Nơi Sinh:</label>
            <input type="text" id="noi_sinh" name="noi_sinh">

            <label for="ma_phong">Mã Phòng:</label>
            <input type="text" id="ma_phong" name="ma_phong">

            <label for="luong">Lương:</label>
            <input type="text" id="luong" name="luong">

            <input type="submit" name="submit" value="Thêm Nhân Viên">
        </form>
    </div>
</body>

</html>
<?php
session_start();


if (!isset($_SESSION['username'])) {

    header('location: login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Quản lý nhân viên</title>
    <style>
    header {
        background-color: #333;
        color: #fff;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    h1 {
        font-size: 20px;
        margin: 0 auto;
        width: fit-content;
        text-align: center;
    }


    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #ddd;
        font-size: 30px;
    }

    h2 {
        color: black;
    }

    p {
        margin: 10px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        width: 30px;
        height: 30px;
        vertical-align: middle;
    }

    form {
        margin-bottom: 20px;
    }

    .btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        font-size: 16px;
        text-decoration: none;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .btn-logout {
        background-color: #f44336;
    }

    .btn-logout:hover {
        background-color: #d32f2f;
    }

    .btn-add {
        background-color: #008CBA;
    }

    .btn-add:hover {
        background-color: #007bb3;
    }
    </style>
</head>

<body>
    <header>
        <h1>Quản lý nhân viên</h1>
        <form action="" method="POST">
            <input type="submit" name="logout" value="Đăng xuất" class="btn btn-logout">
        </form>
    </header>

    <div class="container">
        <h2>THÔNG TIN NHÂN VIÊN</h2>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <a href="addUser.php" class="btn btn-add">Thêm nhân viên mới</a>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Mã Nhân Viên</th>
                    <th>Tên Nhân Viên</th>
                    <th>Giới tính</th>
                    <th>Nơi Sinh</th>
                    <th>Tên Phòng</th>
                    <th>Lương</th>
                    <?php
                    if ($_SESSION['role'] == 'admin') {
                        echo '<th>Thao tác</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
        include 'config/connect.php';

        $results_per_page = 5;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        $start_from = ($page - 1) * $results_per_page;

        $sql = "SELECT NHANVIEN.Ma_NV, Ten_NV, Phai, Noi_Sinh, Ten_Phong, Luong
                FROM NHANVIEN
                JOIN PHONGBAN ON NHANVIEN.Ma_Phong = PHONGBAN.Ma_Phong
                LIMIT $start_from, $results_per_page";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Ma_NV'] . "</td>";
                echo "<td>" . $row['Ten_NV'] . "</td>";
                echo "<td>";
                if ($row['Phai'] == 'NU') {
                    echo '<img src="images/woman.png" alt="Woman">';
                } else {
                    echo '<img src="images/man.png" alt="Man">';
                }
                echo "</td>";
                echo "<td>" . $row['Noi_Sinh'] . "</td>";
                echo "<td>" . $row['Ten_Phong'] . "</td>";
                echo "<td>" . $row['Luong'] . "</td>";
                if ($_SESSION['role'] == 'admin') {
                    echo '<td><a href="editUser.php?id=' . $row['Ma_NV'] . '"><i class="fas fa-edit" style="color: #BBBBBB;"></i></a> | <a href="deleteUser.php?id=' . $row['Ma_NV'] . '"><i class="fas fa-trash-alt" style="color: #BBBBBB;"></i></a></td>';
                }
                echo "</tr>";
            }
        } else {
            echo "Không có dữ liệu.";
        }

        $conn->close();
        ?>
            </tbody>
        </table>

        <?php
            include 'nextpage.php';
        ?>
    </div>
</body>

</html>
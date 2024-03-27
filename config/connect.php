<?php

$servername = "localhost";
$username = "root";
$password = null;
$dbname = "ql_nhansu";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}
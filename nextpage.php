<?php
include 'config/connect.php';

$sql = "SELECT COUNT(*) AS total FROM NHANVIEN";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / 5);

echo "<div style='text-align: center; margin-top: 10px;'>";

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='index.php?page=".$i."' style='margin-right: 5px;'><button style='padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px;'>".$i."</button></a>";
}

echo "</div>";
$conn->close();
?>
<?php
include('connect.php');

$id = $_GET['id'];

// xóa tồn kho của sản phẩm
$sql1 = "DELETE FROM ton_kho WHERE san_pham_id = $id";
mysqli_query($conn, $sql1);

// Xóa sản phẩm
$sql2 = "DELETE FROM san_pham WHERE id = $id";
mysqli_query($conn, $sql2);

header('Location: index.php?page_layout=quanlysanpham');
exit;
?>

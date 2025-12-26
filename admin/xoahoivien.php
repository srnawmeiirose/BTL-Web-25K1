<?php 
include('connect.php');
$id = $_GET["id"];

$sql1 = "DELETE FROM dang_ky WHERE nguoi_dung_id = $id";
mysqli_query($conn, $sql1);

$sql2 = "DELETE FROM nguoi_dung WHERE id = $id";
mysqli_query($conn, $sql2);

header('Location:index.php?page_layout=thongtinhoivien');
?>

<?php
include 'connect.php';

$id = (int)$_GET['id'];

// Lấy thông tin người dùng
$sql = "SELECT 
    nd.id,
    nd.tai_khoan,
    nd.ho_ten,
    nd.sdt,
    nd.email,
    nd.dia_chi,
    nd.ngay_sinh,
    nd.gioi_tinh
FROM nguoi_dung nd
WHERE nd.id = $id";

$result = mysqli_query($conn, $sql);
$nguoiDung = mysqli_fetch_assoc($result);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten      = $_POST['ten-hv'] ?? '';
    $sdt      = $_POST['so-dt'] ?? '';
    $email    = $_POST['email'] ?? null;
    $diaChi   = $_POST['dia-chi'] ?? null;
    $ngaySinh = $_POST['ngay-sinh'] ?? null;
    $gioiTinh = $_POST['gtinh'] ?? null;

    // Validate số điện thoại
    if (!preg_match('/^[0-9]{10}$/', $sdt)) {
        $errors[] = "Số điện thoại phải đúng 10 chữ số!";
    }

    // Kiểm tra trùng số điện thoại
    $sqlCheck = "SELECT id FROM nguoi_dung WHERE sdt='$sdt' AND id != $id";
    $check = mysqli_query($conn, $sqlCheck);
    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Số điện thoại đã tồn tại!";
    }

    if (empty($errors)) {
        // Update bảng nguoi_dung
        $sqlNguoiDung = "
        UPDATE nguoi_dung SET
            ho_ten = '$ten',
            sdt = '$sdt',
            email = " . ($email ? "'$email'" : "NULL") . ",
            dia_chi = " . ($diaChi ? "'$diaChi'" : "NULL") . ",
            ngay_sinh = " . ($ngaySinh ? "'$ngaySinh'" : "NULL") . ",
            gioi_tinh = " . ($gioiTinh ? "'$gioiTinh'" : "NULL") . "
        WHERE id = $id
        ";
        mysqli_query($conn, $sqlNguoiDung);

        header('Location: index.php?page_layout=thongtinnguoidung');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Cập nhật thông tin người dùng</title>
  <style>
    body { background:#000; font-family:Arial,sans-serif; }
    .container-sua { width:50%; margin:40px auto; padding:30px; background:#3a3a3a; border-radius:12px; }
    .container-sua h1 { text-align:center; font-size:28px; color:#fff; margin-bottom:25px; }
    .box { margin-bottom:18px; }
    .box p { margin:0 0 6px 0; font-size:15px; color:#fff; }
    input, select { width:95%; padding:11px 12px; border:1px solid #666; border-radius:6px; font-size:15px; background:#4a4a4a; color:#fff; }
    input[readonly] { background:#555; cursor:not-allowed; }
    input[type="submit"] { width:100%; padding:12px; background:#e60000; color:#fff; font-size:16px; border:none; border-radius:6px; cursor:pointer; }
    input[type="submit"]:hover { background:#cc0000; }
  </style>
</head>
<body>
<?php if (!empty($errors)) { ?>
  <script>alert("<?php echo implode('\n', $errors); ?>");</script>
<?php } ?>
<div class="container-sua">
  <h1>Cập nhật thông tin người dùng</h1>
  <form action="index.php?page_layout=capnhatthongtinnguoidung&id=<?php echo $id ?>" method="post">
    <div class="box"><p>Tài khoản</p><input type="text" value="<?php echo $nguoiDung['tai_khoan'] ?>" readonly></div>
    <div class="box"><p>Họ và tên</p><input name="ten-hv" type="text" value="<?php echo $nguoiDung['ho_ten'] ?>"></div>
    <div class="box"><p>Số điện thoại</p><input name="so-dt" type="text" value="<?php echo $nguoiDung['sdt'] ?>" maxlength="10" pattern="[0-9]{10}" required></div>
    <div class="box"><p>Email</p><input name="email" type="text" value="<?php echo $nguoiDung['email'] ?>"></div>
    <div class="box"><p>Địa chỉ</p><input name="dia-chi" type="text" value="<?php echo $nguoiDung['dia_chi'] ?>"></div>
    <div class="box"><p>Ngày sinh</p><input name="ngay-sinh" type="date" value="<?php echo $nguoiDung['ngay_sinh'] ?>"></div>
    <div class="box"><p>Giới tính</p>
      <select name="gtinh">
        <option value="nam"  <?php if($nguoiDung['gioi_tinh']=='nam') echo 'selected'; ?>>Nam</option>
        <option value="nu"   <?php if($nguoiDung['gioi_tinh']=='nu') echo 'selected'; ?>>Nữ</option>
        <option value="khac" <?php if($nguoiDung['gioi_tinh']=='khac') echo 'selected'; ?>>Khác</option>
      </select>
    </div>
    <div class="box"><input type="submit" value="Cập nhật"></div>
  </form>
</div>
</body>
</html>

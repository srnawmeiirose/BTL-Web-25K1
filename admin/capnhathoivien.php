<?php
include 'connect.php';

$id = $_GET['id'];
$sql = "SELECT 
    nd.id,
    nd.ho_ten,
    nd.sdt,
    nd.email,
    nd.dia_chi,
    nd.ngay_sinh,
    nd.gioi_tinh,
    dk.goi_tap_id,
    dk.ngay_dang_ky,
    dk.ngay_bat_dau,
    dk.ngay_het_han,
    dk.trang_thai
FROM nguoi_dung nd
JOIN dang_ky dk ON nd.id = dk.nguoi_dung_id
WHERE nd.id = $id";

    $result = mysqli_query($conn, $sql);
    $nguoiDung = mysqli_fetch_assoc($result);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ten = $_POST['ten-hv'] ?? '';
    $sdt = $_POST['so-dt'] ?? '';
    $email = $_POST['email'] ?? null;
    $diaChi = $_POST['dia-chi'] ?? null;
    $ngaySinh = $_POST['ngay-sinh'] ?? null;
    $gioiTinh = $_POST['gtinh'] ?? null;
    $goiTap = $_POST['goi-tap'] ?? '';
    $ngayDangKy = $_POST['ngay-dky'] ?? '';
    $ngayBatDau = $_POST['ngay-bd'] ?? '';
    $ngayHetHan = $_POST['ngay-hh'] ?? '';
    $trangThai = $_POST['tthai'] ?? 'con_han';

    // 1. Validate SĐT
    if (!preg_match('/^[0-9]{10}$/', $sdt)) {
        $errors[] = "Số điện thoại phải đúng 10 chữ số!";
    }

    // 2. Check trùng
    $sql1= "SELECT id FROM nguoi_dung WHERE sdt='$sdt' AND id != $id";
    $check = mysqli_query($conn,$sql1);
    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Số điện thoại đã tồn tại!";
    }

    // 3. Nếu KHÔNG lỗi → INSERT
    if (empty($errors)) {

        $taiKhoan = 'hv_' . time();
        $matKhau  = password_hash('123456', PASSWORD_DEFAULT);
        $vaiTroId = 2;

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
        $nguoiDungId = mysqli_insert_id($conn);

        $sqlDangKy = "
        UPDATE dang_ky SET
                goi_tap_id = $goiTap,
                ngay_dang_ky = '$ngayDangKy',
                ngay_bat_dau = '$ngayBatDau',
                ngay_het_han = '$ngayHetHan',
                trang_thai = '$trangThai'
            WHERE nguoi_dung_id = $id
        ";

        mysqli_query($conn, $sqlDangKy);

        header('location:index.php?page_layout=thongtinhoivien');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      body {
    background: #000;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

/* KHỐI FORM */
.container-sua {
    width: 50%;
    margin: 40px auto;
    padding: 30px;
    background: #3a3a3a;
    border-radius: 12px;
}

/* TIÊU ĐỀ */
.container-sua h1 {
    text-align: center;
    font-size: 28px;
    color: #fff;
    margin-bottom: 25px;
}

/* MỖI DÒNG INPUT */
.box {
    margin-bottom: 18px;
}

.box p {
    margin: 0 0 6px 0;
    font-size: 15px;
    color: #fff;
}

/* INPUT + SELECT */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
input[type="date"],
select {
    width: 95%;
    padding: 11px 12px;
    border: 1px solid #666;
    border-radius: 6px;
    font-size: 15px;
    background: #4a4a4a;
    color: #fff;
}

/* FOCUS */
input:focus,
select:focus {
    outline: none;
    border-color: #ff5f8f;
    background: #555;
}

/* NÚT SUBMIT */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #ff5f8f;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #ff3f7f;
}

/* ALERT (JS) */
.warning {
    text-align: center;
    color: #ff5f8f;
    font-weight: bold;
    margin-top: 15px;
}

    </style>
  </head>
  <body>

    <?php if (!empty($errors)) { ?>
<script>
    alert("<?php echo implode('\n', $errors); ?>");
</script>
<?php } ?>

    <div class="container-sua">
      <h1>Cập nhật hội viên</h1>
      <div>
        <form action="index.php?page_layout=capnhathoivien&id=<?php echo $id ?>" method="post">
          <div class="box">
            <p>Họ và tên</p>
            <input name="ten-hv" type="text" placeholder="Tên hội viên" value="<?php echo $nguoiDung['ho_ten'] ?> " />
          </div>
          <div class="box">
            <p>Số điện thoại</p>
            <input name="so-dt" type="text" placeholder="Số điện thoại" value="<?php echo $nguoiDung['sdt'] ?>" maxlength="10" pattern="[0-9]{10}" title="Số điện thoại phải đúng 10 chữ số" required/>
          </div>
          <div class="box">
            <p>Email</p>
            <input name="email" type="text" placeholder="Email" value="<?php echo $nguoiDung['email'] ?> "/>
          </div>
          <div class="box">
            <p>Địa chỉ</p>
            <input name="dia-chi" type="text" placeholder="Địa chỉ" value="<?php echo $nguoiDung['dia_chi'] ?>" />
          </div>
          <div class="box">
            <p>Ngày sinh</p>
            <input name="ngay-sinh" type="date" value="<?php echo $nguoiDung['ngay_sinh'] ?>" />
          </div>
          <div class="box">
            <p>Giới tính</p>
            <select name="gtinh">
              <option value="nam" <?php echo $nguoiDung['gioi_tinh'] == 'nam' ? "selected" : "" ?> >Nam</option>
              <option value="nu" <?php echo $nguoiDung['gioi_tinh'] == 'nu' ? "selected" : "" ?> >Nữ</option>
              <option value="khac" <?php echo $nguoiDung['gioi_tinh'] == 'khac' ? "selected" : "" ?> >Khác</option>
            </select>
          </div>
          <div class="box">
            <p>Gói tập</p>
            <select name="goi-tap">
                <option value="1" <?php echo $nguoiDung['goi_tap_id'] == '1' ? "selected" : "" ?> >Gói ngày</option>
                <option value="2" <?php echo $nguoiDung['goi_tap_id'] == '2' ? "selected" : "" ?> >Gói tuần</option>
                <option value="3" <?php echo $nguoiDung['goi_tap_id'] == '3' ? "selected" : "" ?> >Gói tháng</option>
                <option value="4" <?php echo $nguoiDung['goi_tap_id'] == '4' ? "selected" : "" ?> >Gói năm</option>
            </select>
          </div>
          <div class="box"> 
            <p>Ngày đăng ký</p>
            <input name="ngay-dky" type="date" value="<?php echo $nguoiDung['ngay_dang_ky'] ?>" />
          </div>
          <div class="box">
            <p>Ngày bắt đầu</p>
            <input name="ngay-bd" type="date" value="<?php echo $nguoiDung['ngay_bat_dau'] ?>" />
          </div>
          <div class="box">
            <p>Ngày hết hạn</p>
            <input name="ngay-hh" type="date" value="<?php echo $nguoiDung['ngay_het_han'] ?>" />
          </div>
          <div class="box">
            <p>Trạng thái</p>
            <select name="tthai">
              <option value="con_han" <?php echo $nguoiDung['trang_thai'] == 'con_han' ? "selected" : "" ?> >Còn hạn</option>
              <option value="het_han" <?php echo $nguoiDung['trang_thai'] == 'het_han' ? "selected" : "" ?> >Hết hạn</option>
            </select>
          <div class="box">
            <input type="submit" value="Cập nhật" />
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>

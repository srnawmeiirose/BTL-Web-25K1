<?php
include 'connect.php';

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
    $check = mysqli_query($conn, "SELECT id FROM nguoi_dung WHERE sdt = '$sdt'");
    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Số điện thoại đã tồn tại!";
    }

    // 3. Nếu KHÔNG lỗi → INSERT
    if (empty($errors)) {

        $taiKhoan = 'hv_' . time();
        $matKhau  = password_hash('123456', PASSWORD_DEFAULT);
        $vaiTroId = 2;

        $sqlNguoiDung = "
        INSERT INTO nguoi_dung
        (tai_khoan, mat_khau, ho_ten, sdt, email, dia_chi, ngay_sinh, gioi_tinh, vai_tro_id)
        VALUES
        ('$taiKhoan', '$matKhau', '$ten', '$sdt',
         " . ($email ? "'$email'" : "NULL") . ",
         " . ($diaChi ? "'$diaChi'" : "NULL") . ",
         " . ($ngaySinh ? "'$ngaySinh'" : "NULL") . ",
         " . ($gioiTinh ? "'$gioiTinh'" : "NULL") . ",
         $vaiTroId)
        ";

        mysqli_query($conn, $sqlNguoiDung);
        $nguoiDungId = mysqli_insert_id($conn);

        $sqlDangKy = "
        INSERT INTO dang_ky
        (nguoi_dung_id, goi_tap_id, ngay_dang_ky, ngay_bat_dau, ngay_het_han, trang_thai)
        VALUES
        ($nguoiDungId, $goiTap, '$ngayDangKy', '$ngayBatDau', '$ngayHetHan', '$trangThai')
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
.container-them {
    width: 50%;
    margin: 40px auto;
    padding: 30px;
    background: #3a3a3a;
    border-radius: 12px;
}

/* TIÊU ĐỀ */
.container-them h1 {
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
    border-color: #e60000;
    background: #555;
}

/* NÚT SUBMIT */
input[type="submit"] {
    width: 100%;
    padding: 12px;
    background: #e60000;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #e60000;
}

/* ALERT (JS) */
.warning {
    text-align: center;
    color: #e60000;
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

    <div class="container-them">
      <h1>Thêm hội viên</h1>
      <div>
        <form action="index.php?page_layout=themhoivien" method="post">
          <div class="box">
            <p>Họ và tên</p>
            <input name="ten-hv" type="text" placeholder="Tên hội viên" value="<?php echo $_POST['ten-hv'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Số điện thoại</p>
            <input name="so-dt"type="text"placeholder="Số điện thoại" maxlength="10" pattern="[0-9]{10}"title="Số điện thoại phải đúng 10 chữ số" required/>
          </div>
          <div class="box">
            <p>Email</p>
            <input name="email" type="text" placeholder="Email" value="<?php echo $_POST['email'] ?? '' ?>"/>
          </div>
          <div class="box">
            <p>Địa chỉ</p>
            <input name="dia-chi" type="text" placeholder="Địa chỉ" value="<?php echo $_POST['dia-chi'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Ngày sinh</p>
            <input name="ngay-sinh" type="date" value="<?php echo $_POST['ngay-sinh'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Giới tính</p>
            <select name="gtinh">
              <option value="nam" <?php if(($_POST['gtinh'] ?? '')=='nam') echo 'selected'; ?> >Nam</option>
              <option value="nu" <?php if(($_POST['gtinh'] ?? '')=='nu') echo 'selected'; ?> >Nữ</option>
              <option value="khac" <?php if(($_POST['gtinh'] ?? '')=='khac') echo 'selected'; ?> >Khác</option>
            </select>
          </div>
          <div class="box">
            <p>Gói tập</p>
            <select name="goi-tap">
                <option value="1" <?php if(($_POST['goi-tap'] ?? '')=='1') echo 'selected'; ?> >Gói ngày</option>
                <option value="2" <?php if(($_POST['goi-tap'] ?? '')=='2') echo 'selected'; ?> >Gói tuần</option>
                <option value="3" <?php if(($_POST['goi-tap'] ?? '')=='3') echo 'selected'; ?> >Gói tháng</option>
                <option value="4" <?php if(($_POST['goi-tap'] ?? '')=='4') echo 'selected'; ?> >Gói năm</option>
            </select>
          </div>
          <div class="box">
            <p>Ngày đăng ký</p>
            <input name="ngay-dky" type="date" value="<?php echo $_POST['ngay-dky'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Ngày bắt đầu</p>
            <input name="ngay-bd" type="date" value="<?php echo $_POST['ngay-bd'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Ngày hết hạn</p>
            <input name="ngay-hh" type="date" value="<?php echo $_POST['ngay-hh'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Trạng thái</p>
            <select name="tthai">
              <option value="con_han">Còn hạn</option>
              <option value="het_han">Hết hạn</option>
            </select>
          <div class="box">
            <input type="submit" value="Thêm mới" />
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>

<?php
include 'connect.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tenSP     = $_POST['ten-sp'] ?? '';
    $loaiSP    = $_POST['loai-sp'] ?? '';
    $giaBan    = $_POST['gia'] ?? 0;
    $moTa      = $_POST['mo-ta'] ?? '';
    $hinhAnh   = $_POST['hinh-anh'] ?? '';
    $trangThai = $_POST['tthai'] ?? 'con_hang';
    $soLuong   = $_POST['so-luong'] ?? 0;

    // 1. Insert sản phẩm
    $sqlSanPham = "
        INSERT INTO san_pham
        (ten_san_pham, gia, mo_ta, hinh_anh, loai_san_pham_id, trang_thai)
        VALUES
        ('$tenSP', $giaBan, '$moTa', '$hinhAnh', $loaiSP, '$trangThai')
    ";

    mysqli_query($conn, $sqlSanPham);

    // 2. Lấy ID sản phẩm vừa thêm
    $sanPhamId = mysqli_insert_id($conn);

    // 3. Insert tồn kho
    $sqlTonKho = "
        INSERT INTO ton_kho (san_pham_id, so_luong)
        VALUES ($sanPhamId, $soLuong)
    ";

    mysqli_query($conn, $sqlTonKho);

    header('Location: index.php?page_layout=quanlysanpham');
    exit;
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
        <form action="index.php?page_layout=themsanpham" method="post">
          <div class="box">
            <p>Tên sản phẩm</p>
            <input name="ten-sp" type="text" placeholder="Tên sản phẩm" value="<?php echo $_POST['ten-sp'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Loại sản phẩm</p>
            <select name="loai-sp">
                <option value="1">Thực phẩm chức năng</option>
                <option value="2">Đồ uống</option>
                <option value="3">Phụ kiện</option>
                <option value="4">Gói tập</option>
                <option value="5">Whey- BCAA</option>
            </select>

          </div>
          <div class="box">
            <p>Giá</p>
            <input name="gia" type="number" placeholder="Giá" value="<?php echo $_POST['gia'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Mô tả</p>
            <input name="mo-ta" type="text" value="<?php echo $_POST['mo-ta'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Hình ảnh</p>
            <input name="hinh-anh" type="text" value="<?php echo $_POST['hinh-anh'] ?? '' ?>" />
          </div>
          <div class="box">
            <p>Trạng thái</p>
            <select name="tthai">
              <option value="con_hang">Còn hàng</option>
              <option value="het_hang">Hết hàng</option>
            </select>
          </div>
          <div class="box">
            <p>Số lượng</p>
            <input name="so-luong" type="text" value="<?php echo $_POST['so-luong'] ?? '' ?>" />
          </div>
          <div class="box">
            <input type="submit" value="Thêm mới" />
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>

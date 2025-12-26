<?php
include 'connect.php';
$id = (int)$_GET['id'];

$sql = "
SELECT 
    sp.id,
    sp.ten_san_pham,
    sp.gia,
    sp.mo_ta,
    sp.hinh_anh,
    sp.loai_san_pham_id,
    sp.trang_thai,
    tk.so_luong
FROM san_pham sp
JOIN ton_kho tk ON sp.id = tk.san_pham_id
WHERE sp.id = $id
";

$result = mysqli_query($conn, $sql);
$sanPham = mysqli_fetch_assoc($result);


$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $tenSP     = $_POST['ten-sp'];
    $loaiSP    = (int)$_POST['loai-sp'];
    $giaBan    = (float)$_POST['gia'];
    $moTa      = $_POST['mo-ta'];
    $trangThai = $_POST['tthai'];
    $soLuong   = (int)$_POST['so-luong'];

    // Mặc định giữ ảnh cũ
    $hinhAnh = $sanPham['hinh_anh'];

    // Nếu có upload ảnh mới
    if (!empty($_FILES['fileToUpload']['name'])) {

        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // kiểm tra ảnh
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            die("File không phải là ảnh");
        }

        if ($_FILES["fileToUpload"]["size"] > 500000) {
            die("File quá lớn");
        }

        if(!in_array($imageFileType, ['jpg','jpeg','png','gif'])) {
            die("Sai định dạng ảnh");
        }

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $hinhAnh = $target_file;
        }
    }

    // Update sản phẩm
    $sqlSanPham = "
    UPDATE san_pham
    SET
        ten_san_pham = '$tenSP',
        gia = $giaBan,
        mo_ta = '$moTa',
        hinh_anh = '$hinhAnh',
        loai_san_pham_id = $loaiSP,
        trang_thai = '$trangThai'
    WHERE id = $id
    ";

    // Update tồn kho
    $sqlTonKho = "
    UPDATE ton_kho
    SET so_luong = $soLuong
    WHERE san_pham_id = $id
    ";

    mysqli_query($conn, $sqlSanPham);
    mysqli_query($conn, $sqlTonKho);

    header('Location: index.php?page_layout=quanlysanpham');
    exit;
}
$sqlLoaiSP = "SELECT id, ten_loai FROM loai_san_pham ORDER BY ten_loai";
$dsLoaiSP = mysqli_query($conn, $sqlLoaiSP);

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
      <h1>Cập nhật sản phẩm</h1>
      <div>
        <form action="index.php?page_layout=capnhatsanpham&id=<?php echo $id?>" method="post" enctype="multipart/form-data">
          <div class="box">
            <p>Tên sản phẩm</p>
            <input name="ten-sp" type="text" placeholder="Tên sản phẩm" value="<?php echo $sanPham['ten_san_pham'] ?> " />
          </div>
          <div class="box">
            <p>Loại sản phẩm</p>
            <select name="loai-sp">
                <option value="">Loại sản phẩm</option>
                <?php while($row = mysqli_fetch_assoc($dsLoaiSP)) : ?>
                    <option value="<?= $row['id'] ?>"
                        <?= $sanPham['loai_san_pham_id'] == $row['id'] ? "selected" : "" ?>>
                        <?= $row['ten_loai'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
          <div class="box">
            <p>Giá</p>
            <input name="gia" type="number" placeholder="Giá" value="<?php echo $sanPham['gia'] ?>" />
          </div>
          <div class="box">
            <p>Mô tả</p>
            <input name="mo-ta" type="text" value="<?php echo $sanPham['mo_ta'] ?>" />
          </div>
          <div class="box">
              <p>Hình ảnh</p>

              <?php if (!empty($sanPham['hinh_anh'])) { ?>
                  <img 
                      src="<?= $sanPham['hinh_anh'] ?>" 
                      width="120" 
                      style="display:block;margin-bottom:10px;border-radius:6px"
             >
             <?php } ?>

    <input type="file" name="fileToUpload">
</div>
          <div class="box">
            <p>Trạng thái</p>
            <select name="tthai">
              <option value="con_hang" <?php echo $sanPham['trang_thai'] == 'con_hang' ? "selected" : "" ?> >Còn hàng</option>
              <option value="het_hang" <?php echo $sanPham['trang_thai'] == 'het_hang' ? "selected" : "" ?> >Hết hàng</option>
            </select>
          </div>
          <div class="box">
            <p>Số lượng</p>
            <input name="so-luong" type="text" value="<?php echo $sanPham['so_luong'] ?>" />
          </div>
          <div class="box">
            <input type="submit" value="Cập nhật mới" />
          </div>
        </form>
      </div>
    </div>
    
  </body>
</html>

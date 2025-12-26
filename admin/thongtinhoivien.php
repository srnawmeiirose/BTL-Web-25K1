<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      body {
  margin: 0;
  background-color: #000;
  font-family: Arial, sans-serif;
}

/* KHỐI BAO TOÀN BỘ DANH SÁCH */
.body-hoivien {
  width: 100%;
  padding: 40px 0;
  background-color: #000;
}

/* KHỐI XÁM NỔI */
.hoivien {
  width: 90%;
  margin: 0 auto;
  background-color: #3a3a3a;
  padding: 25px;
  border-radius: 8px;
}

/* TIÊU ĐỀ */
h1 {
  text-align: center;
  margin-bottom: 25px;
  font-size: 32px;
  color: #fff;
}

/* BẢNG */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: #4a4a4a;
  color: #fff;
}

/* HEADER BẢNG */
table th {
  border: 1px solid #666;
  padding: 10px;
  font-size: 15px;
  background-color: #5a5a5a;
  color: #fff;
}

/* BODY BẢNG */
table td {
  border: 1px solid #666;
  padding: 10px;
  font-size: 15px;
  text-align: center;
}

/* NÚT SỬA */
.sua {
  padding: 6px 12px;
  background: #5bc0de;
  border-radius: 4px;
  color: #fff;
  text-decoration: none;
}

/* NÚT XÓA */
.xoa {
  padding: 6px 12px;
  background: #e74c3c;
  color: #fff;
  border-radius: 4px;
  text-decoration: none;
}

/* NHÓM NÚT */
.sua-xoa {
  display: flex;
  justify-content: center;
  gap: 8px;
}

/* NÚT THÊM / TÌM */
.them, .tim {
  color: #000;
  font-weight: bold;
}

    </style>
</head>
<body>
  <div class="body-hoivien">
    <div class="hoivien">

  <div  style="display: flex; justify-content: space-between; align-items: center;">
      <h1>Danh sách hội viên</h1>
   <div class="" style="display:flex; justify-content: flex-end; gap:10px"> 
    <a class="them" href="index.php?page_layout=themhoivien" style="padding: 10px; background-color:#e60000; border-radius: 5px">Thêm hội viên</a>
    <!-- <a class="tim" href="index.php?page_layout=timkiem" style="padding: 10px; background-color:#e60000; border-radius: 5px">Tìm kiếm</a> -->
    <form method="get" action="index.php" style="display:flex; gap:10px">
        <input type="hidden" name="page_layout" value="thongtinhoivien">
        <input type="text"  name="keyword" placeholder="Nhập tên cần tìm" value="<?= $_GET['keyword'] ?? '' ?>" style="padding:8px; border-radius:4px; border:none">
  <button 
    type="submit"
    style="padding:8px 12px; background:#e60000; color:#000; font-weight:bold; border:none; border-radius:4px; cursor:pointer"
  >
    Tìm kiếm
  </button>
</form>

  </div>
    </div>
      <table border = 1>
      <tr>
        <th>Số thứ tự</th>
        <th>Họ tên</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Địa chỉ</th>
        <th>Ngày sinh</th>
        <th>Giới tính</th>
        <th>Gói tập</th>
        <th>Ngày đăng ký</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày hết hạn</th>
        <th>Trạng thái</th>
        <th>Tùy chọn</th>
      </tr>
      <?php 
      include ("connect.php");
      $keyword = $_GET['keyword'] ?? '';
      $sql = "
SELECT 
    nd.id,
    nd.ho_ten,
    nd.sdt,
    nd.email,
    nd.dia_chi,
    nd.ngay_sinh,
    nd.gioi_tinh,
    gt.ten_goi,
    dk.ngay_dang_ky,
    dk.ngay_bat_dau,
    dk.ngay_het_han,
    dk.trang_thai
FROM nguoi_dung nd
JOIN dang_ky dk ON nd.id = dk.nguoi_dung_id
JOIN goi_tap gt ON dk.goi_tap_id = gt.id
WHERE nd.vai_tro_id = 2
";

if (!empty($keyword)) {
    $sql .= " AND nd.ho_ten LIKE '%$keyword%'";
}
      $result = mysqli_query($conn, $sql);
      $stt = 1;
      while($row = mysqli_fetch_array($result)){
      ?>
      <tr>
        <td><?php echo $stt++; ?></td>
        <td><?php echo $row["ho_ten"]?></td>
        <td><?php echo $row["sdt"]?></td>
        <td><?php echo $row["email"]?></td>
        <td><?php echo $row["dia_chi"]?></td>
        <td><?php echo $row["ngay_sinh"]?></td>
        <td><?php echo $row["gioi_tinh"]?></td>
        <td><?php echo $row["ten_goi"]?></td>
        <td><?php echo $row["ngay_dang_ky"]?></td>
        <td><?php echo $row["ngay_bat_dau"]?></td>
        <td><?php echo $row["ngay_het_han"]?></td>
        <td><?php echo $row["trang_thai"]?></td>
        <td class="sua-xoa">
          <a class = "sua" href="capnhathoivien.php?id=<?php echo $row['id']?>">Sửa thông tin</a>
          <a class = "xoa" href="xoahoivien.php?id=<?php echo $row['id']?>">Xóa hội viên</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
  </div>
</body>
</html>
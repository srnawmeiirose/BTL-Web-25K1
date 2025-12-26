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
.body-sanpham {
  width: 100%;
  padding: 40px 0;
  background-color: #000;
}

/* KHỐI XÁM NỔI */
.sanpham {
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
  <div class="body-sanpham">
    <div class="sanpham">

  <div  style="display: flex; justify-content: space-between; align-items: center;">
      <h1>Danh sách sản phẩm</h1>
   <div class="" style="display:flex; justify-content: flex-end; gap:10px"> 
    <a class="them" href="index.php?page_layout=themsanpham" style="padding: 10px; background-color:#e60000; border-radius: 5px">Thêm sản phẩm</a>
    <form method="get" action="index.php" style="display:flex; gap:10px">
        <input type="hidden" name="page_layout" value="quanlysanpham">
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
        <th>Tên sản phẩm</th>
        <th>Phân loại</th>
        <th>Giá</th>
        <th>Mô tả</th>
        <th>Hình ảnh</th>
        <th>Trạng thái</th>
        <th>Tồn kho</th>
        <th>Tùy chọn</th>
      </tr>
      <?php 
      include ("connect.php");
      $keyword = $_GET['keyword'] ?? '';
      $sql = "
SELECT 
    sp.id,
    sp.ten_san_pham,
    lsp.ten_loai,
    sp.gia,
    sp.mo_ta,
    sp.hinh_anh,
    sp.trang_thai,
    tk.so_luong
FROM san_pham sp
LEFT JOIN loai_san_pham lsp ON sp.loai_san_pham_id = lsp.id
LEFT JOIN ton_kho tk ON sp.id = tk.san_pham_id
WHERE 1
";

if (!empty($keyword)) {
    $sql .= " AND sp.ten_san_pham LIKE '%$keyword%'";
}
      $result = mysqli_query($conn, $sql);
      $stt = 1;
      while($row = mysqli_fetch_array($result)){
      ?>
      <tr>
        <td><?php echo $stt++; ?></td>
        <td><?php echo $row["ten_san_pham"]?></td>
        <td><?php echo $row["ten_loai"]?></td>
        <td><?php echo $row["gia"]?></td>
        <td><?php echo $row["mo_ta"]?></td>
        <td >  
          <img src="<?php echo $row['hinh_anh'] ?>" style=" width:100%; height:100%; object-fit:cover;border-radius:6px;">
        </td>
        <td><?php echo $row["trang_thai"]?></td>
        <td><?php echo $row["so_luong"]?></td>
        <td class="sua-xoa">
          <a class = "sua" href="capnhatsanpham.php?id=<?php echo $row['id']?>">Sửa thông tin</a>
          <a class = "xoa" href="xoasanpham.php?id=<?php echo $row['id']?>">Xóa sản phẩm</a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
  </div>
</body>
</html>
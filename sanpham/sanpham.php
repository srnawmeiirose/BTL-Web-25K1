<?php include '../connect.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>GYM - Danh mục sản phẩm</title>
    <style>
    
     body {
            font-family: Arial, sans-serif;
            background: #000;
            margin: 0;
            
        }

    
    .shop-page { 
        background-color: #000; 
        color: white; 
        padding: 30px; 
        text-align: center;
        border-bottom: 2px solid #e60000; 
        border-top: 2px solid #e60000;
    }

    .shop-page h1 {
        text-transform: uppercase;
        letter-spacing: 2px;
        margin: 0;
    }
    p{
        color: #fff;
        font-size: 20px;
        margin-top: 30px;
    }

    /* Khung tìm kiếm */
    .search-box { 
        text-align: center; 
        margin: 30px; 
    }

    .search-box input {
        padding: 10px 15px;
        width: 300px;
        background: #1a1a1a;
        border: 1px solid #333;
        color: #fff;
        border-radius: 4px;
        outline: none;
    }

    .search-box button {
        padding: 10px 20px;
        background: #e60000;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    .search-box button:hover {
        background: #b30000;
    }

    /* Tiêu đề loại sản phẩm (Whey, Phụ kiện...) */
    h2 {
        text-align: center; 
        color: #e60000 !important; 
        text-transform: uppercase;
        margin-top: 40px;
        font-weight: 800;
        margin-bottom: 20px;
    }

    /* Danh sách sản phẩm */
    .Gym-content { 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: center; 
        gap: 25px; 
        padding: 20px; 
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Card từng sản phẩm */
    .Gym-content_info { 
        background-color: #111; 
        color: white; 
        padding: 0; 
        border-radius: 12px; 
        width: 280px; 
        text-align: center; 
        overflow: hidden;
        border: 1px solid #222;
        transition: all 0.3s ease;
    }

    .Gym-content_info:hover {
        transform: translateY(-10px); 
        border-color: #e60000;
        box-shadow: 0 10px 20px rgba(230, 0, 0, 0.2);
    }

    .Gym-content_info img { 
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
        cursor: pointer;
        transition: 0.5s;
    }

    .Gym-content_info img:hover {
        opacity: 0.8;
    }

    .Gym-info {
        padding: 15px;
    }

    .Gym-info h3 {
        font-size: 18px;
        margin: 10px 0;
        height: 45px; 
        overflow: hidden;
    }

    .Gym-info p {
        color: #e60000;
        font-size: 20px;
        font-weight: bold;
        margin: 10px 0;
    }

    
</style>
</head>



<script>
// ===== HÀM XEM CHI TIẾT =====
function xemChiTiet(idSanPham) {
    for (let i = 0; i < danhSachSanPham.length; i++) {
        if (danhSachSanPham[i].id === idSanPham) {

            let sp = danhSachSanPham[i];

            alert(
                "Tên sản phẩm: " + sp.ten + "\n" +
                "Loại: " + sp.loai + "\n" +
                "Giá: " + sp.gia.toLocaleString() + " đ\n" +
                "Mô tả: " + sp.moTa
            );

            break;
        }
    }
}
</script>

<body>
  <div class="shop-page">
    <h1 style="font-size: 70px;">Danh mục mua hàng</h1>
    <p>Hãy chọn giá đúng</p>
  
    </div>
<section class="list">
    <?php

    $search = "";
    if(isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    }

    // Lấy danh sách loại sản phẩm để hiển thị theo từng mục
    $sql_loai = "SELECT * FROM loai_san_pham";
    $result_loai = mysqli_query($conn, $sql_loai);

    while($loai = mysqli_fetch_assoc($result_loai)) {
        $loai_id = $loai['id'];
        $sql_sp = "SELECT * FROM san_pham WHERE loai_san_pham_id = $loai_id";
        if($search != "") {
            $sql_sp .= " AND ten_san_pham LIKE '%$search%'";
        }
        $result_sp = mysqli_query($conn, $sql_sp);
        if(mysqli_num_rows($result_sp) > 0) {
            echo "<h2 style='text-align: center; color:black'>{$loai['ten_loai']}</h2>";
            echo "<div class='Gym-content'>";
            
            while($sp = mysqli_fetch_assoc($result_sp)) {
                ?>
                <div class="Gym-content_info">
                    <img src="../sanpham/picture/<?php echo $sp['hinh_anh']; ?>" 
                         onclick="xemChiTiet('<?php echo $sp['ten_san_pham']; ?>', '<?php echo number_format($sp['gia']); ?>', '<?php echo $sp['mo_ta']; ?>')">
                    <div cl ass="Gym-info">
                        <h3><?php echo $sp['ten_san_pham']; ?></h3>
                        <p>Giá: <?php echo number_format($sp['gia']); ?>đ</p>
                       
                    </div>
                </div>
                <?php
            }
            echo "</div>";
        }
    }
    ?>
</section>


</body>
</html>

<?php
session_start();

if (!isset($_GET['page_layout'])) {
    $_GET['page_layout'] = 'trangchu';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COR X FITNESS</title>
    <style>
      *{
  box-sizing: border-box;
  margin: 0;
  padding: 0;
  
}

body{
  background-color: #000000;
  font-family: Arial, sans-serif;
}


.header{
  width: 100%;
  background: #000;
  border-bottom: 2px solid #b30000;
}


.header_container{
  max-width: 1200px;
  height: 70px;
  margin: 0 auto;      
  padding: 0 40px;
  background-color: #000000;
  display: flex;
  align-items: center;
  justify-content: space-between;
}


.logo{
  font-size: 26px;
  font-weight: 800;
  color: #fff;
  text-decoration: none;
  white-space: nowrap;
}

.logo span{
  color: #e60000;
}


.menu{
  display: flex;
  gap: 32px;
}

.menu a{
  color: #eee;
  text-decoration: none;
  font-size: 14px;
  font-weight: 600;
  text-transform: uppercase;
  position: relative;
  transition: 0.3s;
}


.menu a::after{
  content: "";
  position: absolute;
  width: 0;
  height: 2px;
  background: #e60000;
  left: 0;
  bottom: -6px;
  transition: 0.3s;
}

.menu a:hover{
  color: #e60000;
}

.menu a:hover::after{
  width: 100%;
}


@media (max-width: 768px){
  .header__container{
    padding: 0 20px;
  }

  .menu{
    gap: 18px;
  }

  .menu a{
    font-size: 13px;
  }
}
.quanly {
  position: relative;
}

.quanly-menu {
  position: absolute;
  top: 100%;
  right: 0;
  background: #111;
  list-style: none;
  min-width: 200px;
  border-radius: 6px;
  padding: 8px 0;

  display: none; /* QUAN TRỌNG */
  z-index: 999;
}

.quanly-menu li a {
  display: block;
  padding: 10px 15px;
  color: #fff;
  text-decoration: none;
}

.quanly-menu li a:hover {
  background: gray;
}

      </style>
    
</head>
 
<body>
    <header >
    <div class="header_container">
      <a href="index.php?page_layout=trangchu" class="logo"><span>COR X </span>FITNESS</a>

  <ul class="menu">
          <li class="">
            <a class="" href="index.php?page_layout=trangchu">Trang chủ</a>
          </li>
          <li class="">
            <a class="" href="index.php?page_layout=gioithieu">Giới thiệu</a>
          </li>
          <li class="">
            <a class="" href="index.php?page_layout=goitap">Gói tập</a>
          </li>
          <li class="">
            <a class="" href="index.php?page_layout=sanpham">Sản phẩm</a>
          </li>
             <?php if (isset($_SESSION['username'])): ?>
          <li class="quanly">
              <a href="javascript:void(0)" id="quanly-btn">Xin chào, <?= $_SESSION['username'] ?> </a>
             <ul class="quanly-menu" id="quanly-menu">
              <li><a href="index.php?page_layout=thongtinnguoidung">Thông tin</a></li>
            </ul>
          </li>
        <li><a href="index.php?page_layout=logout">Đăng xuất</a></li>
      <?php else: ?>
        <li><a href="../dangnhap.php">Đăng nhập</a></li>
        <li><a href="../dangky.php">Đăng ký</a></li>
    <?php endif; ?>
        </ul>
</div>
    </header>
    <main>
<?php
switch ($_GET['page_layout']) {
    case 'gioithieu':
        include '../gioithieu/gioithieu.php';
        break;
    case 'goitap':
        include '../cacgoitap.php';
        break;
    case 'sanpham':
        include '../sanpham/sanpham.php';
        break;
        // quannguoidung
    case 'thongtinnguoidung':
        include '../thongtinnguoidung.php';
        break;
    case 'capnhatthongtinnguoidung':
        include '../capnhatthongtinnguoidung.php';
        break;
    case 'logout':
    session_unset();
    session_destroy();
    header("Location: index.php?page_layout=trangchu");
    exit;
        break;
    default:
        include 'trangchu.php';
}
?>
</main>
<script>
  const btn = document.getElementById("quanly-btn");
  const menu = document.getElementById("quanly-menu");

  // Click vào "Xin chào"
  btn.addEventListener("click", function (e) {
    e.stopPropagation(); // không lan sự kiện
    menu.style.display = 
      menu.style.display === "block" ? "none" : "block";
  });

  // Click vào menu item → ẩn menu
  menu.addEventListener("click", function () {
    menu.style.display = "none";
  });

  // Click ra ngoài → ẩn menu
  document.addEventListener("click", function () {
    menu.style.display = "none";
  });
</script>
</body>
</html>
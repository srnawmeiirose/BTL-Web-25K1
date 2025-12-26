<?php
include('connect.php');

$thongbao = "";

if (isset($_POST['tendangnhap'])
) {

    if (
        empty($_POST['tendangnhap']) ||
        empty($_POST['password']) ||
        empty($_POST['hoten']) ||
        empty($_POST['email']) ||
        empty($_POST['sdt']) ||
        empty($_POST['diachi']) ||
        empty($_POST['ngaysinh']) ||
        empty($_POST['gioitinh'])
    ) {
        $thongbao = "⚠️ Vui lòng nhập đầy đủ thông tin!";
    } else {

        $tenDangNhap = $_POST['tendangnhap'];
        $matKhau = $_POST['password'];
        $hoTen = $_POST['hoten'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $ngaySinh = $_POST['ngaysinh'];
        $gioiTinh = $_POST['gioitinh'];
        $vaiTro = 2;



        $check = "SELECT * FROM nguoi_dung WHERE tai_khoan = '$tenDangNhap' ";
        $kiemtra1 = mysqli_query($conn, $check);
        $checkemmail= "SELECT * FROM nguoi_dung WHERE email = '$email'";
        $kiemtra2= mysqli_query($conn, $checkemmail);
        $checksdt= "SELECT * FROM nguoi_dung WHERE sdt = '$sdt'";
        $kiemtra3= mysqli_query($conn, $checksdt);
        if(mysqli_num_rows($kiemtra3) > 0){
            $thongbao = "❌ Số điện thoại đã tồn tại!"; 
        }
        else
         if (mysqli_num_rows($kiemtra2) > 0) {
            $thongbao = "❌ Email đã tồn tại!";
        }
        else
        if (mysqli_num_rows($kiemtra1) > 0) {
            $thongbao = "❌ Tên đăng nhập đã tồn tại!";

        } else {
            $sql = "INSERT INTO nguoi_dung
            (tai_khoan, mat_khau, ho_ten, email, sdt, ngay_sinh, gioi_tinh, dia_chi, vai_tro_id)
            VALUES
            ('$tenDangNhap', '$matKhau', '$hoTen', '$email', '$sdt', '$ngaySinh', '$gioiTinh', '$diachi', '$vaiTro')";
            
            mysqli_query($conn, $sql);
            header("Location: dangnhap.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            body {
                background:#000;
                     margin:0;
                    min-height:100vh;
                    display:flex;
                    justify-content:center;
                
                    font-family: Arial, sans-serif;
            }
            .container{
                display:flex;
        justify-content:center;
                align-items:center;
                
            }
            
                .container-khung{
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    flex-direction:column;

                }
        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1{
            text-align:center;
            color:white;
        }
        .form{
            margin-bottom: 15px;
            display:flex;
            justify-content:center;
            
        }
        .thongtin{
            padding: 10px;
            width: 80%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .submit{
            padding: 10px 20px;
            display:flex;
            justify-content:center;
            
        }
        .dangky{
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            background-color: #c21b1bff;
            color: white;
        }
        .gioitinh{
            padding: 10px;
            width: 85%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .thongbao {
    width: 80%;
    margin: 10px auto;
    padding: 10px;
    background: #ffe5e5;
    border: 1px solid red;
    color: red;
    text-align: center;
}
            .logo{
        font-size: 30px;
         font-weight: 800;
         color: #fff;
         text-decoration: none;
          white-space: nowrap;
        margin-bottom: 20px;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:5px;
        
}


.logo span{
  color: #e60000;
}


        </style>
</head>
<body>
    <div class="container-khung">
      <div class="logo-khung">
            <a href="#" class="logo"><span>COR X </span>FITNESS</a>
            </a>
        </div>
    <div class="container">
    <form action="dangky.php" method="POST">
        <h1>Đăng Ký Tài Khoản</h1>
        <?php if (!empty($thongbao)) { ?>
        <div class="thongbao">
            <?= $thongbao ?>
        </div>
    <?php } ?>

        <div class="form">
            <input class="thongtin" type="text" name="tendangnhap" placeholder="Tên Đăng Nhập">
        </div>
        <div class="form">
            <input class="thongtin" type="password" name="password" placeholder="Mật Khẩu" >
        </div>
        <div class="form">
            <input class="thongtin" type="email" name="email" placeholder="Email" >
        </div>
        <div class="form">
            <input class="thongtin" type="text" name="hoten" placeholder="Họ và Tên" >
        </div>
        <div class="form">
            <input class="thongtin" type="text" name="sdt" placeholder="Số Điện Thoại" >
        </div>
        <div class="form">
            <input class="thongtin" type="text" name="diachi" placeholder="Địa Chỉ" >
        </div>
        <div class="form">
            <input class="thongtin" type="date" name="ngaysinh" placeholder="Ngày Sinh" >
        </div>
        <div class="form">
            <select class="gioitinh" name="gioitinh">
                <option value="">Giới Tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
            </div>
        <div class="submit">
            <input class="dangky" type="submit" value="Đăng Ký">
        </div>
    </form>
    </div>
    </div>
   
</body>
</html>
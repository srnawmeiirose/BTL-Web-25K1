  <?php
session_start();
include 'connect.php';

// Nếu đã đăng nhập, kiểm tra quyền
if (isset($_SESSION['username'])) {
    $taiKhoan = $_SESSION['username'];
    $sqlCheck = "SELECT vai_tro_id FROM nguoi_dung WHERE tai_khoan='$taiKhoan'";
    $resultCheck = mysqli_query($conn, $sqlCheck);
    $rowCheck = mysqli_fetch_assoc($resultCheck);

    if ($rowCheck['vai_tro_id'] == 1) {
        header("Location: admin/index.php?page_layout=trangchu"); // quản trị viên
    } else {
        header("Location: gymfitness/index.php?page_layout=trangchu"); // admin hoặc các vai trò khác
    }
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $taiKhoan = $_POST['username'];
    $matKhau  = $_POST['password'];

    $sql = "SELECT * FROM nguoi_dung 
            WHERE tai_khoan='$taiKhoan' 
            AND mat_khau='$matKhau'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["username"] = $taiKhoan;

        // Kiểm tra quyền ngay sau khi đăng nhập
        $row = mysqli_fetch_assoc($result);
        if ($row['vai_tro_id'] == 1) {
            header("Location: admin/index.php?page_layout=trangchu"); // hội viên
        } else {
            header("Location: gymfitness/index.php?page_layout=trangchu"); // admin
        }
        
        exit();
    } else {
        $warning="⚠️ Tên đăng nhập hoặc mật khẩu không đúng!";
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
                    align-items:center;
                    font-family: Arial, sans-serif;
                }
                .container-khung{
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    flex-direction:column;

                }
                .container{
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
                margin-top: 10px;
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
                gap:20px;
                
            }
            .dangnhap, .dangky{
                padding: 10px 20px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                background-color: #c21b1bff;
                color: white;
            }
            .warning{
                color: red;
                text-align: center;
                margin-top: 10px;
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
               
    <div class="login-box">
        <form action="dangnhap.php" method="post">
            <h1>Đăng nhập</h1>
            <div class="form">
                <input class="thongtin" type="text" name="username" placeholder="Tên Đăng Nhập">
            </div>
            <div class="form">
                <input class="thongtin" type="password" name="password" placeholder="Mật Khẩu">
            </div>
            <div class="submit">
                <input class="dangnhap" type="submit" value="Đăng Nhập">
                <input class="dangky" type="button" value="Đăng Ký" onclick="location='dangky.php'">
            </div>
        </form>
           <?php if(!empty($warning)) { ?>
        <div class="warning"><?php echo $warning; ?></div>
     <?php } ?>
</div>

     

    </div>
</div>

    </body>
    </html>
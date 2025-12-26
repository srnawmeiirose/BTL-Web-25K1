<?php
session_start();
include('../connect.php');

$thongbao = "";

if (isset($_POST['dangky'])) {
    if (!isset($_SESSION['username'])) {
        echo "<script>
            let result = confirm(' Bạn cần đăng nhập để đăng ký gói tập!');
            if(result){
                window.location.href='../dangnhap.php';
            } else {
                window.location.href='../gymfitness/index.php?page_layout=trangchu';
            }
        </script>";
        exit;
    }

    $tenDangNhap = $_SESSION['username'];
    $goiTap = 'Gói Tuần';

   
    $sqlUser = "SELECT id FROM nguoi_dung WHERE tai_khoan='$tenDangNhap'";
    $resultUser = mysqli_query($conn, $sqlUser);
    $user = mysqli_fetch_assoc($resultUser);
    $nguoiDungId = $user['id'];

    
    $sqlGoi = "SELECT id, so_ngay_dung FROM goi_tap WHERE ten_goi='$goiTap'";
    $resultGoi = mysqli_query($conn, $sqlGoi);
    $goi = mysqli_fetch_assoc($resultGoi);
    $goiTapId = $goi['id'];
    $soNgay = $goi['so_ngay_dung'];

 
    $sqlCheck = "SELECT * FROM dang_ky 
                 WHERE nguoi_dung_id='$nguoiDungId' 
                   AND goi_tap_id='$goiTapId' 
                   AND trang_thai='con_han'";
    $resultCheck = mysqli_query($conn, $sqlCheck);

    if(mysqli_num_rows($resultCheck) > 0){
        $thongbao = " Bạn đã đăng ký $goiTap và gói vẫn còn hạn. Không thể đăng ký lần 2.";
    } else {
        $ngayDangKy = date('Y-m-d');
        $ngayBatDau = $ngayDangKy;
        $ngayHetHan = date('Y-m-d', strtotime("+$soNgay days"));

        $sqlInsert = "INSERT INTO dang_ky (nguoi_dung_id, goi_tap_id, ngay_dang_ky, ngay_bat_dau, ngay_het_han, trang_thai)
                      VALUES ('$nguoiDungId', '$goiTapId', '$ngayDangKy', '$ngayBatDau', '$ngayHetHan', 'con_han')";

        if(mysqli_query($conn, $sqlInsert)){
            $thongbao = " Chúc mừng $tenDangNhap, bạn đã đăng ký $goiTap thành công!";
        } else {
            $thongbao = "Lỗi khi đăng ký: " . mysqli_error($conn);
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
    <script>
<?php if(!empty($thongbao)){ ?>
    alert("<?php echo $thongbao; ?>");
    window.location.href="../gymfitness/index.php?page_layout=trangchu";
<?php } ?>
</script>

    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #000;
            margin: 0;
            padding: 20px;
        }
   .container{
            display:flex;
            justify-content:center;
            align-items:center;
            height:80vh;
            flex-direction:column;  
            gap:20px;
            width:600px;
            margin:0 auto;
            box-shadow: 0 0 10px rgba(224, 217, 217, 0.1);
    
            padding:20px;
        }

        h1{
            text-align:center;
            color:white;
        }
        p{  

            text-align:center;
            font-size:16px;
            line-height:1.6;
            color:white;
        }
        .dangky{
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            background-color: #c21b1bff;
            color: white;
            display:flex;
            justify-content:center;
            margin:0 auto;
        }
         .marquee {
    width: 100%;
    overflow: hidden;          
    padding: 8px 0;
    border-radius: 4px;
    position: relative;
}

.marquee-text {
    display: inline-block;
    white-space: nowrap;
    position: relative;
    left: 100%;               
    animation: marquee 12s linear infinite;
    color: #c21b1b;
    font-weight: 600;
    font-size: 14px;
}

@keyframes marquee {
    from {
        left: 100%;
    }
    to {
        left: -100%;
    }
}
 .container-khung{
                    display:flex;
                    justify-content:center;
                    align-items:center;
                    flex-direction:column;

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
<body>  <div class="container-khung">
            <div class="logo-khung">
            <a href="#" class="logo"><span>COR X </span>FITNESS</a>
            </div>
    <div class="container">
           <div class="marquee">
    <div class="marquee-text">
        Chào mừng bạn đến với chúng tôi – Nơi bắt đầu hành trình nâng cao sức khỏe!
    </div>
</div>
        <h1>Đăng Ký Gói Tập Tuần</h1>

<p>
    Chào mừng bạn đến với dịch vụ đăng ký gói tập của chúng tôi. Gói tập tuần là lựa chọn lý tưởng dành cho những khách hàng lần đầu
    trải nghiệm dịch vụ và mong muốn cảm nhận không gian tập luyện
    chuyên nghiệp trong thời gian ngắn.
</p>

<p>
    Trong suốt 7 ngày sử dụng, bạn có thể tự do khám phá hệ thống
    trang thiết bị hiện đại, khu vực tập đa dạng và môi trường
    tập luyện năng động, thân thiện. Đây là bước khởi đầu nhẹ nhàng giúp bạn làm quen với thói quen
    vận động, đồng thời đánh giá chất lượng dịch vụ trước khi
    đăng ký các gói tập dài hạn hơn.
</p>
           
<p>
     Hãy đăng ký ngay hôm nay để bắt đầu hành trình cải thiện sức khỏe,
            nâng cao thể lực và xây dựng lối sống năng động cùng chúng tôi.
</p>
          <form method="post">
        <input type="submit" name="dangky" value="Đăng Ký Ngay" class="dangky">
    </form>
</div>
</div>
</body>
</html>
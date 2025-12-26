<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #000;
            margin: 0;
            
        }
        .goingay, .goituan, .goithang, .goinam {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            color: white;
            padding: 20px;
        }
       
        h2 {
            color: #f9f6f6ff;
        }
        p {
            color: #fdf8f8ff;
        }
        h3 {
            color: #c21b1bff;
        }
        .dangky{
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            background-color: #c21b1bff;
            color: white;
        }
      .goi-container{
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 80%;
    min-height: 100vh;
    gap: 20px;
}

        .cacgoitap{
         display:flex;
            justify-content:space-around;
            margin-right:20px;
            width:300px;
            height:400px;
            background-color: #111;
            color:white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .page-goitap{
    background:#000;
}

.page-goitap .container-khung{
    width:100%;
}

.page-goitap .goi-container{
    display:flex;
    justify-content:space-around;
    width:80%;
    margin: 0 auto;
    padding: 80px 0;
}

        </style>
</head>
<body>
    <div class=page-goitap>
    <div class="container-khung">
      
    <div class="goi-container">
        <div class="cacgoitap">
        <div class="goingay">
            <h2>GÓI NGÀY</h2>
            <p>Gói ngày phù hợp cho những người có nhu cầu sử dụng dịch vụ trong thời gian ngắn, như du khách hoặc người dùng thử nghiệm. Với gói này, bạn sẽ được truy cập đầy đủ các tính năng của dịch vụ trong vòng 24 giờ kể từ thời điểm kích hoạt.</p>
            <h3>Giá: 50.000 VND</h3>
            <input class="dangky" type="button" value="Đăng Ký" onclick="location='../cacgoitap/goingay.php'">
        </div> 
    </div>
    
    <div class="cacgoitap">
        <div class="goituan">
            <h2>GÓI TUẦN</h2>
            <p>Gói tuần phù hợp cho những người muốn trải nghiệm dịch vụ trong thời gian ngắn hơn so với gói tháng. Với gói này, bạn sẽ được truy cập đầy đủ các tính năng của dịch vụ trong vòng 7 ngày kể từ thời điểm kích hoạt.</p>
            <h3>Giá: 150.000 VND</h3>
            <input class="dangky" type="button" value="Đăng Ký" onclick="location='../cacgoitap/goituan.php'">
        </div> 
        </div>
        <div class="cacgoitap">
        <div class="goithang">
            <h2>GÓI THÁNG</h2>
            <p>Gói tháng là lựa chọn lý tưởng cho những người dùng thường xuyên hoặc những ai muốn tận hưởng dịch vụ trong thời gian dài hơn. Với gói này, bạn sẽ được truy cập đầy đủ các tính năng của dịch vụ trong vòng 30 ngày kể từ thời điểm kích hoạt.</p>
            <h3>Giá: 500.000 VND</h3>
            <input class="dangky" type="button" value="Đăng Ký" onclick="location='../cacgoitap/goithang.php'">
            </div>
        </div>
        <div class="cacgoitap">
            <div class="goinam">
            <h2>GÓI NĂM</h2>
            <p>Gói năm là lựa chọn tiết kiệm nhất cho những người dùng cam kết sử dụng dịch vụ trong thời gian dài. Với gói này, bạn sẽ được truy cập đầy đủ các tính năng của dịch vụ trong vòng 365 ngày kể từ thời điểm kích hoạt.</p>
            <h3>Giá: 5.000.000 VND</h3>

            <input class="dangky" type="button" value="Đăng Ký" onclick="location='../cacgoitap/goinam.php'">
            </div>
        </div>
    
    </div>
    </div>
    </div>

</body>
</html>
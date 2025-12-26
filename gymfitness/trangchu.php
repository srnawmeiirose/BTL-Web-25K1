<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COR X FITNESS</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}


body {
  background: #000;
  font-family: Arial, sans-serif;
  color: #fff;
}


.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 40px;
}


.slogan {
  height: 70vh;
  background-image: url('./img/home.jpg');
  background-size: cover;
  background-position: center;
  display: flex;
}

.slogan .container {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.slogan h1 {
  font-size: 60px;
  font-weight: 700;
  text-transform: uppercase;
}

.slogan h1 span {
  color: #e60000;
}


.gioi-thieu {
  padding: 80px 0;
}

.noi-dung1 {
  display: flex;
}

.message1, .message2, .message3 {
  width: 33.33%;
  padding: 5px;
}

.ben-trong {
  background: #1a1a1a;
  transition: 0.3s;
}

.ben-trong:hover {
  transform: translateY(-10px);
}

.message2 .ben-trong { background: #c11325; }

.ben-trong img {
  width: 100%;
}

.title {
  padding: 30px;
  text-align: center;
}


.why-join {
  padding: 80px 0;
  text-align: center;
}

.why-image img {
  width: 100%;
  border-radius: 6px;
}


.footer {
  padding: 40px 0;
}

.footer-content {
  display: flex;
  gap: 30px;
}

.footer-box {
  flex: 1;
}

.footer-box h3 {
  color: #c11325;
  margin-bottom: 10px;
}

.contact-info li {
  margin-bottom: 10px;
}

.social a {
  display: inline-block;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  background: #c11325;
  margin-right: 5px;
  color: #fff;
}


.map {
  margin-top: 30px;
  border-radius: 8px;
  overflow: hidden;
}

.map iframe {
  width: 100%;
  height: 300px;
  border: 0;
}

ul {
  list-style: none;
}
    </style>
</head>

<body>


<div class="slogan">
  <div class="container">
    <h1 class="animate__animated animate__slideInLeft">Train <span>Hard</span></h1>
    <h1 class="animate__animated animate__slideInRight">Stay <span>Strong</span></h1>
  </div>
</div>


<div class="gioi-thieu">
  <div class="container">
    <div class="noi-dung1">
      <div class="message1">
        <div class="ben-trong">
          <img src="./img/ab1.jpg">
          <div class="title">
            <h4>Môi Trường Tập Luyện</h4>
            <p>Không gian tập luyện hiện đại, rộng rãi.</p>
          </div>
        </div>
      </div>

      <div class="message2">
        <div class="ben-trong">
          <img src="./img/ab2.jpg">
          <div class="title">
            <h4>Huấn Luyện Chuyên Nghiệp</h4>
            <p>Huấn luyện viên theo sát học viên.</p>
          </div>
        </div>
      </div>

      <div class="message3">
        <div class="ben-trong">
          <img src="./img/ab3.jpg">
          <div class="title">
            <h4>Lối Sống Khỏe Mạnh</h4>
            <p>Xây dựng lối sống tích cực.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="why-join">
  <h2>WHY JOIN US?</h2>
  <div class="why-image">
    <img src="./img/why.jpg">
  </div>
</div>


<footer class="footer">
  <div class="container">
    <div class="footer-content">

      <div class="footer-box">
        <h3>Kết nối với COR X FITNESS</h3>
        <ul class="contact-info">
          <li><i class="fa fa-map-marker"></i> 127 Cổ Nhuế, Bắc Từ Liêm, Hà Nội</li>
          <li><i class="fa fa-phone"></i> 090 123 4567</li>
          <li><i class="fa fa-envelope"></i> info@corxfitness.vn</li>
        </ul>
        <div class="social">
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-youtube-play"></i></a>
        </div>
      </div>

      
      <div class="footer-box map">
        <h3>Bản đồ phòng tập</h3>
        <iframe 
          src="https://www.google.com/maps?q=127%20C%E1%BB%95%20Nhu%E1%BA%BF,%20B%E1%BA%AFc%20T%E1%BB%AB%20Li%C3%AAm,%20H%C3%A0%20N%E1%BB%99i&output=embed"
          loading="lazy">
        </iframe>
      </div>

    </div>
  </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
  new WOW().init();
</script>

</body>
</html>

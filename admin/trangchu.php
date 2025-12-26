<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body{
  background: #000;
  font-family: Arial, sans-serif;
  max-width: 1200px;   
  margin: 0 auto;      
  padding: 0 40px;

  
  align-items: center;
  justify-content: space-between;
}


.slogan{
	height: 70vh;
	background-image: url('./img/home.jpg');
	background-size: cover;
	padding:15px;
	-webkit-display: flex;
	display: flex;
	position: relative;
}

.slogan .container{
  display: flex;
  flex-direction: column;
  justify-content: center; /* GIỮA THEO CHIỀU DỌC */
  flex-grow: 1;
}
.slogan h1{
	color:#ffffff;
	font-size:60px ;
	font-weight: 700;
	text-transform: uppercase;
	margin:0;
  align-items: center;
}


.slogan h1 span{
	color:#c11325;;
}


.slogan h1 span{
  color: #e60000;
}



.gioi-thieu{
  padding: 80px 0;
  background: #000;
}

.khung-noi-dung{
  width: 1200px;
  margin: 0 auto;
}

.noi-dung1{
  display: flex;
}

.message1,
.message2,
.message3{
  width: 33.33%;
  padding: 5px;
  
}

.ben-trong{
  background: #1a1a1a;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: 0.3s;
  width:80%;
}
.ben-trong:hover{
  transform: translateY(-10px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.4);
}

.message1 .ben-trong{
  background: #111;
}

.message2 .ben-trong{
  background: #c11325;
}

.message3 .ben-trong{
  background: #222;
}

/*ẢNH */
.ben-trong .anh img{
  width: 100%;
  display: block;
}


.ben-trong .title{
  padding: 30px;
  text-align: center;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.ben-trong .title h4{
  font-size: 20px;
  font-weight: 600;
  color: #fff;
  margin-bottom: 15px;
  text-transform: uppercase;
}

.ben-trong .title p{
  font-size: 15px;
  line-height: 22px;
  color: #ddd;
}

.why-join{
  background: #000;
  padding: 80px 0;
  text-align: center;
}

.why-header{
  max-width: 800px;
  margin: 0 auto 40px;
}

.why-header h2{
  color: #fff;
  font-size: 32px;
  letter-spacing: 2px;
  margin-bottom: 15px;
}

.why-header p{
  color: #aaa;
  font-size: 15px;
  line-height: 22px;
}

/* ảnh lớn */
.why-image{
  max-width: 1500px;
  margin: 0 auto;
  padding: 0 20px;
}

.why-image img{
  width: 100%;
  height:100%;
  display: block;
  border-radius: 6px;
}
.footer {
  background: #000; /* nền đen */
  color: #fff;
  padding: 40px 20px;
  font-family: sans-serif;
}

.footer a {
  color: #fff;
  text-decoration: none;
}

/* Flex chia 2 phần: form và info */
.footer .footer-content {
  display: flex;
  gap: 30px;
}

.footer-box {
  flex: 1;
  padding: 10px;
}

/* Form */
.footer-box form input,
.footer-box form textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 15px;
  border: 1px solid #fff;
  background: transparent;
  color: #fff;
}

.footer-box form input::placeholder,
.footer-box form textarea::placeholder {
  color: #fff;
}

.footer-box form textarea {
  height: 100px;
}

.footer-box form button {
  padding: 8px 30px;
  background: #c11325;
  color: #fff;
  border: none;
  cursor: pointer;
}

.footer-box form button:hover {
  background: none;
  border: 1px solid #fff;
}

/* Text & info */
.footer-box h3 {
  color: #c11325;
  margin-bottom: 10px;
}

.footer-box p,
.footer .contact-info li {
  margin-bottom: 10px;
}

/* Icon info */
.footer .contact-info {
  list-style: none;
  padding: 0;
  margin: 0 0 15px 0;
}

.footer .contact-info li {
  position: relative;
  padding-left: 25px;
}

.footer .contact-info li span {
  position: absolute;
  left: 0;
  top: 0;
  color: #c11325;
}

/* Social icons */
.footer .social a {
  display: inline-block;
  width: 30px;
  height: 30px;
  line-height: 30px;
  text-align: center;
  background: #c11325;
  color: #fff;
  margin-right: 5px;
  text-decoration: none;
}

.footer .social a:hover {
  background: none;
  border: 1px solid #fff;
}



        </style>

<body>
    <div class="slogan" id="home">
    
  	 <div class="container">
  	 	<h1 class="animate__animated animate__slideInLeft">Train <span>Hard</span></h1>
      <h1 class="animate__animated animate__slideInRight">Stay <span>Strong</span></h1>
  	 </div>
</div>
<div class="gioi-thieu" id="gioithieu">
  <div class="khung-noi-dung">
    <div class="noi-dung1">

      <!-- MESSAGE 1 -->
      <div class="message1">
        <div class="ben-trong">
          <div class="anh">
            <img src="./img/ab1.jpg" alt="gioi-thieu" />
          </div>
          <div class="title">
            <h4>Môi Trường Tập Luyện</h4>
            <p>
              Môi trường tập luyện tại phòng gym của chúng tôi được xây dựng theo tiêu chuẩn chuyên nghiệp,
              hiện đại và đầy cảm hứng. Không gian rộng rãi, thoáng mát cùng hệ thống máy móc tiên tiến
              giúp học viên tập trung tối đa vào từng buổi tập. Mỗi ngày đến phòng tập là một ngày bạn
              tiến gần hơn đến phiên bản tốt nhất của chính mình.
            </p>
          </div>
        </div>
      </div>
      <div class="message2">
        <div class="ben-trong">
          <div class="anh">
            <img src="./img/ab2.jpg" alt="gioi-thieu" />
          </div>
          <div class="title">
            <h4>Huấn Luyện Chuyên Nghiệp</h4>
            <p>
              Đội ngũ huấn luyện viên giàu kinh nghiệm luôn theo sát từng học viên trong suốt quá trình
              tập luyện. Giáo án được thiết kế khoa học, cá nhân hóa theo thể trạng và mục tiêu cụ thể,
              giúp bạn tập đúng – tập đủ – tập hiệu quả, hạn chế chấn thương và tối ưu kết quả.
            </p>
          </div>
        </div>
      </div>

      <div class="message3">
        <div class="ben-trong">
          <div class="anh">
            <img src="./img/ab3.jpg" alt="gioi-thieu" />
          </div>
          <div class="title">
            <h4>Xây Dựng Lối Sống Khỏe Mạnh</h4>
            <p>
              Không chỉ dừng lại ở việc tập luyện, chúng tôi hướng đến việc xây dựng cho bạn một lối sống
              lành mạnh, kỷ luật và bền vững. Mỗi buổi tập là sự kết hợp giữa thể chất và tinh thần,
              giúp bạn khỏe hơn, tự tin hơn và mạnh mẽ hơn mỗi ngày.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
      <div class="why-join">
  <div class="why-header">
    <h2>WHY JOIN US ?</h2>
    <p>
     Cộng đồng học viên đa dạng, thân thiện và đầy động lực giúp bạn không chỉ
      cải thiện thể chất mà còn duy trì tinh thần kỷ luật và sự quyết tâm trong
      suốt quá trình tập luyện.
  </div>

  <div class="why-image">
    <img src="./img/why.jpg" alt="why join us">
  </div>
</div>
<div class="lich-tap" id="lich-tap">
  <div class="khung">
    <div class="noi-dung">

      
      </div>

    </div>
  </div>
</div>
    <footer class="footer" id="contact">
    <div class="container">
      <div class="footer-content">
        <!-- Form liên hệ -->
        <div class="footer-box form">
          <h3>Liên hệ với chúng tôi</h3>
          <form>
            <input type="text" placeholder="Tên của bạn" required>
            <input type="email" placeholder="Email" required>
            <input type="tel" placeholder="Số điện thoại" required>
            <textarea placeholder="Tin nhắn của bạn" required></textarea>
            <button type="submit">Gửi tin nhắn</button>
          </form>
        </div>

        <!-- Thông tin & mạng xã hội -->
        <div class="footer-box info">
          <h3>Kết nối với COR X FITNESS</h3>
      <p>Chúng tôi mang đến cho bạn các chương trình tập luyện chuyên nghiệp, phù hợp với mọi mục tiêu: giảm mỡ, tăng cơ, tăng sức bền và cải thiện sức khỏe toàn diện.</p>
      <ul class="contact-info">
        <li><span class="fa fa-map-marker"></span> 123 Đường Thể Thao, Quận 1, TP. Hồ Chí Minh</li>
        <li><span class="fa fa-phone"></span> 090 123 4567</li>
        <li><span class="fa fa-envelope"></span> info@corxfitness.vn</li>
      </ul>
          <div class="social">
            <a href="#"><span class="fa fa-facebook"></span></a>
            <a href="#"><span class="fa fa-linkedin"></span></a>
            <a href="#"><span class="fa fa-skype"></span></a>
            <a href="#"><span class="fa fa-youtube-play"></span></a>
          </div>
          
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
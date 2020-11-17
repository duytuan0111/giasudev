<!DOCTYPE html>
<html>
<head>
   <title>Tìm Việc 365 - Tìm kiếm Việc Làm Nhanh, Làm Thêm 24h Hiệu Quả</title>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
   <meta http-equiv="content-language" itemprop="inLanguage" content="vi"/>
   <meta name="robots" content="noindex,nofollow,noodp"/>
   <meta name="description" content="Tìm việc làm với hơn 268,089 hồ sơ ứng viên tìm việc làm nhanh, việc làm thêm tại Hà Nội, Đà Nẵng, TP HCM và 60 tỉnh thành trên toàn quốc. Tìm việc làm nhanh việc làm thêm 24h hiệu quả tại Timviec365 sẽ giúp bạn tiết kiệm phần lớn thời gian và thao tác trong quá trình lựa chọn một việc làm phù hợp cho mình!"/>
   <meta name="Keywords" content="tuyển dụng, việc làm, tìm việc làm nhanh, tìm việc làm thêm, việc làm nhanh, việc làm thêm, tuyen dung, viec lam, tim viec lam nhanh, tim viec lam them, viec lam nhanh, viec lam them, hà nội, ha noi"/>
   <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no, minimal-ui"/>
   <meta property="og:site_name" content="Kênh tuyển dụng việc làm"/>
   <meta property="og:type" content="Website"/>
   <meta property="og:locale" content="vi_VN"/>
   <meta property="og:title" itemprop="name" content="Tìm Việc 365 - Tìm kiếm Việc Làm Nhanh, Làm Thêm 24h Hiệu Quả"/>
   <meta property="og:url" itemprop="url" content="https://timviec365.com.vn"/>
   <meta property="og:description" content="Tìm việc làm với hơn 268,089 hồ sơ ứng viên tìm việc làm nhanh, việc làm thêm tại Hà Nội, Đà Nẵng, TP HCM và 60 tỉnh thành trên toàn quốc. Tìm việc làm nhanh việc làm thêm 24h hiệu quả tại Timviec365 sẽ giúp bạn tiết kiệm phần lớn thời gian và thao tác trong quá trình lựa chọn một việc làm phù hợp cho mình!"/>
   <meta property="og:image" content="https://timviec365.com.vn/images/bg_fb_2.jpg"/>
   <meta name="language" content="vietnamese"/>
   <meta name="copyright" content="Copyright © 2018 by timviec365.com.vn"/>
   <meta name="abstract" content="Tìm Việc 365 - Tìm kiếm Việc Làm Nhanh, Làm Thêm 24h Hiệu Quả"/>
   <meta name="distribution" content="Global"/>
   <meta name="author" itemprop="author" content="timviec365.com.vn"/>
   <meta http-equiv="refresh" content="1800"/>
   <meta name="REVISIT-AFTER" content="1 DAYS"/>
   <link rel="canonical" href="https://timviec365.com.vn"/>
   <link href="https://timviec365.com.vn//css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link href="https://timviec365.com.vn//css/common.css?>" rel="stylesheet"/>
   <link rel="stylesheet" href="https://timviec365.com.vn//css/reponsive.css?>">  
   <meta name="google-site-verification" content="xSYu-lgbxzn4wZVpaJOp_cHRW3IiDMymW9dZxWyvdKU" />
   <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"/>
   <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=vietnamese" rel="stylesheet">
   <script src="https://timviec365.com.vn//js/jquery.min.js"></script>
   <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130208644-4"></script> -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-130208644-4');
</script>
</head>
<body>
<header class="logingenaral">
   <div class="container">
    <!-- <a class="backurl"><i class="fa fa-backurl"></i></a> -->
    <div class="logo-login">
            <a href="/">
               <img src="https://timviec365.com.vn//images/logo-new2.png" alt="Trang chủ">
            </a>
         </div>
    <a href="#" class="btnlogout" id="btnlogout" style="position: absolute;right: 15px">Thoát</a>
   </div>
</header>
<section>
<div class="container">
    <div class="formlogin frmfogotpass confirmfogot">
         <?php 
          // unset($_SESSION['UserInfo']);
          $url = base_url();
          if (isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo']) && ($_SESSION['UserInfo']['Active'] == 0 && $_SESSION['UserInfo']['Active'] !== null) && ($_SESSION['UserInfo']['UserType'] == 1)) {
              $info_user = $_SESSION['UserInfo'];
          } else {
            header("Location: $url");
            exit;
          }
        ?>
        <div class="fogotmypassword">
          <h1 style="text-align: center;">Xác thực email</h1>
            <!-- <p>Xin chào <strong></strong><br /> -->
            Để hoàn thành đăng kí tài khoản, xin vui lòng truy cập <a><?php echo $_SESSION['UserInfo']['Email']; ?></a> và làm theo hướng dẫn để xác thực email (lưu ý kiểm tra Spam/Junk). <br>
            <p>Nếu bạn chưa nhận được email xác thực, hãy bấm nút "<b>Gửi lại mail</b>" dưới đây:<br>           
            </p>
             <div class="divbtnconfirmfogotpass"><a class="btnconfirmfogotpass">Gửi lại Email</a></div>
            <br>
            <!-- <p>Tìm việc 365 xin chúc Quý khách tuyển dụng nhân tài thành công!</p> -->
            <br>
          <!--   <div>
                <ul>
                    <li>- Nếu gặp khó khăn, vui lòng liên hệ qua email:<a href="email:timviec365.com.vn@gmail.com"> timviec365.com.vn@gmail.com</a></li>
                    <li>- Hoặc qua số Hotline: <strong style="">1900633682</strong> để được hỗ trợ</li>
                </ul>
            </div> -->
        </div>
        <div class="linkregister">
            
        </div>
    </div>
</div>
<div class="clr"></div>

</body>
<script>
  jQuery(document).ready(function($) {
    var configurl = '<?php echo base_url(); ?>';
    $('.btnconfirmfogotpass').on('click', function(event) {
      var email = '<?php echo $info_user['Email']; ?>';
      $.ajax({
        url: configurl+'site/forgetmail',
        type: 'POST',
        data: {email: email},
           dataType: 'json',
           success: function (res) 
           { 
              alert('Vui lòng kiểm tra tin email để nhận mã xác thực kích hoạt tài khoản');
          },
          error: function (xhr) 
          {
            console.log(xhr);
          }
      })
    });
    $('#btnlogout').on('click', function(e) {
      e.preventDefault();
      $.ajax({
        url: configurl + "/site/logout",
        type: "POST",
        data: {},
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(reponse) {
          if (reponse.kq == true) {
            window.location.reload();
            $(location).attr('href', configulr);
          } else {
            alert(reponse.msg);
          }
        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
        }
      });

  });
  });
</script>
</html>
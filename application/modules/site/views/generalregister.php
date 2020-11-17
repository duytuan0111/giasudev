<?php 
?>
<style>
    @media (max-width: 479px) {
        .img-dkychung {
            margin-left: 27px;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px)  {
           .img-dkychung {
            margin-left: -38px;
        }
    }
</style>
<header class="logingenaral">
   <div class="container">
        <a href="<?php echo base_url() ?>" class="backurl"><i class="fa fa-backurl"></i></a>
        <div class="logo-login">
            <a href="https://timviec365.com.vn/" title="timviec365">
               <img src="<?php echo base_url(); ?>upload/images/logo-new2.png" class="img-dnchung" alt="trang chủ" style="padding: 0px 10px;">
            </a>
         </div>
        <a href="<?php echo base_url(); ?>dang-nhap-chung" class="btn btndangky">Đăng nhập</a>
   </div>
</header>
<section class="padd-0">
    <div class="container">
        <div class="formlogin">
            <div class="col-md-6 col-sm-12">
                <div class="login_user">
                    <div>
                        <img src="images/img_login_uv.png" alt="đăng ký nhà ứng viên"/> 
                    </div>
                    <ul>
                        <li>Trực tiếp liên hệ với giáo viên để hẹn lịch học</li>
                        <li>Chủ động chọn lựa giáo viên phù hợp</li>
                        <li>Hoàn toàn miễn phí
                        </li>
                    </ul>
                    <span class="btnloginuv" onclick="location='dang-ky-nguoi-dung'">Đăng ký tìm gia sư</span>
                    <!-- <a  class="supportregister" href="<?php echo base_url() ?>huong-dan-dang-ky-tk">Hướng dẫn đăng ký tìm gia sư</a> -->
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="login_ntd">
                    <div>
                        <img src="images/img-loginntd.png" alt="đăng ký nhà tuyển dụng"/>
                    </div>
                     <ul>
                        <li>Được tiếp cận với hàng ngàn học viên</li>
                        <li>Chủ động lựa chọn lớp và mức giá phù hợp</li>
                        <li>Có cơ hội được truyền đạt kiến thức của mình
                        </li>
                    </ul>
                    <span class="btnloginntd" onclick="location='dang-ky-gia-su'">Đăng ký làm gia sư</span>
                    <!-- <a class="supportregisterntd" href="<?php echo base_url() ?>huong-dan-dang-ky-gia-su">Hướng dẫn đăng ký làm gia sư</a> -->
                </div>
            </div>        
            
            <div class="linkregister">
                <span>Bạn đã có tài khoản? <a href="<?php echo base_url() ?>dang-nhap-chung">đăng nhập</a></span>
            </div>
        </div>
    </div>
</section>
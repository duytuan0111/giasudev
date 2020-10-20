<?php 
if(!empty($_SESSION['UserInfo'])){
    redirect(site_url());
}
?>
<header class="logingenaral">
   <div class="container">
    <a href="<?php echo base_url() ?>" class="backurl"><i class="fa fa-backurl"></i></a>
    <div class="logo-login">
            <a href="<?php echo base_url() ?>" title="trang chủ">
               <img src="images/logo-01.png" alt="#" style="background-color:#203043;">
            </a>
         </div>
    <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<section class="padd-0">
<div class="container">
    <div class="formlogin">
        <div class="col-md-6 col-sm-12">
            <div class="login_user">
                
                <div>
                    <img src="images/img_login_uv.png" alt="đăng nhập nhà ứng viên" > 
                </div>
                <ul>
                    <li>Trực tiếp liên hệ với giáo viên để hẹn lịch học</li>
                    <li>Chủ động chọn lựa giáo viên phù hợp</li>
                    <li>Hoàn toàn miễn phí</li>
                </ul>
                <span class="btnloginuv" onclick="location='phu-huynh-dang-nhap'">Đăng nhập tìm gia sư</span>
                <a class="supportregister" href="<?php echo base_url() ?>huong-dan-dang-nhap-tk">Hướng dẫn đăng nhập tìm gia sư</a>
            </div>    
        </div>    
        <div class="col-md-6 col-sm-12">
            <div class="login_ntd">
                <div>
                    <img src="images/img-loginntd.png" alt="đăng nhập nhà tuyển dụng">
                </div>
                 <ul>
                <li>Được tiếp cận với hàng ngàn học viên</li>
                <li>Chủ động lựa chọn lớp với mức giá phù hợp</li>
                <li>Có cơ hội được truyền đạt kiến thức của mình
                </li>
            </ul>
            <span class="btnloginntd" onclick="location='gia-su-dang-nhap'">Đăng nhập làm gia sư</span>
            <a class="supportregisterntd" href="<?php echo base_url() ?>huong-dan-dang-nhap-gia-su">Hướng dẫn đăng nhập làm gia sư</a>
            </div>
        </div>
        <div class="linkregister">
            <span>Bạn chưa có tài khoản? <a href="<?php echo base_url() ?>dang-ky-chung">đăng ký</a></span>
        </div>
    </div>
</div>
<div class="clearfix"></div>

</section>
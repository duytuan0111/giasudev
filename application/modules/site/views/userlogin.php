<header class="logingenaral">
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
   <div class="container">
    <a href="<?php echo base_url() ?>dang-nhap-chung" class="backurl"><i class="fa fa-backurl"></i></a>
    <div class="logo-login">
            <a href="https://timviec365.com.vn/" title="trang chủ">
               <img src="<?php echo base_url(); ?>upload/images/logo-new2.png" class="img-dkychung" alt="Trang chủ" style=" padding: 0px 10px;">
            </a>
         </div>
    <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<section class="padd-0">
    <div class="container">
        <div class="formloginntd">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="login_user ">
                    <div class="frmtitle">Đăng nhập tìm gia sư</div>
                    <div class="form-control" id="div_email_login">
                        <i class="fa fa-email"></i>
                        <input type="text" class="form-input" value="<?php if($_COOKIE['nameuserphp'] != '') {echo $_COOKIE['nameuserphp']; } ?>" id="useremail" name="useremail" placeholder="Nhập địa chỉ email của bạn" />
                    </div>
                    <div class="form-control" id = "div_password_login">
                        <i class="fa fa-password"></i>
                        <input type="password" value="<?php if($_COOKIE['puuserphp'] != '') {echo $_COOKIE['puuserphp'];} ?>" class="form-input" id="userpassword" name="userpassword" placeholder="Nhập mật khẩu" />
                        <i class="fa-showpass"></i>
                    </div>
                    <span class="rememberlogin"><input type="checkbox" <?php if($_COOKIE['nameuserphp'] != '') {echo 'checked';} ?>  id="rememberlogin" name="rememberlogin"/> Nhớ đăng nhập</span>
                    
                    <span class="btnloginuv phuhuynhlogin" id="phuhuynhlogin">Đăng nhập</span>
                    <a href="<?php echo base_url() ?>tk-lay-lai-mat-khau" class="forgotpass">Quên mật khẩu?</a>
                </div>   
            </div>     
            <div class="col-md-6 padd-0 col-xs-12">
                <div class="login_ntd">
                    <div class="info_loginone">
                        <span class="howto">Bạn chưa có tài khoản?</span>
                        <span class="btnregisteruv">Đăng ký</span>
                        <p>Gia sư 365 luôn đồng hành cùng bạn! Là cầu nối dạy và học Nhanh chóng - Chủ động - uy tín!</p>
                    </div>
                    <div class="info_loginone">
                        <span class="howto">Tại sao đăng ký?</span>
                        <ul>
                            <li>Trực tiếp liên hệ với giáo viên để hẹn lịch học</li>
                            <li>Chủ động chọn lựa giáo viên phù hợp</li>
                            <li>Hoàn toàn miễn phí</li>
                        </ul>
                    </div>
                </div> 
            </div>           
        </div>
    </div>
</section>
<script>
    $(document).ready(function () 
    {
        var configulr='<?php echo base_url(); ?>';
        $('.btnregisteruv').on('click',function(){
            window.location.href=configulr+'dang-ky-nguoi-dung';
        });
    });
</script>
<?php ?>
<header class="logingenaral">
   <div class="container">
    <a href="<?php echo base_url() ?>" class="backurl"><i class="fa fa-backurl"></i></a>
    <div class="logo-login">
            <a href="<?php echo base_url() ?>" title="trang chủ">
               <img src="images/logo-2.png" alt="#" style="background-color:#203043;">
            </a>
         </div>
    <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<section class="padd-0">
    <div class="container">
        <div class="formloginntd">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="login_user">
                    <div class="frmtitle">Đăng nhập tài khoản gia sư</div>
                    <div class="form-control" id = "div_email_login">
                        <i class="fa fa-email"></i>
                        <input type="text" class="form-input" id="useremail" name="useremail" placeholder="Nhập địa chỉ email của bạn" />
                    </div>
                    <div class="form-control" id = "div_password_login">
                        <i class="fa fa-password"></i>
                        <input type="password" class="form-input" id="userpassword" name="userpassword" placeholder="Nhập mật khẩu" />
                        <i class="fa-showpass"></i>
                    </div>
                    <span class="rememberlogin"><input type="checkbox" id="rememberlogin" name="rememberlogin" /> Nhớ đăng nhập</span>
                    
                    <span class="btnloginuv logininfo" id="dangnhapgiasu">Đăng nhập</span>
                    <a href="<?php echo base_url() ?>gia-su-lay-lai-mat-khau" class="forgotpass">Quên mật khẩu?</a>
                </div>   
            </div>     
            <div class="col-md-6 padd-0 col-xs-12">
                <div class="login_ntd">
                    <div class="info_loginone">
                        <span class="howto">Bạn chưa có tài khoản?</span>
                        <span class="btnregisteruv">Đăng ký</span></a>
                        <p>Gia sư 365 luôn đồng hành cùng gia sư trên con đường truyền đạt kiến thức của mình!</p>
                    </div>
                    <div class="info_loginone">
                        <span class="howto">Tại sao đăng ký?</span>
                        <ul>
                            <li>Được tiếp cận với hàng ngàn học viên</li>
                            <li>Chủ động lựa chọn lớp và mức giá phù hợp</li>
                            <li>Có cơ hội được truyền đạt kiến thức của mình</li>
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
            window.location.href=configulr+'dang-ky-gia-su';
        });
        var self=this;
    });
</script>
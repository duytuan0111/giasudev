<?php 
?>
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
        <div class="formlogin frmfogotpass">
            <div class="title"><h3>Xác nhận đổi mật khẩu</h3></div>
            <div class="note">
                <span>(<b>*</b>) Thông tin bắt buộc</b></span>  
                <input type="hidden" id="email" value="<?php echo $email ?>" />
            </div>  
            <div class="fogotemail">
                <div class="group-control">
                    <div class="col-md-12">
                        <label class="control-label required" style="float: left;">Mật khẩu mới</label>
                        <div class="form-control"><input type="password" id="password" name="password" placeholder="Nhập mật khẩu mới"/></div>
                    </div>
                    <div class="col-md-12">
                        <label class="control-label required" style="float: left;">Nhập lại mật khẩu:</label>
                        <div class="form-control"><input type="password" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu mới"/></div>          
                    </div>  

                </div>
            </div>
            <p>Vui lòng nhập mật khẩu mới.</p>
            <a class="btnforgotpassword" id="btnconfirmpass">Xác nhận</a>            
        </div>
        <div class="linkregister">
            <span>&nbsp;</span>
        </div>
    </div>
</div>
</section>
<?php $urlweb= current_url();
$CI=&get_instance();
$CI->load->model('site/site_model');
$userlogin="";
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    
    $tg=$_SESSION['UserInfo'];
    $userlogin=$tg['Balance'];
    $userid = $tg['UserId'];
    $point=$CI->site_model->getpoint($userid);
}

foreach ($point as $key ) {
    $diem += $key;
}
?>
<!-- Start Navigation -->
<style>
.activesearch {
    width: 100%;
    margin: 10px 0;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 16px;
    color: #444444;
}
@media screen and (max-width: 479px) {
    .manager-col-right .infontd .functionntd {
        float: left;
        width: 100%;
        padding-left: 63px;
    }
    .groupbtnuv {
        padding-left: 63px;
    }
    .content-right .dashboard_r span {
        width: 49%;
        margin-right: 0px;
        margin-bottom: 13px;
    }
    .updatepass .note-1 {
        font-weight: 700;
        font-style: italic;
        font-size: 12px;
        color: #5d5d5d;
        padding-left: 3%;
        margin-bottom: 2px;
        position: relative;
        top: -7px;
    }
}
@media (min-width: 768px) and (max-width: 1024px)  {
    .functionntd {
       float: right;
       width: 55%;
       padding-top: 0px;
       position: relative;
   }
    .content-right .fromdatime .form-control {
        height: 29px;
        line-height: 28px;
        box-shadow: none;
        border-radius: 0px;
        position: relative;
        padding: 3px 12px;
        width: 230px !important;
        background-color: #fff;
    }
    .dashboard_r span {
        display: inline-block;
        width: 16%;
        border: 1px solid #d5d6d7;
        border-radius: 6px;
        text-align: center;
        margin-right: 0.3px;
        line-height: 36px;
        text-transform: uppercase;
        font-size: 12px;
        color: #323232;
        font-weight: 500;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 0px;
        padding-right: 0px;
        background-color: #f0f1f3;
    }
    .updatepass .control-label {
        width: 23%;
        text-align: right;
        margin-right: 12px;
        float: left;
        margin-bottom: 0px;
        line-height: 32px;
        height: 40px;
    }
    .fieldset .btngroup {
        text-align: center;
        margin-bottom: 20px;
        padding-left: 63px;
    }

}

</style>
<header class="manager">
   <div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <div class="logo"  style="padding: 6px 0px !important;">
            <a href="<?php echo base_url(); ?>giao-vien-manager" title="#">
               <img src="<?php echo base_url(); ?>upload/images/logo-new.png" alt="Gia sư quản lý">
            </a>
            </div>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="row">
            <div class="infontd">
                <div class="infosupport" style="padding-top: 32px; padding-left: 25px;">
                   <!--  <img class="imgemployer" src="images/employersp.png">
                    <span class="chuyenvien">Chuyên viên tư vấn dành cho Gia sư</span>
                    <span><b>Ms Hải Yến - SĐT: </b><span>0977.648.623</span> <b>- Email: </b><a>yen.nguyen@gmail.com</a></span> -->
                </div>
                <div class="functionntd">
                    <a href="<?php echo base_url(); ?>"  style=" display: inline-block;margin-right: 17px;margin-bottom: 6px;"><i class="fa fa-backhome" data-toggle="tooltip" title="" data-original-title="Trở về trang chủ"></i> Trang chủ</a>
                   <!--  <a class="ndtnotify"><i class="fa fa-notify"></i>
                    <img src="images/icon-notify.png" alt="notify">
                    </a> -->
                    <!-- <span class="ntdmoney">TKC: <?php echo $userlogin; ?> vnđ <span> và <?php $diem ?> điểm</span></span> -->
                    <!-- <span class="btnntdregisterservices">Đăng ký dịch vụ</span> -->
                    <span class="btnntdaddnews" onclick="location.href='<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>'">Cập nhật hồ sơ</span>
                    <!-- <a class="btnlogout" id="btnlogout"><i class="fa fa-logout"></i> Đăng xuất</a> -->
                </div>
            </div>
            </div>
        </div>
    </div>
        
   </div>
</header>

 

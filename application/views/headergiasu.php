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

</style>
<header class="manager">
   <div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <div class="logo">
            <a href="<?php echo base_url(); ?>" title="#">
               <img src="images/logo-01.png" alt="#">
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
                    <a href="<?php echo base_url(); ?>"><i class="fa fa-backhome" data-toggle="tooltip" title="" data-original-title="Trở về trang chủ"></i></a>
                   <!--  <a class="ndtnotify"><i class="fa fa-notify"></i>
                    <img src="images/icon-notify.png" alt="notify">
                    </a> -->
                    <span class="ntdmoney">TKC: <?php echo $userlogin; ?> vnđ <span> và <?php $diem ?> điểm</span></span>
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

 

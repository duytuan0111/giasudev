<?php $urlweb= current_url();
$CI=&get_instance();
$CI->load->model('site/site_model');
if($_SESSION['UserInfo'] !=''){
  $tg=$_SESSION['UserInfo'];
  $userid=$tg['UserId'];
}
$uinfo = $CI->site_model->GetUserInfoByUserID($userid);
?>
<!-- Start Navigation -->
<style>
@media screen and (max-width: 479px) { 
a.returnhome {
    display: inline-block;
    text-align: center;
    line-height: 16px;
    color: #858585;
}
a.returnhome i {
    padding-bottom: 2px;
}
.uvactiventd label div {
    display: block;
    width: 43px;
    height: 20px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
}
.functionungvien {
    float: left;
    width: 100%;
    padding-bottom: 20px !important;
    padding-right: 66px !important;
}
.infosupport {
    float: left;
    width: 53%;
    padding-left: 73px;
}
.th_ngaymoi {
    padding-left: 3px !important;
}
.content-right .dashboard_r span {
    width: 49%;
    margin-right: 0px;
    margin-top: 7px;
}
}
@media (min-width: 768px) and (max-width: 1024px)  {
.infontd .functionungvien {
    padding-top: 21px;
    position: relative;
    width: calc(100% - 53%);
    float: right;
    text-align: right;
}
.right-uv .dashboard_r span {
    width: 23.35% !important;
    position: relative !important;
    height: 110px;
    line-height: 20px;
    display: block;
    float: left;
    margin-top: 5px;
}
.th_ngaymoi {
    padding-left: 7px !important;
}
}
</style>
<header class="manager">
   <div class="container">
   <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <div class="logo" style="padding: 6px 0px !important;">
            <a href="<?php echo base_url(); ?>phu-huynh-manager" title="#">
               <img src="<?php echo base_url(); ?>upload/images/logo-new.png" alt="Phụ huynh quản lý">
            </a>
            </div>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12" style="background-color: #fff;">
        <div class="row mrg-r-0">
            <div class="infontd">
                <div class="infosupport">
                    <div class="uvactiventd" id="uvactiventd" style="padding-top: 29px; padding-left: 16px;">                            
                        <span style="display:inline-block;float:left;margin-right:20px;">Cho phép NTD tìm kiếm:</span>
                        <label for="uvduyetsearch">
                          <input value="1"<?php if($uinfo->IsSearch==1){ ?> checked="checked"<?php } ?> type="checkbox" name="uvduyetsearch" id="uvduyetsearch" class="uvduyetsearch"/>
                          <div>
                            <span class="on">Bật</span>
                            <span class="off">Tắt</span>
                        </div>  
                        <i></i>
                    </label>                            
                </div>
                    <!-- <img class="imgemployer" src="images/uv-support.png" />
                    <span class="chuyenvien">Chuyên viên hỗ trợ, tư vấn dành cho phụ huynh, học viên</span>
                    <span><b>SĐT: </b><span>1900633682</span> <b>- Email: </b><a>yen.nguyen@gmail.com</a></span> -->
                </div>
                <div class="functionungvien">
                    <a href="<?php echo site_url() ?>" class="returnhome"><i class="fa fa-backhome" title="Trở lại trang chủ" ></i>
                    Trở lại trang chủ
                    </a>
                    <!-- <a class="uvnotify"><i class="fa fa-notify"></i>
                    <img src="images/icon-notify.png" alt="notify" />Thông báo
                    </a> -->
                    <a class="btnlogout" id="btnlogout"><i class="fa fa-logout"></i> Đăng xuất</a>
                </div>
            </div>
            </div>
        </div>
        </div>
   </div>
</header>


 

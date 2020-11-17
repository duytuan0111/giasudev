<?php 
$urlweb= current_url();
$CI=&get_instance();
$CI->load->model('site/site_model');
$lstitem=$CI->site_model->GetTeacherType(12);
$monhoc=$CI->site_model->ListSubject();
$lop=$CI->site_model->ListClass();
$quanhuyen=$CI->site_model->ListDistrict($keyfilter['place']);
$tinhthanh=$CI->site_model->ListCity();
$urlgiasu=site_url('dang-ky-chung');
$type = 3;
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $type = $tg['UserType'];
    $active = $CI ->site_model->active($tg['UserId'])->Active;
    $check = $CI ->site_model->checknews($tg['UserId']);
    if($tg['UserType']==0){
        $urlgiasu=site_url('mn-hv-dang-tin');
    }
}
if (isset($xacnhanuser) && $xacnhanuser == 1) {

} else {
   if (isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo']) && ($_SESSION['UserInfo']['Active'] == 0 &&  $_SESSION['UserInfo']['Active'] !== null) && ($_SESSION['UserInfo']['UserType'] == 0)) {
    $url_xt = base_url().'xac-thuc-tai-khoan-ntd';
    header("Location: $url_xt");
    exit;
} else if (isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo']) && ($_SESSION['UserInfo']['Active'] == 0 &&  $_SESSION['UserInfo']['Active'] !== null) && ($_SESSION['UserInfo']['UserType'] == 1)) {
    $url_xt = base_url().'xac-thuc-tai-khoan';
    header("Location: $url_xt");
    exit;
}
}
// $urlweb= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER['HTTP_HOST]$_SERVER['REQUEST_URI']";
// $urlweb = base_url().str_replace('/', '', $_SERVER['REQUEST_URI']);

// if($urlweb != $canonical)
// {
//  header("HTTP/1.1 301 Moved Permanently"); 
//  header("Location: $canonical");
//  exit();
// }
$link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$ktra = base_url()."xacnhankichhoattaikhoan";
$ktra2 = base_url()."mn-hv-dang-tin";

// require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
?>
<style>
.fb_iframe_widget iframe {
    display: inline-block;
    width: 135px !important;
}
.main_itg {
    float: left;
    width: 100%;
    height: auto;
    max-height: 1240px !important;
    margin-top: 30px;
    border: 1px solid #efefef;
    overflow-y: scroll;
}
.textwidget.lknhanh img {
    max-width: 93% !important;
    height: 135px;
}
.top_head {
    cursor: default !important;
}
.viewnow {
    display: none;
}
.item_lc:hover .giasu_logo a .viewnow{ display: block; background-color:#ffb01d}
.top_head {
    padding-top: 15px;
    padding-left: 20px;
}
.main_hd .slick-dots{
    font-size: 0;
    line-height: 0;
    display: none;
    width: 20px;
    height: 20px;
    padding: 5px;
    cursor: pointer;
    color: transparent;
    border: 0;
    outline: none;
    background: transparent;
}
 .dis-imp {
    display: none !important;
 }
 .tab-content {
    padding-top: 0px !important;
 }
 .width-fix {
    width: 212px  !important;
 }
 .live-search h4 {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 16px;
    text-decoration-line: underline;
    text-transform: uppercase;

    color: #2169A8;

 }
 .hot_place a {
    width: 100px;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 15px;
    line-height: 24px;
    /* identical to box height, or 160% */


    color: #484848;
    margin-bottom: 6px;
 }
 .hot_place_left {
    padding-right: 134px;
 }
 .border-search-right {
    border: 0.5px solid #E2E2E2;
    transform: rotate(90deg);
    width: 142px;
    display: inline-block;
    margin-top: 124px;
}
 .searchtop {
    background-image: url('<?php echo base_url(); ?>upload/images/bg-search.png');
    padding: 45px 0px !important;
 }
 #example-tabs {
    margin-bottom: 18px !important;
    border: none !important;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    /* identical to box height */


    color: #203043;
 }
.border-mid-rotate  {
    border-bottom: 1px solid #000000;
    width: 15px;
    transform: rotate(90deg);
    margin-top: 25px;
    margin-left: 38px;
    margin-right: 25px;
}
 .icon-search-header{
    display: inline-block;
    width: 18px;
    height: 22px;
    margin-top: -4px;
 }
 .searchtop .nav-tabs>li>a{
    border: none !important;
 }
 .searchtop .nav-tabs>li.active>a {
    background-color: transparent;
    border: none !important;
    border-bottom: 2px solid #FFFFFF !important;
 }
 .searchtop .nav-tabs>li>a:hover {
    background-color: #FFFFFF !important;
    border: none !important;
 }
 .tab-content {
    width: 923px;
    text-align: center;
    margin-top: 0px auto;

 }
 .banner-caption {
    margin-left: 228px;

 }
  .searchtop #findkeyjob{
    border-top-left-radius: 100px !important;
    border-bottom-left-radius: 100px !important;
 }
  .searchtop #findkeyjob1{
    border-top-left-radius: 100px !important;
    border-bottom-left-radius: 100px !important;
 }
 .btnsearch .timvieclam {
    border-top-right-radius: 100px !important;
    border-bottom-right-radius: 100px !important;
 }
 .recommend-search-header a {
    margin-right: 18px !important;
    margin-top: 11px !important;
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 15px;
    line-height: 148.69%;
    /* or 22px */


    color: #101A2B;
 }
 .live-search {
    display: none;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    width: auto !important;
    height: auto !important;
    border-radius: 10px;
 }
 .live-search-place {
   display: none;
   width: 923px; 
   background-color: #FFFFFF;
   box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
   border-radius: 10px;
 }
 .live-search-place h4 {
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 14px;
    line-height: 16px;
    text-decoration-line: underline;
    text-transform: uppercase;

    color: #2169A8;
}
#live-search2 {
    /*padding: 24px 60px 40px 50px !important; */
}
 .live-search-left {
    float: left;
    text-align: left;
    padding: 24px 0px 40px 50px;
    margin-left: -18px;
    margin-right: -25px;

 }
 .live-search-right {
    float: right;
    text-align: left;
    padding: 24px 0px 50px 0px;
    margin-right: 0px;
    margin-left: -42px;
}
 .live-search a {
    display: block;
 }
.live-search-place {
   height: auto !important;
}
.live-search-place a {
    display: block;
 }
 .live-search-place .live-search-right h4 {
    padding-left: 16px;
 }
 .live-search-place #select2-index_dia_diem_sm-container{
    border: 1px solid #00baba;
 }
 .live-search-place #select2-index_dia_diem_sm1-container {
    border: 1px solid #00baba;
}
 .live-search-place .live-search-right {
    margin-right: 97px !important;
 }
 .point-left img{
    margin-left: 5px;
 }
 /*them css sua*/
._2tga._8j9v {
    border-radius: 3px;
    font-size: 11px;
    height: 20px;
    padding: 0 0px !important;
}
 .company_logo a img {
    max-width: 100%;
    max-height: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
}
.itemnews .itemnews_l a.logouser {
    display: block;
    /* height: 75px; */
    padding: 20px 0px;
    overflow: hidden;
    max-width: 100%;
    max-height: 67%;
}
.class-img-left {
    width: 187px !important;
    height: 241px;
}
.img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    max-height: 100%;
    height: auto;
    text-align: center;
    width: 155px;
    margin: 0px auto;
}
 /*css mobile */
 @media screen and (max-width: 360px) {
#example-tabs {
    padding-left: 13px !important;
    padding-right: 2px;
}
}
 @media screen and (max-width: 479px) {
.content-seo {
    padding: 5px 15px;
}
.quanhuyenmobile {
    width: auto !important;
    height: auto !important;
}
.gt-mobile {
    margin-right: 0px !important;
}
.login-u-mobile {
    padding-left: 10px;
    margin-right: 23px;
    margin-top: 10px;
    margin-bottom: 5px;
}
.tt-batbuoc-mobile {
    display: block;
    margin-top: 6px;
    margin-right: 56px;
}
.chitietmobile {
    display: block !important;
}
.tit_hd .ir_h3 span{
     display: inline-block;
     margin-top: 22px;

}
.span_nhathan {
    display: inline !important;
}
.thongtinmobile {
    display: block !important;
    margin-bottom: 13px;
}
.thongtindesktop {
    display: none !important;
}
.tit_hd h3 span {
    line-height: 17px;
    display: inline-block;
    margin-top: 20px;
}
.detailjob-header .detailjob-info .detailjob-name a {
    display: block;
    overflow: hidden;
    white-space: normal !important;
    text-overflow: ellipsis;
    font-size: 22px;
    font-weight: 700;
    color: #203043;
}
.class-img-left {
    border: 5px solid #f5f5f5;
    width: 100% !important;
    height: 100% !important;
    float: left;
    background-color: #fbfbfb;
    padding: 24px 12px 3px 12px;
    margin-top: 17px;
    min-height: 198px;
}
.img-responsive, .thumbnail a>img, .thumbnail>img {
    display: block;
    max-width: 100%;
    max-height: 100%;
    height: auto;
    text-align: center;
    width: 155px;
    margin: 0px auto;
    margin-top: 15px;
}
.loginmenu {
    width: 46%;
    padding: 0px;
    padding-top: 10px;
}
.viewnow {
    display: block !important;
}
.itemnews_r .dadenghiday {
    display: inline-block;
    float: left;
    margin-right: 15px;
    color: #006969;
    font-weight: 700;
    padding-left: 5px;
}
.mb-border a{
    border: none !important;
    text-decoration: underline;
}
.tit_hd h3, .tit_hd h2, .tit_hd h1 {
    font-size: 16px;
    color: #2c2c2c;
    font-weight: 500;
    height: 39px;
    line-height: 18px;
    margin: 0;
    float: left;
    background: #fff;
    margin-right: 5px;
    text-transform: uppercase;
}
.main_tg .item_hd {
    margin-right: 0px;
    margin-left: 0px;
    height: 110px !important;
    width: 100%;
    padding-top: 11px;
}
#dia_diem_sm {
       width: 250px !important;
       margin-left: 0px;
}
.searchmobile .banner-caption {
    width: 100%;
    position: relative;
    display: block;
    margin-left: 0px;
}
.banner-caption {
    margin-left: 228px;
 }
.searchmobile {
    background-image: url('<?php echo base_url(); ?>upload/images/bg-mobile.png');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    background-position: center top;
    /*background-attachment: fixed;*/
    padding: 45px 0px !important;
 }
.searchmobile .nav-tabs>li.active>a  {
    color: #555;
    background-color: transparent;
    border: none;
    border-bottom: 2px solid #FFFFFF !important;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.42857143;
    border: none !important;
    border-radius: 4px 4px 0 0;
}
.banner-caption .input-group {
    padding: 0;
    display: block;
    float: left;
    width: 321px !important;
}
#findkeyjob1 {
    padding-left: 33px !important;
}
.btnsearch .timvieclam {
    width: 133px;
    color: #FFFFFF;
    text-align: center;
    display: inline-block;
    border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px !important;
    }
.live-search {
    width: 321px !important;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    padding-left: 30px;
    padding-bottom: 20px;
    text-align: left !important;
    margin-top: -2px;
    border-radius: 5px;
}
.icon-close-rec {
    display: inline-block;
    float:right;
    padding-right: 40px;
    padding-top: 5px;
}
.icon-close-rec1 {
    display: inline-block;
    float: right;
    padding-right: 40px;
}
#example-tabs {
    padding-left: 31px !important;
 }
.live-search-place {
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    height: auto !important;
    width: 322px;
    margin-left: 14px;
}
.live-search-place #select2-index_dia_diem_sm1-container{
    border: 1px solid #00baba;
 }
 .border-mid-rotate {
    border-bottom: 1px solid #000000;
    width: 15px;
    transform: rotate(90deg);
    margin-top: 24px;
    margin-left: 0px;
    margin-right: 0px;
}
#example-tabs {
    padding-left: 20px !important;
}
/* .dia_diem_sm {
    width: 400px;
}*/

}
@media screen and (max-width: 767px) {
.banner-caption {
    padding: 20px 0px;
 }
}
@media (min-width: 768px) and (max-width: 1024px)  {
.updatepass .control-label {
    width: 18% !important;
    text-align: right;
    margin-right: 26px;
    float: left;
    margin-bottom: 0px;
    line-height: 32px;
    height: 32px;
}
.fieldset .btngroup {
    text-align: center;
    margin-bottom: 20px;
    padding-left: 77px !important;
}
.class-img-left {
    border: 5px solid #f5f5f5;
    width: 100% !important;
    float: left;
    background-color: #fbfbfb;
    padding: 24px 12px 3px 12px;
    margin-top: 17px;
    min-height: 198px;
}
.viewnow {
    display: block !important;
}
.itemnews .itemnews_r {
    float: right;
    width: calc(100% - 135px);
    padding-left: 17px;
}
.itemnews_r .dadenghiday {
    display: inline-block;
    float: right;
    margin-right: 2px;
    color: #006969;
    font-weight: 700;
}
.navbar-right {
    float: left !important;
    margin: 0;
}
.dropdown-backdrop {
    position: static;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 990;
}
.uvmienphi .box-f {
    height: 154px;
    padding: 21px 17px 56px 154px;
    color: #fff;
    margin-bottom: 19px;
    position: relative;
    margin-top: 19px;
}
.loginmenu {
    width: 28% !important;
    padding: 0px;
}
.itemnews {
    position: relative;
    width: 100%;
    height: 165px !important;
    border-bottom: 1px solid #dedede;
}
#dia_diem_sm {
     width: 626px !important;
     margin-left: 0px  !important;
 }
 .timkiemungvien .box-f {
    height: 154px;
    padding: 19px 10px 35px 77px;
    color: #fff;
    margin-bottom: 19px;
    position: relative;
    margin-top: 19px;
    display: none !important;
}
.banner-caption {
    width: 100%;
    margin-left: 0px;
 }
.searchmobile {
    background-image: url('<?php echo base_url(); ?>upload/images/bg-search.png');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    background-position: center top;
    /*background-attachment: fixed;*/
    padding: 45px 0px !important;
 }
 .searchmobile .nav-tabs>li.active>a  {
    color: #555;
    background-color: transparent;
    border: none;
    border-bottom: 2px solid #FFFFFF !important;
}
.nav-tabs>li>a {
    margin-right: 2px;
    line-height: 1.42857143;
    border: none !important;
    border-radius: 4px 4px 0 0;
}
.banner-caption .input-group {
    padding: 0;
    display: block;
    float: left;
    width: 713px !important;
    padding-left: 38px;
}
 .btnsearch .timvieclam {
    width: 133px;
    color: #FFFFFF;
    text-align: center;
    display: inline-block;
    border-top-right-radius: 0px !important;
    border-bottom-right-radius: 0px !important;
    font-family: Roboto;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    /* identical to box height */

    text-transform: uppercase;

 }
.live-search {
    width: 677px !important;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    margin-left: 37px;
    text-align: left;
    padding-left: 40px;
}
.live-search-place {
    width: 677px !important;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.13);
    margin-left: 37px;
}
#example-tabs {
    margin-left: 221px !important;
}
#findkeyjob1 {
    padding-left: 33px !important;
}
.icon-close-rec {
    display: inline-block;
    float:right;
    padding-right: 40px;
    padding-top: 5px;
}
}
</style>
<style>
    .call-now-header {
        z-index: 300;
        position: fixed;
        width: 230px;
        height: 44px;
        right: 20px;
        top: 76px;
        padding-top: 2px;
        background-color: #00baba;
        border-radius: 25px;
        border: 1px solid #d3d3d36e;
        -webkit-box-shadow: 0 0 10px 10px rgba(160,160,160,0.75);
        -moz-box-shadow: 0 0 10px 10px rgba(160,160,160,0.75);
        box-shadow: 0 0 10px 10px rgba(160,160,160,0.75);
    }
    .fa-phone:before {
        content: "\f095";
    }
    .call-now-header .call-number .call-info {
        text-align: center;
        float: left;
        padding: 3px 0 0 30px;
        color: #fff;
    }
    .call-now-header .call-number-icon {
        width: 54px;
        height: 54px;
        float: left;
        padding: 10px 14px;
        margin: -8px 0 0 -2px;
        -webkit-animation: ANIMATION-PHONE 2s infinite;
        -webkit-animation-iteration-count:infinite;
        background-color: #ffb11b;
        border-radius: 50%;
        -webkit-box-shadow: 0 0 5px 2px #fff;
        -moz-box-shadow: 0 0 5px 2px #fff;
        box-shadow: 0 0 5px 2px #fff;
    }
    .call-now-header .call-number .call-info p {
        color: #FFFFFF;
        padding: 0;
        margin: 0;
        line-height: 1.2;
        position: relative;
        -webkit-animation: leaves 2s infinite;
        animation: ANIMATION-TEXT 2s infinite;
    }
    .call-now-header .call-number .call-info a {
        color: #FFFFFF;
    }
    @-webkit-keyframes ANIMATION-PHONE{
      0% {
      }
      10% {
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        -o-transform:rotate(5deg); 
    }
    20% {
        -webkit-transform:rotate(-5deg);
        -moz-transform:rotate(-5deg);
        -o-transform:rotate(-5deg);       
    }
    30% {
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        -o-transform:rotate(5deg);       
    }
    40% {
        -webkit-transform:rotate(-5deg);
        -moz-transform:rotate(-5deg);
        -o-transform:rotate(-5deg);       
    }
    50% {
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        -o-transform:rotate(5deg);       
    }
    60% {
        -webkit-transform:rotate(-5deg);
        -moz-transform:rotate(-5deg);
        -o-transform:rotate(-5deg);       
    }
    70% {
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        -o-transform:rotate(5deg);       
    }
    80% {
        -webkit-transform:rotate(-5deg);
        -moz-transform:rotate(-5deg);
        -o-transform:rotate(-5deg);       
    }
    90% {
        -webkit-transform:rotate(5deg);
        -moz-transform:rotate(5deg);
        -o-transform:rotate(5deg);       
    }
    100% {
        -webkit-transform:rotate(-5deg);
        -moz-transform:rotate(-5deg);
        -o-transform:rotate(-5deg);       
    }
}
@-webkit-keyframes ANIMATION-TEXT{
      0% {
      }
      10% {
        transform: scale(0.7);
    }
    20% {
        transform: scale(0.8);     
    }
    30% {
        transform: scale(0.9);      
    }
    40% {
        transform: scale(1);     
    }
    50% {
        transform: scale(1);    
    }
    60% {
        transform: scale(1);     
    }
    70% {
        transform: scale(1);    
    }
    80% {
        transform: scale(1); ;      
    }
    90% {
        transform: scale(1);     
    }
    100% {
        transform: scale(1);      
    }
}
@media screen and (max-width: 479px) {
    .call-info {
        display: none !important;
    }
    .call-now-header {
       width: 50px;
       display: block !important;
       margin-top: 42px;
       position: fixed;
       cursor: pointer;
       bottom: 100px;
       right: 303px;
       top: 636px;
       z-index: 9999999;
       opacity: 1;
    }
}
@media screen and (max-width: 360px) {
    .call-info {
        display: none !important;
    }
    .call-now-header {
       width: 50px;
       display: block !important;
       margin-top: 42px;
       position: fixed;
       cursor: pointer;
       bottom: 100px;
       right: 303px;
       top: 636px;
       z-index: 9999999;
       opacity: 1;
    }
}
</style>
<div class="call-now-header hidden-xs">
    <div class="call-number">
        <div class="call-number-icon"><i class="fa fa-phone" style="color:#fff;font-size: 36px;"></i></div>
        <div class="call-info">
            <p style="font-size: 18px;"><a href="tel:0981509188">0981.509.188</a></p>
            <p style="font-size: 10px;text-transform: uppercase;">Tư vấn miễn phí</p>
        </div>          
    </div>
</div>
<!-- Start Navigation -->
<nav class="<?php echo $classheader?> <?php if(!$showsearch){ echo "navnosearch"; }?>">
    <div class="container header-top">            
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars fa-3x" style="font-size: 25px; "></i>
        </button>
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="https://timviec365.com.vn/">
                <?php if(!$home){ ?>
                    <img src="<?php echo base_url(); ?>upload/images/logo-new.png" class="logo logo-display" alt="tìm việc">
                <?php }else{ ?>
                    <img src="<?php echo base_url(); ?>upload/images/logo-new.png" class="logo logo-display" alt="tìm việc">
                <?php } ?>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling animated  animated data-in="fadeInDown" data-out="fadeOutUp" animated data-in="fadeInDown" data-out="fadeOutUp"-->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav top_head <?php if(!$showsearch){ echo "nosearch"; }?>" >
                <li>
                <a href="<?php echo base_url(); ?>"><i class="fa fa-home" style="margin-right: 0px !important; color: #FFFFFF;"></i> Trang chủ</a>
                </li>
                <li class="dropdown p1">
                    <a class="dropdown-toggle v1" data-toggle="dropdown">Dành cho phụ huynh</a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="<?php echo base_url() ?>tim-gia-su">Gia sư hàng đầu</a></li>
                        <li><a href="<?php echo $urlgiasu; ?>">Đăng tin tìm gia sư</a></li>
                    </ul>
                </li>
                <li class="dropdown p1">
                    <a class="dropdown-toggle v3" data-toggle="dropdown">Dành cho gia sư</a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="<?php echo base_url() ?>tim-lop-hoc" title="">Danh sách lớp học</a></li>
                    </ul>
                </li>
               <!--  <li class="dropdown p1">
                    <a class="dropdown-toggle v5" data-toggle="dropdown" title="">Góc chia sẻ</a>
                    <ul class="dropdown-menu " role="menu">
                        <?php $news = $this->db->query('SELECT c.`name`,c.alias as aliascat,c.id as idcat FROM chuyenmuc as c WHERE c.status=1 ORDER BY c.id'); 
                        if($news->num_rows()>0){                                
                            $tg= $news->result();
                            foreach($news->result() as $n){
                                ?>
                                <li><a href="<?php echo site_url($n->aliascat.'.html') ?>"><?php echo $n->name ?></a></li>
                            <?php }
                        } ?>
                    </ul>
                </li> -->
            </ul>
            <ul class="navbar-right loginmenu" >
                <?php  if(!isset($_SESSION['UserInfo']) || empty($_SESSION['UserInfo'])){ ?>
                    <li><a href="<?php echo base_url() ?>dang-ky-chung">Đăng ký</a></li>
                    <li><a href="<?php echo base_url() ?>dang-nhap-chung">Đăng nhập</a></li>
                <?php }else{ 
                    $userinfo=$_SESSION['UserInfo'];
                    ?>
                    <style type="text/css">
                        .loginmenu li{width: unset; min-width: 60%; max-width: 100%;}
                    </style>
                    <li class="dropdown logininfo"><a class="dropdown-toggle" data-toggle="dropdown"><?php echo $userinfo['Name']; ?></a>
                        <ul class="dropdown-menu " role="menu">
                            <?php if($type==1){ ?>
                                <li class="mb-border"><a href="<?php echo base_url() ?>giao-vien-manager">Thông tin cá nhân</a></li>
                            <?php }else{ ?>
                                <li class="mb-border"><a href="<?php echo base_url() ?>phu-huynh-manager">Thông tin cá nhân</a></li>
                            <?php } ?>
                            <li class="mb-border"><a href="javascript:void(0);" id="btnlogout">Thoát</a></li>
                        </ul>
                    </li>
                <?php } ?>							
            </ul>
            <?
            if($type !=3)
            {
                if($active==0)
                {
                    if($ktra != $link)
                    {
                        header('Location:'.base_url()."xacnhankichhoattaikhoan");
                    }
                }
                // else if($check == 0 && $type == 0 && $ktra2 != $link)
                // {
                   
                //         header('Location:'.base_url()."mn-hv-dang-tin");
                    
                    
                // }
            }
            ?>

        </div>
        <!-- /.navbar-collapse -->
    </div>   
</nav>
<!-- End Navigation -->
<?php if($showsearch && !$detect->isMobile()){ ?>
    <div class="searchtop">
        <div class="banner-caption hidden-mobile">
            <!-- Thêm tab html -->
            <ul class="nav nav-tabs" id="example-tabs" role="tablist">
                <li class="nav-item active" id="search-teacher" value="1">
                    <a id="tab1" class="nav-link" style="border-left:none" data-toggle="tab" role="tab"  href="#pane-tab-1"> <img src="<?php echo base_url(); ?>upload/images/graduated1.png" alt="Tìm gia sư" class="icon-search-header"> Tìm gia sư</a>
                </li>
               <li>
                    <div class="border-mid-rotate">
                                        
                </div>
               </li>
                <li class="nav-item" id="search-class-teacher" value="2">
                    <a id="tab2" class="nav-link" data-toggle="tab" role="tab"  href="#pane-tab-2"> <img src="<?php echo base_url(); ?>upload/images/book1.png" alt="Tìm lớp gia sư" class="icon-search-header"> Tìm lớp gia sư</a>
                </li>
            </ul>
            <!-- Nội dung tab -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="pane-tab-1" role="tabpanel" aria-labelledby="tab1">
                    <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal" style="padding-top: 0px">
                    <div class="col-md-6 no-padd">
                        <div class="col-md-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo ($keyfilter['keywork']!='0')?$keyfilter['keywork']: '' ?>" id="findkeyjob"  class="form-control right-bor" placeholder="Nhập từ khóa tìm kiếm..." autocomplete="off"> 
                            </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?php 
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?php        
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?php
                                    }

                                    ?>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no-padd">
                        <div class="col-md-10 no-padd">
                            <div class="col-md-12 no-padd diadiem">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem" class="form-control">
                                        <option  data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                   
                                </div>
                            </div>
                        </div>                               
                        <div class="col-md-2 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
            <p class="recommend-search-header">
                <!-- <?php foreach ($list_search_teacher as $url_teacher) { ?>
                    <?php if ($url_teacher->option == 0) { ?>
                        <a href="<?php echo base_url(); ?>tim-gia-su-mon-<?php echo $url_teacher->alias ?>-m<?php echo $url_teacher->ID; ?>l0t0.html"><?php echo $url_teacher->key_tag ?></a> 
                    <?php } else if($url_teacher->option == 1){ ?>
                        <a href="<?php echo base_url(); ?>tim-gia-su-tai-<?php echo vn_str_filter($url_teacher->place_name)?>-m0l0t<?php echo $url_teacher->place_id ?>.html"><?php echo $url_teacher->key_tag ?></a>
                    <?php } else if($url_teacher->option == 2) { ?>
                        <a  href="<?php echo base_url(); ?>tim-gia-su-mon-<?php echo $url_teacher->alias ?>-m<?php echo $url_teacher->ID ?>l0t<?php echo $url_teacher->place_id; ?>.html"><?php echo $url_teacher->key_tag ?></a>
                    <?php } ?>
                <?php } ?> -->
                <a href="<?php echo base_url(); ?>tim-gia-su-toan-m281l0t0.html">Gia sư Toán</a> 
                <a href="<?php echo base_url(); ?>tim-gia-su-ly-m282l0t0.html">Gia sư Lý</a> 
                <a href="<?php echo base_url(); ?>tim-gia-su-tieng-viet-m285l0t0.html">Gia sư Tiếng Việt</a> 
                <a href="<?php echo base_url(); ?>tim-gia-su-tieng-anh-m290l0t0.html">Gia sư Tiếng Anh</a> 
                <a href="<?php echo base_url(); ?>tim-gia-su-sinh-m288l0t0.html">Gia sư Sinh</a> 
            </p>
            <div class="live-search">
                <div class="row">
                     <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                     X
                    </a>
                    <div class="co-md-4 live-search-left live-search-left2">
                        <h4>Tìm kiếm gần đây</h4>
                        <?php foreach ($list_search_teacher_top as $teacher_top) { ?>
                        <a href="#" class="fk-search"><?php echo $teacher_top->key_tag; ?></a>
                        <?php } ?>
                        
                    </div>
                    <div class="border-search-right">
                        
                    </div>
                    <div class="co-md-7 live-search-right">
                        <h4>Tìm kiếm gia sư</h4>
                        <div class="row">
                            <div class="col-md-4  width-fix">
                                <?php foreach ($list_search_teacher1 as $q => $l) { ?>
                                    <a href="#" class="fk-search"><?php echo $l->key_tag; ?></a>
                                    <?php if ($q == 3) { ?>
                                    </div>
                                    <div class="col-md-4  width-fix">
                                    <?php } ?>
                                    <?php if ($q == 7) { ?>
                                    </div>
                                    <div class="col-md-4  width-fix">
                                    <?php } ?>
                                    <?php if ($q == 11) { ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
            </div>
             <div class="live-search-place" id="live-search-place">
                   <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                     X
                    </a>
                     <div class="row">
                    <div class="co-md-6 live-search-left">
                        <h4>Địa điểm phổ biến</h4>
                        <div class="row hot_place">
                            <div class="col-md-6 hot_place_left">
                                <a href="#" data-val="1" class="search_cit_n">Hà Nội</a>
                                <a href="#" data-val="26" class="search_cit_n">Đà Nẵng</a>
                                <a href="#" data-val="2" class="search_cit_n">Hải Phòng</a>
                            </div>
                            <div class="col-md-6 hot_place_right">
                              <a href="#" data-val="45" class="search_cit_n">Hồ Chí Minh</a>
                                <a href="#" data-val="48" class="search_cit_n">Cần Thơ</a>
                                <a href="#" data-val="46" class="search_cit_n">Bình Dương</a>
                            </div>
                        </div>
                    </div>
                    <div class="co-md-5 live-search-right">
                        <h4>Danh sách địa điểm</h4>
                        <div class="row">
                            <div class="col-md-9">
                               <div class="input-group" style="width: 250px !important;">
                                <!-- <span class="span-before"><i class="nn2"></i></span> -->
                                <select id="index_dia_diem_sm" class="form-control">
                                    <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                    <?php 
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){
                                            if($n->cit_id == $keyfilter['place']){
                                                ?>
                                                <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                    }
                                    ?>     
                                </select>

                            </div>
                        </div>
                            <div class="col-md-2 point-left">
                                <img src="<?php echo base_url(); ?>upload/images/hand_left.png" alt="Tỉnh thành">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix" style="clear:both">
                        
                    </div>
                </div>
            </div>
               <!--  </div> --> <!-- div loi -->
                <div class="tab-pane fade in" id="pane-tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal" style="padding-top: 0px">
                    <div class="col-md-6 no-padd">
                        <div class="col-md-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo ($keyfilter['keywork']!='0')?$keyfilter['keywork']:'' ?>" id="findkeyjob1" class="form-control right-bor" placeholder="Nhập từ khóa tìm kiếm..." aria-label="nhập từ khóa">
                                <div class="input-group">
                            </div>
                            </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?php 
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?php        
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?php
                                    }

                                    ?>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 no-padd">
                        <div class="col-md-10 no-padd">
                            <div class="col-md-12 no-padd diadiem">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem1" class="form-control" >
                                        <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                </div>
                            </div>

                        </div>                               
                        <div class="col-md-2 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
            <p class="recommend-search-header recommend-search2">
                 <!-- <?php foreach ($list_class_teacher as $url_class) { ?>
                  <?php if ($url_class->option == 0) { ?>
                    <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $url_class->alias ?>-s<?php echo $url_class->ID ?>c0p0.html"><?php echo $url_class->key_tag ?></a>
                <?php } else if($url_class->option == 1) { ?>
                    <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-tai-<?php echo vn_str_filter($url_class->place_name)?>-s0c0p<?php echo $url_class->place_id ?>.html"><?php echo $url_class->key_tag ?></a>
                <?php } else if($url_class->option == 2) { ?>
                    <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $url_class->alias ?>-m<?php echo $url_class->ID ?>c0p<?php echo $url_class->place_id; ?>.html"><?php echo $url_class->key_tag ?></a>
                <?php } ?>
                <?php } ?> -->
                 <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-toan-s294c0p0.html">Lớp môn Toán</a>
                 <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-ly-s295c0p0.html">Lớp môn Lý</a>
                 <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-hoa-s296c0p0.html">Lớp môn Hóa</a>
                 <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-tieng-viet-s298c0p0.html">Lớp môn Tiếng Việt</a>
                 <a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-sinh-s301c0p0.html">Lớp môn Sinh</a>
            </p>

            <div class="live-search" id="live-search2">
                <div class="row">
                    <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                     X
                    </a>
                    <div class="co-md-4 live-search-left live-search-left3">
                       <h4>Tìm kiếm gần đây</h4>
                        <?php foreach ($list_search_class_top as $class_top) { ?>
                        <a href="#" class="fk-search1"><?php echo $class_top->key_tag; ?></a>
                        <?php } ?>
                    </div>
                    <div class="border-search-right">
                        
                    </div>
                    <div class="co-md-7 live-search-right live-search-right2">
                         <h4>Tìm kiếm gia sư</h4>
                        <div class="row ">
                            <div class="col-md-4 width-fix">
                                <?php foreach ($list_class_teacher1 as $e => $r) { ?>
                                    <a href="#" class="fk-search1"><?php echo $r->key_tag; ?></a>
                                    <?php if ($e == 3) { ?>
                                    </div>
                                    <div class="col-md-4 width-fix">
                                    <?php } ?>
                                    <?php if ($e == 7) { ?>
                                    </div>
                                    <div class="col-md-4 width-fix">
                                    <?php } ?>
                                    <?php if ($e == 11) { ?>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
             <div class="live-search-place" id="live-search-place1" >
                <div class="row">
                   <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                     X
                    </a>
                    <div class="co-md-6 live-search-left">
                        <h4>Địa điểm phổ biến</h4>
                       <div class="row hot_place">
                            <div class="col-md-6 hot_place_left">
                                <a href="#" data-val="1" class="search_cit_n1">Hà Nội</a>
                                <a href="#" data-val="26" class="search_cit_n1">Đà Nẵng</a>
                                <a href="#" data-val="2" class="search_cit_n1">Hải Phòng</a>
                            </div>
                            <div class="col-md-6 hot_place_right">
                              <a href="#" data-val="45" class="search_cit_n1">Hồ Chí Minh</a>
                                <a href="#" data-val="48" class="search_cit_n1">Cần Thơ</a>
                                <a href="#" data-val="46" class="search_cit_n1">Bình Dương</a>
                            </div>
                        </div>
                    </div>
                    <div class="co-md-5 live-search-right">
                        <h4>Danh sách địa điểm</h4>
                        <div class="row">
                            <div class="col-md-9">
                               <div class="input-group" style="width: 250px !important;">
                                <span class="span-before"><i class="nn2"></i></span>
                                <select id="index_dia_diem_sm1" class="form-control" >
                                    <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                    <?php 
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){
                                            if($n->cit_id == $keyfilter['place']){
                                                ?>
                                                <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                    }
                                    ?>     
                                </select>

                            </div>
                        </div>
                            <div class="col-md-2 point-left">
                                <img src="<?php echo base_url(); ?>upload/images/hand_left.png" alt="tỉnh thành">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <!-- end -->
            <!-- <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal">
                    <div class="col-md-4 no-padd">
                        <div class="col-md-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo ($keyfilter['keywork']!='0')?$keyfilter['keywork']:'' ?>" id="findkeyjob" class="form-control right-bor" aria-label="nhập từ khóa" <?php if($type==1 || $link == base_url()."tim-lop-hoc"){echo 'placeholder="Tìm kiếm lớp gia sư"';} else echo 'placeholder="Tìm kiếm gia sư"';?> >
                            </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?php 
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?php        
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?php
                                    }

                                    ?>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 no-padd">
                        <div class="col-md-6 no-padd">
                            <div class="col-md-6 no-padd nganhnghe">
                                <div class="input-group">
                                    
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_nganhnghe" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?> >
                                        <option  value="0">Môn học</option> 
                                        <?php
                                        
                                        
                                        if(!empty($monhoc)){
                                            foreach($monhoc as $n){
                                                if($n->SubjectName == $keyfilter['subject'] || $n->ID == $keyfilter['subject']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php } 
                                            }
                                        } 
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 no-padd lop">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_lop" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Chọn lớp</option> 
                                        <?php 
                                        if(!empty($lop)){
                                            foreach($lop as $n){
                                                if($n->id == $keyfilter['class']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>       
                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="col-md-5 no-padd">
                            <div class="col-md-6 no-padd diadiem">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem" class="form-control" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option data-tokens="0" value="0">Tỉnh thành</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 no-padd quanhuyen">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_quanhuyen" class="form-control"  <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Quận/Huyện</option> 
                                        <?php 
                                        if(!empty($keyfilter['place'])){
                                            foreach($quanhuyen as $n){
                                                if($n->cit_id == $keyfilter['district']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                            </div>  
                        </div>                               
                        <div class="col-md-1 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div> -->
        </div>
        <!-- <span class="nangcao" title="Tìm kiếm nâng cao" data-toggle="modal" data-target="#myModalmorsearch"></span> -->
    </div>
</div>
</div>
<?php } ?>

<div class="clearfix"></div>

<?php if($showsearch && $detect->isMobile()){ ?>
    <div class="container searchmobile" style="background-color: #203043;border-top: 1px solid #fff;">
        <div class="banner-caption hidden-mobile">
             <!-- Thêm tab html -->
            <div class="col-xs-12 no-padd">
            <ul class="nav nav-tabs col-xs-12"  id="example-tabs" role="tablist">
                <li class="nav-item active" id="search-teacher" value="1">
                    <a id="tab1" class="nav-link" style="border-left:none" data-toggle="tab" role="tab"  href="#pane-tab-1"><img src="<?php echo base_url(); ?>upload/images/graduated1.png" alt="Tìm gia sư">Tìm gia sư</a>
                </li>
                  <li>
                    <div class="border-mid-rotate">
                                        
                </div>
                <li class="nav-item" id="search-class-teacher" value="2">
                    <a id="tab2" class="nav-link" data-toggle="tab" role="tab"  href="#pane-tab-2"> <img src="<?php echo base_url(); ?>upload/images/book1.png" alt="Tìm lớp gia sư"> Tìm lớp gia sư</a>
                </li>
            </ul>
            </div>
            <!-- Nội dung tab -->
            <div class="tab-content">
                <div class="tab-pane fade in active" id="pane-tab-1" role="tabpanel" aria-labelledby="tab1">
                    <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal">
                    <div class="col-xs-12 no-padd">
                        <div class="col-xs-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo $keyfilter['keywork'] ?>" autocomplete="off" id="findkeyjob" class="form-control right-bor" aria-label="nhập từ khóa" placeholder="Tìm kiếm gia sư" >
                            </div>
                            <div class="clearfix">
                                
                            </div>
                            <div class="live-search">
                                <div class="row">
                                    <span class="icon-close-rec">
                                        X
                                    </span>
                                    <div class="live-search-left2">
                                        
                                    <h4>Tìm kiếm gần đây</h4>
                                    <?php foreach ($list_search_teacher_top as $teacher_top) { ?>
                                        <a href="#" class="fk-search"><?php echo $teacher_top->key_tag; ?></a>
                                    <?php } ?>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?       
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="no-padd">
                        <!-- <div class="col-xs-12 no-padd">
                        </div> -->
                        <div class="col-xs-12 no-padd">
                            <div class="col-xs-12 no-padd diadiem">
                                <div class="input-group">
                                    <!-- <span class="span-before"><i class="nn2"></i></span> -->
                                    <select id="index_dia_diem"  class="form-control" >
                                        <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                </div>
                            </div>
                            <div class="live-search-place" id="live-search-place">
                               <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                                 X
                             </a>
                             <h4>Danh sách địa điểm</h4>
                             <div class="input-group dia_diem_sm" id="dia_diem_sm" style="width: 250px; margin-left: 40px;">
                                <select id="index_dia_diem_sm" class="form-control" >
                                    <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                    <?php 
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){
                                            if($n->cit_id == $keyfilter['place']){
                                                ?>
                                                <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                    }
                                    ?>     
                                </select>

                            </div>

                        </div>
                        </div>                               
                        <div class="col-xs-12 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
                </div>
                <div class="tab-pane fade in" id="pane-tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="banner-text">
                        <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal">
                    <div class="col-xs-12 no-padd">
                        <div class="col-xs-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo $keyfilter['keywork'] ?>" id="findkeyjob1" class="form-control right-bor" aria-label="nhập từ khóa" placeholder="Tìm kiếm lớp gia sư" >
                            </div>
                            <div class="clearfix">
                                
                            </div>
                             <div class="live-search" id="live-search2">
                                <div class="row">
                                    <span class="icon-close-rec">
                                        X
                                    </span>
                                    <div class="live-search-left3">
                                    <h4>Tìm kiếm gần đây</h4>
                                    <?php foreach ($list_search_class_top as $class_top) { ?>
                                        <a href="#" class="fk-search1"><?php echo $class_top->key_tag; ?></a>
                                    <?php } ?>
                                    </div>
                                </div>
                                </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?       
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="no-padd">
                        <div class="col-xs-12 no-padd">
                           <!--  <div class="col-xs-12 no-padd nganhnghe">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_nganhnghe1" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?> >
                                        <option  value="0">Môn học</option> 
                                        <?php
                                        if(!empty($monhoc)){
                                            foreach($monhoc as $n){
                                                if($n->ID == $keyfilter['subject']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php } 
                                            }
                                        } 
                                        ?>

                                    </select>
                                </div>
                            </div> -->
                           <!--  <div class="col-xs-12 no-padd lop">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_lop1" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Chọn lớp</option> 
                                        <?php 
                                        if(!empty($lop)){
                                            foreach($lop as $n){
                                                if($n->id == $keyfilter['class']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>       
                                    </select>
                                </div>
                            </div> -->   
                        </div>
                        <div class="col-xs-12 no-padd">
                            <div class="col-xs-12 no-padd diadiem">
                                <div class="input-group">
                                    <!-- <span class="span-before"><i class="nn2"></i></span> -->
                                    <select id="index_dia_diem1" class="form-control" >
                                        <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                </div>
                            </div>
                             <div class="live-search-place" id="live-search-place1">
                               <a href="#" class="icon-close-rec1" style="float: right; padding-right: 40px;padding-top: 10px;">
                                 X
                             </a>
                             <h4>Danh sách địa điểm</h4>
                             <div class="input-group" id="dia_diem_sm" style="width: 250px; margin-left: 40px;">
                                <select id="index_dia_diem_sm1" class="form-control" >
                                    <option data-tokens="0" value="0">Chọn tỉnh / thành phố</option>
                                    <?php 
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){
                                            if($n->cit_id == $keyfilter['place']){
                                                ?>
                                                <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                    }
                                    ?>     
                                </select>

                            </div>

                        </div>
                            <!-- <div class="col-xs-12 no-padd quanhuyen">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_quanhuyen1" class="form-control"  <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Quận/Huyện</option> 
                                        <?php 
                                        if(!empty($keyfilter['place'])){
                                            foreach($quanhuyen as $n){
                                                if($n->cit_id == $keyfilter['district']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                            </div>  --> 
                        </div>                               
                        <div class="col-xs-12 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i> Tìm kiếm</button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
                    </div>
                </div>

        </div>
            <!-- <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal">
                    <div class="col-xs-12 no-padd">
                        <div class="col-xs-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo $keyfilter['keywork'] ?>" id="findkeyjob" class="form-control right-bor" aria-label="nhập từ khóa" <?php if($type==1 || $link == base_url()."tim-lop-hoc"){echo 'placeholder="Tìm kiếm lớp gia sư"';} else echo 'placeholder="Tìm kiếm gia sư"';?> >
                            </div>
                        </div>
                        <div class="no-padd user_type hidden-mobile">
                            <div class="input-group">
                                <select id="index_user_type" class="form-control right-bor">
                                    <?
                                    if($type == 1 || $link == base_url()."tim-lop-hoc")
                                    {
                                        ?>
                                        <option data-tokens="0" value="0">Tìm lớp gia sư</option>
                                        <?       
                                    }
                                    else if($type ==0 || $type == 3)
                                    {
                                        ?>
                                        <option data-tokens="1" value="1">Tìm gia sư</option>
                                        <?
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="no-padd">
                        <div class="col-xs-12 no-padd">
                            <div class="col-xs-12 no-padd nganhnghe">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_nganhnghe" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?> >
                                        <option  value="0">Môn học</option> 
                                        <?php
                                        if(!empty($monhoc)){
                                            foreach($monhoc as $n){
                                                if($n->ID == $keyfilter['subject']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                                <?php } 
                                            }
                                        } 
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padd lop">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_lop" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Chọn lớp</option> 
                                        <?php 
                                        if(!empty($lop)){
                                            foreach($lop as $n){
                                                if($n->id == $keyfilter['class']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>       
                                    </select>
                                </div>
                            </div>   
                        </div>
                        <div class="col-xs-12 no-padd">
                            <div class="col-xs-12 no-padd diadiem">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem" class="form-control" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option data-tokens="0" value="0">Tỉnh thành</option>
                                        <?php 
                                        if(!empty($tinhthanh)){
                                            foreach($tinhthanh as $n){
                                                if($n->cit_id == $keyfilter['place']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>     
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 no-padd quanhuyen">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_quanhuyen" class="form-control"  <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
                                        <option  value="0">Quận/Huyện</option> 
                                        <?php 
                                        if(!empty($keyfilter['place'])){
                                            foreach($quanhuyen as $n){
                                                if($n->cit_id == $keyfilter['district']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $n->cit_id ?>"><?php echo $n->cit_name ?></option>
                                                <?php }
                                            }
                                        }
                                        ?>  
                                    </select>
                                </div>
                            </div>  
                        </div>                               
                        <div class="col-xs-12 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div> -->

        </div>
    </div>
<?php } ?>
<div id="myModalmorsearch" class="modal fade top" role="dialog">
    <div class="col-sm-3"></div>
    <div class="modal-dialog col-sm-12">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Tìm kiếm nâng cao</h4>
        </div>
        <div class="modal-body" style="overflow: hidden;">
            <div class="col-md-12 col-sm-12">
               <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Hình thức công việc</label>
                    <select class="form-control" id="hinhthuc" name="hinhthuc">
                     <option value="">Hình thức dạy</option>
                     <option value="1">Gia sư tại nhà</option>
                     <option value="2">Online trực tuyến</option>
                 </select>
             </div>
         </div>  
         <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Giới tính</label>
                <select class="form-control" id="ppgioitinh" name="ppgioitinh">
                 <option value="">Chọn giới tính</option>
                 <option value="1">Nam</option>
                 <option value="2">Nữ</option>
             </select>
         </div>
     </div> 
     <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Trình độ</label>
            <select class="form-control" id="txtteachtypemd" name="txtteachtypemd">
             <option value="">Chọn trình độ</option>
             <?php
             if(!empty($lstitem)){
                foreach($lstitem as $n){ ?>
                    <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>            
                <?php }
            } 
            ?>
        </select>
    </div>
</div> 
<div class="col-md-6">
    <div class="form-group">
        <span class="btnsearchmore">Chọn</span>
    </div>
</div>   
</div>
</div>      
</div>
</div>
</div>

<script>
    $(document).ready(function() {
        var url = "<?php echo base_url(); ?>";
        var search_class = <?php echo (isset($search_class) ? $search_class : '""') ?>;
        if (search_class == 2) {
            $('#pane-tab-1').removeClass('active')
            $('#pane-tab-2').addClass('active')
            $('#search-class-teacher').addClass('active');
            $('#search-teacher').removeClass('active');

        }
        $('#myModalmorsearch #hinhthuc,#myModalmorsearch #ppgioitinh,#myModalmorsearch #txtteachtype,#myModalmorsearch #txtteachtypemd').select2();
        $('#index_dia_diem_sm1').select2();
        $('#index_dia_diem_sm').select2();
        $('.btnsearchmore').on('click',function(){
            $('#myModalmorsearch').modal('hide');
        });
        $('#findkeyjob').focus(function(event) {
            $('.recommend-search-header').css({'display':'none'});
            $('.live-search').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});
            $('#live-search-place').css('display', 'none');
            $(this).attr('autocomplete', 'off');
        });
        $('.icon-close-rec').click(function(event) {
            $('.recommend-search-header').css('display', 'none');
            $('.live-search').css('display', 'none');
             $('#live-search-place').css('display', 'none');
        });
         $('.icon-close-rec1').click(function(event) {
            event.preventDefault();
            $('.recommend-search-header').css('display', 'block');
             $('.recommend-search2').css({'display':'blocks'});
            $('.live-search').css('display', 'none');
            $('#live-search2').css('display', 'none');
             $('#live-search-place').css('display', 'none');
             $('#live-search-place1').css('display', 'none');
        });
         $('#findkeyjob1').focus(function(event) {
            $('.recommend-search2').css({'display':'none'});
            $('#live-search2').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});
             $('#live-search-place1').css('display', 'none');
            $(this).attr('autocomplete', 'off');
        });
        $('#index_dia_diem').on('select2:open',function(event) {
            $('#index_dia_diem_sm').select2();
            $('.select2-dropdown').css('display', 'none');
            $('.recommend-search-header').css('display', 'none');
            $('#live-search-place').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});
            $('.live-search').css({'display': 'none'});

            $(this).attr('autocomplete', 'off');
        });
        $('#index_dia_diem1').on('select2:open',function(event) {
            $('#index_dia_diem_sm1').select2();
            $('.select2-dropdown').css('display', 'none');
            $('.recommend-search2').css('display', 'none');
            $('#live-search-place1').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});

            $('.live-search').css({'display': 'none'});
            $(this).attr('autocomplete', 'off');
        });
        $('#findkeyjob').keyup(function(event) {
            event.preventDefault();
            var findkeyjob = $(this).val();
            if (findkeyjob != '') {
                $.ajax({
                    url: url+'site/ajax_live_search',
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    data: {key1: findkeyjob, tbl:'topic'},
                    success: function(res) {
                       $('.live-search-left2').html(res.html);
                    },
                    error: function(xhr) {
                        alert('error');
                    }
                })
                
            }
        });
         $('#findkeyjob1').keyup(function(event) {
            event.preventDefault();
            var findkeyjob = $(this).val();
            if (findkeyjob != '') {
                $.ajax({
                    url: url+'site/ajax_live_search1',
                    async: false,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {key1: findkeyjob, tbl: 'url_timviec'},
                    success: function(res) {
                       $('.live-search-left3').html(res.html);
                    },
                    error: function(xhr) {
                        alert('error');
                    }
                })
                
            }
        });
        $('body').on('click','.fk-search',function(event) {
            event.preventDefault();
            var fk_search = $(this).html();
            $('#findkeyjob').val(fk_search);
            $('.select2-dropdown').css('display', 'none');
            $('.recommend-search-header').css('display', 'none');
            $('#live-search-place').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});
            $('.live-search').css({'display': 'none'});

        });
        $('body').on('click','.fk-search1', function(event) {
            event.preventDefault();
            var fk_search = $(this).html();
            $('#findkeyjob1').val(fk_search);
            $('.select2-dropdown').css('display', 'none');
            $('.recommend-search-header').css('display', 'none');
            $('#live-search-place1').css({'display': 'block', 'position' : 'absolute', 'z-index': '1'});
            $('.live-search').css({'display': 'none'});

        });
        $('#index_dia_diem_sm').on('select2:select', function(event) {
            event.preventDefault();
            var city1 = $(this).val();
            $('#index_dia_diem').val(city1);
            $('#index_dia_diem').select2().trigger('change');
        });
        $('#index_dia_diem_sm1').on('select2:select', function(event) {
            event.preventDefault();
            var city1 = $(this).val();
            $('#index_dia_diem1').val(city1);
            $('#index_dia_diem1').select2().trigger('change');
        });
        $('.search_cit_n').on('click',  function(event) {
            event.preventDefault();
            var cit = $(this).attr('data-val');
            $('#index_dia_diem').val(cit);
            $('#index_dia_diem').select2().trigger('change');
        });
         $('.search_cit_n1').on('click',  function(event) {
            event.preventDefault();
            var cit = $(this).attr('data-val');
            $('#index_dia_diem1').val(cit);
            $('#index_dia_diem1').select2().trigger('change');
        });
      
    });

</script>


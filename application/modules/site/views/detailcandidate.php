<?php

/**
 * @author GallerySoft.info
 * @copyright 2018
 */
$urlweb=base_url().$_SERVER['REQUEST_URI'] ;
if($urlweb != $canonical)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $canonical");
   exit();
}

?>
<!-- SubHeader -->
        <div class="careerfy-subheader careerfy-subheader-without-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="careerfy-page-title">
                            <h1>Thông tin ứng viên: <?php echo $userinfo->use_first_name ?></h1>
                            <p>Hiển thị thông tin chi tiết của ứng viên trên website</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="careerfy-breadcrumb">
                <ul>
                    <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                    <li><a href="<?php echo base_url() ?>nguoi-tim-viec.html">Danh sách ứng viên</a></li>
                    <li><?php echo $userinfo->use_first_name ?></li>
                </ul>
            </div>
        </div>
<!-- SubHeader -->
<div class="careerfy-main-content">
    <div class="careerfy-main-section careerfy-dashboard-fulltwo">
        <div class="container">
            <div class="row">
                <aside class="careerfy-column-3">
                    <div class="careerfy-typo-wrap">
                        <div class="jobsearch_candidate_info">
                                    <figure><img src="images/<?php echo $userinfo->use_logo; ?>" alt="<?php echo $userinfo->use_first_name ?>" onerror='this.onerror=null;this.src="images/icon-no-image.png";' class="img-circle"></figure>
                                    <h2><a href="<?php echo base_url()."ung-vien/".vn_str_filter($userinfo->use_first_name)."-uv".$userinfo->use_id.".html"; ?>"><?php echo $userinfo->use_first_name ?></a></h2>
                                    <p><?php
                if(empty($userinfo->cv_cate_id)){
                    $catname=0;
                }else{
                    $catname=$userinfo->cv_cate_id;
                }
                 echo GetCategory($catname); ?> tại <a ><?php if(intval($userinfo->cv_city_id)==0){echo "Chưa cập nhật";}else{ echo Getcitybyindex($userinfo->cv_city_id);} ?></a></p>
                                    <span><i class="fa fa-map-marker"></i> <?php 
                                        if(empty($userinfo->use_address)){echo ' Chưa cập nhật';}else{echo $userinfo->use_address;}
                                        ?>
                                    </span>
                                    <small>Cập nhật, 
                                    <?php if($userinfo->use_update_time !='1498451673'){ echo date('F j, Y',$userinfo->use_update_time); ?>
                                    <?php }else{ 
                                        echo date('F j, Y',time());
                                        
                                    } ?>
                                    </small>
                                    <small>Lượt xem: <?php echo number_format($userinfo->use_view) ?></small>
                                    <small>Mức lương: <?php
                                            if(empty($userinfo->cv_money_id)){
                                                $mucluong=0;
                                            }else{
                                                $mucluong=$userinfo->cv_money_id;
                                            }
                                             echo GetLuong($mucluong); ?>
                                    </small>
                                    <small><i class="fa fa-envelope"></i>
                                          <?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){ 
                                            if(empty($userinfo->use_email)){echo ' Chưa cập nhật';}else{echo $userinfo->use_email;}
                                            ?>
                                                
                                          <?php }else{ ?>
                                          <b style="color:#ff0000">Đăng nhập để xem</b>
                                          <?php } ?>
                                    </small>
                                    <small><i class="fa fa-phone"></i>
                                          <?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){ 
                                            if(empty($userinfo->use_phone)){echo ' Chưa cập nhật';}else{echo $userinfo->use_phone;}
                                            ?>
                                                
                                          <?php }else{ ?>
                                          <b style="color:#ff0000">Đăng nhập để xem</b>
                                          <?php } ?>
                                    </small>
                                    <ul>
                                        <li><a data-original-title="facebook" class="careerfy-icon careerfy-facebook-logo"></a></li>
                                        <li><a data-original-title="twitter" class="careerfy-icon careerfy-twitter-logo"></a></li>
                                        <li><a data-original-title="linkedin" class="careerfy-icon careerfy-linkedin-button"></a></li>
                                        <li><a data-original-title="google-plus" class="careerfy-icon careerfy-google-plus-logo-button"></a></li>
                                        <li><a data-original-title="dribbble" class="careerfy-icon careerfy-dribbble-logo"></a></li>
                                    </ul>
                                    <a href="javascript:void(0);" class="careerfy-candidate-download-btn"><i class="careerfy-icon careerfy-download-arrow"></i> Lưu hồ sơ</a>
                                    <div style="clear:both;height:7px;"></div>
                                    <a href="javascript:void(0);" class="careerfy-candidate-download-btn"><i class="fa fa-phone"></i> Liên hệ ứng viên</a>
                         </div>
                    </div>
                </aside>
                <div class="careerfy-column-9">
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-candidate-editor">
                            <div class="careerfy-content-title"><h3 style="margin-top:0px;font-size:20px;font-weight:400;">Về <?php echo $userinfo->use_first_name ?></h3></div>
                            <div class="careerfy-jobdetail-services">
                                        <ul class="careerfy-row">
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-salary"></i>
                                                <div class="careerfy-services-text">Lương <small><?php if(intval($userinfo->cv_money_id)==0){echo "Thỏa thuận";}else{ echo GetLuong($userinfo->cv_money_id);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-social-media"></i>
                                                <div class="careerfy-services-text">Cấp bậc <small><?php if(intval($userinfo->cv_capbac_id)==0){echo "Chưa cập nhật";}else{ echo GetCapBac($userinfo->cv_capbac_id);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-briefcase"></i>
                                                <div class="careerfy-services-text">Kinh nghiệm <small><?php if(intval($userinfo->cv_exp)==0){echo "Chưa có kinh nghiệm";}else{ echo Getexp($userinfo->cv_exp);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-user"></i>
                                                <div class="careerfy-services-text">Giới tính <small><?php if($userinfo->use_gioi_tinh==0){
                                                    echo"Chưa cập nhật";
                                                  }else if($userinfo->use_gioi_tinh==1){
                                                    echo "Nam";
                                                  }else{
                                                    echo "Nữ";
                                                  } ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-network"></i>
                                                <div class="careerfy-services-text">Ngành nghề <small><?php if(intval($userinfo->cv_cate_id)==0){echo "Chưa cập nhật";}else{ echo GetCategory($userinfo->cv_cate_id);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-mortarboard"></i>
                                                <div class="careerfy-services-text">Học vấn <small><?php if(intval($userinfo->cv_hocvan)==0){echo "Chưa cập nhật";}else{ echo Geteduhome($userinfo->cv_hocvan);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="fa fa-map-marker"></i> 
                                                 <div class="careerfy-services-text">Địa chỉ <small><?php 
                                                    if(empty($userinfo->use_address)){echo ' Chưa cập nhật';}else{echo $userinfo->use_address;}
                                                    ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="fa fa-map-marker"></i> 
                                                <div class="careerfy-services-text">Nơi làm việc<small><?php if(intval($userinfo->cv_city_id)==0){echo "Chưa cập nhật";}else{ echo Getcitybyindex($userinfo->cv_city_id);} ?></small></div>
                                            </li>
                                            <li class="careerfy-column-4">
                                                <i class="careerfy-icon careerfy-calendar-1"></i> 
                                                <div class="careerfy-services-text">Ngày sinh<small><?php echo date("d/m/Y",$userinfo->use_birth_day); ?></small></div>
                                            </li>
                                        </ul>
                             </div>
                             <div class="careerfy-content-title"><h2>Mục tiêu nghề nghiệp</h2></div>
                             <div class="careerfy-description">
                             <?php if(empty($userinfo->cv_muctieu)){echo "Mục tiêu nghề nghiệp chưa cập nhật";}else{ echo $userinfo->cv_muctieu ;} ?>
                             </div>
                             <div class="careerfy-content-title"><h2>Kỹ năng bản thân</h2></div>
                             <div class="careerfy-description">
                             <?php if(empty($userinfo->cv_kynang)){echo "Chưa cập nhật";}else{ echo $userinfo->cv_kynang;} ?>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

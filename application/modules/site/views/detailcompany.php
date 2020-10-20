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
<section class="inner-header-title  detailcom" style="background-image:url(images/banner-10.jpg);">
	<div class="container">
		<h1>Nhà tuyển dụng: <?php echo $itemcom->usc_company ?></h1>
	</div>
</section>
<div class="clearfix"></div>
<section class="detail-desc">
				<div class="container white-shadow">				
					<div class="row">
						<div class="detail-pic">
							<img src="<?php gethumbnail(geturlimageAvatar($itemcom->usc_create_time).$itemcom->usc_logo,$itemcom->usc_logo,$itemcom->usc_create_time,155,155,95) ?>" class="detailecom" onerror='this.onerror=null;this.src="images/no-image.png";' alt="<?php echo $n->usc_company ?>">					
						</div>
						<div class="detail-status">
							<!--<span>10 Min Days Ago</span>-->
						</div>
					</div>					
					<div class="row bottom-mrg">					
						<div class="col-md-12 col-sm-12">
							<div class="detail-desc-caption">
								<h4><?php echo $itemcom->usc_company; ?></h4>
							</div>
                            <div class="get-touch">								
								<ul>
									<li><i class="fa fa-map-marker"></i><span><?php echo $itemcom->usc_address ?></span></li>
									<li><i class="fa fa-envelope"></i><span><?php if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
                                        if(empty($itemcom->usc_email)){echo "Chưa cập nhật";}else{ echo $itemcom->usc_email;}
                                    }else{
                                        echo "<b style='' class='btn_login_do' data-type='0'>Đăng nhập để xem</b>";
                                    }?></span></li>
									<li><i class="fa fa-globe"></i><span><?php echo $itemcom->usc_website ?></span></li>
									<li><i class="fa fa-phone"></i><span><?php 
                                    if(isset($_SESSION['UserInfo']) && !empty($_SESSION['UserInfo'])){
                                        if(empty($itemcom->usc_phone)){
                                            echo "Chưa cập nhật";
                                        }else{
                                        echo $itemcom->usc_phone;
                                        }
                                    }else{
                                        echo "<b style='' class='btn_login_do' data-type='0'>Đăng nhập để xem</b>";
                                    }
                                    ?></span></li>
									<li><i class="fa fa-users"></i><span><?php echo GetQuyMoCty($itemcom->usc_size); ?></span></li>
								</ul>
							</div>
						</div>						
												
					</div>					
					<div class="row no-padd">
						<div class="detail pannel-footer">						
							<div class="col-md-5 col-sm-5">
								<ul class="detail-footer-social">
									<li><a><i class="fa fa-facebook"></i></a></li>
									<li><a><i class="fa fa-google-plus"></i></a></li>
									<li><a><i class="fa fa-twitter"></i></a></li>
									<li><a><i class="fa fa-linkedin"></i></a></li>
									<li><a><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>							
							<div class="col-md-7 col-sm-7">
								<div class="detail-pannel-footer-btn pull-right">
									<!--<a class="footer-btn grn-btn" title="">Favourite</a>-->
									<a class="footer-btn blu-btn" title="">Nộp đơn</a>
								</div>
							</div>							
						</div>
					</div>					
				</div>
</section>
<section class="full-detail-description full-detail">
				<div class="container">
					<div class="row row-bottom">
						<h2 class="detail-title">Thông tin chi tiết </h2>
						<?php echo $itemcom->usc_company_info ?>
					</div>
					<div class="row row-bottom">
					<h2 class="detail-title">Công ty đang tuyển <?php if(count($morejob)== 6){ ?> 
                            <a href="javascript:void(0);" class="pull-right viewall">Xem tất cả</a>
                            <?php } ?></h2>
					<?php if(!empty($morejob)){
                              foreach($morejob as $n){
                       ?>
                            <div class="col-md-4 col-sm-6">
    							<div class="grid-view brows-job-list">
    								<div class="brows-job-company-img">
    									<img src="<?php gethumbnail(geturlimageAvatar($n->usc_create_time).$n->usc_logo,$n->usc_logo,$n->usc_create_time,80,80,85) ?>" alt="<?php echo $n->usc_company ?>">
    								</div>
    								<div class="brows-job-position">
    									<h3><a target="_blank" href="<?php echo base_url()."".vn_str_filter($n->new_title)."-job".$n->new_id.".html"; ?>"><?php echo $n->new_title ?></a> 
                                                                </h3>
    									<p><span>@ <?php echo $n->usc_company ?></span></p>
    								</div>
    								<div class="job-position">
    									<span class="job-num"><?php if(intval($n->new_so_luong) < 1){echo "1 vị trí";}else{ echo $n->new_so_luong." vị trí";} ?></span>
    								</div>
    								<div class="brows-job-type">
                                        <?php if($n->new_hinh_thuc > 0 && $n->new_hinh_thuc < 3){ ?>
                                                                  <span class="full-time"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else if($n->new_hinh_thuc >= 3 && $n->new_hinh_thuc < 5) { ?>
                                                                  <span class="freelanc"><?php echo GetTypeJob($n->new_hinh_thuc) ?></span>
                                                                  <?php }else{ ?>
                                                                  <span class="part-time"><?php echo GetTypeJob($n->new_hinh_thuc)?></span>
                                        <?php } ?>
    								</div>
    								<ul class="grid-view-caption">
    									<li>
    										<div class="brows-job-location">
    											<p><i class="fa fa-map-marker"></i><?php echo Getcitybyindex($n->new_city) ?></p>
    										</div>
    									</li>
    									<li>
    										<p><span class="brows-job-sallery"><i class="fa fa-money"></i><?php echo GetLuong($n->new_money) ?></span></p>
    									</li>
    								</ul>
                                    <?php if($n->new_hot==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">HOT</span>
                                                                <?php } ?>
                                                                <?php if($n->new_do==1||$n->new_cao==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">VIP</span>
                                                                <?php } ?>
                                                                <?php if($n->new_gap==1){ ?>
                                                                <span class="tg-themetag tg-featuretag">Tuyển gấp</span>
                                                                <?php } ?>
    								
    							</div>
    						</div>
                                   
                                            
                         <?php } }else{
                            echo "<div class='col-md-12'><h5>Không tìm thấy kết quả phù hợp</h5></div>";
                         } ?> 
					</div>
					
				</div>
</section>

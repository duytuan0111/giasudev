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
<!-- Title Header Start -->
			<section class="inner-header-title detailcom" style="background-image:url(images/banner-10.jpg);">
				<div class="container">
					<h1><?php echo $itemjob->new_title ?></h1>
				</div>
			</section>
			<div class="clearfix"></div>
			<!-- Title Header End -->
<section class="detail-desc">
				<div class="container white-shadow">
				
					<div class="row">
					
						<div class="detail-pic">
							<img height="120px" width="120px" src="<?php gethumbnail(geturlimageAvatar($itemjob->usc_create_time).$itemjob->usc_logo,$itemjob->usc_logo,$itemjob->usc_create_time,155,155,85) ?>" alt="<?php echo $itemjob->usc_company ?>" onerror='this.onerror=null;this.src="images/no-image.png";'>
							
						</div>
						
						<div class="detail-status">
							<!--<span>2 Days Ago</span>-->
						</div>
						
					</div>
					
					<div class="row bottom-mrg">
						<div class="col-md-12 col-sm-12">
							<div class="detail-desc-caption">
								<h4><?php echo $itemjob->usc_company ?> </h4>
								<p class="designation"><?php                        
                                                    $arr=explode(',',$itemjob->new_cat_id);
                                                    for($i=0;$i< count($arr);$i++){
                                                        echo "<a href='javascript:void(0);' class=''>".GetCategory(intval($arr))."</a>";
                                                    } 
                                                    ?>
                                </p>
								<ul>
									<li><i class="fa fa-briefcase"></i><span><?php echo GetTypeJob($itemjob->new_hinh_thuc) ?></span></li>
									<li><i class="fa fa-flask"></i><span><?php echo Getexp($itemjob->new_exp) ?></span></li>
                                    <li><i class="fa fa-map-marker"></i><span><?php echo Getcitybyindex($itemjob->new_city) ?> </span></li>
									<li><i class="fa fa-venus-mars"></i><span><?php if(empty($itemjob->new_gioi_tinh)){echo "Không yêu cầu";}else{ echo $itemjob->new_gioi_tinh;} ?></span></li>
									<li><i class="fa fa-level-up"></i><span><?php echo GetCapBac($itemjob->new_cap_bac) ?></span></li>
									<li><i class="fa fa-calendar"></i><span><?php echo date('F j, Y',$itemjob->new_han_nop); ?></span></li>
									<li><i class="fa fa-money"></i><span><?php echo GetLuong($itemjob->new_money) ?>/Month</span></li>                                    
                                    <li><i class="fa fa-graduation-cap"></i><span><?php if(empty($itemjob->new_bang_cap)){echo "Không yêu cầu";}else{ echo Getedu($itemjob->new_bang_cap);} ?></span></li>
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
									<a class="footer-btn grn-btn" title="">Nộp đơn</a>
									<a class="footer-btn blu-btn" title="">Lưu việc</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
<!-- SubHeader -->
<section class="full-detail-description full-detail jobdetail">
				<div class="container">
					<div class="row row-bottom">
                        <h2 class="detail-title">Mô tả công việc</h2>
                        <?php if(empty($itemjob->new_mota)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_mota;} ?>
                    </div>
                    <div class="row row-bottom">
                        <h2 class="detail-title">Yêu cầu kỹ năng</h2>
                        <?php if(empty($itemjob->new_yeucau)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_yeucau;} ?>
                    </div>
                    <div class="row row-bottom">
                        <h2 class="detail-title">Quyền lợi được hưởng</h2>
                        <?php if(empty($itemjob->new_quyenloi)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_quyenloi;} ?>
                    </div>
                    <div class="row row-bottom">
                        <h2 class="detail-title">Quyền lợi được huỏng</h2>
                        <?php if(empty($itemjob->new_ho_so)){echo "Nội dung chưa cập nhật";}else{ echo $itemjob->new_ho_so;} ?>
                    </div>
                    
                </div>
                <div class="container">
                <div class="row">
                    <h2 class="detail-title">Việc làm liên quan</h2>
                    <div class="row row-bottom">
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
                </div>
</section>
<!-- SubHeader -->

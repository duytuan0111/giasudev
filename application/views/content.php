<?php 
$CI=&get_instance();
$CI->load->model('site/site_model');
$footer=$CI->site_model->getconfig();
//$urluri=
//if(current_url() == base_url())
//{
//   header("HTTP/1.1 301 Moved Permanently"); 
//   header("Location: $canonical");
//   exit();
//}
$check=false;
$taohoso=site_url('dang-ky-chung');
$usertype=3;
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){

  $tg=$_SESSION['UserInfo'];
  $usertype=$tg['UserType'];
  if($usertype ==0){
    $taohoso=site_url('mn-hv-dang-tin');
  }else{
    $taohoso=site_url('mn-gia-su-cap-nhat-thong-tin');
  }
// var_dump($active); die();
  $check=true;
}
$detect = new Mobile_Detect;
?>
<!-- Main Banner Section Start -->
<div class="container">
  <hr class="timeline" style="width: 1%;">
</div>
<div class="clearfix"></div>
<?
if($usertype==1)
{
?>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12 titledetail">
                <div class="tit_hd">
                    <h3><i class="fa fa-ntd-logout"></i> Lớp có học phí cao nhất</h3> 
                    <a href="<?php echo site_url('tim-lop-hoc') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
                </div>
            </div>  
            <div class="col-md-12 topmoney">
                <div class="main_hd slick">
                    <?php if(!empty($lstitem)){
                        $tg=0;
                        foreach($lstitem as $n){ 
                            if($tg%12==0){
                                echo "<div class='box_slider_hd'>";
                            }  ?>
                            <div class="col-md-4 col-xs-12 padd-l-5 padd-r-5">
                                <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                                    <div class="company_logo">
                                        <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>">
                                            <?php if(!empty($n->Image)){?>
                                                <img src="<?php echo base_url(); ?>upload/images/<?php echo $n->Image  ?>" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                            <?php }else{ ?>
                                                <img src="images/no-image2.png" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="right_item">
                                        <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>" class="title_new"><i class="fa fa-online"></i><?php echo $n->ClassTitle ?></a>
                                        <a href="" title="" class="title_co"><i class="fa fa-giasuname"></i><?php echo $n->Name ?> <i class="fa fa-chat"></i></a>
                                        <span class="money_item">Từ: <span><?php echo number_format($n->Money)." vnđ/h" ?></span></span>
                                        <span class="time_item"><?php echo Getcitybyindex($n->City) ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($tg%12==11){
                                echo "</div>";
                            } else if($tg==count($lstitem)&&$tg%12 != 11){
                                echo "</div>";
                            }
                            $tg+=1;
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
  </section>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12">
          <div class="titlesearch">                 
              <h3 class="vltg"><i class="fa fa-uv-newsest"></i> <span>Lớp mới đang tìm gia sư</span></h3>
          </div>
          <div class="main_itg">
              <?php
              if(!empty($newitem)){
                  foreach($newitem as $n){ ?>
                      <div class="itemnews">
                          <div class="itemnews_l">
                              <a class="logouser">
                                  <?php if(!empty($n->Image)){?>
                                     <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"><img src="<?php echo base_url(); ?>upload/images/<?php echo $n->Image  ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' /></a> 
                                  <?php }else{ ?>
                                    <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"> <img src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' /></a> 
                                  <?php } ?>
                              </a>
                              
                              <span><?php echo date("d/m/Y",strtotime($n->CreateDate)); ?></span>
                          </div>
                          <div class="itemnews_r">
                              <a  href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" class="item-uv-name" tabindex="0"><i class="fa fa-online"></i> <?php echo $n->ClassTitle ?> </a>
                              <p><?php $gn_text=$n->DescClass; 
                              if ( strlen( $n->DescClass ) > 150 ) {
                                  $gn_text = substr( $n->DescClass, 0, 150 );
                                  $space   = strrpos( $gn_text, ' ' );
                                  $gn_text = substr( $gn_text, 0, $space ). '...';           
                              }
                              echo $gn_text ;  ?></p>  
                              <span class="btn btn-freelance"><?php echo number_format($n->Money)." vnđ/h" ?></span> 
                              <span class="btn"><?php $tg=explode(',',$n->LearnType);
                              echo GetLearnType($tg[0]); ?></span>
                              <span class="btn"><?php echo Getcitybyindex($n->City) ?></span>
                              <span class="xacthuc"><i class="fa fa-shield" data-toggle="tooltip" data-placement="top" title="Phụ huynh đã xác thực"></i><i data-toggle="tooltip" data-placement="top" title="Chat với học viên" class="fa fa-uv-chat-cam"></i></span>
                              <span class="dadenghiday">Đã đề nghị dạy:&nbsp;&nbsp;<?php echo $n->denghiday  ?><i class="fa fa-user-dnd"></i></span>
                          </div>
                      </div>
                  <?php }
              }
              else
              {
                  echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
              } ?>
          </div>
         <!--  <div class="home_camnang">
              <div class="tit_hd">
                <h3><img src="images/ic_cn.png" alt="Cẩm nang nghề nghiệp"/><span>Cẩm nang nghề nghiệp</span></h3>
                <a href="" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
              </div>
              <div class="main_cn">
                <div class="row">
                  <?php $news = $this->db->query('SELECT b.id,b.alias,b.title,b.image,b.sapo,b.created_day,c.`name`,c.alias as aliascat,c.id as idcat FROM baiviet as b inner join chuyenmuc as c on b.cid=c.id WHERE b.cid=2 and b.status=1 ORDER BY b.id DESC LIMIT 6'); 
                  if($news->num_rows()>0){
                    foreach($news->result() as $n){                               
                      ?>
                      <div class="col-md-4 col-xs-12 item_cn">
                        <img src="upload/news/thumb/240/<?php echo $n->image==''?'images-09.jpg':$n->image; ?>" alt="<?php echo $n->title; ?>" title="<?php echo $n->title; ?>"/>
                        <a class="title_cn" href="<?php echo site_url($n->alias.'-b'.$n->id.'.html'); ?>"><?php echo $n->title; ?></a>
                        <p><?php
                        $gn_text=$n->sapo;
                        if ( strlen( $n->sapo ) > 70 ) {
                          $gn_text = substr( $n->sapo, 0, 70 );
                          $space   = strrpos( $gn_text, ' ' );
                          $gn_text = substr( $gn_text, 0, $space ). '...';           
                        }
                        echo $gn_text ;
                        ?></p>
                      </div>
                    <?php } 
                  } ?>                
                </div>
              </div>
          </div> -->
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="box_job_search tagwork uvonline">
            <!-- <h2>Phụ huynh đang online</h2> -->
            <!-- <div class="clearfix"></div> -->
           <!--  <div class="list_workonline">
                <?php if(!empty($lstonline)){
                  foreach($lstonline as $n){ ?>
                      <div class="item-uv-online">
                          <div class="item-uv-onlien-job"><a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"><i class="fa fa-online"></i> <?php echo $n->ClassTitle ?></a></div>
                          <div class="item-uv-name"><a href="">Học phí: <?php echo number_format($n->Money)." vnđ/buổi" ?> </a><span><span>Địa điểm:</span> <?php echo Getcitybyindex($n->City); ?></span></div>
                          <div class="item-uv-online-chat">
                              <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với phụ huynh</span>
                              <span class="uvonline-kinhnghiem"><span>Hình thức: </span><?php $tg=explode(',',$n->LearnType);
                              echo GetLearnType($tg[0]);
                              ?></span>
                          </div>
                      </div>
                  <?php }
                } ?>
            </div> -->
          </div>
          <div class="uvmienphi">
            <div class="box-f box-document">
                <h3 class="title">Đăng tin làm gia sư</h3>
                <ul>
                    <li>Kết nối, tuyển dụng và quản lý nhân tài</li>
                    <li>Talent Solution - Giải pháp tuyển dụng toàn diện dành cho doanh nghiệp được sáng tạo độc quyền bởi timviec365.com.vn</li>
                </ul>
                <span class="btnuvboxcreatedocument">Gửi email ngay</span>
            </div>
            <div class="box-f box-adsrecruit">
                <h3 class="title">Cẩm nang làm gia sư</h3>
                <ul>
                    <li>Tạo sự khác biệt cho thương hiệu Công ty</li>
                    <li>Thông tin tuyển dụng của bạn sẽ nổi bật hơn nhờ nội dung đăng tuyển được thiết kế hấp dẫn nhấn mạnh văn hóa và thương hiệu Công ty</li>
                </ul>
                <span class="btnuvboxcruit">Quảng bá ngay</span>
            </div>
            <div class="box-f box-disk">
                <h3 class="title">Tạo CV online</h3>
                <ul>
                    <li>Tham khảo mức lương trên thị trường</li>
                    <li>Trả lương cho nhân viên phù hợp hơn ở từng vị trí</li>
                </ul>
                <span class="btnuvboxcreatedocument">Ước tính ngay</span>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section> 
<?
}
else if($usertype==0)
{
?>
  <div class="container col-popover">
    <div class="tit_hd">
      <div class="ir_h3"><h2><img src="images/icon-gia-su-blue.png" alt="Gia sư tiếng anh, nhật, hàn, trung"/><span>Gia sư tiếng Anh, Nhật, Hàn, Trung</span></h2>
      </div>
      <a href="<?php echo site_url('tim-giao-vien-day-kem') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
    </div>
    <div class="">
      <div class="main_hd slick">
        <?php if(!empty($tinmoinhat)){
          $tg=0;
          foreach($tinmoinhat as $n){ 
            if($tg%18==0){
              echo "<div class='box_slider_hd'>";
            }
            ?>
            <div class="col-md-4 col-xs-12 padd-l-5 padd-r-5">
              <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                <div class="company_logo">
                  <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>">
                    <?php if(!empty($n->Image)){?>
                      <?php $tg1= explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                      <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg1[2]."/".$tg1[1]."/".$tg1[0]."/".$n->Image  ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                    <?php }else{ ?>
                      <img src="<?php gethumbnail('images/no-image2.png','no-image2.png',strtotime($n->CreateDate),60,60,80) ?>" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                    <?php } ?>
                  </a>
                </div>
                <div class="right_item">
                  <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_new"><i class="fa fa-online"></i><?php echo $n->TitleView ?></a>
                  <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_co"><i class="fa fa-giasuname"></i><?php echo $n->Name ?> <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i></a>
                  <span class="money_item">Từ: <span><?php echo number_format($n->Free)." vnđ/h" ?></span></span>
                  <span class="time_item"><?php echo $n->CityName ?></span>
                </div>
              </div>
            </div>
            <?php
            if($tg%18==17){
              echo "</div>";
            } else if($tg==count($tinmoinhat)&&$tg%18 != 17){
              echo "</div>";
            }
            $tg+=1; 
          } 
        } ?>
      </div>
    </div>
  </div>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12 padd-r-5">
          <div class="vl_tuyengap">
            <div class="tit_hd">
              <div class="ir_h3">   
                <h2 class="vltg"><img src="images/icon-gia-su-blue.png" alt="gia su toan ly hoa"/><span>Gia sư Toán, Lý, Hóa</span></h2>
              </div>
              <a href="<?php echo site_url('tim-giao-vien-day-kem') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
            </div>
            <div class="main_tg">
              <?php if(!empty($toanlyhoa)){
                foreach($toanlyhoa as $n){ 
                  ?>
                  <div class="col-md-6 col-xs-12 padd-l-5 padd-r-5">
                    <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                      <div class="company_logo">
                        <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>">
                          <?php if(!empty($n->Image)){?>
                            <?php $tg=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                            <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$n->Image  ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                          <?php }else{ ?>
                            <img src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                          <?php } ?>
                        </a>
                      </div>
                      <div class="right_item">
                        <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_new"><i class="fa fa-online"></i><?php echo $n->TitleView ?></a>
                        <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_co"><i class="fa fa-giasuname"></i><?php echo $n->Name ?> <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i></a>
                        <span class="money_item">Từ: <span><?php echo number_format($n->Free)." vnđ/h" ?></span></span>
                        <span class="time_item"><?php echo $n->CityName ?></span>
                      </div>
                      <span class="oldview">Đã xem</span>
                    </div>
                  </div>
                  <?php
                } 
              } ?>
            </div>
          </div>
          <div class="banner_cv">
            <a href="#" title="#"><img class="bannerads" src="images/banner2.png" alt="#"/></a>
          </div>
          <div class="vl_lc">
            <div class="tit_hd">
              <div class="ir_h3">
                <h2><img src="images/icon-gia-su-blue.png" alt="gia sư văn sử địa"/><span>Gia sư văn, sử, địa</span></h2>
              </div>
              <a href="<?php echo site_url('tim-giao-vien-day-kem') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
            </div>
            <div class="main_lc">
              <?php if(!empty($vansudia)){
                foreach($vansudia as $n){ 
                  ?>
                  <div class="item_lc">
                    <div class="col-md-3 col-xs-12 padd-0">
                      <div class="giasu_logo">
                        <!--  -->
                        <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>">
                          <?php if(!empty($n->Image)){?>
                            <?php $tg=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                            <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$n->Image  ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                          <?php }else{ ?>
                            <img src="images/no-image2.png" alt="#" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                          <?php } ?>
                          <span class="viewnow">Xem hồ sơ</span>
                        </a>
                      </div>
                    </div>
                    <div class="col-md-9 col-xs-12">
                      <div class="giasu_info">
                        <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="giasu_name"><i class="fa fa-online"></i><?php echo $n->Name ?> <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i></a>
                        <div title="#" class="giasu_titleview">
                          <span>Gia sư:</span><?php echo str_replace('Gia sư','',$n->TitleView);?>
                        </div>
                        <div>
                          <span>Khu vực: <span><?php echo $n->CityName ?></span></span>
                        </div>
                        <span class="giasu_luong">Từ: <span><?php echo number_format($n->Free)." vnđ/h" ?></span></span>
                        <p><?php
                        $gn_text=$n->Description;
                        if ( strlen( $n->Description ) > 110 ) {
                          $gn_text = substr( $n->Description, 0, 110 );
                          $space   = strrpos( $gn_text, ' ' );
                          $gn_text = substr( $gn_text, 0, $space ). '...';           
                        }
                        echo $gn_text ; 
                        ?></p>
                      </div>
                    </div>
                  </div>
                <?php } 
              } ?>
            </div>
          </div>
          <div class="row timkiemungvien">
            <div class="col-md-6 padd-r-5">
                <div class="box-f box-document">
                    <h3 class="title">Gửi email cho ứng viên</h3>
                    <ul>
                        <li>Kết nối, tuyển dụng và quản lý nhân tài</li>
                        <li>Talent Solution - Giải pháp tuyển dụng toàn diện dành cho doanh nghiệp được sáng tạo độc quyền bởi timviec365.com.vn</li>
                    </ul>
                    <span class="btnuvboxcreatedocument">Gửi email ngay</span>
                </div>
            </div>
            <div class="col-md-6 padd-l-5">
                <div class="box-f box-adsrecruit">
                    <h3 class="title">Quảng bá tuyển dụng</h3>
                    <ul>
                        <li>Tạo sự khác biệt cho thương hiệu Công ty</li>
                        <li>Thông tin tuyển dụng của bạn sẽ nổi bật hơn nhờ nội dung đăng tuyển được thiết kế hấp dẫn nhấn mạnh văn hóa và thương hiệu Công ty</li>
                    </ul>
                    <span class="btnuvboxcruit">Quảng bá ngay</span>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="box_job_search cate">
            <h3>GIA SƯ THEO MÔN HỌC</h3>
            <div class="main_sc">
              <input type="text" placeholder="Nhập từ khóa..." id="keymonhon" name="keymonhoc">
              <ul class="right_tg">
                <?php if(!empty($giasutheomonhoc)){
                  foreach($giasutheomonhoc as $n)
                  { ?>
                    <li><a href="<?php echo base_url() ?>giao-vien&key=all&subject=<?php echo $n->ID ?>&topic=0&place=0&type=0&sex=0&order=last"><?php echo $n->SubjectName ?> <span>(<?php echo $n->sogiasu ?>)</span></a></li> 
                  <?php }
                } ?>
              </ul>
            </div>
          </div>
          <div class="box_job_search city">
            <h3>GIA SƯ THEO TỈNH THÀNH</h3>
            <div class="main_sc">
              <input type="text" placeholder="Nhập từ khóa..." id="keytinhthanh" name="keytinhthanh">
              <ul class="giasutt">
                <?php if(!empty($giasutheott)){
                  foreach($giasutheott as $n){?>
                    <li><a href="<?php echo base_url() ?>giao-vien&key=all&subject=0&topic=0&place=<?php echo $n->cit_id ?>&type=0&sex=0&order=last"><?php echo $n->cit_name ?> <span>(<?php echo $n->giasutt ?>)</span></a></li> 
                  <?php }
                } ?>
              </ul>
            </div>
          </div>
          <div class="box_job_search user">
            <h3>TÌM KIẾM HỒ SƠ GIA SƯ</h3>
            <div class="main_sc">        
              <form onsubmit="return false" action="" method="post">  
                <div class="input">
                  <input type="text" name="findkey" id="findkey" placeholder="Nhập từ khóa..." />
                </div>
                <div class="input">
                  <span class="icon-before"><img src="images/s_01.png" alt=""></span>
                  <select id="monhoc" name="monhoc">
                    <option value="">Chọn môn học</option>
                    <?php 
                    if(!empty($monhoc)){
                      foreach($monhoc as $n){ ?>
                        <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                      <?php }
                    } ?> 
                  </select>
                </div>
                <div class="input">
                  <span class="icon-before"><img src="images/s_01.png" alt=""></span>
                  <select id="chudehoc" class="city_ab_tag">                        
                    <option value="" >Chọn chủ đề môn học</option>
                  </select>
                </div>
                <div class="input">
                  <span class="icon-before" style="top:8px"><img src="images/s_02.png" alt=""></span>
                  <select id="tinhthanh" class="mucluong_ab_tag">                        
                    <option data-tokens="0" value="">Tỉnh thành</option>
                    <option data-tokens="1" value="1">Hà Nội</option> 
                    <option data-tokens="45" value="45">Hồ Chí Minh</option> 
                    <option data-tokens="49" value="49">An Giang</option> 
                    <option data-tokens="47" value="47">Bà Rịa Vũng Tàu</option> 
                    <option data-tokens="3" value="3">Bắc Giang</option> 
                    <option data-tokens="4" value="4">Bắc Kạn</option> 
                    <option data-tokens="50" value="50">Bạc Liêu</option> 
                    <option data-tokens="5" value="5">Bắc Ninh</option> 
                    <option data-tokens="52" value="52">Bến Tre</option> 
                    <option data-tokens="46" value="46">Bình Dương</option> 
                    <option data-tokens="51" value="51">Bình Phước</option> 
                    <option data-tokens="31" value="31">Bình Thuận</option> 
                    <option data-tokens="30" value="30">Bình Định</option> 
                    <option data-tokens="53" value="53">Cà Mau</option> 
                    <option data-tokens="48" value="48">Cần Thơ</option> 
                    <option data-tokens="6" value="6">Cao Bằng</option> 
                    <option data-tokens="34" value="34">Gia Lai</option> 
                    <option data-tokens="10" value="10">Hà Giang</option> 
                    <option data-tokens="11" value="11">Hà Nam</option> 
                    <option data-tokens="35" value="35">Hà Tĩnh</option> 
                    <option data-tokens="9" value="9">Hải Dương</option> 
                    <option data-tokens="2" value="2">Hải Phòng</option> 
                    <option data-tokens="56" value="56">Hậu Giang</option> 
                    <option data-tokens="8" value="8">Hòa Bình</option> 
                    <option data-tokens="12" value="12">Hưng Yên</option> 
                    <option data-tokens="28" value="28">Khánh Hòa</option> 
                    <option data-tokens="57" value="57">Kiên Giang</option> 
                    <option data-tokens="36" value="36">Kon Tum</option> 
                    <option data-tokens="14" value="14">Lai Châu</option> 
                    <option data-tokens="29" value="29">Lâm Đồng</option> 
                    <option data-tokens="15" value="15">Lạng Sơn</option> 
                    <option data-tokens="13" value="13">Lào Cai</option> 
                    <option data-tokens="58" value="58">Long An</option> 
                    <option data-tokens="17" value="17">Nam Định</option> 
                    <option data-tokens="37" value="37">Nghệ An</option> 
                    <option data-tokens="16" value="16">Ninh Bình</option> 
                    <option data-tokens="38" value="38">Ninh Thuận</option> 
                    <option data-tokens="18" value="18">Phú Thọ</option> 
                    <option data-tokens="39" value="39">Phú Yên</option> 
                    <option data-tokens="40" value="40">Quảng Bình</option> 
                    <option data-tokens="41" value="41">Quảng Nam</option> 
                    <option data-tokens="42" value="42">Quảng Ngãi</option> 
                    <option data-tokens="19" value="19">Quảng Ninh</option> 
                    <option data-tokens="43" value="43">Quảng Trị</option> 
                    <option data-tokens="59" value="59">Sóc Trăng</option> 
                    <option data-tokens="20" value="20">Sơn La</option> 
                    <option data-tokens="61" value="61">Tây Ninh</option> 
                    <option data-tokens="21" value="21">Thái Bình</option> 
                    <option data-tokens="22" value="22">Thái Nguyên</option> 
                    <option data-tokens="44" value="44">Thanh Hóa</option> 
                    <option data-tokens="27" value="27">Thừa Thiên Huế</option> 
                    <option data-tokens="60" value="60">Tiền Giang</option> 
                    <option data-tokens="62" value="62">Trà Vinh</option> 
                    <option data-tokens="23" value="23">Tuyên Quang</option> 
                    <option data-tokens="63" value="63">Vĩnh Long</option> 
                    <option data-tokens="24" value="24">Vĩnh Phúc</option> 
                    <option data-tokens="25" value="25">Yên Bái</option> 
                    <option data-tokens="26" value="26">Đà Nẵng</option> 
                    <option data-tokens="32" value="32">Đắk Lắk</option> 
                    <option data-tokens="33" value="33">Đắk Nông</option> 
                    <option data-tokens="7" value="7">Điện Biên</option> 
                    <option data-tokens="55" value="55">Đồng Nai</option> 
                    <option data-tokens="54" value="54">Đồng Tháp</option>                         
                  </select>
                </div>
                <div class="input">
                  <span class="icon-before"><img src="images/icongioitinh.png" alt=""></span>
                  <select id="gioitinh" class="ngoaingu_ab_tag">                        
                    <option value="" ></option>
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>                         
                  </select>
                </div>
                <div class="input">
                  <span class="icon-before" style="top:8px"><img src="images/iconhinhthuchoc.png" alt=""></span>
                  <select id="hinhthuchoc" class="kinhnghiem_ab_tag">                        
                    <option value="">Chọn hình thức dạy</option>
                    <option value="1">Offline) Gặp mặt</option>
                    <option value="2">Online) Trực tuyến</option>                         
                  </select>
                </div>                          
                <center><input class="btn btnsearchuv" type="button" name="submit" value="Tìm kiếm"></center>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
<?
}
else if($usertype==3)
{
?>
  <div class="container col-popover">
    <div class="tit_hd">
      <div class="ir_h3"><h2><img src="images/icon-gia-su-blue.png" alt="Gia sư đang tìm lớp"/><span>Gia sư đang tìm lớp</span></h2>
      </div>
      <a href="<?php echo site_url('tim-giao-vien-day-kem') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
    </div>
    <div class="">
      <div class="main_hd slick">
        <?php if(!empty($tinmoinhat)){
          $tg=0;
          foreach($tinmoinhat as $n){ 
            if($tg%18==0){
              echo "<div class='box_slider_hd'>";
            }
            ?>
            <div class="col-md-4 col-xs-12 padd-l-5 padd-r-5">
              <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                <div class="company_logo">
                  <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>">
                    <?php if(!empty($n->Image)){?>
                      <?php $tg3=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                      <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg3[2]."/".$tg3[1]."/".$tg3[0]."/".$n->Image  ?>" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                    <?php }else{ ?>
                      <img src="<?php gethumbnail('images/no-image2.png','no-image2.png',strtotime($n->CreateDate),60,60,80) ?>" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                    <?php } ?>
                  </a>
                </div>
                <div class="right_item">
                   <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="title_new"><i class="fa fa-giasuname"></i><?php echo $n->Name ?> <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i></a>
                  <a class="title_co"><i class="fa fa-online"></i><?php echo $n->TitleView ?></a>
                
                  <span class="money_item">Từ: <span><?php echo number_format($n->Free)." vnđ/h" ?></span></span>
                  <span class="time_item"><?php echo $n->CityName ?></span>
                </div>
              </div>
            </div>
            <?php
            if($tg%18==17){
              echo "</div>";
            } else if($tg==count($tinmoinhat)&&$tg%18 != 17){
              echo "</div>";
            }
            $tg+=1; 
          } 
        } ?>
      </div>
    </div>
  </div>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12 titledetail">
                <div class="tit_hd">
                    <h3><i class="fa fa-ntd-logout"></i> Lớp có học phí cao nhất</h3> 
                    <a href="<?php echo site_url('tim-lop-hoc') ?>" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
                </div>
            </div>  
            <div class="col-md-12 topmoney">
                <div class="main_hd slick">
                    <?php if(!empty($lstitem)){
                        $tg=0;
                        foreach($lstitem as $n){ 
                            if($tg%12==0){
                                echo "<div class='box_slider_hd'>";
                            }  ?>
                            <div class="col-md-4 col-xs-12 padd-l-5 padd-r-5">
                                <div class="item_hd vip" data-object="<?php echo $n->UserID ?>" data-type="<?php echo $n->UserID ?>">
                                    <div class="company_logo">
                                        <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>">
                                            <?php if(!empty($n->Image)){?>
                                                <img src="<?php echo base_url(); ?>upload/images/<?php echo $n->Image  ?>"alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                            <?php }else{ ?>
                                                <img src="images/no-image2.png" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                            <?php } ?>
                                        </a>
                                    </div>
                                    <div class="right_item">
                                        <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" title="<?php echo $n->ClassTitle; ?>" class="title_new"><i class="fa fa-online"></i><?php echo $n->ClassTitle ?></a>
                                        <a href="" title="" class="title_co"><i class="fa fa-giasuname"></i><?php echo $n->Name ?> <i class="fa fa-chat"></i></a>
                                        <span class="money_item">Từ: <span><?php echo number_format($n->Money)." vnđ/h" ?></span></span>
                                        <span class="time_item"><?php echo Getcitybyindex($n->City) ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($tg%12==11){
                                echo "</div>";
                            } else if($tg==count($lstitem)&&$tg%12 != 11){
                                echo "</div>";
                            }
                            $tg+=1;
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>
  </section>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
   <!--    <div class="home_camnang">
        <div class="tit_hd">
          <h3><img src="images/ic_cn.png" alt="Cẩm nang nghề nghiệp"/><span>Cẩm nang nghề nghiệp</span></h3>
          <a href="" class="span_hd">Xem tất cả <img src="images/ic_muiten.png" alt="#"/></a>
        </div>
        <div class="main_cn">
          <div class="row">
            <?php $news = $this->db->query('SELECT b.id,b.alias,b.title,b.image,b.sapo,b.created_day,c.`name`,c.alias as aliascat,c.id as idcat FROM baiviet as b inner join chuyenmuc as c on b.cid=c.id WHERE b.cid=2 and b.status=1 ORDER BY b.id DESC LIMIT 6'); 
            if($news->num_rows()>0){
              foreach($news->result() as $n){                               
                ?>
                <div class="col-md-4 col-xs-12 item_cn">
                  <img src="upload/news/thumb/240/<?php echo $n->image==''?'images-09.jpg':$n->image; ?>" alt="<?php echo $n->title; ?>" title="<?php echo $n->title; ?>"/>
                  <a class="title_cn" href="<?php echo site_url($n->alias.'-b'.$n->id.'.html'); ?>"><?php echo $n->title; ?></a>
                  <p><?php
                  $gn_text=$n->sapo;
                  if ( strlen( $n->sapo ) > 70 ) {
                    $gn_text = substr( $n->sapo, 0, 70 );
                    $space   = strrpos( $gn_text, ' ' );
                    $gn_text = substr( $gn_text, 0, $space ). '...';           
                  }
                  echo $gn_text ;
                  ?></p>
                </div>
              <?php } 
            } ?>                
          </div>
        </div>
      </div> -->
    </div>
  </section>
  <section class="padd-top-20 padd-bot-30">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12">
          <div class="titlesearch">                 
              <h3 class="vltg"><i class="fa fa-uv-newsest"></i> <span>Lớp mới đang tìm gia sư</span></h3>
          </div>
          <div class="main_itg">
              <?php
              if(!empty($newitem)){
                  foreach($newitem as $n){ ?>
                      <div class="itemnews">
                          <div class="itemnews_l">
                              <a class="logouser">
                                  <?php if(!empty($n->Image)){?>
                                      <img src="<?php echo base_url(); ?>upload/images/<?php echo $n->Image  ?>" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                  <?php }else{ ?>
                                      <img src="images/no-image2.png" alt="<?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                                  <?php } ?>
                              </a>
                              <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" class="nameu" title="<?php echo $n->Name ?>"><?php echo $n->Name ?></a>
                              <span><?php echo date("d/m/Y",strtotime($n->CreateDate)); ?></span>
                          </div>
                          <div class="itemnews_r">
                              <a  href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" class="item-uv-name" tabindex="0"><i class="fa fa-online"></i> <?php echo $n->ClassTitle ?> </a>
                              <p><?php $gn_text=$n->DescClass;
                              if ( strlen( $n->DescClass ) > 150 ) {
                                  $gn_text = substr( $n->DescClass, 0, 150 );
                                  $space   = strrpos( $gn_text, ' ' );
                                  $gn_text = substr( $gn_text, 0, $space ). '...';           
                              }
                              echo $gn_text ;  ?></p>  
                              <span class="btn btn-freelance"><?php echo number_format($n->Money)." vnđ/h" ?></span> 
                              <span class="btn"><?php $tg=explode(',',$n->LearnType);
                              echo GetLearnType($tg[0]); ?></span>
                              <span class="btn"><?php echo Getcitybyindex($n->City) ?></span>
                              <span class="xacthuc"><i class="fa fa-shield" data-toggle="tooltip" data-placement="top" title="Phụ huynh đã xác thực"></i><i data-toggle="tooltip" data-placement="top" title="Chat với học viên" class="fa fa-uv-chat-cam"></i></span>
                              <span class="dadenghiday">Đã đề nghị dạy:&nbsp;&nbsp;<?php echo $n->denghiday  ?><i class="fa fa-user-dnd"></i></span>
                          </div>
                      </div>
                  <?php }
              }
              else
              {
                  echo "<div class='col-md-12'>Không tìm thấy bản ghi.</div>";
              } ?>
          </div>
        </div>
        <div class="col-md-4 col-xs-12">
          <div class="box_job_search user">
            <h3><i class="fa fa-userl"></i> Gia sư tiêu biểu</h3>
            <div class="boxfeature">
              <?php if(!empty($chude)){
                foreach($chude as $n){ ?>
                  <div class="itemfeature">
                  <div class="feature-icon">
                    <?php if(!empty($n->Image)){?>
                      <?php $tg=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                      <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$n->Image  ?>" alt="<?php echo $n->Name; ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                    <?php }else{ ?>
                     <img src="<?php gethumbnail('images/no-image2.png','no-image2.png',strtotime($n->CreateDate),60,60,80) ?>" alt="<?php echo $n->Name; ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                   <?php } ?>
                  </div>
                  <div class="feature-caption">
                    <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><i class="fa fa-online"></i><?php echo $n->Name ?> <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i></a>
                    <div title="#" class="feature_titleview"><span>Gia sư: </span><?php 
                      echo str_replace('Gia sư','',$n->TitleView); ?>
                    </div>
                    <div>
                      <span>Khu vực: <span><?php echo $n->CityName ?></span></span>
                    </div>
                    <span class="feature_luong">Từ: <span><?php echo number_format($n->Free)." vnđ/h" ?></span></span>
                  </div>
                  </div>    
                <?php   }
              } ?>
            </div>
          </div>
          <div class="box_hotline">
            <div class="bg1">
              <p>HOTLINE CHO NHÀ TUYỂN DỤNG</p>
              <strong><img src="images/vl9.png" alt="">HOTLINE:  0981509188</strong>
            </div>
            <div class="bg2">
              <p>HOTLINE CHO ỨNG VIÊN</p>
              <strong><img src="images/vl10.png" alt="">HOTLINE:  0981509188</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?
}
?>
     
<div class="clearfix"></div>  
      <!--<script src="js/theme6/jquery.slimscroll.min.js" type="text/javascript"></script>-->
<script src="<?php echo base_url() ?>combine.php?type=javascript&files=jquery.slimscroll.min.js"  type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var configulr='<?php echo base_url() ?>';
    $('#monhoc').select2({ width: '100%',placeholder:"Chọn môn học" });
    $('#chudehoc').select2({ width: '100%',placeholder: "Chọn chủ đề"});
    $('#gioitinh').select2({ width: '100%',placeholder:"Chọn giới tính" });
    $('#hinhthuchoc').select2({ width: '100%',placeholder:"Chọn hình thức học" });
    $('#tinhthanh').select2({ width: '100%',placeholder:"Chọn tỉnh thành" });
    $('#monhoc').change(function () {
      var monhoc=$(this).val();
      if(monhoc != '' || monhoc !=0){
        $.ajax(
        {
          url: configulr+"/site/Ajaxchude",
          type: "POST",
          data: { idmon: monhoc },
          dataType: 'json',
          beforeSend: function () {
            $("#boxLoading").show();
          },
          success: function (obj) {

            if(obj.kq != ''){
              var reponse=obj.kq;
              $("#chudehoc option").remove();                        
              $("#chudehoc").append(obj.data);                           

              $("#chudehoc").select2();
            }else{

            }
          },
          error: function (xhr) {
            alert("error");
          },
          complete: function () {
            $("#boxLoading").hide();
          }
        }); 
      }
    });

    $('.btnsearchuv').on('click',function(){
      var findkey=$('#findkey').val();
      var strsubj=$('#monhoc').val();
      var strtopic=$('#chudehoc').val();
      var strtinhthanh=$('#tinhthanh').val();
      var strgioitinh=$('#gioitinh').val();
      var strtype=$('#hinhthuchoc').val();
    
      $.ajax({
        url: configulr+"site/searchteacherheader", //  searchclass searchteacherheader
        type: "POST", 
        data: 
        { 

          key:findkey,
          subject:strsubj,
          topic:strtopic,
          place:strtinhthanh,
          type:strtype,
          sex:strgioitinh
        },
        dataType: 'json',
        beforeSend: function () {
          $("#boxLoading").show();
        },
        success: function (reponse) {
          if (reponse.kq == true) {
            window.location=reponse.data;
          }                      
        },
        error: function (xhr) {
          alert("error");
        },
        complete: function () {
          $("#boxLoading").hide();
        }
      }); 
    });

    
    /*index_dia_diem ,placeholder:"Chọn ngành nghề"*/
    if(jQuery(this).scrollTop()<566 && jQuery('hr.timeline').width()!=1170){	    	
      jQuery('hr.timeline').animate({
        'width': '100%'
      },800);
    }else{
      jQuery('hr.timeline').css('width','100%');
    }
    $('.right_tg').slimscroll({
      height: '400',
      allowPageScroll: true,
    });

    $('.giasutt').slimscroll({
      height: '400',
      allowPageScroll: true,
    });

    $("#keymonhon").keypress(function (e) {
      if (e.which === 13) {
        e.preventDefault();
        $.ajax(
        {
          url: configulr+"site/ajaxtimgiasutheomonhoc",
          type: "POST",
          data: { monhoc:$("#keymonhon").val() },
          dataType: 'json',
          beforeSend: function () {
            $("#boxLoading").show();
          },
          success: function (reponse) {
            $(".right_tg li").remove();
            /*$("#list_workonline").innerHTML = reponse.data;*/                        
            $(".right_tg").append(reponse.data); 
          },
          error: function (xhr) {
            alert("error");
          },
          complete: function () {
            $("#boxLoading").hide();
          }
        }); 
      }
    });

    $("#keytinhthanh").keypress(function (e) {
      if (e.which === 13) {
        e.preventDefault();
        $.ajax(
        {
          url: configulr+"site/ajaxtimgiasutheotinhthanh",
          type: "POST",
          data: { monhoc:$("#keytinhthanh").val() },
          dataType: 'json',
          beforeSend: function () {
            $("#boxLoading").show();
          },
          success: function (reponse) {
            $(".giasutt li").remove();
            /*$("#list_workonline").innerHTML = reponse.data;*/                        
            $(".giasutt").append(reponse.data); 
          },
          error: function (xhr) {
            alert("error");
          },
          complete: function () {
            $("#boxLoading").hide();
          }
        }); 
      }
    });
  });
</script>



<?php
$page = $this->uri->segment(2);
if ($page > 0) {
  $canonical_new = $canonical.'/'.$page;
} else {
  $canonical_new = $canonical;
}
$urlweb= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if($urlweb != $canonical_new)
{
   header("HTTP/1.1 301 Moved Permanently"); 
   header("Location: $canonical_new");
   exit();
}
?>
<div class="container">
 <?php $this->load->view('headerfun'); ?>
</div>
<style type="text/css">
  .teacher-name-h3 {
    display: inline-block;
    font-size: 15px;
    color: #00baba;
    font-weight: 500;
    margin-top: 0px;
    margin-bottom: 0px;
  }
  .h1-teacher {
    display: inline;
    float: right !important;
    padding-top: 10px;
    padding-left: 12px;
  }
  .teacher-h3-sp {
    height: 46px;
    background: #00baba;
    font-size: 18px;
    color: #fdfdfe;
    font-weight: 500;
    line-height: 48px;
    margin: 0;
    padding: 0;
    text-indent: 50px;
  }
  .ds-gs-moinhat {
    font-size: 18px;
    color: #2c2c2c;
    font-weight: 500;
    height: 36px;
    line-height: 36px;
    /* float: left; */
    background: #fff;
    margin-right: 5px;
    text-transform: uppercase;
    margin-left: 14px;
    margin-bottom: 22px;
  }

</style>
<section class="padd-top-30 padd-bot-30">
  <div class="container">
    <div class="row">
      <div class="col-md-12" style="overflow: hidden;">
        <div class="tit_hd resultfindteacher">
         <div class="ir_h3"><img src="images/icon-gia-su-blue.png" alt="Hồ sơ gia sư dạy <?php echo $keywork; ?>"/><h1 class="h1-teacher"> <?php if(strtolower($keywork)=='all' || empty($keywork)){echo "Tìm gia sư";}else{echo "Hồ sơ gia sư dạy ".$keywork;} ?></h1>
         </div>
         <span class="span_hd">Sắp xếp theo: 
           <select  id="slkbox" aria-label="lọc" name="slkbox">

            <option value="<?php echo $canonicals ?>"  <?php if(strtolower($order)=='last'){echo "selected";} ?>>Mới nhất</option>
            <option value="<?php echo $selectbox.'pricelow' ?>" <?php if(strtolower($order)=='pricelow'){echo "selected";} ?>>Lương từ thấp đến cao</option>
            <option value="<?php echo $selectbox.'pricehigh' ?>" <?php if(strtolower($order)=='pricehigh'){echo "selected";} ?>>Lương từ cao xuống thấp</option>                    
          </select>
        </span>
      </div>
    </div>
    <h2 class="ds-gs-moinhat">Danh sách gia sư mới nhất</h2>
    <div class="col-md-70 col-sm-12">
      <div class="main_giaovien" style="overflow: hidden; margin-bottom: 10px">
       <?php if(!empty($lstitem)){
        foreach($lstitem as $n){    
          ?>
          <div class="item_lc">
            <div class="col-md-3 col-sm-12 padd-0">
              <div class="giasu_logo">
                <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name;?>" target="_blank">
                  <?php if(!empty($n->Image)){?>
                    <?php $tg3=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
                    <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg3[2]."/".$tg3[1]."/".$tg3[0]."/".$n->Image  ?>" alt="gia sư <?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                  <?php }else{ ?>
                   <img src="images/no-image2.png" alt="gia sư <?php echo $n->Name ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
                 <?php } ?>
                 <span class="viewnow">Xem hồ sơ</span>
               </a>
             </div>
           </div>
           <div class="col-md-9 col-sm-12">
            <div class="giasu_info" style="margin-bottom: 15px">
              <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name ?>" class="giasu_name"><i class="fa fa-online"></i><h3 class="teacher-name-h3"><?php echo $n->Name ?></h3></a> <!-- <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i> -->
              <div title="#" class="giasu_titleview">
                <span>Gia sư: </span><?php echo str_replace('Gia sư','',$n->TitleView); ?>
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
   } 
   ?>

 </div>
 <div class="clearfix" style="overflow: hidden;">
   <div class="col-md-3 col-sm-12 padd-0"></div>
   <div class="col-md-9 col-sm-12">
    <div class="pagation">
      <?php echo $pagination; ?>
    </div>
  </div>
</div>           	


</div>
<div class="col-md-30 col-sm-12 col-right-search padd-l-0">
  <div class="box_job_search user">
    <div class="teacher-h3-sp"><i class="fa fa-userl"></i> <h2 style="display: inline-block; padding-left: 2px">Gia sư tiêu biểu</h2></div>
    <div class="boxfeature">
      <?php if(!empty($chude)){
        foreach($chude as $n){ ?>
          <div class="itemfeature">
          <div class="feature-icon">
            <?php if(!empty($n->Image)){?>
               <?php $tg4=explode('-',date('d-m-Y',strtotime($n->CreateDate))); ?>
              <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg4[2]."/".$tg4[1]."/".$tg4[0]."/".$n->Image  ?>" alt="<?php echo $n->Name; ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
            <?php }else{ ?>
             <img src="<?php gethumbnail('images/no-image2.png','no-image2.png',strtotime($n->CreateDate),60,60,80) ?>" alt="<?php echo $n->Name; ?>" onerror='this.onerror=null;this.src="images/no-image2.png";' />
           <?php } ?>
          </div>
          <div class="feature-caption">
            <a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>" title="<?php echo $n->Name; ?>" class="feature_name"><i class="fa fa-online"></i><h3 style="display: inline-block;background-color: #FFFFFF; color: #00baba; font-size: 15px; font-weight: 500; padding-left: 0px;text-transform: none; margin: -11px auto;"><?php echo $n->Name ?></h3> <!-- <i class="fa fa-chat" data-toggle="tooltip" title="Chat với gia sư"></i> --></a>
            <div title="#" class="feature_titleview"><span>Gia sư: </span><?php 
              echo str_replace('Gia sư','',str_replace(' ,', ', ', $n->TitleView)); ?>
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
<!-- <div class="box_job_search tagwork uvonline" style="display: none;">
  <h3>Gia sư đang online
  </h3>
  <div class="formtagwork">
    <div class="col-md-8 col-sm-12 padd-l-0 padd-r-5">
      <input placeholder="Nhập từ khóa" id="keyworktag" aria-label="từ khóa tìm gia sư" />
    </div>
    <div class="col-md-4 col-sm-12 padd-0">
      <select id="tag_city" class="city_ab_tag" name="tag_city" aria-label="tag">
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
  </div>
  <div class="clearfix"></div>
  <div class="list_workonline">
    <?php if(!empty($lstonline)){
      foreach($lstonline as $n){ ?>
        <div class="item-uv-online">
          <div class="item-uv-onlien-job"><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><i class="fa fa-online"></i> <?php echo $n->TitleView ?></a></div>
          <div class="item-uv-name"><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name ?></a><span><span>Từ:</span> <?php echo number_format($n->Free)." vnđ/h" ?></span></div>
          <div class="item-uv-online-chat">
            <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với gia sư</span>
            <span class="uvonline-kinhnghiem"><span>Hình thức: </span>
            <?php echo GetLearnType($n->WorkID); ?> 
          </span>
        </div>
      </div>
    <?php }
  } ?>

</div>
</div> -->
<div class="box_job_search topkeyword">
  <div class="teacher-h3-sp"> <i class="fa fa-key"></i> <h2 style="display: inline; padding-left: 2px">Top từ khóa</h2>
  </div>
  <div class="listtag">
    <ul>                                   
      <?php if(!empty($topkey)){
        foreach($topkey as $n){ ?>

          <li><a title="<?php echo  $n->keywork ?>" href="<?php $n->link ?>"><?php echo  $n->keywork ?></a></li>
      <?php
      } }
      ?>
    </ul>
  </div>
</div>
</div>
</div>
</div>
</section>
<script src="js/theme6/jquery.slimscroll.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
   var configulr='<?php echo site_url() ?>';
   $('.list_workonline').slimscroll({
    height: '700'

  });
   $('#tag_city').select2();
   $('#slkbox').select2({minimumResultsForSearch: -1});
   $("#keyworktag").keypress(function (e) {
    if (e.which === 13) {
      e.preventDefault();
      $.ajax(
      {

        url: configulr+"/site/ajaxlstteacher",
        type: "POST",
        data: { keytag:$("#keyworktag").val(),city:$('#tag_city').val() },
        dataType: 'json',
        beforeSend: function () {
          $("#boxLoading").show();
        },
        success: function (reponse) {
          $(".list_workonline div").remove();                      
          $(".list_workonline").append(reponse.data); 
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
   $('#tag_city').change(function () {
    var cityval=$(this).val();
    if(cityval != '' || cityval !=0){
     $.ajax(
     {

      url: configulr+"/site/ajaxlstteacher",
      type: "POST",
      data: { keytag:$("#keyworktag").val(),city:cityval },
      dataType: 'json',
      beforeSend: function () {
        $("#boxLoading").show();
      },
      success: function (reponse) {
        $(".list_workonline div").remove();
        /*$("#list_workonline").innerHTML = reponse.data;*/                        
        $(".list_workonline").append(reponse.data); 


      },
      error: function (xhr) {
        alert("error");
      },
      complete: function () {
        $("#boxLoading").hide();
      }
    }); 
   };
 });
   $('#slkbox').change(function(){
    var url=$(this).val();
    window.location.href=url;
  })
   $('[data-toggle="tooltip"]').tooltip(); 
   $('.viewallnganhnghe').on('click',function(){

    if($('.catmore ul').hasClass("rutgon"))
    {
      $('.catmore ul').removeClass("rutgon").addClass('fullcat');
      $('.viewallnganhnghe i').removeClass("fa-angle-down").addClass('fa-angle-up');
    }
    else if($('.catmore ul').hasClass("fullcat")){
      $('.catmore ul').removeClass("fullcat").addClass('rutgon');
      $('.viewallnganhnghe i').removeClass("fa-angle-up").addClass('fa-angle-down');
    };
  });
 })
</script>
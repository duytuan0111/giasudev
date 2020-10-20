<?php  
$CI=&get_instance();
$CI->load->model('site/site_model');

 $menu1=false;
 $active1=false;
 if(current_url()==site_url('mn-hv-gia-su-da-luu')){
    $menu1=true;
 $active1=true;
 }else if(current_url()==site_url('mn-hv-gia-su-moi-day')){
   $menu1=true;
    $active1=true; 
 }else if(current_url()==site_url('mn-hv-gia-su-phu-hop')){
    $menu1=true;
    $active1=true; 
 }else if(current_url()==site_url('mn-hv-gia-su-de-nghi-day')){
    $menu1=true;
    $active1=true; 
 }
$menutt=false;
$activett=false;
if(current_url()==site_url('mn-hv-thay-doi-mk')){
   $menutt=true;
$activett=true; 
}else if(current_url()==site_url('mn-hv-cai-dat-ho-so')){
    $menutt=true;
$activett=true; 
}else if(current_url()==site_url('mn-hv-thong-tin-ho-so')){
    $menutt=true;
$activett=true; 
}
$menuhoso=false;
$activehoso=false;
if(current_url()==site_url('mn-danh-sach-lop-de-nghi-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-moi-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-da-day')){
    $menuhoso=true;
$activehoso=true;
}else if(current_url()==site_url('mn-danh-sach-lop-da-luu')){
    $menuhoso=true;
$activehoso=true;
}
$CI=&get_instance();
$CI->load->model('site/site_model');
$userlogin="";
$footer="";
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
   
    $tg=$_SESSION['UserInfo'];
    $type = $tg['UserType'];
    $userid = $tg['UserId'];
    $active = $CI ->site_model->active($userid)->Active;
    $userlogin=$tg['Name'];
    $balance=$tg['Balance'];
    $check = $CI ->site_model->checknews($tg['UserId']);
    $uinfo=$CI ->site_model->GetUserInfoByUserID($userid);
    $point=$CI->site_model->getpoint($userid);
}
    
foreach ($point as $key ) {
    $diem += $key;
}
?>
            <?
            $link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $ktra = base_url()."xacnhankichhoattaikhoan";
            $ktra2 = base_url()."mn-hv-dang-tin";
            if($type !=3)
            {
                if($active==0)
                {
                    if($ktra != $link)
                    {
                        header('Location:'.base_url()."xacnhankichhoattaikhoan");
                    }
                }
                else if($check == 0 && $type == 0)
                {
                    if($ktra2 != $link){
                        // header('Location:'.base_url()."mn-hv-dang-tin");
                    }
                }
            }
            ?>
    <div class="row">
            <div class="left-menu">
            <div class="logonuv">
            <?php if(empty($uinfo->Image)) {
                    $tg=explode('-',date('d-m-Y',strtotime($uinfo->CreateDate)));?>
                    
                <img src="<?php echo base_url(); ?>images/no-image2.png" alt="" class="img-t-01">
                <?php } else {?>
                <img src="<?php echo base_url(); ?>upload/images/<?php echo $uinfo->Image ?>" class="img-t-01" />
                <?php } ?>
              <a><?php echo $userlogin; ?></a>
            </div>
            <div class="col-md-12" style="margin: 0 auto 23px auto;">
            <div class="uvhoanthienhoso">
                <!-- <span>Hoàn thiện hồ sơ: <span>100%</span></span>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  
                    </div>
                  </div> -->
                  <span style="text-align: center; display: block;" class="ntdmoney">TKC: <?php echo $balance; ?> vnđ <span> và <?php $diem ?> điểm</span></span>
                <!-- <label class="activesearch">
                    Cho phép gia sư tìm kiếm
                    <input value="1" <?php if($footer!=''){ if($footer->IsSearch ==1){echo "checked";} } ?> name="buttonRounded" type="checkbox" id="buttonRounded">
                    <span class="lever"></span>                    
                </label> -->
            </div>
            <div class="groupbtnuv" style="text-align: center;">                
                <span class="btnrefreshuv" onclick="location='<?php echo site_url() ?>'">Làm mới</span>
                <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-hv-thong-tin-ho-so') ?>'">Hoàn thiện</span>
            </div>
            </div>
            <div style="clear:bold;"></div>
            <nav id="sidebar">
                <ul class="list-unstyled components">
                <?php if(current_url()==site_url('phu-huynh-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-uv-jobmanager"></i><a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle <?php if($menu1){echo "";}else{echo "collapsed";} ?>">Quản lý gia sư</a>
                        <ul class="list-unstyled collapse <?php if($active1){echo "in";}else{echo "";} ?>" id="homeSubmenu" style="">
                            <?php if(current_url()==site_url('mn-hv-gia-su-da-luu')){ ?>
                            <li class="active">
                                <i class="fa fa-disk"></i><a href="<?php echo site_url('mn-hv-gia-su-da-luu'); ?>">Gia sư đã lưu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-disk"></i><a href="<?php echo site_url('mn-hv-gia-su-da-luu'); ?>">Gia sư đã lưu</a>
                            </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-hv-gia-su-moi-day')){ ?>
                            <li class="active">
                                <i class="fa fa-uv-ungtuyen"></i><a href="<?php echo site_url('mn-hv-gia-su-moi-day'); ?>">Gia sư đã mời dạy</a>
                            </li>
                            <?php }else{ ?>
                             <li>
                                <i class="fa fa-uv-ungtuyen"></i><a href="<?php echo site_url('mn-hv-gia-su-moi-day'); ?>">Gia sư đã mời dạy</a>
                            </li>
                            <?php } ?>
                           <?php if(current_url()==site_url('mn-hv-gia-su-phu-hop')){ ?>
                               <li class="active">
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-phu-hop') ?>">Gia sư phù hợp</a>
                                </li>
                           <?php }else{ ?>
                               <li>
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-phu-hop') ?>">Gia sư phù hợp</a>
                                </li>
                           <?php } ?>
                           <?php if(current_url()==site_url('mn-hv-gia-su-de-nghi-day')){ ?>
                               <li class="active">
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-de-nghi-day') ?>">Gia sư đề nghị dạy</a>
                                </li>
                           <?php }else{ ?>
                               <li>
                                  <i class="fa fa-uv-phuhop"></i><a href="<?php echo site_url('mn-hv-gia-su-de-nghi-day') ?>">Gia sư đề nghị dạy</a>
                                </li>
                           <?php } ?>
                           
                        </ul>
                    </li>
                    <?php if(current_url()==site_url('mn-hv-quan-ly-lop-hoc')){ ?>
                    <li class="active">
                        <i class="fa fa-uv-updatevip"></i><a href="<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>">Quản lý lớp học</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-uv-updatevip"></i><a href="<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>">Quản lý lớp học</a>
                    </li>
                    <?php } ?>
                    
                   <!--  <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('phu-huynh-manager') ?>">Chat online</a>                       
                    </li> --> 
                    <li>
                      <i class="fa fa-uv-info"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin cá nhân</a>
                      <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                        <?php if(current_url()==site_url('mn-hv-thong-tin-ho-so')){ ?>
                          <li class="active">
                            <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-hv-thong-tin-ho-so'); ?>">Thông tin hồ sơ</a>
                          </li>
                        <?php }else{ ?>
                          <li>
                            <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-hv-thong-tin-ho-so'); ?>">Thông tin hồ sơ</a>
                          </li>
                        <?php } ?>

                        <?php if(current_url()==site_url('mn-hv-cai-dat-ho-so')){ ?>
                          <li class="active">
                            <i class="fa fa-uv-setting"></i><a href="<?php echo site_url('mn-hv-cai-dat-ho-so'); ?>">Cài đặt hồ sơ</a>
                          </li>
                        <?php }else{ ?>
                          <li>
                            <i class="fa fa-uv-setting"></i><a href="<?php echo site_url('mn-hv-cai-dat-ho-so'); ?>">Cài đặt hồ sơ</a>
                          </li>
                        <?php } ?>

                        <?php if(current_url()==site_url('mn-hv-thay-doi-mk')){ ?>
                         <li class="active">
                          <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-hv-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                        </li>
                        <?php }else{ ?>
                        <li>
                          <i class="fa fa-pincode"></i><a href="<?php echo site_url('mn-hv-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>
                    <!-- <?php if(current_url()==site_url('mn-gia-su-nap-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-gia-su-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout"></i><a href="<?php echo site_url('mn-gia-su-nap-tien'); ?>">Nạp tiền vào tài khoản</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-gia-su-rut-tien')){ ?>
                    <li class="active">
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-gia-su-rut-tien'); ?>">Hoàn tiền</a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <i class="fa fa-cashout-return"></i><a href="<?php echo site_url('mn-gia-su-rut-tien'); ?>">Hoàn tiền</a>
                    </li>
                    <?php } ?>
                    <?php if(current_url()==site_url('mn-gia-su-qua-tang-km')){ ?>
                    <li class="active">
                        <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-gia-su-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                    </li>
                    <?php }else{?>
                    <li>
                        <i class="fa fa-bonus-ntd"></i><a href="<?php echo site_url('mn-gia-su-qua-tang-km'); ?>">Quà tặng - khuyến mãi</a>
                    </li>
                    <?php } ?>  -->                   
                </ul>
            </nav>
           </div>
           </div>
           <script type="text/javascript">
	$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        $('.uvhoanthienhoso input[name="buttonRounded"]').each(function () {
    $(this).change(function () {
        /*if($(this).prop('checked')==true){
            alert('đã bật search');
        }*/
        cknhatuyendung=1;
        if(typeof ($('.uvhoanthienhoso input[name="buttonRounded"]:checked').val())=== "undefined"){
            cknhatuyendung=0;
        }
        $.ajax(
              {                  
                  url: configulr+"site/ajaxupdateissearch",
                  type: "POST",
                  data: { issearch:cknhatuyendung},
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                          alert(reponse.data);
                      }else{
                        alert('Thay đổi trạng thái thất bại');
                      }
                      
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                      window.location.reload();
                  }
              }); 
        /*alert($('.uvactiventd input[name="uvduyetsearch"]:checked').val());*/
    });
    });
   $('.btnrefreshuv').on('click',function(){ 
    $.ajax({
      url: configulr+ 'site/ajaxrefreshusers',
      type: 'POST',
      dataType: 'json',
      beforeSend: function() {
        $('#boxloading').show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          console.log(reponse);
          alert('Cập nhật thành công');
          window.location.reload();
        }
        else {
          alert('Cập nhật thất bại');
        }
      },
      error: function() {
        alert('error');
      }
    })
   });
	   });
 </script>
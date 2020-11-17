<?php  site_url('mn-giao-vien-tim-lop-day');
 $menu1=false;
 $active1=false;
 if(current_url()==site_url('mn-giao-vien-tim-lop-day')){
    $menu1=true;
 $active1=true;
 }else if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-mon')){
   $menu1=true;
    $active1=true; 
 }else if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-tt')){
    $menu1=true;
    $active1=true; 
 }
$menutt=false;
$activett=false;
if(current_url()==site_url('mm-giao-vien-thay-doi-mk')){
   $menutt=true;
$activett=true; 
}else if(current_url()==site_url('mn-gia-su-cap-nhat-thong-tin')){
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
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    
    $tg=$_SESSION['UserInfo'];
    $type = $tg['UserType'];
    $userid = $tg['UserId'];
    $active = $CI ->site_model->active($userid)->Active;
    $userlogin=$tg['Name'];
}
?>
            <?
            $link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $ktra = base_url()."xacnhankichhoattaikhoan";
            if($type !=3)
            {
                if($active==0)
                {
                    if($ktra != $link)
                    {
                        header('Location:'.base_url()."xacnhankichhoattaikhoan");
                    }
                }
            }
            ?>
<div class="row">
            <div class="left-menu">
            <div class="logonuv">
                <span class="imglogo">
                <?php if(empty($info->Image)) { ?>
                <img src="<?php echo base_url(); ?>images/no-image2.png" alt="<?php echo $info->Name; ?>" class="img-t-01">
                <?php } else { $tg=explode('-',date('d-m-Y',strtotime($info->CreateDate))); ?>
                <img alt="<?php echo $info->Name; ?>" src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$info->Image  ?>" class="img-t-01" />
                <?php } ?>
                </span>
                
                <a><a href="<?php echo base_url().vn_str_filter($info->Name).'-gv'.$info->UserID ?>"><?php echo $info->Name; ?></a></a>
            </div>
            <div class="col-md-12" style="margin: 0 auto 23px auto;">
            <div class="uvhoanthienhoso">
                <!-- <span>Hoàn thiện hồ sơ: <span>100%</span></span>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                  
                    </div>
                </div> -->
               <!--  <label class="activesearch">
                    Cho phép phụ huynh tìm kiếm
                    <input value="true" name="buttonRounded" type="checkbox">
                    <span class="lever"></span>                    
                </label> -->
            </div>
            <div class="groupbtnuv">                
                <span class="btnrefreshuv">Làm mới</span>
                <span class="btnupdateuv" onclick="location.href='<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>'">Chỉnh sửa</span>
                <!--<div style="width:100%;"><p>Bạn đang có: <a>0 đ</a></p></div>-->
            </div>
            </div>
            <div style="clear:bold;"></div>
            <nav id="sidebar">
                <ul class="list-unstyled components">
                <?php if(current_url()==site_url('giao-vien-manager')){ ?>
                    <li class="active">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php }else{ ?>
                    <li class="">
                        <i class="fa fa-settings"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Quản lý chung</a>
                    </li>
                    <?php } ?>
                    <li>
                        <i class="fa fa-searchuv"></i><a href="#pageSubmenu" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menu1){echo "";}else{echo "collapsed";} ?>">Tìm kiếm lớp dạy</a>
                        <ul class="list-unstyled collapse <?php if($active1){echo "in";}else{echo "";} ?>" id="pageSubmenu" style="">
                        <!--     <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day')){ ?>
                    <li class="active">
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo base_url() ?>mn-giao-vien-tim-lop-day">Tìm kiếm lớp dạy</a>
                            </li>
                    <?php }else{ ?>
                    <li>
                                <i class="fa fa-timkiemungv"></i><a href="<?php echo base_url() ?>mn-giao-vien-tim-lop-day">Tìm kiếm lớp dạy</a>
                    </li>
                    <?php } ?> -->
                     <!--        <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-mon')){ ?>
                    <li class="active">
                                <i class="fa fa-timkiemnn"></i><a href="<?php echo base_url()  ?>mn-giao-vien-tim-lop-day-theo-mon">Theo môn học</a>
                            </li>
                    <?php }else{ ?>
                        <li>
                                <i class="fa fa-timkiemnn"></i><a href="<?php echo base_url()  ?>mn-giao-vien-tim-lop-day-theo-mon">Theo môn học</a>
                            </li>
                    <?php } ?> -->
                    <?php if(current_url()==site_url('mn-giao-vien-tim-lop-day-theo-tt')){ ?>
                        <li class="active">
                                <i class="fa fa-locationp"></i><a href="<?php echo site_url('mn-giao-vien-tim-lop-day-theo-tt'); ?>">Theo tỉnh thành</a>
                            </li>
                    <?php }else{ ?>
                            <li>
                                <i class="fa fa-locationp"></i><a href="<?php echo site_url('mn-giao-vien-tim-lop-day-theo-tt'); ?>">Theo tỉnh thành</a>
                            </li>
                    <?php } ?>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-filemanager"></i><a href="#quanlyhoso" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menuhoso){echo "";}else{echo "collapsed";} ?>">Quản lý hồ sơ</a>
                        <ul class="list-unstyled collapse <?php if($activehoso){echo "in";}else{echo "";} ?>" id="quanlyhoso" style="">
                            <?php if(current_url()==site_url('mn-danh-sach-lop-moi-day')){ ?>
                                <li class="active">
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-moi-day'); ?>">Lớp đã mời dạy</a>
                                </li>
                            <?php }else{ ?>
                                <li>
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-moi-day'); ?>">Lớp đã mời dạy</a>
                                </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-danh-sach-lop-da-day')){ ?>
                            <li class="active">
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-day'); ?>">Lớp đã nhận dạy</a>
                            </li>
                            <?php }else{ ?>
                                <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-day'); ?>">Lớp đã nhận dạy</a>
                            </li>
                            <?php } ?>
                            
                            <?php if(current_url()==site_url('mn-danh-sach-lop-de-nghi-day')){ ?>
                            <li class="active">
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>">Lớp đã đề nghị dạy</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>">Lớp đã đề nghị dạy</a>
                            </li>
                            <?php } ?>
                            <?php if(current_url()==site_url('mn-danh-sach-lop-da-luu')){ ?>
                                <li class="active">
                                  <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-luu'); ?>">Lớp đã lưu</a>
                                </li>
                            <?php }else{ ?>
                            <li>
                              <i class="fa fa-class-save"></i><a href="<?php echo site_url('mn-danh-sach-lop-da-luu'); ?>">Lớp đã lưu</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <!-- <li>
                        <i class="fa fa-message"></i><a href="<?php echo site_url('giao-vien-manager') ?>">Chat online</a>
                       
                    </li> -->
                    <li>
                        <i class="fa fa-uv-info"></i><a href="#infocompany" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle <?php if($menutt){echo "";}else{echo "collapsed";} ?>">Thông tin gia sư</a>
                        <ul class="list-unstyled collapse <?php if($activett){echo "in";}else{echo "";} ?>" id="infocompany" style="">
                            <?php if(current_url()==site_url('mn-gia-su-cap-nhat-thong-tin')){ ?>
                            <li class="active">
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-infomation"></i><a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>">Cập nhật thông tin</a>
                            </li>
                            <?php } ?>
                            
                            <?php if(current_url()==site_url('mm-giao-vien-thay-doi-mk')){ ?>
                            <li class="active">
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mm-giao-vien-thay-doi-mk'); ?>">Đổi mật khẩu</a>
                            </li>
                            <?php }else{ ?>
                            <li>
                                <i class="fa fa-pincode"></i><a href="<?php echo site_url('mm-giao-vien-thay-doi-mk'); ?>">Đổi mật khẩu</a>
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
                    <?php } ?> -->
                                        
                </ul>
            </nav>
           </div>
           </div>
<script>
$(document).ready(function() {
	    var configulr='<?php echo base_url(); ?>';
        $('.btnrefreshuv').on('click',function(){
        $.ajax({
            url: configulr+'site/ajaxrefreshusers',
            type: 'POST',
            dataType: 'JSON',
            success: function (response) {
                if (response.kq == true) {
                    window.alert('Cập nhật thành công');
                }
                else {
                    window.alert('Cập nhật thất bại');
                }
            },
            error: function(xhr) {
                window.alert('Error');
            }
        });
         
   });
        });

</script>
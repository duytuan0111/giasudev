<?php 
$usertype=3;
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $usertype=$tg['UserType'];
}
?>
<?php if($usertype ==0){ ?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('phu-huynh-manager') ?>" title="Tủ hồ sơ"><i class="fa fa-uv-documentfile"></i> Tủ hồ sơ</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-hv-thong-tin-ho-so') ?>" title="Tài khoản"><i class="fa fa-uv-account"></i> Tài khoản</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-hv-dang-tin') ?>" title="Đăng tin tìm gia sư"><i class="fa fa-uv-newspaper"></i> Đăng tin tìm gia sư</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-hv-gia-su-da-luu') ?>" title="Gia sư đã mời dạy"><i class="fa fa-uv-downloadbox"></i> Gia sư đã lưu</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-hv-gia-su-moi-day') ?>" title="gia sư mời dạy"><i class="fa fa-uv-sendmail"></i> Gia sư mời dạy</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-hv-cai-dat-ho-so') ?>" title="Thiết lập thông báo"><i class="fa fa-uv-pencilouline"></i> Thiết lập thông báo</a>
            </li>
        </ul>
    </div>
    <?php }else if($usertype==1){?>
    <div class="uvheaderfun">
        <ul>
            <li class="col-md-2 col-xs-6 ">
                <a href="<?php echo site_url('giao-vien-manager') ?>"><i class="fa fa-uv-account"></i> Tài khoản</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-gia-su-cap-nhat-thong-tin') ?>" title="Đăng tin tìm lớp"><i class="fa fa-uv-newspaper"></i> Đăng tin tìm lớp</a>
            </li>            
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-gia-su-nap-tien') ?>"><i class="fa fa-uv-documentfile"></i> Quản lý tin đăng</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-danh-sach-lop-da-luu') ?>" title="lớp đã lưu"><i class="fa fa-uv-savefolder"></i> Lớp đã lưu</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-danh-sach-lop-de-nghi-day') ?>" title="Lớp đề nghị dạy"><i class="fa fa-uv-uploadfolder"></i> Lớp đã đề nghị dạy</a>
            </li>
            <li class="col-md-2 col-xs-6">
                <a href="<?php echo site_url('mn-giao-vien-tim-lop-day') ?>" title="Thông báo lớp"><i class="fa fa-uv-pencilouline"></i> Thông báo lớp</a>
            </li>
        </ul>
    </div>
    <?php } 
    ?>
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
$link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$ktra = base_url()."xacnhankichhoattaikhoan";
$ktra2 = base_url()."mn-hv-dang-tin";
// require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
?>
<style>
 .tab-content {
    padding-top: 0px !important;
 }   
</style>
<!-- Start Navigation -->
<nav class="<?php echo $classheader?> <?php if(!$showsearch){ echo "navnosearch"; }?>">
    <div class="container header-top">            
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Start Header Navigation -->
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <?php if(!$home){ ?>
                    <img src="images/logo-01.png" class="logo logo-display" alt="tìm việc">
                <?php }else{ ?>
                    <img src="images/logo-01.png" class="logo logo-display" alt="tìm việc">
                <?php } ?>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling animated  animated data-in="fadeInDown" data-out="fadeOutUp" animated data-in="fadeInDown" data-out="fadeOutUp"-->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav top_head <?php if(!$showsearch){ echo "nosearch"; }?>" >
                <li class="dropdown p1">
                    <a class="dropdown-toggle v1" data-toggle="dropdown">Dành cho phụ huynh</a>
                    <ul class="dropdown-menu " role="menu">
                        <li><a href="<?php echo base_url() ?>tim-giao-vien-day-kem">Gia sư hàng đầu</a></li>
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
                                <li><a href="<?php echo base_url() ?>giao-vien-manager">Thông tin cá nhân</a></li>
                            <?php }else{ ?>
                                <li><a href="<?php echo base_url() ?>phu-huynh-manager">Thông tin cá nhân</a></li>
                            <?php } ?>
                            <li><a href="javascript:void(0);" id="btnlogout">Thoát</a></li>
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
                    <a id="tab1" class="nav-link" style="border-left:none" data-toggle="tab" role="tab"  href="#pane-tab-1">Tìm gia sư</a>
                </li>
                <li class="nav-item" id="search-class-teacher" value="2">
                    <a id="tab2" class="nav-link" data-toggle="tab" role="tab"  href="#pane-tab-2">Tìm lớp gia sư</a>
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
                                <input type="text" value="<?php echo ($keyfilter['keywork']!='0')?$keyfilter['keywork']:'' ?>" id="findkeyjob" class="form-control right-bor" placeholder="Tìm kiếm gia sư"> 

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
                        <!-- <div class="col-md-6 no-padd"> -->
                            <!-- <div class="col-md-6 no-padd nganhnghe">
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
                            </div> -->
                            <!-- <div class="col-md-6 no-padd lop">
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
                            </div>  -->  
                        <!-- </div> -->
                        <div class="col-md-10 no-padd">
                            <div class="col-md-12 no-padd diadiem">
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
                            <!-- <div class="col-md-6 no-padd quanhuyen">
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
                            </div> -->  
                        </div>                               
                        <div class="col-md-2 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
                </div>
                <div class="tab-pane fade" id="pane-tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal" style="padding-top: 0px">
                    <div class="col-md-6 no-padd">
                        <div class="col-md-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo ($keyfilter['keywork']!='0')?$keyfilter['keywork']:'' ?>" id="findkeyjob1" class="form-control right-bor" placeholder="Tìm kiếm lớp gia sư" aria-label="nhập từ khóa">
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
                        <!-- <div class="col-md-6 no-padd"> -->
                            <!-- <div class="col-md-6 no-padd nganhnghe">
                                <div class="input-group">
                                    
                                    <span class="span-before"><i class="nn"></i></span>
                                    <select id="index_nganhnghe1" class="form-control right-bor" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?> >
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
                            </div> -->
                            <!-- <div class="col-md-6 no-padd lop">
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
                        <!-- </div> -->
                        <div class="col-md-10 no-padd">
                            <div class="col-md-12 no-padd diadiem">
                                <div class="input-group">
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem1" class="form-control" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
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
                           <!--  <div class="col-md-6 no-padd quanhuyen">
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
                        <div class="col-md-2 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
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
<?php } ?>

<div class="clearfix"></div>

<?php if($showsearch && $detect->isMobile()){ ?>
    <div class="container searchmobile" style="background-color: #203043;border-top: 1px solid #fff;">
        <div class="banner-caption hidden-mobile">
             <!-- Thêm tab html -->
            <div class="col-xs-12 no-padd">
            <ul class="nav nav-tabs col-xs-12"  id="example-tabs" role="tablist">
                <li class="nav-item active" id="search-teacher">
                    <a id="tab1" class="nav-link" style="border-left:none" data-toggle="tab" role="tab"  href="#pane-tab-1">Tìm gia sư</a>
                </li>
                <li class="nav-item" id="search-class-teacher">
                    <a id="tab2" class="nav-link" data-toggle="tab" role="tab"  href="#pane-tab-2">Tìm lớp gia sư</a>
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
                                <input type="text" value="<?php echo $keyfilter['keywork'] ?>" id="findkeyjob" class="form-control right-bor" aria-label="nhập từ khóa" placeholder="Tìm kiếm gia sư" >
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
                            </div> -->
                           <!--  <div class="col-xs-12 no-padd lop">
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
                            </div>  -->  
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
                           <!--  <div class="col-xs-12 no-padd quanhuyen">
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
                            </div>  --> 
                        </div>                               
                        <div class="col-xs-12 no-padd btnsearch">
                            <div class="input-group">
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
                </div>
                <div class="tab-pane fade" id="pane-tab-2" role="tabpanel" aria-labelledby="tab2">
                    <div class="banner-text">
                        <div class="banner-text">
                <form onsubmit="return false" class="form-horizontal">
                    <div class="col-xs-12 no-padd">
                        <div class="col-xs-12 no-padd findkeyjob">
                            <div class="input-group">
                                <input type="text" value="<?php echo $keyfilter['keywork'] ?>" id="findkeyjob1" class="form-control right-bor" aria-label="nhập từ khóa" placeholder="Tìm kiếm lớp gia sư" >
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
                                    <span class="span-before"><i class="nn2"></i></span>
                                    <select id="index_dia_diem1" class="form-control" <? if($type == 1){echo 'onchange="searchclassbyheader(); searchclassbyheader()"';} else { echo 'onchange="searchteacherbyheader(); searchbyteachertitle()"'; }?>>
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
                                <button class="btn btn-primary timvieclam" aria-label="more" role="button"><i class="fa fa-search"></i></button>
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
        $('#myModalmorsearch #hinhthuc,#myModalmorsearch #ppgioitinh,#myModalmorsearch #txtteachtype,#myModalmorsearch #txtteachtypemd').select2();
        $('.btnsearchmore').on('click',function(){
            $('#myModalmorsearch').modal('hide');
        })
    });	 
</script>


<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$footer=$CI->admin_model->gettbl('tbl_meta',1)->row();
$uoctinhluong=$CI->admin_model->gettbl('tbl_meta',2)->row();
$formresultsosanh=	$CI->admin_model->gettbl('tbl_meta',3)->row();
$ketquauoctinhluong=	$CI->admin_model->gettbl('tbl_meta',4)->row();
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
$huongdan=	$CI->admin_model->gettbl('tbl_footer',1)->row();
?>
<div class="navbar-inner">
	<ul>
		<li><a href="<?php echo site_url('admin'); ?>">Quản trị</a></li>	
		<li><a href="javascript:void(0)">Quản lý bài viết</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/chuyenmuc'); ?>">Chuyên mục</a></li>
				<li><a href="<?php echo site_url('admin/baiviet'); ?>">Bài viết</a></li>
                <li><a href="<?php echo site_url('admin/baiviettimgiasu'); ?>">Bài viết tìm gia sư</a></li>	
                <li><a href="<?php echo site_url('admin/baiviettimlop'); ?>">Bài viết tìm lớp</a></li> 
			</ul>			
		</li>		
		<?php if($admin->role==1){?>
		<li>
			<a href="javascript:void(0)">Trang gia sư</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/vieclam'); ?>">tất cả gia sư</a></li>
                <!-- <li><a href="<?php echo site_url('admin/urlgiasutheotinh'); ?>">Url theo tỉnh thành</a></li>
                <li><a href="<?php echo site_url('admin/urlgiasutheomon'); ?>">Url theo môn học</a></li>
                <li><a href="<?php echo site_url('admin/urlgiasutheomontinhthanh'); ?>">Url theo môn học và tỉnh thành</a></li> -->
                <li><a href="<?php echo site_url('admin/urlgiasu'); ?>">Danh sách</a></li>
                <li><a href="<?php echo site_url('admin/urlgiasuadd'); ?>">Thêm mới</a></li>
			</ul>
		</li>
        <li>
            <a href="javascript:void(0)">Trang phụ huynh</a>
            <ul class="sub-menu">
                <li><a href="<?php echo site_url('admin/doanhnghiep'); ?>">Quản lý lớp học</a></li>
                <!-- <li><a href="<?php echo site_url('admin/urlviectheotinh'); ?>">Url theo tỉnh thành</a></li>
                <li><a href="<?php echo site_url('admin/urlviectheomon'); ?>">Url theo môn học</a></li>
                 <li><a href="<?php echo site_url('admin/urlviectheomontinhthanh'); ?>">Url theo môn học và tỉnh thành</a></li> -->
                <li><a href="<?php echo site_url('admin/url_phuhuynh'); ?>">Danh sách</a></li>
                <li><a href="<?php echo site_url('admin/urlphuhuynhadd'); ?>">Thêm mới</a></li>
            </ul>
        </li>
		<!--<li>
			<a href="javascript:void(0)">Quản lý CV</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/danhmuc_cv'); ?>">Danh mục CV</a></li>
				<li><a href="<?php echo site_url('admin/cv'); ?>">Mẫu CV</a></li>				
			</ul>
		</li>
		<li><a href="<?php echo site_url('admin/ungvien'); ?>">Ứng viên</a>
			<ul class="sub-menu">
				<li><a href="<?php echo site_url('admin/thu_ungvien'); ?>">Thư Ứng viên</a></li>
			</ul>
		</li>		
		<li><a href="<?php echo site_url('admin/khachhang'); ?>">Khách hàng</a></li>
		<li><a href="<?php echo site_url('admin/doanhnghiep'); ?>">Doanh nghiệp</a></li>-->	
        <li><a href="<?php echo site_url('admin/linkseo')?>">Link seo</a></li>	
		<li>
            <a href="admin/pagemeta">Quản lý Meta</a>
            <ul class="sub-menu">
                <li><a href="<?php if (count($footer)==0){echo site_url('admin/edit_meta/1');}
            			else{
            			echo site_url('admin/edit_meta/'.$footer->id);
            			}
            		?>">Home</a>
                </li>
                <li><a href="<?php if (count($uoctinhluong)==0){echo site_url('admin/edit_meta/2');}
            			else{
            			echo site_url('admin/edit_meta/'.$uoctinhluong->id);
            			}
            		?>">Tin tuyển dụng</a>
                </li>
                <li><a href="<?php if (count($formresultsosanh)==0){echo site_url('admin/edit_meta/3');}
            			else{
            			echo site_url('admin/edit_meta/'.$formresultsosanh->id);
            			}
            		?>">Nhà tuyển dụng</a>
                </li>
                <li><a href="<?php if (count($ketquauoctinhluong)==0){echo site_url('admin/edit_meta/4');}
            			else{
            			echo site_url('admin/edit_meta/'.$ketquauoctinhluong->id);
            			}
            		?>">Ứng viên</a>
                </li>
                <!--
                
                
                
                <li><a href="<?php if (count($formtimkiem)==0){echo site_url('admin/edit_footer/4');}
            			else{
            			echo site_url('admin/edit_footer/'.$formtimkiem->id);
            			}
            		?>">Form ước tính lương</a>
                </li>-->
            </ul>
            </li>
        <li><a href="<?php if (count($huongdan)==0){echo site_url('admin/edit_footer/1');}
            			else{
            			echo site_url('admin/edit_footer/'.$huongdan->id);
            			}
            		?>">Thông số chung</a>
                </li>			
		<li><a href="<?php echo site_url('admin/tbladmin'); ?>">Thành viên</a></li>
        <li><a href="<?php echo site_url('admin/keywork'); ?>">Từ khóa liên quan</a></li>
		<?php } ?>
	</ul>
</div>
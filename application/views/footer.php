<?php 
$CI=&get_instance();
$CI->load->model('site/site_model');
$footer=$CI->site_model->getconfig();
$urlweb= current_url();
?>
</div>
<div class="clearfix"></div>

	<footer class="footer" <?php echo "style='border-top:1px solid #e6e6e6'"; ?>>

		<div class="row no-padding">
			<div class="container"> <!-- class="container" -->
				<div class="col-md-3 col-sm-12">
					<div class="footer-widget">
						<h3 class="widgettitle widget-title">LIÊN KẾT NHANH</h3>
						<div class="textwidget">
							<?php echo $footer->content ?>

						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-4">
					<div class="footer-widget">

						<div class="textwidget widget-img">
							<div class="textwidget lknhanh">
								<img class=" lazyload" data-src="images/map.png" src="images/map.png" alt="bản đồ timviec365">
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-4">
					<div class="footer-widget">
						<h3 class="widgettitle widget-title">Nhận bản tin Việc Làm Mới Nhất</h3>
						<div class="textwidget">
							<form action="" method="post">
								<input aria-label="nhập email" type="text" name="email" placeholder="Nhập email của bạn..." value="">
								<input type="submit" value="Đăng ký">
							</form>
							<h3 class="widgettitle widget-title mrg-top-0">Kết nối mạng xã hội việc làm</h3>

							<ul class="footer-social">
								<li><a title="fabook" href="" aria-label="facebook" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a></li>
								<li><a href="" title="" aria-label="twitter" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a></li>
								<li><a href="" title="" aria-label="instagram" rel="noopener noreferrer"><i class="fa fa-instagram"></i></a></li>
								<li><a href="" title="" aria-label="linkedin" rel="noopener noreferrer"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
				</div>							
				<div class="col-md-3 col-sm-4">
					<div class="footer-widget">

						<div class="textwidget lknhanh">
							<img class=" lazyload" data-src="/images/banner2.png" src="images/banner2.png" alt="Tìm việc làm">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row copyright">
			<!-- <div class="container"> -->
				
				<a href="" title="" aria-label="facebook"  rel="noopener noreferrer"><img src="images/dk.png" alt="Đã đăng ký bộ công thương"></a>
				<a href="" title="" aria-label="facebook"  rel="noopener noreferrer"><img src="images/secu.png" alt="DMCA.com Protection Status"></a>
				<?php echo $footer->content_thu ?>
			<!-- </div> -->
		</div>
		<div class="row home_tag">
			<div> <!-- class="container" -->
				<?php echo $footer->meta_footer ?>
			</div>
		</div>
	</footer>
	<!-- Footer -->        
	<div id="btn-top" style="display: none;"></div>
	<a href="skype:live:binhminhmta123?chat" class="skypefix" style="position: fixed;cursor: pointer;bottom: 96px;right: 0px;z-index: 9999999;"><i class="fa fa-skype"></i></a>

	<script>
		jQuery(window).scroll(function(){
			if(jQuery(this).scrollTop()>300){
				jQuery('#btn-top').fadeIn(800);
			}else{
				jQuery('#btn-top').fadeOut(800);
			}
		});
		document.addEventListener("DOMContentLoaded", function(event) {
			console.log("DOM fully loaded and parsed");
		});
		$(document).ready(function(){
			var configulr = '<?php echo site_url(); ?>';
			var usertype= 1;
			$('#btn-top').click(function() {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
			});
			$('[data-toggle="tooltip"]').tooltip();
			$('#index_nganhnghe').select2({ width: 'calc(100%)' });
			$('#index_dia_diem').select2({ width: 'calc(100%)' });
			$('#index_lop').select2({ width: 'calc(100%)' });
			$('#index_quanhuyen').select2({ width: 'calc(100%)' });
			$('#index_nganhnghe1').select2({ width: 'calc(100%)' });
			$('#index_dia_diem1').select2({ width: 'calc(100%)' });
			$('#index_lop1').select2({ width: 'calc(100%)' });
			$('#index_quanhuyen1').select2({ width: 'calc(100%)' });
			$('#candinganhnghe').select2({ width: 'calc(100%)' });
			$('#candilocation').select2({ width: 'calc(100%)' });
			$('#index_user_type').select2({width: 'calc(100%)' });
			$('#morelocation').on('click',function(){        
				if($('#showlocation').hasClass("morelocation"))
				{
					$('#showlocation').removeClass("morelocation");
				}
				else {
					$('#showlocation').addClass('morelocation');
				}
			});   
			$('#morenganhnghe').on('click',function(){

				if($('#shownganhnghe').hasClass("morelocation"))
				{
					$('#shownganhnghe').removeClass("morelocation");
				}
				else {
					$('#shownganhnghe').addClass('morelocation');
				}
			});
			function ChangeToSlug(bien)
{
				var slug;
			
				//Đổi chữ hoa thành chữ thường
				slug = bien.toLowerCase();
			
				//Đổi ký tự có dấu thành không dấu
				slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
				slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
				slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
				slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
				slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
				slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
				slug = slug.replace(/đ/gi, 'd');
				//Xóa các ký tự đặt biệt
				slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
				//Đổi khoảng trắng thành ký tự gạch ngang
				slug = slug.replace(/ /gi, " - ");
				//Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
				//Phòng trường hợp người nhập vào quá nhiều ký tự trắng
				slug = slug.replace(/\-\-\-\-\-/gi, '-');
				slug = slug.replace(/\-\-\-\-/gi, '-');
				slug = slug.replace(/\-\-\-/gi, '-');
				slug = slug.replace(/\-\-/gi, '-');
				//Xóa các ký tự gạch ngang ở đầu và cuối
				slug = '@' + slug + '@';
				slug = slug.replace(/\@\-|\-\@|\@/gi, '');
				//In slug ra textbox có id “slug”
				return slug;
			}
			$(document).on('click', '#tab2', function(event) {
				usertype = 0;
			});
			$(document).on('click', '#tab1', function(event) {
				usertype = 1;
			});
			$('.timvieclam').on('click',function(){
				var li_active = $('#example-tabs').find('li.active').val();
                var configulr = '<?php echo site_url(); ?>';
				if(li_active == 2) //  usertype == 0
				{
					var findkey=$('#findkeyjob1').val();
					var nganhnghe=$('#index_nganhnghe1').val();
					var diadiem=$('#index_dia_diem1').val();
					var lop = $('#index_lop1').val();
					var quanhuyen = $('#index_quanhuyen1').val();
					if(findkey !='' || nganhnghe !=0 || diadiem!=0 || lop!=0)
					{
						$.ajax({
							url: configulr+"site/searchclassheader",
							type: "POST",
							data: 
							{ 
								key:findkey,
								subject:nganhnghe,
								topic:0,
								place:diadiem,
								type:usertype,
								sex:0,
								district:quanhuyen, 
								class: lop 
							},
							dataType: 'json',
							// beforeSend: function () {
							// 	$("#boxLoading").show();
							// },
							success: function (reponse) {
								if (reponse.kq == 1) {
									if (reponse.blank  == true) {
										alert('Vui lòng chọn trường tìm kiếm');
									}
									else {
										window.location.href = reponse.data;
									}
								}              
							},
							error: function (xhr) {
								console.log(xhr);
							},
							// complete: function () {
							// 	$("#boxLoading").hide();
							// }
						}); 
					}
					else
					{
						window.location.href = 'https://timviec365.com.vn/gia-su/tim-lop-hoc';
					}
				}
				else if(li_active == 1) // usertype == 1
				{
					var findkey=$('#findkeyjob').val();
					var nganhnghe=$('#index_nganhnghe').val();
					var diadiem=$('#index_dia_diem').val();
					var lop = $('#index_lop').val();
					var quanhuyen = $('#index_quanhuyen').val();
					
					if(findkey !='' || nganhnghe !=0 || diadiem!=0 || lop!=0)
					{
						$.ajax({                  
							url: configulr+"site/searchteacherheader",
							type: "POST",
							async: false,
							data: 
							{ 
								key:findkey,
								subject:nganhnghe,
								place:diadiem,
								district:quanhuyen, 
								class: lop 
							},
							dataType: 'json',
							beforeSend: function () {
								$("#boxLoading").show();
							},
							success: function (reponse) {
								if (reponse.kq == true) {
									if (reponse.blank == true) {
										window.alert('Vui lòng chọn trường tìm kiếm');
									} else {
										window.location.href = reponse.data;
									}

								}

							},
							error: function (xhr) {
								console.log(xhr);
							},
							complete: function () {
								$("#boxLoading").hide();
							}
						}); 
					}
					else
					{
						window.location.href = 'https://timviec365.com.vn/gia-su/tim-gia-su';
					}
				}
				else
				{
					alert('Vui lòng chọn yêu cầu tìm kiếm!');
					return false;
				}
			});

			$('#index_nganhnghe').on('change',function()
			{
				var id_monhoc = $(this).val();

				$.ajax({
					url: configulr+"site/CheckMonHoc",
					type:'POST',
					data:
					{
						id_monhoc : id_monhoc
					},
					success:function(reponse)
					{
						$('#index_lop').html('<option value='+0+'>Chọn lớp</option>'+reponse);

					},
					error: function(xhr)
					{
						console.log(xhr);
					},
					complete: function()
					{
						$("#boxLoading").hide();
					}
				});

			});

			$('#index_lop').on('change',function()
			{
				var id_lop = $(this).val();
				$.ajax({
					url: configulr+"site/CheckLop",
					type:'POST',
					data:
					{
						id_lop : id_lop
					},
					success:function(reponse)
					{
						$('#index_monhoc').html('<option value='+0+'>Chọn môn học</option>'+reponse);
					},
					error:function(xhr)
					{
						console.log(xhr);
					},
					complete:function()
					{
						$("#boxLoading").hide();
					}
				});
			});
		});
		$('#index_dia_diem').on('change',function()
			{
				var id_diadiem = $(this).val();
				var configulr  = '<?php echo site_url(); ?>';
				$.ajax({
					url: configulr+"site/CheckDiaDiem",
					type:'POST',
					data:
					{
						id_diadiem : id_diadiem
					},
					success:function(reponse)
					{
						if(id_diadiem==0){
							$('#index_quanhuyen').html('<option value='+0+'>Quận/Huyện</option>');
						}
						else{
							$('#index_quanhuyen').html('<option value='+0+'>Quận/Huyện</option>'+reponse);
						}
					},
					error: function(xhr)
					{
						console.log(xhr);
					},
					complete: function()
					{
						$("#boxLoading").hide();
					}
				});

			});
		
		
	</script>

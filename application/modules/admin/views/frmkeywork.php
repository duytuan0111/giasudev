<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$this->db->select('id');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();	
?>

<h3 class="header">Thêm từ khóa</h3>
<div class="content-inner1">
	<form name="frmtintuc" action="<?php echo site_url('admin/add_keywork'); ?>" method="post" enctype="multipart/form-data">		 
		<?php 
		if(isset($id))
		{
			$this->db->where('id',$id);
			$item=$this->db->get('keywork')->row();				
			$id=$item->id;            
		}
		?>  
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />		
		<div class="gray">
			<table width="100%">
				<tr>
					<td>		
						<table class="tab1">
							<tr>
								<td width="150"><strong>Từ khóa</strong></td>
								<td><input type="text" name="keywork" value="<?php if(isset($id)) {echo htmlspecialchars($item->keywork);} ?>" /></td>
							</tr>

							<tr class="second">
								<td><strong>Link từ khóa</strong></td>
								<td><input type="text" name="link" value="<?php if(isset($id)){ echo $item->link;} ?>" /></td>
							</tr>		
							<tr>
								<td><strong>Tải file exe</strong></td>
								<td><input type="file" name="file">
									
								</td>	
							</tr>						
						</table>		
					</td>		

				</table>
			</div>		
			<div class="gray">
				<center>
					<?php 
					if(isset($id))
					{
						?>			
						<input class="button" type="submit" name="submit" value="Lưu thay đổi" />						
						<?php    
					}
					else
					{
						?>			
						<input class="button" type="submit" name="submit" value="Nhập tin" />					
						<?php 
					}
					?>
				</center>
			</div>
		</form>
		<div class="clr"></div>
	</div>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript">
		jQuery(function($){

			$.datepicker.regional['vi'] = {

				closeText: 'Đóng',

				prevText: '&#x3c;Trước',

				nextText: 'Tiếp&#x3e;',

				currentText: 'Hôm nay',

				monthNames: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu',

				'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Tháng Mười Một', 'Tháng Mười Hai'],

				monthNamesShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',

				'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],

				dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],

				dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

				dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],

				weekHeader: 'Tu',

				dateFormat: 'dd-mm-yy',

				firstDay: 0,

				isRTL: false,

				showMonthAfterYear: false,

				yearSuffix: ''};

				$.datepicker.setDefaults($.datepicker.regional['vi']);
			});
		$(function() {
			$( "#created_day" ).datepicker();
			$.datepicker.setDefaults($.datepicker.regional['vi']);
			$('#findkey').keypress(function (e) {
				if (e.which === 13) {
					e.preventDefault();
					$.ajax(
					{

						url: "/ssl/admin/ajaxgetlistarticle",
						type: "POST",
						data: { findkey: $('#findkey').val()},
						dataType: 'json',
						beforeSend: function () {
							$("#boxLoading").show();
						},
						success: function (obj) {
							var result=obj;
							if(result.length > 0){
								var strhtml='';
								for (var i = 0; i < result.length; i++) {
									strhtml+="<li><a href='"+result[i].alias+"-b"+result[i].id+".html'>"+result[i].title+"</a></li>";


								}
								document.getElementById('listnewest').innerHTML=strhtml;
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
		});
	</script>
	<!-- Tích hợp jck soạn thảo-->

	<script type="text/javascript"> 
		CKEDITOR.replace( 'editor', {
			toolbar: [				
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
			{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
			{ name: 'styles', items: [ 'Styles', 'Format', 'FontSize'] },
			{ name: 'colors', items: [ 'TextColor', 'BGColor'] },
			{ name: 'links', items: [ 'Link', 'Unlink'] },
		//{ name: 'about', items: [ 'About' ] },
		'/',		
		{ name: 'insert', items: [ 'Link', 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		{ name: 'tools', items: ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']},
		{ name: 'tools', items: [ 'Maximize' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
		{ name: 'others', items: [ '-' ] }
		]
	});
</script>
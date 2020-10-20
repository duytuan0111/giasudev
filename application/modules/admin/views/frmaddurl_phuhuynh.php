<?php 
$CI=&get_instance();
$CI->load->model('admin/admin_model');
$this->db->select('id');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();		
?>

<h3 class="header">Thêm url phụ huynh</h3>
<div class="content-inner1">
	<form name="frmtintuc">
		<!-- method="post" enctype="multipart/form-data" action="" -->
		 <!-- action="<?php echo site_url('admin/add_url_giasu'); ?>" -->
		<?php 
			if(isset($id))
			{
				$this->db->where('id',$id);
				$item=$this->db->get('url_timviec')->row();				
				$id=$item->id;            
			}
			?>  
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />			<div class="gray">
		<table width="100%"><tr><td>		
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề (h1):</strong></td>
			<td><input type="text" name="h1" id="h1" required=""  /></td>
		</tr>
		<tr>
			<td width="150"><strong>Key tag:</strong></td>
			<td><input type="text" name="key_tag" id="key_tag" required=""  /></td>
		</tr>
		<tr>
			<td width="150"><strong>Alias:</strong></td>
			<td><input type="text" name="alias" id="alias" required="" readonly></td>
		</tr>
		<tr>
			<td width="150"><strong>Option:</strong></td>
			<td><select name="option" id="option">
				<option value="0">Môn học</option>
				<option value="1">Địa điểm</option>
				<!-- <option value="2">Môn học & Tỉnh thành</option> -->
			</td></select>
		</tr>
		<!-- 	<tr class="second">
			<td><strong>Link đặt bài viết</strong></td>
			<td><input type="text" name="link" placeholder="Vui lòng nhập LINK đầy đủ. Ví dụ: http://timviec365.com.vn/gia-su/gia-su-toan-s1l0c0.html" value="<?php if(isset($id)){ echo $item->link;} ?>" /></td>
		</tr> -->
		<!-- <tr class="second" style="display: none;">
			<td><input type="text" name="alias" value="<?php if(isset($id)){ echo $item->alias;} ?>" /></td>
		</tr>	 -->				
		</table>		
		</td>		
		</tr>
		<tr><td colspan="2">				
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" required="" name="editor" id="editor"> </textarea>
		</td></tr>	
		</table>
		</div>		
		<div class="gray">
		<table width="100%">
			<tr>
				<td width="150"><strong>SEO Title</strong></td>
				<td><input type="text" required="" name="title" id="seo_title"  /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Key</strong></td>
				<td><input type="text" required="" name="keyword" id="seo_keyword"  /></td>
			</tr>
			<tr>
				<td width="150"><strong>SEO Description</strong></td>
				<td>​<textarea rows="4" required="" cols="70" style="width:95%" name="description" id="seo_description" /><?php if(isset($id)) {echo $item->desscription;} ?></textarea></td>
			</tr>
		</table>
		</div>
		<div class="gray">
		<center>
		<?php 
			if(isset($id))
			{
			?>			
				<input class="button submit" type="submit" name="submit"  value="Lưu thay đổi" />						
			<?php    
			}
			else
			{
			?>			
				<input class="button submit" type="submit" name="submit" value="Thêm" />					
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
	$(document).ready(function() {
		$('#key_tag').change(function(event) {
				var key_tag 	= $(this).val();
				var slug		=  key_tag.toLowerCase();
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
			    slug = slug.replace(/ /gi, "-");
			    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
			    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
			    slug = slug.replace(/\-\-\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-\-/gi, '-');
			    slug = slug.replace(/\-\-/gi, '-');
			    //Xóa các ký tự gạch ngang ở đầu và cuối
			    slug = '@' + slug + '@';
			    slug = slug.replace(/\@\-|\-\@|\@/gi, '');

			    $('#alias').val(slug);

		});
		$('.submit').click(function(event) {
			event.preventDefault();
			var option = $('#option').val();
			var h1 = $('#h1').val();
			var key_tag = $('#key_tag').val();
			var alias = $("#alias").val();
			var content = CKEDITOR.instances.editor.getData();
			var title = $("#seo_title").val();
			var key = $('#seo_keyword').val();
			var description = $('#seo_description').val();
			var url='<?php echo site_url(); ?>';
			if (h1 == '') {
				alert('Tiêu đề không được để trống');
			} else if (key_tag == '') {
				alert('Key tag không được để trống');
			} else {
				$.ajax({
					url: url+"admin/add_url_phuhuynh",
					type: "POST",
					dataType: "JSON",
					data: {h1: h1, key_tag: key_tag, option: option, alias: alias,content:content, title: title, keyword: key, description: description},
					success: function(reponse) {
						if (reponse.kq == 0) {
							alert('Key tag đã tồn tại');
						} else if(reponse.kq == 1) {
							alert('Thêm thành công');
							window.location.href = url+'admin/url_phuhuynh';

						} else {
							alert('Thêm không thành công');
						}
					},
					error: function(xhr) {
						alert('Không thành công');
					}
				})
				
				
			}
		});
	});
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
                  
                  url: "/ssl/admin/ajaxgetlistarticlegiasu",
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
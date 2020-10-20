<h3 class="header">Sửa url gia  sư</h3>
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/exit_urlgiasu'); ?>" method="post" enctype="multipart/form-data">
		<?php 
			if(isset($id))
			{

				$this->db->where('id',$id);			          
				$item=$this->db->get('url_phuhuynh')->row();
				$id=$item->id;
				
			}
		?>     
		<input type="hidden" name="id" id="id" value="<?php if(isset($id)) { echo $id; }; ?>" />	
		<div class="gray">
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề (h1):</strong></td>
			<td><input type="text" name="h1" id="h1" value="<?php if(isset($id)) {echo htmlspecialchars($item->h1);} ?>" /></td>
		</tr>
		<tr>
			<td width="150"><strong>Key tag:</strong></td>
			<td><input type="text" name="key_tag" id="key_tag" required="" value="<?php if(isset($id)) {echo htmlspecialchars($item->key_tag);} ?>"  /></td>
		</tr>
		<tr>
			<td width="150"><strong>Địa điểm: </strong></td>
			<td>
				<select name="place" id="place">
					<option value>-- Chọn địa điểm --</option>

					<?php foreach ($listcity as $k) { ?>
					<option value="<?php echo $k->cit_id; ?>" <?php echo ($k->cit_id == $item->place_id) ? 'selected' : ''; ?> data-val="<?php echo $k->cit_name; ?>"><?php echo $k->cit_name; ?></option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr><td colspan="2">				
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="editor" id="editor" /><?php if(isset($id)) {echo $item->content;} ?></textarea>
		</td></tr>			
		<tr class="second"><td width="200"><strong>SEO Title</strong></td>
			<td>
			<input type="text" name="title" id="seo_title" value="<?php if(isset($id)) { echo $item->seo_title; }; ?>" />
		</td></tr>				
		<tr><td width="200">
			<strong>SEO Key</strong></td>
			<td>
            <textarea name="keyword" id="seo_keyword" rows="5" cols="40" ><?php if(isset($id)) { echo $item->seo_keyword; }; ?></textarea>
		      </td>
        </tr>
		<tr><td width="200">
			<strong>SEO Description </strong></td>
			<td>
			<textarea name="description" id="seo_description" rows="5" cols="40" ><?php if(isset($id)) { echo $item->seo_description; }; ?></textarea>
		</td></tr>
		
		</table>
		</div>
		<div class="gray">
		<center>
		<?php 
			if(isset($id))
			{
			?>			
				<input class="button submit" type="submit" name="submit" value="Lưu thay đổi" />						
			<?php    
			}
			else
			{
			?>			
				<input class="button submit" type="submit" name="submit" value="Cập nhật" />					
			<?php 
			}
		?>
		</center>
		</div>
	</form>
	<div class="clr"></div>
</div>
<!-- Tích hợp jck soạn thảo-->
<script type="text/javascript"> 
	$(document).ready(function() {
		$('.submit').click(function(event) {
			event.preventDefault();
			var option = $('#option').val();
			var id = $('#id').val();
			var h1 = $('#h1').val();
			var key_tag = $('#key_tag').val();
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
					url: url+"admin/edit_url_giasu",
					type: "POST",
					dataType: "JSON",
					data: {id: id,option: option, h1: h1, key_tag: key_tag,content:content, title: title, keyword: key, description: description},
					success: function(reponse) {
						if (reponse.kq == 1) {
							alert('Cập nhật thành công');
							window.location.href = url+'admin/urlgiasu';
						}
					},
					error: function(xhr) {
						alert('Không thành công');
					}
				})
				
				
			}

		});
	});
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
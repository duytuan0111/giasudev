<!-- <h3 class="header">Thêm HTML</h3> -->
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/add_viectheotinh'); ?>" method="post" enctype="multipart/form-data">
		<?php 
			if(isset($id))
			{
				$city_id = $id;
				$this->db->where('City_ID',$id);			          
				$item=$this->db->get('viecbycity')->row();
				$id=$item->City_ID;
			}
		?>     
		<input type="hidden" name="id" value="<?php if(isset($id)) { echo $id; }; ?>" />	
		<input type="hidden" name="city_id" value="<?php if(isset($city_id)) { echo $city_id; }; ?>" />	
		<div class="gray">
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề (h1):</strong></td>
			<td><input type="text" name="h1" id="h1" value="<?php if(isset($id)) {echo htmlspecialchars($item->h1);} ?>" /></td>
		</tr>
		<tr><td colspan="2">				
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="editor" id="editor" /><?php if(isset($id)) {echo $item->content;} ?></textarea>
		</td></tr>			
		<tr class="second"><td width="200"><strong>keywork</strong></td>
			<td>
			<input type="text" name="keywork" value="<?php if(isset($id)) { echo $item->keywork; }; ?>" />
		</td></tr>				
		<tr><td width="200">
			<strong>Description</strong></td>
			<td>
            <textarea name="description" id="description" rows="5" cols="40" ><?php if(isset($id)) { echo $item->description; }; ?></textarea>
		      </td>
        </tr>
		<tr><td width="200">
			<strong>Title </strong></td>
			<td>
			<textarea name="title" id="title" rows="5" cols="40" ><?php if(isset($id)) { echo $item->title; }; ?></textarea>
		</td></tr>
		
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
				<input class="button" type="submit" name="submit" value="Cập nhật" />					
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
<div class="content-inner">
	<form name="frmslider" action="<?php echo site_url('admin/add_urltheomontinhthanh'); ?>" method="post" enctype="multipart/form-data">
		<?php 

			if(isset($subject_id) && isset($subject_id))
			{
				$this->db->where('Subject_ID',$subject_id);			          
				$this->db->where('City_ID',$city_id);			          
				$item=$this->db->get('seobycitysubject')->row();
				$sub_id =$item->Subject_ID;            
				$cit_id =$item->City_ID;
				   
			}
		?>     
		<input type="hidden" name="id" value="<?php if(isset($sub_id) && isset($sub_id)) { echo $item->id; }; ?>" />	
		<input type="hidden" name="city_id" value="<?php if(isset($subject_id) && isset($subject_id)) { echo $city_id; }; ?>" />	
		<input type="hidden" name="subject_id" value="<?php if(isset($subject_id) && isset($subject_id)) { echo $subject_id; }; ?>" />	
		<div class="gray">
		<table class="tab1">
		<tr>
			<td width="150"><strong>Tiêu đề (h1):</strong></td>
			<td><input type="text" name="h1" id="h1" value="<?php if(isset($sub_id) && isset($cit_id)) {echo htmlspecialchars($item->h1);} ?>" /></td>
		</tr>
		<tr><td colspan="2">				
			<strong>Nội dung</strong>
			​<textarea rows="5" cols="70" name="editor" id="editor" /><?php if(isset($sub_id) && isset($cit_id)) {echo $item->content;} ?></textarea>
		</td></tr>		
		<tr class="second"><td width="200"><strong>keywork</strong></td>
			<td>
			<input type="text" name="keywork" value="<?php if(isset($sub_id) && isset($cit_id)) { echo $item->keywork; }; ?>" />
		</td></tr>				
		<tr><td width="200">
			<strong>Description</strong></td>
			<td>
            <textarea name="description" id="description" rows="5" cols="40" ><?php if(isset($sub_id) && isset($cit_id)) { echo $item->description; }; ?></textarea>
		      </td>
        </tr>
		<tr><td width="200">
			<strong>Title</strong></td>
			<td>
			<textarea name="title" id="title" rows="5" cols="40" ><?php if(isset($sub_id) && isset($cit_id)) { echo $item->title; }; ?></textarea>
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
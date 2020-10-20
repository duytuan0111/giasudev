<?php 
$CI=&get_instance();

$CI->load->model('admin/admin_model');
$this->db->where('status',1);
$this->db->where('name',$_SESSION['name_admin']);
$admin=$this->db->get('tbl_admin')->row();
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#frmxoaall').submit(function(){
			if(!$('#request-form input[type="checkbox"]').is(':checked')){
  				alert("Bạn phải chọn ít nhất 1 bản ghi.");
 			 return false;
			}
		});
	});

	function checkall(class_name,obj)
	{
		var items=document.getElementsByClassName(class_name);
		if(obj.checked == true)
		{
			for(i=0;i<items.length;i++)
				items[i].checked=true;
		}
		else
		{
			for(i=0;i<items.length;i++)
				items[i].checked=false;					
				
		}
	}	
</script>
<div class="form-search">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/keywork'); ?>">
<input class="text-search" name="txt_search" type="text" value="<?php if(isset($_SESSION['txt_search'])){ echo $_SESSION['txt_search'];} ?>" placeholder="Từ khóa tìm kiếm" />
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_keywork'); ?>">
<p class="sidebar"><a href="<?php echo site_url('admin/frmkeywork'); ?>">Thêm mới</a> <input type="submit" name="submit" value="Xóa" /></p>
<table width="100%">
    <tr class="title">
        <td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>        
        <td width="40%">Từ khóa</td>
		<td width="50%">Link</td>		
		<td width="5%" align="center">id</td>
    </tr>
	<?php 
	if($query->num_rows() >0)
	{
	?>
    <?php 
		foreach($query->result() as $item)
        {
		$stt++;			
    ?>
		<tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
			<td align="center">
			<div id="request-form">
				<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $item->id; ?>" />
			</div>
			</td>					
			<td><a href="<?php echo site_url('admin/edit_keywork/'.$item->id.'-'.url_title($item->keywork)); ?>"><?php echo $item->keywork; ?></a></td>			
			<td>
				<a href="<?php echo site_url('admin/edit_keywork/'.$item->link.'-'.url_title($item->link)); ?>"><?php echo $item->link; ?></a>
			 </td>			
							
			<td align="center"><?php echo $item->id; ?></td>
		</tr>		
    <?php 
    }
    ?>
	<?php 
	}
	else
	{
	?>
	<tr><td colspan="8">Dữ liệu đang cập nhật</td></tr>
	<?php    
	}
	?>
</table>

</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
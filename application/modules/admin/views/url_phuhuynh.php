<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

$CI=&get_instance();
//$CI->load->helper('locdau');
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
<!-- <div class="form-search">
	<form name="frmsearch" method="post" action="<?php echo site_url('admin/vieclam'); ?>">
		<input class="text-search" name="findkey" type="text" value="<?php if(isset($_SESSION['findkey'])){ echo $_SESSION['findkey'];} ?>" placeholder="Từ khóa tìm kiếm" />
		<select id="category" name="category" class="city_ab" style="width:150px;">
			<option value="">Chọn môn học</option>
			<?php 
			if(!empty($monhoc)){
				foreach($monhoc as $n){ ?>
					<option value="<?php echo $n->IDs ?>"><?php echo $n->SubjectName ?></option>
				<?php }
			}
			?>               
		</select>
		<select id="city" name="city" class="city_ab" style="width:150px;">                        
			<option data-tokens="0" value="0">Tỉnh thành</option>
			<option data-tokens="1" value="1">Hà Nội</option> 
			<option data-tokens="45" value="45">Hồ Chí Minh</option> 
			<option data-tokens="49" value="49">An Giang</option> 
			<option data-tokens="47" value="47">Bà Rịa Vũng Tàu</option> 
			<option data-tokens="3" value="3">Bắc Giang</option> 
			<option data-tokens="4" value="4">Bắc Kạn</option> 
			<option data-tokens="50" value="50">Bạc Liêu</option> 
			<option data-tokens="5" value="5">Bắc Ninh</option> 
			<option data-tokens="52" value="52">Bến Tre</option> 
			<option data-tokens="46" value="46">Bình Dương</option> 
			<option data-tokens="51" value="51">Bình Phước</option> 
			<option data-tokens="31" value="31">Bình Thuận</option> 
			<option data-tokens="30" value="30">Bình Định</option> 
			<option data-tokens="53" value="53">Cà Mau</option> 
			<option data-tokens="48" value="48">Cần Thơ</option> 
			<option data-tokens="6" value="6">Cao Bằng</option> 
			<option data-tokens="34" value="34">Gia Lai</option> 
			<option data-tokens="10" value="10">Hà Giang</option> 
			<option data-tokens="11" value="11">Hà Nam</option> 
			<option data-tokens="35" value="35">Hà Tĩnh</option> 
			<option data-tokens="9" value="9">Hải Dương</option> 
			<option data-tokens="2" value="2">Hải Phòng</option> 
			<option data-tokens="56" value="56">Hậu Giang</option> 
			<option data-tokens="8" value="8">Hòa Bình</option> 
			<option data-tokens="12" value="12">Hưng Yên</option> 
			<option data-tokens="28" value="28">Khánh Hòa</option> 
			<option data-tokens="57" value="57">Kiên Giang</option> 
			<option data-tokens="36" value="36">Kon Tum</option> 
			<option data-tokens="14" value="14">Lai Châu</option> 
			<option data-tokens="29" value="29">Lâm Đồng</option> 
			<option data-tokens="15" value="15">Lạng Sơn</option> 
			<option data-tokens="13" value="13">Lào Cai</option> 
			<option data-tokens="58" value="58">Long An</option> 
			<option data-tokens="17" value="17">Nam Định</option> 
			<option data-tokens="37" value="37">Nghệ An</option> 
			<option data-tokens="16" value="16">Ninh Bình</option> 
			<option data-tokens="38" value="38">Ninh Thuận</option> 
			<option data-tokens="18" value="18">Phú Thọ</option> 
			<option data-tokens="39" value="39">Phú Yên</option> 
			<option data-tokens="40" value="40">Quảng Bình</option> 
			<option data-tokens="41" value="41">Quảng Nam</option> 
			<option data-tokens="42" value="42">Quảng Ngãi</option> 
			<option data-tokens="19" value="19">Quảng Ninh</option> 
			<option data-tokens="43" value="43">Quảng Trị</option> 
			<option data-tokens="59" value="59">Sóc Trăng</option> 
			<option data-tokens="20" value="20">Sơn La</option> 
			<option data-tokens="61" value="61">Tây Ninh</option> 
			<option data-tokens="21" value="21">Thái Bình</option> 
			<option data-tokens="22" value="22">Thái Nguyên</option> 
			<option data-tokens="44" value="44">Thanh Hóa</option> 
			<option data-tokens="27" value="27">Thừa Thiên Huế</option> 
			<option data-tokens="60" value="60">Tiền Giang</option> 
			<option data-tokens="62" value="62">Trà Vinh</option> 
			<option data-tokens="23" value="23">Tuyên Quang</option> 
			<option data-tokens="63" value="63">Vĩnh Long</option> 
			<option data-tokens="24" value="24">Vĩnh Phúc</option> 
			<option data-tokens="25" value="25">Yên Bái</option> 
			<option data-tokens="26" value="26">Đà Nẵng</option> 
			<option data-tokens="32" value="32">Đắk Lắk</option> 
			<option data-tokens="33" value="33">Đắk Nông</option> 
			<option data-tokens="7" value="7">Điện Biên</option> 
			<option data-tokens="55" value="55">Đồng Nai</option> 
			<option data-tokens="54" value="54">Đồng Tháp</option>                      
		</select>
		<select name="hot" style="width:125px;">
			<option value="0">-- Chọn Vip --</option>
			<option value="1" <?php if(isset($_SESSION['tinhot']) and $_SESSION['tinhot']==1){ ?>selected="selected"<?php } ?>>Hot</option>

		</select>

		<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
	</form>
</div> -->
<h3 class="header">Quản lý url phụ huynh</h3>
<div class="form-search">
<form name="frmsearch" method="post" action="<?php echo site_url('admin/url_phuhuynh'); ?>">
<input class="text-search" name="txt_search" type="text" value="<?php if(isset($_SESSION['txt_search'])){ echo $_SESSION['txt_search'];} ?>" placeholder="Từ khóa tìm kiếm" />

<select name="search_status" style="width:110px;">
	<option value="3" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==3){ ?>selected="selected"<?php } ?>>Tất cả</option>
	<option value="0" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==0){ ?>selected="selected"<?php } ?>>Môn học</option>
	<option value="1" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==1){ ?>selected="selected"<?php } ?>>Địa điểm</option>
	<option value="2" <?php if(isset($_SESSION['search_status']) and $_SESSION['search_status']==2){ ?>selected="selected"<?php } ?>>Môn học và địa điểm</option>
	
</select>
<select name="search_address" id="search_address" style="width:110px;">
	<option value>-- Tỉnh/ thành --</option>
	<?php foreach ($listcity as $k) { ?>
	<option value="<?php echo $k->cit_id; ?>" <?php if(isset($_SESSION['search_address']) and $_SESSION['search_address']== $k->cit_id ){ ?>selected="selected"<?php } ?>><?php echo $k->cit_name; ?></option>
	<?php } ?>
</select>
<input class="button_w" type="submit" name="submit" value="Tìm kiếm" />
</form>
</div>
<form name="frmxoaall" id="frmxoaall" method="post" action="<?php echo site_url('admin/del_urlphuhuynh'); ?>">
	 <p class="sidebar"> <input type="submit" name="submit" value="Xóa" /></p>
	<table width="100%" style="display:block;">
		<tr class="title">
			<td width="5%" align="center"><input type="checkbox" onclick="checkall('checkbox', this)" name="check"/></td>
			<td width="5%" align="center">TOP</td>        
			<td width="5%" align="center">STT</td>        
			<td width="20%">Key tag</td>        
			<td width="20%">Địa điểm</td>        
			<td width="20%">Url</td>
			<td width="5%" align="center">Index</td>   
			<td width="5%"></td>
			
		</tr>
		<?php foreach ($query as $n ) { ?>
		
		<tr class="<?php echo $stt%2 ? 'odd' : 'even'; ?>">
			<td align="center">
				<div id="request-form">
					<input type="checkbox" name="checkbox[]" class="checkbox" value="<?php echo $n->ID ?>" />
				</div>
			</td>
			<td align="center">
				<div id="request-form">
					<input type="checkbox" name="is_top" class="checkbox_is_search" <?php echo ($n->is_top == 1) ? 'checked' : '' ?> value="" data-val="<?php echo $n->ID ?>" />
				</div>
			</td>
			<td align="center"><?php echo $n->ID; ?></td>					
			<td align="center"><p><?php echo ($n->key_tag); ?></p></td>		
			<td align="center"><p><?php echo ($n->place_name); ?></p></td>		
			<td>
				<?php if ($n->option == 0) { ?>
					<a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-<?php echo $n->alias ?>-s<?php echo $n->ID ?>c0p0.html" target="blank"><?php echo base_url(); ?>tim-viec-lam-gia-su-<?php echo $n->alias ?>-s<?php echo $n->ID ?>c0p0.html</a>
				<?php } else if($n->option == 1) { ?>
					<a href="<?php echo base_url(); ?>tim-viec-lam-gia-su-tai-<?php echo vn_str_filter($n->place_name)?>-s0c0p<?php echo $n->place_id ?>.html" target="blank"><?php echo base_url(); ?>tim-viec-lam-gia-su-tai-<?php echo vn_str_filter($n->place_name)?>-s0c0p<?php echo $n->place_id ?>.html</a>
				<?php } else if($n->option == 2) { ?>
					<!-- <a target="blank" href="<?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $n->alias?>-tai-<?php echo vn_str_filter($n->place_name); ?>-m<?php echo $n->ID ?>c0p<?php echo $n->place_id; ?>.html"><?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $n->alias?>-tai-<?php echo vn_str_filter($n->place_name); ?>-m<?php echo $n->ID ?>c0p<?php echo $n->place_id; ?>.html</a> -->
					<a target="blank" href="<?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $n->alias ?>-m<?php echo $n->ID ?>c0p<?php echo $n->place_id; ?>.html"><?php echo base_url(); ?>tim-viec-lam-gia-su-mon-<?php echo $n->alias ?>-m<?php echo $n->ID ?>c0p<?php echo $n->place_id; ?>.html</a>
				<?php } ?>
			</td>
			<td align="center">
				<div id="request-form">
					<input type="checkbox" name="index" class="checkbox_index" <?php echo ($n->index == 1) ? 'checked' : '' ?> value="" data-val="<?php echo $n->ID ?>" />
				</div>
			</td>			
			<td align="center">						
				<a href="<?php echo base_url(); ?>admin/exit_urlphuhuynh/<?php echo $n->ID ?>" class="btn btn-sm btn-danger">Sửa</a>
			</td> 

			


		</tr>
		<?php } ?>		

	</table>

</form>
<div class="clr"></div>
<div class="pagation">
	<?php echo $pagination; ?>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var url = '<?php echo base_url(); ?>';
		$('.checkbox_is_search').change(function(event) {
			var checkbox_is_search = $(this).val();
			var id = $(this).attr('data-val');
			if ($(this).is(':checked') == true) {
				checkbox_is_search = 1;
			} else {
				checkbox_is_search = 0
			}
			$.ajax({
				url: url+'admin/update_is_top1/'+id,
				type: 'POST',
				dataType: 'JSON',
				data: {is_top: checkbox_is_search},
				success: function(data) {
					if (data.kq == true) {
						window.location.reload();
					} else {
						alert('Cập nhật không thành công');
					}
				},
				error: function(xhr) {
					alert('Cập nhật không thành công');
				}
			})
		// 
		});
		// check index
	$('.checkbox_index').change(function(event) {
			var index = $(this).val();
			var id = $(this).attr('data-val');
			if ($(this).is(':checked') == true) {
				index = 1;
			} else {
				index = 0;
			}
			$.ajax({
				url: url+'admin/update_index/'+id,
				type: 'POST',
				dataType: 'JSON',
				data: {index: index, tbl: 'url_timviec'},
				success: function(res) {
					if (res.kq == true) {
						window.location.reload();
					} else {
						alert('error');
					}
				}, 
				error: function(kq) {
					alert('Error');
				}
			})
			
			
		});
	});
	
	function check_statusck(tblname,field,status,fieldid,id)
	{
		$.ajax({
			cache:false,
			type:"POST",  
			url:"<?php echo site_url() ?>admin/statusck", 
			data:{tblname : tblname, field : field,fieldvl:status,fieldid:fieldid,id:id},
			success:function(html){				
				//window.location.href = ""+'/'+name;
				location.reload();
			}                                                          
		});  
	}
</script>
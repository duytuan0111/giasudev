<?php ?>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left1'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right right-uv" style="min-height:300px;">
                <div class="fromdatime">
                        <div class="clr" style="height:0px"></div>
                        <!--<div class="form-control">
                            <input type="text" id="datepiker" name="datepiker" placeholder="Chọn khoảng thời gian" />
                            <i class="fa fa-datetime"></i> 
                        </div>-->
                        <!--<a class="btnhoanthienhoso"><i class="fa fa-uv-hths"></i> Hoàn thiện hồ sơ</a>-->
                </div>
                <div class="box-file-newest uvupdatesuccess">
                    
                        <div class="title"><i class="fa fa-infomation-black"></i> Thông tin hồ sơ                    
                        </div>
                        <div class="uvinfo-header edit">
                            <div class="uvinfoheader-l">
                                <span class="uvimgrepresent">
                                <?php if(empty($uinfo->Image)) {?>
                                <img src="<?php echo base_url(); ?>images/no-image2.png" alt="" class="img-t-01">
                                <?php } else {?>
                                <img src="<?php echo base_url(); ?>upload/images/<?php echo $uinfo->Image ?>" class="img-t-01" />
                                <?php } ?>
                                
                                <input type="file" id="file" name="file" title=" "  class="input-t"/>
                                <button id="upload" class="button-t ">Cập nhật ảnh</button>
                                <!-- <label for="file"><span>Thay ảnh đại diện</span></label>			 -->
                            </div>
                            <div class="uvinfoheader-r row">                                
                                <div style="width:90%;">
                                  <ul>
                                    <div class="col-md-6 col-xs-12">
                                      <li style="width:90%;"><label class="label-control required-left">Họ và tên</label>
                                        <div class="form-control"><input  placeholder="Họ và tên" value="<?php echo $uinfo->Name ?>" type="text" id="txtname" name="txtname" /></div>
                                      </li>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                      <li rowspan="2" style="vertical-align: top;">
                                        <div class="form-inline">
                                          <label style="margin-right:30px;" class="required-left">Giới thiệu bản thân: </label>
                                          <div class="form-group">
                                            <textarea id="txtdescription" name="txtdescription" placeholder="Giới thiệu bản thân" style="width:100%;padding:10px;height:110px;"><?php echo trim($uinfo->Description) ?></textarea>
                                          </div>
                                        </div>
                                      </li>
                                    </div>
                                  </ul>
                                  
                                    
                                    <ul>
                                        <li><label class="label-control required-left">Ngày sinh</label>
                                            <div class='input-group date' id='datetimepicker1' style="width: 90%">
                                                    <input type='text' name="txtngaysinh" placeholder="Ngày sinh" value="<?php echo date('d-m-Y',strtotime($uinfo->Birth))  ?>" id="txtngaysinh" class="form-control" />
                                                    <span class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </span>
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="uvfun-bottom">
                            <span class="btnuvhuy"><i class="fa fa-uv-cancel"></i> Hủy</span>
                            <span class="btnuvcapnhat capnhat1"><i class="fa fa-uv-updateall"></i> Cập nhật</span>
                        </div> -->
                        <!--info function-->
                        
                        <div class="uvinfo-canhan edit" style="clear: both;overflow: hidden;">
                            <div class="tablediv">
                                <div class="title2"><span>Thông tin cá nhân </span>
                                </div>
                            </div>
                            <div class="tablediv col-md-12">
                                <div class="tablediv_l col-md-6 padd-l-0">
                                    <label class="label-control required-left">Email:</label>
                                            <div class="form-control"><input disabled placeholder="abc@gmail.com" value="<?php echo $uinfo->Email ?>" type="text" id="txtemail" name="txtemail" /></div>
                                </div>
                                <div class="tablediv_r col-md-6 padd-r-0">
                                    <label class="label-control required-left">Giới tính:</label>
                                    <select id="txtgioitinh" name="txtgioitinh" class="form-control">
                                                <option value="">Chọn giới tính</option>
                                                <option value="1" <?php if($uinfo->Sex==1){?> selected <?php } ?> >Nam</option>
                                                <option value="2" <?php if($uinfo->Sex==2){?> selected <?php } ?>>Nữ</option>
                                    </select>
                                 </div>
                                 <div class="col-md-12 padd-0">
                                    <label class="label-control required-left">Địa chỉ:</label>
                                    <div class="form-control"><input placeholder="Việt Nam" value="<?php echo $uinfo->Address ?>" type="text" id="txtaddress" name="txtaddress" /></div>                                
                                 </div>
                            </div>
                        </div>
                        <div class="uvfun-bottom">
                            <span class="btnuvhuy"><i class="fa fa-uv-cancel"></i> Hủy</span>
                            <span class="btnuvcapnhat capnhat2"><i class="fa fa-uv-updateall"></i> Cập nhật</span>
                        </div>                        
                        <!--end info function-->
                    
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function () { 
   var configulr='<?php echo site_url(); ?>';
    $('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('.capnhat2').on('click',function(){
        if(validate2giasu()){
            $.ajax(
                      {                          
                          url: configulr+"site/ajaxupdateusersinfomation2",
                          type: "POST",
                          data: {
                            gioitinh:$('#txtgioitinh').val(),
                            diachi:$('#txtaddress').val(),
                            hoten: $('#txtname').val() ,
                            ngaysinh:$('#txtngaysinh').val(),
                            mota:$('#txtdescription').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                alert('Cập nhật thành công');
                                }else{
                                    alert(obj.data);
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {
                              
                              $('#myModal').modal('hide');
                              window.location.reload();
                          }
                      }); 
        }
    });
    function validategiasu()
    {
        var flag=true;
        if ($.trim($('#txtname').val()) == '') {
                    $($('#txtname')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtname').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtdescription').val()) == '') {
                    $($('#txtdescription')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtdescription').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtngaysinh').val()) == '') {
                    $($('#txtngaysinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtngaysinh').data("title", "").removeClass("errorClass");
                }
        return flag;
        };
    function validate2giasu()
    {
        var flag=true;
        if ($.trim($('#txtemail').val()) == '') {
                    $($('#txtemail')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtemail').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtgioitinh').val()) == '') {
                    $($('#txtgioitinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtgioitinh').data("title", "").removeClass("errorClass");
                }
        if ($.trim($('#txtaddress').val()) == '') {
                    $($('#txtaddress')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtaddress').data("title", "").removeClass("errorClass");
                }
        return flag;
        };
});
</script>
<script type="text/javascript">
    $(document).ready(function (e) {
        $('#upload').on('click', function () {
            var file_data = $('#file').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: configulr+"site/upload_file", // point to server-side controller method
                dataType: 'text', // what to expect back from the server
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                success: function (res) {
                    // if(res.kq1 ==true){
                    // alert('Cập nhật thành công');
                    // }else{
                    //     alert(res.form_data);
                    // }
                    // $('#msg').html(res); // display success response from the server
                },
                error: function (res1) {
                        alert('Kích thước size ảnh không vượt quá 1024kb');
                },
                    complete: function () { 
                        window.location.reload();
                }
            });
        });

        $('.uvimgrepresent img').click(function(){
            $('#file').click();
        });
        $('#file').change(function(){
            $('#upload').click();
        });
    });
</script>
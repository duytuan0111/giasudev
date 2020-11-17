<?php ?>
<style>
  @media (max-width: 479px) {
    .city-none {
      display: none;
    }
  }
</style>
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
                    <!-- <div class="countitem">Tổng số: <?php echo $giaovienluu->giasumoiday ?></div> -->
                </div>
               <div class="box-file-newest uvrecruitjob">
                    <div class="title"><i class="fa fa-man-brown"></i> Danh sách gia sư đã xem thông tin gần đây                   
                    </div>
                    <table class="uv-ungtuyen box-has-news teacherinvite">
                        <thead>
                        <tr>
                            
                            <th style="width:40%">Họ và tên</th>
                            <th style="width:13%">Số điện thoại</th>
                            <th style="width:15%">Email</th>
                            <th style="width:17%" class="city-none">Địa chỉ</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($giasudadaxem)){
                                foreach($giasudadaxem as $n){
                                    
                                
                            ?>
                                <tr>
                                
                                <td><a href="<?php echo base_url().vn_str_filter($n->Name).'-gv'.$n->UserID ?>"><?php echo $n->Name; ?></a>
                                </td>
                                <td><?php if ($n->Phone !='') {echo $n->Phone;} else { echo 'Chưa cập nhật';} ?></td>                                
                                <td><?php if ($n->Email !='') {echo $n->Email;} else { echo 'Chưa cập nhật';} ?></td>                                
                                <td class="city-none"><?php if ($n->CityName !='') {echo $n->CityName;} else { echo 'Chưa cập nhật';} ?></td>                                
                            </tr>
                            <?php } } else { echo "<p class='text-center'>Không tìm thấy bản ghi.</p>"; } ?>

                        </tbody>
                        <?php if (!empty($giasudadaxem)) { ?>
                           <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="loadmoreitem"><input type="hidden" id="txtpage" name="txtpage" value="2" /><span id="btnloadmoreitem" class="btn-link"><i class="fa fa-arrow-loadmore"></i> Xem thêm</span></div>
                                </td>
                            </tr>
                        </tfoot> 
                        <?php  } ?>
                        
                    </table>
                    
                </div> 
            </div>
        </div>
    </div>
</div>
</section>
<script>
    $(document).ready(function () {
        var configulr='<?php echo base_url(); ?>';
        $('#btnloadmoreitem').on('click',function(){
            $.ajax(
                      {                          
                          url: configulr+"site/ajaxloadmoreteachersee",
                          type: "POST",
                          data: { 
                            page: $('#txtpage').val()
                          },
                          dataType: 'json',
                          beforeSend: function () {
                              $("#boxLoading").show();
                          },
                          success: function (obj) {
                             
                             if(obj.kq ==true){
                                var j=parseInt($('#txtpage').val())+1;
                                $('.teacherinvite tbody').append(obj.data);
                                $('#txtpage').val(j);
                                }else{
                                   alert('Đã tải toàn bộ lớp bạn đã lưu');
                                }
                          },
                          error: function (xhr) {
                              alert("error");
                          },
                          complete: function () {
                              
                          }
                      }); 
        });
        
        
        });
 </script>
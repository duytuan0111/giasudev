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
                    <div class="countitem">Tổng số: <?php echo $countclass ?></div>
                </div>
               <div class="box-file-newest uvrecruitjob">
                    <div class="title"><i class="fa fa-man-brown"></i> Danh sách lớp học 
                        <a class="btn btn-link btnthemmoilophoc pull-right" href="<?php echo site_url('mn-hv-dang-tin') ?>" >Thêm mới</a>                   
                    </div>
                    <table class="uv-ungtuyen box-has-news teacherinvite">
                        <thead>
                        <tr>
                            
                            <th style="width:45%">Tiêu đề</th>
                            <th style="width:13%">Hình thức dạy</th>
                            <th style="width:15%">Mức học phí</th>
                            <th style="width:15%">Môn học</th>
                            <th style="width:12%">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($uclass)){
                                foreach($uclass as $n){
                            ?>
                                <tr>                                
                                <td><a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>"><?php echo $n->ClassTitle; ?></a>
                                    <span><?php echo $n->TitleView; ?></span>
                                </td>
                                <td><?php echo GetLearnType($n->LearnType) ?></td>                                
                                <td><?php echo number_format($n->Money)." vnđ/h"; ?></td>
                                <td><?php echo $n->SubjectName ?></td>       
                                <td class="actionjob">
                                    <a class="btn btnntdupdate" data-val="<?php echo $n->ClassID ?>" data-id="<?php echo $n->ClassID ?>"><i class="fa fa-refresh"></i> Sửa </a>
                                    <a data-val="<?php echo $n->ClassID ?>" id="xoalopdadang" class="btn btnntddelete"><i class="fa fa-trash"></i> Xóa</a>
                                    <a href="<?php echo base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID ?>" target="_blank" class="btn btnntdviewdetail"><i class="fa fa-view-detail"></i> Chi tiết</a>
                                </td>                         
                            </tr>
                            <?php } } ?>
                        </tbody>
                        <?php if(!empty($giasudaluu) && count($giasudaluu) >= 6){ ?>
                           <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <div class="loadmoreitem"><input type="hidden" id="txtpage" name="txtpage" value="2" /><span id="btnloadmoreitem" class="btn-link"><i class="fa fa-arrow-loadmore"></i> Xem thêm</span></div>
                                    </td>
                                </tr>
                            </tfoot> 
                        <?php } ?>
                        
                    </table>
                    <?php if (empty($uclass)) {
                      echo "<p class='text-center'>Không tìm thấy bản ghi.</p>";
                    } ?>
                    
                </div> 
            </div>
        </div>
    </div>
</div>
</section>
<!--modal fade-->

  <script>
    $(document).ready(function () {
        var configulr='<?php echo base_url(); ?>';
        $('.teacherinvite').on('click','a.btnntdupdate',function(){
           var tg= $(this).attr('data-val');
            window.location.href='<?php echo site_url('mn-hv-dang-tin')."/" ?>'+tg;
        });
        // xóa tin đăng tìm lớp học
        $('body').on('click', '#xoalopdadang', function(event) {
            if (confirm('bạn có chắc muốn xóa bản ghi này không ?')) {
                var ClassID = $(this).attr('data-val');
                $.ajax({
                    url: configulr + 'site/ajaxdeleteteacherclass',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {ClassID: ClassID},
                    success: function() {
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Xóa không thành công');
                    }
                })
        

                
            }
        });
        });
  </script>
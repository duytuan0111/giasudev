<?php 
$CI=&get_instance();
$CI->load->model('site/site_model');

?>
<style>
    @media (max-width: 479px) {
        .divyeucau textarea {
            padding-left: 18px;
            margin-left: 1px !important;
        }
        .quanhuyenmobile {
            width: 100% !important;
            height: 100% !important;
        }
    }
</style>
<section class="padd-0">
<div class="container">
    <div class="row">
        <div class="manager-col-left col-md-3 col-sm-12 width-250">
            <?php $this->load->view('left'); ?>
        </div>
        <div class="manager-col-right col-md-9 col-sm-12">
            <div class="content-right " style="min-height:300px;">
                <!-- <div class="clr" style="height:10px;position: relative;"><a class="btnlogout"><i class="fa fa-logout"></i> Thoát</a></div> -->
                <div class="clr" style="height:50px;"></div>
                <div class="col-md-12">
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <div class="col-md-12 batbuoc">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin cá nhân</h4>
                            
                        </div>
                    </div>
                    <form enctype="multipart/form-data">
                    <div class="col-md-12">
                    
                            <label  class="required">Họ tên</label>
                            <div class="form-control ">
                                <input type="text" placeholder="Vui lòng nhập họ tên" id="txthoten" value="<?php echo $info->Name ?>">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="required">Ảnh đại diện</label>
                                    <div class="form-control">
                                        <input accept="image/x-png,image/gif,image/jpeg" type="file" name="anhdaidien" id="anhdaidien" class="inputfile inputfile-6" data-multiple-caption="{count} files" multiple />
        					               <label for="anhdaidien"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if(!empty($info->Image)){ 
                                        $tg=explode('-',date('d-m-Y',strtotime($info->CreateDate)));
                                        
                                        ?>
                                    <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$info->Image  ?>" width="100px" height="100px"/>
                                    <?php } 
                                    else {?>
                                    <img src="<?php echo base_url();?>upload/images/no-image2.png" width="100px" height="100px"/>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <label>Ảnh CMND, thẻ sinh viên hoặc bằng cấp chuyên môn cao nhất <span>(để tăng sự tin tưởng của học viên với bạn)</span></label>
                                    <div class="form-control">
                                        <input accept="image/x-png,image/gif,image/jpeg" type="file" name="anhcmnd" id="anhcmnd" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
        					               <label for="anhcmnd"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <?php if(!empty($info->ImgPassport)){ 
                                        $tg=explode('-',date('d-m-Y',strtotime($info->CreateDate)));
                                        
                                        ?>
                                    <img src="<?php echo base_url(); ?>upload/users/thumb/<?php echo $tg[2]."/".$tg[1]."/".$tg[0]."/".$info->ImgPassport  ?>" width="60px" height="60px"/>
                                    <?php } 
                                    else {?>
                                    <img src="<?php echo base_url(); ?>upload/images/no-image2.png" width="100px" height="100px"/>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <label class="required">Ngày tháng năm sinh</label>
                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                    <input type='text' placeholder="Ngày sinh" id="txtngaysinh" class="form-control" value="<?php echo date('d-m-Y',strtotime($info->Birth)) ?>" />
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($info->Sex==1){ ?> checked="checked" <?php } ?> name="location1" id="location1" type="radio">
                                    <label for="location1">Nam</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2"  <?php if($info->Sex==2){ ?> checked="checked" <?php } ?>  name="location1" id="location2" type="radio">
                                    <label for="location2">Nữ</label>                                     
                                </div>
                            </div>
                            <label>Nơi ở hiện tại</label>
                            <div class="form-control">
                                <input type="text" value="<?php echo $info->Address ?>" placeholder="Vui lòng nhập chi tiết nơi ở hiện tại" id="txtnoiohientai">
                            </div>
                            <label>Hiện tại là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Hiện tại là</option>
                                    <?php
                                        if(!empty($teachtype)){
                                            foreach($teachtype as $n){
                                                if($n->ID == intval($info->TeachType)){
                                                ?>
                                        <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>            
                                    <?php }else{ ?>
                                        <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option> 
                                    <?php } }
                                        } 
                                    ?>
                                </select>
                            </div>
                            <label>Học trường</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập trường học của bạn" id="txtschool" value="<?php echo $info->School ?>">
                            </div>
                            <label>Chuyên ngành</label>
                            <div class="form-control">
                                <input type="text" placeholder="Chuyên ngành học" id="txtmajor" value="<?php echo $info->Major ?>">
                            </div>
                            <label>Năm tốt nghiệp</label>
                            <div class="form-control">
                                <input type="text" placeholder="Năm tốt nghiệp" id="txtGraduationyear" value="<?php echo $info->Graduationyear ?>">
                            </div>
                            <label>Nơi công tác <span>(nếu đã đi làm)</span></label>
                            <div class="form-control">
                                <input type="text" placeholder="Nơi công tác" id="txtworkplace" value="<?php echo $info->Workplace ?>">
                            </div>
                            <div class="clearfix"></div>
                            <label>Kinh nghiệm đi dạy</label>
                            <div class="">
                                <textarea id="kinhnghiem" name="kinhnghiem" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Exp ?></textarea>
                            </div>
                            <label>Thành tích</label>
                            <div class="">
                                <textarea id="thanhtich" name="thanhtich" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Bonus ?></textarea>
                            </div>
                            <label>Giới thiệu về bản thân</label>
                            <div class="">
                                <textarea id="infouser" name="infouser" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Description ?></textarea>
                            </div>
                            
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin gia sư</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                            <label>Môn học sẽ dạy</label>
                            <div class="form-control quanhuyenmobile">
                                <?php 
                                $arrIdTitle = explode(',',$info->IdTitle);
                                ?>
                                <select id="monhoc" name="monhoc" multiple="multiple">
                                    <option value="0">Chọn môn học</option>
                                    <?php 
                                    
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){
                                            if(in_array($n->ID,$arrIdTitle)){
                                                $checked = "selected";
                                            }else{
                                                $checked = '';
                                            }
                                            ?>
                                            <option <?php echo $checked ?> value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                        <?php }
                                    }
                                    ?> 
                                </select>
                            </div>
                           <!--  <div class="form-control">
                                <?php 
                                $arrIdTitle = explode(',',$info->IdTitle);
                                ?>
                                <select id="monhoc" name="monhoc" multiple="multiple">
                                    <option value="0">Chọn môn học</option>
                                    <?php 
                                    
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){
                                            if(in_array($n->ID,$arrIdTitle)){
                                                $checked = "selected";
                                            }else{
                                                $checked = '';
                                            }
                                        ?>
                                            <option <?php echo $checked ?> value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }
                                        }
                                    ?> 
        						</select>
                            </div> -->
                            <div id="grouptopic">
                            <?php if(count($usersubject) > 0){ 
                                for($i=0;$i<count($usersubject);$i++){
                                    echo "<div class='child_".vn_str_filter($subjectname[$i])."' id='group-topic".$usersubject[$i]."'>" ;
                                    echo "<label>Lớp hoặc chủ đề môn học <span>(".$subjectname[$i].")</span></label>";
                                    $lstopic=$CI->site_model->ListTopicBySubject($usersubject[$i]);
                                    if(count($lstopic) >0){
                                        echo "<div class='form-group'><ul class='ultopic'>";
                                        $data="";
                                           for($j=0;$j<count($lstopic);$j++){
                                            if(in_array($lstopic[$j]->ID,$usertopic) ){
                                                $data.="<li>";
                                                $data.="<input class='radio-calendar' id='toppic-".$lstopic[$j]->ID."' checked='checked' type='checkbox' name='toppicchk' value='".$lstopic[$j]->ID."'>
                                                        <label for='toppic-".$lstopic[$j]->ID."'>".$lstopic[$j]->NameTopic."</label>";
                                                $data.="</li>";
                                                }else{
                                                $data.="<li>";
                                                $data.="<input class='radio-calendar' id='toppic-".$lstopic[$j]->ID."' type='checkbox' name='toppicchk' value='".$lstopic[$j]->ID."'>
                                                        <label for='toppic-".$lstopic[$j]->ID."'>".$lstopic[$j]->NameTopic."</label>";
                                                $data.="</li>"; 
                                            }
                                           }
                                           echo $data; 
                                        echo "</ul></div>";
                                    }
                                    echo '</div>';
                                }
                                ?>
                                
                            <?php }else{ ?>
                                <div id="group-topic0">
                                <label>Lớp hoặc chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                                <div class="form-group">
                                    <ul class="ultopic">
                                        <li>
                                            <input class="radio-calendar" id="morning-calendar-2"  type="checkbox" name="sang_2" value="sang_2">
                                            <label for="morning-calendar-2" class="lbl-active">Sáng</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="afternoon-calendar-2" type="checkbox" name="chieu_2" value="chieu_2">
                                            <label for="afternoon-calendar-2">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar" id="evening-calendar-2" type="checkbox" name="toi_2" value="toi_2">
                                            <label for="evening-calendar-2">Tối</label>
                                            
                                        </li>
                                    </ul>
                                </div>
                                </div>
                                <?php } ?>
                            </div>
                            <label>Khu vực dạy</label>
                            <div class="form-control">
                                <?php
                                $arrCityID1 = explode(',',$info->CityID1);
                                // var_dump($arrCityID2);
                                ?>
                                <select id="txtcityclass" class="city_ab_tag">
                                    <option data-tokens="0" value="">Địa điểm lớp</option>
                                    <?php 
                                    
                                    if(!empty($tinhthanh)){
                                        foreach($tinhthanh as $n){
                                            if($info->CityID1 == $n->cit_id){
                                                $checked = "selected";
                                            }else{
                                                $checked = '';
                                            }
                                        ?>
                                            <option <?php echo $checked ?> data-tokens="<?php echo $n->cit_id?>" value="<?php echo $n->cit_id?>"><?php echo $n->cit_name ?></option>
                                            <?php }
                                        }
                                    ?> 
                       
                                </select>
                            </div>
                            <div class="form-control quanhuyenmobile">
                                <select id="txtquanhuyen" class="checkquanhuyen" name="txtquanhuyen" multiple="multiple">
                                   <option value="">Quận/Huyện</option>
                                   <?php 
                                    $arrCityID2 = explode(',',$info->CityID2);
                                    if(!empty($quanhuyen)){
                                        foreach($quanhuyen as $qh){
                                            if(in_array($qh->cit_id,$arrCityID2)){
                                                $checked = "selected";
                                            }else{
                                                $checked = '';
                                            }
                                        ?>
                                            <option <?php echo $checked; ?> value="<?php echo $qh->cit_id?>"><?php echo $qh->cit_name ?></option>
                                            <?php }
                                        }
                                    ?> 
                                </select>
                            </div>                                    
                            <div class="form-inline">
                                <label style="margin-right:30px;" class="required">Hình thức dạy: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($info->WorkID==1){ ?> checked="checked" <?php } ?> name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" <?php if($info->WorkID==2){ ?> checked="checked" <?php } ?> name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>                                     
                                </div>                                
                            </div>
                            <label class="required">Học phí dự kiến<span>(vnđ/h)</span></label>
                            <div class="form-control">
                                <input type="text" value="<?php echo $info->Free ?>" placeholder="Nhập học phí dự kiến" id="txthocphi" name="txthocphi">
                            </div>
                            <label>Buổi có thể dạy <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input <?php if($info->MonMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input <?php if($info->MonAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input <?php if($info->MonNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div> 
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input <?php if($info->TueMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->TueAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>                                            
                                        </li>
                                        <li>
                                            <input  <?php if($info->TueNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->WeMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->WeAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input  <?php if($info->WeNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->ThuMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->ThuAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input  <?php if($info->ThuNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->FriMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->FriAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input  <?php if($info->FriNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->SatMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->SatAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label   class="" for="CSatAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input <?php if($info->SatNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input  <?php if($info->SunMorning==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input  <?php if($info->SunAfter==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input  <?php if($info->SunNight==1){ ?> checked="checked" <?php } ?> class="radio-calendar2" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>                                                                           
                            </div>
                            <div class="clearfix"></div>
                            <label>Thông tin khác</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $info->Orther ?></textarea>
                            </div>
                        </div>
                        </form>
                        <div class="col-md-12">
                            <div class="fun">
                                <span class="btn btn-primary btn-success" id="btnteacherupdateinfo">Hoàn tất</span>
                                
                            </div>
                        </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
$(document).ready(function () {
    var abc='<?php echo join(',',$usersubject) ?>';
    var tg1=abc.split(",");
$('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('#txtusername').numeric();
    $("#txthocphi").numeric();
    $('#txtteachtype').select2();
    $('#monhoc').select2({ width: '100%',placeholder: 'Chọn môn học (tối đa 3 môn học)' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
    $('#txtquanhuyen').select2({ width: '100%',placeholder: 'Khu vực bạn có thể dạy (Tối đa 3 Quận/Huyện) ' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });

    $('#txtcityclass').val(<?php echo $info->CityID ?>).select2();
     var configulr='<?php echo site_url(); ?>';
     var id_diadiem = <?php echo $info->CityID ?>;
     $('#monhoc').on('select2:unselect', function(e){
        var monhoc1 = $('#monhoc').val();
        var data = e.params.data;
        var id = data.id;
        $('#group-topic'+id).remove();
     });
     // 
     $('#monhoc').on('select2:select', function () {
            var monhoc=$(this).val();
            if (monhoc == null) {
                $('#grouptopic').empty();
            }
            /*monhoc=monhoc1.split(',');*/
            var abc1= '<?php echo join(',',$usersubject) ?>';
            var tg=abc1.split(",");
            if(monhoc.length > 0){
                    $('#grouptopic div#group-topic0').remove();
                        for(var i=0; i<monhoc.length; i++) {
                            $('#group-topic'+monhoc[i]).remove(); // them
                        // if(tg.indexOf(monhoc[i]) < 0){
                        if(typeof($('#group-topic'+monhoc[i]).attr('data-val'))==='undefined'){
                        var strhtml="<div id='group-topic"+monhoc[i]+"' data-val='"+monhoc[i]+"'>";
                            strhtml+="<label>Lớp hoặc chủ đề môn học <span>("+$(this).find('option[value="' + monhoc[i] + '"]').text()+")</span></label>";
                            $.ajax({
                                      
                                      url: configulr+"/site/AjaxchudeCheckboxNew",
                                      type: "POST",
                                      data: { idmon: monhoc[i] },
                                      dataType: 'json',
                                      async: false,
                                      beforeSend: function () {
                                          $("#boxLoading").show();
                                      },
                                      success: function (obj) {
                                         
                                         if(obj.kq != ''){
                                            var reponse=obj.kq;
                                            
                                            strhtml+="<div class='form-group'><ul class='ultopic'>";
                                            strhtml+=obj.data;
                                            strhtml+="</ul></div>";
                                            strhtml+="</div>";
                                            $('#grouptopic').append(strhtml);

                                            }else{
                                                /*alert('không tồn tại');*/
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
                         // }
                           /*alert($(this).find('option[value="' + monhoc[i] + '"]').text());*/
                     } 
                     
                }
            });
     $('#btnteacherupdateinfo').on('click',function(){
            var tg=[];
            var tgName = [];
            var sexteach=[];
            
                sexteach.push($('input[name=location1]:checked').val());
            
            var itemtopic=document.getElementsByClassName('radio-calendar');
            for(var i=0;i< itemtopic.length;i++){
                
              var valuethis=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').val();
              var valuethat=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').parent().find('label').text();
               if (typeof (valuethis) !== "undefined") {
                tg.push(valuethis);
                }
                if (typeof (valuethat) !== "undefined") 
                {
                    tgName.push(valuethat);
                }
                
            };
            var sang2=0;
            if(typeof($('input[name=CMonMorning]:checked').val())!=='undefined'){
                sang2=$('input[name=CMonMorning]:checked').val();
            };
            var chieu2=0;
            if(typeof($('input[name=CMonAfter]:checked').val())!=='undefined'){
                chieu2=$('input[name=CMonAfter]:checked').val();
            };
            var toi2=0;
            if(typeof($('input[name=CMonNight]:checked').val())!=='undefined'){
                toi2=$('input[name=CMonNight]:checked').val();
            };
            var sang3=0;
            if(typeof($('input[name=CTueMorning]:checked').val())!=='undefined'){
                sang3=$('input[name=CTueMorning]:checked').val();
            };
            var chieu3=0;
            if(typeof($('input[name=CTueAfter]:checked').val())!=='undefined'){
                chieu3=$('input[name=CTueAfter]:checked').val();
            };
            var toi3=0;
            if(typeof($('input[name=CTueNight]:checked').val())!=='undefined'){
                toi3=$('input[name=CTueNight]:checked').val();
            };
            var sang4=0;
            if(typeof($('input[name=CWeMorning]:checked').val())!=='undefined'){
                sang4=$('input[name=CWeMorning]:checked').val();
            };
            var chieu4=0;
            if(typeof($('input[name=CWeAfter]:checked').val())!=='undefined'){
                chieu4=$('input[name=CWeAfter]:checked').val();
            };
            var toi4=0;
            if(typeof($('input[name=CWeNight]:checked').val())!=='undefined'){
                toi4=$('input[name=CWeNight]:checked').val();
            };
            var sang5=0;
            if(typeof($('input[name=CThuMorning]:checked').val())!=='undefined'){
                sang5=$('input[name=CThuMorning]:checked').val();
            };
            var chieu5=0;
            if(typeof($('input[name=CThuAfter]:checked').val())!=='undefined'){
                chieu5=$('input[name=CThuAfter]:checked').val();
            };
            var toi5=0;
            if(typeof($('input[name=CThuNight]:checked').val())!=='undefined'){
                toi5=$('input[name=CThuNight]:checked').val();
            };
            var sang6=0;
            if(typeof($('input[name=CFriMorning]:checked').val())!=='undefined'){
                sang6=$('input[name=CFriMorning]:checked').val();
            };
            var chieu6=0;
            if(typeof($('input[name=CFriAfter]:checked').val())!=='undefined'){
                chieu6=$('input[name=CFriAfter]:checked').val();
            };
            var toi6=0;
            if(typeof($('input[name=CFriNight]:checked').val())!=='undefined'){
                toi6=$('input[name=CFriNight]:checked').val();
            };
            var sang7=0;
            if(typeof($('input[name=CSatMorning]:checked').val())!=='undefined'){
                sang7=$('input[name=CSatMorning]:checked').val();
            };
            var chieu7=0;
            if(typeof($('input[name=CSatAfter]:checked').val())!=='undefined'){
                chieu7=$('input[name=CSatAfter]:checked').val();
            };
            var toi7=0;
            if(typeof($('input[name=CSatNight]:checked').val())!=='undefined'){
                toi7=$('input[name=CSatNight]:checked').val();
            };
            var sang8=0;
            if(typeof($('input[name=CSunMorning]:checked').val())!=='undefined'){
                sang8=$('input[name=CSunMorning]:checked').val();
            };
            var chieu8=0;
            if(typeof($('input[name=CSunAfter]:checked').val())!=='undefined'){
                chieu8=$('input[name=CSunAfter]:checked').val();
            };
            var toi8=0;
            if(typeof($('input[name=CSunNight]:checked').val())!=='undefined'){
                toi8=$('input[name=CSunNight]:checked').val();
            };
            
            var arrmonhoc=$('#monhoc').val();
            if(arrmonhoc == null){
                alert('Vui lòng chọn môn học !!!');
                $('#monhoc').focus();
                return false;
            }else{
                arrmonhoc = arrmonhoc.join();
            }
            var arrquanhuyen = $('#txtquanhuyen').val();
            if(arrquanhuyen == null){
                alert('Vui lòng chọn quận huyện !!!');
                $('#txtquanhuyen').focus();
                return false;
            }else{
                arrquanhuyen = arrquanhuyen.join();
            }

            var arrmonhoc=$('#monhoc').val();
            var arrquanhuyen = $('#txtquanhuyen').val();
            var file_data = $('#anhdaidien')[0].files[0];
            var filecmnd=$('#anhcmnd')[0].files[0];

            data = new FormData();
            data.append('hoten',$('#txthoten').val());
            data.append('ngaysinh', $('#txtngaysinh').val());
            data.append('ngaysinh', $('#txtngaysinh').val());
            data.append('gioitinh', sexteach[0]);
            data.append('noiohientai', $('#txtnoiohientai').val());
            data.append('hientaila', $('#txtteachtype').val());
            data.append('hoctruong', $('#txtschool').val());
            data.append('chuyennganh', $('#txtmajor').val());
            data.append('namtotnghiep', $('#txtGraduationyear').val());
            data.append('noicongtac', $('#txtworkplace').val());
            data.append('kinhnghiem', $('#kinhnghiem').val());
            data.append('thanhtich', $('#thanhtich').val());
            data.append('gioithieubanthan', $('#infouser').val());
            data.append('monhoc', arrmonhoc);
            data.append('quanhuyen', arrquanhuyen);
            data.append('chudemonhoc', tg.join());
            data.append('tentopic', tgName.join());
            data.append('khuvucday', $('#txtcityclass').val());
            data.append('tenkhuvucday', $('#txtcityclass option:selected').text());            
            data.append('hinhthucday', $('input[name=teachtype]:checked').val());
            data.append('hocphi', $('#txthocphi').val());
            data.append('sang2', sang2);
            data.append('chieu2', chieu2);
            data.append('toi2', toi2);
            data.append('sang3', sang3);
            data.append('chieu3', chieu3);
            data.append('toi3', toi3);
            data.append('sang4', sang4);
            data.append('chieu4', chieu4);
            data.append('toi4', toi4);
            data.append('sang5', sang5);
            data.append('chieu5', chieu5);
            data.append('toi5', toi5);
            data.append('sang6', sang6);
            data.append('chieu6', chieu6);
            data.append('toi6', toi6);
            data.append('sang7', sang7);
            data.append('chieu7', chieu7);
            data.append('toi7', toi7);
            data.append('sang8', sang8);
            data.append('chieu8', chieu8);
            data.append('toi8', toi8);
            data.append('chitietnoidung', $('#chitietnoidung').val());
            data.append('imageuser', file_data);
            data.append('cmnduser', filecmnd);
            
        $.ajax({
                  url: configulr+"site/ajaxteacherupdateinfo",
                  type: "POST",
                  contentType: false,
                  processData: false,
                  data: data,
                  dataType: 'json',
                  enctype: 'multipart/form-data',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                    console.log(reponse);
                    if (reponse.kq == true) {
                        console.log(reponse);
                        console.log(typeof(reponse.isimagecmnd));
                        if ((typeof(reponse.isimagesizeavt !== 'undefined') && (reponse.isimagesizeavt == false)) || (typeof(reponse.isimagecmnd !== 'undefined') && (reponse.isimagecmnd == false))) {
                            alert('Dung lượng ảnh không vượt quá 2MB');
                        }
                        else {
                            alert('Cập nhật thành công');
                            window.location.reload();
                        }

                    }
                    else {
                       alert('Cập nhật thất bại');
                   }
                  },
                  error: function (xhr) {
                      alert("error");
                  },
                  complete: function () {
                      $("#boxLoading").hide();
                    //   window.location.reload();
                  }
              }); 
        });
     })
            $('#txtcityclass').on('change',function()
            {
                var id_diadiem = $(this).val();

                $.ajax({
                    url: configulr+"site/CheckDiaDiem",
                    type:'POST',
                    data:
                    {
                        id_diadiem : id_diadiem
                    },
                    success:function(reponse)
                    {
                        if(id_diadiem==0){
                            $('#txtquanhuyen').html('<option value='+0+'>Quận/Huyện</option>');
                        }
                        else{
                            $('#txtquanhuyen').html(reponse);
                        }
                    },
                    error: function(xhr)
                    {
                        console.log(xhr);
                    },
                    complete: function()
                    {
                        $("#boxLoading").hide();
                    }
                });

            });
</script>
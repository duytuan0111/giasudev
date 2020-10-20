<?php
//mnuserscreateorupdateclass
$CI=&get_instance();
$CI->load->model('site/site_model');
$type = 3;
$idlopday = $uclass->IdLopDay; 
$listid = explode(',', $idlopday);
if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $type = $tg['UserType'];
    $check = $CI ->site_model->checknews($tg['UserId']);
}
// if($type !=3 || $type != 1)
// {
//   if($check == 0)
//   {
//     echo "<script type='text/javascript'>setTimeout(function(){alert('Vui lòng đăng một tin để xác nhận tài khoản')});</script>";
//   }
// }
?>
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
                    </div><div class="countitem">Tổng số: <?php echo $countclass ?></div>-->
                    
                </div>
               <div class="box-file-newest uvupdatesuccess">
                    <?php if($classid > 0){ ?>
                    <?php if(!empty($uclass) ){ $city=$uclass->City; $dis = $uclass->District ?>
                    <div class="uvinfo-canhan edit" style="clear: both;overflow: hidden;">
                        <input type="hidden" id="txtid" name="txtid" value="<?php echo $uclass->ClassID ?>" />
                    </div>
                    <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <h4><i class="fa fa-plus-circle"></i> Chỉnh sửa yêu cầu tìm gia sư</h4>
                        <div class="col-md-10 col-md-offset-1">
                            <label>Tóm tắt yêu cầu tìm gia sư</label>
                            <div class="form-control">
                                <input type="text" placeholder="Ví dụ: Tìm gia sư tiếng Anh lớp 1 tại Hoàn Kiếm" id="txtclassname" value="<?php echo $uclass->ClassTitle ?>" />
                            </div>
                            <label>Yêu cầu gia sư là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Hiện tại là</option>
                                    <?php
                                        if(!empty($lstitem)){
                                            foreach($lstitem as $n){
                                                if($n->ID == intval($uclass->TeachType)){?>
                                                <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                                <?php }else{ ?>
                                                <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                                <?php } ?>
                                                    
                                    <?php }
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-inline">
                            <!-- <?php $tgsex=explode($uclass->TeacherSex); ?> -->
                            <?php $tgsex= $uclass->TeacherSex; ?>
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($tgsex == 1){ ?>checked="checked"<?php } ?> name="location1" id="location1" type="radio">
                                    <label for="location1">Nam</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" <?php if($tgsex == 2){ ?>checked="checked"<?php } ?> name="location1" id="location2" type="radio">
                                    <label for="location2">Nữ</label>                                     
                                </div>
                            </div>
                            <label>Môn học</label>
                            <div class="form-control">
                                <select id="monhoc" name="monhoc">
        							<option value="">Chọn môn học</option>
                                     <?php $monchon=$uclass->SubjectID;
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){ 
                                            if($monchon==$n->ID){
                                            ?>
                                            <option selected="selected" value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            <?php } ?>
                                            <?php }
                                        }
                                    ?> 
        						</select>
                            </div>
                            <label>Lớp hoặc chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                            <div class="form-group">
                                <ul class="ultopic">
                                    <?php 
                                    $lstopic=$CI->site_model->ListTopicBySubject($monchon);
                                    $usertopic=explode(',',$uclass->TopicArr);
                                    if(count($lstopic) >0){
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
                                        }
                                    ?>
                                </ul>
                            </div>
                                <label>Dạy lớp</label>
                            <div class="form-control">
                                <select id="lop" class="checklophoc" name="lop" multiple="multiple">
                                   <option value="">Chọn lớp</option>
                                   <?php 
                                   if(!empty($lop)){
                                    foreach($lop as $n){ ?>
                                        <option value="<?php echo $n->id ?>" <?php echo  ($n->id == $listid[0] || $n->id == $listid[1] || $n->id == $listid[2]) ? 'selected' : '' ?> ><?php echo $n->classname; ?></option>
                                    <?php }
                                }
                                ?> 
                                </select>
                            </div>
                            <label>Số lượng học sinh</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập số lượng học sinh" id="txtsohocsinh" value="<?php echo $uclass->Student ?>" />
                            </div>
                            <label>Số giờ học 1 buổi</label>
                            <div class="form-inline durationtime"> 
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="1" id="duration1" <?php if($uclass->Hours=='1'){ ?>checked="checked"<?php } ?>><label for="duration1">1h</label>
                                </div>                               
                          		<div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="1.5" <?php if($uclass->Hours=='1.5'){ ?>checked="checked"<?php } ?> id="duration2"><label for="duration2">1.5h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2" <?php if($uclass->Hours=='2'){ ?>checked="checked"<?php } ?> id="duration3" ><label for="duration3">2h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2.5" <?php if($uclass->Hours=='2.5'){ ?>checked="checked"<?php } ?> id="duration4"><label for="duration4">2.5h</label>
                                </div>    								        
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Hình thức học: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" <?php if($uclass->LearnType=='1'){ ?>checked="checked"<?php } ?> name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" <?php if($uclass->LearnType=='2'){ ?>checked="checked"<?php } ?> name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>                                     
                                </div>
                                
                            </div>
                            <label>Học phí dự kiến</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập học phí dự kiến" id="txthocphi" value="<?php echo $uclass->Money ?>"/>
                            </div>                            
                            <label>Điện thoại liên hệ</label>
                            <div class="form-control">
                                <input type="text" placeholder="Số điện thoại liên hệ" id="txtphone" maxlength="10" value="<?php echo $uclass->Phone ?>" />
                            </div>
                            <label>Tỉnh thành</label>
                            <div class="form-control">
                                <select id="txtcityclass" class="city_ab_tag">                        
                                    <option data-tokens="0" value="">Địa điểm lớp</option>
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
                            </div>
                            <?php $info_city2 = $CI->site_model->SelectDistrictID($uclass->District); ?>
                            <div class="form-control">
                                <select id="txtquanhuyen" class="checkquanhuyen" name="txtquanhuyen" multiple="multiple">
                                    <?php if (!empty($uclass->District)) { ?>
                                        <option value="<?php echo $uclass->District; ?>" selected><?php echo $info_city2->cit_name; ?></option>
                                        
                                    <?php } else { ?>
                                        <option value="">Quận(huyện)</option>
                                    <?php } ?>
                                   
                                </select>
                            </div> 
                            <label>Địa chỉ diễn ra lớp học</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập địa chỉ diễn ra lớp học" id="txtdiachilop" value="<?php echo $uclass->Address ?>"/>
                            </div>
                            <label>Buổi có thể học <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CMonMorning==1){ ?> checked="checked" <?php } ?> id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CMonAfter==1){ ?> checked="checked" <?php } ?> id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CMonNight==1){ ?> checked="checked" <?php } ?> id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div> 
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CTueMorning==1){ ?> checked="checked" <?php } ?> id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CTueAfter==1){ ?> checked="checked" <?php } ?> id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CTueNight==1){ ?> checked="checked" <?php } ?> id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CWeMorning==1){ ?> checked="checked" <?php } ?> id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CWeAfter==1){ ?> checked="checked" <?php } ?> id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CWeNight==1){ ?> checked="checked" <?php } ?> id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CThuMorning==1){ ?> checked="checked" <?php } ?> id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CThuAfter==1){ ?> checked="checked" <?php } ?> id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CThuNight==1){ ?> checked="checked" <?php } ?> id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CFriMorning==1){ ?> checked="checked" <?php } ?> id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CFriAfter==1){ ?> checked="checked" <?php } ?> id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CFriNight==1){ ?> checked="checked" <?php } ?> id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSatMorning==1){ ?> checked="checked" <?php } ?> id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSatAfter==1){ ?> checked="checked" <?php } ?> id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label class="" for="CSatAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSatNight==1){ ?> checked="checked" <?php } ?> id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSunMorning==1){ ?> checked="checked" <?php } ?> id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSunAfter==1){ ?> checked="checked" <?php } ?> id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" <?php if($uclass->CSunNight==1){ ?> checked="checked" <?php } ?> id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>                                                                           
                            </div>
                            <div class="clearfix"></div>
                            <label>Mô tả chi tiết nội dung</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $uclass->DescClass ?></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="clearfix" style="height:30px;float:left;width:100%;"></div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="dangkytaikhoan">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning" onclick="window.location='<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>'">Quay lại</span>
                    </div>
                </div>
                    <?php }else { $city="";$monchon=""; ?>
                    <div class="title">Bạn không có quyền với bài viết</div>
                    <?php } ?>
                    <?php }else{ $city="";?>
                    <div>Thêm mới bài viết</div>
                    <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <h4><i class="fa fa-plus-circle"></i> Đăng tin tìm gia sư</h4>
                        <div class="col-md-10 col-md-offset-1">
                            <label>Tóm tắt yêu cầu tìm gia sư</label>
                            <div class="form-control">
                                <input type="text" placeholder="Ví dụ: Tìm gia sư tiếng Anh lớp 1 tại Hoàn Kiếm" id="txtclassname"  />
                            </div>
                            <label>Yêu cầu gia sư là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Hiện tại là</option>
                                    <?php
                                        if(!empty($lstitem)){
                                            foreach($lstitem as $n){
                                                ?>
                                                
                                                <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>
                                                
                                                    
                                    <?php }
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-inline">
                            
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="checked"  name="location1" id="location1" type="radio">
                                    <label for="location1">Nam</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" name="location1" id="location2" type="radio">
                                    <label for="location2">Nữ</label>                                     
                                </div>
                            </div>
                            <label>Môn học</label>
                            <div class="form-control">
                                <select id="monhoc" name="monhoc">
        							<option value="">Chọn môn học</option>
                                     <?php 
                                    if(!empty($monhoc)){
                                        foreach($monhoc as $n){ 
                                            
                                            ?>
                                            
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                            
                                            <?php }
                                        }
                                    ?> 
        						</select>
                            </div>
                            <label>Lớp hoặc chủ đề môn học <span>(Chọn lớp hoặc chủ đề giúp giáo viên tìm kiếm bạn dễ hơn)</span></label>
                            <div class="form-group">
                                <ul class="ultopic">
                                    
                                </ul>
                            </div>
                            <label>Dạy lớp</label>
                            <div class="form-control">
                                <select id="lop" class="checklophoc" name="lop" multiple="multiple">
                                   <option value="">Chọn lớp</option>
                                   <?php 
                                   if(!empty($lop)){
                                    foreach($lop as $n){ ?>
                                        <option value="<?php echo $n->id ?>"><?php echo $n->classname ?></option>
                                    <?php }
                                }
                                ?> 
                                </select>
                            </div>
                            <label>Số lượng học sinh</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập số lượng học sinh" id="txtsohocsinh" value="<?php echo $uclass->Student ?>" />
                            </div>
                            <label>Số giờ học 1 buổi</label>
                            <div class="form-inline durationtime"> 
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" checked="" value="1" id="duration1" ><label for="duration1">1h</label>
                                </div>                               
                          		<div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="1.5" id="duration2"><label for="duration2">1.5h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2" id="duration3" ><label for="duration3">2h</label>
                                </div>
                                <div class="form-group lblcheck">
                                    <input type="radio" name="duration" value="2.5" id="duration4"><label for="duration4">2.5h</label>
                                </div>    								        
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Hình thức học: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="" name="teachtype" id="teachtype" type="radio">
                                    <label for="teachtype">Gia sư tại nhà</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" name="teachtype" id="teachtype1" type="radio">
                                    <label for="teachtype1">Online trực tuyến</label>                                     
                                </div>
                                
                            </div>
                            <label>Học phí dự kiến</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập học phí dự kiến" id="txthocphi" />
                            </div>                            
                            <label>Điện thoại liên hệ</label>
                            <div class="form-control">
                                <input type="text" placeholder="Số điện thoại liên hệ" id="txtphone" maxlength="10"  />
                            </div>
                            <label>Tỉnh thành</label>
                            <div class="form-control">
                                <select id="txtcityclass" class="city_ab_tag">                        
                                <option data-tokens="0" value="">Tỉnh thành</option>
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
                            </div>
                            <div class="form-control">
                                <select id="txtquanhuyen" class="checkquanhuyen" name="txtquanhuyen" multiple="multiple">
                                   <option value="">Quận(huyện)</option>
                                </select>
                            </div>  
                            <label>Địa chỉ diễn ra lớp học</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập địa chỉ diễn ra lớp học" id="txtdiachilop" />
                            </div>
                            <label>Buổi có thể học <span>(Bấm để chọn những buổi bạn có thể học)</span></label>
                            <div class="detaijob-body2 lichday checklichday">
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 2
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                            <label class="" for="CMonMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                            <label class="" for="CMonAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                            <label class="" for="CMonNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div> 
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 3
                                 </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                            <label class="" for="CTueMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                            <label class="" for="CTueAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                            <label class="" for="CTueNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                 <div>Thứ 4
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                                            <label class="" for="CWeMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                                            <label class="" for="CWeAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                                            <label class="" for="CWeNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 5
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                                            <label class="" for="CThuMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                                            <label class="" for="CThuAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                                            <label class="" for="CThuNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 6
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                                            <label class="" for="CFriMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                                            <label class="" for="CFriAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                                            <label class="" for="CFriNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Thứ 7
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                                            <label class="" for="CSatMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                                            <label class="" for="CSatAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                                            <label class="" for="CSatNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                                    <div>Chủ nhật
                                    </div>
                                    <ul>
                                        <li>
                                            <input class="radio-calendar1" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                                            <label class="" for="CSunMorning">Sáng</label>                                        
                                        </li>
                                        <li>
                                            <input class="radio-calendar1"  id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                                            <label class="" for="CSunAfter">Chiều</label>
                                            
                                        </li>
                                        <li>
                                            <input class="radio-calendar1" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                                            <label class="" for="CSunNight">Tối</label>
                                        </li>
                                    </ul>
                                 </div>                                                                           
                            </div>
                            <div class="clearfix"></div>
                            <label>Mô tả chi tiết nội dung</label>
                            <div class="">
                                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"><?php echo $uclass->DescClass ?></textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="clearfix" style="height:30px;float:left;width:100%;"></div>
                <div class="col-md-12">
                    <div class="fun">
                        <span class="btn btn-primary btn-success" id="dangkytaikhoan">Hoàn tất</span>
                        <span class="btn btn-primary btn-warning" onclick="window.location='<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>'">Quay lại</span>
                    </div>
                </div>
                    <?php } ?>
                    
                </div> 
            </div>
        </div>
    </div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script>
    $(document).ready(function () {
        
        var self=this;
        var configulr='<?php echo base_url(); ?>';
        $('#lop').select2({ width: '100%',placeholder: 'Chọn lớp học sẽ dạy' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#txtquanhuyen').select2({ width: '100%',placeholder: 'Quận huyện' ,multiple: true, maximumSelectionLength: 1,minimumInputLength: 0 });
        $("#txthocphi").numeric();
        $('#txtsohocsinh').numeric();
        $('#txtusername').numeric();
        $('#txtteachtype').select2();
        $('#monhoc').select2();
        $('#txtcityclass').val('<?php echo $city; ?>').select2();
        // $('#txtquanhuyen').val('<?php echo $dis; ?>').select2({ width: '100%',placeholder: 'Quận huyện' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#monhoc').change(function () {
            var monhoc=$(this).val();
            if(monhoc != '' || monhoc !=0){
                    $.ajax(
              {
                  
                  url: configulr+"/site/AjaxchudeCheckbox",
                  type: "POST",
                  data: { idmon: monhoc },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (obj) {
                     
                     if(obj.kq != ''){
                        var reponse=obj.kq;
                        $(".ultopic li").remove();                        
                            $(".ultopic").append(obj.data);                           
                        
                        /*$(".ultopic").select2();*/
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
            });
         $('#dangkytaikhoan').on('click',function(){
            var tg=[];
            var sexteach=[];
            var lopday = $('#lop').val();
            var quanhuyen = $('#txtquanhuyen').val();
            if(typeof($('input[id=location1]:checked').val())!=='undefined'){
                sexteach.push($('input[id=location1]:checked').val());
            };
            if(typeof($('input[id=location2]:checked').val())!=='undefined'){
                sexteach.push($('input[id=location2]:checked').val());
            };
            var itemtopic=document.getElementsByClassName('radio-calendar');
            for(var i=0;i< itemtopic.length;i++){
                
              var valuethis=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').val();
               if (typeof (valuethis) !== "undefined") {
                tg.push(valuethis);
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
            var uc=0;
            if(typeof($('#txtid').val())!=='undefined'){
                uc=$('#txtid').val();
            };
            if(self.validatephuhuynh()){
            $.ajax(
              {
                  
                  url: configulr+"/site/ajaxuserupdateclass",
                  type: "POST",
                  data: { 
                    uc:uc,
                        hoten:$('#txthoten').val(),
                        password:$('#txtpass').val(),
                        username:$('#txtusername').val(),
                        topicarr:tg.join(),
                        classname:$('#txtclassname').val(),
                        teachertype:$('#txtteachtype').val(),
                        teachersex:sexteach.join(),
                        monhoc:$('#monhoc').val(),
                        lopday: lopday.join(),
                        tenmonhoc:$('#monhoc option:selected').text(),
                        studens:$('#txtsohocsinh').val(),
                        hours:$('input[name=duration]:checked').val(),
                        workid:$('input[name=teachtype]:checked').val(),
                        money:$('#txthocphi').val(),
                        email:$('#txtemail').val(),
                        phone:$('#txtphone').val(),
                        cityid:$('#txtcityclass').val(),
                        districtid: quanhuyen.join(),
                        cityname:$('#txtcityclass option:selected').text(),
                        address:$('#txtdiachilop').val(),
                        descclass:$('#chitietnoidung').val(),
                        sang2:sang2,
                        chieu2:chieu2,
                        toi2:toi2,
                        sang3:sang3,
                        chieu3:chieu3,
                        toi3:toi3,
                        sang4:sang4,
                        chieu4:chieu4,
                        toi4:toi4,
                        sang5:sang5,
                        chieu5:chieu5,
                        toi5:toi5,
                        sang6:sang6,
                        chieu6:chieu6,
                        toi6:toi6,
                        sang7:sang7,
                        chieu7:chieu7,
                        toi7:toi7,
                        sang8:sang8,
                        chieu8:chieu8,
                        toi8:toi8
                        },
                  dataType: 'json',
                  beforeSend: function () {
                      $("#boxLoading").show();
                  },
                  success: function (reponse) {
                      if (reponse.kq == true) {
                            alert(reponse.data);
                          window.location.href='<?php echo site_url('mn-hv-quan-ly-lop-hoc') ?>'
                      }
                      else {
                         alert('Cập nhật thất bại, bạn vui lòng kiểm tra lại');
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
        self.validatephuhuynh=function(){
             var flag = true;
              
            if ($.trim($('#txtclassname').val()) == '') {
                    $($('#txtclassname')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtclassname').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txtteachtype').val()) == '') {
                    $($('#select2-txtteachtype-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-txtteachtype-container').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#monhoc').val()) == '') {
                    $($('#select2-monhoc-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-monhoc-container').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txtsohocsinh').val()) == '') {
                    $($('#txtsohocsinh')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtsohocsinh').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txthocphi').val()) == '') {
                    $($('#txthocphi')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txthocphi').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#lop').val()) == '') {
                    $($('.select2-search__field')).addClass('errorClass');
                    flag = false;
                } else {
                    $('.select2-search__field').data("title", "").removeClass("errorClass");
                };

                
                var regex_phone =/((09|03|07|08|05)+([0-9]{8})\b)/g;
                if($('#txtphone').val() ==''){
                    if($('#txtphone').parent().hasClass('errorClass') == false){
                        $('#txtphone').parent().attr('title', 'Vui lòng nhập số điện thoại').tooltip('show').addClass('errorClass');                
                    } 
                    $('#txtphone').focus();
                }
                else
                {
                    var regex_sdt = /((09|03|07|08|05)+([0-9]{8})\b)/g;
                    if (regex_sdt.test($('#txtphone').val()) == false) 
                    {
                        $('#txtphone').parent().attr('title', 'Số điện thoại không phù hợp').tooltip('show').addClass('errorClass');
                        $('#txtphone').focus();
                    }
                    else
                    {
                        $('#txtphone').parent().removeClass("errorClass").tooltip("destroy");
                    }
                };
                if ($.trim($('#txtdiachilop').val()) == '') {
                    $($('#txtdiachilop')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#txtdiachilop').data("title", "").removeClass("errorClass");
                };
                if ($.trim($('#txtcityclass').val()) == '') {
                    alert('Tỉnh thành không được để trống ');
                    $($('#select2-txtcityclass-container')).addClass('errorClass');
                    flag = false;
                } else {
                    $('#select2-txtcityclass-container').data("title", "").removeClass("errorClass");
                };
                 if ($.trim($('#txtquanhuyen').val()) == '') {
                    $($('#select2-txtquanhuyen-container')).addClass('errorClass');
                    alert('Quận / huyện không được để trống')
                    flag = false;
                } else {
                    $('#select2-txtquanhuyen-container').data("title", "").removeClass("errorClass");
                };                
             return flag;
        }

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

        });
</script>
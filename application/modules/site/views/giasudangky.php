<?php
    $CI=&get_instance();
    $CI->load->model('site/site_model');
    $monhoc=$CI->site_model->ListSubject();
    $lop=$CI->site_model->ListClass();
    $quanhuyen=$CI->site_model->ListDistrict();
?>
<div class="container">
<?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row register padd-bot-40">
            <h1 class="title titleregister">Đăng ký làm gia sư</h1>
            <p style="text-align:center;">Bạn vui lòng điền đầy đủ và chính xác thông tin bên dưới</p>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="registerform">
                    <h3 class="col-md-12"><i class="fa fa-plus-circle"></i> Thông tin đăng nhập <span>Bạn đã có tài khoản? <a href="<?php echo base_url() ?>gia-su-dang-nhap">Đăng nhập</a></span></h3>
                    <div class="col-md-6">
                        <label>Email <span style="font-weight:300;font-size:13">(Email là tài khoản để bạn đăng nhập)</span> *</label>
                        <div class="form-control"><input autocomplete="off" type="text" placeholder="Vui lòng nhập email" id="txtemail"></div>
                    </div>                    
                    <div class="col-md-6">
                        <label>Họ tên đầy đủ *</label>
                        <div class="form-control"><input type="text" id="txthoten" placeholder="Vui lòng nhập họ tên"/></div>
                    </div>

                    <div class="col-md-6">
                        <label>Mật khẩu <span  style="font-weight:300;font-size:13">(Mật khẩu tối thiểu 6 ký tự)</span> *</label>
                        <div class="form-control"><input type="password" id="txtmatkhau" placeholder="Vui lòng nhập mật khẩu"/></div>
                    </div>
                    
                    <div class="col-md-6">
                        <label>Nhập lại mật khẩu *</label>
                        <div class="form-control"><input type="password" id="txtrepass" placeholder="Vui lòng nhập lại mật khẩu"/></div>
                    </div>
                </div>
            </div>        
        </div>
        <div class="row padd-top-20 padd-bot-20">
            <div class="col-md-10 col-md-offset-1">
                <div class="col-md-12 col-sm-12 divyeucau phuhuynhyc">
                    <div class="row">
                        <div class="col-md-12 batbuoc">
                            <h4><i class="fa fa-plus-circle"></i> Thông tin cá nhân</h4>
                            <div>(<span>*</span>) Thông tin bắt buộc nhập</div>
                        </div>
                    </div>
                    <form onsubmit="return false" enctype="multipart/form-data">
                        <div class="col-md-10 col-md-offset-1">
                            <label class="required">Số điện thoại </label>
                            <div class="form-control">
                                <input type="text" id="txtphone" placeholder="Vui lòng nhập số điện thoại của bạn" maxlength="10"/>
                            </div>
                            <label class="required">Ảnh đại diện</label>
                            <div class="form-control">
                                <input accept="image/x-png,image/gif,image/jpeg" type="file" name="danhdaidien" id="danhdaidien" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                <label for="danhdaidien"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                            </div>
                            <label class="required">Ảnh CMND, thẻ sinh viên hoặc bằng cấp chuyên môn cao nhất <span>(để tăng sự tin tưởng của học viên với bạn)</span></label>
                            <div class="form-control">
                                <input accept="image/x-png,image/gif,image/jpeg" type="file" name="anhcmnd" id="anhcmnd" class="inputfile inputfile-6" data-multiple-caption="{count} files selected" multiple />
                                <label for="anhcmnd"><strong> Chọn tệp</strong> <span>không có file nào được chọn</span></label>
                            </div>
                            <label class="required">Ngày tháng năm sinh</label>
                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                                <input type='text' placeholder="Ngày sinh (01-10-1997)" id="txtngaysinh" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                </span>
                            </div>
                            <div class="form-inline">
                                <label style="margin-right:30px;">Giới tính: </label>
                                <div class="form-group lblcheck">
                                    <input value="1" checked="checked" name="location1" id="location1" type="radio">
                                    <label for="location1">Nam</label>                                     
                                </div>
                                <div class="form-group lblcheck">
                                    <input value="2" name="location1" id="location2" type="radio">
                                    <label for="location2">Nữ</label>                                     
                                </div>
                            </div>
                            <label class="required">Nơi ở hiện tại</label>
                            <div class="form-control">
                                <input type="text" placeholder="Vui lòng nhập chi tiết nơi ở hiện tại" id="txtnoiohientai">
                            </div>
                            <label class="required">Hiện tại là</label>
                            <div class="form-control">
                                <select id="txtteachtype" name="txtteachertype">
                                    <option value="">Hiện tại là</option>
                                    <?php
                                    if(!empty($lstitem)){
                                        foreach($lstitem as $n){ ?>
                                            <option value="<?php echo $n->ID ?>"><?php echo $n->NameType ?></option>            
                                        <?php }
                                    } 
                                    ?>
                                </select>
                            </div>
                            <label class="required">Học trường</label>
                            <div class="form-control">
                                <input type="text" placeholder="Nhập trường học của bạn" id="txtschool">
                            </div>
                            <label class="required">Chuyên ngành</label>
                            <div class="form-control">
                                <input type="text" placeholder="Chuyên ngành học" id="txtmajor">
                            </div>
                            <label class="required">Năm tốt nghiệp</label>
                            <div class="form-control">
                                <input type="text" placeholder="Năm tốt nghiệp" id="txtGraduationyear">
                            </div>
                            <label>Nơi công tác <span>(nếu đã đi làm)</span></label>
                            <div class="form-control">
                                <input type="text" placeholder="Nơi công tác" id="txtworkplace">
                            </div>
                            <div class="clearfix"></div>
                            <label class="required">Giới thiệu về bản thân</label>
                            <div class="">
                                <textarea id="infouser" name="infouser" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                            <label class="required">Kinh nghiệm đi dạy</label>
                            <div class="">
                                <textarea id="kinhnghiem" name="kinhnghiem" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                            <label>Thành tích</label>
                            <div class="">
                                <textarea id="thanhtich" name="thanhtich" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h4><i class="fa fa-plus-circle"></i> Thông tin gia sư</h4>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <label class="required">Môn học sẽ dạy</label>
                            <div class="form-control">
                                <select id="monhoc" class="checkmonhoc" name="monhoc" multiple="multiple">
                                   <option value="">Chọn môn học</option>
                                   <?php 
                                   if(!empty($monhoc)){
                                    foreach($monhoc as $n){ ?>
                                        <option value="<?php echo $n->ID ?>"><?php echo $n->SubjectName ?></option>
                                    <?php }
                                }
                                ?> 
                            </select>
                            </div>

                
                            <label class="required">Lớp học sẽ dạy</label>
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
                        <div id="grouptopic">
                            <div id="group-topic0">
                                <label>Chủ đề môn học <span>(Chọn chủ đề giúp phụ huynh tìm kiếm bạn dễ hơn)</span></label>
                                <div class="form-group">
                                    <ul class="ultopic">
                                        <li>
                                            <input class="radio-calendar" id="morning-calendar-2" type="checkbox" name="sang_2" value="sang_2">
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
                        </div>
                        <label class="required">Khu vực dạy</label>
                        <div class="form-control">
                            <select id="txtcityclass" class="city_ab_tag">
                                <option data-tokens="0" value="0">Tỉnh/Thành phố</option>
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
                        <div class="form-inline">
                            <label class="required" style="margin-right:30px;" class="required">Hình thức dạy: </label>
                            <div class="form-group lblcheck">
                                <input value="1" checked="checked" name="teachtype" id="teachtype" type="radio">
                                <label for="teachtype">Gia sư tại nhà</label>                                     
                            </div>
                            <div class="form-group lblcheck">
                                <input value="2" name="teachtype" id="teachtype1" type="radio">
                                <label for="teachtype1">Online trực tuyến</label>                                     
                            </div>                                
                        </div>
                        <label class="required">Học phí dự kiến<span>(vnđ/h)</span></label>
                        <div class="form-control">
                            <input type="text" placeholder="Nhập học phí dự kiến" id="txthocphi" name="txthocphi">
                        </div>
                        <label class="required">Buổi có thể dạy <span>(Bấm để chọn những buổi bạn có thể dạy)</span></label>
                        <div class="detaijob-body2 lichday checklichday" id = "lichday" name = "lichday">
                         <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                            <div>Thứ 2
                            </div>
                            <ul>
                                <li>
                                    <input class="radio-calendar2" id="CMonMorning" type="checkbox" name="CMonMorning" value="1">
                                    <label class="" for="CMonMorning">Sáng</label>                                        
                                </li>
                                <li>
                                    <input class="radio-calendar2" id="CMonAfter" type="checkbox" name="CMonAfter" value="1">
                                    <label class="" for="CMonAfter">Chiều</label>

                                </li>
                                <li>
                                    <input class="radio-calendar2" id="CMonNight" type="checkbox" name="CMonNight" value="1">
                                    <label class="" for="CMonNight">Tối</label>
                                </li>
                            </ul>
                        </div> 
                        <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                         <div>Thứ 3
                         </div>
                         <ul>
                            <li>
                                <input class="radio-calendar2" id="CTueMorning" type="checkbox" name="CTueMorning" value="1">
                                <label class="" for="CTueMorning">Sáng</label>                                        
                            </li>
                            <li>
                                <input class="radio-calendar2" id="CTueAfter" type="checkbox" name="CTueAfter" value="1">
                                <label class="" for="CTueAfter">Chiều</label>

                            </li>
                            <li>
                                <input class="radio-calendar2" id="CTueNight" type="checkbox" name="CTueNight" value="1">
                                <label class="" for="CTueNight">Tối</label>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                     <div>Thứ 4
                     </div>
                     <ul>
                        <li>
                            <input class="radio-calendar2" id="CWeMorning" type="checkbox" name="CWeMorning" value="1">
                            <label class="" for="CWeMorning">Sáng</label>                                        
                        </li>
                        <li>
                            <input class="radio-calendar2" id="CWeAfter" type="checkbox" name="CWeAfter" value="1">
                            <label class="" for="CWeAfter">Chiều</label>

                        </li>
                        <li>
                            <input class="radio-calendar2" id="CWeNight" type="checkbox" name="CWeNight" value="1">
                            <label class="" for="CWeNight">Tối</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                    <div>Thứ 5
                    </div>
                    <ul>
                        <li>
                            <input class="radio-calendar2" id="CThuMorning" type="checkbox" name="CThuMorning" value="1">
                            <label class="" for="CThuMorning">Sáng</label>                                        
                        </li>
                        <li>
                            <input class="radio-calendar2" id="CThuAfter" type="checkbox" name="CThuAfter" value="1">
                            <label class="" for="CThuAfter">Chiều</label>

                        </li>
                        <li>
                            <input class="radio-calendar2" id="CThuNight" type="checkbox" name="CThuNight" value="1">
                            <label class="" for="CThuNight">Tối</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                    <div>Thứ 6
                    </div>
                    <ul>
                        <li>
                            <input class="radio-calendar2" id="CFriMorning" type="checkbox" name="CFriMorning" value="1">
                            <label class="" for="CFriMorning">Sáng</label>                                        
                        </li>
                        <li>
                            <input class="radio-calendar2" id="CFriAfter" type="checkbox" name="CFriAfter" value="1">
                            <label class="" for="CFriAfter">Chiều</label>

                        </li>
                        <li>
                            <input class="radio-calendar2" id="CFriNight" type="checkbox" name="CFriNight" value="1">
                            <label class="" for="CFriNight">Tối</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                    <div>Thứ 7
                    </div>
                    <ul>
                        <li>
                            <input class="radio-calendar2" id="CSatMorning" type="checkbox" name="CSatMorning" value="1">
                            <label class="" for="CSatMorning">Sáng</label>                                        
                        </li>
                        <li>
                            <input class="radio-calendar2" id="CSatAfter" type="checkbox" name="CSatAfter" value="1">
                            <label class="" for="CSatAfter">Chiều</label>

                        </li>
                        <li>
                            <input class="radio-calendar2" id="CSatNight" type="checkbox" name="CSatNight" value="1">
                            <label class="" for="CSatNight">Tối</label>
                        </li>
                    </ul>
                </div>
                <div class="col-md-15 col-sm-12 padd-l-5 padd-r-5">
                    <div>Chủ nhật
                    </div>
                    <ul>
                        <li>
                            <input class="radio-calendar2" id="CSunMorning" type="checkbox" name="CSunMorning" value="1">
                            <label class="" for="CSunMorning">Sáng</label>                                        
                        </li>
                        <li>
                            <input class="radio-calendar2" id="CSunAfter" type="checkbox" name="CSunAfter" value="1">
                            <label class="" for="CSunAfter">Chiều</label>

                        </li>
                        <li>
                            <input class="radio-calendar2" id="CSunNight" type="checkbox" name="CSunNight" value="1">
                            <label class="" for="CSunNight">Tối</label>
                        </li>
                    </ul>
                </div>                                                                           
            </div>
            <div class="clearfix"></div>
            <label>Thông tin khác</label>
            <div class="">
                <textarea id="chitietnoidung" name="chitietnoidung" placeholder="Chi tiết nội dung" rows="5" cols="30"></textarea>
            </div>
        </div>
    </form>
</div>
</div>


</div>
<div class="col-md-12 captchavalue" style="overflow: hidden;">
    <div class="form-group lblcheck">
        <input type="checkbox" id="dongydieukhoan" /><label for="dongydieukhoan">
         Tôi cam kết thông tin đăng ký làm gia sư là thật. Tôi chấp nhận các quy định của Giasu365.
     </label>
 </div>
</div>
<div class="col-md-12">
    <div class="fun">
        <span class="btn btn-primary btn-success" id="dangkygiaovien">Hoàn tất</span>
        <span class="btn btn-primary btn-warning">Làm lại</span>
    </div>
</div>

</div>
</section>
<!---->
<div id="mymodalregistersuccess" class="modal fade top" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title title titlesuccess"><img src="images/icon-tick.png" alt="tick" />Tìm kiếm nâng cao</h4>
    </div>
    <div class="modal-body">
        <div class="col-md-12 col-sm-12">
           <p><span id="txttenthongbao">Xin chào: <b>Quang Anh</b></span></p>  
           <p>Bạn đã đăng ký tài khoản thành công. Ngay bây giờ bạn có thể sử dụng dịch vụ của giasu365</p>    
       </div>
   </div>      
</div>
</div>
</div>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script src="js/moment.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<script>
    $(document).ready(function () 
    {
        $('#datetimepicker1').datetimepicker({
            locale: 'vi',
            format: 'DD-MM-YYYY'
        });

        $('#txtphone').numeric();
        $("#txthocphi").numeric();
        $('#txtteachtype').select2();
        $('#monhoc').select2({ width: '100%',placeholder: 'Chọn môn học sẽ dạy' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#lop').select2({ width: '100%',placeholder: 'Chọn lớp học sẽ dạy' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        $('#txtcityclass').select2();
        $('#txtquanhuyen').select2({ width: '100%',placeholder: 'Khu vực bạn có thể dạy (Tối đa 3 Quận/Huyện) ' ,multiple: true, maximumSelectionLength: 3,minimumInputLength: 0 });
        var configulr='<?php echo site_url(); ?>';
        $('#dangkygiaovien').on('click',function()
        {
            if(validategiasu() && typeof($('input[id=dongydieukhoan]:checked').val())!=='undefined')
            {
                var tg=[];
                var sexteach=[];
                if(typeof($('input[id=location1]:checked').val())!=='undefined')
                {
                    sexteach.push($('input[id=location1]:checked').val());
                };
                if(typeof($('input[id=location2]:checked').val())!=='undefined')
                {
                    sexteach.push($('input[id=location2]:checked').val());
                };
                var itemtopic=document.getElementsByClassName('radio-calendar');
                for(var i=0;i< itemtopic.length;i++)
                {
                    var valuethis=  $('input[id='+$(itemtopic[i]).attr('id')+']:checked').val();
                    if (typeof (valuethis) !== "undefined") 
                    {
                        tg.push(valuethis);
                    }
                };
                var sang2=0;
                if(typeof($('input[name=CMonMorning]:checked').val())!=='undefined')
                {
                    sang2=$('input[name=CMonMorning]:checked').val();
                };
                var chieu2=0;
                if(typeof($('input[name=CMonAfter]:checked').val())!=='undefined')
                {
                    chieu2=$('input[name=CMonAfter]:checked').val();
                };
                var toi2=0;
                if(typeof($('input[name=CMonNight]:checked').val())!=='undefined')
                {
                    toi2=$('input[name=CMonNight]:checked').val();
                };
                var sang3=0;
                if(typeof($('input[name=CTueMorning]:checked').val())!=='undefined')
                {
                    sang3=$('input[name=CTueMorning]:checked').val();
                };
                var chieu3=0;
                if(typeof($('input[name=CTueAfter]:checked').val())!=='undefined')
                {
                    chieu3=$('input[name=CTueAfter]:checked').val();
                };
                var toi3=0;
                if(typeof($('input[name=CTueNight]:checked').val())!=='undefined')
                {
                    toi3=$('input[name=CTueNight]:checked').val();
                };
                var sang4=0;
                if(typeof($('input[name=CWeMorning]:checked').val())!=='undefined')
                {
                    sang4=$('input[name=CWeMorning]:checked').val();
                };
                var chieu4=0;
                if(typeof($('input[name=CWeAfter]:checked').val())!=='undefined')
                {
                    chieu4=$('input[name=CWeAfter]:checked').val();
                };
                var toi4=0;
                if(typeof($('input[name=CWeNight]:checked').val())!=='undefined')
                {
                    toi4=$('input[name=CWeNight]:checked').val();
                };
                var sang5=0;
                if(typeof($('input[name=CThuMorning]:checked').val())!=='undefined')
                {
                    sang5=$('input[name=CThuMorning]:checked').val();
                };
                var chieu5=0;
                if(typeof($('input[name=CThuAfter]:checked').val())!=='undefined')
                {
                    chieu5=$('input[name=CThuAfter]:checked').val();
                };
                var toi5=0;
                if(typeof($('input[name=CThuNight]:checked').val())!=='undefined')
                {
                    toi5=$('input[name=CThuNight]:checked').val();
                };
                var sang6=0;
                if(typeof($('input[name=CFriMorning]:checked').val())!=='undefined')
                {
                    sang6=$('input[name=CFriMorning]:checked').val();
                };
                var chieu6=0;
                if(typeof($('input[name=CFriAfter]:checked').val())!=='undefined')
                {
                    chieu6=$('input[name=CFriAfter]:checked').val();
                };
                var toi6=0;
                if(typeof($('input[name=CFriNight]:checked').val())!=='undefined')
                {
                    toi6=$('input[name=CFriNight]:checked').val();
                };
                var sang7=0;
                if(typeof($('input[name=CSatMorning]:checked').val())!=='undefined')
                {
                    sang7=$('input[name=CSatMorning]:checked').val();
                };
                var chieu7=0;
                if(typeof($('input[name=CSatAfter]:checked').val())!=='undefined')
                {
                    chieu7=$('input[name=CSatAfter]:checked').val();
                };
                var toi7=0;
                if(typeof($('input[name=CSatNight]:checked').val())!=='undefined')
                {
                    toi7=$('input[name=CSatNight]:checked').val();
                };
                var sang8=0;
                if(typeof($('input[name=CSunMorning]:checked').val())!=='undefined')
                {
                    sang8=$('input[name=CSunMorning]:checked').val();
                };
                var chieu8=0;
                if(typeof($('input[name=CSunAfter]:checked').val())!=='undefined')
                {
                    chieu8=$('input[name=CSunAfter]:checked').val();
                };
                var toi8=0;
                if(typeof($('input[name=CSunNight]:checked').val())!=='undefined')
                {
                    toi8=$('input[name=CSunNight]:checked').val();
                };
                
                
                var arrmonhoc=$('#monhoc').val();
                var arrlopday = $('#lop').val();
                var arrquanhuyen=$('#txtquanhuyen').val();
                var file_data = $('#danhdaidien')[0].files[0];
                var filecmnd=$('#anhcmnd')[0].files[0];
                

                data = new FormData();
                data.append('hoten',$('#txthoten').val());
                data.append('sdt',$('#txtphone').val());
                data.append('password',$('#txtmatkhau').val());
                data.append('emailuser', $('#txtemail').val());
                data.append('ngaysinh', $('#txtngaysinh').val());
                data.append('gioitinh', sexteach[0]);
                data.append('noiohientai', $('#txtnoiohientai').val());
                data.append('hientaila', $('#txtteachtype').val());
                data.append('hoctruong', $('#txtschool').val());
                data.append('chuyennganh', $('#txtmajor').val());
                data.append('namtotnghiep', $('#txtGraduationyear').val());
                if($('#txtworkplace').val()=='')
                {
                    var noicongtac = ''; 
                }
                else
                {
                    var noicongtac = $('#txtworkplace').val();
                }
                data.append('noicongtac', noicongtac);
                data.append('gioithieubanthan', $('#infouser').val());
                data.append('kinhnghiem', $('#kinhnghiem').val());
                if($('#thanhtich').val()=='')
                {
                    var thanhtich = ''; 
                }
                else
                {
                    var thanhtich = $('#thanhtich').val();
                }
                data.append('thanhtich', thanhtich);
                
                
                
                data.append('monhoc', arrmonhoc.join());
                data.append('lopday', arrlopday.join());
                data.append('quanhuyen', arrquanhuyen.join());
                
                
                //data.append('chudemonhoc', tg.join());
                if(tg != null)
                {
                    data.append('chudemonhoc', tg.join());
                }
                else
                {
                   data.append('chudemonhoc', ""); 
                }
                // data.append('lop', $("#lop").val());
                data.append('khuvucday', $('#txtcityclass').val());
                data.append('tenkhuvucday', $('#txtcityclass option:selected').text());
                data.append('quanhuyen', arrquanhuyen.join());

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
                if($('#chitietnoidung').val()=='')
                {
                    var chitietnoidung = '';
                }
                else
                {
                   var chitietnoidung = $('#chitietnoidung').val();
                }
                data.append('chitietnoidung', chitietnoidung);
                data.append('imageuser', file_data);
                data.append('cmnduser', filecmnd);

                $.ajax({
                    url: configulr+"site/ajaxteacherregistersuccess",
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: data,
                    dataType: 'json',
                    enctype: 'multipart/form-data',
                    beforeSend: function () 
                    {
                        $("#boxLoading").show();
                    },
                    success: function (reponse) 
                    {
                        if (reponse.kq == true) 
                        {
                            alert('Bạn đã đăng ký tài khoản thành công. Vui lòng kiểm tra tin email để nhận mã xác thực kích hoạt tài khoản');
                            var urlredirect=configulr;
                            window.location.href=urlredirect;
                        }
                        else 
                        {
                            alert('Đăng ký tài khoản không thành công. Vui lòng kiểm tra lại.');
                        }
                    },
                    error: function (xhr) 
                    {
                        console.log(xhr);
                    },
                    complete: function () 
                    {
                        $("#boxLoading").hide();
                    }
                }); 
            }
        });

        $('#monhoc').change(function () 
        {
            var monhoc=$(this).val();
            /*monhoc=monhoc1.split(',');*/
            if(monhoc.length > 0){
                $('#grouptopic div#group-topic0').remove();
                for(var i=0; i<monhoc.length; i++) {
                    if(typeof($('#group-topic'+monhoc[i]).attr('data-val'))==='undefined'){
                        var strhtml="<div id='group-topic"+monhoc[i]+"' data-val='"+monhoc[i]+"'>";

                        strhtml+="<label>Lớp hoặc chủ đề môn học <span>("+$(this).find('option[value="' + monhoc[i] + '"]').text()+")</span></label>";
                        $.ajax({
                            url: configulr+"site/AjaxchudeCheckbox",
                            type: "POST",
                            data: { idmon: monhoc[i] },
                            dataType: 'json',
                            beforeSend: function () 
                            {
                                $("#boxLoading").show();
                            },
                            success: function (obj) 
                            {
                                if(obj.kq != '')
                                {
                                    if(obj.id == monhoc)
                                    {
                                        var reponse=obj.kq;
                                        strhtml+="<div class='form-group'><ul class='ultopic'>";
                                        strhtml+=obj.data;
                                        strhtml+="</ul></div>";
                                        strhtml+="</div>";
                                        $('#grouptopic').append(strhtml);
                                    }
                                    for(var j=1; j<29; j++){
                                         if('#group-topic'+obj.id != '#group-topic'+j)
                                        {
                                            $('#group-topic'+j).remove();
                                        }
                                    }
                                }
                                else
                                {
                                    alert('không được để trống môn học');
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
                } 
            }
            
        });


        function validategiasu()
        {
            var btndangky = true;
            var hoten = $('#txthoten').val();
            var pass = $("#txtmatkhau").val();
            var repass = $("#txtrepass").val();
            var regex_sdt = /^[0-9]{9,16}$/;


            if ($.trim($('#txtemail').val()) == '') 
            {
               $('#txtemail').parent().addClass('errorClass');
               $('#txtemail').focus();
               return false;
            } 
            else 
            {
                $.ajax({
                    url: configulr+"site/check_mail",
                    type: "POST",
                    data: { type: 1, data: $('#txtemail').val() },
                    dataType: 'json',
                    beforeSend: function () 
                    {
                        $("#boxLoading").show();
                    },
                    success: function (obj) 
                    {
                        if(obj == 1)
                        {
                            $('#txtemail').tooltip('hide').attr('title', 'Email đã được đăng ký vui lòng chọn email khác').tooltip('show');
                            $('#txtemail').parent().addClass('errorClass');
                            $('#txtemail').focus();
                            return false;
                        }
                        else
                        {
                            $('#txtemail').data("title", "");
                            $('#txtemail').parent().removeClass("errorClass");
                        }
                    },
                    error: function (xhr) 
                    {
                        alert("error");
                    },
                    complete: function () 
                    {
                        $("#boxLoading").hide();
                    }
                });      
            };

            if ($.trim(hoten) == '') 
            {
                $('#txthoten').parent().addClass('errorClass');
                $('#txthoten').focus();
                return false;
            } 
            else 
            {
                $('#txthoten').data("title", "").removeClass("errorClass");
            };

            if ($.trim($('#txtmatkhau').val()) == '') 
            {
                $('#txtmatkhau').parent().addClass('errorClass');
                $('#txtmatkhau').focus();
                return false;
            } 
            else 
            {
                $('#txtmatkhau').data("title", "");
                $('#txtmatkhau').parent().removeClass("errorClass");
            };

            if (checkPassword(pass, $('#txtmatkhau')) == 1) 
            {
                return false;
            };

            if ($.trim($('#txtrepass').val()) == '') 
            {
                $('#txtrepass').parent().addClass('errorClass');
                $('#txtrepass').focus();
                return false;
            } 
            else 
            {
                $('#txtrepass').data("title", "");
                $('#txtrepass').parent().removeClass("errorClass");
            };   

            // if (checkPassword(repass, $('#txtrepass')) == 1) 
            // {
            //     return false;
            // };

            if (checkPassword(pass, $('#txtrepass')) == 0 && pass != repass) 
            {
                $('#txtrepass').tooltip('hide').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show');
                $('#txtrepass').parent().addClass("errorClass");
                $('#txtrepass').focus();
                return false;
            };

            if ($.trim($('#txtphone').val()) == '') 
            {
                $('#txtphone').parent().addClass('errorClass');
                $('#txtphone').focus();
                return false;
            } 
            else 
            {
                if (regex_sdt.test($('#txtphone').val()) == false) 
                {
                    $('#sdt').attr('title', 'Số điện thoại không phù hợp').tooltip('show').addClass('errorClass');
                    $('#txtsdt').focus();
                    return false;
                }
                else
                {
                    $.ajax({
                        url: configulr+"site/check_sdt",
                        type: "POST",
                        data: { type: 1, data: $('#txtphone').val() },
                        dataType: 'json',
                        beforeSend: function () 
                        {
                            $("#boxLoading").show();
                        },
                        success: function (obj) 
                        {
                            if(obj == 1){
                                $($('#txtphone')).tooltip('hide').attr('title', 'Số điện thoại đã đăng ký vui lòng chọn số khác').tooltip('show');
                                $('#txtphone').parent().addClass('errorClass');
                                $('#txtphone').focus();
                                return false;
                            }
                            else
                            {
                                $('#txtphone').data("title", "");
                                $('#txtphone').removeClass("errorClass");
                            }
                        },
                        error: function (xhr) 
                        {
                            alert("error");
                        },
                        complete: function () 
                        {
                            $("#boxLoading").hide();
                        }
                    });
                }        
            };

            if ($.trim($('#danhdaidien').val()) == '') {
                $('#danhdaidien + label').parent().addClass('errorClass');
                $('#danhdaidien').focus();
                return false;
            } 
            else 
            {
                $('#danhdaidien + label').parent().removeClass('errorClass');
            };

            if ($.trim($('#anhcmnd').val()) == '') {
                 $('#anhcmnd + label').parent().addClass('errorClass');
                 $('#anhcmnd').focus();
                 return false;
            } 
            else 
            {
                $('#anhcmnd + label').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtngaysinh').val()) == '') {
               $('#txtngaysinh').parent().addClass('errorClass');
               $('#txtngaysinh').focus();
                return false;
            } 
            else 
            {
               $('#txtngaysinh').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtnoiohientai').val()) == '')
            {
               $('#txtnoiohientai').parent().addClass('errorClass');
               $('#txtnoiohientai').focus();
                return false;
            } 
            else 
            {
               $('#txtnoiohientai').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtteachtype').val()) == '') 
            {
               $('#txtteachtype').parent().addClass('errorClass');
               $('#txtteachtype').first().focus();
                return false;
            } 
            else 
            {
               $('#txtteachtype').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtschool').val()) == '') {
               $('#txtschool').parent().addClass('errorClass');
               $('#txtschool').focus();
                return false;
            } 
            else 
            {
               $('#txtschool').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtmajor').val()) == '') 
            {
               $('#txtmajor').parent().addClass('errorClass');
               $('#txtmajor').focus();
                return false;
            } 
            else 
            {
               $('#txtmajor').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtGraduationyear').val()) == '') {
               $('#txtGraduationyear').parent().addClass('errorClass');
               $('#txtGraduationyear').focus();
                return false;
            } 
            else 
            {
               $('#txtGraduationyear').parent().removeClass('errorClass');
            };

            // if ($.trim($('#txtworkplace').val()) == '') {
            //    $('#txtworkplace').parent().addClass('errorClass');
            //    flag = false;
            // } 
            // else 
            // {
            //    $('#txtworkplace').parent().removeClass('errorClass');
            // };

            if ($.trim($('#kinhnghiem').val()) == '') 
            {
               $('#kinhnghiem').addClass('errorClass');
               $('#kinhnghiem').focus();
                return false;
            } 
            else 
            {
               $('#kinhnghiem').removeClass('errorClass');
            };

            // if ($.trim($('#thanhtich').val()) == '') 
            // {
            //    $('#thanhtich').addClass('errorClass');
            //    flag = false;
            // } 
            // else 
            // {
            //    $('#thanhtich').removeClass('errorClass');
            // };

            if ($.trim($('#infouser').val()) == '') 
            {
               $('#infouser').addClass('errorClass');
               return false;
            } 
            else 
            {
               $('#infouser').parent().removeClass('errorClass');
            };

            if ($.trim($('#monhoc').val()) == '') 
            {
               $('#monhoc').parent().addClass('errorClass');
               $('#monhoc').focus();
                return false;
            } 
            else 
            {
               $('#monhoc').parent().removeClass('errorClass');
            };

            if ($.trim($('#lop').val()) == '') 
            {
               $('#lop').parent().addClass('errorClass');
               $('#lop').focus();
                return false;
            } 
            else 
            {
               $('#lop').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtcityclass').val()) == '' || $('#txtcityclass').val() ==0) {
               $('#txtcityclass').parent().addClass('errorClass');
                $('#txtcityclass').focus();
                return false;
            } 
            else 
            {
               $('#txtcityclass').parent().removeClass('errorClass');
            };

            if ($.trim($('#txtquanhuyen').val()) == '' || $('#txtquanhuyen').val() ==0) {
               $('#txtquanhuyen').parent().addClass('errorClass');
                $('#txtquanhuyen').focus();

                return false;
            } 
            else 
            {
               $('#txtquanhuyen').parent().removeClass('errorClass');
            };

            if ($.trim($('#txthocphi').val()) == '') {
               $('#txthocphi').parent().addClass('errorClass');
               $('#txthocphi').focus();
                return false;
            } 
            else 
            {
               $('#txthocphi').parent().removeClass('errorClass');
            };
            // if ($.trim($('#chitietnoidung').val()) == '') {
            //  $('#chitietnoidung').addClass('errorClass');
            //  flag = false;
            // } else {
            //  $('#chitietnoidung').removeClass('errorClass');
            // }; 


            //  if ($.trim($('#lichday').val()) == '') {
            //    $('#lichday').addClass('errorClass');
            //     $('#lichday').first().focus();
            //     return false;
            // } 
            // else 
            // {
            //    $('#lichday').removeClass('errorClass');
            // }; 
            return btndangky;     
        };
        function checkPassword(pwd, element) 
        {
            var Hoa = 0;
            var Thuong = 0;
            var So = 0;
            if (pwd.length < 6) {
                $(element).tooltip('hide').attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show');
                $(element).parent().addClass('errorClass');
                $(element).focus();
                return 1;
            }
            $(element).data("title", "").tooltip("hide");
            $(element).parent().removeClass('errorClass');

            return 0;
        };

        $('#txtemail').keyup(function(){
        //Nhap ban phim
            if($('#txtemail').val().length == 0)
            {
                if($('#txtemail').parent().hasClass('errorClass') == false)
                {
                    $('#txtemail').parent().attr('title', 'Vui lòng nhập email.').tooltip('show').addClass('errorClass');
                }
                $('#txtemail').focus();

            }
            else
            {
                $('#txtemail').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtemail').blur(function(){
            var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#txtemail').val() ==''){
                if($('#txtemail').parent().hasClass('errorClass') == false){
                    $('#txtemail').parent().attr('title', 'Vui lòng nhập email.').tooltip('show').addClass('errorClass');                
                } 
                $('#txtemail').focus();
            }
            else
            {
                if (regex_email.test($('#txtemail').val()) == false)
                {
                    $('#txtemail').parent().attr('title', 'Email không phù hợp').tooltip('show').addClass('errorClass');
                    $('#txtemail').focus();
                }
                else if(regex_email.test($('#txtemail').val()) == true)
                {
                    $.ajax({
                    url: configulr+"site/check_mail",
                    type: "POST",
                    data: { type: 1, data: $('#txtemail').val() },
                    dataType: 'json',
                    beforeSend: function () 
                    {
                        $("#boxLoading").show();
                    },
                    success: function (obj) 
                    {
                        if(obj == 1)
                        {
                            $('#txtemail').tooltip('hide').attr('title', 'Email đã được đăng ký vui lòng chọn email khác').tooltip('show');
                            $('#txtemail').parent().addClass('errorClass');
                            $('#txtemail').focus();
                            return false;
                        }
                        else
                        {
                            $('#txtemail').data("title", "");
                            $('#txtemail').parent().removeClass("errorClass");
                        }
                    },
                    error: function (xhr) 
                    {
                        alert("error");
                    },
                    complete: function () 
                    {
                        $("#boxLoading").hide();
                    }
                }); 
                }
                else
                {
                     $('#txtemail').parent().removeClass("errorClass").tooltip("destroy");
                }

            }   
        });

        $('#txthoten').keyup(function(){
        //Nhap ban phim
            if($('#txthoten').val().length == 0)
            {
                if($('#txthoten').parent().hasClass('errorClass') == false)
                {
                    $('#txthoten').parent().attr('title', 'Vui lòng nhập họ tên.').tooltip('show').addClass('errorClass');
                }
                $('#txthoten').focus();

            }
            else
            {
                $('#txthoten').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txthoten').blur(function(){
            if($('#txthoten').val() ==''){
                if($('#txthoten').parent().hasClass('errorClass') == false){
                    $('#txthoten').parent().attr('title', 'Vui lòng nhập họ tên.').tooltip('show').addClass('errorClass');                
                } 
                $('#txthoten').focus();
            }
            else
            {
                $('#txthoten').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#txtmatkhau').keyup(function(){
        //Nhap ban phim
            if($('#txtmatkhau').val().length == 0)
            {
                if($('#txtmatkhau').parent().hasClass('errorClass') == false)
                {
                    $('#txtmatkhau').parent().attr('title', 'Vui lòng nhập mật khẩu.').tooltip('show').addClass('errorClass');
                }
                $('#txtmatkhau').focus();

            }
            else
            {
                $('#txtmatkhau').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtmatkhau').blur(function(){
            if($('#txtmatkhau').val() ==''){
                if($('#txtmatkhau').parent().hasClass('errorClass') == false){
                    $('#txtmatkhau').parent().attr('title', 'Vui lòng nhập mật khẩu.').tooltip('show').addClass('errorClass');                
                } 
                $('#txtmatkhau').focus();
            }
            else
            {
                if ($('#txtmatkhau').val().length <6) 
                {
                    $('#txtmatkhau').parent().attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
                    $('#txtmatkhau').focus();
                }
                else
                {
                    $('#txtmatkhau').parent().removeClass("errorClass").tooltip("destroy");
                }
            }   
        });

        $('#txtrepass').keyup(function(){
        //Nhap ban phim
            if($('#txtrepass').val().length == 0)
            {
                if($('#txtrepass').parent().hasClass('errorClass') == false)
                {
                    $('#txtrepass').parent().attr('title', 'Vui lòng nhập mật khẩu.').tooltip('show').addClass('errorClass');
                }
                $('#txtrepass').focus();

            }
            else
            {
                $('#txtrepass').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtrepass').blur(function(){
            if($('#txtrepass').val() ==''){
                if($('#txtrepass').parent().hasClass('errorClass') == false){
                    $('#txtrepass').parent().attr('title', 'Vui lòng nhập mật khẩu.').tooltip('show').addClass('errorClass');                
                } 
                $('#txtrepass').focus();
            }
            else
            {
                if($('#txtmatkhau').val() != $('#txtrepass').val())
                {
                    $('#txtrepass').parent().attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
                    // $('#txtrepass').focus();
                }
                else{
                    $('#txtrepass').parent().removeClass("errorClass").tooltip("destroy");
                }
            }   
        });

        $('#txtphone').keyup(function(){
        //Nhap ban phim
            if($('#txtphone').val().length == 0)
            {
                if($('#txtphone').parent().hasClass('errorClass') == false)
                {
                    $('#txtphone').parent().attr('title', 'Vui lòng nhập số điện thoại').tooltip('show').addClass('errorClass');
                }
                $('#txtphone').focus();
            }
            else
            {
                $('#txtphone').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtphone').blur(function(){
            if($('#txtphone').val() ==''){
                if($('#txtphone').parent().hasClass('errorClass') == false){
                    $('#txtphone').parent().attr('title', 'Vui lòng nhập số điện thoại').tooltip('show').addClass('errorClass');                
                } 
                $('#txtphone').focus();
            }
            else
            {
                var regex_sdt = /^[0-9]{9,16}$/;
                if (regex_sdt.test($('#txtphone').val()) == false) 
                {
                    $('#txtphone').parent().attr('title', 'Số điện thoại không phù hợp').tooltip('show').addClass('errorClass');
                    $('#txtphone').focus();
                }
                else if(regex_sdt.test($('#txtphone').val()) == true)
                {
                    $.ajax({
                        url: configulr+"site/check_sdt",
                        type: "POST",
                        data: { type: 1, data: $('#txtphone').val() },
                        dataType: 'json',
                        beforeSend: function () 
                        {
                            $("#boxLoading").show();
                        },
                        success: function (obj) 
                        {
                            if(obj == 1){
                                $($('#txtphone')).tooltip('hide').attr('title', 'Số điện thoại đã đăng ký vui lòng chọn số khác').tooltip('show');
                                $('#txtphone').parent().addClass('errorClass');
                                $('#txtphone').focus();
                                return false;
                            }
                            else
                            {
                                $('#txtphone').data("title", "");
                                $('#txtphone').removeClass("errorClass");
                            }
                        },
                        error: function (xhr) 
                        {
                            alert("error");
                        },
                        complete: function () 
                        {
                            $("#boxLoading").hide();
                        }
                    });
                }
                else
                {
                    $('#txtphone').parent().removeClass("errorClass").tooltip("destroy");
                }
            }   
        });

        $('#txtngaysinh').keyup(function(){
        //Nhap ban phim
            if($('#txtngaysinh').val().length == 0)
            {
                if($('#txtngaysinh').parent().hasClass('errorClass') == false)
                {
                    $('#txtngaysinh').parent().attr('title', 'Vui lòng nhập ngày sinh').tooltip('show').addClass('errorClass');
                }
                $('#txtngaysinh').focus();
            }
            else
            {
                $('#txtngaysinh').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtngaysinh').blur(function(){
            if($('#txtngaysinh').val() =='')
            {
                if($('#txtngaysinh').parent().hasClass('errorClass') == false){
                    $('#txtngaysinh').parent().attr('title', 'Vui lòng nhập ngày sinh').tooltip('show').addClass('errorClass');                
                } 
                $('#txtngaysinh').focus();
            }
            else
            {
                $('#txtngaysinh').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#txtnoiohientai').keyup(function(){
        //Nhap ban phim
            if($('#txtnoiohientai').val().length == 0)
            {
                if($('#txtnoiohientai').parent().hasClass('errorClass') == false)
                {
                    $('#txtnoiohientai').parent().attr('title', 'Vui lòng nhập địa chỉ hiện tại bạn đang sinh sống').tooltip('show').addClass('errorClass');
                }
                $('#txtnoiohientai').focus();
            }
            else
            {
                $('#txtnoiohientai').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtnoiohientai').blur(function(){
            if($('#txtnoiohientai').val() =='')
            {
                if($('#txtnoiohientai').parent().hasClass('errorClass') == false){
                    $('#txtnoiohientai').parent().attr('title', 'Vui lòng nhập địa chỉ hiện tại bạn đang sinh sống').tooltip('show').addClass('errorClass');                
                } 
                $('#txtnoiohientai').focus();
            }
            else
            {
                $('#txtnoiohientai').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#txtschool').keyup(function(){
        //Nhap ban phim
            if($('#txtschool').val().length == 0)
            {
                if($('#txtschool').parent().hasClass('errorClass') == false)
                {
                    $('#txtschool').parent().attr('title', 'Vui lòng nhập trường học của bạn ').tooltip('show').addClass('errorClass');
                }
                $('#txtschool').focus();
            }
            else
            {
                $('#txtschool').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtschool').blur(function(){
            if($('#txtschool').val() =='')
            {
                if($('#txtschool').parent().hasClass('errorClass') == false){
                    $('#txtschool').parent().attr('title', 'Vui lòng nhập trường học của bạn').tooltip('show').addClass('errorClass');                
                } 
                $('#txtschool').focus();
            }
            else
            {
                $('#txtschool').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#txtmajor').keyup(function(){
        //Nhap ban phim
            if($('#txtmajor').val().length == 0)
            {
                if($('#txtmajor').parent().hasClass('errorClass') == false)
                {
                    $('#txtmajor').parent().attr('title', 'Vui lòng nhập chuyên ngành của bạn').tooltip('show').addClass('errorClass');
                }
                $('#txtmajor').focus();
            }
            else
            {
                $('#txtmajor').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtmajor').blur(function(){
            if($('#txtmajor').val() =='')
            {
                if($('#txtmajor').parent().hasClass('errorClass') == false){
                    $('#txtmajor').parent().attr('title', 'Vui lòng nhập chuyên ngành của bạn').tooltip('show').addClass('errorClass');                
                } 
                $('#txtmajor').focus();
            }
            else
            {
                $('#txtmajor').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });
        var reg_year = /^[0-9]{4}$/;
        $('#txtGraduationyear').keyup(function(){
        //Nhap ban phim
            if($('#txtGraduationyear').val().length == 0)
            {
                if($('#txtGraduationyear').parent().hasClass('errorClass') == false)
                {
                    $('#txtGraduationyear').parent().attr('title', 'Vui lòng nhập năm tốt nghiệp của bạn').tooltip('show').addClass('errorClass'); 
                }
                $('#txtGraduationyear').focus();
            }
            else if (reg_year.test($('#txtGraduationyear').val()) == false) {
                 if($('#txtGraduationyear').hasClass('errorClass') == false)
                {
                    $('#txtGraduationyear').attr('title', 'năm tốt nghiệp không đúng định dạng').tooltip('show').addClass('errorClass');
                     $('#txtGraduationyear').focus();
                     return false;
                }

        
            }
            else
            {
                $('#txtGraduationyear').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtGraduationyear').blur(function(){
            if($('#txtGraduationyear').val() =='')
            {
                if($('#txtGraduationyear').parent().hasClass('errorClass') == false){
                    $('#txtGraduationyear').parent().attr('title', 'Vui lòng nhập năm tốt nghiệp của bạn').tooltip('show').addClass('errorClass');                
                } 
                $('#txtGraduationyear').focus();
            }
            else
            {
                $('#txtGraduationyear').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#infouser').keyup(function(){
        //Nhap ban phim
            if($('#infouser').val().length == 0)
            {
                if($('#infouser').parent().hasClass('errorClass') == false)
                {
                    $('#infouser').parent().attr('title', 'Vui lòng giới thiệu về bản thân của bạn').tooltip('show').addClass('errorClass');
                }
                $('#infouser').focus();
            }
            else
            {
                $('#infouser').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#infouser').blur(function(){
            if($('#infouser').val() =='')
            {
                if($('#infouser').parent().hasClass('errorClass') == false){
                    $('#infouser').parent().attr('title', 'Vui lòng giới thiệu về bản thân của bạn').tooltip('show').addClass('errorClass');                
                } 
                $('#infouser').focus();
            }
            else
            {
                $('#infouser').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#kinhnghiem').keyup(function(){
        //Nhap ban phim
            if($('#kinhnghiem').val().length == 0)
            {
                if($('#kinhnghiem').parent().hasClass('errorClass') == false)
                {
                    $('#kinhnghiem').parent().attr('title', 'Vui lòng nhập kinh nghiệm đi dạy của bạn').tooltip('show').addClass('errorClass');
                }
                $('#kinhnghiem').focus();
            }
            else
            {
                $('#kinhnghiem').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#kinhnghiem').blur(function(){
            if($('#kinhnghiem').val() =='')
            {
                if($('#kinhnghiem').parent().hasClass('errorClass') == false){
                    $('#kinhnghiem').parent().attr('title', 'Vui lòng nhập kinh nghiệm đi dạy của bạn').tooltip('show').addClass('errorClass');                
                } 
                $('#kinhnghiem').focus();
            }
            else
            {
                $('#kinhnghiem').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });

        $('#txthocphi').keyup(function(){
        //Nhap ban phim
            if($('#txthocphi').val().length == 0)
            {
                if($('#txthocphi').parent().hasClass('errorClass') == false)
                {
                    $('#txthocphi').parent().attr('title', 'Vui lòng nhập mức học phí dự kiến').tooltip('show').addClass('errorClass');
                }
                $('#txthocphi').focus();
            }
            else
            {
                $('#txthocphi').parent().removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txthocphi').blur(function(){
            if($('#txthocphi').val() =='')
            {
                if($('#txthocphi').parent().hasClass('errorClass') == false){
                    $('#txthocphi').parent().attr('title', 'Vui lòng nhập mức học phí dự kiến').tooltip('show').addClass('errorClass');                
                } 
                $('#txthocphi').focus();
            }
            else
            {
                $('#txthocphi').parent().removeClass("errorClass").tooltip("destroy");
            }   
        });
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


        $('#lop').on('change',function()
        {
            var id_lop = $(this).val();
                $.ajax({
                url: configulr+"site/getlopday",
                type:'POST',
                data:
                {
                    id_lop : id_lop,
                },
                success:function(reponse)
                {
                    // $('#monhoc').html('<option value='+0+'>Chọn môn học</option>'+reponse);
                    console.log(reponse);
                },
                error:function(xhr)
                {
                    console.log("error");
                },
                complete:function()
                {
                    $("#boxLoading").hide();
                }
            });
        });
    });
</script>
<?php

/**
 * @author lolkittens
 * @copyright 2018
 */



?>

<section class="signup-signin light dangkythanhvien">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#candidate" aria-controls="candidate" role="tab" data-toggle="tab" aria-expanded="true"><i class="careerfy-icon careerfy-user"></i><span>Tài khoản ứng viên</span> <small>Tìm công việc phù hợp</small></a></li>
              <li role="presentation" class=""><a href="#employer" aria-controls="employer" role="tab" data-toggle="tab" aria-expanded="false"><i class="careerfy-icon careerfy-building"></i><span>Tài khoản nhà tuyển dụng</span> <small>Tìm ứng viên giỏi</small></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="candidate">
                <div class="register-form">
                    <h5>Thông tin đăng nhập <span style="float:right;font-size:13px;">Các trường có * là bắt buộc</span></h5>
                  
                  
                    <div class="row">
                      <div class="col-sm-6">
                        
                        <div class="form-group">
                          <input type="email" name="email" autocomplete="off" id="emailcandi" class="form-control" placeholder="Tên đăng nhập" required>
                          <span class="required">*</span>
                        </div>
                        
                        <div class="form-group">
                          <input type="password" name="passwordcandi" autocomplete="off" id="passcandi" class="form-control" placeholder="Mật khẩu" required>
                          <span class="required">*</span>
                        </div>
                        
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="password" name="retype-passwordcandi" autocomplete="off" id="repasscandi" class="form-control" placeholder="Nhập lại mật khẩu" required>
                          <span class="required">*</span>
                        </div>                        
                        
                      </div>
                    </div>
                    <h5>Thông tin cá nhân</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <input type="text" name="username" autocomplete="off" id="namecandi" class="form-control" placeholder="Họ và tên" required>
                              <span class="required">*</span>
                            </div>
                            <div class="form-group">
                              <input type="tel" name="mobile" autocomplete="off" class="form-control" id="phonecandi" placeholder="Số điện thoại" required="">
                              <span class="required">*</span>
                            </div>
                            <div class="form-group">
                            <select id="citycandi" class="city_ab">                        
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
                                <span class="required">*</span>
                            </div>
                            <div class="form-group">
                            <select id="districtcandi" class="city_ab">                        
                            <option data-tokens="0" value="0">Chọn quận/huyện</option>
                                                                                                 
                                </select>
                                <span class="required">*</span>
                            </div>
                            <div class="form-group">
                              <input type="text" name="school" autocomplete="off" id="school" class="form-control" placeholder="Tên trường học" required>
                              
                            </div>
                            <div class="form-group">
                              <input type="text" name="schooltype" autocomplete="off" id="schooltype" class="form-control" placeholder="Chuyên ngành học" required>
                              
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class='input-group date' id='datetimepicker1' style="width: 100%">
                            <input type='text' placeholder="Ngày sinh" id="txtngaysinh" class="form-control" />
                            <span class="input-group-addon">
                                <span class="fa fa-calendar"></span>
                            </span>
                            </div>
                            <div class="form-group">
                                <select id="candisex" class="city_ab">
                                    <option value="0">Chọn giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="2">Nữ</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="candimarriage" class="form-control" name="lg_honnhan">
                                    <option value="0">Chọn tình trạng hôn nhân *</option>
                                    <option value="1">Độc thân</option>
                                    <option value="2">Đã có gia đình</option>
                                </select>
                                <span class="required">*</span>
                            </div>
                            <div class="form-group">
                              <input type="text" name="diachicandi" autocomplete="off" id="diachicandi" class="form-control" placeholder="Nhập địa chỉ thường trú" required>
                              <span class="required">*</span>
                            </div>
                            <div class="form-group">
                                <select id="xeploaihoctap" class="xeploaihoctap">
                                    <option value="0">Chọn xếp loại học tập</option>
                                    <option value="1">Yếu</option>
                                    <option value="2">Trung bình</option>
                                    <option value="5">TB khá</option>
                                    <option value="3">Khá</option>
                                    <option value="4">Giỏi</option> 
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="languagecandi" class="form-control" name="languagecandi">                                    
                                      <option value="0">Chọn ngôn ngữ bạn biết</option>
                                      <option value="1">Tiếng Anh</option>
                                      <option value="2">Tiếng Pháp</option>
                                      <option value="3">Tiếng Nga</option>
                                      <option value="4">Tiếng Hàn</option>
                                      <option value="5">Tiếng Trung</option>
                                      <option value="6">Tiếng Nhật</option>
                                </select>
                                <span class="required">*</span>
                            </div>
                        </div>
                    </div>
                    <h5>Công việc mong muốn</h5>
                    <div class="row thongtinboxung">
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                              <input type="text" name="jobwish" autocomplete="off" id="jobwish" class="form-control" placeholder="Công việc mong muốn" required>
                              
                            </div>
                            <div class="form-group">
                                <select id="candibangcap" class="form-control valid error" name="candibangcap">
                                <option value="0">Chọn bằng cấp *</option><option value="7">Đại học</option>
                                <option value="5">Cao đẳng</option>
                                <option value="1">PTCS</option>
                                <option value="2">Trung học</option>
                                <option value="3">Chứng chỉ</option>
                                <option value="4">Trung cấp</option>
                                <option value="6">Cử nhân</option>
                                <option value="8">Thạc sĩ</option>
                                <option value="9">Thạc sĩ Nghệ thuật</option>
                                <option value="10">Thạc sĩ Thương mại</option>
                                <option value="11">Thạc sĩ Khoa học</option>
                                <option value="12">Thạc sĩ Kiến trúc</option>
                                <option value="13">Thạc sĩ QTKD</option>
                                <option value="14">Thạc sĩ Kỹ thuật ứng dụng</option>
                                <option value="15">Thạc sĩ Luật</option>
                                <option value="16">Thạc sĩ Y học</option>
                                <option value="17">Thạc sĩ Dược phẩm</option>
                                <option value="18">Tiến sĩ</option>
                                <option value="19">Khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="candihtlv" class="form-control valid error" name="candihtlv">
                                <option value="0">Chọn hình thức làm việc *</option>
                                <option value="1">Toàn thời gian cố định</option>
                                <option value="2">Toàn thời gian tạm thời</option>
                                <option value="3">Bán thời gian</option>
                                <option value="4">Bán thời gian tạm thời</option>
                                <option value="5">Hợp đồng</option>
                                <option value="6">Khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="candicapbac" class="form-control valid error" name="candicapbac">
                                    <option value="">Chọn cấp bậc mong muốn </option> 
                                    <option value="1">Mới Tốt Nghiệp</option>
                                  <option value="3">Nhân viên</option>
                                  <option value="2">Trưởng Phòng</option>
                                  <option value="4">Giám Đốc và Cấp Cao Hơn</option>
                                  <option value="5">Trưởng nhóm</option>
                                 </select>
                            </div>
                            <div class="form-group">
                                <select id="salarycandi" class="form-control valid error" name="salarycandi">
                                <option value="0">Chọn mức lương *</option>
                                <option value="1">Thỏa thuận</option>
                                <option value="2">1 - 3 triệu</option>
                                <option value="3">3 - 5 triệu</option>
                                <option value="4">5 - 7 triệu</option>
                                <option value="5">7 - 10 triệu</option>
                                <option value="6">10 - 15 triệu</option>
                                <option value="7">15 - 20 triệu</option>
                                <option value="8">20 - 30 triệu</option>
                                <option value="9">Trên 30 triệu</option>
                                </select>                            
                            </div>

                        </div>
                        <div class="col-sm-6">
                            
                            <div class="form-group">
                                <select id="citycandimore" class="city_ab">                        
                                <option data-tokens="0" value="0">Nơi làm việc khác</option>
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
                                <div class="form-group">
                                    <select id="candicategory" class="city_ab">
                                        <option data-tokens="0" value="0">Công việc 1</option> 
                                                    <option data-tokens="1" value="1">Kế toán - Kiểm toán</option> 
                                                                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option> 
                                                                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option> 
                                                                                        <option data-tokens="4" value="4">Xây dựng</option> 
                                                                                        <option data-tokens="5" value="5">Điện - Điện tử</option> 
                                                                                        <option data-tokens="6" value="6">Làm bán thời gian</option> 
                                                                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option> 
                                                                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option> 
                                                                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option> 
                                                                                        <option data-tokens="10" value="10">Việc làm bán hàng</option> 
                                                                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option> 
                                                                                        <option data-tokens="12" value="12">Lao động phổ thông</option> 
                                                                                        <option data-tokens="13" value="13">IT phần mềm</option> 
                                                                                        <option data-tokens="14" value="14">Marketing-PR</option> 
                                                                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option> 
                                                                                        <option data-tokens="18" value="18">Kỹ thuật</option> 
                                                                                        <option data-tokens="19" value="19">Y tế-Dược</option> 
                                                                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option> 
                                                                                        <option data-tokens="21" value="21">Dịch vụ</option> 
                                                                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option> 
                                                                                        <option data-tokens="23" value="23">Dệt may - Da giày</option> 
                                                                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option> 
                                                                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option> 
                                                                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option> 
                                                                                        <option data-tokens="27" value="27">Nhân sự</option> 
                                                                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option> 
                                                                                        <option data-tokens="29" value="29">Tư vấn</option> 
                                                                                        <option data-tokens="30" value="30">Bảo vệ</option> 
                                                                                        <option data-tokens="31" value="31">Ô tô - xe máy</option> 
                                                                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option> 
                                                                                        <option data-tokens="33" value="33">KD bất động sản</option> 
                                                                                        <option data-tokens="34" value="34">Du lịch</option> 
                                                                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option> 
                                                                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option> 
                                                                                        <option data-tokens="37" value="37">Ngành nghề khác</option> 
                                                                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option> 
                                                                                        <option data-tokens="39" value="39">Thiết kế web</option> 
                                                                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option> 
                                                                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option> 
                                                                                        <option data-tokens="42" value="42">Thương mại điện tử</option> 
                                                                                        <option data-tokens="43" value="43">Nhập liệu</option> 
                                                                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option> 
                                                                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option> 
                                                                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
                 Thực tập</option> 
                                                                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option> 
                                                                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option> 
                                                                                        <option data-tokens="49" value="49">Dầu khí -
                 Địa chất</option> 
                                                                                        <option data-tokens="50" value="50">Giao thông vận tải -
                 Thủy lợi - Cầu đường</option> 
                                                                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option> 
                                                                                        <option data-tokens="52" value="52">Làm đẹp -
                 Thể lực -
                 Spa</option> 
                                                                                        <option data-tokens="53" value="53">Luật - Pháp lý</option> 
                                                                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option> 
                                                                                        <option data-tokens="55" value="55">Mỹ phẩm -
                 Thời trang -
                 Trang sức</option> 
                                                                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option> 
                                                                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option> 
                                                                                        <option data-tokens="58" value="58">Phát triển thị trường</option> 
                                                                                        <option data-tokens="59" value="59">Phục vụ -
                 Tạp vụ -
                 Giúp việc</option> 
                                                                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option> 
                                                                                        <option data-tokens="61" value="61">Quản lý điều hành</option> 
                                                                                        <option data-tokens="62" value="62">Sản xuất -
                 Vận hành sản xuất</option> 
                                                                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option> 
                                                                                        <option data-tokens="64" value="64">Thể dục -
                 Thể thao</option> 
                                                                                        <option data-tokens="65" value="65">Hóa học -
                 Sinh học</option> 
                                                                                        <option data-tokens="66" value="66">Bảo hiểm</option> 
                                                                                        <option data-tokens="67" value="67">Freelancer</option> 
                                                                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>              
                                     </select>
                                </div>
                                <div class="form-group">
                                    <select id="candicategorymore" class="city_ab">
                                        <option data-tokens="0" value="0">Công việc 2</option> 
                                                    <option data-tokens="1" value="1">Kế toán - Kiểm toán</option> 
                                                                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option> 
                                                                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option> 
                                                                                        <option data-tokens="4" value="4">Xây dựng</option> 
                                                                                        <option data-tokens="5" value="5">Điện - Điện tử</option> 
                                                                                        <option data-tokens="6" value="6">Làm bán thời gian</option> 
                                                                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option> 
                                                                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option> 
                                                                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option> 
                                                                                        <option data-tokens="10" value="10">Việc làm bán hàng</option> 
                                                                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option> 
                                                                                        <option data-tokens="12" value="12">Lao động phổ thông</option> 
                                                                                        <option data-tokens="13" value="13">IT phần mềm</option> 
                                                                                        <option data-tokens="14" value="14">Marketing-PR</option> 
                                                                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option> 
                                                                                        <option data-tokens="18" value="18">Kỹ thuật</option> 
                                                                                        <option data-tokens="19" value="19">Y tế-Dược</option> 
                                                                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option> 
                                                                                        <option data-tokens="21" value="21">Dịch vụ</option> 
                                                                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option> 
                                                                                        <option data-tokens="23" value="23">Dệt may - Da giày</option> 
                                                                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option> 
                                                                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option> 
                                                                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option> 
                                                                                        <option data-tokens="27" value="27">Nhân sự</option> 
                                                                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option> 
                                                                                        <option data-tokens="29" value="29">Tư vấn</option> 
                                                                                        <option data-tokens="30" value="30">Bảo vệ</option> 
                                                                                        <option data-tokens="31" value="31">Ô tô - xe máy</option> 
                                                                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option> 
                                                                                        <option data-tokens="33" value="33">KD bất động sản</option> 
                                                                                        <option data-tokens="34" value="34">Du lịch</option> 
                                                                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option> 
                                                                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option> 
                                                                                        <option data-tokens="37" value="37">Ngành nghề khác</option> 
                                                                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option> 
                                                                                        <option data-tokens="39" value="39">Thiết kế web</option> 
                                                                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option> 
                                                                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option> 
                                                                                        <option data-tokens="42" value="42">Thương mại điện tử</option> 
                                                                                        <option data-tokens="43" value="43">Nhập liệu</option> 
                                                                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option> 
                                                                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option> 
                                                                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
                 Thực tập</option> 
                                                                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option> 
                                                                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option> 
                                                                                        <option data-tokens="49" value="49">Dầu khí -
                 Địa chất</option> 
                                                                                        <option data-tokens="50" value="50">Giao thông vận tải -
                 Thủy lợi - Cầu đường</option> 
                                                                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option> 
                                                                                        <option data-tokens="52" value="52">Làm đẹp -
                 Thể lực -
                 Spa</option> 
                                                                                        <option data-tokens="53" value="53">Luật - Pháp lý</option> 
                                                                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option> 
                                                                                        <option data-tokens="55" value="55">Mỹ phẩm -
                 Thời trang -
                 Trang sức</option> 
                                                                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option> 
                                                                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option> 
                                                                                        <option data-tokens="58" value="58">Phát triển thị trường</option> 
                                                                                        <option data-tokens="59" value="59">Phục vụ -
                 Tạp vụ -
                 Giúp việc</option> 
                                                                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option> 
                                                                                        <option data-tokens="61" value="61">Quản lý điều hành</option> 
                                                                                        <option data-tokens="62" value="62">Sản xuất -
                 Vận hành sản xuất</option> 
                                                                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option> 
                                                                                        <option data-tokens="64" value="64">Thể dục -
                 Thể thao</option> 
                                                                                        <option data-tokens="65" value="65">Hóa học -
                 Sinh học</option> 
                                                                                        <option data-tokens="66" value="66">Bảo hiểm</option> 
                                                                                        <option data-tokens="67" value="67">Freelancer</option> 
                                                                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>              
                                     </select>
                                </div>
                                <div class="form-group">
                                    <select id="candicategorymore2" class="city_ab">
                                        <option data-tokens="0" value="0">Công việc 3</option> 
                                                    <option data-tokens="1" value="1">Kế toán - Kiểm toán</option> 
                                                                                        <option data-tokens="2" value="2">Hành chính - Văn phòng</option> 
                                                                                        <option data-tokens="3" value="3">Sinh viên làm thêm</option> 
                                                                                        <option data-tokens="4" value="4">Xây dựng</option> 
                                                                                        <option data-tokens="5" value="5">Điện - Điện tử</option> 
                                                                                        <option data-tokens="6" value="6">Làm bán thời gian</option> 
                                                                                        <option data-tokens="7" value="7">Vận tải - Lái xe</option> 
                                                                                        <option data-tokens="8" value="8">Khách sạn - Nhà hàng</option> 
                                                                                        <option data-tokens="9" value="9">Nhân viên kinh doanh</option> 
                                                                                        <option data-tokens="10" value="10">Việc làm bán hàng</option> 
                                                                                        <option data-tokens="11" value="11">Cơ khí - Chế tạo</option> 
                                                                                        <option data-tokens="12" value="12">Lao động phổ thông</option> 
                                                                                        <option data-tokens="13" value="13">IT phần mềm</option> 
                                                                                        <option data-tokens="14" value="14">Marketing-PR</option> 
                                                                                        <option data-tokens="17" value="17">Giáo dục-Đào tạo</option> 
                                                                                        <option data-tokens="18" value="18">Kỹ thuật</option> 
                                                                                        <option data-tokens="19" value="19">Y tế-Dược</option> 
                                                                                        <option data-tokens="20" value="20">Quản trị kinh doanh</option> 
                                                                                        <option data-tokens="21" value="21">Dịch vụ</option> 
                                                                                        <option data-tokens="22" value="22">Biên-Phiên dịch</option> 
                                                                                        <option data-tokens="23" value="23">Dệt may - Da giày</option> 
                                                                                        <option data-tokens="24" value="24">Kiến trúc - Tk nội thất</option> 
                                                                                        <option data-tokens="25" value="25">Xuất,nhập khẩu</option> 
                                                                                        <option data-tokens="26" value="26">IT Phần cứng-mạng</option> 
                                                                                        <option data-tokens="27" value="27">Nhân sự</option> 
                                                                                        <option data-tokens="28" value="28">Thiết kế - Mỹ thuật</option> 
                                                                                        <option data-tokens="29" value="29">Tư vấn</option> 
                                                                                        <option data-tokens="30" value="30">Bảo vệ</option> 
                                                                                        <option data-tokens="31" value="31">Ô tô - xe máy</option> 
                                                                                        <option data-tokens="32" value="32">Thư ký-Trợ lý</option> 
                                                                                        <option data-tokens="33" value="33">KD bất động sản</option> 
                                                                                        <option data-tokens="34" value="34">Du lịch</option> 
                                                                                        <option data-tokens="35" value="35">Báo chí-Truyền hình</option> 
                                                                                        <option data-tokens="36" value="36">Thực phẩm-Đồ uống</option> 
                                                                                        <option data-tokens="37" value="37">Ngành nghề khác</option> 
                                                                                        <option data-tokens="38" value="38">Vật tư-Thiết bị</option> 
                                                                                        <option data-tokens="39" value="39">Thiết kế web</option> 
                                                                                        <option data-tokens="40" value="40">In ấn - Xuất bản</option> 
                                                                                        <option data-tokens="41" value="41">Nông-Lâm-Ngư-Nghiệp</option> 
                                                                                        <option data-tokens="42" value="42">Thương mại điện tử</option> 
                                                                                        <option data-tokens="43" value="43">Nhập liệu</option> 
                                                                                        <option data-tokens="44" value="44">Việc làm thêm tại nhà</option> 
                                                                                        <option data-tokens="45" value="45">Chăm sóc khách hàng</option> 
                                                                                        <option data-tokens="46" value="46">Sinh viên mới tốt nghiệp -
                 Thực tập</option> 
                                                                                        <option data-tokens="47" value="47">Kỹ thuật ứng dụng</option> 
                                                                                        <option data-tokens="48" value="48">Bưu chính viễn thông</option> 
                                                                                        <option data-tokens="49" value="49">Dầu khí -
                 Địa chất</option> 
                                                                                        <option data-tokens="50" value="50">Giao thông vận tải -
                 Thủy lợi - Cầu đường</option> 
                                                                                        <option data-tokens="51" value="51">Khu chế xuất - Khu công nghiệp</option> 
                                                                                        <option data-tokens="52" value="52">Làm đẹp -
                 Thể lực -
                 Spa</option> 
                                                                                        <option data-tokens="53" value="53">Luật - Pháp lý</option> 
                                                                                        <option data-tokens="54" value="54">Môi trường - Xử lý chất thải</option> 
                                                                                        <option data-tokens="55" value="55">Mỹ phẩm -
                 Thời trang -
                 Trang sức</option> 
                                                                                        <option data-tokens="56" value="56">Ngân hàng - Chứng khoán - Đầu tư</option> 
                                                                                        <option data-tokens="57" value="57">Nghệ thuật - Điện ảnh</option> 
                                                                                        <option data-tokens="58" value="58">Phát triển thị trường</option> 
                                                                                        <option data-tokens="59" value="59">Phục vụ -
                 Tạp vụ -
                 Giúp việc</option> 
                                                                                        <option data-tokens="60" value="60">Quan hệ đối ngoại</option> 
                                                                                        <option data-tokens="61" value="61">Quản lý điều hành</option> 
                                                                                        <option data-tokens="62" value="62">Sản xuất -
                 Vận hành sản xuất</option> 
                                                                                        <option data-tokens="63" value="63">Thẩm định - Giám thẩm định - Quản lý chất lượng</option> 
                                                                                        <option data-tokens="64" value="64">Thể dục -
                 Thể thao</option> 
                                                                                        <option data-tokens="65" value="65">Hóa học -
                 Sinh học</option> 
                                                                                        <option data-tokens="66" value="66">Bảo hiểm</option> 
                                                                                        <option data-tokens="67" value="67">Freelancer</option> 
                                                                                        <option data-tokens="68" value="68">Công chức - Viên chức </option>              
                                     </select>
                                </div>
                                <div class="form-group">
                                <select id="candiexp" class="form-control valid error" name="candiexp">
                                    <option value="">Chọn kinh nghiệm bản thân *</option>
                                    <option value="0">Chưa có kinh nghiệm</option>
                                    <option value="1">Dưới 1 năm</option>
                                    <option value="2">1 năm</option>
                                    <option value="3">2 năm</option>
                                    <option value="4">3 năm</option>
                                    <option value="5">4 năm</option>
                                    <option value="6">5 năm</option>
                                    <option value="7">Trên 5 năm</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <h5>Mục tiêu nghề nghiệp</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="canditarget" rows="7" cols="50" style="width:100%;" wrap="hard"></textarea>
                            </div>
                        </div>                        
                    </div>
                    <h5>Kỹ năng bản thân</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea id="candiskill" rows="7" cols="50" style="width:100%;" wrap="hard"></textarea>
                                
                            </div>
                        </div>                        
                    </div>
                    <div class="row">
                      <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="form-group checkboxcom">
                          <input type="checkbox" id="user-terms" name="user-terms" value="ok">
                          <label for="user-terms">Tôi đồng ý với <a href="javascript:void(0);">Điều khoản và điều kiện</a> của timvievlamthem.vn</label>
                        </div>
                        <button type="button" class="btn btn-primary btn-secondary btn-block dangkyungvien" >Đăng ký ngay</button>
                        
                      </div>
                    </div>
                  
                  <p class="register-link text-center">Bạn đã có tài khoản? <a href="<?php echo base_url() ?>dang-nhap">Đăng nhập ngay</a></p>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="employer">
                <div class="register-form">
                  <h6>Các trường có * là bắt buộc</h6>
                  
                    <div class="row">
                      <div class="col-sm-6">
                        
                        <div class="form-group">
                          <input type="email" name="email" autocomplete="off" id="usercompany" class="form-control" placeholder="Tên đăng nhập" >
                          <span class="required">*</span>
                        </div>
                        <div class="form-group">
                          <input type="password" name="password" autocomplete="off" id="passcompany" class="form-control" placeholder="Mật khẩu" >
                          <span class="required">*</span>
                        </div>
                        <div class="form-group">
                          <input type="password" name="retype-password" autocomplete="off" id="repasscompany" class="form-control" placeholder="Nhập lại mật khẩu" >
                          <span class="required">*</span>
                        </div>
                        <div class="form-group">
                          <input type="text" name="username" autocomplete="off" class="form-control" id="phonecompany" placeholder="Số điện thoại" >
                          <span class="required">*</span>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input type="text" name="company-name" autocomplete="off" class="form-control" id="namecompany" placeholder="Tên Công ty">
                        </div>
                        <div class="form-group">
                          <select id="citycompany" class="city_ab">                        
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
                        </div>
                        <div class="form-group">
                          <input type="text" name="website" autocomplete="off" id="websitecompany" class="form-control" placeholder="Website">
                        </div>
                        <div class="form-group">
                          <input type="text" name="address" autocomplete="off" id="addresscompany" class="form-control" placeholder="Địa chỉ">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8 col-md-offset-2 text-center">
                        <div class="form-group checkboxcom">
                          <input type="checkbox" name="company-terms" id="company-terms" value="ok">
                          <label for="company-terms">Tôi đồng ý với <a href="javascript:void(0);">Điều khoản và điều kiện</a> của timvievlamthem.vn</label>
                        </div>
                        <button name="submit" class="btn btn-primary btn-secondary btn-block dangkynhatuyendung" >Đăng ký ngay</button>
                      </div>
                    </div>
                  
                  <p class="register-link text-center">Bạn đã có tài khoản? <a href="<?php echo base_url() ?>dang-nhap">Đăng nhập ngay</a></p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet" />
<script src="js/localDatetime.js"></script>
<link href="css/froala_editor.min.css" rel="stylesheet" />
<script src="js/froala_editor.min.js"></script>
<script>
$(document).ready(function () {
$('#datetimepicker1').datetimepicker({
        locale: 'vi',
        format: 'DD-MM-YYYY'
    });
    $('textarea#canditarget').froalaEditor();
    $('textarea#candiskill').froalaEditor();
    });
</script>
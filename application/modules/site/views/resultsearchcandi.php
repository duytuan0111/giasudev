<?php

/**
 * @author lolkittens
 * @copyright 2018
 */

$CI=&get_instance();
$CI->load->model('site/site_model');

?>
<!-- SubHeader -->
        <div class="careerfy-subheader careerfy-subheader-without-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="careerfy-page-title">
                            <h1>Kết quả tìm kiếm ứng viên</h1>
                            <p>Danh sách toàn bộ ứng viên tốt nhất phù hợp với Quý Công ty</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="careerfy-breadcrumb">
                <ul>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>nguoi-tim-viec.html">Người tìm việc</a></li>
                    <li class="breadcrumb-item active">Kết quả tìm kiếm</li>        
                </ul>
                <div class="alpha-filters">
                  <div class="filter-by slider">
                  <?php if(!empty($candiabc)){
                    foreach($candiabc as $item){ 
                        if($params['keywork']== $item['name']){
                        ?>
                        <div><a onclick="load('<?php echo $item['url']  ?>')" class="active"><?php echo $item['name'] ?></a></div>  
                        <?php }else{ ?>
                         <div><a onclick="load('<?php echo $item['url']  ?>')"><?php echo $item['name'] ?></a></div>     
                    <?php } }
                  } 
                  ?>
                    
                  </div>
        
                </div>
            </div>
        </div>
        <!-- SubHeader -->
<div class="careerfy-main-content">
    <div class="careerfy-main-section careerfy-top-full">
        <div class="container">
            <div class="row">
                <aside class="careerfy-column-3">
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-search-filter">
                            <div class="careerfy-search-filter-wrap careerfy-without-toggle">
                                        <h2><a>Tìm ứng viên</a></h2>
                                        <div class="careerfy-search-box">
                                            <input class="form-control" value="<?php echo $params['keywork'] ?>" id="findkeycandi" placeholder="Nhập từ khóa" type="text">
                                            <button name="submit" class="timungvien" type="button"><i class="careerfy-icon careerfy-search"></i></button>
                                            
                                        </div>
                                        <div class="careerfy-location-box">
                                            <select id="candilocation" class="city_ab">                        
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
                                        <div class="careerfy-location-box">
                                            <select id="candinganhnghe" class="city_ab">
                        <option data-tokens="0" value="0">Không yêu cầu</option> 
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
                            </div>
                            <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                        <h2><a class="careerfy-click-btn">Lọc theo ngành nghề</a></h2>
                                        <div class="careerfy-checkbox-toggle">
                                            <ul id="shownganhnghe" class="careerfy-checkbox morelocation">
                                                <?php 
                                                if(!empty($nganhnghe)){
                                                    foreach($nganhnghe as $itemcat)
                                                    {
                                                        if($params['danhmuc']==$itemcat['cv_cate_id']){
                                                        ?>  
                                                          <li>
                                                            <input checked="checked" onclick="load('<?php echo $itemcat['url']  ?>')" name="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>" id="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>" type="checkbox">
                                                            <label for="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>"><span></span><?php echo $itemcat['nganhnghe']  ?></label>
                                                            <small class="pull-right"><?php echo $itemcat['soungvien']  ?></small>
                                                          </li>
                                                       <?php }else{
                                                        ?>
                                                        <li>
                                                            <input onclick="load('<?php echo $itemcat['url']  ?>')" name="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>" id="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>" type="checkbox">
                                                            <label for="nganhnghe<?php echo $itemcat['cv_cate_id']  ?>"><span></span><?php echo $itemcat['nganhnghe']  ?></label>
                                                            <small class="pull-right"><?php echo $itemcat['soungvien']  ?></small>
                                                          </li>
                                               <?php  }   }
                                                }
                                                ?>
                                            </ul>
                                            <a class="careerfy-seemore" id="morenganhnghe">+xem thêm</a>
                                        </div>
                                    </div>
                                    <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                        <h2><a class="careerfy-click-btn">Categories</a></h2>
                                        <div class="careerfy-checkbox-toggle">
                                            <ul id="showlocation"  class="careerfy-checkbox morelocation">
                                                <?php 
                                                    if(!empty($category)){
                                                        foreach($category as $n){ 
                                                if($params['tinhthanh']==$n['use_city']){ ?>
                                                    <li>
                                                    <input checked="checked" onclick="load('<?php echo $n['url'] ?>')" name="location<?php echo $n['use_city'] ?>" id="location<?php echo $n['use_city'] ?>" type="checkbox">
                                                    <label for="location<?php echo $n['use_city'] ?>"><span></span><?php echo $n['tinhthanh'] ?></label>
                                                    <small class="pull-right"><?php echo $n['soungvien'] ?></small>
                                                  </li>
                                                <?php }else{            
                                                ?>
                                                <li>
                                                    <input onclick="load('<?php echo $n['url'] ?>')" name="location<?php echo $n['use_city'] ?>" id="location<?php echo $n['use_city'] ?>" type="checkbox">
                                                    <label for="location<?php echo $n['use_city'] ?>"><span></span><?php echo $n['tinhthanh'] ?></label>
                                                    <small class="pull-right"><?php echo $n['soungvien'] ?></small>
                                                  </li>            
                                                <?php } }
                                                    }
                                                ?>
                                            </ul>
                                            <a id="morelocation" class="careerfy-seemore">+xem thêm</a>
                                        </div>
                                    </div>
                                    <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                        <h2><a  class="careerfy-click-btn">Lọc theo mức lương</a></h2>
                                        <div class="careerfy-checkbox-toggle">
                                            <ul class="careerfy-checkbox">
                                                <?php
                                                    if(!empty($candisalary)){
                                                        foreach($candisalary as $item){ 
                                                            if(isset($_COOKIE['candisalary']) and $_COOKIE['candisalary']== $item->cv_money_id  ){?>
                                                            <li>
                                                        <input checked="checked" onclick="fillcandisalary(this)" value="<?php echo $item->cv_money_id ?>" name="candisalary<?php echo $item->cv_money_id ?>" id="candisalary<?php echo $item->cv_money_id ?>" type="checkbox">
                                                        <label for="candisalary<?php echo $item->cv_money_id ?>"><span></span><?php echo $item->NameMoney ?></label>
                                                        <small class="pull-right"><?php echo $item->sobanghi ?></small>
                                                      </li> 
                                                            <?php }else{ ?>
                                                    <li>
                                                        <input onclick="fillcandisalary(this)" value="<?php echo $item->cv_money_id ?>" name="candisalary<?php echo $item->cv_money_id ?>" id="candisalary<?php echo $item->cv_money_id ?>" type="checkbox">
                                                        <label for="candisalary<?php echo $item->cv_money_id ?>"><span></span><?php echo $item->NameMoney ?></label>
                                                        <small class="pull-right"><?php echo $item->sobanghi ?></small>
                                                      </li>        
                                                <?php } }
                                                    } 
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="careerfy-search-filter-wrap careerfy-search-filter-toggle">
                                        <h2><a  class="careerfy-click-btn">Lọc theo kinh nghiệm</a></h2>
                                        <div class="careerfy-checkbox-toggle">
                                            <ul class="careerfy-checkbox">
                                                <?php
                                                    if(!empty($candiexp)){
                                                        foreach($candiexp as $item){
                                                            if(isset($_COOKIE['candiexp']) and $_COOKIE['candiexp']== $item->cv_exp  ){
                                                    ?>
                                                    <li>
                                                        <input checked="checked" value="<?php echo $item->cv_exp ?>" onclick="fillcandiexp(this)" name="industry<?php echo $item->cv_exp ?>" id="industry<?php echo $item->cv_exp ?>" type="checkbox">
                                                        <label for="industry<?php echo $item->cv_exp ?>"><span></span><?php echo $item->NameExp ?></label>
                                                        <small class="pull-right"><?php echo $item->sobanghi ?></small>
                                                      </li>  
                                                    <?php }else{ ?>
                                                    <li>
                                                        <input onclick="fillcandiexp(this)" value="<?php echo $item->cv_exp ?>" name="industry<?php echo $item->cv_exp ?>" id="industry<?php echo $item->cv_exp ?>" type="checkbox">
                                                        <label for="industry<?php echo $item->cv_exp ?>"><span></span><?php echo $item->NameExp ?></label>
                                                        <small class="pull-right"><?php echo $item->sobanghi ?></small>
                                                      </li>        
                                                <?php  }    }
                                                    }
                                                ?> 
                                            </ul>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </aside>
                <div class="careerfy-column-9">
                    <div class="careerfy-typo-wrap">
                        <div class="careerfy-filterable">
                                    <h2>Có <?php echo $totalrow ?> nhân viên hàng đầu phù hợp với kết quả tìm kiếm của bạn</h2>
                                    <ul>
                                        <li>
                                            <a onclick="clearcookecandi()" class="pull-right">Xóa lọc</a>
                                        </li>
                                    </ul>
                         </div>
                         <div class="careerfy-candidate careerfy-candidate-default">
                            <ul class="careerfy-row">
                                <?php if(!empty($itemcandi)){
                                    foreach($itemcandi as $n){ ?>
                                        <li class="careerfy-column-12">
                                            <div class="careerfy-candidate-default-wrap">
                                                <figure>
                                                    <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->use_first_name)."-uv".$n->use_id.".html"; ?>"><img src="images/<?php echo $n->use_logo; ?>" alt="<?php echo $n->use_first_name ?>" onerror='this.onerror=null;this.src="images/icon-no-image.png";'></a>
                                                    
                                                </figure>
                                                <div class="careerfy-candidate-default-text">
                                                    <div class="careerfy-candidate-default-left">
                                                        <h2><a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->use_first_name)."-uv".$n->use_id.".html"; ?>"><?php echo $n->use_first_name ?></a> <i class="careerfy-icon careerfy-check-mark"></i></h2>
                                                        <ul>
                                                            <li><?php
                                                if(empty($n->cv_cate_id)){
                                                    $catname=0;
                                                }else{
                                                    $catname=$n->cv_cate_id;
                                                }
                                                if($catname==0){
                                                    echo "Chưa cập nhật";
                                                }else{
                                                 echo GetCategory($catname);} ?> từ <a class="careerfy-candidate-default-studio"><?php echo date('d/m/Y',$n->use_update_time) ?></a></li>
                                                            <li><i class="fa fa-map-marker"></i> <?php echo Getcitybyindex($n->use_city) ?></li>
                                                            <li><a><i class="fa fa-usd"></i> <?php echo GetLuong($n->cv_money_id) ?></a></li>
                                                            <li><i class="fa fa-briefcase"></i> <?php echo Getexp(intval($n->cv_exp)) ?></li>
                                                        </ul>
                                                    </div>
                                                    <a href="<?php echo base_url()."ung-vien/".vn_str_filter($n->use_first_name)."-uv".$n->use_id.".html"; ?>" class="careerfy-candidate-default-btn"><i class="careerfy-icon careerfy-add-list"></i> Chi tiết</a>
                                                </div>
                                            </div>
                                        </li>
                                        
                                <?php }
                                }else{
                                    echo "Không tìn thấy theo yêu cầu";
                                } ?>
                                
                            </ul>
                         </div>
                         <div class="pagation pull-right">
    						<?php echo $pagination; ?>
    					</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h3 class="text-left" style="margin-top:10px;">Việc làm theo tỉnh thành</h3>
            <div class="row">
                <ul class='job-category-list'>
                     <?php $jobforcat=$CI->site_model->GetProvinceWithLink();
                        
                        foreach($jobforcat as $item){
                            
                            ?>
                            <li class="col-md-3 col-sm-6"><a class="" href="<?php echo $item['url'] ?>" title="<?php echo $item['name'] ?>"><?php echo $item['name'] ?></a></li> 
                            <?php
                        }
                        
                         ?>
                </ul>
            </div>
        </div>
    </div>
</div>
    
<script>
jQuery( ".careerfy-click-btn" ).on('click', function (e) {
  jQuery( this ).parents('.careerfy-search-filter-toggle').find('.careerfy-checkbox-toggle').slideToggle( "slow", function() {});
  jQuery( this ).parents('.careerfy-search-filter-toggle').toggleClass( "careerfy-remove-padding", function() {});
   return false;
});
function fillcandisalary(e)
{
    var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('candisalary', fillzero);
}
function fillcandiexp(e)
{
    var fillzero = $(e).attr("value");
window.location = window.location.href;
setCookie('candiexp', fillzero);
}
function setCookie(key, value) {
var expires = new Date();
expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
function delCookie(key) {
var expires = new Date();
expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
document.cookie = key + '=;expires=' + expires.toUTCString();
}
function clearcookecandi()
{
    delCookie('candiexp');
    delCookie('candisalary');
    //setCookie('jobedu', '');
    //setCookie('joblevel', '');
    //setCookie('jobexperion', '');
    //setCookie('jobupdate', '');
    window.location = '<?php echo base_url().'nguoi-tim-viec.html' ?>';//window.location.href;
}
function load(elm){window.location = elm;}
var job=new SearchJob();
$('#candinganhnghe').select2({ width: 'calc(100% - 0px)' }).select2("val", "<?php echo $params['danhmuc'] ?>");
$('#candilocation').select2({ width: 'calc(100% - 0px)' }).select2("val", "<?php echo $params['tinhthanh'] ?>");
</script>
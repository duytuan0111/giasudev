<?php ?>
<div class="container">
<?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-top-30 padd-bot-30">
    <div class="container">
        <div class="row register">
            <h1 class="title titleregister">Đăng ký tìm gia sư</h1>
            <p style="text-align:center;">Quý phụ huynh, học sinh vui lòng điền đầy đủ và chính xác thông tin bên dưới</p>
        </div>
        <div class="row padd-bot-5">
            <div class="col-md-10 col-md-offset-1">
                <div class="registerform">
                    <h3 class="col-md-12"><i class="fa fa-plus-circle"></i> Thông tin đăng nhập <span>Bạn đã có tài khoản? <a href="<?php echo base_url() ?>phu-huynh-dang-nhap">Đăng nhập</a></span></h3>
                    <div class="col-md-12">
                        <label>Email<span style="font-weight:300;font-size:13">(Email là tài khoản để bạn đăng nhập)</span> *</label>
                        <div class="form-control" id = "email" ><input type="text" id="txtemail"/></div>
                    </div>
                    <div class="col-md-12">
                        <label>Họ tên đầy đủ *</label>
                        <div class="form-control" id = "hoten"><input type="text" id="txthoten"/></div>
                    </div>
                    
                    <div class="col-md-12" >
                     <label>Số điện thoại <span style="font-weight:300;font-size:13"></span> *</label>
                     <div class="form-control" id = "sdt"><input type="text" id="txtsdt" maxlength="10" /></div>
                 </div>
                 <div class="col-md-6">
                    <label>Mật khẩu <span  style="font-weight:300;font-size:13">(Mật khẩu tối thiểu 6 ký tự)</span> *</label>
                    <div class="form-control" id = "pass"><input type="password" id="txtpass"/></div>
                </div>

                <div class="col-md-6">
                    <label>Nhập lại mật khẩu *</label>
                    <div class="form-control" id = "repass"><input type="password" id="txtrepass"/></div>
                </div>
            </div>
        </div>        
    </div>
    <div class="row padd-bot-5">
        <div class="col-md-10 col-md-offset-1">

            <div class="col-md-12 captchavalue" style="overflow: hidden;">
                <div class="form-group lblcheck">
                    <input type="checkbox" id="dongydieukhoan" /><label for="dongydieukhoan">
                       Tôi cam kết thông tin tạo lớp là thật và không thu bất kỳ phí nào của giáo viên. Tôi chấp nhận các quy định của Giasu365.
                   </label>
               </div>
           </div>
           <div class="col-md-12">
            <div class="fun">
                <span class="btn btn-primary btn-success" id="dangkytaikhoan">Hoàn tất</span>
                <span class="btn btn-primary btn-warning">Làm lại</span>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<script src="js/jquery.numeric.js"></script>
<script src="js/common.js"></script>
<script>
    $(document).ready(function () 
    {
        var self=this;
        var configulr='<?php echo base_url(); ?>';
        $('#txtsdt').numeric();
        $('#dangkytaikhoan').on('click',function()
        {
            // console.log(self.validatephuhuynh();
            if(self.validatephuhuynh() && typeof($('input[id=dongydieukhoan]:checked').val())!=='undefined'){

                $.ajax({
                    url: configulr+"/site/ajaxuserregisterphuhuynh",
                    type: "POST",
                    data: { 
                        hoten:$('#txthoten').val(),
                        email:$('#txtemail').val(),
                        sdt:$('#txtsdt').val(),
                        pass:$('#txtpass').val()
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $("#boxLoading").show();
                    },
                    success: function (reponse) {
                        if (reponse.kq == true) {
                            alert(reponse.msg);
                            window.location.href=configulr;
                        }
                        else 
                        {
                            alert(reponse.msg);
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
        self.validatephuhuynh=function()
        {
            var btndangky = true;
            var hoten = $('#txthoten').val();
            var email = $('#txtemail').val();
            var sdt = $('#txtsdt').val();
            var pass = $("#txtpass").val();
            var repass = $("#txtrepass").val();
            var regex_sdt =  /((09|03|07|08|05)+([0-9]{8})\b)/g;
            var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            
            if ($.trim(email) !== '') 
            {
                if (regex_email.test(email) == false) 
                {
                    $('#email').attr('title', 'Email không phù hợp').tooltip('show').addClass('errorClass');
                    $('#txtemail').focus();
                    return false;
                }
                else 
                {
                     $('#email').data("title", "").removeClass("errorClass");
                }
            } 
            else 
            {
                $('#email').attr('title', 'Vui lòng nhập email').tooltip('show').addClass('errorClass');
                $('#txtemail').focus();
                return false;
            }

            if (hoten == '') 
            {
                if($('#hoten').hasClass('errorClass') == false)
                {
                   $('#hoten').attr('title', 'Vui lòng nhập họ tên.').tooltip('show').addClass('errorClass');
                }
                $('#txthoten').focus();
                return false;
            } 
            else 
            {
                $('#hoten').data("title", "").removeClass("errorClass");
            }

            if ($.trim(sdt) !== '') 
            {
                if (regex_sdt.test(sdt) == false) 
                {
                    $('#sdt').attr('title', 'Số điện thoại không phù hợp').tooltip('show').addClass('errorClass');
                    $('#txtsdt').focus();
                    return false;
                }

            } 
            else 
            {
                $('#sdt').attr('title', 'Vui lòng nhập số điện thoại').tooltip('show').addClass('errorClass');
                $('#txtsdt').focus();
                return false;
            }

            if ($.trim($('#txtpass').val()) == '') 
            {
                $('#pass').attr('title', 'Vui lòng nhập mật khẩu').tooltip('show').addClass('errorClass');
                $('#txtpass').focus();
                return false;
            } 
            else 
            {
                $('#txtpass').data("title", "").removeClass("errorClass");
            }

            if ($.trim($('#txtrepass').val()) == '') 
            {
                $('#repass').attr('title', 'Vui lòng nhập lại mật khẩu').tooltip('show').addClass('errorClass');
                $('#txtrepass').focus();
                return false;
            } 
            else 
            {
                $('#repass').data("title", "").removeClass("errorClass");
            } 

            if (checkPassword(pass, $('#pass')) == 1) {
                return false;
            }

            if (checkPassword(repass, $('#repass')) == 1) {
                return false;
            }

            if (checkPassword(pass, $('#repass')) == 0 && pass != repass) {
                $('#repass').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
                $('#txtrepass').focus();
                return false;
            }
            return btndangky;
        };
        function checkPassword(pwd, element) {
            var Hoa = 0;
            var Thuong = 0;
            var So = 0;
            if (pwd.length < 6) {
                $(element).tooltip('hide').attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
                $(element).focus();
                return 1;
            }
            $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
            return 0;
        };

        $('#txtemail').keyup(function()
        {
        //Nhap ban phim
            if($('#txtemail').val().length == 0)
            {
                if($('#email').hasClass('errorClass') == false)
                {
                    $('#email').attr('title', 'Vui lòng nhập email').tooltip('show').addClass('errorClass');
                }
                $('#txtemail').focus();
            }
            else
            {
                $('#email').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtemail').blur(function()
        {
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
                if($('#hoten').hasClass('errorClass') == false)
                {
                    $('#hoten').attr('title', 'Vui lòng nhập họ tên').tooltip('show').addClass('errorClass');
                }
                $('#txthoten').focus();

            }
            else
            {
                $('#hoten').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txthoten').blur(function(){
            if($('#txthoten').val() ==''){
                if($('#hoten').hasClass('errorClass') == false){
                    $('#hoten').attr('title', 'Vui lòng nhập họ tên').tooltip('show').addClass('errorClass');                
                } 
                $('#txthoten').focus();
            }
        });

        $('#txtsdt').keyup(function(){
        //Nhap ban phim
            if($('#txtsdt').val().length == 0)
            {
                if($('#sdt').hasClass('errorClass') == false)
                {
                    $('#sdt').attr('title', 'Vui lòng nhập số điện thoại').tooltip('show').addClass('errorClass');
                }
                $('#txtsdt').focus();

            }
            else
            {
                $('#sdt').removeClass("errorClass").tooltip("destroy");
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
            }   
        });
        
        $('#txtpass').keyup(function(){
        //Nhap ban phim
            if($('#txtpass').val().length == 0)
            {
                if($('#pass').hasClass('errorClass') == false)
                {
                    $('#pass').attr('title', 'Vui lòng nhập mật khẩu').tooltip('show').addClass('errorClass');
                }
                $('#txtpass').focus();

            }
            else
            {
                $('#pass').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtpass').blur(function(){
            if($('#txtpass').val() ==''){
                if($('#pass').hasClass('errorClass') == false){
                    $('#pass').attr('title', 'Vui lòng nhập mật khẩu').tooltip('show').addClass('errorClass');                
                } 
                $('#txtpass').focus();
            }
            else
            {
                if ($('#txtpass').val().length <6) 
                {
                    $('#pass').attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
                }
                else
                {
                    $('#pass').removeClass("errorClass").tooltip("destroy");
                }
            }
        });

        $('#txtrepass').keyup(function(){
        //Nhap ban phim
            if($('#txtrepass').val().length == 0)
            {
                if($('#repass').hasClass('errorClass') == false)
                {
                    $('#repass').attr('title', 'Vui lòng nhập lại mật khẩu').tooltip('show').addClass('errorClass');
                }
                $('#txtrepass').focus();
            }
            else
            {
                $('#repass').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtrepass').blur(function(){
            if($('#txtrepass').val() ==''){
                if($('#repass').hasClass('errorClass') == false){
                    $('#repass').attr('title', 'Vui lòng nhập lại mật khẩu').tooltip('show').addClass('errorClass');                
                } 
                $('#txtrepass').focus();
            }
            else
            {
                if($('#txtpass').val() != $('#txtrepass').val())
                {
                    $('#repass').attr('title', 'Nhập lại mật khẩu không đúng').tooltip('show').addClass('errorClass');
                    // $('#txtrepass').focus();
                }
                else{
                    $('#repass').removeClass("errorClass").tooltip("destroy");
                }
            }
        });

        $('#txtrepass').keyup(function(){
        //Nhap ban phim
            if($('#txtrepass').val().length == 0)
            {
                if($('#repass').hasClass('errorClass') == false)
                {
                    $('#repass').attr('title', 'Vui lòng nhập lại mật khẩu').tooltip('show').addClass('errorClass');
                }
                $('#txtrepass').focus();
            }
            else
            {
                $('#repass').removeClass("errorClass").tooltip("destroy");
            }
        });
        $('#txtrepass').blur(function(){
            if($('#txtrepass').val() ==''){
                if($('#repass').hasClass('errorClass') == false){
                    $('#repass').attr('title', 'Vui lòng nhập lại mật khẩu').tooltip('show').addClass('errorClass');                
                } 
                // $('#txtrepass').focus();
            }
            else
            {
                if($('#txtpass').val() != $('#txtrepass').val())
                {
                    $('#repass').attr('title', 'Nhập lại mật khẩu không phù hợp').tooltip('show').addClass('errorClass');
                    // $('#txtrepass').focus();
                }
                else{
                    $('#repass').removeClass("errorClass").tooltip("destroy");
                }
            }
        });
    });
</script>

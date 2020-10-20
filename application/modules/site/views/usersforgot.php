<?php ?>
<header class="logingenaral">
   <div class="container">
        <a href="<?php echo base_url() ?>" class="backurl"><i class="fa fa-backurl"></i></a>
        <div class="logo-login">
            <a href="<?php echo base_url() ?>" title="trang chủ">
               <img src="images/logo-2.png" alt="#" style="background-color:#203043;">
            </a>
         </div>
        <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<section class="padd-0">
    <div class="container">
        <div class="formlogin frmfogotpass">
            <!-- <div class="supportfogotpassword"><a href="#">Hướng dẫn lấy lại mật khẩu</a></div> -->
            <div class="fogotmypassword">
                
                <div class="title">Quên mật khẩu</div>
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span></div>  
                <div class="fogotemail">
                <div class="group-control col-md-12">
                  <label class="control-label required" style="float: left;">Tài khoản quên mật khẩu: </label>
                  <div class="form-control" id="div_emailuser">
                    <input type="text" id="emailuser" name="emailuser" placeholder="Nhập tài khoản email"/>
                  </div>
                  
                </div>
                </div>
                <p>Mời bạn nhập tài khoản Email đã đăng kí. Gia sư 365 sẽ gửi tới bạn hướng dẫn để tạo mật khẩu mới, vui lòng kiểm tra email. </p>
                <a class="btnuserforgotpassword" id="btnusersforgot">Lấy lại mật khẩu</a>
                <div class="linkregister">
                <span>Bạn đã có tài khoản? <a href="<?php echo base_url() ?>dang-nhap-chung">đăng nhập</a></span>
            </div>
            </div>
            
        </div>
    </div>
</section>
<script>
$(document).ready(function() {
  var configulr='<?php echo site_url() ?>';
  var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  $('#btnusersforgot').on('click',function(){
    
    if($('#emailuser').val() =='')
    {
      if($('#div_emailuser').hasClass('errorClass') == false)
      {
        $('#div_emailuser').addClass('errorClass');
        $('#div_emailuser').after('<p id="emailuser_error" style="color:red; float:left">Vui lòng nhập Email.</p>');
      }
      $('#emailuser').focus();
      return false;
    }
    else
    {
      if(regex_email.test($('#emailuser').val()) == false)
      {
        if($('#div_emailuser').hasClass('errorClass') == false)
        {
          $('#div_emailuser').addClass('errorClass');
          $('#div_emailuser').after('<p id="emailuser_error" style="color:red; float:left">Email không đúng định dạng</p>');
        }
        $('#emailuser').focus();
        return false;
      }
      else
      {
        $.ajax({
          url: configulr+"/site/ajaxgetforgotpassword",
          type: "POST",
          data: 
          { 
            email: $('#emailuser').val() 
          },
          dataType: 'json',
          beforeSend: function () 
          {
            $("#boxLoading").show();
          },
          success: function (reponse) 
          {
            if (reponse.kq == true) 
            {
              alert(reponse.data);
              window.location.href=configulr;
            }
            else 
            {
             alert('Tài khoản không tồn tại') ;
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
  });
  $('#emailuser').keyup(function(){
  //Nhap ban phim
    if($('#emailuser').val().length == 0)
    {
      if($('#div_emailuser').hasClass('errorClass') == false)
      {
        $('#div_emailuser').addClass('errorClass');
        $('#div_emailuser').after('<p id="emailuser_error" style="color:red;float:left">Email không được để trống.</p>');
      }
      $('#emailuser').focus();
    }
    else
    {
      $('#div_emailuser').removeClass("errorClass");
      $('#emailuser_error').remove();
    }
  });
  $('#emailuser').blur(function(){
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if($('#emailuser').val() == ''){
      if($('#div_emailuser').hasClass('errorClass') == false){
        $('#div_emailuser').addClass('errorClass');
        $('#div_emailuser').after('<p id="emailuser_error" style="color:red;float:left">Email không được để trống.</p>');
      } 
      $('#emailuser').focus();
    }
    else
    {
      if(regex_email.test($('#emailuser').val()) == false)
      {
        if($('#div_emailuser').hasClass('errorClass') == false)
        {
          $('#div_emailuser').addClass('errorClass');
          $('#div_emailuser').after('<p id="emailuser_error" style="color:red; float:left">Email không đúng định dạng.</p>');
        }
        $('#emailuser').focus();
      }
    }
  });    
});

</script>
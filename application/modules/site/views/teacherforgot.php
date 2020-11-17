<?php ?>
<header class="logingenaral">
  <style>
    @media (max-width: 479px) {
        .note {
          margin-right: 70px !important;
        }
        .img-dkychung {
            margin-left: 27px;
        }
        .btnforgotpassword {
          padding: 0px 20px !important;
        }
    }
    @media (min-width: 768px) and (max-width: 1024px)  {
       .img-dkychung {
        margin-left: -38px;
    }
}
</style>
   <div class="container">
        <a href="<?php echo base_url() ?>gia-su-dang-nhap" class="backurl"><i class="fa fa-backurl"></i></a>
        <div class="logo-login">
            <a href="https://timviec365.com.vn/" title="trang chủ">
               <img src="<?php echo base_url(); ?>upload/images/logo-new2.png" alt="Trang chủ" style="">
            </a>
         </div>
        <a href="<?php echo base_url() ?>dang-ky-chung" class="btn btndangky">Đăng ký</a>
   </div>
</header>
<div id="wait" style="display:none;width:69px;height:89px;position:absolute;top:21%;left:50%;padding:2px; z-index: 1;"><img src='<?php echo base_url(); ?>upload/images/demo_wait.gif' width="64" height="64" /><br>Đang gửi..</div>
<section class="padd-0">
    <div class="container">
        <div class="formlogin frmfogotpass">
            <!-- <div class="supportfogotpassword"><a href="#">Hướng dẫn lấy lại mật khẩu</a></div> -->
            <div class="fogotmypassword">
                
                <div class="title">Quên mật khẩu</div>
                <div class="note"><span>(<b>*</b>) Thông tin bắt buộc</b></span>  </div>  
                <div class="fogotemail">
                <div class="group-control">
                        <label class="control-label required" style="float: left;">Tài khoản quên mật khẩu</label>
                        <div class="form-control" id="div_emailteacher"><input type="text" id="emailuser" name="emailuser" placeholder="Điền tài khoản"/></div>
                        
                </div>
                </div>
                 <p>Mời bạn nhập tài khoản Email đã đăng kí. Gia sư 365 sẽ gửi tới bạn hướng dẫn để tạo mật khẩu mới, vui lòng kiểm tra email.</p>
                <button class="btnforgotpassword" id="btn_teacherforgot">Lấy lại mật khẩu</button>
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

  $('#btn_teacherforgot').on('click',function(){
    
    if($('#emailuser').val() =='')
    {
      if($('#div_emailteacher').hasClass('errorClass') == false)
      {
        $('#div_emailteacher').addClass('errorClass');
        $('#div_emailteacher').after('<p id="emailteacher_error" style="color:red; float:left">Vui lòng nhập Email.</p>');
      }
      $('#emailuser').focus();
      return false;
    }
    else
    {
      if(regex_email.test($('#emailuser').val()) == false)
      {
        if($('#div_emailteacher').hasClass('errorClass') == false)
        {
          $('#div_emailteacher').addClass('errorClass');
          $('#div_emailteacher').after('<p id="emailteacher_error" style="color:red; float:left">Email không đúng định dạng</p>');
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
            $("#wait").css('display', 'block');
            $(".btnforgotpassword").attr('disabled', true);
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
            $("#wait").css('display', 'none');
            $(".btnforgotpassword").attr('disabled', false);
          }
        });
      }
    };
  });

  $('#emailuser').keyup(function(){
    if($('#emailuser').val().length == 0)
    {
      if($('#div_emailteacher').hasClass('errorClass') == false)
      {
        $('#div_emailteacher').addClass('errorClass');
        $('#div_emailteacher').after('<p id="emailteacher_error" style="color:red;float:left">Email không được để trống.</p>');
      }
      $('#emailuser').focus();
    }
    else
    {
      $('#div_emailteacher').removeClass("errorClass");
      $('#emailteacher_error').remove();
    }
  });

  $('#emailuser').blur(function(){
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if($('#emailuser').val() == '')
    {
      if($('#div_emailteacher').hasClass('errorClass') == false)
      {
        $('#div_emailteacher').addClass('errorClass');
        $('#div_emailteacher').after('<p id="emailteacher_error" style="color:red;float:left">Email không được để trống.</p>');
      }
      $('#emailuser').focus();
    }
    else
    {
      if(regex_email.test($('#emailuser').val()) == false)
      {
        if($('#div_emailteacher').hasClass('errorClass') == false)
        {
          $('#div_emailteacher').addClass('errorClass');
          $('#div_emailteacher').after('<p id="emailteacher_error" style="color:red; float:left">Email không đúng định dạng</p>');
        }
        $('#emailuser').focus();
      }
    }
  })


});

</script>
<?php

/**
 * @author lolkittens
 * @copyright 2018
 */
echo  $itemconfirm['kq'];
?>
<div class="container">
 <?php $this->load->view('headerfun'); ?>
</div>
<section class="padd-0">
  <div class="container">
    <br />

    <div class="formlogin frmfogotpass" style="border:1px solid #ccc;border-radius: 4px;padding:10px;">
      <br />
      <?php if ($itemconfirm['kq']) { ?>
          <h3 class="text-center">Đăng ký tài khoản thành công</h3>
          <p>Giasu365 chúc mừng bạn xác thực thành công tài khoản. </p>
          <p>Vui lòng đăng nhập để tìm gia sư miễn phí.</p>
          <p>Giasu365 xin chân thành cảm ơn !!!</p>
      <?php }else{ ?>
          <h3 class="text-center">Xác thực tài khoản tại Timviec365.vn</h3>
          <p  class="text-center">Xác thực tài khoản thất bại !!!</p>
      <?php } ?>           
    </div>


    <div class="linkregister">
      <span>&nbsp;</span>
    </div>
  </div>
</div>
</section>
<script>
  $(document).ready(function () {
    var configulr='<?php echo site_url(); ?>';
    var code = '<?php echo $code; ?>';
    var email = '<?php echo $email; ?>';
    console.log(email);

    if (code != '' && email != '') {
        $.ajax({      
          url: configulr+"/site/ajaxconfirmusersregister",
          type: "POST",
          data: { code: code, usp: email },
          dataType: 'json',
          beforeSend: function () {
            $("#boxLoading").show();
          },
          success: function (obj) {
          if(obj.kq != true){
            alert('Bạn đã kích hoạt thành công');
            window.location.href=configulr+'dang-nhap-chung';
          }else{
            alert('Xác nhận thất bại');
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
</script>
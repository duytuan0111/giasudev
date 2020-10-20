<?php
  if(isset($_SESSION['UserInfo']) || !empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
  }
?>
<section class="padd-0">
  <div class="container">
    <br />
    <div class="formlogin frmfogotpass" style="border:1px solid #ccc;border-radius: 4px;padding:10px;">
      <br />
      <h3 class="text-center">Vui lòng kiểm tra email và xác thực tài khoản của bạn</h3>
    </div> 
    <div class="col-md-12">
      <div class="fun">
        <h5 class="text-center">Nếu bạn chưa nhận được email vui lòng click</h5>
        <span class="btn btn-primary btn-success guilai">Gửi lại email</span>
      </div>
    </div>           
    <div class="linkregister">
      <span>&nbsp;</span>
    </div>
  </div>
</section>
<script>
  $(document).ready(function () {
    var configulr='<?php echo site_url(); ?>';
    $('.guilai').on('click',function(){
        var id = '<?php $tg['UserId']; ?>';
        var name = '<?php $tg["UserName"]; ?>';
        var email = '<?php $tg["EmailAddress"]; ?>';
        var type = '<?php $tg["UserType"]; ?>';
        $.ajax({      
          url: configulr+"/site/sendmail",
          type: "POST",
          data: { 
            id:id, 
            name: name,
            email: email, 
            type: type
          },
          dataType: 'json',
          beforeSend: function () {
            $("#boxLoading").show();
          },
          success: function (reponse) {
            if (reponse.kq == true) 
            {
              alert(reponse.msg);
              // window.location.href=configulr;
            }
          },
          error: function (xhr) {
            console.log(xhr);
          },
          complete: function () {
            $("#boxLoading").hide();
          }
        });
    }) 
  });
</script>
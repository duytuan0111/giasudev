/*************************************


All custom js files contents are below
**************************************
* 01. Company Brand Carousel
* 02. Client Story testimonial
* 03. Bootstrap wysihtml5 editor
* 04. Tab Js
* 05. Add field Script
**************************************/
// var configulr='https://timviec365.vn/giasu365';

// var configulr = 'https://timviec365.com.vn/gia-su/';

var configulr = 'http://localhost:8181/';
(function($) {
  "use strict";
  var um = new UserManager();
  //$(".Loader").fakeLoader({
  //		timeToHide:200,
  //		bgColor:"#1c2733",
  //		spinner:"spinner2"
  //	});	 
  jQuery('#box-contact .more').click(function() {
    if ($(this).hasClass('open')) {
      $(this).removeClass('open');
      $("#box-contact .gt").css('height', '72px');
    } else {
      $(this).addClass('open');
      $("#box-contact .gt").css('height', 'auto');
    }
  });
  $('.slick').slick({
    slidesToShow: 1,
    arrows: true,
    autoplay: false,
    infinite: true,
    dots: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: true,
        centerMode: true,
        slidesToShow: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerPadding: '0px',
        slidesToShow: 1
      }
    }]
  });
  $('.grid-slide-2').slick({
    slidesToShow: 2,
    arrows: false,
    autoplay: true,
    infinite: true,
    responsive: [{
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        slidesToShow: 1
      }
    }, {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerPadding: '0px',
        slidesToShow: 1
      }
    }]
  });
  $('#choose-city').select2();
  $("#simple-design-tab a").on('click', function(e) {
    e.preventDefault();
    $(this).tab('show');
  });
  $('.extra-field-box').each(function() {
    var $wrapp = $('.multi-box', this);
    $(".add-field", $(this)).on('click', function() {
      $('.dublicat-box:first-child', $wrapp).clone(true).appendTo($wrapp).find('input').val('').focus();
    });
    $('.dublicat-box .remove-field', $wrapp).on('click', function() {
      if ($('.dublicat-box', $wrapp).length > 1)
        $(this).parent('.dublicat-box').remove();
    });
  });
  var a = $(".bg");
  a.each(function(a) {
    if ($(this).attr("data-bg")) $(this).css("background-image", "url(" + $(this).data("bg") + ")");
  });

  $('.slideshow-container').slick({
    slidesToShow: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    fade: true,
    cssEase: 'ease-in',
    infinite: true,
    speed: 2000
  });

  function csselem() {
    $(".slideshow-container .slideshow-item").css({
      height: $(".slideshow-container").outerHeight(true)
    });
    $(".slider-container .slider-item").css({
      height: $(".slider-container").outerHeight(true)
    });
  }
  csselem();
  if ($('.col-popover').size() && window.innerWidth >= 1000) {
    var timer, timer2;
    var check = 0;
    $('.col-popover .item_hd').each(function(index, element) {
      $(this).popover({
          trigger: "manual",
          html: true,
          animation: false,
          placement: function(tip, element) {
            var left = $(element).offset().left;
            var windowWidth = $(window).width();
            if (left < windowWidth / 2) {
              return 'right';
            } else {
              return 'left';
            }
          },
          content: function() {
            return "Loading...";
          }
        })
        .on("mouseenter", function() {
          clearTimeout(timer);
          var _this = this;
          $('.col-popover .item_hd', $(this));
          var object_id = $(this).attr('data-object');
          $('.col-popover .item_hd', $(this));
          var object_type = $(this).attr('data-type');
          $('.col-md-4 .item_hd').not(_this).popover('hide');
          var left = $(this).offset().left;
          var windowWidth = $(window).width();
          var width = this.offsetWidth;
          var position = 0;
          var arrow = "";
          if (left < windowWidth / 2) {
            position = -0; //-10
            arrow = "left-arrow";
          } else {
            position = -295; //215;
            arrow = "right-arrow";
          }
          var height = 0; // this.offsetHeight/2;
          timer2 = setTimeout(function() {

            if ($(_this).is(':hover')) {
              $.ajax({
                url: configulr + '/site/quickviewuser',
                type: "POST",
                data: {
                  objid: object_id
                },
                dataType: 'json',
                success: function(data) {
                  $(".popover-content").empty();
                  $(".popover-content").append(data.data);
                  $('#quick-view-box .tooltiptext').addClass(arrow);
                  $('#quick-view-box').css('top', -height);
                  $('#quick-view-box').css('left', position);
                }
              });
              $(_this).popover("show");
            }
            $(".popover").on("mouseleave", function() {
              $('.col-md-4 .item_hd').popover('hide');
            });
          }, 500);
          // $(".popover").on("mouseleave", function () {
          //     $(_this).popover('hide');
          // });


        }).on("mouseleave", function() {
          clearTimeout(timer2);
          var _this = this;
          setTimeout(function() {
            if (!$(".popover:hover").length) {
              $(_this).popover("hide");
            }
          }, 200);
        });
    });
  };
  var inputs = document.querySelectorAll('.inputfile');
  Array.prototype.forEach.call(inputs, function(input) {
    var label = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener('change', function(e) {
      var fileName = '';
      if (this.files && this.files.length > 1)
        fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
      else
        fileName = e.target.value.split('\\').pop();

      if (fileName)
        label.querySelector('span').innerHTML = fileName;
      else
        label.innerHTML = labelVal;
    });

    input.addEventListener('focus', function() {
      input.classList.add('has-focus');
    });
    input.addEventListener('blur', function() {
      input.classList.remove('has-focus');
    });
  });
})(jQuery);

function UserManager() {
  $(".loginform").keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
      if ($('#username').val() == '') {
        $('#username').focus();
      } else if ($('#password').val() == '' && $('#username').val() != '') {
        $('#password').focus();
      } else if ($('#password').val() != '' && $('#username').val() != '') {
        $('#btndangnhap').focus();
        $('#btndangnhap').trigger('click');
      }
    }
  });
  $(".login_user").keypress(function(e) {
    if (e.which === 13) {
      e.preventDefault();
      if ($('#useremail').val() == '') {
        $('#useremail').focus();
      } else if ($('#userpassword').val() == '' && $('#useremail').val() != '') {
        $('#userpassword').focus();
      } else if ($('#userpassword').val() != '' && $('#useremail').val() != '') {
        if (typeof($('#phuhuynhlogin').text()) !== 'undefined') {
          $('#phuhuynhlogin').focus();
          $('#phuhuynhlogin').trigger('click');
        }
        $('#dangnhapgiasu').focus();
        $('#dangnhapgiasu').trigger('click');

      }
    }
  });

  var self = this;
  $('#dangnhapgiasu').on('click', function() {
    var useremail = $('#useremail');
    var userpassword = $('#userpassword');
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (useremail.val() == '') {
      if ($('#div_email_login').hasClass('errorClass') == false) {
        $('#div_email_login').addClass('errorClass');
        $('#div_email_login').after('<p id="emaillogin_error" style="color:red">Vui lòng nhập Email.</p>');
      }
      useremail.focus();
      return false;
    } else {
      if (regex_email.test(useremail.val()) == false) {
        if ($('#div_email_login').hasClass('errorClass') == false) {
          $('#div_email_login').addClass('errorClass');
          $('#div_email_login').after('<p id="emaillogin_error" style="color:red">Email không đúng định dạng.</p>');

        }
        useremail.focus();
        return false;
      } else {
        useremail.removeClass("errorClass");
        $('#emaillogin_error').remove();
      }
    }

    if (userpassword.val() == '') {
      if ($('#div_password_login').hasClass('errorClass') == false) {
        $('#div_password_login').addClass('errorClass');
        $('#div_password_login').after('<p id="passwordlogin_error" style="color:red">Vui lòng nhập password.</p>');
      } else {
        userpassword.removeClass("errorClass");
        $('#passwordlogin_error').remove();
      }
      password.focus();
      return false;

    }


    var cknhatuyendung = 1;
    // if(typeof ($('input[name=rememberlogin]:checked').val())=== "undefined"){
    //     cknhatuyendung=0;
    // }
    $.ajax({

      url: configulr + "/site/loginteacher",
      type: "POST",
      data: {
        username: $('#useremail').val(),
        password: $('#userpassword').val(),
        typelogin: cknhatuyendung
      },
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location.href = configulr;

        } else {

          var clickcomfirm=confirm(reponse.msg);
          if (clickcomfirm==true)
            {
              var useremail = $('#useremail').val();
              $.ajax({
                url: configulr+"/site/forgetmail",
                type: "POST",
                data:{
                  email:useremail
                },
                dataType: 'json',
                success: function (res) 
                { 
                    if (res.kq == true) 
                    {   
                        alert('Vui lòng kiểm tra tin email để nhận mã xác thực kích hoạt tài khoản');
                    }
                    // else 
                    // {
                    //     alert('Gửi email không thành công. Vui lòng kiểm tra lại.');
                    // }
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
          else
            {
              // alert('không có gì');
            }
        }
      },
      error: function(xhr) {
        alert("error");
        
      },
      complete: function() {
        $("#boxLoading").hide();

      }
    });
  });
    
  //========== Đăng nhập ===========
  $('#useremail').keyup(function() {
    //Nhap ban phim
    if ($('#useremail').val().length == 0) {
      if ($('#div_email_login').hasClass('errorClass') == false) {
        $('#div_email_login').addClass('errorClass');
        $('#div_email_login').after('<p id="emaillogin_error" style="color:red">Email không được để trống.</p>');
      }
    } else {
      $('#div_email_login').removeClass("errorClass");
      $('#emaillogin_error').remove();
    }
  });
  $('#userpassword').keyup(function() {
    //Nhap ban phim
    if ($('#userpassword').val().length == 0) {
      if ($('#div_password_login').hasClass('errorClass') == false) {
        $('#div_password_login').addClass('errorClass');
        $('#div_password_login').after('<p id="passwordlogin_error" style="color:red">Password không được để trống.</p>');
      }
    } else {
      $('#div_password_login').removeClass("errorClass");
      $('#passwordlogin_error').remove();
    }
  });

  $('#useremail').blur(function() {
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if ($('#useremail').val() == '') {
      if ($('#div_email_login').hasClass('errorClass') == false) {
        $('#div_email_login').addClass('errorClass');
        $('#div_email_login').after('<p id="emaillogin_error" style="color:red;">Email không được để trống.</p>');
      }
      $('#useremail').focus();
    } else {
      if (regex_email.test($('#useremail').val()) == false) {
        if ($('#div_email_login').hasClass('errorClass') == false) {
          $('#div_email_login').addClass('errorClass');
          $('#div_email_login').after('<p id="emaillogin_error" style="color:red;">Email không đúng định dạng.</p>');
        }
        $('#useremail').focus();
      }

    }
  });

  $('#userpassword').blur(function() {
    if ($('#userpassword').val() == '') {
      if ($('#div_password_login').hasClass('errorClass') == false) {
        $('#div_password_login').addClass('errorClass');
        $('#div_password_login').after('<p id="passwordlogin_error" style="color:red;">Mật khẩu không được để trống</p>');
      }
      $('#userpassword').focus();
    } else {
      if ($('#userpassword').val().length < 6) {
        if ($('#div_password_login').hasClass('errorClass') == false) {
          $('#div_password_login').addClass('errorClass');
          $('#div_password_login').after('<p id="passwordlogin_error" style="color:red;">Mật khẩu phải nhiều hơn hoặc có 6 ký tự</p>');
        }
        $('#userpassword').focus();
      } else {
        $('#div_password_login').removeClass("errorClass");
        $('#passwordlogin_error').remove();
      }
    }
  });
  
  //================================
  $('#phuhuynhlogin').on('click', function() {
    var useremail = $('#useremail');
    var userpassword = $('#userpassword');
    var regex_email = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (useremail.val() == '') {
      if ($('#div_email_login').hasClass('errorClass') == false) {
        $('#div_email_login').addClass('errorClass');
        $('#div_email_login').after('<p id="emaillogin_error" style="color:red">Vui lòng nhập Email.</p>');
      }
      useremail.focus();
      return false;
    } else {
      if (regex_email.test(useremail.val()) == false) {
        if ($('#div_email_login').hasClass('errorClass') == false) {
          $('#div_email_login').addClass('errorClass');
          $('#div_email_login').after('<p id="emaillogin_error" style="color:red">Email không đúng định dạng.</p>');

        }
        useremail.focus();
        return false;
      } else {
        useremail.removeClass("errorClass");
        $('#emaillogin_error').remove();
      }
    }

    if (userpassword.val() == '') {
      if ($('#div_password_login').hasClass('errorClass') == false) {
        $('#div_password_login').addClass('errorClass');
        $('#div_password_login').after('<p id="passwordlogin_error" style="color:red">Vui lòng nhập password.</p>');
      } else {
        userpassword.removeClass("errorClass");
        $('#passwordlogin_error').remove();
      }
      password.focus();
      return false;

    }


    // var cknhatuyendung=1;
    // if(typeof ($('input[name=rememberlogin]:checked').val())=== "undefined"){
    //     cknhatuyendung=0;
    // }
    var cknhatuyendung = 0;
    $.ajax({
      url: configulr + "site/loginusers",
      type: "POST",
      data: {
        username: $('#useremail').val(),
        password: $('#userpassword').val(),
        typelogin: cknhatuyendung
      },
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location.href = configulr;
        } else {
          var clickcomfirm=confirm(reponse.msg);
          if (clickcomfirm==true)
            {
              var useremail = $('#useremail').val();
              $.ajax({
                url: configulr+"/site/forgetmail2",
                type: "POST",
                data:{
                  email:useremail
                },
                dataType: 'json',
                success: function (res) 
                { 
                    if (res.kq == true) 
                    {   
                        alert('Vui lòng kiểm tra tin email để nhận mã xác thực kích hoạt tài khoản');
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
          else
            {
              // alert(reponse.msg);
            }
        }
      },
      error: function(xhr) {
        alert("error");
      },
      complete: function() {
        $("#boxLoading").hide();
      }
    });
  });
  /*
  $('#btnusersforgot').on('click',function(){
      if($('#emailuser').val()!=''){
          $.ajax(
            {
                
                url: configulr+"/site/ajaxgetforgotpassword",
                type: "POST",
                data: { username: $('#emailuser').val() },
                dataType: 'json',
                beforeSend: function () {
                    $("#boxLoading").show();
                },
                success: function (reponse) {
                    if (reponse.kq == true) {
                      alert(reponse.data);
                      var urlredirect=configulr+'/lay-lai-mat-khau&u='+reponse.unam
                      window.location.href=urlredirect;//configulr+'/lay-lai-mk-thanh-cong';                          
                    }
                    else {
                       alert('tài khoản không tồn tại') ;
                    }
                },
                error: function (xhr) {
                    alert("error");
                },
                complete: function () {
                    $("#boxLoading").hide();                      
                }
            }); 
      }else{
          $('#emailuser').addClass('errorClass')
      }
  });
  */
  // $('#btn_teacherforgot').on('click',function(){
  //     if($('#emailuser').val()!=''){
  //         $.ajax(
  //           {                  
  //               url: configulr+"/site/ajaxgetforgotpassword",
  //               type: "POST",
  //               data: { username: $('#emailuser').val() },
  //               dataType: 'json',
  //               beforeSend: function () {
  //                   $("#boxLoading").show();
  //               },
  //               success: function (reponse) {
  //                   if (reponse.kq == true) {
  //                     alert(reponse.data);
  //                     var urlredirect=configulr+'/lay-lai-mat-khau&u='+reponse.unam
  //                     window.location.href=urlredirect;//configulr+'/lay-lai-mk-thanh-cong';                        
  //                   }
  //                   else {
  //                      alert('tài khoản không tồn tại') ;
  //                   }
  //               },
  //               error: function (xhr) {
  //                   alert("error");
  //               },
  //               complete: function () {
  //                   $("#boxLoading").hide();                      
  //               }
  //           }); 
  //     }else{
  //         $('#emailuser').addClass('errorClass')
  //     }
  // });

  $('#btnconfirmpass').on('click', function() {
    if ($('#password').val() != '') {
      $.ajax({
        url: configulr + "/site/ajaxconfirmpass",
        type: "POST",
        data: {
          email: $('#email').val(),
          password: $('#password').val()
        },
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(reponse) {
          if (reponse.kq == true) {
            alert(reponse.mk);
            window.location.href = configulr + 'dang-nhap-chung';
          } else {

            alert('Đổi mật khẩu thất bại');
          }
        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
        }
      });
    }
  })
  $('#btnlogout').on('click', function() {
    $.ajax({
      url: configulr + "/site/logout",
      type: "POST",
      data: {},
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location.reload();
          $(location).attr('href', configulr);
        } else {
          alert(reponse.msg);
        }
      },
      error: function(xhr) {
        alert("error");
      },
      complete: function() {
        $("#boxLoading").hide();
      }
    });

  });
  $('.btnlogout').on('click', function() {
    $.ajax({

      url: configulr + "/site/logout",
      type: "POST",
      data: {},
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location.reload();
          $(location).attr('href', configulr);
        } else {
          alert(reponse.msg);
        }
      },
      error: function(xhr) {
        alert("error");
      },
      complete: function() {
        $("#boxLoading").hide();
      }
    });

  });
  $('#citycandi').change(function() {
    //alert($(this).val()); 
    var tinhthanh = $(this).val();

    if (tinhthanh != '' || tinhthanh != 0) {
      $.ajax({

        url: configulr + "/site/GetListDistrict",
        type: "POST",
        data: {
          province: tinhthanh
        },
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(obj) {
          var strhtml = '<option value="">Ch?n Qu?n, Huy?n</option>';
          if (obj.kq != '') {
            var reponse = obj.kq;
            $("#districtcandi option").remove();
            var o1 = new Option('Ch?n qu?n huy?n', '');
            $("#districtcandi").append(o1);
            for (var i = 0; i < reponse.length; i++) {
              //strhtml+="<option value='"+reponse[i].cit_name+"'>"+reponse[i].cit_name+"</option>";
              var o = new Option(reponse[i].cit_name, reponse[i].cit_name);
              $("#districtcandi").append(o);

            }

            //$("#district").html=strhtml;
            //document.getElementById('district').innerHTML=strhtml;
            //$("#districtcandi").selectpicker('refresh');
          } else {
            //alert('không t?n t?i');
          }
        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
        }
      });
    }
  });
  $('.dangkyungvien').on('click', function() {
    if (self.validateregister()) {
      var hoten = $('#namecandi').val();
      var phone = $("#phonecandi").val();
      var email = $("#emailcandi").val();
      var pass = $("#passcandi").val();
      var city = $('#citycandi').val();
      /* moi bo xung*/
      var district = $('#districtcandi').val();
      /*thong tin them*/
      var school = $('#school').val();
      var schooltype = $('#schooltype').val();
      var xeploaihoctap = $('#xeploaihoctap').val();
      var languagecandi = $('#languagecandi').val();
      /*ket thuc moi bo xung*/
      var ngaysinh = $('#txtngaysinh').val();
      var gioitinh = $('#candisex').val();
      var honnhan = $('#candimarriage').val();
      var cvtitle = $('#jobwish').val();
      var bangcap = $('#candibangcap').val();
      var hinhthuclamviec = $('#candihtlv').val();
      var capbac = $('#candicapbac').val();
      var noilamvieckhac = $('#citycandimore').val();
      var nganhnghe = $('#candicategory').val();
      var nganhnghe1 = $('#candicategorymore').val();
      var nganhnghe2 = $('#candicategorymore2').val();
      //var extrann=nganhnghe1+','+nganhnghe2;
      var muctieu = $('#canditarget').val();
      var kynang = $('#candiskill').val();
      var diachi = $('#diachicandi').val();
      var mucluong = $('#salarycandi').val();
      var kinhnghiem = $('#candiexp').val();
      $.ajax({

        url: configulr + "/site/registercandi",
        type: "POST",
        data: {
          hoten: hoten,
          phone: phone,
          email: email,
          city: city,
          pass: pass,
          ngaysinh: ngaysinh,
          gioitinh: gioitinh,
          honnhan: honnhan,
          cvtitle: cvtitle,
          bangcap: bangcap,
          hinhthuclamviec: hinhthuclamviec,
          capbac: capbac,
          noilamvieckhac: noilamvieckhac,
          nganhnghe: nganhnghe,
          nganhnghe1: nganhnghe1,
          nganhnghe2: nganhnghe2,
          muctieu: muctieu,
          kynang: kynang,
          diachi: diachi,
          mucluong: mucluong,
          kinhnghiem: kinhnghiem,
          district: district,
          school: school,
          schooltype: schooltype,
          xeploaihoctap: xeploaihoctap,
          languagecandi: languagecandi
        },
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(reponse) {
          if (reponse.kq == true) {
            alert(reponse.msg);
          } else {}
        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
          //window.location = configulr;
        }
      });
    }
  })
  $('.dangkynhatuyendung').on('click', function() {
    var hoten = $('#namecompany').val();
    var phone = $("#phonecompany").val();
    var email = $("#usercompany").val();
    var pass = $("#passcompany").val();
    var repass = $("#repasscompany").val();
    var term = $('input[name=company-terms]:checked').val();
    var city = $('#citycompany').val();
    var website = $('#websitecompany').val();
    var addresscom = $('#addresscompany').val();
    if (self.validatecomregister()) {
      $.ajax({
        url: configulr + "/site/registercompany",
        type: "POST",
        data: {
          tencongty: hoten,
          phone: phone,
          email: email,
          city: city,
          pass: pass,
          website: website,
          addresscom: addresscom
        },
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(reponse) {
          if (reponse.kq == true) {
            alert(reponse.msg);
            window.location = configulr;
          } else {

          }
        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
          //window.location = configulr;
        }
      });
    }
  })
  //Check valid register
  self.validateregister = function() {
    var flag = true;
    var hoten = $('#namecandi').val();
    var phone = $("#phonecandi").val();
    var email = $("#emailcandi").val();
    var pass = $("#passcandi").val();
    var repass = $("#repasscandi").val();
    var term = $('input[name=user-terms]:checked').val();
    var city = $('#citycandi').val();
    var ngaysinh = $('#txtngaysinh').val();
    if ($.trim(ngaysinh) == '') {
      $($('#txtngaysinh')).attr('data-original-title', 'Nh?p ngày sinh').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#txtngaysinh').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    var gioitinh = $('#candisex').val();
    if ($.trim(gioitinh) == '0') {
      $('#candisex').addClass('errorClass');
    } else {
      $('#candisex').removeClass('errorClass');
    }
    var honnhan = $('#candimarriage').val();
    if ($.trim(honnhan) == '0') {
      $('#candimarriage').addClass('errorClass');
    } else {
      $('#candimarriage').removeClass('errorClass');
    }
    var cvtitle = $('#jobwish').val();
    var bangcap = $('#candibangcap').val();
    if ($.trim(bangcap) == '0') {
      $('#candibangcap').addClass('errorClass');
    } else {
      $('#candibangcap').removeClass('errorClass');
    }
    var hinhthuclamviec = $('#candihtlv').val();
    if ($.trim(hinhthuclamviec) == '0') {
      $('#candihtlv').addClass('errorClass');
    } else {
      $('#candihtlv').removeClass('errorClass');
    }
    var capbac = $('#candicapbac').val();
    if ($.trim(capbac) == '0') {
      $('#candicapbac').addClass('errorClass');
    } else {
      $('#candicapbac').removeClass('errorClass');
    }
    var nganhnghe = $('#candicategory').val();
    if ($.trim(nganhnghe) == '0') {
      $('#candicategory').addClass('errorClass');
    } else {
      $('#candicategory').removeClass('errorClass');
    }
    var muctieu = $('#canditarget').val();
    if ($.trim(muctieu) == '') {
      $($('#canditarget')).attr('data-original-title', 'Nh?p m?c tiêu').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#canditarget').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    var kynang = $('#candiskill').val();
    if ($.trim(kynang) == '') {
      $($('#candiskill')).attr('data-original-title', 'Nh?p k? nang').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#candiskill').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    if ($.trim(hoten) == '') {
      $($('#namecandi')).attr('data-original-title', 'Nh?p h? tên').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#namecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(phone) == '') {
      $($('#phonecandi')).attr('data-original-title', 'Nh?p s? di?n tho?i').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#phonecandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(email) == '') {
      $($('#emailcandi')).attr('data-original-title', 'Nh?p d?a ch? email').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#emailcandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(email) != '') {
      if (!Common.IsValidEmail(email)) {
        $($('#emailcandi')).attr('data-original-title', 'Email không h?p l?').tooltip('show').addClass('errorClass');
        flag = false;
      } else {
        $('#emailcandi').data("title", "").removeClass("errorClass").tooltip("destroy");
      }
    }
    if ($.trim(pass) == '') {
      $($('#passcandi')).attr('data-original-title', 'Nh?p m?t kh?u').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#passcandi').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    if (checkPassword(pass, $('#passcandi')) == 1) {
      flag = false;
    }
    if (checkPassword(repass, $('#repasscandi')) == 1) {
      flag = false;
    }

    if (checkPassword(pass, $('#repasscandi')) == 0 && pass != repass) {
      $($('#passcandi')).attr('title', 'Nh?p l?i m?t kh?u không phù h?p').tooltip('show').addClass('errorClass');
      flag = false;
    }

    if ($.trim(term) != 'ok') {
      $('#user-terms').addClass('errorClass');
      flag = false;
    } else {

    }
    if (city == '0') {
      flag = false;

    }
    return flag;
  };


  self.validatecomregister = function() {
    var flag = true;

    var hoten = $('#namecompany').val();
    var phone = $("#phonecompany").val();
    var email = $("#usercompany").val();
    var pass = $("#passcompany").val();
    var repass = $("#repasscompany").val();
    var term = $('input[name=company-terms]:checked').val();
    var city = $('#citycompany').val();
    var website = $('#websitecompany').val();
    var addresscom = $('#addresscompany').val();

    if ($.trim(addresscom) == '') {
      $($('#addresscompany')).attr('data-original-title', 'Nh?p d?a ch? Công ty').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#addresscompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    if ($.trim(hoten) == '') {
      $($('#namecompany')).attr('data-original-title', 'Nh?p tên công ty').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#namecompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(phone) == '') {
      $($('#phonecompany')).attr('data-original-title', 'Nh?p s? di?n tho?i').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#phonecompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(email) == '') {
      $($('#usercompany')).attr('data-original-title', 'Nh?p d?a ch? email').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#usercompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }

    if ($.trim(email) != '') {
      if (!Common.IsValidEmail(email)) {
        $($('#usercompany')).attr('data-original-title', 'Email không h?p l?').tooltip('show').addClass('errorClass');
        flag = false;
      } else {
        $('#usercompany').data("title", "").removeClass("errorClass").tooltip("destroy");
      }
    }
    if ($.trim(pass) == '') {
      $($('#passcompany')).attr('data-original-title', 'Nh?p m?t kh?u').tooltip('show').addClass('errorClass');
      flag = false;
    } else {
      $('#passcompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    if (checkPassword(pass, $('#passcompany')) == 1) {
      flag = false;
    }
    if (checkPassword(repass, $('#repasscompany')) == 1) {
      flag = false;
    }

    if (checkPassword(pass, $('#repasscompany')) == 0 && pass != repass) {
      $($('#passcompany')).attr('title', 'Nh?p l?i m?t kh?u không phù h?p').tooltip('show').addClass('errorClass');
      flag = false;
    }

    if ($.trim(term) != 'ok') {
      $('.checkboxcom').addClass('errorClass');
      flag = false;
    } else {
      $('.checkboxcom').removeClass('errorClass');
    }
    if (city == '0') {
      $($('#citycompany')).attr('title', 'Ch?n t?nh thành').tooltip('show').addClass('errorClass');
      flag = false;

    } else {
      $('#citycompany').data("title", "").removeClass("errorClass").tooltip("destroy");;
    }
    return flag;
  };
}

function checkPassword(pwd, element) {
  var Hoa = 0;
  var Thuong = 0;
  var So = 0;

  if (pwd.length < 6) {
    $(element).attr('title', 'Mật khẩu phải nhiều hơn hoặc có 6 ký tự').tooltip('show').addClass('errorClass');
    return 1;
  }
  //for (i = 0; i < pwd.length; i++) {
  //    a = toAscii(pwd.charAt(i));
  //    if (a >= 65 && a <= 90) {
  //        Hoa = 1;
  //    }
  //    if (a >= 97 && a <= 122) {
  //        Thuong = 1;
  //    }
  //    if (a >= 48 && a <= 57) {
  //        So = 1;
  //    }
  //}
  //if (Hoa == 0) {
  //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? ký t? vi?t hoa').tooltip('fixTitle').addClass('errorClass');
  //    return 1;
  //}
  //else if (Thuong == 0) {
  //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? ký t? vi?t thu?ng').tooltip('fixTitle').addClass('errorClass');
  //    return 1;
  //}
  //else if (So == 0) {
  //    $(element).tooltip('hide').attr('title', 'M?t kh?u ph?i g?m c? s?').tooltip('fixTitle').addClass('errorClass');
  //    return 1;
  //}
  $(element).data("title", "").removeClass("errorClass").tooltip("destroy");
  return 0;

}

function SearchJob() {
  // $('.timvieclam').on('click',function(){
  //        var findkey=$('#findkeyjob').val();
  //        var location=$('#index_dia_diem').val();
  //        var nganhnghe=$('#index_nganhnghe').val();
  //        
  //        $.ajax(
  //              {
  //                  
  //                  url: configulr+"/site/searchjob",
  //                  type: "POST",
  //                  data: { findkey: findkey, location: location,nganhnghe:nganhnghe,type:1 },
  //                  dataType: 'json',
  //                  beforeSend: function () {
  //                      $("#boxLoading").show();
  //                  },
  //                  success: function (reponse) {
  //                      if (reponse.kq == true) {
  //                          window.location=reponse.data;
  //                      }
  //                      
  //                  },
  //                  error: function (xhr) {
  //                      alert("error");
  //                  },
  //                  complete: function () {
  //                      $("#boxLoading").hide();
  //                  }
  //              }); 
  //    })
  //searchcompany
  $('.timdoanhnghiep').on('click', function() {
    var findkey = $('#keyworkcom').val();
    if (findkey != '') {
      $.ajax({

        url: configulr + "/site/searchcompany",
        type: "POST",
        data: {
          findkey: findkey
        },
        dataType: 'json',
        beforeSend: function() {
          $("#boxLoading").show();
        },
        success: function(reponse) {
          if (reponse.kq == true) {
            window.location = reponse.data;
          }

        },
        error: function(xhr) {
          alert("error");
        },
        complete: function() {
          $("#boxLoading").hide();
        }
      });
    } else {
      $('#keyworkcom').addClass('errClass').focus();
    }
  });
  //searchcandi
  $('.timungvien').on('click', function() {
    var findkey = $('#findkeycandi').val();
    var location = $('#candilocation').val();
    var nganhnghe = $('#candinganhnghe').val();

    $.ajax({

      url: configulr + "/site/searchcandi",
      type: "POST",
      data: {
        findkey: findkey,
        location: location,
        nganhnghe: nganhnghe
      },
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location = reponse.data;
        }

      },
      error: function(xhr) {
        alert("error");
      },
      complete: function() {
        $("#boxLoading").hide();
      }
    });
  })
}

function AllClearCooke() {
  $('#xoacookie').on('click', function() {
    $.ajax({

      url: configulr + "/site/delcookiephp",
      type: "POST",
      data: {},
      dataType: 'json',
      beforeSend: function() {
        $("#boxLoading").show();
      },
      success: function(reponse) {
        if (reponse.kq == true) {
          window.location = window.location.href;
        }

      },
      error: function(xhr) {
        alert("error");
      },
      complete: function() {
        $("#boxLoading").hide();
      }
    });
  })
}

function searchteacherbyheader() {

  var nganhnghe = $('#index_nganhnghe').val();
  var diadiem = $('#index_dia_diem').val();
  var lop = $('#index_lop').val();
  var quanhuyen = $('#index_quanhuyen').val();

  $.ajax({
    url: configulr + "site/ajaxsearchteacherheader",
    type: 'POST',
    dataType: "json",
    data: {
      subject: nganhnghe,
      class: lop,
      place: diadiem,
      district: quanhuyen
    },

    success: function(reponse) {
      // $(".main_giaovien").innerHTML = reponse.data;
      $(".main_giaovien").html(reponse.data);
    },
    error: function(xhr) {
      console.log(xhr);
    },
    complete: function() {
      $("#boxLoading").hide();
    }
  });

}

function searchclassbyheader() {

  var nganhnghe = $('#index_nganhnghe').val();
  var diadiem = $('#index_dia_diem').val();
  var lop = $('#index_lop').val();
  var quanhuyen = $('#index_quanhuyen').val();

  $.ajax({
    url: configulr + "site/ajaxsearchclassheader",
    type: 'POST',
    dataType: "json",
    data: {
      subject: nganhnghe,
      class: lop,
      place: diadiem,
      district: quanhuyen
    },
    success: function(reponse) {
      console.log(reponse.da);
      $(".main_lop").html(reponse.data);
    },
    error: function(xhr) {
      console.log(xhr);
    },
    complete: function() {
      $("#boxLoading").hide();
    }
  });

}

function searchbyteachertitle() {

  var nganhnghe = $('#index_nganhnghe').val();
  var diadiem = $('#index_dia_diem').val();
  var lop = $('#index_lop').val();
  var quanhuyen = $('#index_quanhuyen').val();

  $.ajax({
    url: configulr + "site/ajaxsearchteachertitle",
    type: 'POST',
    dataType: "json",
    data: {
      subject: nganhnghe,
      class: lop,
      place: diadiem,
      district: quanhuyen
    },
    success: function(reponse) {
      console.log(reponse.da);
      $(".searchteachertitle").html(reponse.data);
    },
    error: function(xhr) {
      console.log(xhr);
    },
    complete: function() {
      $("#boxLoading").hide();
    }
  });

}

function searchclassbytitle() {

  var nganhnghe = $('#index_nganhnghe').val();
  var diadiem = $('#index_dia_diem').val();
  var lop = $('#index_lop').val();
  var quanhuyen = $('#index_quanhuyen').val();

  $.ajax({
    url: configulr + "site/ajaxsearchclasstitle",
    type: 'POST',
    dataType: "json",
    data: {
      subject: nganhnghe,
      class: lop,
      place: diadiem,
      district: quanhuyen
    },
    success: function(reponse) {
      console.log(reponse.da);
      $(".searchclasstitle").html(reponse.data);
    },
    error: function(xhr) {
      console.log(xhr);
    },
    complete: function() {
      $("#boxLoading").hide();
    }
  });

}
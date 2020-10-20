<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/
$route['default_controller'] = "site/site";
$route['logout'] = "site/logout";
//$route['/login']="site/loginuser";(/:num)?
$route['tim-kiem-lop-hoc']="site/ForTeacher";


//tim-lop-gia-su = tin gia sư tại .....
// $route['tim-lop-gia-su-(:any)-s(:num)l(:num)c(:num).html(/:num)?']="site/listclassbyfilter/$1/$2/$3/$4"; 
//Danh sách lớp cần gia sư
// $route['tim-gia-su&key=(:any)&subject=(:num)&topic=(:num)&place=(:num)&type=(:num)&sex=(:num)(/:num)?']="site/tutorresultfind/$1/$2/$3/$4/$5/$6";
$route['lop-hoc/(:any)-(:num)']="site/DetailClass/$1/$2";
$route['tim-lop-hoc']="site/AllTeacher";
// $route['tim-kiem-gia-su']="site/ForUsers";


 
//link tìm gia sư dành cho seo

$route['(:any)-m(:num)l(:num)t(:num).html(/:num)?']="site/listteacherbyfilter/$1/$2/$3/$4";
$route['(:any)/(:any)-s(:num)r(:num)c(:num).html(/num)?']="site/listteacherbyfilter_clone/$1/$2/$3/$4/$5";
$route['(:any)/(:any)-c(:num)d(:num).html(/:num)?']="site/listteacherbyfilter_TPHCM/$1/$2/$3/$4";

$route['tim-gia-su(:any)keywork=(:any)&subject=(:num)&class=(:num)&place=(:num)&district=(:num).html(/:num)?']="site/searchtutorresultteacher/$1/$2/$3/$4/$5/$6/";
// tìm gia sư theo keyword và city
$route['tim-gia-su(:any)keywork=(:any)&place=(:num).html(/:num)?']="site/searchtteacherbycity/$1/$2/$3/";
//link tìm lớp gia sư
// tìm gia sư theo keyword
$route['tim-gia-su-mon-(:any).html(/:num)?'] = "site/searchtteacherbykeyword/$1/$2/$3";
$route['tim-gia-su-tai-(:any).html(/:num)?'] = "site/searchtteacherbyplace/$1/$2/$3";
//
$route['viec-lam-gia-su-(:any)-s(:num)c(:num)p(:num).html(/:num)?']="site/listclassbyfilter/$1/$2/$3/$4";
$route['viec-lam-gia-su-(:any)/(:any)-m(:num)c(:num)p(:num).html(/num)?']="site/listclassbyfilter_clone/$1/$2/$3/$4/$5"; 
$route['viec-lam-gia-su-(:any)/(:any)-p(:num)d(:num).html(/:num)?']="site/listclassbyfilter_TPHCM/$1/$2/$3/$4";

$route['tim-viec-lam-gia-su(:any)keywork=(:any)&subject=(:num)&class=(:num)&place=(:num)&district=(:num)&type=(:num)&sex=(:num).html(/:num)?']="site/searchtutorresultfind/$1/$2/$3/$4/$5/$6/$7/$8";
// tìm việc làm gia sư theo keyword và city
$route['tim-viec-lam-gia-su(:any)keywork=(:any)&place=(:num).html(/:num)?']="site/searchtutorresultbycity/$1/$2/$3/";
// tìm việc theo keyword
$route['tim-viec-lam-gia-su-mon-(:any).html(/:num)?'] = "site/searchtutorresultbykeyword/$1/$2/$3";
$route['tim-viec-lam-gia-su-tai-(:any).html(/:num)?'] = "site/searchtutorresultbyplace/$1/$2/$3";


//=================
$route['giao-vien&key=(:any)?&subject=(:num)&topic=(:num)&place=(:num)&type=(:num)&sex=(:num)&order=(:any)(/:num)?']="site/tutorresultteacher/$1/$2/$3/$4/$5/$6/$7";
$route['(:any)-gv(:num)']="site/DetailTeacher/$1/$2";
$route['tim-giao-vien-day-kem']="site/TeacherAll";
// $route['tim-giao-vien-day-kem&order=(:num)?(/:num)?']="site/TeacherAll/$1";
$route['tim-giao-vien-day-kem&order=(:any)?(/:num)?']="site/TeacherAll/$1";
$route['dang-nhap-chung']="site/generallogin";
$route['dang-ky-chung']="site/generalregister";
$route['gia-su-dang-nhap']="site/teacherlogin";
$route['phu-huynh-dang-nhap']="site/userlogin";
$route['gia-su-lay-lai-mat-khau']="site/teacherforgot";
$route['tk-lay-lai-mat-khau']="site/usersforgot";
$route['lay-lai-mk-thanh-cong']="site/forgotsuccessall";
$route['lay-lai-mat-khau&u=(:any)&e=(:any)&c=(:any)']="site/ChangeNewPass/$1/$2/$3";
$route['dang-ky-nguoi-dung']="site/phuhuynhdangky";
$route['dang-ky-gia-su']="site/giasudangky";
$route['giao-vien-manager']="site/teacherloginmanager";
$route['mn-giao-vien-tim-lop-day']="site/mnteachsearchuv";
$route['mn-giao-vien-tim-lop-day-theo-mon']="site/mnteachsearchuvbysubject";
$route['mn-giao-vien-tim-lop-day-theo-tt']="site/mnteachsearchbyprovince";
$route['mm-giao-vien-thay-doi-mk']="site/mnteacherchangepass";
$route['mn-danh-sach-lop-de-nghi-day']="site/mnteachervsclass";
$route['mn-danh-sach-lop-moi-day']="site/mnclassvsteacher";
$route['mn-danh-sach-lop-da-day']="site/mnteachervsclassactive";
$route['mn-danh-sach-lop-da-luu']="site/mnteachersaveclass";
$route['mn-gia-su-cap-nhat-thong-tin']="site/mnteacherupdateinfo";
$route['mn-gia-su-nap-tien']="site/mnteacherrecharge";
$route['mn-gia-su-rut-tien']="site/mnteachercashout";
$route['mn-gia-su-qua-tang-km']="site/mnteacherbonus";


$route['phu-huynh-manager']="site/usersloginmanager";
$route['mn-hv-gia-su-da-luu']="site/mnusersteachersave";
$route['mn-hv-gia-su-moi-day']="site/mnusersinviteteacher";
$route['mn-hv-gia-su-phu-hop']="site/mnusersfitteacher";
$route['mn-hv-gia-su-de-nghi-day']="site/mnuserssuggestteacher";
$route['mn-hv-thay-doi-mk']="site/mnuserschangepass";
$route['mn-hv-cai-dat-ho-so']="site/mnuserssetup";
$route['mn-hv-thong-tin-ho-so']="site/mnusersinfomation";
$route['mn-hv-quan-ly-lop-hoc']="site/mnusersclassmanager";
$route['mn-hv-dang-tin(/:num)?']="site/mnuserscreateorupdateclass";


$route['huong-dan-dang-nhap-gia-su']="site/supportteacherlogin";
$route['huong-dan-dang-ky-gia-su']="site/supportteacherregister";
$route['huong-dan-dang-ky-tk']="site/supportusersregister";
$route['huong-dan-dang-nhap-tk']="site/supportuserslogin";


//old function
$route['tim-viec-lam.html(/:num)?']="site/ListJobByFilter";
$route['viec-lam-(:any)-(:any)-c(:num)p(:num).html(/:num)?']="site/ListJobByFilter/$1/$2/$3/$4";
$route['tim-viec-lam&keywork=(:any)?&dd=(:num)&nn=(:num)(/:num)?']="site/resultjobfilter/$1/$2/$3";
$route['nha-tuyen-dung&keywork=(:any)?&c=(:num)&n=(:num)&type=(:num)(/:num)?']="site/ListCompanyByFilter/$1/$2/$3/$4";
$route['dang-tin-tuyen-dung.html']="site/createjobfree";
$route['lien-he']="site/contactus";
//nha tuyen dung&
$route['nguoi-tim-viec.html(/:num)?']="site/ListCandidatebyfilter";
$route['ung-vien-(:any)-(:any)-u(:num)s(:num).html(/:num)?']="site/ListCandidatebyfilter/$1/$2/$3/$4";
$route['tim-ung-vien&keywork=(:any)?&dd=(:num)&nn=(:num)(/:num)?']="site/ResultSearchCandi/$1/$2/$3";
$route['(:any)-job(:num).html']="site/detailjob/$1/$2";
$route['hoan-thien-ho-so.html']="site/hoanthienhoso";

$route['(:any)-ntd(:num).html']="site/DetailCompany/$1/$2";
$route['ung-vien/(:any)-uv(:num).html']="site/DetailCandidate/$1/$2";
$route['dang-nhap']="site/login";
$route['dang-ky']="site/register";

$route['kichhoattaikhoan']="site/confirmuser";
$route['kichhoattaikhoan&c=(:any)&u=(:any)&t=(:num)']="site/confirmuser/$1/$2/$3";

$route['xacnhankichhoattaikhoan']="site/sendmailconfirmuser";
$route['/']="site/index";
$route['(:any)-b(:num).html'] = 'site/show_news/$1/$2';
$route['(:any).html(/:num)?']="site/show_cat_sub/$1";
	

//Xuat excel
$route['xuat-excel-tk'] = 'site/xuat_excel';	
$route['xuat-excel-vl'] = 'site/xuat_excel2';
$route['insert_user'] = 'site/insert_user';
/* End of file routes.php */
/* Location: ./system/application/config/routes.php */


$route['ajaxfileuploadimage'] = 'ajaxfileuploadimage';
$route['ajaxpro'] = 'site/ajaxPro1';
// $route['tim-gia-su&keywork=(:any)?&c=(:num)&n=(:num)&type=(:num)(/:num)?']="site/search_keyword/$1/$2/$3/$4";
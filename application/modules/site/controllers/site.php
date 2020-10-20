<?php 
class site extends Controller
{	
	function site()
	{
		parent::Controller(); 		
		$this->load->model('site_model');	
		$this->load->helper('locdau');	
    $this->load->helper('resize');	
    $this->load->helper('images');	
    $this->load->helper('device');
		//$this->output->enable_profiler(TRUE);	
		//$this->load->library('resize-class'); 
  }   	
  function index()
  {   	
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 

    $data['tinmoinhat']=$this->site_model->GetListTeacher(18); 
    $data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
    $data['vansudia']=$this->site_model->GetListTeacherVSD(5);
    $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
    $data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
    $data['monhoc']=$this->site_model->ListSubject();
    $data['lstitem']=$this->site_model->GetTopClassByMoney(12);
    $data['newitem']=$this->site_model->GetClassTop(20);
    $data['countcity']=$this->site_model->CountClassByCity();
    $data['countsubject']=$this->site_model->Danhsachloptheomonhoc();
    $data['lstonline']=$this->site_model->GetListClassbyUserOnline(); 
    $data['chude']=$this->site_model->GetTeacherFeature();
    $data['districk']=$this->site_model->CountTeacherbyCity();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='content';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  } 

  function generallogin()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
    if(isset($_COOKIE['namephp'])&& $_COOKIE['namephp']!='' && $_SESSION['UserInfo']== ''){
      $result=$this->site_model->GetLoginTeacher($_COOKIE['namephp'],$_COOKIE['puphp']);
      if($result != ""){
        $ip = time();
        $remember=1;
                //$result=json_decode($result,true);
                //var_dump($result->UserId);die();
        $token = $this->site_model->create_token($result->UserID,$ip,$remember);

        $profileData = array("UserId" => $result->UserID,
         "UserName" => $result->UserName,
         "EmailAddress" => $result->Email,
         "FullName" => $result->Name, 
         "Phone"=>$result->Phone,                                
         "TokentKey" => $token,
         "UserType"=>$type);
                                     //var_dump($profileData);die();
        $_SESSION['UserInfo'] = $profileData;


      }
    }
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='generallogin';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }

  function generalregister()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='generalregister';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }
  function supportteacherlogin()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18); 
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='supportteacherlogin';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function supportteacherregister()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18); 
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='supportteacherregister';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function supportusersregister()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18); 
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='supportusersregister';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }function supportuserslogin()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 

        //$data['tinmoinhat']=$this->site_model->GetListTeacher(18); 
        //$data['toanlyhoa']=$this->site_model->GetListTeacherTLH(12);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='supportuserslogin';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function ChangeNewPass($u, $e, $c)
  {
    $data['username']=$u;
    $data['email']=$e;
    $data['code']=$c;
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url()."lay-lai-mat-khau";	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='changenewpass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);
  }
  function teacherlogin()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='teacherlogin';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }
  function teacherforgot()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='teacherforgot';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }
  function usersforgot()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='usersforgot';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }
  function forgotsuccessall()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='forgotsuccessall';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template1',$data);

  }
  function userlogin()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='userlogin';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';	
    $this->load->view('template1',$data);

  }
  function teacherloginmanager()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);

    }
		//$data['amp']=site_url('amp');
    $data['lopday']=$this->site_model->getcountclassvsuser($userid);
    $data['classsave']=$this->site_model->getcountclasssave($userid);
    $data['classinvite']=$this->site_model->getcountclassinvite($userid);
    $data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='teacherloginmanager';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteachsearchuv()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['monhoc']=$this->site_model->ListSubject(); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachsearchuv';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteacherchangepass()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
        //$data['monhoc']=$this->site_model->ListSubject(); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteacherchangepass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function del_uservsclass() {
    $id = $this->input->post('id');
    $result = ['kq' => false, 'msg' => ''];
    if ($id) {
      $del = $this->site_model->del_userclass_by($id);
      if ($del == 1) {
        $result['kq'] = true;
      } else {
        $result['kq'] = false;
      }
      
    }
    echo  json_encode($result);
  }
  function mnteachervsclass()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['uservsclass']=$this->site_model->getfulluservsclass($userid); 

		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachervsclass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnclassvsteacher()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['uservsclass']=$this->site_model->getfullclassvsuser($userid); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnclassvsteacher';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteachervsclassactive()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['uservsclass']=$this->site_model->getfulluservsclassactive($userid); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachervsclassactive';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteachersaveclass()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['monhoc']=$this->site_model->ListSubject(); 
    $data['uservsclass']=$this->site_model->getfullteachersaveclass($userid); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachersaveclass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteacherupdateinfo()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['teachtype']=$this->site_model->GetTeacherType();
    $data['monhoc']=$this->site_model->ListSubject($userid);

    $data['info']=$this->site_model->GetInfoTeacher($userid);
    $infor = $this->site_model->GetInfoTeacher($userid);
    $CityID = $this->site_model->GetInfoTeacher($userid)->CityID;
    $data['tinhthanh']=$this->site_model->ListCity();
    
    $data['quanhuyen']=$this->site_model->ListDistrict($CityID);
     
    $kq=$this->site_model->getusersubject($userid);
    $data['usersubject']=$kq['id'];
    $data['subjectname']=$kq['name'];
    $data['usertopic']=$this->site_model->getusertopic($userid);
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteacherupdateinfo';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteacherrecharge()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['lstbank']=$this->site_model->GetListBank();
    $data['bankused']=$this->site_model->GetBankUsed();		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteacherrecharge';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnteachercashout()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachercashout';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnteacherbonus()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteacherbonus';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnteachsearchbyprovince()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['tinhthanh']=$this->site_model->getprovincebykey(''); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachsearchbyprovince';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnteachsearchuvbysubject()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $data['info']=$this->site_model->GetInfoTeacher($userid);
    }
    $data['monhoc']=$this->site_model->ListSubject(); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnteachsearchuvbysubject';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function usersloginmanager()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";       
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
		//$data['amp']=site_url('amp');
    $data['giasuphuhop']=$this->site_model->countteacherfitclass($userid);
    $data['giaovienluu']=$this->site_model->countteachersave($userid);
    $data['teacherinvite']=$this->site_model->countteacheinvite($userid);
    $data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
    $data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='usersloginmanager';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnusersteachersave()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }

    $data['giasudaluu']=$this->site_model->getpageteachersavebyuserid($userid,1);
    $data['giaovienluu']=$this->site_model->countteachersave($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnusersteachersave';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnusersinviteteacher()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }

    $data['giasudaluu']=$this->site_model->getpageteacherinvitebyuserid($userid,1);
    $data['giaovienluu']=$this->site_model->countteacheinvite($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnusersinviteteacher';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnusersfitteacher()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }

    $data['giasudaluu']=$this->site_model->getpageteacherfitbyuserid($userid,1);
    $data['giaovienluu']=$this->site_model->countteacherfitclass($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnusersfitteacher';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnuserssuggestteacher()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }

    $data['giasudaluu']=$this->site_model->getpageteachersuggestbyuserid($userid,1);
        //$data['giaovienluu']=$this->site_model->countteacherfitclass($userid);
        //$data['teacherinvite']=$this->site_model->countteacheinvite($userid);
        //$data['topteacherinvite']=$this->site_model->getlistteachersavebyuserid($userid);
        //$data['topteachsave']=$this->site_model->getlistteacherinvitebyuserid($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnuserssuggestteacher';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnuserschangepass()
  {

    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
        //$data['monhoc']=$this->site_model->ListSubject(); 
		//$data['amp']=site_url('amp');
        //$data['lopday']=$this->site_model->getcountclassvsuser($userid);
        //$data['classsave']=$this->site_model->getcountclasssave($userid);
        //$data['classinvite']=$this->site_model->getcountclassinvite($userid);
        //$data['topclasssave']=$this->site_model->gettopclassbyuser($userid);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnuserschangepass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnuserssetup()
  {        	
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['uinfo']=$this->site_model->GetUserInfoByUserID($userid);		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnuserssetup';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);

  }
  function mnusersinfomation()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['uinfo']=$this->site_model->GetUserInfoByUserID($userid);		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnusersinfomation';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnusersclassmanager()
  {
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";        
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['uclass']=$this->site_model->getlistclassbyuser($userid,1);
    $countclass=$this->site_model->getcountclassbyuser($userid);
    $data['countclass']=$countclass->solophoc;		
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnusersclassmanager';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('templatemanager',$data);
  }
  function mnuserscreateorupdateclass()
  {
    $idclass=$this->uri->segment(2);
    if(empty($idclass)||intval($idclass)==0){
      $idclass=0;
    }else{
      $idclass=intval($idclass);
    }
    $data['home'] = false;
    $data['meta_title']="Đăng nhập chung";
    $data['meta_key']="Đăng nhập gia sư";
    $data['meta_des']="Đăng nhập gia sư";     
    $data['classid']=$idclass;   
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
    $userid=0;
    if($_SESSION['UserInfo'] !=''){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
    }
    $data['uclass']=$this->site_model->GetFirstClassByUserClassID($idclass,$userid);
    $data['lstitem']=$this->site_model->GetTeacherType(12);
    $data['monhoc']=$this->site_model->ListSubject();
    $data['lop'] 	 = $this->site_model->ListClass();
    $data['IdLopDay'] = explode(',', $data['uclass']->IdLopDay);
    $data['showsearch']=true;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='mnuserscreateorupdateclass';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';
    // var_dump($_SESSION['UserInfo']);
    // die();
    $this->load->view('templatemanager',$data);
  }
  function ForTeacher()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['chude']=$this->site_model->ListTopic();
        //$data['districk']=$this->site_motel->GetListdistrictbycity();

        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');

    $data['robots']= 'noindex,nofollow';	
    $data['content']='forteacher';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';	
    $data['showsearch']=true;
    $data['cssbody']='customsl'	;
    $this->load->view('template',$data);
  }
  function ForUsers()
  {
    $data['home'] = false;		
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 
    $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['chude']=$this->site_model->ListTopic();
        //$data['districk']=$this->site_motel->GetListdistrictbycity();

        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
    $data['canonical']=base_url();	
		//$data['amp']=site_url('amp');

    $data['robots']= 'noindex,nofollow';	
    $data['content']='forusers';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';	
    $data['showsearch']=true;
    $data['cssbody']='customsl'	;
    $this->load->view('template',$data);
  }

  function searchclass()
  {
    $key=$_POST['key'];
    $subject=$_POST['subject'];
    $topic=0;
    $place=$_POST['place'];
    $type=$_POST['type'];
    $sex=$_POST['sex'];
    
      $class = 0;
      $district= 0;
      if(strlen($key)>0){
        $key=str_replace(' ','+', $key);
      }
      else
      {
        $key='0';
      }

      if(intval($subject)>0)
      {
        $subject = $subject;
        $monhoc=$this->site_model->selectsubjectbyid(intval($subject))->SubjectName;
        $monhoc = vn_str_filter($monhoc);
      }
      else
      {
        $subject = 0;
        $monhoc = '';
      }

      if(intval($place)>0)
      {
        $place = $place;
        $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place))->cit_name;
        $tinhthanh = 'tai-'.vn_str_filter($tinhthanh);
        if(intval($district)>0){
          $quanhuyen=$this->site_model->SelectDistrictID(intval($district))->cit_name;
          $quanhuyen = $tinhthanh.'/'.vn_str_filter($quanhuyen);
        }
      }
      else
      {
        $place = 0;
        $district=0;
        $tinhthanh = '';
        $quanhuyen='';
      }

      if(intval($class)>0)
      {
        $class = $class;
        $lop=$this->site_model->SelectClassByid(intval($class))->classname;
        $lop = vn_str_filter($lop);
      }
      else
      {
        $class = 0;
        $lop = '';
      }
      if(intval($type)>0){
        $type = $type;
      }
      else{
        $type = 0;
      }
      if(intval($sex)>0){
        $sex = $sex;
      }
      else{
        $sex = 0;
      }

    // var_dump($key, $subject, $class, $place, $type, $sex);
    // die();
    if(!empty(CheckSubject($subject)) && intval($class)==0 && intval($place)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'-s'.intval($subject).'c0p0.html';
    }
    else if(!empty(CheckClass($class)) && intval($subject)==0 && intval($place)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-'.$lop.'-s0c'.intval($class).'p0.html';
    }
    else if(!empty( CheckCity($place)) && intval($subject)==0 && intval($class)==0 && intval($district)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-'.$tinhthanh.'-s0c0p'.intval($place).'.html';
    }
    else if(!empty(CheckSubject1($subject)) && (intval($place)==1 ||intval($place)==45) && intval($class)==0 && intval($district)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'/'.$tinhthanh.'-m'.intval($subject).'c0p'.intval($place).'.html';
    }
    else if(!empty(CheckSubject1($subject)) && !empty(CheckClass($class)) && intval($place)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'/'.$lop.'-m'.intval($subject).'c'.intval($class).'p0.html'; 
    }
    else if(intval($place)==45 && intval($district)>0 && intval($subject)==0 && intval($class)==0 && strlen($key)>0 && intval($type)==0 && intval($sex)==0)
    {
      $link=base_url().'viec-lam-gia-su-'.$quanhuyen.'-p45d'.intval($district).'.html';
    }
    else
    {
      $link=base_url()."tim-viec-lam-gia-su?keywork=".$key."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district)."&type=".intval($type)."&sex=".intval($sex).'.html'; 
    }

    $result=['kq'=>true,'data'=>$link];
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
  }

  function searchteacherheader()
  {
    $result = [];
    $key = $_POST['key'];
    $subject=$_POST['subject'];
    $place=$_POST['place'];
    $class = $_POST['class'];
    $district= $_POST['district'];
    if(!empty($key)){
      $key = str_replace(' ','+',trim($key));
      // $key1=$this->site_model->Selectkey($key)->Name;
    }
    else
    {
      $key= "0";
    }
    if(intval($subject)>0)
    {
      $subject1 = intval($subject);
      $monhoc=$this->site_model->selectsubjectbyid($subject1)->SubjectName;
      
      $monhoc = vn_str_filter($monhoc);
    }
    else
    {
      $subject = 0;
      $monhoc = '';
    }
    if(intval($place)>0)
    {
      $place = $place;
      $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place))->cit_name;
      $tinhthanh = 'tai-'.vn_str_filter($tinhthanh);
      if(intval($district)>0){
        $quanhuyen=$this->site_model->SelectDistrictID(intval($district))->cit_name;
        $quanhuyen = $tinhthanh.'/'.vn_str_filter($quanhuyen);
      }
    }
    else
    {
      $place = 0;
      $district=0;
      $tinhthanh = '';
      $quanhuyen='';
    }

    if(intval($class)>0)
    {
      $class = $class;
      $lop=$this->site_model->SelectClassByid(intval($class))->classname;
      $lop = vn_str_filter($lop);
    }
    else
    {
      $class = 0;
      $lop = '';
    }

   
//=====(:any)-m(:num)l(:num)t(:num).html(/:num)?
    if((!empty(CheckSubject($subject)) && intval($class)==0 && intval($place)==0) && empty($key))
    {
      $link=base_url().'mon-'.$monhoc.'-m'.intval($subject).'l0t0.html';
    }
    else if(!empty(CheckClass($class)) && intval($subject)==0 && intval($place)==0 && empty($key))
    {
      $link=base_url().$lop.'-m0l'.intval($class).'t0.html';
    }
    else if(!empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0 && empty($key))
    {
      $link=base_url().$tinhthanh.'-m0l0t'.intval($place).'.html';
    }
//=====(:any)/(:any)-s(:num)r(:num)c(:num).html
    else if(!empty(CheckSubject1($subject)) && (intval($place)==1 ||intval($place)==45) && intval($class)==0 && intval($district)==0 && empty($key))
    {
      $link=base_url().'mon-'.$monhoc.'/'.$tinhthanh.'-s'.intval($subject).'r0c'.intval($place).'.html';
    }
    else if(!empty(CheckSubject1($subject)) && !empty(CheckClass($class)) && intval($place)==0 && empty($key))
    {
      $link=base_url().'mon-'.$monhoc.'/'.$lop.'-s'.intval($subject).'r'.intval($class).'c0.html'; 
    }
//=====(:any)/(:any)-c(:num)d(:num).html(/:num)
    else if(intval($place)==45 && intval($district)>0 && intval($subject)==0 && intval($class)==0 && empty($key))
    {
      $link=base_url().$quanhuyen.'-c45d'.intval($district).'.html';
    }
//===='tim-gia-su?key=(:any)&subject=(:num)&topic=(:num)&place=(:num)&district=(:num)&type=(:num)&sex=(:num)&order=(:any)(/:num)
    else if(!empty($key) && !empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $link=base_url()."tim-gia-su?keywork=".$key."&place=".intval($place).'.html';
    }
    else if(!empty($key) && empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $link=base_url()."tim-gia-su?keywork=".$key."&place=".intval($place).'.html';
    }
    else if (empty($key) && empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $result['blank'] = true;
    }
    else
    { 
      
      $link=base_url()."tim-gia-su?keywork=".$key."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district).'.html'; 
      
    }

    
    $result['kq'] = true; 
    $result['data'] = $link;
    echo json_encode($result,JSON_UNESCAPED_UNICODE);
   
  }

  function tutorresultteacher($keywork,$subject,$topic,$place,$type,$sex,$order)
  {

    $page=$start_row=$this->uri->segment(2);
    if (isset($_POST['district'])) {
      $district = $_POST['district'];
    } else {
      $district = '';
    }
    $data['home'] = false;	
    $data['showsearch']=true;	
    $sql=$this->site_model->gettblwidthid('tbl_meta',1);
    $data['meta_title']=$sql->title;
    $data['meta_key']=$sql->metakeywork;
    $data['meta_des']=$sql->metadesc;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    } 
    $perpage=10;
    if(empty($page)||intval($page)==0){
      $page=0;
    }else{
      $page=intval($page);
    }
    if($page <= 10){
      $data['robots']= 'noindex,nofollow';
    }else{
     $data['robots']= 'noindex,nofollow'; 
   }
   $data['keywork']=$keywork;
   $class = '';
   // $order = 'last';
   $result=$this->site_model->GetListTeacherBySearch($keywork,$subject,$class,$topic,$place,$district,$type,$sex,$order,0,20);
   $link=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".$order;
   $data['lstitem']=$result['data'];
  //  var_dump($data['lstitem']);
  //  die();
   $this->load->library('pagination');
   $config['total_rows'] = $result['total'];
   $config['per_page'] = $perpage;
   $config['uri_segment'] =2;
   $config['next_link'] = '<i class="fa fa-angle-right"></i>';
   $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
   $config['num_links'] = 4;
   $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
   $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
   $config['base_url']=$link;
   $this->pagination->initialize($config);	
   $data['total']=$result['total'];
   $data['order']=$order;
   $data['start_row']= $page;
   $data['pagination']= $this->pagination->create_links();
   $data['monhoc']=$this->site_model->ListSubject(); 
   $data['chude']=$this->site_model->GetTeacherFeature();
   $data['districk']=$this->site_model->CountTeacherbyCity();
   $data['lstonline']=$this->site_model->GetTeacherOnline(10);
   $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=";
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
   $data['topkey'] = $this->site_model->ListTopKeywork();
   $data['canonical']=base_url()."giao-vien";	
		//$data['amp']=site_url('amp');

   $data['robots']= 'noindex,nofollow';	
   $data['content']='searchtutorresultteacher';
   $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']=''	;//customsl
        $data['showsupport']=true;
  
        $this->load->view('template',$data);
      }

      function searchtutorresultteacher($alias,$keywork,$subject,$class,$place,$district)
      {
        
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;  
        $data['showsearch']=true; 
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        $lop=$this->site_model->SelectClassByid(intval($class));
        $classname=$lop->classname;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $perpage=10;
        if(empty($page)||intval($page)==0){
          $page=0;
        }else{
          $page=intval($page);
        }
        if($page <= 10){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $keywork = str_replace("+", " ",  urldecode($keywork));
       $order = 'last';

       $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'place'=>$place,'district' => $district];
       $result=$this->site_model->ListTeacherBySearchHeader($keywork,$subject,$class,$place,$district,$order,$page,$perpage);

      $data['keywork']=$keywork;
    
      $data['topkey'] = $this->site_model->ListTopKeywork();

     
      // echo "<script type='text/javascript'>alert('$keywork');</script>";
      // die();
       $link=base_url()."tim-gia-su?keywork=".$keywork."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district).'.html';
      //  var_dump( $link);
      //  die();
      
       $data['lstitem']=$result['data'];
       
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
      
       $config['per_page'] = $perpage;
      
       $config['uri_segment'] =2;
       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
      
       $this->pagination->initialize($config);  
       $data['total']=$result['total'];
       
       $data['order']=$order;
      
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
       
       $data['monhoc']=$this->site_model->ListSubject(); 
       $data['chude']=$this->site_model->GetTeacherFeature();
      
       $data['districk']=$this->site_model->CountTeacherbyCity();
       $data['lstonline']=$this->site_model->GetTeacherOnline(10);
       $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".intval($order);

       $data['canonical']=base_url()."giao-vien"; 

       $data['robots']= 'noindex,nofollow'; 
       $data['content']='searchtutorresultteacher';
       $data['classheader']='navbar navbar-default white bootsnav on no-full';  
        $data['cssbody']='' ;//customsl
        $data['showsupport']=true;
        
        // var_dump($result['data']);
        // die();
        $this->load->view('template',$data);
      }
      function searchtteacherbycity($alias,$keywork,$place,$district)
      {
        $subject = '';
        $class = '';
        $district = '';
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;  
        $data['showsearch']=true; 
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        $lop=$this->site_model->SelectClassByid(intval($class));
        $classname=$lop->classname;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $perpage=10;
        if(empty($page)||intval($page)==0){
          $page=0;
        }else{
          $page=intval($page);
        }
        if($page <= 10){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $keywork = str_replace("+", " ",  urldecode($keywork));
       $order = 'last';

       $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'place'=>$place,'district' => $district];
       
       $result=$this->site_model->ListTeacherBySearchHeader($keywork,$subject,$class,$place,$district,$order,$page,$perpage);

      $data['keywork']=$keywork;
    
      $data['topkey'] = $this->site_model->ListTopKeywork();

     
      // echo "<script type='text/javascript'>alert('$keywork');</script>";
      // die();
       $link=base_url()."tim-gia-su?keywork=".$keywork."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district).'.html';
      //  var_dump( $link);
      //  die();
      
       $data['lstitem']=$result['data'];
       
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
      
       $config['per_page'] = $perpage;
      
       $config['uri_segment'] =2;
       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
      
       $this->pagination->initialize($config);  
       $data['total']=$result['total'];
       
       $data['order']=$order;
      
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
       
       $data['monhoc']=$this->site_model->ListSubject(); 
       $data['chude']=$this->site_model->GetTeacherFeature();
      
       $data['districk']=$this->site_model->CountTeacherbyCity();
       $data['lstonline']=$this->site_model->GetTeacherOnline(10);
       $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".intval($order);

       $data['canonical']=base_url()."giao-vien"; 

       $data['robots']= 'noindex,nofollow'; 
       $data['content']='searchtutorresultteacher';
       $data['classheader']='navbar navbar-default white bootsnav on no-full';  
        $data['cssbody']='' ;//customsl
        $data['showsupport']=true;
        
        // var_dump($result['data']);
        // die();
        $this->load->view('template',$data);
      }
      // them 
       function searchtteacherbykeyword($alias,$keywork,$place,$district)
      {
        
        $subject = '';
        $class = '';
        $district = '';
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;  
        $data['showsearch']=true; 
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        $lop=$this->site_model->SelectClassByid(intval($class));
        $classname=$lop->classname;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $perpage=10;
        if(empty($page)||intval($page)==0){
          $page=0;
        }else{
          $page=intval($page);
        }
        if($page <= 10){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $keywork = str_replace("+", " ",  urldecode($keywork));
       $order = 'last';

       $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'place'=>$place,'district' => $district];
       $keywork = $alias;
       $result=$this->site_model->ListTeacherBySearchHeader($keywork,$subject,$class,$place,$district,$order,$page,$perpage);

      $data['keywork']=$keywork;
    
      $data['topkey'] = $this->site_model->ListTopKeywork();


       // $link=base_url()."tim-gia-su?keywork=".$keywork."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district).'.html';

       $link=base_url()."tim-gia-su-mon-".$alias.".html";
    
       $data['lstitem']=$result['data'];
       
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
      
       $config['per_page'] = $perpage;
       $config['uri_segment'] = 2;
       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
      
       $this->pagination->initialize($config);  
       $data['total']=$result['total'];
       
       $data['order']=$order;
      
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
       
       $data['monhoc']=$this->site_model->ListSubject(); 
       $data['chude']=$this->site_model->GetTeacherFeature();
      
       $data['districk']=$this->site_model->CountTeacherbyCity();
       $data['lstonline']=$this->site_model->GetTeacherOnline(10);
       $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".intval($order);

       $data['canonical']=base_url()."giao-vien"; 

       $data['robots']= 'noindex,nofollow'; 
       $data['content']='searchtutorresultteacher';
       $data['classheader']='navbar navbar-default white bootsnav on no-full';  
        $data['cssbody']='' ;//customsl
        $data['showsupport']=true;
        
        // var_dump($result['data']);
        // die();
        $this->load->view('template',$data);
      }
      function searchtteacherbyplace($alias,$keywork,$place,$district)
      {

        $subject = '';
        $class = '';
        $district = '';
        $alias_new = str_replace('-', ' ', $alias);
        $page=$start_row=$this->uri->segment(2);
        $data['home'] = false;  
        $data['showsearch']=true; 
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        $lop=$this->site_model->SelectClassByid(intval($class));
        $classname=$lop->classname;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $perpage=10;
        if(empty($page)||intval($page)==0){
          $page=0;
        }else{
          $page=intval($page);
        }
        if($page <= 10){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $keywork = str_replace("+", " ",  urldecode($keywork));
       $order = 'last';

       $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'place'=>$place,'district' => $district];
       $keywork = $alias;
       $place = $alias_new;
       $result=$this->site_model->ListTeacherBySearchHeader1($keywork,$subject,$class,$place,$district,$order,$page,$perpage);

      $data['keywork']=$keywork;
    
      $data['topkey'] = $this->site_model->ListTopKeywork();

     
      
       // $link=base_url()."tim-gia-su?keywork=".$keywork."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district).'.html';
      $link=base_url()."tim-gia-su-tai-".$alias.'.html';
      
       $data['lstitem']=$result['data'];
       
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
  
       $config['per_page'] = $perpage;
      
       $config['uri_segment'] =2;

       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
      
       $this->pagination->initialize($config);  
       $data['total']=$result['total'];
       
       $data['order']=$order;
      
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
       
       $data['monhoc']=$this->site_model->ListSubject(); 
       $data['chude']=$this->site_model->GetTeacherFeature();
      
       $data['districk']=$this->site_model->CountTeacherbyCity();
       $data['lstonline']=$this->site_model->GetTeacherOnline(10);
       $data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".intval($order);

       $data['canonical']=base_url()."giao-vien"; 

       $data['robots']= 'noindex,nofollow'; 
       $data['content']='searchtutorresultteacher';
       $data['classheader']='navbar navbar-default white bootsnav on no-full';  
        $data['cssbody']='' ;//customsl
        $data['showsupport']=true;
        
        // var_dump($result['data']);
        // die();
        $this->load->view('template',$data);
      }

      function getName(){

       $sql="SELECT * FROM class ";
       $query= $this->db->query($sql)->result();
       foreach ($query as $key => $value) {
        echo $a = "'".$value->id. "'" ."=>'".$value->classname."',<br>";
      }

    }
    function test()
    {
      $place = 5;
      $subject=2;
          $query="select ut.*,u.`Name`
    ,u.UserName
    ,u.Phone
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.Address
    ,u.Description
    ,u.UserType
    ,u.CreateDate
    ,u.CreateBy
    ,u.Image
    ,u.Latitude
    ,u.Longitude
    from users as u JOIN userteacher as ut on u.UserID=ut.UserID
    where u.Email <>'' and u.Active=1 and u.UserType=1";
    if(!empty($class)){
        $query.=" OR (ut.TitleView like '%".str_replace(' ','%',$class)."%')";
    }
    if(intval($place) > 0){
        $query.=" OR u.CityID='".intval($place)."'";
    }
    if(intval($subject)>0){
    $query.=" OR u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."'";
    if(intval($topic)>0){
        $query.=" OR TopicID='".intval($topic)."'";
    }
    $query.=")";
}
$total=$this->db->query($query)->num_rows();
$query.=" LIMIT 0,19";
$db_qr = $this->db->query($query);

$tg1="";
if($db_qr->num_rows() > 0)
{
    foreach($db_qr->result() as $itemcat)
    {
        $tg1[]=$itemcat;
    }
}
    }

    function searchteacher()
    {
      $key=$_POST['key'];
      $subject=$_POST['subject'];
      $topic=$_POST['topic'];
      $place=$_POST['place'];
      $type=$_POST['type'];
      $sex=$_POST['sex'];
      if(empty($key)){
        $key="all";
      }
      $order='last';
        // $link=base_url()."tim-gia-su&key=".$key."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex)."&order=".$order;
      $link=base_url()."tim-gia-su&key=".$key."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($place)."&type=".intval($type)."&sex=".intval($sex);

      $result=['kq'=>true,'data'=>$link];
      echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

    function searchclassheader()
    {
      $result = [];
      $key = $_POST['key'];  
      $subject=$_POST['subject'];
      $place=$_POST['place'];
      $class = $_POST['class'];
      $district= $_POST['district'];
      
      if(strlen($key)>0)
      {
        $key=str_replace(' ','+', $key);
      }
      else
      {
        $key = 0;
      }
      if(intval($subject)>0)
      {
        $subject  = $subject;
        $monhoc   =$this->site_model->selectsubjectbyid(intval($subject))->SubjectName;
        $monhoc   = vn_str_filter($monhoc);

      }
      else
      {
        $subject = 0;
        $monhoc = '';
      }
      if(intval($place)>0)
      {
        $place = $place;
        $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place))->cit_name;
        $tinhthanh = 'tai-'.vn_str_filter($tinhthanh);
        if(intval($district)>0){
          $quanhuyen=$this->site_model->SelectDistrictID(intval($district))->cit_name;
          $quanhuyen = $tinhthanh.'/'.vn_str_filter($quanhuyen);
        }
      }
      else
      {
        $place = 0;
        $district=0;
        $tinhthanh = '';
        $quanhuyen='';
      }

      if(intval($class)>0)
      {
        $class = $class;
        $lop=$this->site_model->SelectClassByid(intval($class))->classname;
        $lop = vn_str_filter($lop);
      }
      else
      {
        $class = 0;
        $lop = '';
      }
      if(intval($type)>0){
        $type = $type;
      }
      else{
        $type = 0;
      }
      if(intval($sex)>0){
        $sex = $sex;
      }
      else{
        $sex = 0;
      }

    
    if(!empty(CheckSubject($subject)) && intval($class)==0 && intval($place)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'-s'.intval($subject).'c0p0.html';
    }
    else if(!empty(CheckClass($class)) && intval($subject)==0 && intval($place)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-'.$lop.'-s0c'.intval($class).'p0.html';
    }
    else if(!empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-'.$tinhthanh.'-s0c0p'.intval($place).'.html';
    }
    else if(!empty(CheckSubject1($subject)) && (intval($place)==1 ||intval($place)==45) && intval($class)==0 && intval($district)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'/'.$tinhthanh.'-m'.intval($subject).'c0p'.intval($place).'.html';
    }
    else if(!empty(CheckSubject1($subject)) && !empty(CheckClass($class)) && intval($place)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-mon-'.$monhoc.'/'.$lop.'-m'.intval($subject).'c'.intval($class).'p0.html'; 
    }
    else if(intval($place)==45 && intval($district)>0 && intval($subject)==0 && intval($class)==0 && empty($key))
    {
      $link=base_url().'viec-lam-gia-su-'.$quanhuyen.'-p45d'.intval($district).'.html';
    }
    else if(!empty($key) && !empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $link=base_url()."tim-viec-lam-gia-su?keywork=".$key."&place=".intval($place).'.html';
    }
    else if(!empty($key) && empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $link=base_url()."tim-viec-lam-gia-su?keywork=".$key."&place=".intval($place).'.html';
    }
    else if(empty($key) && empty($place) && intval($subject)==0 && intval($class)==0 && intval($district)==0) {
      $result['blank'] = true;
    }
    else
    {
      $link=base_url()."tim-viec-lam-gia-su?keywork=".$key."&subject=".intval($subject)."&class=".intval($class)."&place=".intval($place)."&district=".intval($district)."&type=".intval($type)."&sex=".intval($sex).'.html'; 
    }

   $result['kq'] = true; 
   $result['data'] = $link;
   echo json_encode($result,JSON_UNESCAPED_UNICODE);
 }
 function CheckMonHoc()
 {

  $monhoc = $_POST['id_monhoc'];
  $a=$this->site_model->SelectMonHoc($monhoc);
  foreach ($a as $key ) 
  {
    echo "<option value='".$key->id."'>".$key->classname."</option>";
  }   
}

function getlopday()
{
  $lop = $_POST['id_lop'];
  $a = $this->site_model->SelectLop($lop);
  foreach ($a as $key) 
  {
    echo "<option value='".$key->ID."'>".$key->SubjectName."</option>";
  }

}
function CheckLopDay() 
{
  $id_lop  = $_POST['id_lop'];
  $a    = $this->site_model->GetLopby($id_lop);
  echo "<option value='".$a->id."'>".$a->classname."</option>";
}

function CheckDiaDiem()
{

  $diadiem = $_POST['id_diadiem'];
  $a = $this->site_model->SelectDiaDiem($diadiem);
  foreach ($a as $key) 
  {
    echo "<option value='".$key->cit_id."'>".$key->cit_name."</option>";
  }
}

function GetDiaDiem()
{

  $diadiem = $_POST['id_diadiem'];
  $a = $this->site_model->SelectDiaDiem($diadiem);
  foreach ($a as $key) 
  {
    echo "<option value='".$key->cit_id."'>".$key->cit_name."</option>";
  }

}

function tutorresultfind($keywork,$subject,$topic,$place,$type,$sex)
{
  $data['home'] = false;	
  $data['showsearch']=true;	
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $class = '';
  $data['lstitem']=$this->site_model->GetListClassBySearch($keywork,$subject,$class,$topic,$place,$type,$sex,0,20);

  $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['chude']=$this->site_model->ListTopic();
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
  $data['canonical']=base_url()."viec-lam-gia-su";	
		//$data['amp']=site_url('amp');

  $data['robots']= 'noindex,nofollow';	
  $data['content']='searchtutorresultfind';
  $data['classheader']='navbar navbar-default white bootsnav on no-full';	
  $data['cssbody']='customsl'	;
  $this->load->view('template',$data);

}
function searchtutorresultfind($alias,$keywork,$subject,$class,$place,$district,$type,$sex)
{
  $classid    = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;  
  $data['showsearch']=true; 
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $keywork = str_replace("+", " ",  urldecode($keywork));
  if(empty($keywork)){
    $keywork = '';
  }
  else
  {
    $keywork = $keywork;
  }


  $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'topic'=>$topic,'place'=>$place,'district' => $district,'type'=>$type,'sex'=>$sex];
  $data['lstitem']=$this->site_model->ListClassBySearchHeader($keywork,$subject,$classid,$place,$district,$order,0,20);
  $data['nav_search'] = 2;
  $data['topkey'] = $this->site_model->ListTopKeywork();
  $data['monhoc']=$this->site_model->ListSubject(); 
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $data['canonical']=base_url()."viec-lam-gia-su"; 
  $data['robots']= 'noindex,nofollow';  
  $data['content']='searchtutorresultfind';
  $data['classheader']='navbar navbar-default white bootsnav on no-full'; 
  $data['cssbody']='customsl' ;
  
  $this->load->view('template',$data);

}
function searchtutorresultbycity($alias,$keywork,$place)
{
  $subject  = '';
  $class    = '';
  $district = '';
  $type     = '';
  $sex      = '';
  $classid    = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;  
  $data['showsearch']=true; 
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $keywork = str_replace("+", " ",  urldecode($keywork));
  if(empty($keywork)){
    $keywork = '';
  }
  else
  {
    $keywork = $keywork;
  }

  $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'topic'=>$topic,'place'=>$place,'district' => $district,'type'=>$type,'sex'=>$sex];
  $data['lstitem']=$this->site_model->ListClassBySearchHeader($keywork,$subject,$classid,$place,$district,$order,0,20);
  $data['nav_search'] = 2;
  $data['topkey'] = $this->site_model->ListTopKeywork();
  $data['monhoc']=$this->site_model->ListSubject(); 
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $data['canonical']=base_url()."viec-lam-gia-su"; 
  $data['robots']= 'noindex,nofollow';  
  $data['content']='searchtutorresultfind';
  $data['classheader']='navbar navbar-default white bootsnav on no-full'; 
  $data['cssbody']='customsl' ;
  
  $this->load->view('template',$data);

}
// 
function searchtutorresultbykeyword($alias,$keywork,$place)
{

  $subject  = '';
  $class    = '';
  $district = '';
  $type     = '';
  $sex      = '';
  $classid    = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;  
  $data['showsearch']=true; 
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $keywork = str_replace("+", " ",  urldecode($keywork));
  if(empty($keywork)){
    $keywork = '';
  }
  else
  {
    $keywork = $keywork;
  }

  $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'topic'=>$topic,'place'=>$place,'district' => $district,'type'=>$type,'sex'=>$sex];
  $keywork = $alias;
  $data['lstitem']=$this->site_model->ListClassBySearchHeader($keywork,$subject,$classid,$place,$district,$order,0,20);
  $data['nav_search'] = 2;
  $data['topkey'] = $this->site_model->ListTopKeywork();
  $data['monhoc']=$this->site_model->ListSubject(); 
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $data['canonical']=base_url()."viec-lam-gia-su"; 
  $data['robots']= 'noindex,nofollow';  
  $data['content']='searchtutorresultfind';
  $data['classheader']='navbar navbar-default white bootsnav on no-full'; 
  $data['cssbody']='customsl' ;
  
  $this->load->view('template',$data);

}
function searchtutorresultbyplace($alias,$keywork,$place)
{

  $alias_new = str_replace('-', ' ', $alias);
  $subject  = '';
  $class    = '';
  $district = '';
  $type     = '';
  $sex      = '';
  $classid    = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;  
  $data['showsearch']=true; 
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $keywork = str_replace("+", " ",  urldecode($keywork));
  if(empty($keywork)){
    $keywork = '';
  }
  else
  {
    $keywork = $keywork;
  }

  $data['keyfilter']=['keywork'=>$keywork,'subject'=>$subject, 'class'=>$class,'topic'=>$topic,'place'=>$place,'district' => $district,'type'=>$type,'sex'=>$sex];
  $place = $alias_new;
  $data['lstitem']=$this->site_model->ListClassBySearchHeader1($keywork,$subject,$classid,$place,$district,$order,0,20);
  $data['nav_search'] = 2;
  $data['topkey'] = $this->site_model->ListTopKeywork();
  $data['monhoc']=$this->site_model->ListSubject(); 
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $data['canonical']=base_url()."viec-lam-gia-su"; 
  $data['robots']= 'noindex,nofollow';  
  $data['content']='searchtutorresultfind';
  $data['classheader']='navbar navbar-default white bootsnav on no-full'; 
  $data['cssbody']='customsl' ;
  
  $this->load->view('template',$data);

}

//
function AllTeacher()
{
  $data['home'] = false;	
  $data['showsearch']=true;	
  $sql=$this->site_model->gettblwidthid('tbl_meta',1);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  } 
  $data['lstitem']=$this->site_model->GetTopClassByMoney(12);
  $data['newitem']=$this->site_model->GetClassTop(20);
  $data['monhoc']=$this->site_model->ListSubject(); 
  $data['countcity']=$this->site_model->CountClassByCity();
  $data['countsubject']=$this->site_model->Danhsachloptheomonhoc();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $data['topkey'] = $this->site_model->ListTopKeywork();

        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
  $data['canonical']=base_url()."tim-gia-su";	
		//$data['amp']=site_url('amp');

  $data['robots']= 'noindex,nofollow';	
  $data['content']='allteacher';
  $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
      }
      function DetailClass($alias,$id)
      {
        $data['home'] = false;	
        $data['showsearch']=true;	

        $itemclass=$this->site_model->GetFirstClass($id);
        if($itemclass !=""){

          $data['meta_title']=$itemclass->MetaTitle;
          $data['meta_key']=$itemclass->MetaKeywork;
          $data['meta_des']=$itemclass->MetaDesc;

          $data['item']=$itemclass;

          $data['monhoc']=$this->site_model->ListSubject();
          $data['relative']=$this->site_model->GetListClassRelative($itemclass->ClassID,$itemclass->SubjectID);
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
          if(isset($_SESSION['viewclass']) || !empty($_SESSION['viewclass'])){
            $tgview=$_SESSION['viewclass'];
            $tgview=explode(',',$tgview);
            $tgview[]=$id;
            if(!in_array($id,$tgview,true)){
              $countview=$this->site_model->addviewclass($id);
              $data['countview']=$countview;
            }else{

              $countview=$this->site_model->getviewclassid($id);
              $data['countview']=$countview;
            }
          }else{
            $countview=$this->site_model->addviewclass($id);
            $data['countview']=$countview;
            $tgview[]=$id;
            $_SESSION['viewclass']=join(',',$tgview);
          }

          $data['canonical']=base_url()."lop-hoc/".vn_str_filter($itemclass->ClassTitle)."-".$itemclass->ClassID;	
          $data['robots']= 'noindex,nofollow';	
          $data['content']='detailclass';
		//$data['amp']=site_url('amp');
        }else{
          redirect(site_url());
        }

        $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
      }
      function DetailTeacher($alias,$id)
      {
        $data['home'] = false;	
        $data['showsearch']=true;	

        $itemclass=$this->site_model->GetFirstTeacher($id);
        if($itemclass !=""){

          $data['meta_title']=$itemclass->Name." | gia sư ".$itemclass->WorkingName." | timviec";
          $data['meta_key']="Gia sư ".$itemclass->WorkingName.", trung tâm gia sư,".$itemclass->TitleView;
          $data['meta_des']=$itemclass->Description;

          $data['item']=$itemclass;
          if(isset($_SESSION['viewteacher']) && !empty($_SESSION['viewteacher'])){
            $tgview=$_SESSION['viewteacher'];

            $tgview=explode(',',$tgview);
            $tgview[]=$id;

            if(in_array(strtolower($id),$tgview,true)===false){
              $countview=$this->site_model->addviewuserid($id);
              $data['countview']=$countview;
            }else{

              $countview=$this->site_model->getviewuserid($id);
              $data['countview']=$countview;
            }
          }else{
            $countview=$this->site_model->addviewuserid($id);
            $tgview[]=$id;
            $_SESSION['viewteacher']=join(',',$tgview);
            $data['countview']=$countview;
          }
          $data['monhoc']=$this->site_model->ListSubject();
        //$data['relative']=$this->site_model->GetListClassRelative($itemclass->ClassID,$itemclass->SubjectID);

          $data['moreteach']=$this->site_model->GetTeacherMore($id);
          $data['lstonline']=$this->site_model->GetTeacherOnline(10);		
          $data['canonical']=base_url()."lop-hoc/".vn_str_filter($itemclass->ClassTitle)."-".$itemclass->ClassID;	
          $data['robots']= 'noindex,nofollow';	
          $data['content']='detailteacher';
          $data['topic']=$this->site_model->GetTopicbyUserID($id);
        }else{
          redirect(site_url());
        }
        $data['showcontact']=true;
        $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);
      }
      function TeacherAll($order)
      {
        if(!isset($order)||empty($order)){
          $order='last';
        }
        $page=(!empty($this->uri->segment(2)))?$this->uri->segment(2):0;
        $data['home'] = false;	
        $data['showsearch']=true;	
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $perpage=10;
        
        
        if($page <= 10){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $keywork='';
       $subject=0;$topic=0;$place=0;$type=1;$sex=0;$class=0;
       $data['keywork']=$keywork;
        $data['topkey'] = $this->site_model->ListTopKeywork();

       // $order='last';
       $result=$this->site_model->GetListTeacherBySearch($keywork,$subject,$class,$topic,$place,$district,$type,$sex,$order,$page,$perpage);

  
       // $link=base_url()."tim-giao-vien-day-kem&order=".$order;
       $link=base_url()."tim-giao-vien-day-kem&order=".$order;
       $data['lstitem']=$result['data'];
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
       $config['per_page'] = $perpage;
       $config['uri_segment'] =2;
       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
       
       $this->pagination->initialize($config);	
       $data['total']=$result['total'];
       $data['order']=$order;
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
       $data['monhoc']=$this->site_model->ListSubject(); 
       $data['chude']=$this->site_model->GetTeacherFeature();
       $data['districk']=$this->site_model->CountTeacherbyCity();
       $data['lstonline']=$this->site_model->GetTeacherOnline(10);
       $data['selectbox']=base_url()."tim-giao-vien-day-kem&order=";
       $data['canonical']=base_url()."tim-giao-vien-day-kem";	
       $data['robots']= 'noindex,nofollow';	
       $data['content']='teacherall';
       $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']=''	;//customsl
        $data['showsupport']=true;
        $this->load->view('template',$data);
      }
      function phuhuynhdangky()
      {
        $data['home'] = false;	
        $data['showsearch']=false;	
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $data['lstitem']=$this->site_model->GetTeacherType(12);
        $data['monhoc']=$this->site_model->ListSubject(); 
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');		
        $data['canonical']=base_url()."tim-gia-su";	
		//$data['amp']=site_url('amp');
        
        $data['robots']= 'noindex,nofollow';	
        $data['content']='phuhuynhdangky';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']='customsl'	;
        $this->load->view('template',$data);

      }
      function giasudangky()
      {
        $data['home'] = false;	
        $data['showsearch']=false;	
        $sql=$this->site_model->gettblwidthid('tbl_meta',1);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        } 
        $data['lstitem']=$this->site_model->GetTeacherType(12);
        $data['monhoc']=$this->site_model->ListSubject(); 		
        $data['canonical']=base_url()."tim-gia-su";	
		//$data['amp']=site_url('amp');
        
        $data['robots']= 'noindex,nofollow';	
        $data['content']='giasudangky';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';	
        $data['cssbody']='customsl'	;//
        $this->load->view('template',$data);
      }
      function GetListDistrict()
      {
        $province = $this->input->post('province');
        $result=$this->site_model->ListDistrictByProvince($province);
        if($result != null){
         echo json_encode(array('kq'=>$result)); 
       }else{
        echo json_encode(array('kq'=>''));
      }

    } 
    function register()
    {    	
      $data['home'] = true;		
      $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Đăng ký tài khoản miễn phí tại website vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']="Đăng ký tài khoản miễn phí tại website vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']="Đăng ký tài khoản miễn phí tại website vieclam24h.net.vn";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }        	
    $data['canonical']=base_url();	
    $data['robots']= 'noindex,nofollow';

    $data['content']='register';
    $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function hoanthienhoso()
  {
    $data['home'] = true;		
    $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Hoàn thiện hồ sơ ứng viên tại vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']="Hoàn thiện hồ sơ ứng viên tại website vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']="Hoàn thiện hồ sơ ứng viên tại website vieclam24h.net.vn";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }        	
    $data['canonical']=base_url();	
    $data['robots']= 'noindex,nofollow';

    $data['content']='hoanthienhoso';
    $data['classheader']='inner-pagenavbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function contactus()
  {
    $data['home'] = true;		
    $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Liên hệ với chúng tôi";//$sql->meta_title;
		$data['meta_key']="Liên hệ với chúng tôi";//$sql->meta_key;
		$data['meta_des']="Liên hệ với chúng tôi";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }        	
    $data['canonical']=base_url();	
    $data['robots']= 'noindex,nofollow';

    $data['content']='contactus';
    $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function createjobfree()
  {
    $data['home'] = true;
		$data['meta_title']="Đăng tin tuyển dụng miễn phí tại timviec365.com";//$sql->meta_title;
		$data['meta_key']="Đăng tin tuyển dụng miễn phí tại website timviec365.com";//$sql->meta_key;
		$data['meta_des']="Đăng tin tuyển dụng miễn phí tại website timviec365.com";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }        	
    $data['canonical']=base_url();	
    $data['robots']= 'noindex,nofollow';

    $data['content']='createjobfree';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function confirmuser($code,$email,$type){ 
    $data['home'] = true;	
        //var_dump($code,$email,$type);	
    $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_title;
		$data['meta_key']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_key;
		$data['meta_des']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }
    $data['code'] = $code;
    $data['email'] = $email;
    $data['type'] = $type;
    $result=$this->site_model->getconfirmuser($code,$email,$type);

    $data['itemconfirm']=$result;

    $data['useremail']=$email;
    $data['canonical']=base_url();	
    $data['robots']= 'noindex,nofollow'; 
    $data['showsearch']=false;	       	
    $data['content']='confirmuser';
    $data['classheader']='navbar navbar-default white bootsnav on no-full';		
    $this->load->view('template',$data);
  }
  function sendmailconfirmuser(){
    $data['home'] = true;   
        $data['meta_title']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_title;
        $data['meta_key']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_key;
        $data['meta_des']="Xác nhận đăng ký tài khoản GIASU365";//$sql->meta_des;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }
        else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['itemconfirm']=$result;
        
        $data['useremail']=$email;
        
        $data['canonical']=base_url();  
        $data['robots']= 'noindex,nofollow'; 
        $data['showsearch']=false;          
        $data['content']='sendmailcomfirmuser';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';     
        $this->load->view('template',$data);
      }
      function forgetmail(){
         $email= $this->input->post('email');
         $kq = $this->site_model->resendmail2($email);
        echo json_encode($kq);
      }
      function forgetmail2(){
        $email= $this->input->post('email');
        $kq = $this->site_model->resendmail3($email);
        echo json_encode($kq);
     }
      function sendmail()
      {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $kq = $this->site_model->resendmail($id,$name,$email,$type);
        echo json_encode($kq);
      }
      function check_mail(){
        $type=$_POST['type'];
        $data=$_POST['data'];
        $kq=$this->site_model->check_mail($type,$data);
        echo $kq;
      }
      function check_sdt(){
        $type=$_POST['type'];
        $data=$_POST['data'];
        $kq=$this->site_model->check_sdt($type,$data);
        echo $kq;
      }
      function registercandi()
      {
        $hoten=$_POST['hoten'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $city=$_POST['city'];
        $ngaysinh=$_POST['ngaysinh'];
        $gioitinh=$_POST['gioitinh'];
        $honnhan=$_POST['honnhan'];
        $cvtitle=$_POST['cvtitle'];
        $bangcap=$_POST['bangcap'];
        $hinhthuclamviec=$_POST['hinhthuclamviec'];
        $capbac=$_POST['capbac'];
        $noilamvieckhac=$_POST['noilamvieckhac'];
        $nganhnghe=$_POST['nganhnghe'];
        //$extrann=['extrann'];
        $muctieu=$_POST['muctieu'];
        $kynang= preg_split('/[\n\r]+/', $_POST['kynang']);
        $diachi=$_POST['diachi'];
        $mucluong=$_POST['mucluong'];
        $kinhnghiem=$_POST['kinhnghiem'];
        $nganhnghe2=$_POST['nganhnghe2'];
        $nganhnghe1=$_POST['nganhnghe1'];
        // mới thêm
        $district=$_POST['district'];
        $school=$_POST['school'];
        $schooltype=$_POST['schooltype'];
        $xeploaihoctap=$_POST['xeploaihoctap'];
        $languagecandi=$_POST['languagecandi'];
        //var_dump($_POST); $district,$school,$schooltype,$xeploaihoctap,$languagecandi
        $result=['kq'=>false];
        if(intval($nganhnghe1) > 0){
          $extrann[]=$nganhnghe1;
        }
        if(intval($nganhnghe2)>0){
          $extrann[]=$nganhnghe2;
        }
        
        $extrann=join(',',$extrann);
        //var_dump($extrann);die();
        $kq=$this->site_model->RegisterCandi($hoten,$email,$pass,$phone,$city,$ngaysinh,$gioitinh,$honnhan,$cvtitle,$bangcap,$hinhthuclamviec,$capbac,$noilamvieckhac,$nganhnghe,$extrann,$muctieu,$kynang,$diachi,$mucluong,$kinhnghiem,$district,$school,$schooltype,$xeploaihoctap,$languagecandi);
        if($kq['userid']>0){
          $result=['kq'=>true,'msg'=>'Bạn vui lòng kiểm tra email để kích hoạt tài khoản'.strtotime($ngaysinh)];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
      }
      function registercompany()
      {
        $tencongty=$_POST['tencongty'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $city=$_POST['city'];
        $pass=$_POST['pass'];
        $website=$_POST['website'];
        $addresscom=$_POST['addresscom'];
        //["tencongty"]=> string(3) "abc" 
        //["phone"]=> string(10) "0913081236" 
        //["email"]=> string(25) "trantronglong87@gmail.com" 
        //["city"]=> string(1) "1" 
        //["pass"]=> string(9) "longtt123" 
        //["website"]=> string(0) "" 
        //["addresscom"]=> string(42) "sá»‘ 41 ngĂµ 179/90 VÄ©nh HÆ°ng HoĂ ng Mai" 
        $kq=$this->site_model->RegisterCompany($tencongty,$phone,$email,$city,$pass,$website,$addresscom);
        if($kq['userid']>0){
          $result=['kq'=>true,'msg'=>'Bạn vui lòng kiểm tra email để kích hoạt tài khoản'];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
      }  
      function delcookiephp()
      {
        $result=['kq'=>false];
        if(isset($_COOKIE['jobedu'])){
          unset($_COOKIE['jobedu']);
          unset($_COOKIE['jobexperion']);
          unset($_COOKIE['joblevel']);
          unset($_COOKIE['jobupdate']);

          $result=['kq'=>true];
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
      } 
      function searchjob()
      {
        $result=['kq'=>false,'data'=>''];
        $findkey=$_POST['findkey'];
        $location=$_POST['location'];
        $nganhnghe=$_POST['nganhnghe'];
        $type=$_POST['type'];
        if(intval($type)<=1){
          if(empty($findkey) && (intval($location)<1) && (intval($nganhnghe)<1)){
            $link=base_url().'tim-viec-lam.html';

          }else if(empty($findkey) && ((intval($location)>=1) || (intval($nganhnghe)>=1))){
            $urltt="";
            if(intval($location)>=1){
              $urltt="-tai-".vn_str_filter(Getcitybyindex($location));
            }
            $urlnn="";
            if(intval($nganhnghe)>=1){
              $urlnn="-".vn_str_filter(GetCategory($nganhnghe));
            }
            $link=base_url()."viec-lam".$urlnn.$urltt."-c".$nganhnghe."p".$location.".html";
          }else{
            $link=base_url()."tim-viec-lam&keywork=".$findkey."&dd=".$location."&nn=".$nganhnghe;
          }
        }
        $result=['kq'=>true,'data'=>$link];
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
      }
      function ResultJobFilter($keywork,$dd,$nn){
        $page=$start_row=$this->uri->segment(2);
        $cookjobedu = $_COOKIE['jobedu'];
        $cookjobexperion = $_COOKIE['jobexperion'];
        $cookjoblevel = $_COOKIE['joblevel'];
        $cookjobupdate = $_COOKIE['jobupdate'];
        $perpage=30;
        if(empty($page)||intval($page)==0){
          $page=0;
        }else{
          $page=intval($page);
        }
        $data['home'] = true;		
        $sql=$this->site_model->gettblwidthid('tbl_meta',2);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
        if(!empty($sql->name)){
          $data['metah1']=$sql->name;
        }else{
          $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        if($page <= 29){
          $data['robots']= 'noindex,nofollow';
        }else{
         $data['robots']= 'noindex,nofollow'; 
       }
       $arrparramnew=['nganhnghe'=>$nn,'keywork'=>$keywork,'diadiem'=>$dd,'type'=>$type];	

        // nhà tuyển dụng nổi bật
        //if(!isset($_SESSION['companyforlistjob']) || empty($_SESSION['companyforlistjob'])){
//            
//            $_SESSION['companyforlistjob']=$this->site_model->GetTopCompany(12);
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }else{
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }
       $result=$this->site_model->GetListJobforfilter($keywork,$cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idnn,$idpro,$page,$perpage);
       $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".$dd."&nn=".$nn;
       $data['itemjob']=$result['data'];
       $this->load->library('pagination');
       $config['total_rows'] = $result['total'];
       $config['per_page'] = $perpage;
       $config['uri_segment'] =2;
       $config['next_link'] = '<i class="fa fa-angle-right"></i>';
       $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
       $config['num_links'] = 4;
       $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
       $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
       $config['base_url']=$link;
       $this->pagination->initialize($config);	
       $data['total']=$result['total'];
       $data['conhan']=$result['total'];
       $data['start_row']= $page;
       $data['pagination']= $this->pagination->create_links();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(12);

       $data['canonical']=$link;	
        //if(!isset($_SESSION['expcheck']) || empty($_SESSION['expcheck'])){
//            $_SESSION['expcheck']=$this->site_model->GetCountJobByEXP();
//            $data['filterexp']=$_SESSION['expcheck'];
//            }
//            else{
//              $data['filterexp']=$_SESSION['expcheck'];  
//            }
        //Loc bang cap
        //if(!isset($_SESSION['educheck']) || empty($_SESSION['educheck'])){
//            $_SESSION['educheck']=$this->site_model->GetCountJobbyEdu();
//            $data['filteredu']=$_SESSION['educheck'];
//            }
//            else{
//              $data['filteredu']=$_SESSION['educheck'];  
//            }
        //lọc cấp bậc
        //if(!isset($_SESSION['levelcheck']) || empty($_SESSION['levelcheck'])){
//            $_SESSION['levelcheck']=$this->site_model->GetCountJobByLevel();
//            $data['filterlevel']=$_SESSION['levelcheck'];
//            }
//            else{
//              $data['filterlevel']=$_SESSION['levelcheck'];  
//            }
        // loc tinh thanh
        //unset($_SESSION['citycheck']);
        //if(!isset($_SESSION['citycheck']) || empty($_SESSION['citycheck'])){
//            $_SESSION['citycheck']=$this->site_model->GetCountJobByProvince(4,$nn,$dd,$keywork);
//            $data['city']=$_SESSION['citycheck'];
//        }else{
//            if($keywork != $arrparram['keywork']){
//                $_SESSION['citycheck']=$this->site_model->GetCountJobByProvince(4,$nn,$dd,$keywork);
//            }
//            $data['city']=$_SESSION['citycheck'];
//        }
        //unset($_SESSION['categorycheck']);
        //loc danh mục
        //if(!isset($_SESSION['categorycheck']) || empty($_SESSION['categorycheck'])){
//            $_SESSION['categorycheck']=$this->site_model->GetCounJobByCategory(4,$nn,$dd,$keywork);
//            $data['category']=$_SESSION['categorycheck'];
//        }else{
//            if($keywork != $arrparram['keywork']){
//                $_SESSION['categorycheck']=$this->site_model->GetCounJobByCategory(4,$nn,$dd,$keywork);
//                }
//            $data['category']=$_SESSION['categorycheck'];
//        }
       $arrparram=['nganhnghe'=>$nn,'keywork'=>$keywork,'diadiem'=>$dd,'type'=>$type];	
       $data['params']=$arrparram;
       $data['content']='resultjobfilter';
       $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
       $this->load->view('template',$data);
     }
     function ListJobByFilter($aliasnn,$aliaspro,$idnn,$idpro)
     {    
      $page=$start_row=$this->uri->segment(2);
      $cookjobedu = $_COOKIE['jobedu'];
      $cookjobexperion = $_COOKIE['jobexperion'];
      $cookjoblevel = $_COOKIE['joblevel'];
      $cookjobupdate = $_COOKIE['jobupdate'];
      $perpage=30;
      if(empty($page)||intval($page)==0){
        $page=0;
      }else{
        $page=intval($page);
      }
      $data['home'] = true;		

      if(!empty($sql->name)){
        $data['metah1']=$sql->name;
      }else{
        $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
      }

      $data['querystring']=$aliasnn."-".$aliaspro."-".$idnn."-".intval($idpro).'=='.$page."---".$cookjobedu;
      $result=$this->site_model->GetListJobbyCatAndProvince($cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idnn,$idpro,$page,$perpage);
      $total=$result['total'];
      if((intval($idpro)<1) && (intval($idnn)<1))	{
        $link=base_url().'tim-viec-lam.html';
        $data['textcrum']="Tin tuyển dụng";
        $sql=$this->site_model->gettblwidthid('tbl_meta',2);
        $data['meta_title']=$sql->title;
        $data['meta_key']=$sql->metakeywork;
        $data['meta_des']=$sql->metadesc;
      }else{
        $urltt="";
        $txtcrum="";
        $txtcrum1="";
        $mttitle="";
        $mtdes="";
        $mtkey="";
        if(intval($idpro)>=1){
          $urltt="-tai-".vn_str_filter(Getcitybyindex($idpro));
          $txtcrum=" tại ".Getcitybyindex($idpro);
          if(intval($idnn)<=0){
                        //"số lượng tin tuyển dụng" + việc làm mọi ngành nghề đang có nhu cầu tuyển dụng tại + "tên tỉnh thành" với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp, năng động. Tìm hiểu thêm chi tiết tại timvieclam365.net
            $mttitle=$total." việc làm có nhu cầu tuyển dụng tại ".Getcitybyindex($idpro);
            $mtdes=$total." việc làm mọi ngành nghề đang có nhu cầu tuyển dụng tại ".Getcitybyindex($idpro)." với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp, năng động. Tìm hiểu thêm chi tiết tại timvieclam365.net ";
            $mtkey="Tuyển dụng nhanh việc làm tại ".Getcitybyindex($idpro);
          }
        }
        $urlnn="";
        if(intval($idnn)>=1){
          $urlnn="-".vn_str_filter(GetCategory($idnn));
          $txtcrum1=GetCategory($idnn);
          if(intval($idpro)<=0){
                        //Tìm việc làm + "tên ngành nghề"
            $mttitle="Có ".$total." việc làm nhanh ".GetCategory($idnn)." mới nhất ";
            $mtdes="Tuyển dụng việc làm ngành ".GetCategory($idnn)." mới nhất ".date('Y',time())." với mức lương hấp dẫn, môi trường làm việc chuyên nghiệp được cập nhật trên timviec365.net";
            $mtkey="Tìm việc làm ".GetCategory($idnn);
          }
        }
        if(intval($idnn)>=1 && intval($idpro)>=1){
                    //Có + "số lượng tin tuyển dụng" + việc làm ngành + "tên ngành nghề" + tại + "tên tỉnh thành" + đang chờ bạn. Tìm hiểu chi tiết tại timvieclam365.net
          $mttitle="Có ".$total." việc làm ngành ".GetCategory($idnn)." uy tín tại ".Getcitybyindex($idpro);
          $mtdes="Có ".$total." việc làm ngành ".GetCategory($idnn)." tại ".Getcitybyindex($idpro)." đang chờ bạn. Tìm hiểu chi tiết tại timviec365.net";
          $mtkey="việc làm ngành ".GetCategory($idnn)." tại ".Getcitybyindex($idpro);
        }
        $data['meta_title']=$mttitle;
        $data['meta_key']=$mtdes;
        $data['meta_des']=$mtkey;
        $link=base_url()."viec-lam".$urlnn.$urltt."-c".$idnn."p".$idpro.".html";
        $data['textcrum']="Việc làm ".$txtcrum1.$txtcrum;
      }	
      $data['canonical']=$link;	

      $data['checkpro']=intval($idpro);
      $data['checkcat']=intval($idnn);
        // nhà tuyển dụng nổi bật
        //if(!isset($_SESSION['companyforlistjob']) || empty($_SESSION['companyforlistjob'])){
//            
//            $_SESSION['companyforlistjob']=$this->site_model->GetTopCompany(12);
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }else{
//            $data['congtymoinhat']=$_SESSION['companyforlistjob'];
//        }
        //Loc bang cap
        //if(!isset($_SESSION['educheck']) || empty($_SESSION['educheck'])){
//            $_SESSION['educheck']=$this->site_model->GetCountJobbyEdu();
//            $data['filteredu']=$_SESSION['educheck'];
//            }
//            else{
//              $data['filteredu']=$_SESSION['educheck'];  
//            }
        // lọc kinh nghiệm
        //if(!isset($_SESSION['expcheck']) || empty($_SESSION['expcheck'])){
//            $_SESSION['expcheck']=$this->site_model->GetCountJobByEXP();
//            $data['filterexp']=$_SESSION['expcheck'];
//            }
//            else{
//              $data['filterexp']=$_SESSION['expcheck'];  
//            }
        //lọc cấp bậc
        //if(!isset($_SESSION['levelcheck']) || empty($_SESSION['levelcheck'])){
//            $_SESSION['levelcheck']=$this->site_model->GetCountJobByLevel();
//            $data['filterlevel']=$_SESSION['levelcheck'];
//            }
//            else{
//              $data['filterlevel']=$_SESSION['levelcheck'];  
//            }
        // loc tinh thanh
        //if(!isset($_SESSION['citycheck']) || empty($_SESSION['citycheck'])){
//            $_SESSION['citycheck']=$this->site_model->GetCountJobByProvince(1,$idnn,$idpro,'');
//            $data['city']=$_SESSION['citycheck'];
//        }else{
//            $data['city']=$_SESSION['citycheck'];
//        }
//$data['city']=$this->site_model->GetCountJobByProvince(1,$idnn,$idpro,'');
        //unset($_SESSION['categorycheck']);
        //loc danh mục
        //if(!isset($_SESSION['categorycheck']) || empty($_SESSION['categorycheck'])){
//            $_SESSION['categorycheck']=$this->site_model->GetCounJobByCategory(1,$idnn,$idpro,'');
//            $data['category']=$_SESSION['categorycheck'];
//        }else{
//            $data['category']=$_SESSION['categorycheck'];
//        }
//$data['category']=$this->site_model->GetCounJobByCategory(1,$idnn,$idpro,'');
      $data['itemjob']=$result['data'];
      $this->load->library('pagination');
      $config['total_rows'] = $total->sobanghi;
      $config['per_page'] = $perpage;
      $config['uri_segment'] =2;
      $config['next_link'] = '<i class="fa fa-angle-right"></i>';
      $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
      $config['num_links'] = 4;
      $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
      $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
      $config['base_url']=$link;
      $this->pagination->initialize($config);	
      $data['total']=$total->sobanghi;
      $data['conhan']=$total->tinconhan;
      $data['start_row']= $page;
      $data['pagination']= $this->pagination->create_links();
		//$data['amp']=site_url('amp');
      if($page <= 29){
        $data['robots']= 'noindex,nofollow';
      }else{
       $data['robots']= 'noindex,follow'; 
     }

     $data['content']='ListJobByFilter';
     $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
     $this->load->view('template',$data);
   } 
   function searchcompany()
   {
    $result=['kq'=>false,'data'=>''];
    $findkey=$_POST['findkey'];

    if($findkey != ''){
      $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=0&n=0&type=1";
      $result=['kq'=>true,'data'=>$link];
    }

    echo json_encode($result,JSON_UNESCAPED_UNICODE);
  }
  function ListCompanyByFilter($keywork,$c,$n,$type)
  {    	
    $page=$start_row=$this->uri->segment(2);
    $perpage=21;
    if(empty($page)||intval($page)==0){
      $page=0;
    }else{
      $page=intval($page);
    }
    $data['home'] = true;	
    if(!isset($c)){
      $c=0;
    }
    if(!isset($keywork)){
      $keywork='';
    }
    if(!isset($n)){
      $n=0;
    }
    if(!isset($type)){
      $type=1;
    }
    if($type > 4 || $n> 100 || $c>100){
      redirect(site_url());
    }else{	
      $sql=$this->site_model->gettblwidthid('tbl_meta',3);
      $data['meta_title']=$sql->title;
      $data['meta_key']=$sql->metakeywork;
      $data['meta_des']=$sql->metadesc;
      if(!empty($sql->name)){
        $data['metah1']=$sql->name;
      }else{
        $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
      }
      $arrparramnew=['cate'=>$c,'keywork'=>$keywork,'nganhnghe'=>$n,'type'=>$type];
        //unset($_SESSION['companycatcheck']);
        //if(!isset($_SESSION['companycatcheck']) || empty($_SESSION['companycatcheck'])){
        //    $_SESSION['companycatcheck']=$this->site_model->GetCityByCompany($n,$keywork,$type);
//            $data['category']=$_SESSION['companycatcheck'];
//        }else{
//            if($arrparramnew['nganhnghe']!=$arrparram['nganhnghe']){
//                $_SESSION['companycatcheck']=$this->site_model->GetCityByCompany($n,$keywork,$type);
//            }
//            $data['category']=$_SESSION['companycatcheck'];
//        }
//        //unset($_SESSION['companycitycheck']);
//        if(!isset($_SESSION['companycitycheck']) || empty($_SESSION['companycitycheck'])){            
//            $_SESSION['companycitycheck']=$this->site_model->GetCatByCompany($c,$keywork,$type);
//            $data['ccity']=$_SESSION['companycitycheck'];
//        }else{
//            if($arrparramnew['cate']!=$arrparram['cate']){
//                $_SESSION['companycitycheck']=$this->site_model->GetCatByCompany($c,$keywork,$type);
//            }
//            $data['ccity']=$_SESSION['companycitycheck'];
//        }	
      $arrparram=['cate'=>$c,'keywork'=>$keywork,'nganhnghe'=>$n,'type'=>$type];
      $data['fillabc']=$this->site_model->GetFilterABCByType($c,$n,1);
      $result=$this->site_model->GetLisCompanyByFillter($keywork,$n,$c,$type,$page,$perpage);
        //var_dump($result);die();
        //unset($_SESSION['tinnbcompany']);unset($_SESSION['uvnbcompany']);
//        if(!isset($_SESSION['tinnbcompany']) || empty($_SESSION['tinnbcompany'])){
//            $_SESSION['tinnbcompany']=$this->site_model->GetTopNew(10);
//            $data['tinmoinhat']=$_SESSION['tinnbcompany'];
//        }else{
//             $data['tinmoinhat']=$_SESSION['tinnbcompany'];
//        }
//        if(!isset($_SESSION['uvnbcompany']) || empty($_SESSION['uvnbcompany'])){
//            $_SESSION['uvnbcompany']=$this->site_model->GetListCandidate("1=1 ",3,'order by u.use_update_time desc');
//            $data['ungviennoibat']=$_SESSION['uvnbcompany'];
//        }else{
//             $data['ungviennoibat']=$_SESSION['uvnbcompany'];
//        }
      $link=base_url()."nha-tuyen-dung&keywork=".$keywork."&c=".$c."&n=".$n."&type=".$type;		
      $data['itemcom']=$result['data'];
      $this->load->library('pagination');
      $data['totalrow']=$result['total'];
      $config['total_rows'] = $result['total'];
      $config['per_page'] = $perpage;
      $config['uri_segment'] =2;
      $config['next_link'] = '<i class="fa fa-angle-right"></i>';
      $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
      $config['num_links'] = 4;
      $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
      $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
      $config['base_url']=$link;
      $this->pagination->initialize($config);	
      $data['total']=$total->sobanghi;
      $data['conhan']=$total->tinconhan;
      $data['start_row']= $page;
      $data['pagination']= $this->pagination->create_links();
      $data['params']=$arrparram;	
      $data['canonical']=$link;
		//$data['amp']=site_url('amp');

      if($page < 21){
        $data['robots']= 'noindex,nofollow';
      }else{
       $data['robots']= 'noindex,nofollow'; 
     }	
     $data['content']='listcompanybyfilter';
     $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
     $this->load->view('template',$data);
   }
 }
 function searchcandi()
 {
  $result=['kq'=>false,'data'=>''];
  $findkey=$_POST['findkey'];
  $location=$_POST['location'];
  $nganhnghe=$_POST['nganhnghe'];
        //$type=$_POST['type'];
        //if(intval($type)<=1){
  if(empty($findkey) && (intval($location)>= 0) && (intval($nganhnghe)>=0)){
    $urltt="";
    if(intval($location)>=1){
      $urltt="-tai-".vn_str_filter(Getcitybyindex($location));
    }else{
      $urltt="-chua-cap-nhat";
    }
    $urlnn="";
    if(intval($nganhnghe)>=1){
      $urlnn="-".vn_str_filter(GetCategory($nganhnghe));
    }
    $link=base_url()."ung-vien".$urlnn.$urltt."-u".$nganhnghe."s".$location.".html";
  }else if($findkey != ''){
    $link=base_url()."tim-ung-vien&keywork=".$findkey."&dd=".$location."&nn=".$nganhnghe;
  }
        //}
  $result=['kq'=>true,'data'=>$link];
  echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function ResultSearchCandi($keywork,$dd,$nn){
  $page=$start_row=$this->uri->segment(2);
  $perpage=20;
  if(empty($page)||intval($page)==0){
    $page=0;
  }else{
    $page=intval($page);
  }
  $candiexp = '';if(isset($_COOKIE['candiexp']) && !empty($_COOKIE['candiexp'])){$candiexp=$_COOKIE['candiexp'];};
  $candisalary ='';if(isset($_COOKIE['candisalary']) && !empty($_COOKIE['candisalary'])){$candisalary=$_COOKIE['candisalary'];} ;
  $data['home'] = true;		
  $sql=$this->site_model->gettblwidthid('tbl_meta',4);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  }
        //unset($_SESSION['candicityresult']);
        //unset($_SESSION['candinnresult']);
         //if(!isset($_SESSION['candicityresult']) || empty($_SESSION['candicityresult'])){
//            $_SESSION['candicityresult']=$this->site_model->GetCountCandiByCity($keywork,$nn,3);
//            $data['category']=$_SESSION['candicityresult'];
//        }else{
//            $data['category']=$_SESSION['candicityresult'];
//        }
//         if(!isset($_SESSION['candinnresult']) || empty($_SESSION['candinnresult'])){
//            $_SESSION['candinnresult']=$this->site_model->GetCountCandiByCategory($keywork,$dd,3);
//            $data['nganhnghe']=$_SESSION['candinnresult'];
//        }else{
//            $data['nganhnghe']=$_SESSION['candinnresult'];
//        }
  $data['category']=$this->site_model->GetCountCandiByCity($keywork,$nn,3);
  $data['nganhnghe']=$this->site_model->GetCountCandiByCategory($keywork,$dd,3);
  $link=base_url()."tim-ung-vien&keywork=".$keywork."&dd=".intval($dd)."&nn=".intval($nn);
  $result=$this->site_model->FindCandiBySearch($keywork,$nn,$dd,$candisalary,$candiexp,$page,$perpage);	
  $data['itemcandi']=$result['data'];
  $this->load->library('pagination');
  $data['totalrow']=$result['total'];
  $config['total_rows'] = $result['total'];
  $config['per_page'] = $perpage;
  $config['uri_segment'] =2;
  $config['next_link'] = '<i class="fa fa-angle-right"></i>';
  $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
  $config['num_links'] = 4;
  $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
  $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
  $config['base_url']=$link;
  $this->pagination->initialize($config);	
  $data['pagination']= $this->pagination->create_links();
  $data['canonical']=$link;
  $data['candiabc']=$this->site_model->GetFilterABCBycandi($dd,$idnn,1);
  $data['candisalary']=$this->site_model->GetSalaryByCandi();	
  $data['candiexp']=$this->site_model->GetExpbyCandi();
  $arrparams=['tinhthanh'=>$dd,'danhmuc'=>$nn,'keywork'=>$keywork];
  $data['params']=$arrparams;
  $data['content']='resultsearchcandi';
  $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';	

  $this->load->view('template',$data);
}
function ListCandidatebyfilter($aliasnn,$aliasstate,$idnn,$idpro)
{
  $page=$start_row=$this->uri->segment(2);
  $perpage=21;
  if(empty($page)||intval($page)==0){
    $page=0;
  }else{
    $page=intval($page);
  }
  $keywork='';
  $candiexp = '';
  if(isset($_COOKIE['candiexp']) && !empty($_COOKIE['candiexp'])){$candiexp=$_COOKIE['candiexp'];};
  $candisalary ='';
  if(isset($_COOKIE['candisalary']) && !empty($_COOKIE['candisalary'])){$candisalary=$_COOKIE['candisalary'];} ;
  $data['home'] = true;		
  $sql=$this->site_model->gettblwidthid('tbl_meta',4);
  $data['meta_title']=$sql->title;
  $data['meta_key']=$sql->metakeywork;
  $data['meta_des']=$sql->metadesc;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  }

        //unset($_SESSION['candinncheck']);
        //unset($_SESSION['candicitycheck']);
         //if(!isset($_SESSION['candicitycheck']) || empty($_SESSION['candicitycheck'])){
//            $_SESSION['candicitycheck']=$this->site_model->GetCountCandiByCity($keywork,$idnn,1);
//            $data['category']=$_SESSION['candicitycheck'];
//        }else{
//            $data['category']=$_SESSION['candicitycheck'];
//        }
  $data['category']=$this->site_model->GetCountCandiByCity($keywork,$idnn,1);
         //if(!isset($_SESSION['candinncheck']) || empty($_SESSION['candinncheck'])){
//            $_SESSION['candinncheck']=$this->site_model->GetCountCandiByCategory($keywork,$idpro,1);
//            $data['nganhnghe']=$_SESSION['candinncheck'];
//        }else{
//            $data['nganhnghe']=$_SESSION['candinncheck'];
//        }
  $data['nganhnghe']=$this->site_model->GetCountCandiByCategory($keywork,$idpro,1);
  $result=$this->site_model->FindCandiBySearch($keywork,$idnn,$idpro,$candisalary,$candiexp,$page,$perpage);	
  $data['itemcandi']=$result['data'];

  $data['candisalary']=$this->site_model->GetSalaryByCandi();	
  $data['candiexp']=$this->site_model->GetExpbyCandi();
  $data['candiabc']=$this->site_model->GetFilterABCBycandi($idpro,$idnn,1);
  $arrparams=['tinhthanh'=>$idpro,'danhmuc'=>$idnn];
  $data['params']=$arrparams;
  if(!isset($idpro) && !isset($idnn))	{
    $link=base_url().'nguoi-tim-viec.html';
    $data['textcrum']="Người tìm việc";
  }else{
    $urltt="";
    $textcrum1="";
    $textcrum="";
    if(intval($idpro)>=1){
      $urltt="-tai-".vn_str_filter(Getcitybyindex($idpro));
      $textcrum=" tại ".Getcitybyindex($idpro);
    }else{
      $urltt="-chua-cap-nhat";
      $textcrum=" chưa cập nhật nơi làm việc";
    }
    $urlnn="";
    if(intval($idnn)>=1){
      $urlnn="-".vn_str_filter(GetCategory($idnn));
      $textcrum1=GetCategory($idnn);
    }
    $link=base_url()."ung-vien".$urlnn.$urltt."-u".intval($idnn)."s".intval($idpro).".html";
    $data['textcrum']="Ứng viên ".$textcrum1.$textcrum;
  }	
  $this->load->library('pagination');
  $data['totalrow']=$result['total'];
  $config['total_rows'] = $result['total'];
  $config['per_page'] = $perpage;
  $config['uri_segment'] =2;
  $config['next_link'] = '<i class="fa fa-angle-right"></i>';
  $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
  $config['num_links'] = 4;
  $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
  $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
  $config['base_url']=$link;
  $this->pagination->initialize($config);	
  $data['pagination']= $this->pagination->create_links();
  $data['canonical']=$link;	
		//$data['amp']=site_url('amp');
  if($page < 21){
    $data['robots']= 'noindex,nofollow';  
  }else{
    $data['robots']= 'noindex,nofollow';
  }

  $data['content']='listcandidatebyfilter';
  $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
  $this->load->view('template',$data);
}   
function DetailJob($alias,$id)
{
  $jobinfo=$this->site_model->detailjobbyid($id)	;
  if($jobinfo != ""){
    $data['home'] = true;
    $data['meta_title']=$jobinfo->meta_title;
    $data['meta_key']=$jobinfo->meta_keywork;
    $data['meta_des']=$jobinfo->meta_desc;        
    $data['itemjob']=$jobinfo;	
    $data['morejob']=$this->site_model->GetRelativeJobdetail($jobinfo->new_cat_id,$jobinfo->new_id);
        //$data['tinmoinhat']=$this->site_model->GetTopNew(7);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",7,'order by u.use_update_time desc');	
    $data['canonical']=base_url().vn_str_filter($jobinfo->new_title)."-job".$jobinfo->new_id.".html";	
		//$data['amp']=site_url('amp');

    $data['robots']= 'noindex,nofollow';	
    $data['content']='detailjob';
    $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }else{
    redirect(site_url());
  }
}
function DetailCompany($alias,$id)
{
  $cominfo=$this->site_model->GetDetailCompanyByID($id);
  if($cominfo !=""){
    $data['home'] = true;		
    $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']=$cominfo->usc_company;//$sql->meta_title;
		$data['meta_key']=$cominfo->usc_company;//$sql->meta_key;
		$data['meta_des']=$cominfo->usc_company;//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }
    $data['itemcom']=$cominfo;		
    $data['morejob']=$this->site_model->GetMoreJobByCompany($cominfo->usc_id);
        //$data['tinmoinhat']=$this->site_model->GetTopNew(7);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');	
    $data['canonical']=base_url().vn_str_filter($cominfo->usc_company)."-ntd".$cominfo->usc_id.".html";	
		//$data['amp']=site_url('amp');

    $data['robots']= 'noindex,nofollow';

    $data['content']='detailcompany';
    $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }else{
    redirect(site_url());
  }
}

function DetailCandidate($alias,$id)
{
  $userinfo=$this->site_model->getcandidatebyID(intval($id));
  if($userinfo !=""){
    $data['home'] = true;		
    $sql=$this->site_model->gettblwidthid('tbl_footer',1);
		$data['meta_title']=$userinfo->use_first_name."vieclam24h.net.vn";//$sql->meta_title;
		$data['meta_key']=$userinfo->use_first_name."vieclam24h.net.vn";//$sql->meta_key;
		$data['meta_des']=$userinfo->use_first_name."vieclam24h.net.vn";//$sql->meta_des;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }

    $data['canonical']=base_url()."ung-vien/".vn_str_filter($userinfo->use_first_name)."-uv".$userinfo->use_id.".html";	
		//$data['amp']=site_url('amp');
    $data['userinfo']=$userinfo;
    $data['robots']= 'noindex,nofollow';	
    $data['content']='detailcandidate';
    $data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
    $this->load->view('template',$data);
  }else{
    redirect(site_url());
  }

}
function show_news($alias,$id)
{		
  $data['id']=$id;
  $data['showsearch']=true;	
  $data['home']=false;
  $data['classheader']='navbar navbar-default white bootsnav on no-full';	
  if(is_numeric($id)){
   $query=$this->db->query('SELECT * FROM baiviet WHERE status=1 AND id='.$id);    

 }else{
   redirect(site_url());
 }

 $data['chude']=$this->site_model->GetTeacherFeature();
 $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",9,'order by u.use_update_time desc');	
 if($query->num_rows()>0){			
   $data['item']= $query->row();
   $cat=$this->site_model->gettblwidthid('chuyenmuc',$data['item']->cid) ;   			
   if($data['item']->alias!=$alias){
    redirect(site_url($data['item']->alias.'-b'.$id.'.html'));
  }
  if($data['item']->meta_title!=''){
    $data['meta_title']=$data['item']->meta_title;
    $data['meta_key']=$data['item']->meta_key;
    $data['meta_des']=$data['item']->meta_des;
  }else{
    $data['meta_title']=$data['item']->title;
    $data['meta_key']=$data['item']->title;
    $data['meta_des']=$data['item']->title;
  }
  $tieude = $query->row()->title;
  $loctieude = 'AND ( title LIKE "%' . str_replace(' ', '%" OR title LIKE "%', $tieude) . '%")';
  $data['laytieude'] = $this->site_model->laytieude($id, $data['item']->cid, $loctieude);
  $data['cat']=$cat;
  $data['canonical']=site_url($data['item']->alias.'-b'.$data['item']->id.'.html');
  $data['robots']= 'noindex,nofollow';
  $data['content']='news';		
  $this->load->view('template',$data); 
}else{
 redirect(site_url());
}
}	   

function show_cat_sub($alias,$id)
{						
  $start_row=$this->uri->segment(2);		
  $per_page=10;
  if(is_numeric($start_row))
  {
   $start_row=$start_row;
 }
 else
 {
   $start_row=0;
 }

		//$cat=$this->memcached_library->get('key_cat_'.$id);
 $query1=$this->db->query("SELECT * FROM chuyenmuc WHERE status=1 AND alias='".$alias."'");
 $cat=$query1->row();
 $query=$this->site_model->gettbl_limited('baiviet',$cat->id,'','');

        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",9,'order by u.use_update_time desc');	
 $total_rows = $query->num_rows();
 $this->load->library('pagination');		
 $config['base_url'] = site_url($cat->alias.".html");
 $config['total_rows'] = $total_rows;
 $config['per_page'] = $per_page;
 $config['uri_segment'] =2;
 $config['next_link'] = '>';
 $config['prev_link'] = '<';
 $config['num_links'] = 4;
 $config['first_link'] = '<<';
 $config['last_link'] = '>>';
 $this->pagination->initialize($config);		
 $data['cid']=$cat->id;
 $data['item']=$cat;
 if($cat->meta_title!=''){
   $data['meta_title']=$cat->meta_title;
   $data['meta_key']=$cat->meta_key;
   $data['meta_des']=$cat->meta_des;
 }else{
   $data['meta_title']=$cat->name;
   $data['meta_key']=$cat->name;
   $data['meta_des']=$cat->name;
 }
 $data['total']=$total_rows;
 $data['start_row']= $start_row;
 $data['query']=$this->site_model->gettbl_limited('baiviet',$cat->id,$start_row,$per_page);
 $data['pagination']= $this->pagination->create_links();
 $data['canonical']=$config['base_url'];
 $data['chude']=$this->site_model->GetTeacherFeature();
 $data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
 $data['robots']= 'noindex,nofollow';
 $data['showsearch']=true;	
 $data['home']=false;
 $data['classheader']='navbar navbar-default white bootsnav on no-full';		
 $data['content']='category_sub';
 $this->load->view('template',$data);
}



function smtpmailer($to, $from, $from_name, $subject, $body)
{
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->CharSet = "UTF-8";
  $mail->SMTPSecure = 'tls';                
  $mail->Host = 'smtp.gmail.com';         
  $mail->Port = 587;                         
  $mail->Username = GUSER;  
  $mail->Password = GPWD;           
  $mail->SetFrom($from, $from_name);
  $mail->Subject = $subject;
  $mail->Body = $body;
  $mail->AddAddress($to);
  if(!$mail->Send())
  {
    $message = 'Gởi mail bị lỗi: '.$mail->ErrorInfo; 
    return false;
  } 
  else 
  {
    $message = 'Thư của bạn đã được gởi đi ';
    return true;
  }
} 
function login()
{
 $data['home'] = true;		
 $sql=$this->site_model->gettblwidthid('tbl_footer',1);
 $data['meta_title']=$sql->meta_title;
 $data['meta_key']=$sql->meta_key;
 $data['meta_des']=$sql->meta_des;
 if(!empty($sql->name)){
  $data['metah1']=$sql->name;
}else{
  $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
}

$data['canonical']=base_url();	
		//$data['amp']=site_url('amp');
$data['provincename']=(isset($_SESSION['provincename']))?$_SESSION['provincename']:'Hà Nội';
$data['province']=(isset($_SESSION['province']))?$_SESSION['province']:'1';
$data['robots']= 'noindex,nofollow';
$data['cityselect']=$this->site_model->selectprovince('selectpickersearch','selectpickersearch','Địa điểm')	;	
$data['content']='login';
$data['classheader']='navbar navbar-default navbar-fixed navbar-light white bootsnav on no-full';		
$this->load->view('template',$data);
}

function loginuser()
{
  $password = $this->input->post('password');
  $username = $this->input->post('username');
  $nhatuyendung = $this->input->post('typelogin');
        //var_dump($password,$username,$nhatuyendung);die();

  if(intval($nhatuyendung) > 0){
    $type=1;
    $result=$this->site_model->getlogincompany($username,$password);
  }else{
    $type=0;
        //var_dump($username,$password);die;
        //var_dump($username,$_POST);die();
    $result=$this->site_model->getlogin($username,$password);
  }
        //var_dump($result);die();
        //echo $result;
  if($result !=""){

    $ip = time();
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
    $token = $this->site_model->create_token($result->use_id,$ip,$type);

    $profileData = array("UserId" => $result->use_id,
     "UserName" => $result->use_email,
     "EmailAddress" => $result->use_email,
     "FullName" => $result->use_first_name,                                 
     "TokentKey" => $token,
     "Type"=>$type);
    $_SESSION['UserInfo'] = $profileData;
    $data=array('kq'=>true,'msg'=>'dang nhap thanh cong');

           // return json_encode();1 cong điệm, 2 trừ điểm
  }else{
    $data=array('kq'=>false,'msg'=>'dang nhap ko thanh cong');
            //return json_encode(array('kq'=>false,'msg'=>'dang nhap ko thanh cong'));
  }

        //return json_encode($data);
  echo json_encode($data);
}
// Trừ điểm xem hồ sơ.
function viewteacherinfo()
{
  $data = ['status' => 0, 'msg' => ''];
  $userid     = $_POST['userid'];
  $teacherid  = $_POST['teacherid'];
  $checkuser        = $this->site_model->check_users_point($userid);
  if ($checkuser['kq'] == true) {
    $userinfo   = $this->site_model->get_point($userid);
    $date_viewed = time();
    $point_free = $userinfo[0]->point_free;
    $point_pay  = $userinfo[0]->point_pay;
    if ($point_free >= 1) {
      $point_free_update = $point_free - 1;
      $update_user_point = $this->site_model->update_point_fp($userid,$point_type='point_free',$point_free_update);
      if ($update_user_point) {
        $data['status'] = 1;
        // check user point log
        $check_log = $this->site_model->check_users_point_log($userid, $teacherid);
        if ($check_log['kq'] == false) {
           $this->site_model->insert_point_log($userid, $teacherid, $type='1', $date_viewed);
        } else {
          $this->site_model->update_point_log_fp($userid, $teacherid, $type='1', $date_viewed);
        }
        // 
      }
    } elseif ($point_pay >= 1) {
      $point_pay_update = $point_pay - 1;
      $update_user_point = $this->site_model->update_point_fp($userid,$point_type='point_pay',$point_pay_update);
      if ($update_user_point) {
        $data['status'] = 2;
        // check user point log
        $check_log = $this->site_model->check_users_point_log($userid, $teacherid);
        if ($check_log['kq'] == false) {
           $this->site_model->insert_point_log($userid, $teacherid, $type='2', $date_viewed);
        } else {
          $this->site_model->update_point_log_fp($userid, $teacherid, $type='2', $date_viewed);
        }
        // 
      }
    } else {
      $data['status'] = 3;
    }
    
  }
    echo json_encode($data);
}
function loginteacher()
{
  $password = $this->input->post('password');
  $username = $this->input->post('username');
  $remember = $this->input->post('typelogin');

  $result=$this->site_model->GetLoginTeacher($username,md5($password));

  if($result != "" && $result->Active==1 && $result->UserType==1){
    $ip = time();
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
    $token = $this->site_model->create_token($result->UserID,$ip,$remember);
    // if($result->Active == 0){
    //   $result=array('kq'=>false,'msg'=>'Vui lòng kiểm tra lại tài khoản và mật khẩu đăng nhập');
    // }
    $balance=$this->site_model->getbalace($result->UserID);
    $profileData = array("UserId" => $result->UserID,
     "UserName" => $result->UserName,
     "EmailAddress" => $result->Email,
     "Name" => $result->Name, 
     "Phone"=>$result->Phone,                                
     "TokentKey" => $token,
     "UserType"=>$result->UserType,
     "Balance"=>intval($balance->Balance));
    $_SESSION['UserInfo'] = $profileData;
    $data=array('kq'=>true,'msg'=>'Đăng nhập thành công');
    $configpoint=$this->site_model->getpointconfig();
    $Trace="users_0";
    $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
    if($remember==1){
            setcookie("namephp", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            setcookie("puphp", md5($password), time() + (86400 * 30), "/"); // 86400 = 1 day
          }
        }
  else if ($result != "" && $result->Active==0 && $result->UserType==1){
    $data=array('kq'=>false,'msg'=>'Bạn chưa kích hoạt gmail hoặc gmail của bạn đã bị xóa , ban có muốn gửi lại không !');
  }
  else {
    $data=array('kq'=>false,'msg'=>'Đăng nhập không thành công. Vui lòng kiểm tra lại.');
  }
  echo json_encode($data,JSON_UNESCAPED_UNICODE);
}
      function loginusers()
      {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('typelogin');
        $result=$this->site_model->GetLoginusers($username,md5($password));
        if($result != "" && $result->Active==1 && $result->UserType==0){
          $ip = time();
          $type=0;
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
          $token = $this->site_model->create_token($result->UserID,$ip,$remember);  
          $balance=$this->site_model->getbalace($result->UserID);          
          $profileData = array("UserId" => $result->UserID,
           "Email" => $result->Email,
           "Name" => $result->Name, 
           "Phone"=>$result->Phone,                                
           "TokentKey" => $token,
           "TypeUser"=>$type,
           "Active"=> $active,
           "Balance"=>intval($balance->Balance));
          $_SESSION['UserInfo'] = $profileData;
          /*+5 điểm miễn phí cho phụ huynh*/
          $user_poin_info   = $this->site_model->get_point($profileData['UserId']);
          $user_reset_day   = new DateTime(date('Y-m-d H:i:s', $user_poin_info[0]->reset_day));
          $time             = new DateTime(date('Y-m-d H:i:s'));
          $checkuser        = $this->site_model->check_users_point($profileData['UserId']);
          $diff             = $user_reset_day->diff($time);
          $reset_day = time();
          if ($checkuser['kq'] == true) {
            if ($diff->format('%d') >= 1) {
              $this->site_model->update_point($profileData['UserId'], $reset_day);
            }
          }else {
            $this->site_model->insert_point($profileData['UserId'], $reset_day);
          }
          /**/
          $data=array('kq'=>true,'msg'=>'Đăng nhập thành công');
          $configpoint=$this->site_model->getpointconfig();
          $Trace="users_0";
          $addpoint=$this->site_model->addlogpoint($result->UserID,1,$configpoint->PointPerDay,1,$Trace);
            if($remember==1){
                setcookie("namephp", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
                setcookie("puphp", md5($password), time() + (86400 * 30), "/"); // 86400 = 1 day
              }
        }
        else if ($result != "" && $result->Active==0 && $result->UserType==0){
          $data=array('kq'=>false,'msg'=>'Bạn chưa kích hoạt gmail hoặc gmail của bạn đã bị xóa , ban có muốn gửi lại không !');
        }
        else {
          $data=array('kq'=>false,'msg'=>'Đăng nhập không thành công. Vui lòng kiểm tra lại.');
        }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
      }
          
          function logout(){
            $arrtg=$_SESSION['UserInfo'];
            $tg=$this->site_model->deltokenbyuserid($arrtg['UserId']);
            $data=['kq'=>true];
            $_SESSION['UserInfo']="";
        setcookie("namephp", $username, time() - (86400 * 31), "/"); // 86400 = 1 day
            setcookie("puphp", md5($password), time() - (86400 * 31), "/"); // 86400 = 1 day
            unset($_SESSION['UserInfo']);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
          }
          function EmailRegisterNofity()
          {
            $findkey = $this->input->post('findkey');
            $data=$this->site_model->EmailNofity($findkey);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
          } 
          function quickviewuser()
          {
            $userid=$this->input->post('objid');       

            $userinfo=$this->site_model->GetFirstUserTeacher(intval($userid));

            $lichday="";
            if(intval($userinfo->MonMorning)==1){$lichday[]=" Thứ 2 sáng";}
            if(intval($userinfo->MonAfter)==1){$lichday[]=" Thứ 2 chiều";}
            if(intval($userinfo->MonNight)==1){$lichday[]=" Thứ 2 tối";}
            if(intval($userinfo->TueMorning)==1){$lichday[]=" Thứ 3 sáng";}
            if(intval($userinfo->TueAfter)==1){$lichday[]=" Thứ 3 chiều";}
            if(intval($userinfo->TueNight)==1){$lichday[]=" Thứ 3 tối";}
            if(intval($userinfo->WeMorning)==1){$lichday[]=" Thứ 4 sáng";}
            if(intval($userinfo->WeAfter)==1){$lichday[]=" Thứ 4 chiều";}
            if(intval($userinfo->WeNight)==1){$lichday[]=" Thứ 4 tối";}
            if(intval($userinfo->ThuMorning)==1){$lichday[]=" Thứ 5 sáng";}
            if(intval($userinfo->ThuAfter)==1){$lichday[]=" Thứ 5 chiều";}
            if(intval($userinfo->ThuNight)==1){$lichday[]=" Thứ 5 tối";}
            if(intval($userinfo->FriMorning)==1){$lichday[]=" Thứ 6 sáng";}
            if(intval($userinfo->FriAfter)==1){$lichday[]=" Thứ 6 chiều";}
            if(intval($userinfo->FriNight)==1){$lichday[]=" Thứ 6 tối";}
            if(intval($userinfo->SatMorning)==1){$lichday[]=" Thứ 7 sáng";}
            if(intval($userinfo->SatAfter)==1){$lichday[]=" Thứ 7 chiều";}
            if(intval($userinfo->SatNight)==1){$lichday[]=" Thứ 7 tối";}
            if(intval($userinfo->SunMorning)==1){$lichday[]=" Chủ nhật sáng";}
            if(intval($userinfo->SunAfter)==1){$lichday[]=" Chủ nhật chiều";}
            if(intval($userinfo->SunNight)==1){$lichday[]=" Chủ nhật tối";}

            if(count($lichday)<=0){
              $lichday[]=" Chưa cập nhật";
            }




            $result=['kq'=>false];

            if(empty($userinfo)){
              $data='<div id="quick-view-box"><div class="tooltiptext"><div class="view view-users view-id-users view-display-id-attachment_7 view-dom-id-991d540f6fd86935d5e91fc993b31d22"><div class="view-content"><div class="views-row views-row-1 views-row-odd views-row-first views-row-last"><div class="fullname_tooltip">
              <h4>Không tồn tại</h4></div>
              </div></div></div></div></div>';
            }else{
              $data='<div id="quick-view-box"><div class="tooltiptext"><div class="view view-users view-id-users view-display-id-attachment_7 view-dom-id-991d540f6fd86935d5e91fc993b31d22"><div class="view-content"><div class="views-row views-row-1 views-row-odd views-row-first views-row-last"><div class="fullname_tooltip">';
              $data.='<h4><a >'.$userinfo->Name.'</a></h4></div>';
              $data.='<div class="class_content_popup">'.$userinfo->TitleView.' | '.$userinfo->CityName.'</div>';
              $data.='<div class="popoverborder"><div class="class_content_popup"><b>Lịch dạy</b>:  '.join(',',$lichday).'</div>

              <div class="class_content_popup" style="border-top:0.5px solid #f5f5f5;"><b>Số lớp đã dạy:</b> '.$userinfo->solopday.'</div>

              <div class="class_content_popup" style="border-top:0.5px solid #f5f5f5;">'.$userinfo->Description.'</div></div>

              </div></div></div></div></div>';
            }

            $result=['kq'=>true,'data'=>$data];

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxlstclass() 
          {
            $keytag=$this->input->post('keytag'); 
            $city=$this->input->post('city');
            $lsttopic=$this->site_model->SearchClassbyUserOnline($keytag,$city);
            $data="";
            if(count($lsttopic) > 0){
              foreach($lsttopic as $n){
                $tg=explode(',',$n->LearnType);
                $data.='<div class="item-uv-online">
                <div class="item-uv-onlien-job"><a href=""><i class="fa fa-online"></i> '.$n->ClassTitle.'</a></div>
                <div class="item-uv-name"><a href="">Học phí: '.number_format($n->Money).' vnđ/h</a><span><span>Địa điểm:</span> '.Getcitybyindex($n->City).'</span></div>
                <div class="item-uv-online-chat">
                <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với phụ huynh</span>
                <span class="uvonline-kinhnghiem"><span>Hình thức: </span>'.GetLearnType($tg[0]).'</span>
                </div>
                </div>';
              }
            }else{
              $data.='<div class="item-uv-online">
              Không tìm thấy lớp phù hợp
              </div>';
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxlstteacher()
          {
            $keytag=$this->input->post('keytag'); 
            $city=$this->input->post('city');
            $lsttopic=$this->site_model->GetTeacherOnlinebySearch($city,$keytag);
            $data="";
            if(count($lsttopic) > 0){
              foreach($lsttopic as $n){
                $tg=explode(',',$n->LearnType);
                $data.='<div class="item-uv-online">
                <div class="item-uv-onlien-job"><a href=""><i class="fa fa-online"></i> '.$n->TitleView.'</a></div>
                <div class="item-uv-name"><a>'.$n->Name.'</a><span><span>Từ:</span> '.number_format($n->Free).' vnđ/h</span></div>
                <div class="item-uv-online-chat">
                <span class="uvonline-chat"><i class="fa fa-chat" ></i> Chat với giáo viên</span>
                <span class="uvonline-kinhnghiem"><span>Hình thức: </span>'.GetLearnType($n->WorkID).'</span>
                </div>
                </div>';
              }
            }else{
              $data.='<div class="item-uv-online">
              Không tìm thấy giáo viên phù hợp
              </div>';
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxsearchteacherheader()
          {
            $subject= $_POST['subject'];
            $class= $_POST['class'];
            $place= $_POST['place'];
            $district= $_POST['district'];
            $order='last';
            
            
            $tinhthanh="";
            $monhoc="";
            $lop="";
            if(intval($subject)>0){
              $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
              $data['subjectname']=$monhoc->SubjectName;
            }
            if(intval($class)>0){
              $ajaxsearchclasstitle=$this->site_model->SelectClassByid(intval($class));
              $data['classname']=$lop->classname;
            }
            if(intval($place)>0){
              $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place));
              $data['cityname']=$tinhthanh->cit_name;
            }
            $result = $this->site_model->SearchTeacherByHeader($subject,$lop,$place,$district,$order,1,20);

            $lstitem = $result['data'];
       // for ($i=0; $i < count($lstitem); $i++) { 
       //   echo $lstitem[$i]->Name.'<br>'. $lstitem[$i]->ID;
       // }
       // die;
            // var_dump($lstitem[0]);die;
            $data="";
            if(!empty($lstitem)){  
            // for ($i=0; $i < 20; $i++) {

              foreach($lstitem as $n){ 
               $data.='<div class="item_lc">
               <div class="col-md-3 col-sm-12 padd-0">
               <div class="giasu_logo">
               <a href="'.base_url().vn_str_filter($n->Name).'-gv'.$n->UserID.'" title="'.$lstitem[$i]->Name.'" target="_blank">';
               if(!empty($n->Image)){
                $data.='<img src="'.gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),174,174,100).'" onerror="this.onerror=null;this.src="images/no-image2.png"/>';
              }else{ 

               $data.='<img src="images/no-image2.png" alt="#" onerror=this.onerror=null;this.src="images/no-image2.png"/>';
             }
             $data.='<span class="viewnow">Xem hồ sơ</span>
             </a>
             </div>
             </div>
             <div class="col-md-9 col-sm-12">
             <div class="giasu_info">
             <a href="'.base_url().vn_str_filter($n->Name).'-gv'.$n->UserID.'" title="'.$n->Name.'" class="giasu_name"><i class="fa fa-online"></i>' .$n->Name.' <i class="fa fa-chat"></i></a>
             <div title="#" class="giasu_titleview"><span>Gia sư:</span>'.
             str_replace('Gia sư','',$n->TitleView).

             '<a>'.$n->CityName. '</a></div>
             <span class="giasu_luong">Từ: <span>' .number_format($n->Free).' vnđ/h</span></span>
             <p>';
             $gn_text=$n->Description;
             if ( strlen( $n->Description ) > 175 ) {
               $gn_text = substr( $n->Description, 0, 175 );
               $space   = strrpos( $gn_text, ' ' );
               $gn_text = substr( $gn_text, 0, $space );          
             }
             $data.=$gn_text.'...';
             $data.= '</p>
             </div>
             </div>
             </div>';

           } 

         }else{ 

          $data.='<div class="item_lc">Không tìm thấy gia sư phù hợp</div>';
        } 

            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }

          function ajaxsearchclassheader()
          {
            $subject= $_POST['subject'];
            $class= $_POST['class'];
            $place= $_POST['place'];
            $district= $_POST['district'];
            $order='last';
            $keywork='';
            
            $tinhthanh="";
            $monhoc="";
            $lop="";
            if(intval($subject)>0){
              $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
              $data['subjectname']=$monhoc->SubjectName;
            }
            if(intval($class)>0){
              $lop=$this->site_model->SelectClassByid(intval($class));
              $data['classname']=$lop->classname;
            }
            if(intval($place)>0){
              $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place));
              $data['cityname']=$tinhthanh->cit_name;
            }
            $result=$this->site_model->ListClassBySearchHeader($keywork,$subject,$classname,$place,$district, $order,0,20);


            $lstitem = $result['data'];
           // for ($i=0; $i < count($lstitem); $i++) { 
           //   echo $lstitem[$i]->Name.'<br>'. $lstitem[$i]->ID;
           // }
           // die;
            // var_dump($lstitem[0]);die;
            $data="";
            if(!empty($lstitem)){  
            // for ($i=0; $i < 20; $i++) {
                        
              foreach($lstitem as $n){ if($n->dongyday ==0){ 
                  $data.='<div class="itemnews">
                      <div class="itemnews_l">
                          <a class="logouser">';
                          if(!empty($n->Image)){
                           $data.='<img src="'.gethumbnail(geturlimageAvatar(strtotime($n->CreateDate)).$n->Image,$n->Image,strtotime($n->CreateDate),63,63,100).'" onerror= this.onerror=null;this.src="images/no-image2.png"/>';
                      }else{
                       $data.='<img src="images/no-image2.png" alt="#" onerror=this.onerror=null;this.src="images/no-image2.png"/>';
                        } 
                       $data.='</a>
                          <a href="'.base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID.'" class="nameu" title="'.$n->Name.'">'.$n->Name.'</a>
                          <span>'.date("d/m/Y",strtotime($n->CreateDate)).'</span>
                      </div>
                      <div class="itemnews_r">
                          <a target="_blank" href="'.base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID.'" class="item-uv-name" tabindex="0"><i class="fa fa-online"></i>'.$n->ClassTitle.' </a>
                          <p>';
                            $gn_text=$n->DescClass;
                                  if ( strlen( $n->DescClass ) > 250 ) {
                                         $gn_text = substr( $n->DescClass, 0, 250 );
                                         $space   = strrpos( $gn_text, ' ' );
                                         $gn_text = substr( $gn_text, 0, $space ). '...';
                                  } 
                          $data.= $gn_text ;
                          $data.='</p>  
                          <span class="btn btn-freelance">'.number_format($n->Money).'" vnđ/h"</span> 
                          <span class="btn">'.$tg=explode(',',$n->LearnType);
                              GetLearnType($tg[0]);
                          $data.='</span>
                          <span class="btn">'.Getcitybyindex($n->City).'</span>
                          <span class="xacthuc"><i class="fa fa-shield" data-toggle="tooltip" data-placement="top" title="Phụ huynh đã xác thực"></i><i class="fa fa-uv-chat-cam"></i></span>
                          <span class="dadenghiday">Đã đề nghị dạy:&nbsp;&nbsp;'.$n->denghiday.'<i class="fa fa-user-dnd"></i></span>                    
                      </div>
                  </div>';
               }
            }
          }
            else
            {
                 $data.='<div class="col-md-12">Không tìm thấy lớp học</div>';
            } 
                    

            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxsearchteachertitle()
          {
            $subject= $_POST['subject'];
            $class= $_POST['class'];
            $place= $_POST['place'];
            $district= $_POST['district'];
            $order='last';
            $keywork='';
            
            $tinhthanh="";
            $monhoc="";
            $lop="";
            if(intval($subject)>0){
              $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
              $subjectname=$monhoc->SubjectName;
            }
            if(intval($class)>0){
              $lop=$this->site_model->SelectClassByid(intval($class));
              $classname=$lop->classname;
            }
            if(intval($place)>0){
              $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place));
              $cityname=$tinhthanh->cit_name;
            }
            if(!empty($subjectname))
            {
              $subjectname = $subjectname.' ';
            }
            else
            {
              $subjectname = '';
            }

            if(!empty($cityname))
            {
              $cityname = 'tại '.$cityname;
            }
            else
            {
              $cityname = '';
            }

            if(!empty($classname))
            { 
              $classname = $classname.' ';
            }
            else
            {
              $classname = '';
            }

            $data='<h1><span>Hồ sơ gia sư dạy kèm '.$subjectname.$classname.$cityname.'</span></h1>';

            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxsearchclasstitle()
          {
            $subject= $_POST['subject'];
            $class= $_POST['class'];
            $place= $_POST['place'];
            $district= $_POST['district'];
            $order='last';
            $keywork='';
            
            $tinhthanh="";
            $monhoc="";
            $lop="";
            if(intval($subject)>0){
              $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
              $subjectname=$monhoc->SubjectName;
            }
            if(intval($class)>0){
              $lop=$this->site_model->SelectClassByid(intval($class));
              $classname=$lop->classname;
            }
            if(intval($place)>0){
              $tinhthanh=$this->site_model->SelectProvinceByID1(intval($place));
              $cityname=$tinhthanh->cit_name;
            }
            if(!empty($subjectname))
            {
              $subjectname = $subjectname.' ';
            }
            else
            {
              $subjectname = '';
            }

            if(!empty($cityname))
            {
              $cityname = 'tại '.$cityname;
            }
            else
            {
              $cityname = '';
            }

            if(!empty($classname))
            { 
              $classname = $classname.' ';
            }
            else
            {
              $classname = '';
            }
            $data='<h1><span>Tổng hợp tin tuyển gia sư '.$subjectname.$classname.$cityname.'</span></h1>';

            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxfindsubject()
          {
            $idmonhoc=$this->input->post('findkey'); 
            $lsttopic=$this->site_model->ListSubjectByKey($idmonhoc);
            $data="";
            foreach($lsttopic as $n){
              $data.="<li class='col-md-4 padd-0'><a target='_blank' href='".base_url()."tim-gia-su&key=all&subject=".$n->ID."&topic=0&place=0&type=0&sex=0'>".$n->SubjectName."</a></li>";
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxfindprovince()
          {
            $idmonhoc=$this->input->post('findkey'); 
            $lsttopic=$this->site_model->getprovincebykey($idmonhoc);
            $data="";
            foreach($lsttopic as $n){
              $data.="<li class='col-md-4 padd-0'><a target='_blank' href='".base_url()."tim-gia-su&key=all&subject=0&topic=0&place=".$n->cit_id."&type=0&sex=0'>".$n->cit_name."</a></li>";
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function Ajaxchude()
          {
            $idmonhoc=$this->input->post('idmon'); 
            $lsttopic=$this->site_model->ListTopicBySubject($idmonhoc);
            $data="<option value=''>Chọn chủ đề</option>";
            foreach($lsttopic as $n){
              $data.="<option value='".$n->ID."'>".$n->NameTopic."</option>";
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          } 
          function AjaxchudeCheckbox()
          {
            $idmonhoc=$this->input->post('idmon'); 
            $lsttopic=$this->site_model->ListTopicBySubject($idmonhoc);
            $data="";
            foreach($lsttopic as $n){

              $data.="<li>";
              $data.="<input class='radio-calendar' id='toppic-".$n->ID."' type='checkbox' name='toppicchk' value='".$n->ID."'>
              <label for='toppic-".$n->ID."'>".$n->NameTopic."</label>";
              $data.="</li>";
              $id = $n->SubjectID;
            }

            $result=['kq'=>true,'data'=>$data, 'id'=>$id];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
            
          function ajaxtimgiasutheomonhoc()
          {
            $idmonhoc=$this->input->post('monhoc'); 
            $lsttopic=$this->site_model->TimGiaSuTheoMonHoc($idmonhoc);
            $data="";
            foreach($lsttopic as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
              $data.="<li><a target='_blank' href='".base_url()."giao-vien&key=all&subject=".$n->ID."&topic=0&place=0&type=0&sex=0&order=last'>".$n->SubjectName."<span>(".$n->sogiasu.")</span></a></li>";
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxgetforgotpassword()
          {
            $result=['kq'=>false,'data'=>''];
            $username=$this->input->post('email'); 
            $lsttopic=$this->site_model->GetUserForgot($username);
            $data="";
            if($lsttopic != ""){
              $code="f_".rand(1000000,9999999);
              $body=file_get_contents(base_url().'EmailTemplate/SendForgotPassword.htm');      
              $body=str_replace('<%name%>',$lsttopic->Name,$body);
              $body=str_replace('<%email%>',$lsttopic->Email,$body);    
              $body=str_replace('<%code%>',$code,$body); 


              $subject='[giasu365] Lấy lại mật khẩu';
              $Description="Lấy lại mật khẩu";
              $data="";
              $CreateDate=date("Y-m-d H:i:s",time());
              $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
              VALUES('".$lsttopic->UserID."','".$code."','0','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
              $insert=$this->db->query($queryconfrim);
              $Name=$lsttopic->Name;
              $arrphone=['Email'=>"'$username'",'Name'=>"'$name'"];        
            //$message=formatsmsmessage(2,$code);//buildsendautocall($arrphone,$code);//
            //$Statuscode=1;//
            //$Statuscode=sendsms($lsttopic->Name,$message);
            //$smslog=$this->site_model->InsertLogSms($code,$Statuscode,'2');
              $body = base64_encode($body);
              $this->site_model->CreateSendMail('timviec365-noreply@timviec365.com.vn',$lsttopic->Email,"","",$subject,$body);
              $result=['kq'=>true,'data'=>'Yêu cầu lấy lại mật khẩu thành công, bạn vui lòng kiểm tra email để thay đổi mật khẩu'];
            }

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxconfirmpass()
          {
            $newpass=$this->input->post('password'); 
            $email=$this->input->post('email'); 
            $lsttopic=$this->site_model->getconfirmuserbycode($newpass,$email);

            echo json_encode($lsttopic,JSON_UNESCAPED_UNICODE);
          }
          function ajaxconfirmusersregister()
          {        
            $code=$this->input->post('code'); 
            $username=$this->input->post('usp'); 
            $lsttopic=$this->site_model->getconfirmuserregisterbycode($code,$username);
            echo json_encode($lsttopic,JSON_UNESCAPED_UNICODE);
          }
          function ajaxteacherchangepass()
          {
            $result=['kq'=>false,'data'=>''];
            $oldpass=$this->input->post('oldpass');
            $newpass=$this->input->post('newpass');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->updatenewpass($userid,$oldpass,$newpass);
              if($kq == true){
                $result=['kq'=>true,'data'=>'Bạn đã thay đổi mật khẩu thành công. Bạn có thể sử dụng mật khẩu này từ bây giờ'];
              }
              else
              {
                $result=['kq'=>true,'data'=>'Mật khẩu cũ không chính xác. Vui lòng kiểm tra lại'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxuservsclass()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid'); 
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              if ($tg['UserType'] == 1 || $tg['TypeUser'] == 1) {
                $kq=$this->site_model->adduservsclass($userid,$classid,0);
                if($kq['kq'] == true){
                  $result=['kq'=>true,'data'=>'Đề nghị dạy thành công, bạn vui lòng chờ phản hồi của phụ huynh'];
                }
                else {
                  $result=['kq'=> 'save', 'data' => 'Bạn đã gửi thông tin ứng tuyển dạy lớp học này'];
                }
              }
              else {
                $result=['kq' => false, 'data' => 'Bạn phải đăng nhập gia sư để thực hiện chức năng này'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxusersaveclassexcel()
          {
            $result=['kq'=>false,'data'=>''];
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $tg=$this->site_model->getfullteachersaveclass($userid); 
              $data="";
              if($tg != '')
              {
                $data .="<table>
                <thead>
                <tr>
                <th style='width: 8.4%;'>STT
                </th>
                <th style='width:35%'>Họ tên
                </th>
                <th style='width:15%;'>Ghi chú</th>
                <th style='width: 14%;'>Môn học</th>
                <th style=''>Ngày lưu</th>
                </tr>
                </thead>
                <tbody>";
                $i=0;
                foreach($tg as $n){ 
                  $i+=1;
                  $data .="<tr>
                  <td >".$i."</td>";
                  $data .="<td>".$n->Name." - Lớp:
                  ".$n->ClassTitle."</a></td>";
                  $data .="<td>".$n->ghichu."</td>";
                  $data .="<td><span>".$n->SubjectName."</span></td>";
                  $data .="<td>".date("d/m/Y",strtotime($n->CreateDate))."</td></tr>";


                }                            
                $data .="</tbody></table>";
                $result=['kq'=>true,'data'=>$data];
              }
            }

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }

          function ajaxfilterusersaveclass()
          {
            $result=['kq'=>false,'data'=>''];
            $monhoc=$this->input->post('monhoc'); 
            $findkey=$this->input->post('findkey'); 
            $ngaythang=$this->input->post('ngaythang');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $tg=$this->site_model->getfilterteachersaveclass($userid,$monhoc,$findkey,$ngaythang); 
              $data="";
              if($tg != '')
              {
                $data .="";
                $i=0;
                foreach($tg as $n){ 
                  $i+=1;
                  $data .="<tr>
                  <td class='stt'>".$i."</td>
                  <td><label>".$n->Name."</label>
                  <a href='".base_url().'lop-hoc/'.vn_str_filter($n->ClassTitle).'-'.$n->ClassID."' target='_blank'>".$n->ClassTitle."</a>
                  </td>
                  <td>".$n->ghichu."</td>
                  <td><span>".$n->SubjectName."</span></td>
                  <td>".date("d/m/Y",strtotime($n->CreateDate))."</td>
                  <td class='actionjob'>
                  <a data-val='".$n->ClassID."' class='btnntdedit' id='sualopdaluu'>Sửa</a>
                  <a data-val='".$n->ClassID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>
                  </td>
                  </tr>";


                }                            

                $result=['kq'=>true,'data'=>$data];
              }
            }

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxusersaveclass()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid'); 
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              if ($tg['UserType'] == 1 || $tg['TypeUser' ==1]) {
                $kq=$this->site_model->addusersaveclass($userid,$classid);
                if($kq['kq'] == true){
                  $result=['kq'=>true,'data'=>'Đã lưu lớp học thành công'];
                }
                else {
                  $result =['kq' => 'save', 'data' => 'Bạn đã lưu lớp học này'];
                }
              }
              else {
                  $result= ['kq' => false, 'data' => 'Bạn phải đăng nhập giáo viên để thực hiện chức năng này'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxusersaveuser()
          {
            $tg=$_SESSION['UserInfo'];
            $result=['kq'=>false,'data'=>''];
            $giaovien=$this->input->post('giaovien'); 
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              if ($tg['TypeUser' == 0] || $tg['UserType'] == 0) {
               $kq=$this->site_model->adduservsusers($userid,$giaovien,1);
               if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
              }
              else {
                $result=['kq' => 'save', 'data' => 'Bạn đã lưu hồ sơ này'];
              }
            }
            else {
              $result=['kq'=>false,'data'=>'Bạn phải là phụ huynh để thực hiện chức năng này'];
            }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdatenoteusersaveuser()
          {
            $result=['kq'=>false,'data'=>''];
            $giaovien=$this->input->post('giaovien'); 
            $note=$this->input->post('note');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->updateusersaveuser($userid,$giaovien,$note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxdeleteusersvaveuser()
          {
            $result=['kq'=>false,'data'=>''];
            $giaovien=$this->input->post('giaovien');         
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->deleteusersaveuser($userid,$giaovien);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Lưu hồ sơ thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);        
          }
          function ajaxdeleteteacherclass(){
            $result   = ['kq' => false, 'data' => ''];
            $ClassID  = $this->input->post('ClassID');
            if (!empty($ClassID)) {
              $del = $this->site_model->deleteteacherclass($ClassID);
              if ($del['kq'] == true) {
                $result['kq'] = true;
                $result['data'] = 'Xóa tin đăng tìm gia sư thành công';
              }
            }
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
          }
          function ajaxaddclassvsusers()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('lophoc'); 
            $userid=$this->input->post('giaovien'); 
            $kq=$this->site_model->addclassvsuser($userid,$classid,1);
            if($kq['kq'] == true){
              $result=['kq'=>true,'data'=>'mời dạy lớp học thành công'];
            }

            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdateissearch()
          {
            $result=['kq'=>false,'data'=>''];
            $issearch=$this->input->post('issearch');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $lst=$this->site_model->updateissearchuser($userid,$issearch);
              if($lst){
                $result=['kq'=>true,'data'=>'Cập nhật thành công'];  
              }
            } 
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdatenotify()
          {
            $result=['kq'=>false,'data'=>''];
            $notify=$this->input->post('notify');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $lst=$this->site_model->updatenofityuser($userid,$notify);
              if($lst){
                $result=['kq'=>true,'data'=>'Cập nhật thành công'];  
              }
            } 
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxloadmoreteachersave()
          {
            $result=['kq'=>false,'data'=>''];
            $page=$this->input->post('page'); 

            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $lst=$this->site_model->getpageteachersavebyuserid($userid,$page);
              if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                  $i+=1;
                  $j=($page*1) +$i;
                  $data.="<tr>
                  <td>".$j."</td>
                  <td><a href='".base_url().vn_str_filter($n->Name)."-gv".$n->UserID."'>".$n->Name."</a>
                  <span>".$n->TitleView."</span>
                  </td>                                
                  <td>".$n->Note."</td>
                  <td>".date('d/m/Y',strtotime($n->ngaymoi))."</td>
                  <td class='actionjob'>
                  <a data-val='".$n->UserID."' class='btnntdedit' id='sualopdaluu'>Sửa</a>
                  <a data-val='".$n->UserID."' id='xoalopdaluu' class='btnntddelete'>Xóa</a>
                  </td>
                  </tr>";
                }
                $result=['kq'=>true,'data'=>$data];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxloadmoreteacherinvite()
          {
            $result=['kq'=>false,'data'=>''];
            $page=$this->input->post('page'); 

            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $lst=$this->site_model->getpageteacherinvitebyuserid($userid,$page);
              if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                  $i+=1;
                  $j=($page*1) +$i;
                  $data.="<tr>

                  <td><a href='".base_url().vn_str_filter($n->Name)."-gv".$n->UserID."'><".$n->Name."</a>
                  <span>".$n->TitleView."</span>
                  </td>
                  <td>".GetLearnType($n->WorkID)."</td>                                
                  <td>Từ: ".number_format($n->Free)." vnđ/h</td>
                  <td>".date('d/m/Y',strtotime($n->ngaymoi))."</td>
                  <td >";
                  if($n->Active ==1){$data.="Chưa phản hồi";}else{ $data.="Đã phản hồi";}  
                  $data.="</td></tr>";
                }
                $result=['kq'=>true,'data'=>$data];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxloadmoreteacherfit()
          {
            $result=['kq'=>false,'data'=>''];
            $page=$this->input->post('page'); 

            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $lst=$this->site_model->getpageteacherfitbyuserid($userid,$page);
              if($lst != ''){
                $data="";
                $i=0;
                foreach($lst as $n){
                  $i+=1;
                  $j=($page*1) +$i;
                  $data.="<tr>                                
                  <td><a href='".base_url().vn_str_filter($n->Name).'-gv'.$n->UserID."'>".$n->Name."</a>
                  <span>".$n->TitleView."</span>
                  </td>
                  <td>".GetLearnType($n->WorkID)."</td>                                
                  <td>Từ: ".number_format($n->Free)." vnđ/h</td>
                  <td>".date('d/m/Y',strtotime($n->CreateDate))."</td>                                
                  </tr>";
                }
                $result=['kq'=>true,'data'=>$data];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxtimgiasutheotinhthanh()
          {
            $idmonhoc=$this->input->post('monhoc'); 
            $lsttopic=$this->site_model->timgiasutheotinhthanh($idmonhoc);
            $data="";
            foreach($lsttopic as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
              $data.="<li><a target='_blank' href='".base_url()."giao-vien&key=all&subject=0&topic=0&place=".$n->cit_id."&type=0&sex=0&order=last'>".$n->cit_name."<span>(".$n->giasutt.")</span></a></li>";
            }
            $result=['kq'=>true,'data'=>$data];
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxgetclassnotteacherbyuserid()
          {
            $tg = $_SESSION['UserInfo'];
            $result=['kq'=>false,'data'=>''];
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              if ($tg['UserType'] == 0) {
                $kq=$this->site_model->Getlistclassnotteacherbyuserid($userid);
                if($kq != ''){
                  foreach($kq as $n){
            //giao-vien&key=all&subject=1&topic=0&place=0&type=0&sex=0&order=last
                    $data.="<option value='".$n->ClassID."'>".$n->ClassTitle."</option>";
                  }
                  $result=['kq'=>true,'data'=>$data];
                }
                else {
                  $result=['kq' => 'save', 'data' => 'Bạn không còn lớp học trống để mời gia sư'];
                }
              }
              else {
                $result=['kq' =>  false, 'data' => 'Bạn phải đăng nhập phụ huynh để thực hiện chức năng này'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdatestatususervsclass()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid');
            $note=$this->input->post('note');
            $active=$this->input->post('trangthai');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->updateuservsclass($userid,$classid,$active,$note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
              }else if($kq['kq']==false && $kq['data']==true){
                $result=['kq'=>false,'data'=>true];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdatestatusteachersuggest()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid');
            $note=$this->input->post('note');
            $active=$this->input->post('trangthai');
            $userid=$this->input->post('id');
            if(!empty($_SESSION['UserInfo'])){

              $kq=$this->site_model->updateuservsclass($userid,$classid,$active,$note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
              }else if($kq['kq']==false && $kq['data']==true){
                $result=['kq'=>false,'data'=>true];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdateuserssaveclass()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid');
            $note=$this->input->post('note');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->updateuserssaveclass($userid,$classid,$note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxdeleteuserssaveclass()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->deleteuserssaveclass($userid,$classid);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Xóa bản ghi thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxsendnotifymoney()
          {
            $result=['kq'=>false,'data'=>''];
            $ReceiveBank=$this->input->post('ReceiveBank');
            $TransferType=$this->input->post('TransferType');
            $TransferBank=$this->input->post('TransferBank');
            $CustomerName=$this->input->post('CustomerName');
            $CustomerBN=$this->input->post('CustomerBN');
            $TransferDate=$this->input->post('TransferDate');
            $Amount=$this->input->post('Amount');
            $Note=$this->input->post('Note');
            $tgngaysinh=explode('-',$TransferDate);        
            $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->insertsendnotifymoney($userid,$TransferType,$TransferBank,$CustomerName,$CustomerBN,$birth,$ReceiveBank,$Amount,$Note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Gửi thông báo thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxupdatestatusclassvsusers()
          {
            $result=['kq'=>false,'data'=>''];
            $classid=$this->input->post('classid');
            $note=$this->input->post('note');
            $active=$this->input->post('trangthai');
            if(!empty($_SESSION['UserInfo'])){
              $tg=$_SESSION['UserInfo'];
              $userid=$tg['UserId'];
              $kq=$this->site_model->updateclassvsusers($userid,$classid,$active,$note);
              if($kq['kq'] == true){
                $result=['kq'=>true,'data'=>'Cập nhật trạng thái thành công'];
              }
            }
            echo json_encode($result,JSON_UNESCAPED_UNICODE);
          }
          function ajaxteacherregistersuccess()
          {

            $result=['kq'=>false,'data'=>$_POST,'file'=>$_FILES];
            $chieu2=$_POST['chieu2'];
            $chieu3=$_POST['chieu3'];
            $chieu4=$_POST['chieu4'];
            $chieu5=$_POST['chieu5'];
            $chieu6=$_POST['chieu6'];
            $chieu7=$_POST['chieu7'];
            $chieu8=$_POST['chieu8'];
            $chitietnoidung=$_POST['chitietnoidung'];
        $chudemonhoc=$_POST['chudemonhoc'];//: "1,2,3,4,5,8,9,15,16,18,19,22"
        $username=$_POST['txthoten'];//: "lớp 1"
        $chuyennganh=$_POST['chuyennganh'];//: "lớp 1"
        $emailuser=$_POST['emailuser'];//: "trantronglong87@gmail.com"
        $gioithieubanthan=$_POST['gioithieubanthan'];//: "giới thiệu bản thân"
        $gioitinh=$_POST['gioitinh'];//: "on"
        $hientaila=$_POST['hientaila'];//: "undefined"
        $hinhthucday=$_POST['hinhthucday'];//: "on"
        $hocphi=$_POST['hocphi'];//: "200000"
        $hoctruong=$_POST['hoctruong'];//: "tiểu học vĩnh hưng"
        $hoten=$_POST['hoten'];//: "Trần Trọng Long"
        $khuvucday=$_POST['khuvucday'];//: "1"
        $tenkhuvucday=$_POST['tenkhuvucday'];
        $quanhuyen = $_POST['quanhuyen'];
        $kinhnghiem=$_POST['kinhnghiem'];//: "kinh nghiệm đi dạy"
        $monhoc=$_POST['monhoc'];//: "1,10"
        $lopday = $_POST['lopday'];
        $namtotnghiep=$_POST['namtotnghiep'];//: "2018"
        $ngaysinh=$_POST['ngaysinh'];//: "28-11-2018"
        $tgngaysinh=explode('-',$ngaysinh);        
        $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
        $noicongtac=$_POST['noicongtac'];//: "Quận Hoàng Mai"
        $noiohientai=$_POST['noiohientai'];//: "Lĩnh Nam"
        $password=$_POST['password'];//: "longtt123"
        $sang2=$_POST['sang2'];//: "0"
        $sang3=$_POST['sang3'];//: "0"
        $sang4=$_POST['sang4'];//: "0"
        $sang5=$_POST['sang5'];//: "0"
        $sang6=$_POST['sang6'];//: "0"
        $sang7=$_POST['sang7'];//: "0"
        $sang8=$_POST['sang8'];//: "0"
        $thanhtich=$_POST['thanhtich'];//: "thành tích"
        $toi2=$_POST['toi2'];//: "1"
        $toi3=$_POST['toi3'];//: "1"
        $toi4=$_POST['toi4'];//: "1"
        $toi5=$_POST['toi5'];//: "1"
        $toi6=$_POST['toi6'];//: "1"
        $toi7=$_POST['toi7'];//: "1"
        $toi8=$_POST['toi8'];//: "1"
        $phone=$_POST['sdt'];//: "0912308"

        $descusers=$gioithieubanthan;
        // $lop = $_POST['lop']; 
        // $classname = $this->site_model->GetClassByID($lop)->classname;

        if($_FILES['imageuser'] != null){
          if(!is_dir('upload/users/'.date("Y",time()).'/'.date("m",time()).'/'.date("d",time())))
          {
           mkdir('upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), 0755, TRUE);
           mkdir('upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), 0755, TRUE);
         }
         $filename = $_FILES['imageuser']['name'];
         $filedata = $_FILES['imageuser']['tmp_name'];
         $temp=explode('.',$filename);
         $imageThumb = new Image($filedata);		
         $thumb_path = "avatar".date("YmdHis",time()).rand(10000,99999);
         $imageThumb->save($thumb_path, 'upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
         $imageThumb->resize(300,300,'crop');
         $imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
         $imguser=$thumb_path.".".$temp[1];
         $arrdistrict=explode(',',$quanhuyen);
         $arrquanhuyen="";
         for($i=0;$i< count($arrdistrict);$i++){
          $j=$this->site_model->GetDistrictByID($arrdistrict[$i]);
          $arrquanhuyen[]=$j->cit_name." ";
        }
        $DistrictView=join(',',$arrquanhuyen) ;
        $lsttopic=$this->site_model->InsertUserTeacher($hoten,$hoten,$phone,$emailuser,$khuvucday,$tenkhuvucday,$quanhuyen,$DistrictView,$noiohientai,$descusers,1,$password,0,$imguser,'','',$gioitinh,$kinhnghiem,$thanhtich,$birth);
        if($lsttopic['data'] > 0){
          $code=$lsttopic['code'];
          $userid=$lsttopic['data'];
          $filename = $_FILES['cmnduser']['name'];
          $filedata = $_FILES['cmnduser']['tmp_name'];
          $temp=explode('.',$filename);			
          $imageThumb = new Image($filedata);
          $thumb_path = "cmnd".date("YmdHis",time()).rand(10000,99999);
          $imageThumb->save($thumb_path, 'upload/users/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
          $imageThumb->resize(300,300,'crop');
          $imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",time())."/".date("m",time())."/".date("d",time()), $temp[1]);
          $imgcmnd=$thumb_path.".".$temp[1];
          $arrsubject = explode(',',$monhoc);
          $arrlophoc  = explode(',', $lopday);
          // var_dump($arrlophoc);
          // die();
          // chuyển chuỗi sang mảng

          // $arrsubject=implode(",",$arrsubject1);
          // $TitleView=$arrsubject;
          // $TitleView.=join(',',$arrsubject) ;
          // var_dump($arrsubject);
          //   die();

          //phần cũ còn dùng được
          $TitleView="";
         
          $arrtitle="";
          // thêm lớp học có thể dạy
          $Classview = "";
          $arrclass  = "";
          for ($c=0; $c < count($arrlophoc) ; $c++) { 
            $k=$this->site_model->GetClassByID($arrlophoc[$c]);
            $arrclass[]=$k->classname." ";
          }
          for($i=0;$i< count($arrsubject);$i++){
            $j=$this->site_model->GetSubjectByID($arrsubject[$i]);
            $arrtitle[]=$j->SubjectName." ";
          }
          $TitleView.=join(',',$arrtitle);
          $Classview .=join(',',$arrclass);

          //phần cũ 

          $lsttopic=$this->site_model->InsertTeacher($userid,$hinhthucday,GetLearn($hinhthucday),$hientaila,$hocphi,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,'',$imgcmnd,0,$monhoc,$lopday,$TitleView,$chitietnoidung,$hoctruong,$chuyennganh,$namtotnghiep,$noicongtac);
          // var_dump($lsttopic);
          // die();
          if($lsttopic['data'] > 0){
            
                        // for($i=0;$i< count($arrsubject);$i++){
                        //     if($chudemonhoc == ''){
                        //         $tgtopic = '';
                        //         $result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$tgtopic,$tgtopic,$userid);
                        //     }
                        //     else
                        //     {
                        //         $tgtopic=$this->site_model->Listtopicbysubjectandidtopic($arrsubject[$i],$chudemonhoc);
                        //         $result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$tgtopic->ID,$tgtopic->NameTopic,$userid);
                        //     }
                        // }
            for($i=0;$i< count($arrsubject);$i++){
              $tgtopic=$this->site_model->Listtopicbysubjectandidtopic($arrsubject[$i],$chudemonhoc);
              foreach($tgtopic as $item){
                $result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$item->ID,$item->NameTopic,$userid);
              }
            }
            foreach ($arrdistrict as $key ){
              $j=$this->site_model->GetDistrictByID($key);
              $arrquanhuyen=$j->cit_name;
              $result2=$this->site_model->InsertTeacherDisctrict($key,$arrquanhuyen,$userid);
            }


            $result=['kq'=>true,'data'=>"$username",'file'=>'','msg'=>'Tạo tài khoản thành công','code'=>"$code"];
          }
        }
      }
      echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
    function ajaxteacherupdateinfo()
    {
      define('MB', 1048576);
      $result=['kq'=>false,'data'=>'','file'=>''];
      $chieu2=$_POST['chieu2'];
      $chieu3=$_POST['chieu3'];
      $chieu4=$_POST['chieu4'];
      $chieu5=$_POST['chieu5'];
      $chieu6=$_POST['chieu6'];
      $chieu7=$_POST['chieu7'];
      $chieu8=$_POST['chieu8'];
      $chitietnoidung=$_POST['chitietnoidung'];
      $chudemonhoc=$_POST['chudemonhoc'];//: "1,2,3,4,5,8,9,15,16,18,19,22"
      $chuyennganh=$_POST['chuyennganh'];//: "lớp 1"
      $emailuser=$_POST['emailuser'];//: "trantronglong87@gmail.com"
      $gioithieubanthan=$_POST['gioithieubanthan'];//: "giới thiệu bản thân"
      $gioitinh=$_POST['gioitinh'];//: "on"
      $hientaila=$_POST['hientaila'];//: "undefined"
      $hinhthucday=$_POST['hinhthucday'];//: "on"
      $hocphi=$_POST['hocphi'];//: "200000"
      $hoctruong=$_POST['hoctruong'];//: "tiểu học vĩnh hưng"
      $hoten=$_POST['hoten'];//: "Trần Trọng Long"
      $khuvucday=$_POST['khuvucday'];//: "1"
      $tenkhuvucday=$_POST['tenkhuvucday'];
      $quanhuyen = $_POST['quanhuyen'];
      $kinhnghiem=$_POST['kinhnghiem'];//: "kinh nghiệm đi dạy"
      $monhoc=$_POST['monhoc'];//: "1,10"
      $namtotnghiep=$_POST['namtotnghiep'];//: "2018"
      $ngaysinh=$_POST['ngaysinh'];//: "28-11-2018"
      $tgngaysinh=explode('-',$ngaysinh);        
      $birth=date("Y-m-d H:i:s",strtotime($tgngaysinh[2].'-'.$tgngaysinh[1].'-'.$tgngaysinh[0]));
      $noicongtac=$_POST['noicongtac'];//: "Quận Hoàng Mai"
      $noiohientai=$_POST['noiohientai'];//: "Lĩnh Nam"
      $sang2=$_POST['sang2'];//: "0"
      $sang3=$_POST['sang3'];//: "0"
      $sang4=$_POST['sang4'];//: "0"
      $sang5=$_POST['sang5'];//: "0"
      $sang6=$_POST['sang6'];//: "0"
      $sang7=$_POST['sang7'];//: "0"
      $sang8=$_POST['sang8'];//: "0"
      $thanhtich=$_POST['thanhtich'];//: "thành tích"
      $toi2=$_POST['toi2'];//: "1"
      $toi3=$_POST['toi3'];//: "1"
      $toi4=$_POST['toi4'];//: "1"
      $toi5=$_POST['toi5'];//: "1"
      $toi6=$_POST['toi6'];//: "1"
      $toi7=$_POST['toi7'];//: "1"
      $toi8=$_POST['toi8'];//: "1"
      $descusers=$gioithieubanthan;
      $imguser="";
      $userid=0;
        if(!empty($_SESSION['UserInfo'])){
          $tg=$_SESSION['UserInfo'];
          $userid=$tg['UserId'];
          $info = $this->site_model->GetInfoTeacher($userid);
          $created_date = strtotime($info->CreateDate);
          // var_dump($_FILES['imageuser']);die();
          if($_FILES['imageuser'] != null){

            if(!is_dir('upload/users/'.date("Y",$created_date).'/'.date("m",$created_date).'/'.date("d",$created_date)))
            {
             mkdir('upload/users/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), 0755, TRUE);
             mkdir('upload/users/thumb/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), 0755, TRUE);
           }           
           $filename = $_FILES['imageuser']['name'];
           $filedata = $_FILES['imageuser']['tmp_name'];
           if ($_FILES['imageuser']['size'] < 2*MB) {
            $temp=explode('.',$filename);
            $imageThumb = new Image($filedata);
            $thumb_path = "avatar".date("YmdHis",$created_date).rand(10000,99999);
            $imageThumb->save($thumb_path, 'upload/users/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), $temp[1]);
            $imageThumb->resize(300,300,'crop');
            $imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), $temp[1]);
            $imguser=$thumb_path.".".$temp[1];
            $result['isimagesizeavt'] = true;
           }
           else {
            $result['isimagesizeavt'] = false;
           }
           
         }
         else {
          $imguser="";
         }
         
         $arrdistrict=explode(',',$quanhuyen);
         $arrquanhuyen="";
         for($i=0;$i< count($arrdistrict);$i++){
          $j=$this->site_model->GetDistrictByID($arrdistrict[$i]);
          $arrquanhuyen[]=$j->cit_name." ";
        }
        $DistrictView=join(',',$arrquanhuyen) ;
        
        $lsttopic=$this->site_model->UpdateUsersT($userid,$hoten,$khuvucday,$tenkhuvucday,$quanhuyen,$DistrictView,$noiohientai,$descusers,$imguser,$gioitinh,$kinhnghiem,$thanhtich,$birth);
       
        if($lsttopic['kq'] ==true){

          $imgcmnd="";
          if($_FILES['cmnduser'] != null){
            $filename = $_FILES['cmnduser']['name'];
            $filedata = $_FILES['cmnduser']['tmp_name'];
            if ($_FILES[['cmnduser']['size']] < 2*MB) {
             $temp=explode('.',$filename);      
             $imageThumb = new Image($filedata);
             $thumb_path = "cmnd".date("YmdHis",$created_date).rand(10000,99999);
             $imageThumb->save($thumb_path, 'upload/users/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), $temp[1]);

             $imageThumb->resize(300,300,'crop');
             $imageThumb->save($thumb_path, 'upload/users/thumb/'.date("Y",$created_date)."/".date("m",$created_date)."/".date("d",$created_date), $temp[1]);
             $imgcmnd=$thumb_path.".".$temp[1]; 
             $result['isimagecmnd'] = true;
            }
            else {
             $result['isimagecmnd'] = false;
            } 
          }  
          else {
            $imgcmnd="";
           }              
          $arrsubject=explode(',',$monhoc);                
          $TitleView="";
          $arrtitle="";
          for($i=0;$i< count($arrsubject);$i++){
            $j=$this->site_model->GetSubjectByID($arrsubject[$i]);
            $arrtitle[]=$j->SubjectName." ";
          }
          $TitleView.=join(',',$arrtitle) ;
          $lsttopic=$this->site_model->UpdateTeacher($userid,$hinhthucday,GetLearn($hinhthucday),$hientaila,$hocphi,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,
            $sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$imgcmnd,$TitleView,$monhoc,$chitietnoidung,$hoctruong,$chuyennganh,$namtotnghiep,$noicongtac);
          if($lsttopic['kq'] ==true){
            $xoatopic=$this->site_model->DeleteTeacherTopic($userid);
            for($i=0;$i< count($arrsubject);$i++){
              $tgtopic=$this->site_model->Listtopicbysubjectandidtopic($arrsubject[$i],$chudemonhoc);
              foreach($tgtopic as $item){
                $result1=$this->site_model->InsertTeacherTopic($arrsubject[$i],$arrtitle[$i],$item->ID,$item->NameTopic,$userid);
              }
            }
            $ip = time();
            $result['kq']   = true;
            $result['data'] = $hoten;
            $result['msg']  = 'Cập nhật thành công'; 
            // $result=['kq'=>true,'data'=>$hoten,'file'=>'','msg'=>'Cập nhật thành công'];
          }
        }
      }
      echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }

  function ajaxupdateusersinfomation2()
  {
    $result=['kq'=>false,'data'=>""];
    $gioitinh=$this->input->post('gioitinh');
    $diachi=$this->input->post('diachi');
    $hoten=$this->input->post('hoten');
    $ngaysinh=$this->input->post('ngaysinh');
    $mota=$this->input->post('mota');

    if(!empty($_SESSION['UserInfo'])){
      $tg=$_SESSION['UserInfo'];
      $userid=$tg['UserId'];
      $kq=$this->site_model->GetUserInfoByUserID($userid);            
      $imguser=$kq->Image;
      $tgbirth=explode('-',$ngaysinh);
      $Birth=date("Y-m-d",strtotime($tgbirth[2]."-".$tgbirth[1]."-".$tgbirth[0]));
      $kg=$this->site_model->UpdateUsers2($userid,$hoten,$kq->CityID,$kq->CityName,$diachi,$mota,
      $imguser,$gioitinh,$kq->Exp,$kq->Bonus,$Birth);	
      if($kg['kq'] == true){
        $result=['kq'=>true,'data'=>'Cập nhật tài khoản thành công'];
      }else if($kg['kq']==false){
        $result=['kq'=>false,'data'=>$kg['data']];
      }
    }
    echo json_encode($result,JSON_UNESCAPED_UNICODE);

  }
  function upload_file() {

    $this->load->helper('file');
        //upload file
        $config['upload_path'] = 'upload/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_filename'] = '255';
        // $config['encrypt_name'] = TRUE;
        $config['overwrite'] = 'FALSE ';
        $config['max_size'] = '2048'; //2 MB

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } 
            else if($config['max_size']>2048){
              echo 'Kích thước file không được lớn hơn 2MB' . $_FILES['file']['error'];
            }
            else {
                if (file_exists('uploads/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/' . $_FILES['file']['name'];
                } else {
                  $this->load->library('upload');
                  $this->upload->initialize($config);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
                      if(!empty($_SESSION['UserInfo'])){
                        $tg=$_SESSION['UserInfo'];
                        $userid=$tg['UserId'];
                        $kq=$this->site_model->GetUserInfoByUserID($userid);
                        $fileimage=$_FILES['file']['name'];
                        // $kq_image=$this->site->model->Checkimage($userid,$fileimage);
                      $kg1=$this->site_model->Updateimage2($userid,$fileimage);
                      if($kg1['kq1'] == true){
                        $result=['kq1'=>true,'data'=>'Cập nhật  thành công'];
                      }else if($kg1['kq1']==false){
                        $result=['kq1'=>false,'data'=>$kg1['data']];
                      }
                        // echo  'File successfully uploaded : uploads/images/' . $_FILES['file']['name'];
                      }
                    }
                }
            }
        } else {
            echo 'Please choose a file';
        }
        echo json_encode($result,JSON_UNESCAPED_UNICODE);
    }
  function ajaxviewcontactinfo()
  {

    $result=['kq'=>false,'data'=>""];
    $keyview=$this->input->post('keyview');
    $Userid = $_SESSION['UserInfo']['UserId'];
    $userlogin = $kq=$this->site_model->GetUserInfoByUserID($Userid); 
    $UserType = $userlogin->UserType;
    // 1: giao  vien , 0 gia su: 
    if ($UserType ==1 || is_null($UserType)) { //is_null($UserType)
      $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
    }
    else {

      $tgkey=explode('_',$keyview);
      if(strtolower($tgkey[0]==='users')|| strtolower($tgkey[0]==='class')){
        $tg=$_SESSION['UserInfo'];
        $userid=$tg['UserId'];
        $kq=$this->site_model->GetUserInfoByUserID($userid);  
        $configpoint=$this->site_model->getpointconfig();          

        $kg=$this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview);  
        if($kg['kq'] == true){
          $result=['kq'=>true,'data'=>'Xem thông tin thành công'];
        }
      }else{
       $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
     }
    }
   //  if(!empty($_SESSION['UserInfo'])){
   //    $tgkey=explode('_',$keyview);
   //    if(strtolower($tgkey[0]==='users')|| strtolower($tgkey[0]==='class')){
   //      $tg=$_SESSION['UserInfo'];
   //      $userid=$tg['UserId'];
   //      $kq=$this->site_model->GetUserInfoByUserID($userid);  
   //      $configpoint=$this->site_model->getpointconfig();          

   //      $kg=$this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview);	
   //      if($kg['kq'] == true){
   //        $result=['kq'=>true,'data'=>'Xem thông tin thành công'];
   //      }
   //    }else{
   //     $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
   //   }

   // }
   echo json_encode($result,JSON_UNESCAPED_UNICODE);
 }
 function ajaxviewcontactinfo1()
  {

    $result=['kq'=>false,'data'=>""];
    $keyview=$this->input->post('keyview');
    $Userid = $_SESSION['UserInfo']['UserId'];
    $userlogin = $kq=$this->site_model->GetUserInfoByUserID($Userid); 
    $UserType = $userlogin->UserType;
    // 1: giao  vien , 0 gia su: 
    if ($UserType ==0 || is_null($UserType)) { //is_null($UserType)
      $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
    }
    else {

      $tgkey=explode('_',$keyview);
      if(strtolower($tgkey[0]==='users')|| strtolower($tgkey[0]==='class')){
        $tg=$_SESSION['UserInfo'];
        $userid=$tg['UserId'];
        $kq=$this->site_model->GetUserInfoByUserID($userid);  
        $configpoint=$this->site_model->getpointconfig();          

        $kg=$this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview);  
        if($kg['kq'] == true){
          $result=['kq'=>true,'data'=>'Xem thông tin thành công'];
        }
      }else{
       $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
     }
    }
   //  if(!empty($_SESSION['UserInfo'])){
   //    $tgkey=explode('_',$keyview);
   //    if(strtolower($tgkey[0]==='users')|| strtolower($tgkey[0]==='class')){
   //      $tg=$_SESSION['UserInfo'];
   //      $userid=$tg['UserId'];
   //      $kq=$this->site_model->GetUserInfoByUserID($userid);  
   //      $configpoint=$this->site_model->getpointconfig();          

   //      $kg=$this->site_model->addlogpoint($userid,2,(0 - $configpoint->PointSub),1,$keyview); 
   //      if($kg['kq'] == true){
   //        $result=['kq'=>true,'data'=>'Xem thông tin thành công'];
   //      }
   //    }else{
   //     $result=['kq'=>false,'data'=>'dữ liệu truyền không đúng'];
   //   }

   // }
   echo json_encode($result,JSON_UNESCAPED_UNICODE);
 }
 function ajaxrefreshusers()
 {
  $result=['kq'=>false,'data'=>""];
  if(!empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $userid=$tg['UserId']; 
    $kg=$this->site_model->refreshclass($userid);
    if($kg['kq'] == true){
      $result=['kq'=>true,'data'=>'Cập nhật tài khoản thành công'];
    }
  }
  echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function ajaxuserregisterphuhuynh ()
{
  $result=['kq'=>false,'data'=>''];
  $hoten = $_POST['hoten'];
  $email = $_POST['email'];
  $sdt = $_POST['sdt'];
  $pass = $_POST['pass'];
  $type = 0;
  $result = $this->site_model->registerphuhuynh($hoten, $email, $sdt, $pass, $type);
  echo json_encode($result);
}
function ajaxuserregistersuccess()
{
  $result=['kq'=>false,'data'=>''];
  $hoten=$_POST['hoten'];
  $password=$_POST['password'];
  $username=$_POST['username'];
  $topicarr=$_POST['topicarr'];
  $classname=$_POST['classname'];
  $teachertype=$_POST['teachertype'];
  $teachersex=$_POST['teachersex'];
  $monhoc=$_POST['monhoc'];
  $tenmonhoc=$_POST['tenmonhoc'];
  $studens=$_POST['studens'];
  $hours=$_POST['hours'];
  $workid=$_POST['workid'];
  $money=$_POST['money'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $cityid=$_POST['cityid'];
  $address=$_POST['address'];
  $descclass=$_POST['descclass'];
  $sang2=$_POST['sang2'];
  $chieu2=$_POST['chieu2'];
  $toi2=$_POST['toi2'];
  $sang3=$_POST['sang3'];
  $chieu3=$_POST['chieu3'];
  $toi3=$_POST['toi3'];
  $sang4=$_POST['sang4'];
  $chieu4=$_POST['chieu4'];
  $toi4=$_POST['toi4'];
  $sang5=$_POST['sang5'];
  $chieu5=$_POST['chieu5'];
  $toi5=$_POST['toi5'];
  $sang6=$_POST['sang6'];
  $chieu6=$_POST['chieu6'];
  $toi6=$_POST['toi6'];
  $sang7=$_POST['sang7'];
  $chieu7=$_POST['chieu7'];
  $toi7=$_POST['toi7'];
  $sang8=$_POST['sang8'];
  $chieu8=$_POST['chieu8'];
  $toi8=$_POST['toi8'];
  $cityname=$_POST['cityname'];
  $metatitle=$classname." ,".$cityname;
  $metadesc=$descclass;
  $descusers='';
  $birth=date("Y-m-d H:i:s",1514798979);
  $ExpectedDate=date("Y-m-d H:i:s",time());
  $metakey=$classname.", gia sư 365, gia sư ".$tenmonhoc.", gia sư tại ".$cityname;
  $lsttopic=$this->site_model->InsertUser($hoten,$username,$username,$email,$cityid,$cityname,$address,$descusers,0,$password,0,'','','',0,'','',$birth);
  if($lsttopic['data'] > 0){
    $code=$lsttopic['code'];
    $userid=$lsttopic['data'];
    $resultclass=$this->site_model->InsertClass($classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$userid,$descclass,1,$studens,$teachersex,$ExpectedDate,$userid,$teachertype);
    $classid=$resultclass['data'];
    if($classid > 0){
      $resultmeta=$this->site_model->InsertClassMeta($classid,$metadesc,$metatitle,$metakey,'','');
      if($resultmeta['data']>0){
        $result=['kq'=>true,'data'=>"$userid",'classid'=>"$classid",'code'=>$code,'uname'=>"$username"];
        $ip = time();
            //$result=json_decode($result,true);
            //var_dump($result->UserId);die();
        $remember=0;
        $type=0;
        $token = $this->site_model->create_token($userid,$ip,$remember);            
        $profileData = array("UserId" => $userid,
         "UserName" => $username,
         "EmailAddress" => $email,
         "FullName" => $hoten, 
         "Phone"=>$phone,                                
         "TokentKey" => $token,
         "Type"=>$type,
         "Balance"=>0);
        $_SESSION['UserInfo'] = $profileData;
      }
    }
  }
  echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function cate(){

  
}
function ajaxuserupdateclass()
{
  $result=['kq'=>false,'data'=>''];
  $classid  =  $_POST['uc'];    
  $topicarr=$_POST['topicarr'];
  $classname=$_POST['classname'];
  $teachertype=$_POST['teachertype'];
  $teachersex=$_POST['teachersex'];
  $monhoc=$_POST['monhoc'];
  $tenmonhoc=$_POST['tenmonhoc'];
  $studens=$_POST['studens'];
  $hours=$_POST['hours'];
  $workid=$_POST['workid'];
  $money=$_POST['money'];        
  $phone=$_POST['phone'];
  $cityid=$_POST['cityid'];
  $address=$_POST['address'];
  $descclass=$_POST['descclass'];
  $sang2=$_POST['sang2'];
  $chieu2=$_POST['chieu2'];
  $toi2=$_POST['toi2'];
  $sang3=$_POST['sang3'];
  $chieu3=$_POST['chieu3'];
  $toi3=$_POST['toi3'];
  $sang4=$_POST['sang4'];
  $chieu4=$_POST['chieu4'];
  $toi4=$_POST['toi4'];
  $sang5=$_POST['sang5'];
  $chieu5=$_POST['chieu5'];
  $toi5=$_POST['toi5'];
  $sang6=$_POST['sang6'];
  $chieu6=$_POST['chieu6'];
  $toi6=$_POST['toi6'];
  $sang7=$_POST['sang7'];
  $chieu7=$_POST['chieu7'];
  $toi7=$_POST['toi7'];
  $sang8=$_POST['sang8'];
  $chieu8=$_POST['chieu8'];
  $toi8=$_POST['toi8'];
  $cityname=$_POST['cityname'];
  $metatitle=$classname." ,".$cityname;
  $metadesc=$descclass;
  $lopday = $_POST['lopday'];
  $quanhuyen = $_POST['districtid'];




  $metakey=$classname.", gia sư 365, gia sư ".$tenmonhoc.", gia sư tại ".$cityname;
  $num = array_count_values(array($sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8));
  if(!empty($_SESSION['UserInfo'])){
    $tg=$_SESSION['UserInfo'];
    $userid=$tg['UserId'];
    $resultclass=['kq'=>false,'data'=>0];
    if(intval($classid)>0){
      $resultclass=$this->site_model->UpdateClass($classid,$classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$descclass,$num[1],$studens,$teachersex,$ExpectedDate,$teachertype,$lopday,$quanhuyen);
      if($resultclass['kq']==true){
       $result =['kq'=>true,'data'=>'Cập nhật thành công'];
     }
   }else{
    $resultclass=$this->site_model->InsertClass($classname,$monhoc,$tenmonhoc,$topicarr,$money,$hours,$workid,$phone,$cityid,$address,$sang2,$chieu2,$toi2,$sang3,$chieu3,$toi3,$sang4,$chieu4,$toi4,$sang5,$chieu5,$toi5,$sang6,$chieu6,$toi6,$sang7,$chieu7,$toi7,$sang8,$chieu8,$toi8,$userid,$descclass,$num[1],$studens,$teachersex,$ExpectedDate,$userid,$teachertype,$lopday,$quanhuyen);
    $classid=$resultclass['data'];
    if($classid > 0){
      $resultmeta=$this->site_model->InsertClassMeta($classid,$metadesc,$metatitle,$metakey,'','');
      if($resultmeta['data']>0){
        $result=['kq'=>true,'data'=>'Thêm mới thành công'];
      }
    }
  }
}
echo json_encode($result,JSON_UNESCAPED_UNICODE);
}
function listclassbyfilter($alias1, $subject,$class,$city)
{
  $page=$start_row=$this->uri->segment(2);
  $classid      = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;
  $data['showsearch']=true;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  }
  $data['topkey'] = $this->site_model->ListTopKeywork();
  $topic=0;$type=0;$sex=0; // $type = 1
  $key='';
  $keywork = '';
  $perpage=20;
  if(empty($page)||intval($page)==0){
    $page=0;
  }else{
    $page=intval($page);
  }
  if($page <= 20){
    $data['robots']= 'noindex,nofollow';
  }else{
   $data['robots']= 'noindex,nofollow';
  }

  if(intval($class)==0)
  {
    $classname = '';
  }
  else
  {
    $classname  = $this->site_model->SelectClassByid($class)->classname;
      
  }
  $data['keyfilter']=['keywork'=>$key,'subject'=>$subject,'class'=>$class,'topic'=>$topic,'place'=>$city,'type'=>$type,'sex'=>$sex];
  $data['lstitem']=$this->site_model->GetListClassBySearch($key,$subject,$classid,$topic,$city,$type,$sex,0,20);
  $data['monhoc']=$this->site_model->ListSubject();
  $data['lop']=$this->site_model->ListClass($class);
  $data['districk']=$this->site_model->GetListdistrictbycity();
  $data['lstonline']=$this->site_model->GetListClassbyUserOnline();
  $tinhthanh="";
  $monhoc="";
  $lop="";
  if(intval($subject)>0){
    $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
    $data['subjectname']=$monhoc->SubjectName;
  }
  if(intval($class)>0){
    $lop=$this->site_model->SelectClassByid(intval($class));
    $data['classname']=$lop->classname;
  }
  if(intval($city)>0){
    $tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
    $data['cityname']=$tinhthanh->cit_name;
  }
  $total=$this->site_model->GetListClassBySearchTotal($keywork,$subject,$lop->classid,$topic,$city,$type,$sex);
  $meta="";$desc="";$metakey="";

  $baiviettimlop = $this->site_model->BaiVietTimLop();
  $data['baiviettimlop']=$baiviettimlop;
  $linkdata = $baiviettimlop->link;
 
  if(!empty(CheckSubject($subject)) && intval($class)==0 && intval($city)==0)
  {
    $link=base_url().'viec-lam-gia-su-mon-'.vn_str_filter($monhoc->SubjectName).'-s'.intval($subject).'c0p0.html';
    if($link == $linkdata){
      $metakey=$baiviettimlop->meta_key;
      $meta=$baiviettimlop->meta_title;
      $desc=$baiviettimlop->meta_des;
    }
    else{
      if ($this->site_model->check_viec_subject($subject) > 0) {
        $seosubject = $this->site_model->Get_viec_subject($monhoc->ID);
       $metakey = $seosubject[0]->keywork;
       $meta = $seosubject[0]->title;
       $desc = $seosubject[0]->description;
      } else {
        $metakey="Việc làm gia sư ".$monhoc->SubjectName;
        $meta="Việc làm gia sư ".$monhoc->SubjectName." uy tín";
        $desc="Tìm việc làm gia sư ".$monhoc->SubjectName." uy tín. Thông tin về việc làm gia sư  ".$monhoc->SubjectName." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
      }
    }
  }
  else if(!empty(CheckClass($class)) && intval($subject)==0 && intval($city)==0)
  {
    $link=base_url().'viec-lam-gia-su-'.vn_str_filter($lop->classname).'-s0c'.intval($class).'p0.html';
    if($link == $linkdata){
      $metakey=$baiviettimlop->meta_key;
      $meta=$baiviettimlop->meta_title;
      $desc=$baiviettimlop->meta_des;
    }
    else{
      $metakey="Việc làm gia sư ".$lop->classname;
      $meta="Việc làm gia sư ".$lop->classname." uy tín";
      $desc="Tìm việc làm gia sư ".$lop->classname." uy tín. Thông tin về việc làm gia sư  ".$lop->classname." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
    }
  }
  else if(!empty( CheckCity($city)) && intval($subject)==0 && intval($class)==0 && intval($district)==0)
  {
    $link=base_url().'viec-lam-gia-su-'.vn_str_filter($tinhthanh->cit_name).'-s0c0p'.intval($city).'.html';
    if($link == $linkdata){
      $metakey=$baiviettimlop->meta_key;
      $meta=$baiviettimlop->meta_title;
      $desc=$baiviettimlop->meta_des;
    }
    else{
     if ($this->site_model->check_viec_city($city) > 0) {
       $seocity = $this->site_model->Get_viec_city($city);
       $metakey = $seocity[0]->keywork;
       $meta = $seocity[0]->title;
       $desc = $seocity[0]->description;
     } else {
       $metakey="Việc làm gia sư tại ".$tinhthanh->cit_name;
       $meta="Việc làm gia sư tại ".$tinhthanh->cit_name." uy tín";
       $desc="Tìm việc làm gia sư tại ".$tinhthanh->cit_name." uy tín. Thông tin về việc làm gia sư tại ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
     }
    }
  }
  $data['nav_search'] = 2;
  $data['canonical']=$link;
  $data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,1);
  $data['meta_title']=$meta;//$sql->title;
  $data['meta_key']=$metakey;
  $data['meta_des']=$desc;
  $this->load->library('pagination');
  $config['total_rows'] = $total;
  $config['per_page'] = $perpage;
  $config['uri_segment'] =2;
  $config['next_link'] = '<i class="fa fa-angle-right"></i>';
  $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
  $config['num_links'] = 4;
  $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
  $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
  $config['base_url']=$link;
  $this->pagination->initialize($config);
  $data['total']=$total;
  $data['start_row']= $page;
  $data['pagination']= $this->pagination->create_links();
  $data['content']='listclassbyfilter';
  $data['classheader']='navbar navbar-default white bootsnav on no-full';
  $data['cssbody']='customsl'	;
  $this->load->view('template',$data);
}


function listclassbyfilter_clone($alias1, $alias2, $subject, $class, $city)
{
  $page=$start_row=$this->uri->segment(2);
  $classid    = $this->site_model->SelectClassByid($class)->id;
  $data['home'] = false;
  $data['showsearch']=true;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  }
  $topic=0;$type=0;$sex=0; // $type =1
  $key='';
  $keywork = '';
  $perpage=20;
  if(empty($page)||intval($page)==0){
    $page=0;
  }else{
    $page=intval($page);
  }
  if($page <= 20){
    $data['robots']= 'noindex,nofollow';
  }else{
   $data['robots']= 'noindex,nofollow';
 }
$data['topkey'] = $this->site_model->ListTopKeywork();
 if(intval($class)==0)
 {
  $classname = '';
}
else
{
  $classname = $this->site_model->SelectClassByid($class)->classname;
}
// $class
$data['keyfilter'] = ['keywork' => $key, 'subject' => $subject, 'class' => $class, 'topic' => $topic, 'place' => $city,'district' =>$district, 'type' => $type, 'sex' => $sex];
$data['lstitem']=$this->site_model->ListClassBySearchHeader($keywork,$subject,$classid,$place,$district, $order,0,20);
$data['lienquan']=$this->site_model->GetListClassRelate($subject,$class,$place,$district);
$data['monhoc']=$this->site_model->ListSubject();
$data['lop']=$this->site_model->ListClass($class);
$data['districk']=$this->site_model->GetListdistrictbycity();
$data['lstonline']=$this->site_model->GetListClassbyUserOnline();
$tinhthanh="";
$monhoc="";
$lop="";
if(intval($subject)>0){
  $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
  $data['subjectname']=$monhoc->SubjectName;
}
if(intval($class)>0){
  $lop=$this->site_model->SelectClassByid(intval($class));
  $data['classname']=$lop->classname;
}
if(intval($city)>0){
  $tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
  $data['cityname']=$tinhthanh->cit_name;
}
$baiviettimlop = $this->site_model->BaiVietTimLop();
$data['baiviettimlop']=$baiviettimlop;
$linkdata = $baiviettimlop->link;
if(!empty(CheckSubject1($subject)) && (intval($city)==1 ||intval($city)==45) && intval($class)==0 && intval($district)==0)
{

  $link=base_url().'viec-lam-gia-su-mon-'.vn_str_filter($monhoc->SubjectName).'/'.vn_str_filter($tinhthanh->cit_name).'-m'.intval($subject).'c0p'.intval($place).'.html';
  if($link == $linkdata){
    $metakey=$baiviettimlop->meta_key;
    $meta=$baiviettimlop->meta_title;
    $desc=$baiviettimlop->meta_des;
  }
  else{
    $metakey="Việc làm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name;
    $meta="Việc làm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." uy tín";
    $desc="Tìm việc làm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." uy tín. Thông tin về việc làm gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
  }
}
else if(!empty(CheckSubject1($subject)) && !empty(CheckClass($class)) && intval($city)==0)
{
  $link=base_url().'viec-lam-gia-su-mon-'.vn_str_filter($monhoc->SubjectName).'/'.vn_str_filter($lop->classname).'-m'.intval($subject).'c'.intval($class).'p0.html'; 
  if($link == $linkdata){
    $metakey=$baiviettimlop->meta_key;
    $meta=$baiviettimlop->meta_title;
    $desc=$baiviettimlop->meta_des;
  }
  else{
    $metakey="Việc làm gia sư ".$monhoc->SubjectName." ".$lop->classname;
    $meta="Việc làm gia sư ".$monhoc->SubjectName." ".$lop->classname." uy tín";
    $desc="Tìm việc làm gia sư ".$monhoc->SubjectName." ".$lop->classname." uy tín. Thông tin về việc làm gia sư ".$monhoc->SubjectName." ".$lop->classname." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
  }
}
// $lop->classname
$total=$this->site_model->GetListClassBySearchTotal($keywork,$subject,$classid,$topic,$city,$type,$sex);
$meta="";$desc="";$metakey="";

$data['canonical']=$link;
$data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,1);
        $data['meta_title']=$meta;//$sql->title;
        $data['meta_key']=$metakey;
        $data['meta_des']=$desc;
        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['uri_segment'] =2;
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        $config['num_links'] = 4;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
        $this->pagination->initialize($config);
        $data['total']=$total;
        $data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        $data['content']='listclassbyfilter';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl' ;
        $this->load->view('template',$data);
      }
function listclassbyfilter_TPHCM($alias1, $alias2, $city, $district)
{
  $page=$start_row=$this->uri->segment(2);
  $data['home'] = false;
  $data['showsearch']=true;
  if(!empty($sql->name)){
    $data['metah1']=$sql->name;
  }else{
    $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
  }
  $topic=0;$type=0;$sex=0; // $type =1
  $key='';
  $keywork = '';
  $perpage=20;
  if(empty($page)||intval($page)==0){
    $page=0;
  }else{
    $page=intval($page);
  }
  if($page <= 20){
    $data['robots']= 'noindex,nofollow';
  }else{
   $data['robots']= 'noindex,nofollow';
 }
$data['topkey'] = $this->site_model->ListTopKeywork();
 if(intval($class)==0)
 {
  $classname = '';
}
else
{
  $classname = $this->site_model->SelectClassByid($class)->classname;
}
$data['keyfilter'] = ['keywork' => $key, 'subject' => $subject, 'class' => $class, 'topic' => $topic, 'place' => $city,'district' =>$district, 'type' => $type, 'sex' => $sex];
$data['lstitem']=$this->site_model->ListClassBySearchHeader($keywork,$subject,$class,$place,$district, $order,0,20);
$data['lienquan']=$this->site_model->GetListClassRelate($subject,$class,$place,$district);
$data['monhoc']=$this->site_model->ListSubject();
$data['lop']=$this->site_model->ListClass($class);
$data['districk']=$this->site_model->GetListdistrictbycity();
$data['lstonline']=$this->site_model->GetListClassbyUserOnline();
$tinhthanh="";
$monhoc="";
$lop="";
if(intval($subject)>0){
  $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
  $data['subjectname']=$monhoc->SubjectName;
}
if(intval($class)>0){
  $lop=$this->site_model->SelectClassByid(intval($class));
  $data['classname']=$lop->classname;
}
if(intval($city)>0){
  $tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
  $data['cityname']=$tinhthanh->cit_name;
}
if(intval($district)>0){
  $quanhuyen=$this->site_model->SelectDistrictID(intval($district));
  $data['district']=$quanhuyen->cit_name;
}
$baiviettimlop = $this->site_model->BaiVietTimLop();
$data['baiviettimlop']=$baiviettimlop;
$linkdata = $baiviettimlop->link;
if(intval($place)==45 && intval($district)>0 && intval($subject)==0 && intval($class)==0)
{
  $link=base_url().'viec-lam-gia-su-'.vn_str_filter($tinhthanh->cit_name).'/'.vn_str_filter($quanhuyen->cit_name).'-p45d'.intval($district).'.html';
  if($link == $linkdata){
    $metakey=$baiviettimlop->meta_key;
    $meta=$baiviettimlop->meta_title;
    $desc=$baiviettimlop->meta_des;
  }
  else{
    $metakey="Việc làm gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name;
    $meta="Việc làm gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." uy tín";
    $desc="Tìm việc làm gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." uy tín. Thông tin về việc làm gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
  }
}
$total=$this->site_model->GetListClassBySearchTotal($keywork,$subject,$lop->classname,$topic,$city,$type,$sex);
$meta="";$desc="";$metakey="";

$data['canonical']=$link;
$data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,1);
        $data['meta_title']=$meta;//$sql->title;
        $data['meta_key']=$metakey;
        $data['meta_des']=$desc;
        $this->load->library('pagination');
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['uri_segment'] =2;
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        $config['num_links'] = 4;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url']=$link;
        $this->pagination->initialize($config);
        $data['total']=$total;
        $data['start_row']= $page;
        $data['pagination']= $this->pagination->create_links();
        $data['content']='listclassbyfilter';
        $data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']='customsl' ;
        $this->load->view('template',$data);
      }


      function listteacherbyfilter_clone($alias1, $alias2, $subject, $class, $city)
      {
        $page = $start_row = $this->uri->segment(2);
        $data['home'] = false;
        $data['showsearch'] = true;
        if (!empty($sql->name)) {
          $data['metah1'] = $sql->name;
        } else {
          $data['metah1'] = 'SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
        }
        $data['topkey'] = $this->site_model->ListTopKeywork();
       
        $perpage = 10;
        if (empty($page) || intval($page) == 0) {
          $page = 0;
        } else {
          $page = intval($page);
        }
        if ($page <= 10) {
          $data['robots'] = 'noindex,nofollow';
        } else {
          $data['robots'] = 'noindex,nofollow';
        }
        $topic = 0;
        $type = 0;
        $sex = 0;
        $key = '';
        $keywork = '';
        $meta = "";
        $desc = "";
        $metakey = "";
        $day = date('m/Y', time());
        $year = date('Y', time());
        $data['keyhome'] = 1;
        if (intval($class) == 0) {
          $classname = '';
        } else {
          $classname = $this->site_model->SelectClassByid($class)->classname;
        }
        $district=0;
        $order = 'last';
        $data['keyfilter'] = ['keywork' => $key, 'subject' => $subject, 'class' => $class, 'topic' => $topic, 'place' => $city,'district' =>$district, 'type' => $type, 'sex' => $sex];
        $result = $this->site_model->GetListTeacherBySearch($key, $subject, $classname, $topic, $city,$district, $type, $sex, $order, $page, $perpage);
        // var_dump($subject, $classname);
        // var_dump($result);
        // die();
        $lq = $this->site_model->GetTeacherRelate($subject,$classname,$city,$topic, $district);
        $data['lienquan']=$lq["data"];
        $tinhthanh = "";
        $monhoc = "";
        if (intval($subject) > 0) {
          $monhoc = $this->site_model->selectsubjectbyid(intval($subject));
          $data['subjectname'] = $monhoc->SubjectName;
        }
        if (intval($city) > 0) {
          $tinhthanh = $this->site_model->SelectProvinceByID1(intval($city));
          $data['cityname'] = $tinhthanh->cit_name;
        }
        if (intval($class) > 0) {
          $lop = $this->site_model->SelectClassByid(intval($class));
          $data['classname'] = $lop->classname;
        }
        $baiviettimgiasu = $this->site_model->BaiVietTimGiaSu();
        $data['baiviettimgiasu']=$baiviettimgiasu;
        $linkdata = $baiviettimgiasu->link;

        if(!empty(CheckSubject1($subject)) && (!empty($city)) && intval($class)==0 && intval($district)==0)
        {

          $link=base_url().'mon-'.vn_str_filter($monhoc->SubjectName).'/'.vn_str_filter($tinhthanh->cit_name).'-s'.intval($subject).'r0c'.intval($city).'.html';

          if($link == $linkdata){
            $metakey=$baiviettimgiasu->meta_key;
            $meta=$baiviettimgiasu->meta_title;
            $desc=$baiviettimgiasu->meta_des;
          }
          else{
            if ($this->site_model->check_seo_subject_city($monhoc->ID, $city) > 0) {

             $seosubject = $this->site_model->Get_seo_city_subject($monhoc->ID, $city);
             $metakey = $seosubject[0]->keywork;
             $meta = $seosubject[0]->title;
             $desc = $seosubject[0]->description;
            } else {
               $metakey="gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name;
            $meta="Tìm gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." uy tín";
            $desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." uy tín. Thông tin về gia sư ".$monhoc->SubjectName." tại ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
            }
          }
        }
        else if(!empty(CheckSubject1($subject)) && !empty(CheckClass($class)) && intval($city)==0)
        {
          $link=base_url().'mon-'.vn_str_filter($monhoc->SubjectName).'/'.vn_str_filter($lop->classname).'-s'.intval($subject).'r'.intval($class).'c0.html';
          if($link == $linkdata){
            $metakey=$baiviettimgiasu->meta_key;
            $meta=$baiviettimgiasu->meta_title;
            $desc=$baiviettimgiasu->meta_des;
          }
          else{ 
            $metakey="gia sư ".$monhoc->SubjectName." ".$lop->classname;
            $meta="Tìm gia sư dạy kèm ".$monhoc->SubjectName." ".$lop->classname." uy tín";
            $desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." ".$lop->classname." uy tín. Thông tin về gia sư ".$monhoc->SubjectName." ".$lop->classname." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
          }
        }

        $data['linkseo'] = $this->site_model->getitemlinkseobuysearch($subject, $city, 2);
        $data['lstitem'] = $result['data'];
        $this->load->library('pagination');
        $config['total_rows'] = $result['total'];
        $config['per_page'] = $perpage;
        $config['uri_segment'] = 2;
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        $config['num_links'] = 4;
        $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
        $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
        $config['base_url'] = $link;
        $this->pagination->initialize($config);
        $data['total'] = $result['total'];
        $data['order'] = $order;
        $data['start_row'] = $page;
        $data['pagination'] = $this->pagination->create_links();
        $data['monhoc'] = $this->site_model->ListSubject();
        $data['chude'] = $this->site_model->GetTeacherFeature();
        $data['districk'] = $this->site_model->CountTeacherbyCity();
        $data['lstonline'] = $this->site_model->GetTeacherOnline(10);
        $data['selectbox'] = base_url() . "giao-vien&key=" . $keywork . "&subject=" . intval($subject) . "&topic=" . intval($topic) . "&place=" . intval($place) . "&type=" . intval($type) . "&sex=" . intval($sex) . "&order=" . $order;
        $data['canonical'] = $link;
        $sql = $this->site_model->gettblwidthid('tbl_meta', 1);
        $data['meta_title'] = $meta;
        $data['meta_key'] = $metakey;
        $data['meta_des'] = $desc;
        $data['robots'] = 'noindex,nofollow';
        $data['content'] = 'listteacherbyfilter'; 
        $data['classheader'] = 'navbar navbar-default white bootsnav on no-full';
    $data['cssbody'] = ''; //customsl
    $data['showsupport'] = true;
    $this->load->view('template', $data);
  }


  function listteacherbyfilter_TPHCM($alias1, $alias2, $city, $district)
  {
    $page = $start_row = $this->uri->segment(2);
    $data['home'] = false;
    $data['showsearch'] = true;
    if (!empty($sql->name)) {
      $data['metah1'] = $sql->name;
    } else {
      $data['metah1'] = 'SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }
    $perpage = 10;
    if (empty($page) || intval($page) == 0) {
      $page = 0;
    } else {
      $page = intval($page);
    }
    if ($page <= 10) {
      $data['robots'] = 'noindex,nofollow';
    } else {
      $data['robots'] = 'noindex,nofollow';
    }
    $topic = 0;
    $type = 0;
    $sex = 0;
    $key = '';
    $keywork = '';
    $meta = "";
    $desc = "";
    $metakey = "";
    $day = date('m/Y', time());
    $year = date('Y', time());
    $data['keyhome'] = 1;
    $order = 'last';
    $data['topkey'] = $this->site_model->ListTopKeywork();
    
    $data['keyfilter'] = ['keywork' => $key, 'subject' => $subject, 'class' => $class, 'topic' => $topic, 'place' => $city, 'district' => $district, 'type' => $type, 'sex' => $sex];
   
    $tinhthanh = "";
    $monhoc = "";
    if (intval($subject) > 0) {
      $monhoc = $this->site_model->selectsubjectbyid(intval($subject));
      $data['subjectname'] = $monhoc->SubjectName;
    }
    if (intval($city) > 0) {
      $tinhthanh = $this->site_model->SelectProvinceByID1(intval($city));
      $data['cityname'] = $tinhthanh->cit_name;
    }
    if (intval($class) > 0) {
      $lop = $this->site_model->SelectClassByid(intval($class));
      $data['classname'] = $lop->classname;
    }
    if(intval($district)>0){
       $quanhuyen=$this->site_model->SelectDistrictID(intval($district));
       $data['district']=$quanhuyen->cit_name;
     }
     $baiviettimgiasu = $this->site_model->BaiVietTimGiaSu();
     $data['baiviettimgiasu']=$baiviettimgiasu;
     $linkdata = $baiviettimgiasu->link;
     if(intval($city)==45 && intval($district)>0 && intval($subject)==0 && intval($class)==0)
     {
      $link=base_url()."tai-".vn_str_filter($tinhthanh->cit_name)."/".vn_str_filter($quanhuyen->cit_name).'-c45d'.intval($district).'.html';
      if($link == $linkdata){
        $metakey=$baiviettimgiasu->meta_key;
        $meta=$baiviettimgiasu->meta_title;
        $desc=$baiviettimgiasu->meta_des;
      }
      else{
        $metakey="gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name;
        $meta="Tìm gia sư dạy kèm tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." uy tín";
        $desc="Tìm gia sư dạy kèm tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." uy tín. Thông tin về gia sư tại ".$quanhuyen->cit_name." ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
      }
    }


    $result = $this->site_model->GetListTeacherBySearch($key, $subject, $classname, $topic, $city, $district, $type, $sex, $order, $page, $perpage);
    $lq = $this->site_model->GetTeacherRelate($subject,$classname,$city,$topic, $district);
    $data['lienquan']=$lq["data"];
    $data['linkseo'] = $this->site_model->getitemlinkseobuysearch($subject, $city, 2);
    $data['lstitem'] = $result['data'];
    $this->load->library('pagination');
    $config['total_rows'] = $result['total'];
    $config['per_page'] = $perpage;
    $config['uri_segment'] = 2;
    $config['next_link'] = '<i class="fa fa-angle-right"></i>';
    $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
    $config['num_links'] = 4;
    $config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
    $config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
    $config['base_url'] = $link;
    $this->pagination->initialize($config);
    $data['total'] = $result['total'];
    $data['order'] = $order;
    $data['start_row'] = $page;
    $data['pagination'] = $this->pagination->create_links();
    $data['monhoc'] = $this->site_model->ListSubject();
    $data['chude'] = $this->site_model->GetTeacherFeature();
    $data['districk'] = $this->site_model->CountTeacherbyCity();
    $data['lstonline'] = $this->site_model->GetTeacherOnline(10);
    $data['canonical'] = $link;
    $sql = $this->site_model->gettblwidthid('tbl_meta', 1);
    $data['meta_title'] = $meta;
    $data['meta_key'] = $metakey;
    $data['meta_des'] = $desc;
    $data['robots'] = 'noindex,nofollow';
    $data['content'] = 'listteacherbyfilter'; 
    $data['classheader'] = 'navbar navbar-default white bootsnav on no-full';
    $data['cssbody'] = ''; //customsl
    $data['showsupport'] = true;
    $this->load->view('template', $data);
  }


  function listteacherbyfilter($alias1,$subject,$class,$city)
  {
    $page=$start_row=$this->uri->segment(2);
    $data['home'] = false;
    $data['showsearch']=true;
    if(!empty($sql->name)){
      $data['metah1']=$sql->name;
    }else{
      $data['metah1']='SO SÁNH LƯƠNG CỦA BẠN TRƯỚC KHI NHẢY VIỆC!';
    }
    $perpage=10;
    if(empty($page)||intval($page)==0){
      $page=0;
    }else{
      $page=intval($page);
    }
    if($page <= 10){
      $data['robots']= 'noindex,nofollow';
    }else{
     $data['robots']= 'noindex,nofollow';
   }
   $topic=0;$type=0;$sex=0;
   $key = '';
   $meta="";$desc="";$metakey="";
   $day=date('m/Y',time());
   $year=date('Y',time());
   $data['keyhome']=1;
   $district=0;
   if(intval($class)==0)
   {
    $classname = '';
  }
  else
  {
    $classname = $this->site_model->SelectClassByid($class)->classname;
    
  }

  $subject_id = $subject;  
  $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
  $data['subjectname']=$monhoc->SubjectName;
  $subject=$data['subjectname'];
  $data['topkey'] = $this->site_model->ListTopKeywork();
  if (isset($_POST['order'])) {
    $order = $_POST['order'];
  } else {
    $order = '';
  }

  $data['keyfilter']=['keywork'=>$key,'subject'=>$subject, 'class'=>$class,'topic'=>$topic,'place'=>$city,'district' => $district,'type'=>$type,'sex'=>$sex];
  // $order
  $result=$this->site_model->GetListTeacherBySearch($key,$subject,$classname,$topic,$city, $district,$type,$sex,$order,$page,$perpage);
  $tinhthanh="";
  // $monhoc="";
  
  if(intval($subject)>0){
    
    $monhoc=$this->site_model->selectsubjectbyid(intval($subject));
   
    $data['subjectname']=$monhoc->SubjectName;
    
    
  }
  if(intval($city)>0){
   $tinhthanh=$this->site_model->SelectProvinceByID1(intval($city));
   $data['cityname']=$tinhthanh->cit_name;
 }
 if(intval($class)>0){
  $lop=$this->site_model->SelectClassByid(intval($class));
  $data['classname']=$lop->classname;
}
$baiviettimgiasu = $this->site_model->BaiVietTimGiaSu();
$data['baiviettimgiasu']=$baiviettimgiasu;
$linkdata = $baiviettimgiasu->link;


    if((!empty(CheckSubject($monhoc->ID)) && intval($class)==0 && intval($city)==0))
    {
      
      $link=base_url().'mon-'.vn_str_filter($monhoc->SubjectName).'-m'.intval($subject).'l0t0.html';
      if($link == $linkdata){
        // 
        $metakey=$baiviettimgiasu->meta_key;
        $meta=$baiviettimgiasu->meta_title;
        $desc=$baiviettimgiasu->meta_des;
      }
      else{
        if ($this->site_model->check_seo_subject($monhoc->ID) > 0) {
          $seosubject = $this->site_model->Get_seo_subject($monhoc->ID);
          $metakey = $seosubject[0]->keywork;
          $meta = $seosubject[0]->title;
          $desc = $seosubject[0]->description;
        } else {
          $metakey="gia sư ".$monhoc->SubjectName;
          $meta="Tìm gia sư dạy kèm ".$monhoc->SubjectName." uy tín";
          $desc="Tìm gia sư dạy kèm ".$monhoc->SubjectName." uy tín. Thông tin về gia sư ".$monhoc->SubjectName." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
        }
      }
    }
    else if(!empty(CheckClass($class)) && intval($subject)==0 && intval($city)==0)
    {
      $link=base_url().vn_str_filter($lop->classname).'-m0l'.intval($class).'t0.html';
      if($link == $linkdata){
        $metakey=$baiviettimgiasu->meta_key;
        $meta=$baiviettimgiasu->meta_title;
        $desc=$baiviettimgiasu->meta_des;
      }
      else{
        $metakey="gia sư ".$lop->classname;
        $meta="Tìm gia sư dạy kèm ".$lop->classname." uy tín";
        $desc="Tìm gia sư dạy kèm ".$lop->classname." uy tín. Thông tin về gia sư ".$lop->classname." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
      }
    }

    else if(!empty( CheckCity($city)) && intval($subject)==0 && intval($class)==0 && intval($district)==0)
    {
      $link=base_url().vn_str_filter($tinhthanh->cit_name).'-m0l0t'.intval($city).'.html';
      if($link == $linkdata){
        $metakey=$baiviettimgiasu->meta_key;
        $meta=$baiviettimgiasu->meta_title;
        $desc=$baiviettimgiasu->meta_des;
      }
      else{

        if ($this->site_model->check_seo_city($tinhthanh->cit_id) > 0) {
            $seocity = $this->site_model->Get_seo_city($tinhthanh->cit_id);
            $metakey = $seocity[0]->keywork;
            $meta = $seocity[0]->title;
            $desc = $seocity[0]->description;
        } else {
            $metakey="gia sư tại ".$tinhthanh->cit_name;
            $meta="Tìm gia sư dạy kèm tại ".$tinhthanh->cit_name." uy tín";
            $desc="Tìm gia sư dạy kèm tại ".$tinhthanh->cit_name." uy tín. Thông tin về gia sư tại ".$tinhthanh->cit_name." chi tiết rõ ràng, chính xác. Đảm bảo sự yên tâm và uy tín.";
        }
      }
    }
$data['linkseo']=$this->site_model->getitemlinkseobuysearch($subject,$city,2);

$data['lstitem']=$result['data'];
$this->load->library('pagination');
$config['total_rows'] = $result['total'];
$config['per_page'] = $perpage;
$config['uri_segment'] =2;
$config['next_link'] = '<i class="fa fa-angle-right"></i>';
$config['prev_link'] = '<i class="fa fa-angle-left"></i>';
$config['num_links'] = 4;
$config['first_link'] = '<i class="fa fa-angle-double-left"></i>';
$config['last_link'] = '<i class="fa fa-angle-double-right"></i>';
$config['base_url']=$link;
$this->pagination->initialize($config);
$data['total']=$result['total'];
$data['order']=$order;
$data['start_row']= $page;
$data['pagination']= $this->pagination->create_links();
$data['monhoc']=$this->site_model->ListSubject();
$data['chude']=$this->site_model->GetTeacherFeature();
$data['districk']=$this->site_model->CountTeacherbyCity();
$data['lstonline']=$this->site_model->GetTeacherOnline(10);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $data['selectbox']=base_url()."site/listteacherbyfilter/&order=".$order;
$data['selectbox']=base_url()."giao-vien&key=".$keywork."&subject=".intval($subject)."&topic=".intval($topic)."&place=".intval($city)."&type=".intval($type)."&sex=".intval($sex)."&order=".$order;
        //$data['vansudia']=$this->site_model->GetListTeacherVSD(5);
        //$data['giasutheomonhoc']=$this->site_model->DemGiaSuTheoMonHoc();
        //$data['giasutheott']=$this->site_model->DemGiaSuTheoTinhThanh();
        //$data['congtymoinhat']=$this->site_model->GetTopCompany(10);
        //$data['ungviennoibat']=$this->site_model->GetListCandidate("1=1 ",5,'order by u.use_update_time desc');
$data['canonical']=$link;
		//$data['amp']=site_url('amp');
$sql=$this->site_model->gettblwidthid('tbl_meta',1);
$data['nav_search'] = 1;
$data['meta_title']=$meta;
$data['meta_key']=$metakey;
$data['meta_des']=$desc;
$data['robots']= 'noindex,nofollow';
$data['content']='listteacherbyfilter';
$data['classheader']='navbar navbar-default white bootsnav on no-full';
        $data['cssbody']=''	;//customsl
        $data['showsupport']=true;
        $this->load->view('template',$data);
      }


      function xuat_excel(){
        $arr_subject = $this->site_model->get_subject();
        $arr_city = $this->site_model->get_city();
        $arr_mhl = $this->site_model->get_class();
        $arr_qh = $this->site_model->get_qh();

        $link_sub = '';
        $link_city = '';
        $link_mhtt = '';
        $link_lop = '';
        $link_mhlop = '';
        $link_qh = '';

        foreach ($arr_subject as $result) {
          if(!empty(CheckSubject($result->ID))){
            $link_sub .= base_url().'mon-'.vn_str_filter($result->SubjectName).'-m'.intval($result->ID).'l0t0.html'.',';
          }
        }

        foreach ($arr_city as $result) {
          if(!empty(CheckCity($result->cit_id))){
            $link_city .= base_url().'tai-'.vn_str_filter($result->cit_name).'-m0l0t'.intval($result->cit_id).'.html'.',';
          }
        }

        foreach ($arr_mhl as $result) {
          if(!empty(CheckClass($result->id))){
            $link_lop .= base_url().vn_str_filter($result->classname).'-m0l'.intval($result->id).'t0.html'.',';
          }
        }

        foreach ($arr_subject as $result) {
          if(!empty(CheckSubject1($result->ID))){
                $link_mhtt .= base_url().'mon-'.vn_str_filter($result->SubjectName).'/tai-'.vn_str_filter('Hồ Chí Minh').'-s'.intval($result->ID).'r0c45.html'.','.base_url().'mon-'.vn_str_filter($result->SubjectName).'/tai-'.vn_str_filter('Hà Nội').'-s'.intval($result->ID).'r0c1.html'.',';
          }
        }

        foreach ($arr_subject as $subject) {
          $link_mhlop .= $this->site_model->get_subject_class($subject->ID,$subject->SubjectName);
        }

        foreach ($arr_qh as $result) {
          $link_qh .= base_url().'tai-ho-chi-minh/'.vn_str_filter($result->cit_name).'-c45d'.intval($result->cit_id).'.html'.',';
        }

        //Xuat File
        header("Content-type:application/csv;charset=UTF-8");
        // header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment; filename=URL-GiaSu.xls");
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        echo '<table border="1px solid black">';
        echo '<tr>';
        echo '<td><strong> STT </strong></td>';
        echo '<td><strong> URL </strong></td></tr>';
        
        $i = 0;

        $link_sub = rtrim($link_sub,',');
        $arr_sub = explode(',', $link_sub);
        
        foreach ($arr_sub as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }

        $link_city = rtrim($link_city,',');
        $arr_cit = explode(',', $link_city);
        
        foreach ($arr_cit as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }

        $link_lop = rtrim($link_lop,',');
        $arr_lop = explode(',', $link_lop);

        foreach ($arr_lop as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }

        $link_mhtt = rtrim($link_mhtt,',');
        $arr_mhtt1 = explode(',', $link_mhtt);

        foreach ($arr_mhtt1 as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }

        $link_mhlop = rtrim($link_mhlop,',');
        $arr_mhlop = explode(',', $link_mhlop);

        foreach ($arr_mhlop as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }

        $link_qh = rtrim($link_qh,',');
        $arr_qh1 = explode(',', $link_qh);

        foreach ($arr_qh1 as $key) {
          $i++;
          echo '<tr>';
          echo '<td>'.$i.'</td>';
          echo '<td>'.$key.'</td>';
          echo '</tr>';
        }
        
        echo '</table>';
      }

function xuat_excel2(){
  

  $arr_subject = $this->site_model->get_subject();
  $arr_city = $this->site_model->get_city();
  $arr_mhl = $this->site_model->get_class();
  $arr_qh = $this->site_model->get_qh();

  $link_sub = '';
  $link_city = '';
  $link_mhtt = '';
  $link_lop = '';
  $link_mhlop = '';
  $link_qh = '';

  foreach ($arr_subject as $result) {
    if(!empty(CheckSubject($result->ID))){
      $link_sub .= base_url().'viec-lam-gia-su-mon-'.vn_str_filter($result->SubjectName).'-s'.intval($result->ID).'c0p0.html'.',';
    }
  }

  foreach ($arr_city as $result) {
    if(!empty(CheckCity($result->cit_id))){   
      $link_city .= base_url().'viec-lam-gia-su-'.vn_str_filter($result->cit_name).'-s0c0p'.intval($result->cit_id).'.html'.',';
    }
  }

  foreach ($arr_mhl as $result) {
    if(!empty(CheckClass($result->id))){
      $link_lop .= base_url().'viec-lam-gia-su-'.vn_str_filter($result->classname).'-s0c'.intval($result->id).'p0.html'.',';
    }
  }

  foreach ($arr_subject as $result) {
    if(!empty(CheckSubject1($result->ID))){
      $link_mhtt .= base_url().'viec-lam-gia-su-mon-'.vn_str_filter($result->SubjectName).'/tai-'.vn_str_filter('Hồ Chí Minh').'-m'.intval($result->ID).'c0p45.html'.','. base_url().'viec-lam-gia-su-mon-'.vn_str_filter($result->SubjectName).'/tai-'.vn_str_filter('Hà Nội').'-m'.intval($result->ID).'c0p1.html'.',';
    }
  }

  foreach ($arr_subject as $subject) {
    $link_mhlop .= $this->site_model->get_subject_class1($subject->ID,$subject->SubjectName);
  }

  foreach ($arr_qh as $result) {
    $link_qh .= base_url().'viec-lam-gia-su-tai-ho-chi-minh/'.vn_str_filter($result->cit_name).'-p45d'.intval($result->cit_id).'.html'.',';
  }

  //Xuat File
  header("Content-type:application/csv;charset=UTF-8");
  // header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=URL-ViecLam.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  echo '<table border="1px solid black">';
  echo '<tr>';
  echo '<td><strong> STT </strong></td>';
  echo '<td><strong> URL </strong></td></tr>';

  $i = 0;

  $link_sub = rtrim($link_sub,',');
  $arr_sub = explode(',', $link_sub);

  foreach ($arr_sub as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  $link_city = rtrim($link_city,',');
  $arr_cit = explode(',', $link_city);

  foreach ($arr_cit as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  $link_lop = rtrim($link_lop,',');
  $arr_lop = explode(',', $link_lop);

  foreach ($arr_lop as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  $link_mhtt = rtrim($link_mhtt,',');
  $arr_mhtt1 = explode(',', $link_mhtt);

  foreach ($arr_mhtt1 as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  $link_mhlop = rtrim($link_mhlop,',');
  $arr_mhlop = explode(',', $link_mhlop);

  foreach ($arr_mhlop as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  $link_qh = rtrim($link_qh,',');
  $arr_qh1 = explode(',', $link_qh);

  foreach ($arr_qh1 as $key) {
    $i++;
    echo '<tr>';
    echo '<td>'.$i.'</td>';
    echo '<td>'.$key.'</td>';
    echo '</tr>';
  }

  echo '</table>';
  }
  
  function insert_user(){
    for($i=0; $i<50;$i++){
      $this->site_model->insert_user();
    }
  }
  function fetch()
 {
  $output = '';
  $query = '';
  // $this->site_model->ajaxsearch_model();
  $this->load->model('site_model');
  if($this->input->post('query'))
  {
   $query = $this->input->post('query');
  }
  $data = $this->site_model->fetch_data($query);
  $output .= '
  <div class="table-responsive" >
     <table class="table table-bordered table-striped">
      <tr>
       <th>Tên gia sư</th>
       <th>Địa chỉ</th>
       <th>Thành phố</th>

      </tr>
  ';
  if($data->num_rows() > 0)
  {
   foreach($data->result() as $row)
   {
    $output .= '
      <tr>
       <td>'.$row->Name.'</td>
       <td>'.$row->Address.'</td>
       <td>'.$row->CityName2.'</td>
      </tr>
    ';
   }
  }
  else
  {
   $output .= '<tr>
       <td colspan="5">Không tìm thấy kết quả tìm kiếm !</td>
      </tr>';
  }
  $output .= '</table>';
  echo $output;
 }

 //làm phần search ở đây
  // function search_keyword()
  //  {  
  //      $keyword=$_POST['keyword'];
  //      var_dump($keyword) ;
  //      die();
  //      $data['users']=$this->site_model->search($keyword);
  //      $data['canonical']=base_url()."giao-vien";
  //      $data['robots']= 'noindex,nofollow'; 
  //      $data['content']='searchtutorresultteacher';
  //      $data['classheader']='navbar navbar-default white bootsnav on no-full';  
  //       $data['cssbody']='' ;//customsl
  //       $data['showsupport']=true;
  //       $this->load->view('template',$data);

  //  }

    }
?>

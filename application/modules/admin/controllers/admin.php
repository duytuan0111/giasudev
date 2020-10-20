<?php 

class admin extends Controller
{
	function admin()
	{
		parent::Controller();  
		$this->load->helper('locdau');			
		$this->load->helper('images');
		$this->load->library('pagination');	
		$this->load->model('admin/admin_model');
		$this->load->model('admin/Classes/PHPExcel');
 	}   
	function index()
    {  
		$this->checklogin();		
        $data['content']='includes/content';
        $this->load->view('template',$data);		
    } 		
	function banner()
    {
		$this->checklogin();	
		$this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
            $per_page=20;
    		if(is_numeric($start_row))
    		{
    			$start_row=$start_row;
    		}
    		else
    		{
    			$start_row=0;
    		}
            $query=$this->admin_model->gettbl('tbl_banner','');			
    		$total_rows = $query->num_rows();
    		$this->load->library('pagination');
    		$config['base_url'] = site_url().'/admin/banner';
    		$config['total_rows'] = $total_rows;
    		$config['per_page'] = $per_page;
    		$config['uri_segment'] =3;
    		$config['next_link'] = '<';
    		$config['prev_link'] = '>';
    		$config['num_links'] = 4;
    		$config['first_link'] = '<<';
    		$config['last_link'] = '>>';    		
    		$this->pagination->initialize($config);
    		$data['query']=$this->admin_model->gettbl_limited('tbl_banner',$start_row,$per_page);
    		$data['pagination']= $this->pagination->create_links();	
    		$data['content']='banner';			
    		$this->load->view('template',$data);    	   
    }
	function frmbanner()
    {		
		$this->checklogin();
		$this->checkrole();			
        $data['content']='frmbanner'; 
        $this->load->view('template',$data);  
    }
	function add_banner()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');					  		
		if(!is_dir('upload/banner')){
			mkdir('upload/banner', 0755, TRUE);		
		}
		if ($_FILES['file']['name']==null)
		{
			if($id==''){
				$file='';					
			}
			else{
				$file=$_POST['file'];									
			}			
		}
		else
		{
			$filename = $_FILES['file']['name'];
	        $filedata = $_FILES['file']['tmp_name'];			
			$temp=explode('.',$filename);				
			$file=$filename;				
			$imageThumb = new Image($filedata);			
			$thumb_path = $temp[0];											
			/*
			$imageThumb->resize(200,200,'crop');
			*/
			$imageThumb->save($thumb_path, 'upload/banner', $temp[1]);			
		}
		/*-----------------------------*/
		$data=array(			
				'name'  	=>  $this->input->post('name'),
				'link'  	=>  $this->input->post('link'),
				'file'  	=>  $file,
				'vip'  		=>  $this->input->post('vip'),
				'vitri'  	=>  $this->input->post('vitri'),
				'sort'  	=>  $this->input->post('sort'),
				'cid'		=>	$this->input->post('cid'),
				'status'    =>  $this->input->post('status')
			); 
		$this->admin_model->add_tbl('tbl_banner',$data,$id);    
		redirect('admin/banner');	
    }
	
	function edit_banner($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='frmbanner';
        $this->load->view('template',$data);    
    }
	function del_banner()
	{     
		$this->checklogin();		
		$this->checkrole();	
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$sql="SELECT file FROM tbl_banner WHERE id=".$del_id;
				$query=$this->db->query($sql)->row();
				//unlink($query->file);//xoa file
				$result = $this->admin_model->del_tbl('tbl_banner',$del_id);
			}
            if($result)
            {
                redirect('admin/banner');        
            }                     
        }
        else
        { 
            echo 'Bạn phải chọn';
            redirect('admin/banner');
        }
	}
	function checkbanner()
	{
		$this->checklogin();		
		$this->checkrole();	
		$action=$_POST['active'];
        $id=$_POST['id'];
        $this->admin_model->checkstatus('tbl_banner',$action,$id);		
	}
		
	function slider()
    {
		$this->checklogin();	
		$this->checkrole();		
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_slider','');			
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/slider';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_slider',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='slider';			
		$this->load->view('template',$data);    	   
    }
	function frmslider()
    {		
		$this->checklogin();		
		$this->checkrole();	
        $data['content']='frmslider'; 
        $this->load->view('template',$data);  
    }
	function add_slider()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');				
		if(!is_dir('upload/slider')){
				mkdir('upload/slider', 0755, TRUE);				
			}
			if ($_FILES['image']['name']==null)
			{
				if($id==''){
					$image='';					
				}
				else{
					$image=$_POST['image'];									
				}			
			}
			else
			{							
				$filename = $_FILES['image']['name'];
		        $filedata = $_FILES['image']['tmp_name'];				
				$temp=explode('.',$filename);				
				$image=$filename;				
				$imageThumb = new Image($filedata);			
				$thumb_path = $temp[0];						
				$imageThumb->save($thumb_path, 'upload/slider', $temp[1]);						
			}		
		/*-----------------------------*/
		$data=array(							
				'name'  		=>  $this->input->post('name'),
				'image'  		=>  $image,					
				'link'  		=>  $this->input->post('link'),
				'content'		=>	$this->input->post('content'),
				'status'    	=>  $this->input->post('status')
			); 
		$this->admin_model->add_tbl('tbl_slider',$data,$id);		
		redirect('admin/slider');	
    }
	
	function edit_slider($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='frmslider';
        $this->load->view('template',$data);    
    }    
	function del_slider()
	{     
		$this->checklogin();		
		$this->checkrole();	
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];			
				$result = $this->admin_model->del_tbl('tbl_slider',$del_id);    				
			}
            if($result)
            {
                redirect('admin/slider');        
            }                     
        }
        else
        { 
            echo 'Bạn phải chọn';
            redirect('admin/slider');
        }
	}
	function checkslider()
	{
		$this->checklogin();		
		$this->checkrole();	
		$action=$_POST['active'];
        $id=$_POST['id'];
        $this->admin_model->checkstatus('tbl_slider',$action,$id);		
	}
	////////////End slider////////////
	function custom()
    {
		$this->checklogin();		
		$this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('customhtml','');			
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/custom';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('customhtml',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='custom';			
		$this->load->view('template',$data);    	   
    }
	function frmcustom()
    {		
		$this->checklogin();	
		$this->checkrole();		
        $data['content']='frmcustom'; 
        $this->load->view('template',$data);  
    }
	function add_custom()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');		
		$data=array(							
				'name'  		=>  $this->input->post('name'),
				'html'			=>	$this->input->post('html'),
				'sort'  		=>  $this->input->post('sort'),				
				'status'    	=>  $this->input->post('status')
			); 
		$this->admin_model->add_tbl('customhtml',$data,$id);		
		redirect('admin/custom');	
    }
	
	function edit_custom($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='frmcustom';
        $this->load->view('template',$data);    
    }   
    
    // meta page
    function pagemeta()
    {
		$this->checklogin();		
		$this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_meta','');			
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/pagemeta';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '<';
		$config['prev_link'] = '>';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_meta',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='pagemeta';			
		$this->load->view('template',$data);    	   
    }
	function frmmeta()
    {		
		$this->checklogin();	
		$this->checkrole();		
        $data['content']='frmmeta'; 
        $this->load->view('template',$data);  
    }
	function add_meta()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');		
		$data=array(							
				'title'  		=>  $this->input->post('title'),
				'metadesc'			=>	$this->input->post('metadesc'),
				'metakeywork'  		=>  $this->input->post('metakeywork')
			);

		$this->admin_model->add_tbl('tbl_meta',$data,$id);		
		redirect('admin/pagemeta');	
    }


	function add_urltheotinh()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');	
		$city_id = $this->input->post('city_id');
		$data=array(
				'h1'					=> $this->input->post('h1'),
				'content'				=> $this->input->post('editor'),
				'City_ID'				=> 	$city_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seocity('seobycity',$data,$id);		
		redirect('admin/urlgiasutheotinh');	
    }
    function add_viectheotinh()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');	
		$city_id = $this->input->post('city_id');
		$data=array(
				'h1'					=> $this->input->post('h1'),
				'content'				=> $this->input->post('editor'),
				'City_ID'				=> 	$city_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seocity('viecbycity',$data,$id);		
		redirect('admin/urlviectheotinh');	
    }
    function add_urltheomon()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');	
		$subject_id = $this->input->post('subject_id');
		$data=array(
				'h1'					=> 	$this->input->post('h1'),
				'content'				=> 	$this->input->post('editor'),
				'subject_id'			=> 	$subject_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seosubject('seobysubject',$data,$id);		
		redirect('admin/urlgiasutheomon');	
    }
      function add_viectheomon()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');	
		$subject_id = $this->input->post('subject_id');
		$data=array(
				'h1'					=> 	$this->input->post('h1'),
				'content'				=> 	$this->input->post('editor'),
				'subject_id'			=> 	$subject_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seosubject('viecbysubject',$data,$id);		
		redirect('admin/urlviectheomon');	
    }
     function add_urltheomontinhthanh()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');
		$city_id = $this->input->post('city_id');	
		$subject_id = $this->input->post('subject_id');
		$data=array(
				'h1'					=> 	$this->input->post('h1'),
				'content'				=> 	$this->input->post('editor'),
				'Subject_ID'			=> 	$subject_id,
				'City_ID'				=> 	$city_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seosubjectcity('seobycitysubject',$data,$id);		
		redirect('admin/urlgiasutheomontinhthanh');	
    }
     function add_viectheomontinhthanh()
    {
		$this->checklogin();		
		$this->checkrole();	
		$id = $this->input->post('id');
		$city_id = $this->input->post('city_id');	
		$subject_id = $this->input->post('subject_id');
		$data=array(
				'h1'					=> 	$this->input->post('h1'),
				'content'				=> 	$this->input->post('editor'),
				'Subject_ID'			=> 	$subject_id,
				'City_ID'				=> 	$city_id,						
				'keywork'  				=>  $this->input->post('keywork'),
				'description'			=>	$this->input->post('description'),
				'title'  				=>  $this->input->post('title')
			); 
		$this->admin_model->add_seosubjectcity('viecbycitysubject',$data,$id);		
		redirect('admin/urlviectheomontinhthanh');	
    }

	function edit_meta($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='frmmeta';
        $this->load->view('template',$data);    
    }
    function exit_urlgiasu($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='exit_urlgiasu';
        $query = $this->admin_model->Getallby($table='city');
        $data['listcity'] = $query['data'];
        $this->load->view('template',$data);    
    }
    function exit_urlphuhuynh($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='exit_urlphuhuynh';
        $this->load->view('template',$data);    
    }
     function edit_urltheotinh($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='edit_urltheotinh';
        $this->load->view('template',$data);    
    }
     function edit_urltheomontinhthanh($subject_id, $city_id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['subject_id']=$subject_id;
        $data['city_id']	= $city_id;
        $data['content']='edit_urltheomontinhthanh';
        $this->load->view('template',$data);    
    }
    function edit_viectheomontinhthanh($subject_id, $city_id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['subject_id']=$subject_id;
        $data['city_id']	= $city_id;
        $data['content']='edit_viectheomontinhthanh';
        $this->load->view('template',$data);    
    }
      function edit_viectheotinh($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='edit_viectheotinh';
        $this->load->view('template',$data);    
    }
      function edit_viectheomon($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='edit_viectheomon';
        $this->load->view('template',$data);    
    }
    function edit_urltheomon($id)
    {
		$this->checklogin();		
		$this->checkrole();	
        $data['id']=$id;
        $data['content']='edit_urltheomon';
        $this->load->view('template',$data);    
    }  
	function del_meta()
	{     
		$this->checklogin();	
		$this->checkrole();		
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];			
				$result = $this->admin_model->del_tbl('tbl_meta',$del_id);    				
			}
            if($result)
            {
                redirect('admin/pagemeta');        
            }                     
        }
        else
        { 
            echo 'Bạn phải chọn';
            redirect('admin/custom');
        }
	}
	
	function edit_footer($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmfooter';
        $this->load->view('template',$data);    
    }
    // quản lý doanh nghiệp
    function ungvien()
    {
         $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) or isset($_POST['city'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];		
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;				
		}	
        $query=$this->admin_model->GetAllCandibypage($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/ungvien';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='ungvien';			
		$this->load->view('template',$data); 
    }
    function edit_ungvien($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');		
        $data['id']=$id;
        $data['content']='frmungvien';
        $this->load->view('template',$data);    
    }
    function add_ungvien()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $use_first_name=trim($this->input->post('use_first_name'));		
        $use_address=$this->input->post('use_address');
        $cv_kynang=$this->input->post('cv_kynang');
        $cv_muctieu=$this->input->post('cv_muctieu');
        $category=$this->input->post('category');
        $city=$this->input->post('city');
        $capbac=$this->input->post('capbac');
        $kinhnghiem=$this->input->post('kinhnghiem');
        $hinhthuc=$this->input->post('hinhthuc');
        $hocvan=$this->input->post('hocvan');
		$data=array(
				'cv_hocvan' 	=>	$hocvan	,
                'cv_exp'=>$kinhnghiem	,
                'cv_muctieu'=>$cv_muctieu	,
                'cv_cate_id'=>$category	,
                'cv_city_id'=>$city	,
                'cv_capbac_id'=>$capbac,
                'cv_loaihinh_id'=>	$hinhthuc,
                'cv_kynang'=>$cv_kynang	
			); 
        $data1=array(
				'use_first_name' 	=>	$use_first_name	,
                'use_address'=>$use_address				
			);		
		$this->admin_model->UpdateorAddtbl('`user`',$data1,'use_id',$id);	
        $this->admin_model->UpdateorAddtbl('cv',$data,'cv_user_id',$id);	 
		//$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/ungvien');}
		else{
			redirect('admin/ungvien/'.$_SESSION['start_row']);
		}		
    }
    function del_ungvien()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];								
				$result = $this->admin_model->delrowtbl('`user`','use_id',$del_id);
                $result = $this->admin_model->delrowtbl('cv','cv_user_id',$del_id);
			}
			redirect('admin/ungvien/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/ungvien');  
        }
	}
    // quản lý doanh nghiệp
    function doanhnghiep()
    {
         $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];		
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;				
		}	
        $query=$this->admin_model->Getallcompanybypage($_SESSION['findkey'],$_SESSION['city'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/doanhnghiep';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='doanhnghiep';			
		$this->load->view('template',$data);  
    }
    function edit_doanhnghiep($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');		
        $data['id']=$id;
        $data['content']='frmdoanhnghiep';
        $this->load->view('template',$data);    
    }
    function add_doanhnghiep()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('usc_company'));		
        $usc_company_info=$this->input->post('usc_company_info');
        $usc_address=$this->input->post('usc_address');
        $usc_phone=$this->input->post('usc_phone');
        $usc_website=$this->input->post('usc_website');
        $usc_mst=$this->input->post('usc_mst');
		$data=array(
				'usc_company' 	=>	$title	,
                'usc_address'=>$usc_address	,
                'usc_phone'=>$usc_phone	,
                'usc_website'=>$usc_website	,
                'usc_mst'=>$usc_mst	,
                'usc_name_add'=>$usc_address,
                'usc_name_phone'=>	$usc_phone	
			); 
        $data1=array(
				'usc_company_info' 	=>	$usc_company_info					
			);		
		$this->admin_model->UpdateorAddtbl('user_company',$data,'usc_id',$id);	
        $this->admin_model->UpdateorAddtbl('user_company_multi',$data1,'usc_id',$id);	 
		//$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/doanhnghiep');}
		else{
			redirect('admin/doanhnghiep/'.$_SESSION['start_row']);
		}		
    }
    //việc làm
    function vieclam()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query=$this->admin_model->Getallnewbypage($_SESSION['findkey'],$_SESSION['category'],$_SESSION['city'],$_SESSION['tinhot'],$start_row,$per_page);
		$total_rows =$query['total'] ;//$query->num_rows();	

				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/vieclam';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
			// 
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='vieclam';			
		$this->load->view('template',$data);    
    }
        // url gia sư
    function urlgiasu()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		$query=$this->admin_model->Getallby($table='url_phuhuynh');
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['txt_search']) OR isset($_POST['search_status'])){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_status']);			
            		
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_status']= $_POST['search_status'];
			$query = $this->admin_model->Getallfilterby($table='url_phuhuynh', $_SESSION['txt_search'], $_SESSION['search_status']);
            	
		}
		else{
			$_SESSION['txt_search'] = '';
			$_SESSION['search_status']= '';
			
            				
		}	
       
        // var_dump($query);
        // die();
        
		$total_rows =$query['total'] ;//$query->num_rows();	

		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlgiasu';			
		$this->load->view('template',$data);    
    }
        function url_phuhuynh()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		$query=$this->admin_model->Getallby($table='url_timviec');
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['txt_search']) OR isset($_POST['search_status']) ){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_status']);			
            		
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_status']= $_POST['search_status'];
			$query = $this->admin_model->Getallfilterby($table='url_timviec', $_SESSION['txt_search'], $_SESSION['search_status']);         	
		}
		else{
			$_SESSION['txt_search'] = '';
			$_SESSION['search_status']= ''; //0
		
            				
		}	
        
        // var_dump($query);
        // die();
        
		$total_rows =$query['total'] ;//$query->num_rows();	

		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='url_phuhuynh';			
		$this->load->view('template',$data);    
    }
    // url gia sư
    function urlgiasutheotinh()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query=$this->admin_model->Getallby($table='city');
        
		$total_rows =$query['total'] ;//$query->num_rows();	
				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		// $this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlgiasutheotinh';			
		$this->load->view('template',$data);    
    }
    function urlviectheotinh()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query=$this->admin_model->Getallby($table='city');
        
		$total_rows =$query['total'] ;//$query->num_rows();	
				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlviectheotinh';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		// $this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlviectheotinh';			
		$this->load->view('template',$data);    
    }
    function urlgiasutheomon()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query=$this->admin_model->Getallby($table='subject');

		$total_rows =$query['total'] ;//$query->num_rows();	
				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		// $this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlgiasutheomon';			
		$this->load->view('template',$data);    
    }
       function urlviectheomon()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query=$this->admin_model->Getallby($table='subject');

		$total_rows =$query['total'] ;//$query->num_rows();	
				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		// $this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlviectheomon';			
		$this->load->view('template',$data);    
    }
        function urlgiasutheomontinhthanh()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=3;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query = $this->admin_model->Getallbylimit($table='subject', $start_row, $per_page);
        $query1= $this->admin_model->Getallby($table='city');
        $query2= $this->admin_model->Getallby($table='subject');

		$total_rows =$query2['total'];//$query->num_rows();

		// var_dump($total_rows);
		// var_dump($per_page);
		// die();
		

				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasutheomontinhthanh';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['query1']=$query1['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlgiasutheomontinhthanh';			
		$this->load->view('template',$data);    
    }
     function urlviectheomontinhthanh()
    {
        $this->checkrole();	
		$this->load->helper('status');
        $start_row=$this->uri->segment(3);
		$per_page=3;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
        if(isset($_POST['findkey']) OR isset($_POST['category']) OR isset($_POST['city']) OR isset($_POST['hot'])){	
			unset($_SESSION['findkey']);
			unset($_SESSION['category']);			
			unset($_SESSION['city']);			
			unset($_SESSION['tinhot']);	
            		
			$_SESSION['findkey'] = $_POST['findkey'];
			$_SESSION['category']= $_POST['category'];
			$_SESSION['city'] = $_POST['city'];
			$_SESSION['tinhot'] = $_POST['hot'];	
            	
		}
		else{
			$_SESSION['findkey'] = '';
			$_SESSION['category']= 0;
			$_SESSION['city'] = 0;
			$_SESSION['tinhot'] = 0;	
            				
		}	
        $query = $this->admin_model->Getallbylimit($table='subject', $start_row, $per_page);
        $query1= $this->admin_model->Getallby($table='city');
        $query2= $this->admin_model->Getallby($table='subject');

		$total_rows =$query2['total'];//$query->num_rows();

		// var_dump($total_rows);
		// var_dump($per_page);
		// die();
		

				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/urlgiasutheomontinhthanh';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config); 
        $data['monhoc']=$this->admin_model->ListSubject();    		
		$data['query']=$query['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['query1']=$query1['data'];//$this->admin_model->gettbl_search_limited('new',$start_row,$per_page);	
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='urlviectheomontinhthanh';			
		$this->load->view('template',$data);    
    }
    function edit_vieclam($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');		
        $data['id']=$id;
        $data['content']='frmvieclam';
        $this->load->view('template',$data);    
    }
    function add_vieclam()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('new_title'));		
        $mota=$this->input->post('new_mota');
        $quyenloi=$this->input->post('new_quyenloi');
        $yccongviec=$this->input->post('new_yeucau');
        $ychoso=$this->input->post('new_ho_so');
		$data=array(
				'new_title' 	=>	$title							
			); 
        $data1=array(
				'new_mota' 	=>	$mota,
                'new_yeucau' 	=>	$yccongviec,
                'new_quyenloi' 	=>	$quyenloi,
                'new_ho_so' 	=>	$ychoso							
			);		
		$this->admin_model->UpdateorAddtbl('new',$data,'new_id',$id);	
        $this->admin_model->UpdateorAddtbl('new_multi',$data1,'new_id',$id);	 
		//$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/vieclam');}
		else{
			redirect('admin/vieclam/'.$_SESSION['start_row']);
		}		
    }
    function del_vieclam()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];								
				$result = $this->admin_model->checkstatusjob('users','`Delete`',1,'UserID',$del_id);
                $result = $this->admin_model->checkstatusjob('users','`Active`',0,'UserID',$del_id);
			}
			redirect('admin/vieclam/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/vieclam');  
        }
	}
	 function del_urlgiasu()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];								
				$result = $this->admin_model->del_urlgiasu('url_phuhuynh','id',$del_id);
			}
			redirect('admin/urlgiasu/');			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/urlgiasu');  
        }
	}
	 function del_urlphuhuynh()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];								
				$result = $this->admin_model->del_urlgiasu('url_timviec','id',$del_id);
			}
			redirect('admin/url_phuhuynh/');			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/url_phuhuynh');  
        }
	}
	//Bài viết
	function baiviet()
    {
		$this->checklogin();				
		$this->load->helper('status');	
		if(isset($_POST['txt_search']) OR isset($_POST['cid']) OR isset($_POST['search_status']) OR isset($_POST['search_user'])){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_cid']);			
			unset($_SESSION['search_user']);			
			unset($_SESSION['search_status']);			
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_cid'] = $_POST['cid'];
			$_SESSION['search_user'] = $_POST['search_user'];
			$_SESSION['search_status'] = $_POST['search_status'];			
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['search_cid']) AND isset($_SESSION['search_status']) AND isset($_SESSION['search_user']) AND $_SESSION['txt_search'] == '' AND $_SESSION['search_cid'] == 0 AND $_SESSION['search_user'] == 0 AND $_SESSION['search_status'] == -1){
				$_SESSION['txt_search'] = '';
				$_SESSION['search_cid'] = 0;
				$_SESSION['search_user'] = 0;
				$_SESSION['search_status'] = -1;
			}			
		}			
		
        $start_row=$this->uri->segment(3);		
        $per_page=20;    		
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;					
		}				    		
		else
		{
			$_SESSION['start_row']=0;				
		}			            
		$query=$this->admin_model->gettbl_search_limited('baiviet','','');
		$total_rows = $query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/baiviet';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$this->admin_model->gettbl_search_limited('baiviet',$_SESSION['start_row'],$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='baiviet';			
		$this->load->view('template',$data);    	   
    }  
    
      	
	function frmbaiviet()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['content']='frmbaiviet'; 
        $this->load->view('template',$data);  
    }
    
	function add_baiviet()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));		
        $alias=$this->input->post('alias');
        if($alias=='')
        {
            $alias=vn_str_filter($title);
        }        
		$uid=$this->input->post('uid');		
		$ngay=explode('-',$this->input->post('created_day'));
		if($this->input->post('time')==''){
			$time='00:00:00';
		}
		else{
			$time=$this->input->post('time');
		}
		$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0].' '.$time;		
        $status =$this->input->post('status');											
		if(!is_dir('upload/news')){
			mkdir('upload/news', 0755, TRUE);
			mkdir('upload/news/thumb', 0755, TRUE);
            mkdir('upload/news/thumb/240', 0755, TRUE);
		}
		if ($_FILES['image']['name']==null)
		{
			if($id==''){
				$image='';
			}
			else{
				$image=$_POST['image'];
			}
		}
		else
		{
			$filename = $_FILES['image']['name'];
	        $filedata = $_FILES['image']['tmp_name'];			
			$temp=explode('.',$filename);			
			$imageThumb = new Image($filedata);
			$thumb_path = vn_str_filter($title);
			$imageThumb->save($thumb_path, 'upload/news', $temp[1]);

			$imageThumb->resize(330,240,'crop');
			$imageThumb->save($thumb_path, 'upload/news/thumb', $temp[1]);
            $imageThumb->resize(240,180,'crop');
			$imageThumb->save($thumb_path, 'upload/news/thumb/240', $temp[1]);
			$image=vn_str_filter($title).'.'.$temp[1];
		}		
		if($_POST['meta_title']==''){
			$meta_title = $meta_key = $meta_des = $title;
		}else{
			$meta_title = $this->input->post('meta_title');
			$meta_key 	= $this->input->post('meta_key');
			$meta_des 	= $this->input->post('meta_des');
		}			
		if($_FILES["file"]["name"]){
			# Tạo thư mục 
			$album_dir  =  'download/';
			if(!is_dir($album_dir)){
				mkdir($album_dir);
			}
			#upload.
			$config['upload_path']	 =  $album_dir;
			$config['allowed_types'] =  'doc|docx|pdf|xls|xlsx';
			$config['max_size'] =  10000;
				
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$image =  $this->upload->do_upload("file");
			$image_data  = 	$this->upload->data();
			if($image) {				
				$file =	$config['upload_path'].$image_data['file_name'];				
			} else {
				$file = '';				
			}			
		}else{
			if($id==''){
				$file='';
			}
			else{
				$file=$_POST['file'];
			}
		}
		$data=array(
				'title' 	=>	$title,				
				'alias'		=>	$alias,				
				'cid'		=>	$this->input->post('cid'),
				'image'  	=>  $image,				
				'file'  	=>  $file,				
				'sapo' 		=>	$this->input->post('sapo'),				
				'content'  =>  $this->input->post('content'),
				'created_day'	=>	$created_day,
				'vip' 		=>	$this->input->post('vip'),				
				'status'    =>  $this->input->post('status'),				
				'uid' 		=>	$uid,
				'meta_title' 	=>	$meta_title,
				'meta_key' 		=>	$meta_key,
				'meta_des' 		=>	$meta_des							
			);
		$this->admin_model->add_tbl('baiviet',$data,$id);		 
		$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/baiviet');}
		else{
			redirect('admin/baiviet/'.$_SESSION['start_row']);
		}		
    }
	function edit_baiviet($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');		
        $data['id']=$id;
        $data['content']='frmbaiviet';
        $this->load->view('template',$data);    
    }
    function ajaxgetlistarticle()
    {
        $findkey = $this->input->post('findkey');
        $data=$this->admin_model->Getlistcontent($findkey);
        echo json_encode($data);
    }	
	function del_baiviet()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$sql="SELECT image FROM baiviet WHERE id=".$del_id;
				$query=$this->db->query($sql)->row();
				if(file_exists('upload/news/'.$query->image)){
					unlink('upload/news/'.$query->image);
					unlink('upload/news/thumb/'.$query->image);
				}				
				$result = $this->admin_model->del_tbl('baiviet',$del_id);
			}
			redirect('admin/baiviet/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/baiviet');  
        }
	}	

	//Bài viết tìm gia sư
	function baiviettimgiasu()
    {
		$this->checklogin();				
		$this->load->helper('status');	
		if(isset($_POST['txt_search']) OR isset($_POST['search_status']) OR isset($_POST['search_user'])){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_user']);			
			unset($_SESSION['search_status']);			
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_user'] = $_POST['search_user'];
			$_SESSION['search_status'] = $_POST['search_status'];			
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['search_status']) AND $_SESSION['search_user'] == 0 AND $_SESSION['search_status'] == -1){
				$_SESSION['txt_search'] = '';
				$_SESSION['search_user'] = 0;
				$_SESSION['search_status'] = -1;
			}			
		}			
		
        $start_row=$this->uri->segment(3);		
        $per_page=20;    		
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;					
		}				    		
		else
		{
			$_SESSION['start_row']=0;				
		}			            
		$query=$this->admin_model->gettbl_search_limited('baiviettimgiasu','','');
		$total_rows = $query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/baiviettimgiasu';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$this->admin_model->gettbl_search_limited('baiviettimgiasu',$_SESSION['start_row'],$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='baiviettimgiasu';			
		$this->load->view('template',$data);    	   
    }  
      	
	function urlgiasuadd()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontentgiasu('');
        $query = $this->admin_model->Getallby($table='city');
        $data['listcity'] = $query['data'];
        $data['content']='frmaddurl_giasu'; 
        $this->load->view('template',$data);  
    }
    function urlphuhuynhadd()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontentgiasu('');
        $data['content']='frmaddurl_phuhuynh'; 
        $this->load->view('template',$data);  
    }
    function add_url_giasu() {
    	$this->checklogin();		
		$this->checkrole();
		$data = [

			'h1' 				=> $_POST['h1'],
			'key_tag'			=> $_POST['key_tag'],
			'alias'				=> $_POST['alias'],
			'content'			=> $_POST['content'],
			'seo_keyword' 		=> $_POST['keyword'],
			'seo_description'	=> $_POST['description'],
			'seo_title' 		=> $_POST['title'],
			'place_id'			=> $_POST['place'],
			'place_name'		=> $_POST['cit_name'],
			'index'				=> 0
		];
		if ($data['key_tag'] != '' && $data['place_id'] == '') {
			$data['option'] = 0;
		} else if ($data['key_tag'] == '' && $data['place_id'] != '') {
			$data['option'] = 1;
		} else if ($data['key_tag'] != '' && $data['place_id'] != '') {
			$data['option'] = 2;
		}
		// $checkalias = $this->admin_model->checkalias($data['alias']);
		$checkalias =  false;
		if ($checkalias == true) {
			$result['kq'] = 0;
		} else {
			$insert = $this->admin_model->insert('url_phuhuynh', $data);
			if ($insert) {
				$result['kq'] = 1;
			} else {
				$result['kq'] = 2;
			}
		}
		echo json_encode($result);
    }
    function add_url_phuhuynh() {
    	$this->checklogin();		
		$this->checkrole();
		$data = [
			'h1' 				=> $_POST['h1'],
			'key_tag'			=> $_POST['key_tag'],
			'alias'				=> $_POST['alias'],
			'content'			=> $_POST['content'],
			'seo_keyword' 		=> $_POST['keyword'],
			'seo_description'	=> $_POST['description'],
			'seo_title' 		=> $_POST['title'],
			'option'			=> $_POST['option'],
			'index'				=> 0
		];
	
		$checkalias = $this->admin_model->checkalias_phuhuynh($data['alias']);
		if ($checkalias == true) {
			$result['kq'] = 0;
		} else {
			$insert = $this->admin_model->insert('url_timviec', $data);
			if ($insert) {
				$result['kq'] = 1;
			} else {
				$result['kq'] = 2;
			}
		}
		echo json_encode($result);
    }
    function edit_url_giasu() {
    	$this->checklogin();		
    	$this->checkrole();
    	$id = $_POST['id'];

    	$data = [
    		'h1' 				=> $_POST['h1'],
    		'key_tag'			=> $_POST['key_tag'],
    		'content'			=> $_POST['content'],
    		'seo_keyword' 		=> $_POST['keyword'],
    		'seo_description'	=> $_POST['description'],
    		'seo_title' 		=> $_POST['title'],
    		'option'			=> $_POST['option'],
    		'index'				=> 0
    	];

    	if ($id != '') {
    		$update = $this->admin_model->add_tbl('url_phuhuynh', $data, $id);
    		$result['kq'] = 1;
    	} else {
    		$result['kq'] = 0;
    	}
    	echo json_encode($result);
    }
        function edit_url_phuhuynh() {
    	$this->checklogin();		
    	$this->checkrole();
    	$id = $_POST['id'];

    	$data = [
    		'h1' 				=> $_POST['h1'],
    		'key_tag'			=> $_POST['key_tag'],
    		'content'			=> $_POST['content'],
    		'seo_keyword' 		=> $_POST['keyword'],
    		'seo_description'	=> $_POST['description'],
    		'seo_title' 		=> $_POST['title'],
    		'option'			=> $_POST['option'],
    		'index'				=> 0
    	];

    	if ($id != '') {
    		$update = $this->admin_model->add_tbl('url_timviec', $data, $id);
    		$result['kq'] = 1;
    	} else {
    		$result['kq'] = 0;
    	}
    	echo json_encode($result);
    }	
	function frmbaiviettimgiasu()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontentgiasu('');
        $data['content']='frmbaiviettimgiasu'; 
        $this->load->view('template',$data);  
    }
    
	function add_baiviettimgiasu()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));	
        $alias=$this->input->post('alias');
        if($alias=='')
        {
            $alias=vn_str_filter($title);
        }   	
        $link=$this->input->post('link');
		$ngay=explode('-',$this->input->post('created_day'));
		if($this->input->post('time')==''){
			$time='00:00:00';
		}
		else{
			$time=$this->input->post('time');
		}
		$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0].' '.$time;		
        $status =$this->input->post('status');											
			
		if($_POST['meta_title']==''){
			$meta_title = $meta_key = $meta_des = $title;
		}else{
			$meta_title = $this->input->post('meta_title');
			$meta_key 	= $this->input->post('meta_key');
			$meta_des 	= $this->input->post('meta_des');
		}			
		if($_FILES["file"]["name"]){
			# Tạo thư mục 
			$album_dir  =  'download/';
			if(!is_dir($album_dir)){
				mkdir($album_dir);
			}
			#upload.
			$config['upload_path']	 =  $album_dir;
			$config['allowed_types'] =  'doc|docx|pdf|xls|xlsx';
			$config['max_size'] =  10000;
				
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$image =  $this->upload->do_upload("file");
			$image_data  = 	$this->upload->data();
			if($image) {				
				$file =	$config['upload_path'].$image_data['file_name'];				
			} else {
				$file = '';				
			}			
		}else{
			if($id==''){
				$file='';
			}
			else{
				$file=$_POST['file'];
			}
		}
		$data=array(
				'link'		=>	$link,
				'title' 	=>	$title,
				'alias'		=>  $alias,
				'file'  	=>  $file,	
				'created_day'	=>	$created_day,			
				'sapo' 		=>	$this->input->post('sapo'),				
				'content'  =>  $this->input->post('content'),
				'vip' 		=>	$this->input->post('vip'),				
				'status'    =>  $this->input->post('status'),				
				'meta_title' 	=>	$meta_title,
				'meta_key' 		=>	$meta_key,
				'meta_des' 		=>	$meta_des							
			); 		
		$this->admin_model->add_tbl('baiviettimgiasu',$data,$id);		 
		$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/baiviettimgiasu');}
		else{
			redirect('admin/baiviettimgiasu/'.$_SESSION['start_row']);
		}		
    }
	function edit_baiviettimgiasu($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontentgiasu('');		
        $data['id']=$id;
        $data['content']='frmbaiviettimgiasu';
        $this->load->view('template',$data);    
    }
    function ajaxgetlistarticlegiasu()
    {
        $findkey = $this->input->post('findkey');
        $data=$this->admin_model->Getlistcontentgiasu($findkey);
        echo json_encode($data);
    }	
	function del_baiviettimgiasu()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('baiviettimgiasu',$del_id);
			}
			redirect('admin/baiviettimgiasu/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/baiviettimgiasu');  
        }
	}


//Bài viết
	function baiviettimlop()
    {
		$this->checklogin();				
		$this->load->helper('status');	
		if(isset($_POST['txt_search']) OR isset($_POST['search_status']) OR isset($_POST['search_user'])){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_user']);			
			unset($_SESSION['search_status']);			
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_user'] = $_POST['search_user'];
			$_SESSION['search_status'] = $_POST['search_status'];			
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['search_status']) AND isset($_SESSION['search_user']) AND $_SESSION['txt_search'] == '' AND $_SESSION['search_user'] == 0 AND $_SESSION['search_status'] == -1){
				$_SESSION['txt_search'] = '';
				$_SESSION['search_user'] = 0;
				$_SESSION['search_status'] = -1;
			}			
		}			
		
        $start_row=$this->uri->segment(3);		
        $per_page=20;    		
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;					
		}				    		
		else
		{
			$_SESSION['start_row']=0;				
		}			            
		$query=$this->admin_model->gettbl_search_limited('baiviettimlop','','');
		$total_rows = $query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/baiviettimlop';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$this->admin_model->gettbl_search_limited('baiviettimlop',$_SESSION['start_row'],$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='baiviettimlop';			
		$this->load->view('template',$data);    	   
    }  
    
      	
	function frmbaiviettimlop()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontent('');
        $data['content']='frmbaiviettimlop'; 
        $this->load->view('template',$data);  
    }
    
	function add_baiviettimlop()
    {        
				$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));		
        $link=$this->input->post('link');
        $alias=$this->input->post('alias');
        if($alias=='')
        {
            $alias=vn_str_filter($title);
        }   
		$ngay=explode('-',$this->input->post('created_day'));
		if($this->input->post('time')==''){
			$time='00:00:00';
		}
		else{
			$time=$this->input->post('time');
		}
		$created_day=$ngay[2].'-'.$ngay[1].'-'.$ngay[0].' '.$time;		
        $status =$this->input->post('status');											
			
		if($_POST['meta_title']==''){
			$meta_title = $meta_key = $meta_des = $title;
		}else{
			$meta_title = $this->input->post('meta_title');
			$meta_key 	= $this->input->post('meta_key');
			$meta_des 	= $this->input->post('meta_des');
		}			
		if($_FILES["file"]["name"]){
			# Tạo thư mục 
			$album_dir  =  'download/';
			if(!is_dir($album_dir)){
				mkdir($album_dir);
			}
			#upload.
			$config['upload_path']	 =  $album_dir;
			$config['allowed_types'] =  'doc|docx|pdf|xls|xlsx';
			$config['max_size'] =  10000;
				
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$image =  $this->upload->do_upload("file");
			$image_data  = 	$this->upload->data();
			if($image) {				
				$file =	$config['upload_path'].$image_data['file_name'];				
			} else {
				$file = '';				
			}			
		}else{
			if($id==''){
				$file='';
			}
			else{
				$file=$_POST['file'];
			}
		}
		$data=array(
				'link'		=>	$link,
				'title' 	=>	$title,
				'alias'		=>  $alias,		
				'file'  	=>  $file,	
				'created_day'	=>	$created_day,			
				'sapo' 		=>	$this->input->post('sapo'),				
				'content'  =>  $this->input->post('content'),
				'vip' 		=>	$this->input->post('vip'),				
				'status'    =>  $this->input->post('status'),				
				'meta_title' 	=>	$meta_title,
				'meta_key' 		=>	$meta_key,
				'meta_des' 		=>	$meta_des							
			); 		
		$this->admin_model->add_tbl('baiviettimlop',$data,$id);		 
		$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/baiviettimlop');}
		else{
			redirect('admin/baiviettimlop/'.$_SESSION['start_row']);
		}	
    }
	function edit_baiviettimlop($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistcontentlop('');		
        $data['id']=$id;
        $data['content']='frmbaiviettimlop';
        $this->load->view('template',$data);    
    }
    function ajaxgetlistarticlelop()
    {
        $findkey = $this->input->post('findkey');
        $data=$this->admin_model->Getlistcontentlop($findkey);
        echo json_encode($data);
    }	
	function del_baiviettimlop()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('baiviettimlop',$del_id);
			}
			redirect('admin/baiviettimlop/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/baiviettimlop');  
        }
	}	

	//keywork
	function keywork()
    {
		$this->checklogin();				
		if(isset($_POST['txt_search']) OR isset($_POST['cid'])){	
			unset($_SESSION['txt_search']);
			unset($_SESSION['search_cid']);			
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['search_cid'] = $_POST['cid'];
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['search_cid']) AND $_SESSION['txt_search'] == '' AND $_SESSION['search_cid'] == 0){
				$_SESSION['txt_search'] = '';
				$_SESSION['search_cid'] = 0;
			}			
		}			
		
        $start_row=$this->uri->segment(3);		
        $per_page=20;    		
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;					
		}				    		
		else
		{
			$_SESSION['start_row']=0;				
		}			            
		$query=$this->admin_model->gettbl_search_keywork('keywork','','');
		$total_rows = $query->num_rows();				
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/keywork';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);    		
		$data['query']=$this->admin_model->gettbl_search_keywork('keywork',$_SESSION['start_row'],$per_page);			
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='keywork';			
		$this->load->view('template',$data);    	   
    }  
    
      	
	function frmkeywork()
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistkeywork('');
        $data['content']='frmkeywork'; 
        $this->load->view('template',$data);  
    }
    
	function add_keywork()
    {        
		$this->checklogin();
        $id=$this->input->post('id');
        $keywork=trim($this->input->post('keywork'));		
        $link=$this->input->post('link');
        $file = $_FILES['file']['tmp_name'];
        if($file != null){
        	$obj = PHPExcel_IOFactory::createReaderForFile($file);
        	$objex = $obj->load($file);
        	$sheetData = $objex->getActiveSheet()->toArray('null', true, true, true);
        	$hight=$objex->setActiveSheetIndex()->getHighestRow('A');
        	for($row = 2; $row<=$hight; $row++){
        		$keywork = $sheetData[$row]['B'];
        		$link = $sheetData[$row]['C'];
        		$data=array(
					'keywork' 	=>	$keywork,				
					'link'		=>	$link
				);
        		$this->admin_model->add_tbl('keywork',$data,$id);
        	}
        }else if(!empty($keywork) && !empty($link)){
        	$data=array(
				'keywork' 	=>	$keywork,				
				'link'		=>	$link
			); 
			$this->admin_model->add_tbl('keywork',$data,$id);
        }
		$this->sitemap(); 
		if($_SESSION['start_row']==0){redirect('admin/keywork');}
		else{
			redirect('admin/keywork/'.$_SESSION['start_row']);
		}		
    }
	function edit_keywork($id)
    {
		$this->checklogin();
        $data['listdefault']=$this->admin_model->Getlistkeywork('');		
        $data['id']=$id;
        $data['content']='frmkeywork';
        $this->load->view('template',$data);    
    }
	function del_keywork()
	{     
		$this->checklogin();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {    
        	for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];
				$result = $this->admin_model->del_tbl('keywork',$del_id);
			}        
			redirect('admin/keywork/'.$_SESSION['start_row']);			           
        }
        else
        { 
            echo 'Bạn phải chọn';
			redirect('admin/keywork');  
        }
	}	

	function chuyenmuc()
    {
		$this->load->helper('status');
		$this->checklogin();
		$this->checkrole();
        $start_row=$this->uri->segment(3);
            $per_page=15;
    		if(is_numeric($start_row))
    		{
    			$start_row=$start_row;
    		}
    		else
    		{
    			$start_row=0;
    		}
            $query=$this->admin_model->gettbl('chuyenmuc','');			
    		$total_rows = $query->num_rows();
    		$this->load->library('pagination');
    		$config['base_url'] = site_url().'/admin/chuyenmuc/';
    		$config['total_rows'] = $total_rows;
    		$config['per_page'] = $per_page;
    		$config['uri_segment']=3;
    		$config['next_link'] = '>';
    		$config['prev_link'] = '<';
    		$config['num_links'] = 4;
    		$config['first_link'] = '<<';
    		$config['last_link'] = '>>';    		
    		$this->pagination->initialize($config);
    		$data['query']=$this->admin_model->gettbl_limited('chuyenmuc',$start_row,$per_page);
    		$data['pagination']= $this->pagination->create_links();	
    		$data['content']='chuyenmuc';			
    		$this->load->view('template',$data);    	   
    }
	
	function frmchuyenmuc()
    {
		$this->checklogin();
		$this->checkrole();
        $data['content']='frmchuyenmuc'; 
        $this->load->view('template',$data);  
    }
	
	function add_chuyenmuc()
    {
		$this->checklogin();
		$this->checkrole();		
		$id = $this->input->post('id');		
		$alias=$this->input->post('alias');
		if($alias=='')
		{
			$alias=vn_str_filter($this->input->post('name'));
		}    
		//Xử lý ảnh				
		if ($_FILES['image']['name']==null)
		{
			if($id==''){
				$image='';					
			}
			else{
				$image=$_POST['image'];									
			}			
		}
		else
		{							
			$filename = $_FILES['image']['name'];
	        $filedata = $_FILES['image']['tmp_name'];		        				
			//Xu ly crop anh
			$temp=explode('.',$filename);				
			$image=$filename;				
			$imageThumb = new Image($filedata);			
			$thumb_path = $temp[0];							
			$imageThumb->resize(270,270,'crop');
			$imageThumb->save($thumb_path, 'upload', $temp[1]);							
		}

		$data=array(
				'name' 		=>	$this->input->post('name'),
				'alias'		=>	$alias,
				'image'		=>	$image,					
				'parent'	=>  $this->input->post('parent'),
				'content'   =>  $this->input->post('content'),
				'menu' 		  	=>  $this->input->post('menu'),
				'sort'	  		=>  $this->input->post('sort'),
				'meta_title'  	=>  $this->input->post('meta_title'),
				'meta_key'   	=>  $this->input->post('meta_key'),
				'meta_des'   	=>  $this->input->post('meta_des'),				
				'status'    =>  $this->input->post('status')
			); 
		$this->admin_model->add_tbl('chuyenmuc',$data,$id);				
		redirect('admin/chuyenmuc');		
    }
	
	function edit_chuyenmuc($id)
    {
		$this->checklogin();
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmchuyenmuc';
        $this->load->view('template',$data);    
    }
	
	function del_chuyenmuc()
	{     
		$this->checklogin();
		$this->checkrole();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];					
				$result = $this->admin_model->del_tbl('chuyenmuc',$del_id);    				
			}
            if($result)
            {
                redirect('admin/chuyenmuc');        
            }                     
        }
        else
        { 
            echo 'Bạn phải chọn';
            redirect('admin/chuyenmuc');
        }
	}	

	function tbladmin()
    {
		$this->checklogin();		
		$this->checkrole();
		$this->load->helper('status');
		$start_row=$this->uri->segment(3);
		$per_page=15;
		if(is_numeric($start_row))
		{
			$start_row=$start_row;
		}
		else
		{
			$start_row=0;
		}
		$query=$this->admin_model->gettbl('tbl_admin','');			
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/tbladmin';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';    		
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_limited('tbl_admin',$start_row,$per_page);
		$data['pagination']= $this->pagination->create_links();	
		$data['content']='tbladmin';			
		$this->load->view('template',$data);    	   
    }
	function frmadmin()
    {
		$this->checklogin();		
		$this->checkrole();
        $data['content']='frmadmin'; 
        $this->load->view('template',$data);  
    }
	function add_admin()
    {        
		$this->checklogin();		
		$this->checkrole();
		$id=$this->input->post('id');       		
		if($id=='' or md5($this->input->post('pass') != $this->admin_model->gettbl('tbl_admin',$id)->row()->pass)){
			$pass = md5($this->input->post('pass'));
		}
		else{			
			$pass = $this->input->post('pass');			
		}
		$data=array(				
			'fullname'	=>	$this->input->post('fullname'),				
			'name'		=>	$this->input->post('name'),		
			'pass' 		=>	$pass,	
			'role' 		=>	$this->input->post('role'),
			'status'    =>  $this->input->post('status')			
		); 		
        $this->admin_model->add_tbl('tbl_admin',$data,$id);   
        redirect('admin/tbladmin');
    }
	function edit_admin($id)
    {
		$this->checklogin();		
		$this->checkrole();
        $data['id']=$id;
        $data['content']='frmadmin';
        $this->load->view('template',$data);    
    }	
    function del_admin()
	{     
		$this->checklogin();		
		$this->checkrole();
        $checkbox=$_POST['checkbox'];                             
        $countcheck=count($checkbox);           
        if($countcheck!=0)
        {            
            for($i=0;$i<$countcheck;$i++)
            {
                $del_id = $checkbox[$i];				
				$result = $this->admin_model->del_tbl('tbl_admin',$del_id);
			}
            if($result)
            {
                redirect('admin/tbladmin');        
            }                     
        }
        else
        { 
            echo 'Bạn phải chọn';
            redirect('admin/tbladmin');
        }
	}
	function status()
	{
	   $this->checklogin();
	   $id=$_POST["id"];
	   $tblname=$_POST["tblname"];
	   $test = $this->admin_model->gettbl($tblname,$id)->row();
	   if($test->status==0){
			$this->admin_model->checkstatus($tblname,1,$id);
	   }
	   else{
			$this->admin_model->checkstatus($tblname,0,$id);
	   }	 	  
	}	
    function statusck()
	{
	   $this->checklogin();
	   $id=$_POST["id"];
       $field=$_POST["field"];
       $fieldvl=$_POST["fieldvl"];
       $fieldid=$_POST["fieldid"];
	   $tblname=$_POST["tblname"];
	   //$test = $this->admin_model->gettblbyfield($tblname,$fieldid,$id)->row();
	   
			$this->admin_model->checkstatusjob($tblname,$field,$fieldvl,$fieldid,$id);
	   	 	  
	}
	function add_footer()
    {
		$this->checklogin();
		$this->checkrole();
		$id = $this->input->post('id');	
		
		$data=array(
				'name'  	=>  $this->input->post('name'),
				'diachi'  	=>  $this->input->post('diachi'),
				'email'  	=>  $this->input->post('email'),
				'content'  	=>  $this->input->post('content'),
				'content_thu'  	=>  $this->input->post('content_thu'),
				'face'  	=>  $this->input->post('face'),
				'google'  	=>  $this->input->post('google'),
				'yoube'  	=>  $this->input->post('yoube'),
				'meta_title'  	=>  $this->input->post('meta_title'),
			    'meta_key'  	=>  $this->input->post('meta_key'),
                'meta_des'  	=>  $this->input->post('meta_des'),
				'meta_footer'  	=>  $this->input->post('meta_footer'),
				'anatic'  	=>  $this->input->post('anatic'),
				'map'  		=>  $this->input->post('map'),
                'meta_estimate'  		=>  $this->input->post('meta_estimate'),
                'meta_descestimate'  		=>  $this->input->post('meta_descestimate'),
                'meta_titleestimate'  		=>  $this->input->post('meta_titleestimate'),
                'estimateh1'=>$this->input->post('estimateh1'),
				'status'    =>  $this->input->post('status')
			); 
		$this->admin_model->add_tbl('tbl_footer',$data,$id);
		redirect('admin');	
    }
	
	function login()
    {
        $this->load->view('login_view');    
    }
    function dologin()
    {       
        if($this->admin_model->getlogin($this->input->post('name'),$this->input->post('pass'))==TRUE)
        {
           $_SESSION['name_admin']=$this->input->post('name');              
           redirect('admin'); 
        }   
        else
        {            
            redirect('admin/login');
        } 
    }
    function thoat()
    {
        if(isset($_SESSION['name_admin']))
        {
            unset($_SESSION['name_admin']);
        }
        redirect('admin/login');
    }
    function checklogin()
    {
		
        if(isset($_SESSION['name_admin']))
        {     
			
        }
        else
        {
            redirect('admin/login');
        }
    }
	function checkrole()
    {
        if(isset($_SESSION['name_admin']))
        {      
			$this->db->where('status',1);
			$this->db->where('name',$_SESSION['name_admin']);
			$admin=$this->db->get('tbl_admin')->row();	
			if($admin->role==2){
				redirect('admin');
			}
        }        
    }		   	

	/////////////////////
	function sitemap()
	{		
		$doc = new DOMDocument("1.0","utf-8"); 
		$doc->formatOutput = true;
		$r = $doc->createElement("urlset");
		$r->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");
		$doc->appendChild( $r );
		$url = $doc->createElement("url" );
		$name = $doc->createElement("loc" );
		$name->appendChild(
		$doc->createTextNode('https://timviec365.com.vn/cv365/')
		);
		$url->appendChild($name);   
		$changefreq = $doc->createElement( "changefreq" );
		$changefreq->appendChild(
			$doc->createTextNode('daily')
		);
		   $url->appendChild($changefreq);   
		$priority = $doc->createElement( "priority" );
		$priority->appendChild(
		$doc->createTextNode('1.00')
		);
		$url->appendChild($priority);   
		$r->appendChild($url);   	  
	
		$this->db->where('status',1);
		$this->db->order_by("id", "desc"); 
		$this->db->limit(200);
		$cate=$this->db->get('baiviet');
		if($cate->num_rows()>0)
		{
			foreach($cate->result() as $row)
		{		
		$url = $doc->createElement( "url" );
		
		$name = $doc->createElement( "loc" );
		$name->appendChild(
		 $doc->createTextNode(site_url($row->alias.'-b'.$row->id).'.html')
		);
		$url->appendChild($name);
		
		$changefreq = $doc->createElement( "changefreq" );
		$changefreq->appendChild(
		 $doc->createTextNode('daily')
		);
		$url->appendChild($changefreq);
		
		$priority = $doc->createElement( "priority" );
		$priority->appendChild(
		 $doc->createTextNode('1.00')
		);
			$url->appendChild($priority);
		
			$r->appendChild($url);
		}
		}                    	 
		$doc->save("sitemap.xml"); 
	}	
	//link seo
	function linkseo()
    {
		$this->checklogin();
		$this->load->helper('status');
		if(isset($_POST['txt_search']) OR isset($_POST['citylinkseo']) OR isset($_POST['subjectseo'])){
			unset($_SESSION['txt_search']);
			unset($_SESSION['citylinkseo']);
			unset($_SESSION['subjectseo']);
			$_SESSION['txt_search'] = $_POST['txt_search'];
			$_SESSION['citylinkseo'] = $_POST['citylinkseo'];
			$_SESSION['subjectseo'] = $_POST['subjectseo'];
		}
		else{
			if(isset($_SESSION['txt_search']) AND isset($_SESSION['citylinkseo']) AND isset($_SESSION['subjectseo'])  AND $_SESSION['txt_search'] == '' AND $_SESSION['citylinkseo'] == '' AND $_SESSION['subjectseo'] == ''){
				$_SESSION['txt_search'] = '';
				$_SESSION['citylinkseo'] = '';
				$_SESSION['subjectseo'] = '';
			}
		}

        $start_row=$this->uri->segment(3);
        $per_page=20;
		if(is_numeric($start_row)){
			$_SESSION['start_row']=$start_row;
		}
		else
		{
			$_SESSION['start_row']=0;
		}
		$query=$this->admin_model->gettbl_search_limited('linkseo','','');
		$total_rows = $query->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = site_url().'/admin/linkseo';
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] =3;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$config['num_links'] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$this->pagination->initialize($config);
		$data['query']=$this->admin_model->gettbl_search_limited('linkseo',$_SESSION['start_row'],$per_page);
		$data['pagination']= $this->pagination->create_links();
		$data['content']='linkseo';
		$this->load->view('template',$data);
    }


	function frmlinkseo()
    {
		$this->checklogin();
        $data['content']='frmlinkseo';
        $this->load->view('template',$data);
    }

	function add_linkseo()
    {
		$this->checklogin();
        $id=$this->input->post('id');
        $title=trim($this->input->post('title'));
		$CreateDate=date("Y-m-d H:i:s",time());
		$itemlinkseo=$this->admin_model->getlinkseobuysubcitytype($this->input->post('subjectid'),$this->input->post('cityid'),$this->input->post('type'));
		//var_dump($itemlinkseo);
        if($itemlinkseo != "" && $id==""){
		  $id=$itemlinkseo->id;
		}
		//var_dump($id);die();
		$data=array(
				'title' 	=>	$title,
				'htmltext'  =>  $this->input->post('htmltext'),
				'createdate'	=>	$CreateDate,
				'type' 		=>	$this->input->post('type'),
				'cityid'    =>  $this->input->post('cityid'),
				'subjectid' 		=>	$this->input->post('subjectid')
			);
		$this->admin_model->add_tbl('linkseo',$data,$id);
		$this->sitemap();
		if($_SESSION['start_row']==0){redirect('admin/linkseo');}
		else{
			redirect('admin/linkseo/'.$_SESSION['start_row']);
		}
    }
	function edit_linkseo($id)
    {
		$this->checklogin();
        $data['id']=$id;
        $data['content']='frmlinkseo';
        $this->load->view('template',$data);
    }

	function del_linkseo()
	{
		//$this->checklogin();
//        $checkbox=$_POST['checkbox'];
//        $countcheck=count($checkbox);
//        if($countcheck!=0)
//        {
//            for($i=0;$i<$countcheck;$i++)
//            {
//                $del_id = $checkbox[$i];
//				$sql="SELECT image FROM baiviet WHERE id=".$del_id;
//				$query=$this->db->query($sql)->row();
//				if(file_exists('upload/news/'.$query->image)){
//					unlink('upload/news/'.$query->image);
//					unlink('upload/news/thumb/'.$query->image);
//				}
//				$result = $this->admin_model->del_tbl('baiviet',$del_id);
//			}
//			redirect('admin/baiviet/'.$_SESSION['start_row']);
//        }
//        else
//        {
//            echo 'Bạn phải chọn';
//			redirect('admin/baiviet');
//        }
	}
}
?>
<?php 
class admin_model extends Model
{	
	function admin_model()
	{
		parent::Model();
	}
	
	function gettbl($tbl,$id)
	{
		if($id!=''){
			$this->db->where('id',$id);
		}				
		$query = $this->db->get($tbl);
		return $query;
	}	
	function gettbl_listbv($tbl)
	{		
		$this->db->where('status',1);
		$query = $this->db->get($tbl);
		return $query;
	}
	
	function add_tbl($tbl,$data,$id)
    {		
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where('id',$id);
            $this->db->update($tbl,$data);    
        }
    }
    function insert($table, $data) {
         $this->db->insert($table, $data);
         return true;
    }
    function add_seocity($tbl,$data,$id)
    {       
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where('City_ID',$id);
            $this->db->update($tbl,$data);    
        }
    }
      function add_seosubject($tbl,$data,$id)
    {       
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where('subject_id',$id);
            $this->db->update($tbl,$data);    
        }
    }
      function add_seosubjectcity($tbl,$data,$id)
    {       
        if($id == '')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where('id',$id);
            $this->db->update($tbl,$data);    
        }
    }
	function UpdateorAddtbl($tbl,$data,$keyID,$id)
    {		
        if($id=='')
        {
            $this->db->insert($tbl,$data);
        }
        else
        {
            $this->db->where($keyID,$id);
            $this->db->update($tbl,$data);    
        }
    } 
    function ListSubject()
    {
        $query="select * from subject";
       $db_qr = $this->db->query($query); 
       $tg1="";
        if($db_qr->num_rows() > 0)
        {
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;    
            }            
        }
        return $tg1;
    }
    function ListClass()
{
    $query="select * from class"  ;
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;    
        }            
    }
    return $tg1;
}
function ListCity(){
    $query = "select * from city";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;    
        }            
    }
    return $tg1;
}
function ListDistrict(){
    $query = "select * from city2 where cit_parent = 45";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;    
        }            
    }
    return $tg1;
}
function GetSubjectByID($idsubject)
{
    $query="select * from subject where ID='".intval($idsubject)."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;
}
function GetDistrictByID($iddistrict)
{
    $query="select * from city2 where cit_id ='".intval($iddistrict)."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;
}
function GetClassByID($idclass)
{
    $query="select * from class where id='".intval($idclass)."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;
}
	function show_category($cid,$parent_id="0",$insert_text="-")
    {
        $this->db->where('parent',$parent_id);
        $this->db->order_by('id','asc');
        $sql=$this->db->get('chuyenmuc');
        foreach($sql->result() as $itemcat)
        {		
			if($itemcat->id==$cid){
				echo "<option selected=\"selected\" value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";				
			}
			else{
				echo "<option value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";				
			}
            $this->show_category($cid,$itemcat->id,$insert_text."---");    
        }
        return true;
    }
	function Getlistcontent($findkey)
    {
        if($findkey != '')
        {
            $query="SELECT id,alias,title,image FROM baiviet WHERE status=1 and title like '%".str_replace(' ','%',$findkey)."%' ORDER BY id DESC LIMIT 5";
        }else{
            $query='SELECT id,alias,title,image FROM baiviet WHERE status=1 ORDER BY id DESC LIMIT 5';
        }
        //var_dump($query);die();
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            { 
                $tg[]=$items;
                }
                return $tg;
                
    }	
    function Getlistcontentgiasu($findkey)
    {
        if($findkey != '')
        {
            $query="SELECT * FROM baiviettimgiasu WHERE status=1 and title like '%".str_replace(' ','%',$findkey)."%' ORDER BY id DESC LIMIT 5";
        }else{
            $query='SELECT * FROM baiviettimgiasu WHERE status=1 ORDER BY id DESC LIMIT 5';
        }
        //var_dump($query);die();
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            { 
                $tg[]=$items;
                }
                return $tg;
                
    }
    function Getlistcontentlop($findkey)
    {
        if($findkey != '')
        {
            $query="SELECT * FROM baiviettimlop WHERE status=1 and title like '%".str_replace(' ','%',$findkey)."%' ORDER BY id DESC LIMIT 5";
        }else{
            $query='SELECT * FROM baiviettimlop WHERE status=1 ORDER BY id DESC LIMIT 5';
        }
        //var_dump($query);die();
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            { 
                $tg[]=$items;
                }
                return $tg;
                
    }
    function Getlistkeywork($findkey)
    {
        if($findkey != '')
        {
            $query="SELECT * FROM keywork WHERE keywork LIKE '%".str_replace(' ','%',$findkey)."%' ORDER BY id DESC LIMIT 5";
        }else{
            $query='SELECT * FROM keywork ORDER BY id DESC LIMIT 5';
        }
        //var_dump($query);die();
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            { 
                $tg[]=$items;
                }
                return $tg;
                
    }   
    function selectCtrl($cid,$name,$class)
    {
        echo "<select name='".$name."' class='".$class."'>\n";
		echo "<option value='0'>-- Chọn chuyên mục --</option>";
        $this->show_category($cid);
        echo "</select>";
    }    	
	// Đệ quy link thân thiện
	function getcatlink($uid)
    {				
		$catlink=0;
        $this->db->where('id',$uid);
        $sql1=$this->db->get('tblchuyenmuc');
        if($sql1->num_rows() >0)
        {           		
            foreach($sql1->result() as $items)
            {                            
                $catlink = $this->getcatlink($items->uid); 
				$catlink .= '/'.$items->alias;								
            }   
		return $catlink;
        }				
    }

		
	function gettbl_limited($tbl,$start_row,$limit)
	{
	    $sql="select * from $tbl  limit $start_row,$limit"; //  order by id  desc
		$query=$this->db->query($sql);
		return $query;
	}	

	function gettbl_search_limited($tbl,$start_row,$limit)
	{	   	
		if(isset($_SESSION['txt_search']) and $_SESSION['txt_search']!='Nhập từ khóa tìm kiếm')
        {                       		
			$this->db->like('title',$_SESSION['txt_search']);			
		}
		if(isset($_SESSION['search_cid'])and $_SESSION['search_cid']!=0)
        {             			
			$this->db->where('cid',$_SESSION['search_cid']);					
		}
		if(isset($_SESSION['search_user'])and $_SESSION['search_user']!=0)
        {             			
			$this->db->where('uid',$_SESSION['search_user']);					
		}
		if(isset($_SESSION['search_status'])and $_SESSION['search_status']!=-1)
        {             			
			$this->db->where('status',$_SESSION['search_status']);		
		}
		$this->db->order_by('id','DESC');
		if($limit!=''){
			$this->db->limit($limit,$start_row);			
		}		
		$query=$this->db->get($tbl);		
		return $query;
	}

    function gettbl_search_keywork($tbl,$start_row,$limit)
    {       
        if(isset($_SESSION['txt_search']) and $_SESSION['txt_search']!='Nhập từ khóa tìm kiếm')
        {                               
            $this->db->like('keywork',$_SESSION['txt_search']);           
        }
        if(isset($_SESSION['search_cid'])and $_SESSION['search_cid']!=0)
        {                       
            $this->db->where('cid',$_SESSION['search_cid']);                    
        }
        $this->db->order_by('id','DESC');
        if($limit!=''){
            $this->db->limit($limit,$start_row);            
        }       
        $query=$this->db->get($tbl);        
        return $query;
    }

	function doanhnghiep_limited($tbl,$start_row,$limit)
	{	   	
		if(isset($_SESSION['cp']))
        {                       		
			$this->db->like('name',$_SESSION['cp']);
		}		
		$this->db->order_by('id','DESC');
		if($limit!=''){
			$this->db->limit($limit,$start_row);			
		}		
		$query=$this->db->get($tbl);		
		return $query;
	}

	function del_tbl($tbl,$id){
		$sql="DELETE FROM $tbl WHERE id=".$id;                
		$result=$this->db->query($sql);		
		return $result;
	}
    function delrowtbl($tbl,$field,$id){
		$sql="DELETE FROM $tbl WHERE ".$field."=".$id;                
		$result=$this->db->query($sql);		
		return $result;
	}
	function  checkstatus($tbl,$action,$id)
	{
		$sql="UPDATE $tbl SET status='$action' WHERE id='$id'";
		$this->db->query($sql);
	}
    function checkstatusjob($tbl,$field,$action,$fieldid,$id)
	{
		$sql="UPDATE $tbl SET ".$field."='$action' WHERE ".$fieldid."='$id'";
        //var_dump($sql);die();
		$this->db->query($sql);
	}
    function del_urlgiasu($tbl,$fieldid,$id)
    {
        $sql="DELETE from $tbl WHERE ".$fieldid."='$id'";
        //var_dump($sql);die();
        $this->db->query($sql);
    }
    function gettblbyfield($tbl,$field,$id)
	{
		if($id!=''){
			$this->db->where($field,$id);
		}				
		$query = $this->db->get($tbl);
		return $query;
	}	
	//Check admin
	function getlogin($name,$pass)
    {
        $this->db->where('name',$name);
        $this->db->where('pass',md5($pass));
        $sql=$this->db->get('tbl_admin');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
    function checkalias($alias)
    {
        $this->db->where('alias',$alias);
        $sql=$this->db->get('url_phuhuynh');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
     function checkalias_phuhuynh($alias)
    {
        $this->db->where('alias',$alias);
        $sql=$this->db->get('url_timviec');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
    function checkfileds($name)
    {
        $this->db->where('name',$name);
        $sql=$this->db->get('tbl_admin');
        if($sql->num_rows()==1)
        {
            return TRUE;
        }
    }
	//Gan Flag
	function flags($id,$nguoidang,$flag){		
		$sql="UPDATE tblbaiviet SET nguoidang=$nguoidang,flag=$flag WHERE id='$id'";
		$this->db->query($sql);
	}	
    function Getallnewbypage($findkey,$category,$city,$hot,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 1000 day');
        $query="select u.*,t.* from users as u join userteacher as t on u.UserID=t.UserID where 1=1";
        if($findkey!=''){
         $query.=" and u.`Name` like '%".$findkey."%'";   
        }else{
            $query.=" and u.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }
        if(intval($category) >0){
            $query .=" and u.CityID = '".intval($category)."'";
        }
        
        if(intval($hot)>0){
            $query.=" and t.Vip=1";
        }
        if(intval($city)>0){
            $query.="  and u.UserID in(select UserID FROM usersubject where SubjectID='".intval($city)."')";
        }
        $query.=" ORDER BY u.UserID desc";
        
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {           		
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =		$items;						
            }   
		
        }
        return array('data'=>$catlink,'total'=>$total) ;	
    }
    function Getallby($table) {
        $query = "SELECT * from ".$table."";
        $total = $this->db->query($query)->num_rows();
        $sql1 = $this->db->query($query);
        $catlink = "";
        if($sql1->num_rows() >0)
        {                   
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =        $items;                     
            }   
        
        }
        return $kq = ['data' => $catlink, 'total' => $total];
    }
     function Getallfilterby($table, $search, $option) {
        if ($search == '') {
            $query = "SELECT * from ".$table." where  option = ".$option."";
        } else if ($option == '') {
            $query = "SELECT * from ".$table." where key_tag like '%".$search."%'";
        } else {
            $query = "SELECT * from ".$table." where key_tag like '%".$search."%' and option = ".$option."";
        }
        $total = $this->db->query($query)->num_rows();
        $sql1 = $this->db->query($query);
        $catlink = "";
        if($sql1->num_rows() >0)
        {                   
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =        $items;                     
            }   
        
        }
        return $kq = ['data' => $catlink, 'total' => $total];
    }
  
      function Getallbylimit($table, $start, $page) {
        $query = "SELECT * from ".$table." limit $start, $page";
        $total = $this->db->query($query)->num_rows();
        $sql1 = $this->db->query($query);
        $catlink = "";
        if($sql1->num_rows() >0)
        {                   
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =        $items;                     
            }   
        
        }
        return $kq = ['data' => $catlink, 'total' => $total];
    }
  
    function Getallcompanybypage($findkey,$city,$page,$perpage){
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 1000 day');
        $query="select * FROM teacherclass as t where 1=1";
        if($findkey!=''){
         $query.=" and t.ClassTitle like '%".str_replace(' ','%',$findkey)."%'";   
        }else{
            $query.=" and t.CreateDate >'".date("Y-m-d",$timenow1)."'";
        }
        if(intval($city)>0){
            $query.=" and t.City='".intval($city)."'";
        }
        
        $query.=" order by t.ClassID desc";
        $total=$this->db->query($query)->num_rows();
        $query.=" limit ".$page.",".$perpage;
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {           		
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =		$items;						
            }   
		
        }
        return array('data'=>$catlink,'total'=>$total) ;	
    }
    
    function GetAllCandibypage($findkey,$category,$city,$page,$perpage)
    {
        $timenow=date("Y-m-d",time());
        $timenow1 = strtotime($timenow.' - 360 day');
        $query="select u.use_id,
                u.use_email,
                u.use_first_name,
                u.use_create_time,
                u.use_phone,
                u.use_gioi_tinh,
                u.use_birth_day,
                u.use_city,
                u.use_address,
                u.use_hon_nhan,
                u.use_authentic,
                c.cv_hocvan,
                c.cv_exp,
                c.cv_muctieu,
                c.cv_cate_id,
                c.cv_city_id,
                c.cv_capbac_id,
                c.cv_money_id,
                c.cv_loaihinh_id,
                c.cv_kynang                 
                from `user` as u left join cv as c on u.use_id=c.cv_user_id
                where 1=1";
        if($findkey!='')
        {
            $query.=" And (u.use_email like '%".$findkey."%' or u.use_first_name like '%".$findkey."%')";
        }else{
            
             $query.=" and u.use_create_time >'".$timenow1."'";
        }
        if(intval($category)>0){
            $query.=" and c.cv_cate_id='".intval($category)."'";
        }
        if(intval($city)>0){
            $query.=" and (u.use_city='".intval($city)."' or c.cv_city_id='".intval($city)."')";
        }
            $query.= " GROUP BY u.use_id ORDER BY u.use_id DESC";
            $total=$this->db->query($query)->num_rows();
            $query.=" limit ".$page.",".$perpage;
            //var_dump($query);die();
        $sql1=	$this->db->query($query);
        $catlink="";
        if($sql1->num_rows() >0)
        {           		
            foreach($sql1->result() as $items)
            {                            
                $catlink[] =		$items;						
            }   
		
        }
        return array('data'=>$catlink,'total'=>$total) ;
    }
    function getlinkseobuysubcitytype($subid,$cityid,$type)
    {
        $query="select * from linkseo where cityid='".intval($cityid)."' and subjectid='".intval($subid)."' and `type`='".intval($type)."'";

        $news_cat = $this->db->query($query);
        $tg="";
        if($news_cat->num_rows()> 0)
            {
                $tg=$news_cat->row();
                }
                return $tg;
    }
    function getlistcity()
    {
        $query="select * from city";
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            {
                $tg[]=$items;
                }
                return $tg;
    }
    function getlistsubject()
    {
        $query="select * from subject";
        $news_cat = $this->db->query($query);
        $tg="";
        foreach($news_cat->result() as $items)
            {
                $tg[]=$items;
                }
                return $tg;
    }
    function getcitybyid($id)
    {
         $query="select * from city where cit_id='".intval($id)."'";

        $news_cat = $this->db->query($query);
        $tg="";
        if($news_cat->num_rows()> 0)
            {
                $tg=$news_cat->row();
                }
        return $tg;
    }
}
?>
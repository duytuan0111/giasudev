<?php 
class site_model extends Model
{	
	function site_model()
	{
		parent::Model();
    }

    function gettbl($tbl)
    {		
      $this->db->where('status',1);
      $this->db->order_by("id","desc");
      $query = $this->db->get($tbl);
      return $query;
  }
  function gettblwidthid($tbl,$id)
  {
      if($id!=''){
       $this->db->where('id',$id);
   }				
   $query = $this->db->get($tbl);
   if($query->num_rows() > 0)
   {
          $row = $query->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
      }

  }
  function gettblwidthidandkey($tbl,$key,$id)
  {
      if($id!=''){
       $this->db->where($key,$id);
   }				
   $query = $this->db->get($tbl);
   if($query->num_rows() > 0)
   {
          $row = $query->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
      }

  }	
  function ListDistrictByProvince($province)
  {
    if(intval($province)>0){
        $query="select * from city2 as c where c.cit_parent='".$province."'";
        $db_qr = $this->db->query($query);
        if($db_qr->num_rows() > 0)
        {
            $tg1="";
            foreach($db_qr->result() as $itemcat)
            {
                $tg1[]=$itemcat;
            }
        }
        return $tg1;
    }else{return null ;}

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

function gettbl_limited($tbl,$id,$start_row,$limit)
{
  $sql = "SELECT * FROM $tbl WHERE status=1";		
  if($id!='' AND $tbl=='baiviet'){
   $sql .= " AND cid=$id";
}	    		
$sql .= " ORDER BY id DESC";
if($limit!=''){
   $sql .= " LIMIT $start_row,$limit";
}		
$query=$this->db->query($sql);
return $query;
}	

function base_limited($tbl,$cate,$exp,$note,$start_row,$limit)
{
  $sql = "SELECT id,alias,image,view,love,download,price FROM $tbl WHERE status=1";		
  if($cate>0){
   $sql .= " AND FIND_IN_SET($cate,cate_id)";
}
if($exp>0){
   $sql .= " AND exp=$exp";
}	    		
if($note>0){
   $sql .= " AND nhucau=$note";
}
$sql .= " ORDER BY id DESC";
if($limit!=''){
   $sql .= " LIMIT $start_row,$limit";
}		
$query=$this->db->query($sql);
return $query;
}	
function registerphuhuynh($hoten, $email, $sdt, $pass, $type)
{
    $sql = "SELECT Email, UserType FROM users WHERE Email = '$email' AND UserType = 0";
    $query = $this->db->query($sql);
    $result = $query->num_rows();
    $sql1 = "SELECT Phone, UserType FROM users WHERE Phone = '$sdt' AND UserType = 0";
    $query1 = $this->db->query($sql1);
    $result1 = $query1->num_rows();
    if($result>0 )
    {
        $arr = ['kq' => false, 'msg' => 'Tài khoản email đã được đăng ký'];
        return $arr;
    }
    else if($result1>0){
        $arr = ['kq' => false, 'msg' => 'Số điện thoại đã được đăng ký'];
        return $arr;
    }
    else
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data =  array
        (
            'Name' => $hoten,
            'Email' => $email,
            'Phone' => $sdt,
            'Password' => md5($pass),
            'UserType' => $type,
            'Active'  => 0,
            'CreateDate' => date("Y-m-d H:i:s", time())
        );
        $this->db->insert('users', $data);
            // SEND MAIL 
        $insertid=$this->db->insert_id();
        $query="INSERT INTO user_company_multi(usc_id)VALUES(".$insertid.")";
        $insert=$this->db->query($query);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
        $code="com_".rand(1000000,9999999);    
        $body=str_replace('<%name%>',$hoten,$body);
        $body=str_replace('<%email%>',$email,$body);    
        $body=str_replace('<%code%>',$code,$body); 
        $body=str_replace('<%type%>',$type,$body); 

        $Description="Đăng ký tài khoản phụ huynh";
        $data="";
        $CreateDate=date("Y-m-d H:i:s",time());
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
        VALUES('".$insertid."','".$code."','0','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);

        $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
        $header='Từ: GiaSu365';
        // require_once('class.phpmailer.php');
        //             require_once('class.pop3.php');
        //             define('GUSER','timviec365-noreply@timviec365.vn');
        //             define('GPWD','Bbz123');
        //             global $message;
        // $this->smtpmailer($email,'timviec365-noreply@timviec365.vn',$header,$subject,$body);
        $body = base64_encode($body);
        $this->CreateSendMail('timviec365-noreply@timviec365.com.vn',$email, "", "", $subject, $body);
        $arr = ['kq' => true , 'msg'=> 'Đăng ký thành công, bạn vui lòng kiểm tra email để xác thực tài khoản.'];
        return $arr;
    }
}
function resendmail($id,$name,$email,$type){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
    $code="new_".rand(1000000,9999999);    
    $body=str_replace('<%name%>',$name,$body);
    $body=str_replace('<%email%>',$email,$body);    
    $body=str_replace('<%code%>',$code,$body);
    $body=str_replace('<%type%>',$type,$body); 
    $CreateDate=date("Y-m-d H:i:s",time());
    $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
    $header='Từ: GiaSu365';
    $body = base64_encode($body);
    $this->CreateSendMail('timviec365-noreply@timviec365.com.vn',$email, "", "", $subject, $body);
    $arr = ['kq' => true , 'msg'=> 'Yêu cầu gửi lại email xác nhận tài khoản thành công. Vui lòng kiểm tra hộp thư đến hoặc hộp thư spam.'];
    return $arr;

}
function resendmail2($email){
    
    $sql=" SELECT * from  users  where Email = '".$email."' and Active=0";
    $select=$this->db->query($sql);
    if ($select->UserType==1) {
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
    $code="new_".rand(1000000,9999999);    
    $body=str_replace('<%name%>',$select->name,$body);
    $body=str_replace('<%email%>',$email,$body);    
    $body=str_replace('<%code%>',$code,$body); 
    $body=str_replace('<%type%>',$select->UserType,$body);   
    $CreateDate=date("Y-m-d H:i:s",time());
    $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
    $header='Từ: GiaSu365';
    $body = base64_encode($body);
    $this->CreateSendMail('timviec365-noreply@timviec365.com.vn',$email, "", "", $subject, $body);
    $arr = ['kq' => true , 'msg'=> 'Yêu cầu gửi lại email xác nhận tài khoản thành công. Vui lòng kiểm tra hộp thư đến hoặc hộp thư spam.'];
    return $arr;
    }
    else{
        $arr = ['kq' => false , 'msg'=> 'Đăng nhập thất bại'];
        return $arr;
    }

}
function resendmail3($email){
    // $username=$email;
    $sql=" SELECT * from users where Email ='".$email."' and Active=0";
    $select=$this->db->query($sql);
    // echo $select;
    // die();
    if($select->UserType==0){
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
    $code="new_".rand(1000000,9999999);    
    $body=str_replace('<%name%>',$select->name,$body);
    $body=str_replace('<%email%>',$email,$body);    
    $body=str_replace('<%code%>',$code,$body); 
    $body=str_replace('<%type%>',$select->UserType,$body);   
    $CreateDate=date("Y-m-d H:i:s",time());
    $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
    $header='Từ: GiaSu365';
    $body = base64_encode($body);
    $this->CreateSendMail('timviec365-noreply@timviec365.com.vn',$email, "", "", $subject, $body);
    $arr = ['kq' => true , 'msg'=> 'Yêu cầu gửi lại email xác nhận tài khoản thành công. Vui lòng kiểm tra hộp thư đến hoặc hộp thư spam.'];
        return $arr;
    }
    else{
        $arr = ['kq' => false , 'msg'=> 'Đăng nhập thất bại'];
        return $arr;
    }

}
function selectCtrl($catid,$name,$class)
{
    echo "<select name='".$name."' class='".$class."'>\n";		
    echo "<option value='0'> -- Chọn chuyên mục -- </option>";		
    $this->show_category($catid);
    echo "</select>";
}
function show_category($catid,$parent_id="0",$insert_text="-")
{
    $this->db->where('uid',$parent_id);
    $this->db->order_by('id','asc');
    $sql=$this->db->get('tbl_chuyenmuc');
    foreach($sql->result() as $itemcat)
    {		        	
       if($itemcat->id==$catid){
        echo '<option selected="selected" value="'.$itemcat->id.'">'.$insert_text.$itemcat->name."</option>";				
    }
    else{
        echo "<option value='".$itemcat->id."'>".$insert_text.$itemcat->name."</option>";				
    }
    $this->show_category($catid,$itemcat->id,$insert_text."---");    
}
return true;
}
function selectprovince($name,$class,$title)
{
        //'select * FROM city where cit_id <> 1 and cit_id <> 45 ORDER BY `cit_name`';
        //$this->db->where('uid',$parent_id);
        //$this->db->order_by('id','asc');
        //$sql=$this->db->get('tbl_chuyenmuc');
        //echo "<select name='".$name."' class='".$class."' title='".$title."'>\n";	
    $tg="";
    $sql="select * FROM city where cit_id = 1 or cit_id = 45 ORDER BY `cit_name`";
    $query=$this->db->query($sql);
    foreach($query->result() as $itemcat)
    {
        $tg[]=$itemcat;
    }
    $sql1="select * FROM city where cit_id <> 1 and cit_id <> 45 ORDER BY `cit_name`";
    $query1=$this->db->query($sql1);
    foreach($query1->result() as $itemcat1)
    {
        $tg[]=$itemcat1;
    }
        //foreach($query->result() as $itemcat)
//        {
//            echo "<option value='".$itemcat->cit_id."'>".$itemcat->cit_name."</option>";
//        }
//        echo "</select>";
    return $tg;
}
function SelectProvinceByID($id)
{
    $sql="select * FROM city where cit_id='".trim($id)."' ORDER BY `cit_name`";
    $query=$this->db->query($sql);
    $kq="";
    if($id > 0){
        if($query->num_rows()> 0)
        {
            $row = $query->row();
            $kq=$row->cit_name;
        }}
        else{$kq='Toàn quốc';}
        return $kq;
    }
    function SelectProvinceByID1($id)
    {
        $sql="select * FROM city where cit_id='".intval($id)."' ORDER BY `cit_name`";
        $query=$this->db->query($sql);
        $kq="";
        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }
        return $kq;
    }
    function Selectkey($key){
        $sql = "SELECT * from users where Name like '%$key%'";
        $query=$this->db->query($sql);
        
        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }

        return $kq;
    }
    function SelectDistrictID($id)
    {
        $sql="select * FROM city2 where cit_id='".intval($id)."' ORDER BY `cit_name`";
        $query=$this->db->query($sql);
        $kq="";
        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }
        return $kq;
    }
  
    function selectsubjectbyid($subject)
    {
        
        $sql="SELECT * FROM subject where ID= $subject";
        
        $query=$this->db->query($sql);
        
        $kq="";
        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }
        
        return $kq;
    }
    function SelectClassByid($id)
    {
        $sql="SELECT * FROM class WHERE id='".intval($id)."' order by id asc";
        $query=$this->db->query($sql);
        $kq="";

        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }
        return $kq;
    }

    function SelectClassSubjectbyid($id_subject, $id_class)
    {
        $sql="SELECT * FROM class_subject WHERE IdSubject='".intval($id_subject)."' AND IdClass = '".intval($id_class)."'";
        $query=$this->db->query($sql);
        $kq="";

        if($query->num_rows()> 0)
        {
            $kq = $query->row();
        }
        return $kq;
    }
    function SelectMonHoc($id)
    {
        $row ='';
        if($id == 0)
        {

                        $sql = "SELECT classname,id FROM class";
            $query= $this->db->query($sql);
            foreach ($query->result() as $item) {
                $row[] = $item;
            }
        }
        else
        {
            
            $sql = "SELECT classname,  class.id FROM class JOIN class_subject ON class.id = class_subject.IdClass JOIN subject ON subject.ID = class_subject.IdSubject WHERE subject.ID= '".$id."' order by class.id asc";
            $query= $this->db->query($sql);
            foreach ($query->result() as $item) {
                $row[] = $item;
            }
        }
        return $row;    
    }
    function SelectLop($id)
    {   
        $row ='';
        if($id == 0)
        {
            $sql = "SELECT SubjectName, ID FROM subject  order by class_subject.Idclass asc";
            $query= $this->db->query($sql);
            foreach ($query->result() as $item) {
                $row[] = $item;
            }
        }
        else
        {
            $sql = "SELECT SubjectName,  subject.ID 
            FROM subject 
            JOIN class_subject ON subject.ID = class_subject.IdSubject 
            JOIN class ON class.id = class_subject.IdClass 
            WHERE class.id= '".$id."'
            order by class_subject.Idclass asc
            ";

            $query= $this->db->query($sql);
            foreach ($query->result() as $item) {
                $row[] = $item;
            }
        }
        return $row;
    }
    function SelectDiaDiem($id)
    {   
        $row ='';
        if($id != 0 || $id != '')
        {
           $sql = "SELECT * FROM city2 WHERE cit_parent= '".$id."'";
           $query= $this->db->query($sql);
           foreach ($query->result() as $item) {
            $row[] = $item;
        }
    }
    else
    {
        $sql = "SELECT * FROM city2 WHERE cit_parent <> 0";
        $query= $this->db->query($sql);
        foreach ($query->result() as $item) {
            $row[] = $item;
        }
    }

    return $row;
}
function SelectQuanHuyen($id)
{   
    $row ='';
    if($id[0] != 0 || $id[0] !='')
    {
        $sql = "SELECT cit_parent FROM city2 WHERE cit_id= '".$id."'";
        $query= $this->db->query($sql)->row();
        $sql1 = "SELECT * FROM city2 WHERE cit_id= '".$query->cit_parent."'";
        $query1= $this->db->query($sql1);
        foreach ($query1->result() as $item) {
            $row[] = $item;
        }
    }
    else
    {

        $sql = "SELECT * FROM city2 WHERE cit_parent= 0";
        $query= $this->db->query($sql);
        foreach ($query->result() as $item) {
            $row[] = $item;
        }
    }
    return $row;
}

function search_limited($tbl,$txt,$start_row,$limit)
{						
  $sql="SELECT * FROM $tbl WHERE status=1";
  if($txt!=""){
   $txt = str_replace('+',' ', $txt);
   $sql .=" AND name LIKE '%$txt%'";	
}			
$sql .=" ORDER BY ngaybd DESC";		
if($limit!=''){
   $sql .= " LIMIT $start_row,$limit";
}
$query=$this->db->query($sql);		
return $query;
}		
function getlogin($name,$pass)
{
    $query="select * FROM `user` where use_email ='".strtolower($name)."' and use_pass ='".md5($pass)."' AND `use_authentic`=1";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();
    }
    return $row;
}
function GetLoginTeacher($name,$pass)
{
    $query="select * from users where Email ='".$name."' and `Password`='".$pass ."' ";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();
    }
    return $row;
}
function GetLoginusers($name,$pass)
{
    $query="select * from users where (Name ='".$name."' or Email ='".$name."') and `Password`='".$pass ."' ";

    $sql=$this->db->query($query);
        $row="";
        if($sql->num_rows()> 0)
        {
            $row=$sql->row();
        }
        return $row;
}
function GetUserForgot($name)
{
    $query="select * from users where (Name ='".$name."' or Email ='".$name."')";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();
    }
    return $row;
}
function GetLopby($id)
{
    $query="select * from class where (id ='".$id."')";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();
    }
    return $row;
}
function getcandidatebyID($id)
{
    $query="select * FROM `user` as u left JOIN cv as c on u.use_id=c.cv_user_id where u.use_id ='".intval($id)."' AND u.`use_authentic`=1";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();


    }
    return $row;
}
function GetListCandidate($where,$limit,$order)
{
    $query="select * FROM `user` as u left JOIN cv as c on u.use_id=c.cv_user_id where ";
    if($where != ""){
        $query.=$where;
    }
    if($order != "")
    {
        $query.=$order;
    }
    if(intval($limit)>0){
        $query.=" LIMIT 0,".$limit;
    }
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return $row;
}

function getlogincompany($name,$pass)
{
    $query="select usc_id as use_id,usc_email as use_email,usc_name as use_first_name from user_company where usc_email ='".strtolower($name)."' and usc_pass ='".md5($pass)."' AND `usc_authentic`=1";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();


    }
    return $row;
}
function GetTopNew($length)
{
 $timenow=date("Y-m-d",time());
 $timenow1 = strtotime($timenow);
 $query="select n.new_id,
 n.new_title,
 n.new_cat_id,
 n.new_city,
 n.new_qh_id,
 n.new_money,
 n.new_cap_bac,
 n.new_exp,
 n.new_bang_cap,
 n.new_gioi_tinh,
 n.new_so_luong,
 n.new_hinh_thuc,
 n.new_user_id,
 n.new_do_tuoi,
 n.new_type,
 n.new_over,
 n.new_view_count,
 n.new_han_nop,
 n.new_post,
 n.new_renew,
 n.new_hot,
 n.new_do,
 n.new_gap,
 n.new_cao,
 n.new_thuc,
 n.new_order,
 n.source,u.usc_company from new as n left join user_company as u on n.new_user_id=u.usc_id ";
 $query.="where n.new_han_nop > '".$timenow1."' and( n.new_hot = 0 or n.new_do = 0 or n.new_gap = 0) 
 order by n.new_hot desc,
 n.new_do desc,
 n.new_gap desc,
 n.new_cao desc, n.new_id desc limit 0,".$length;

          //var_dump($query);          
 $sql=$this->db->query($query);
 $row="";
 $arrth="";

 if($sql->num_rows()> 0)
 {
    foreach($sql->result() as $item){
        $row[]=$item;

    }
}
return $row;
}
function GetTopCompany($lenght)
{
    $query="SELECT u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,COUNT(n.new_id) as sobaiviet,p.point_usc,u.usc_address  
    from user_company as u
    JOIN tbl_point_company as p on u.usc_id=p.usc_id
    join new as n on u.usc_id = n.new_user_id
    where u.usc_id IN (SELECT new_user_id FROM new WHERE (new_hot = 0 OR new_do = 0 OR new_gap = 0 OR new_cao = 0))
    GROUP BY u.usc_id 
    order by n.new_hot desc,n.new_do desc,n.new_gap desc,n.new_cao desc,u.usc_id desc
    limit ".$lenght;

    $row="";


    $sql=$this->db->query($query);
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }

    }
    return $row;
}
function detailjobbyid($id)
{
    $query="select n.new_id,
    n.new_title,
    n.new_cat_id,
    n.new_city,
    n.new_qh_id,
    n.new_money,
    n.new_cap_bac,
    n.new_exp,
    n.new_bang_cap,
    n.new_gioi_tinh,
    n.new_so_luong,
    n.new_hinh_thuc,
    n.new_user_id,
    n.new_do_tuoi,
    n.new_type,
    n.new_over,
    n.new_view_count,
    n.new_han_nop,
    n.new_post,
    n.new_renew,
    n.new_hot,
    n.new_do,
    n.new_gap,
    n.new_cao,
    n.new_thuc,
    n.new_order,
    n.source,
    u.usc_create_time,
    u.usc_company,
    u.usc_logo,
    u.usc_name_add,
    u.usc_address,
    u.usc_name_phone,
    u.usc_phone,
    u.usc_name_email,
    u.usc_size,
    nm.new_mota,
    nm.new_yeucau,
    nm.new_quyenloi,
    nm.new_ho_so,
    nm.meta_title,
    nm.meta_desc,
    nm.meta_keywork

    from new as n left join user_company as u on n.new_user_id=u.usc_id left join new_multi as nm on n.new_id=nm.new_id";
    $query .=" Where n.new_id='".$id."'";
        //var_dump($query);
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();
    }
    return $row;
}
function GetDetailCompanyByID($id)
{
    $query="SELECT u.usc_id,u.usc_email,u.usc_website,u.usc_phone,u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,p.point_usc,u.usc_address ,c.usc_company_info
    from user_company as u
    left JOIN tbl_point_company as p on u.usc_id=p.usc_id
    left join user_company_multi as c on u.usc_id=c.usc_id
    where u.usc_id='".intval($id)."'";

    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        $row=$sql->row();


    }
    return $row;
}
function GetMoreJobByCompany($id){
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    $query="select n.new_id,
    n.new_title,
    n.new_cat_id,
    n.new_city,
    n.new_qh_id,
    n.new_money,
    n.new_cap_bac,
    n.new_exp,
    n.new_bang_cap,
    n.new_gioi_tinh,
    n.new_so_luong,
    n.new_hinh_thuc,
    n.new_user_id,
    n.new_do_tuoi,
    n.new_type,
    n.new_over,
    n.new_view_count,
    n.new_han_nop,
    n.new_post,
    n.new_renew,
    n.new_hot,
    n.new_do,
    n.new_gap,
    n.new_cao,
    n.new_thuc,
    n.new_order,
    n.source,u.usc_company 
    from new as n left join user_company as u on n.new_user_id=u.usc_id 
    where n.new_han_nop > '".$timenow1."'";                    
    $query .=" and n.new_user_id ='".$id."'";
    $query.=" order by n.new_id desc limit 0,6";

    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }



    }
    return $row;
}
function GetCountJobByProvince($type,$cat,$pro,$keywork)
{
        //type =1:viec lam them, 2: viec lam nganh nghe tại, 3: tìm việc làm
        //$query="select t.cit_id,t.cit_name,SUM(t.sobanghi) as tongbanghi from ((select c.cit_id,c.cit_name, COUNT(n.new_money)as sobanghi
//                from new as n ,city as c
//                where n.new_han_nop > 0  and LENGTH(n.new_city)>= 3 and FIND_IN_SET(c.cit_id , n.new_city)
//                GROUP BY c.cit_id)
//union ALL
//(
//select c.cit_id,c.cit_name, COUNT(n.new_money)as sobanghi
//                from new as n ,city as c
//                where n.new_han_nop > 0  and LENGTH(n.new_city)< 3 and n.new_city=c.cit_id
//                GROUP BY c.cit_id
//)) as t
//GROUP BY t.cit_id";

    $query="select c.cit_id,c.cit_name, COUNT(n.new_money)as tongbanghi
    from new as n ,city as c
    where n.new_han_nop > 0  and FIND_IN_SET(c.cit_id , n.new_city)
    GROUP BY c.cit_id";

    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['cit_id']=$item->cit_id;
            $item1['cit_name']=$item->cit_name;
            $item1['tongbanghi']=$item->tongbanghi;
            if($type < 3){
                $urltt="";
                if(intval($item->cit_id)>=1){
                    $urltt="-tai-".vn_str_filter(Getcitybyindex($item->cit_id));
                }
                $urlnn="";
                if(intval($cat)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($cat));
                }
                $link=base_url()."viec-lam".$urlnn.$urltt."-c".intval($cat)."p".$item->cit_id.".html";
            }else{
                $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".intval($item->cit_id)."&nn=".intval($cat);
            }
            $item1['url']=$link;
            $row[]=$item1;
        }



    }
    return $row;
}
function GetCounJobByCategory($type,$cat,$pro,$keywork)
{
        //type =1:viec lam them, 2: viec lam nganh nghe tại, 3: tìm việc làm
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
        //var_dump($type,$cat,$pro,$keywork);
        //$query="select t.cat_id,t.cat_name,SUM(t.sobanghi) as tongbanghi from ((select c.cat_id,c.cat_name, COUNT(n.new_money)as sobanghi
//                from new as n ,category as c
//                where n.new_han_nop > '".$timenow1."'  and LENGTH(n.new_cat_id)>= 3 and FIND_IN_SET(c.cat_id , n.new_cat_id)
//                GROUP BY c.cat_id)
//        union ALL
//        (
//        select c.cat_id,c.cat_name, COUNT(n.new_money)as sobanghi
//                        from new as n ,category as c
//                        where n.new_han_nop > '".$timenow1."'  and LENGTH(n.new_cat_id)< 3 and n.new_cat_id=c.cat_id
//                        GROUP BY c.cat_id
//        )) as t
//        GROUP BY t.cat_id";
    $query="select c.cat_id,c.cat_name, COUNT(n.new_money)as tongbanghi
    from new as n ,category as c
    where n.new_han_nop > '".$timenow1."'  and FIND_IN_SET(c.cat_id , n.new_cat_id)
    GROUP BY c.cat_id";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['cat_id']=$item->cat_id;
            $item1['cat_name']=$item->cat_name;
            $item1['tongbanghi']=$item->tongbanghi;
            if($type < 3){
                $urltt="";
                if(intval($pro)>=1){
                    $urltt="-tai-".vn_str_filter(Getcitybyindex($pro));
                }
                $urlnn="";
                if(intval($item->cat_id)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($item->cat_id));
                }
                $link=base_url()."viec-lam".$urlnn.$urltt."-c".intval($item->cat_id)."p".intval($pro).".html";
            }else{
                $link=base_url()."tim-viec-lam&keywork=".$keywork."&dd=".intval($pro)."&nn=".intval($item->cat_id);
            }
            $item1['url']=$link;
            $row[]=$item1;
        }

    }
    return $row;
}
function GetCountCandiByCity($keywork,$cat,$type)
{
    $query="select u.use_city,IFNULL(c.cit_name, 'Chưa cập nhật') as tinhthanh ,COUNT(u.use_city) as soungvien from `user` as u left join city as c on u.use_city=c.cit_id
    GROUP BY u.use_city";
    $sql=$this->db->query($query);
    $row="";
        //var_dump($keywork,$cat,$type); 
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['use_city']=$item->use_city;
            $item1['tinhthanh']=$item->tinhthanh;
            $item1['soungvien']=$item->soungvien;
            if($type <=2){
                $urltt="";
                if(intval($item->use_city)>=1){
                    $urltt="-tai-".vn_str_filter($item->tinhthanh);
                }else{
                    $urltt="-chua-cap-nhat";
                }
                $urlnn="";
                if(intval($cat)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($cat));

                }
                $link=base_url()."ung-vien".$urlnn.$urltt."-u".intval($cat)."s".$item->use_city.".html";
            }else{
             $link=base_url()."tim-ung-vien&keywork=".$keywork."&dd=".$item->use_city."&nn=".intval($cat);
         }
         $item1['url']=$link;
         $row[]=$item1;
     }

 }
 return $row;
}
function GetCountCandiByCategory($keywork,$cate,$type)
{
    $query="select c1.cv_cate_id,IFNULL(c.cat_name, 'Chưa cập nhật') as nganhnghe ,COUNT(c1.cv_cate_id) as soungvien 
    from `user` as u join cv as c1 on c1.cv_user_id=u.use_id
    left join category as c on c.cat_id=c1.cv_cate_id
    GROUP BY c1.cv_cate_id";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['cv_cate_id']=$item->cv_cate_id;
            $item1['nganhnghe']=$item->nganhnghe;
            $item1['soungvien']=$item->soungvien;
            if($type <=2){
                $urltt="";
                if(intval($cate)>=1){
                    $urltt="-tai-".vn_str_filter(Getcitybyindex($cate));
                }else{
                    $urltt="-chua-cap-nhat";
                }
                $urlnn="";
                if(intval($item->cv_cate_id)>=1){
                    $urlnn="-".vn_str_filter(GetCategory($item->cv_cate_id));
                }
                $link=base_url()."ung-vien".$urlnn.$urltt."-u".intval($item->cv_cate_id)."s".intval($cate).".html";
            }else{
             $link=base_url()."tim-ung-vien&keywork=".$keywork."&dd=".intval($cate)."&nn=".intval($item->cv_cate_id);
         }
         $item1['url']=$link;
         $row[]=$item1;
     }

 }
 return $row;
}
function GetSalaryByCandi()
{
    $query="select c.cv_money_id,COUNT(c.cv_user_id) as sobanghi, 
    CASE c.cv_money_id
    WHEN 0 THEN N'Thỏa thuận' 
    WHEN 1 THEN N'1 - 3 triệu' 
    WHEN 2 THEN N'3 - 5 triệu' 
    WHEN 3 THEN N'5 - 7 triệu' 
    WHEN 4 THEN N'7 - 10 triệu' 
    WHEN 5 THEN N'10 - 15 triệu'
    WHEN 6 THEN N'15 - 20 triệu'
    WHEN 7 THEN N'20 - 30 triệu'
    WHEN 8 THEN N'Trên 30 triệu' 
    END As NameMoney
    from `user` as u join cv as c on c.cv_user_id=u.use_id
    group by c.cv_money_id";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return $row;
}
function GetExpbyCandi()
{
    $query="select c.cv_exp,COUNT(c.cv_user_id) as sobanghi, 
    CASE c.cv_exp
    WHEN 0 THEN N'Chưa có kinh nghiệm' 
    WHEN 1 THEN N'0 - 1 năm kinh nghiệm' 
    WHEN 2 THEN N'1 - 2 năm kinh nghiệm' 
    WHEN 3 THEN N'2 - 5 năm kinh nghiệm' 
    WHEN 4 THEN N'5 - 10 năm kinh nghiệm' 
    WHEN 5 THEN N'Hơn 10 năm kinh nghiệm'
    END As NameExp
    from `user` as u join cv as c on c.cv_user_id=u.use_id
    where c.cv_exp < 6
    group by c.cv_exp";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return $row;
}
function GetFilterABCBycandi($city,$cat,$type)
{
    $arrabc=GetABC();
    $row="";
    for($i=0;$i<count($arrabc);$i++){
        if($type==1){
            $link="tim-ung-vien&keywork=".$arrabc[$i]."&dd=".intval($city)."&nn=".intval($cat)."";
            $item1['url']=base_url().$link;
            $item1['name']=$arrabc[$i];
        }else{

        }
        $row[]=$item1;
    }
    return $row;

}
function FindCandiBySearch($keywork,$nganhnghe,$diadiem,$salary,$exp,$page,$perpage){
    $query="select	u.use_id,u.use_email,u.use_first_name,u.use_type,u.use_create_time,u.use_update_time,u.use_logo,u.use_phone,u.use_gioi_tinh,u.use_birth_day,
    u.use_city,u.use_address,u.use_hon_nhan,u.use_view,c.cv_address,c.cv_capbac_id,c.cv_cate_id,c.cv_city_id,c.cv_exp,c.cv_hocvan,c.cv_kynang,c.cv_money_id,c.cv_muctieu,c.cv_title,c.cv_kynang
    from `user` as u join cv as c on u.use_id=c.cv_user_id
    where u.use_authentic=1";
    if($salary !=''){
        $query.=" and c.cv_money_id='".intval($salary)."'";
    }
    if($diadiem !=''){
        $query.=" and (c.cv_city_id='".intval($diadiem)."' or u.use_city='".intval($diadiem)."')";
    }
    if($exp !=''){
        $query.=" and c.cv_exp='".intval($exp)."'";
    }
    if($nganhnghe != ''){
        $query.=" AND c.cv_cate_id='".intval($nganhnghe)."'";
    }
    if($keywork !='')
    {
        $keywork=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($keywork));
        $query.=" and (c.cv_title like '%".$keywork."%'  or u.use_first_name like '%".$keywork."%' or c.cv_kynang like '%".$keywork."%')";  
    }
    $query.=" order by u.use_id desc";

    $total=$this->db->query($query)->num_rows();
    $query.=" limit ".$page.",".$perpage;;
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return array('data'=>$row,'total'=>$total);

}
function GetCityByCompany($nganhnghe,$findkey,$type)
{
    $query="SELECT cit_id,cit_name from city ORDER BY cit_id asc";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['cit_id']=$item->cit_id;
            $item1['cit_name']=$item->cit_name;
                        //$item1['tongbanghi']=$item->tongbanghi;
            if($findkey !=''){
                $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=".$item->cit_id."&n=".$nganhnghe."&type=1";
            }else{
                $link=base_url()."nha-tuyen-dung&keywork=&c=".$item->cit_id."&n=".$nganhnghe."&type=1";
            }
            $item1['url']=$link;
            $row[]=$item1;
        }



    }
    return $row;
}
function GetCatByCompany($city,$findkey,$type)
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow.'- 30 day');
    $query="SELECT c.cat_id,c.cat_name,COUNT(n.new_user_id) as socongty from new as n,category as c WHERE n.new_han_nop > '".$timenow1."' and FIND_IN_SET(c.cat_id,n.new_cat_id)
    GROUP BY c.cat_id";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $item1['cat_id']=$item->cat_id;
            $item1['cat_name']=$item->cat_name;
            $item1['socongty']=$item->socongty;
            if($findkey !=''){
                $link=base_url()."nha-tuyen-dung&keywork=".$findkey."&c=".$city."&n=".$item->cat_id."&type=1";
            }else{
               $link=base_url()."nha-tuyen-dung&keywork=&c=".$city."&n=".$item->cat_id."&type=1"; 
           }
           $item1['url']=$link;
           $row[]=$item1;
       }



   }
   return $row;
}
function GetFilterABCByType($city,$cat,$type)
{
    $arrabc=GetABC();
    $row="";
    for($i=0;$i<count($arrabc);$i++){
        if($type==1){
            $link="nha-tuyen-dung&keywork=".$arrabc[$i]."&c=".$city."&n=".$cat."&type=2";
            $item1['url']=$link;
            $item1['name']=$arrabc[$i];
        }else{

        }
        $row[]=$item1;
    }
    return $row;

}

function check_mail($type,$data){
    $query = 'SELECT `UserID` FROM `users` WHERE `Email` = "'.$data.'" AND `UserType` = "'.$type.'"';
    $check = $this->db->query($query)->num_rows();
    if ($check > 0) {
        return 1;
    }else{
        return 0;
    }
}

function check_sdt($type,$data){
    $query = 'SELECT `UserID` FROM `users` WHERE `Phone` = "'.$data.'" AND `UserType` = "'.$type.'"';
    $check = $this->db->query($query)->num_rows();
    if ($check > 0) {
        return 1;
    }else{
        return 0;
    }
}
function check_seo_city($id) {
    $this->db->where('City_ID', $id);
    return $this->db->get('seobycity')->num_rows();
}
function check_seo_subject($id) {
    $this->db->where('subject_id', $id);
    return $this->db->get('seobysubject')->num_rows();
}
function check_seo_subject_city($sub_id, $cit_id) {
    $this->db->where('Subject_ID', $sub_id);
    $this->db->where('City_ID', $cit_id);
    return $this->db->get('seobycitysubject')->num_rows();
}
function check_viec_city($id) {
    $this->db->where('City_ID', $id);
    return $this->db->get('viecbycity')->num_rows();
}
function check_viec_subject($id) {
    $this->db->where('subject_id', $id);
    return $this->db->get('viecbysubject')->num_rows();
}
function Get_seo_city_subject($sub_id, $cit_id) {
    $sql = 'SELECT * from  seobycitysubject where Subject_ID = "'.$sub_id.'" and City_ID = "'.$cit_id.'"';
    return $query = $this->db->query($sql)->result();
}
function Get_viec_city($id) {
    $sql = 'SELECT * from  viecbycity where City_ID = "'.$id.'"';
    return $query = $this->db->query($sql)->result();
}
function Get_viec_subject($id) {
    $sql = 'SELECT * from  viecbysubject where subject_id = "'.$id.'"';
    return $query = $this->db->query($sql)->result();
}
function Get_seo_city($id) {
    $sql = 'SELECT * from  seobycity where City_ID = "'.$id.'"';
    return $query = $this->db->query($sql)->result();
}
function Get_seo_subject($id) {
    $sql = 'SELECT * from  seobysubject where subject_id = "'.$id.'"';
    return $query = $this->db->query($sql)->result();
}
function GetCountJobbyEdu()
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    $query="select e.EduID,e.TitleEdu,COUNT(n.new_id) as sobanghi,ValueOption from new as n, edulevel as e
    WHERE n.new_han_nop > '".$timenow1."' and n.new_bang_cap in (e.ValueOption)
    GROUP BY e.EduID";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){

            $row[]=$item;
        }



    }
    return $row;
}
function GetCountJobByLevel()
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    $query="select e.LevelID,e.Title,COUNT(n.new_id) as sobanghi from new as n, `level` as e
    WHERE n.new_han_nop >'".$timenow1."' and n.new_cap_bac =e.LevelID
    GROUP BY e.LevelID";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){

            $row[]=$item;
        }



    }
    return $row;
}
function GetCountJobByEXP()
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    $query="select e.ExperienceID,e.TitleEX,COUNT(n.new_id) as sobanghi,e.ValueOption from new as n, experience as e
    WHERE n.new_han_nop > '".$timenow1."' and n.new_exp =e.ValueOption
    GROUP BY e.ExperienceID";
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){

            $row[]=$item;
        }



    }
    return $row;      
}
function GetLisCompanyByFillter($findkey,$category,$city,$type,$page,$perpage)
{
    $query="SELECT u.usc_id,u.usc_create_time,u.usc_company,u.usc_logo,u.usc_size,COUNT(n.new_id) as sobaiviet,p.point_usc,u.usc_address  from user_company as u
    JOIN tbl_point_company as p on u.usc_id=p.usc_id
    join new as n on u.usc_id = n.new_user_id where 1=1";
    if(intval($category)>0){
        $query.=" and FIND_IN_SET('".$category."',n.new_cat_id)";
    }
    if(intval($city)>0){
        $query.=" and FIND_IN_SET('".$city."',n.new_city)";
    }
    if($type==2){
        if($findkey != ''){
            if($findkey=='0-9'){
                $query.=" and(u.usc_company BETWEEN '0' AND '9')";
            }else{
                $query.=" and u.usc_company like '".$findkey."%'";
            }
        }
    }else{
        if($findkey !=''){
            $findkey=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($findkey));
            $query.=" and u.usc_company like '%".str_replace(' ','%',$findkey)."%'";    
        }            

    }
    $query.=" GROUP BY u.usc_id";
    $total=$this->db->query($query)->num_rows();
        //var_dump($total);die();
    $query.=" order by sobaiviet desc limit ".$page.",".$perpage;;
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return array('data'=>$row,'total'=>$total);
}
function GetListJobforfilter($keywork,$cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idcat,$idpro,$page,$perpage)
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    if(!empty($cookjobupdate)){
        if($cookjobupdate=="week"){
            $timenow1 = strtotime($timenow.' - 7 day');
        }
        if($cookjobupdate=="twoweek"){
            $timenow1 = strtotime($timenow.' - 14 day');
        }
        if($cookjobupdate=="month"){
            $timenow1 = strtotime($timenow.' - 30 day');
        }
        if($cookjobupdate=="twomonth"){
            $timenow1 = strtotime($timenow.' - 60 day');
        }
        if($cookjobupdate=="all"){
                //$timenow1 = strtotime($timenow.' - 360 day');
        }
    }
    $query="select n.new_id,
    n.new_title,
    n.new_cat_id,
    n.new_city,
    n.new_qh_id,
    n.new_money,
    n.new_cap_bac,
    n.new_exp,
    n.new_bang_cap,
    n.new_gioi_tinh,
    n.new_so_luong,
    n.new_hinh_thuc,
    n.new_user_id,
    n.new_do_tuoi,
    n.new_type,
    n.new_over,
    n.new_view_count,
    n.new_han_nop,
    n.new_post,
    n.new_renew,
    n.new_hot,
    n.new_do,
    n.new_gap,
    n.new_cao,
    n.new_thuc,
    n.new_order,
    n.source,u.usc_create_time,u.usc_company,u.usc_logo 
    from new as n left join user_company as u on n.new_user_id=u.usc_id 
    where 1=1";
    if(intval($idcat)>0){
        $query.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
    }  
    if(intval($idpro)>0){
        $query.=" and FIND_IN_SET('".$idpro."',n.new_city)";
    }                  
    if(isset($cookjobedu) && $cookjobedu !='') {
        $query.=" and n.new_bang_cap in(".$cookjobedu.")";
    }
    if(!empty($cookjobexperion)  && $cookjobexperion !='') {
        $query.=" and n.new_exp='".$cookjobexperion."'";
    }
    if(!empty($cookjoblevel)  && $cookjoblevel !='') {
        $query.=" and n.new_cap_bac ='".$cookjoblevel."'";
    }
    if(!empty($cookjobupdate) && $cookjobupdate!='all'  && $cookjobupdate !='') {
        $query.=" and n.new_han_nop >'".$timenow1."'";
    }
    if($keywork !=''){
        $keywork=preg_replace('/([^\pL\.\ ]+)/u', '', strip_tags($keywork));
        $query.=" and n.new_title like '%".str_replace(' ','%',$keywork)."%'";
    }
    $query.=" order by n.new_id desc";
                  //var_dump($query);  

    $total=$this->db->query($query)->num_rows();
    $query.=" limit ".$page.",".$perpage;
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return array('data'=>$row,'total'=>$total);
}
function GetListJobbyCatAndProvince($cookjobedu,$cookjobexperion,$cookjoblevel,$cookjobupdate,$idcat,$idpro,$page,$perpage)
{
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    if(!empty($cookjobupdate)){
        if($cookjobupdate=="week"){
            $timenow1 = strtotime($timenow.' - 7 day');
        }
        if($cookjobupdate=="twoweek"){
            $timenow1 = strtotime($timenow.' - 14 day');
        }
        if($cookjobupdate=="month"){
            $timenow1 = strtotime($timenow.' - 30 day');
        }
        if($cookjobupdate=="twomonth"){
            $timenow1 = strtotime($timenow.' - 60 day');
        }
        if($cookjobupdate=="all"){
                //$timenow1 = strtotime($timenow.' - 360 day');
        }
    }
    $query="select n.new_id,
    n.new_title,
    n.new_cat_id,
    n.new_city,
    n.new_qh_id,
    n.new_money,
    n.new_cap_bac,
    n.new_exp,
    n.new_bang_cap,
    n.new_gioi_tinh,
    n.new_so_luong,
    n.new_hinh_thuc,
    n.new_user_id,
    n.new_do_tuoi,
    n.new_type,
    n.new_over,
    n.new_view_count,
    n.new_han_nop,
    n.new_post,
    n.new_renew,
    n.new_hot,
    n.new_do,
    n.new_gap,
    n.new_cao,
    n.new_thuc,
    n.new_order,
    n.source,u.usc_create_time,u.usc_company,u.usc_logo 
    from new as n left join user_company as u on n.new_user_id=u.usc_id 
    where 1=1";
    if(intval($idcat)>0){
        $query.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
    }  
    if(intval($idpro)>0){
        $query.=" and FIND_IN_SET('".$idpro."',n.new_city)";
    }                  
    if(isset($cookjobedu) && $cookjobedu !='') {
        $query.=" and n.new_bang_cap in(".$cookjobedu.")";
    }
    if(!empty($cookjobexperion)  && $cookjobexperion !='') {
        $query.=" and n.new_exp='".$cookjobexperion."'";
    }
    if(!empty($cookjoblevel)  && $cookjoblevel !='') {
        $query.=" and n.new_cap_bac ='".$cookjoblevel."'";
    }
    if(!empty($cookjobupdate) && $cookjobupdate!='all'  && $cookjobupdate !='') {
        $query.=" and n.new_han_nop >'".$timenow1."'";
    }
    $query.=" order by n.new_id desc limit ".$page.",".$perpage;
                  //var_dump($query);  
    $sql=$this->db->query($query);
    $query1="select count(*) as sobanghi,
    SUM(CASE WHEN n.new_han_nop > '".$timenow1."' THEN 1 ELSE 0 END) AS tinconhan 
    from new as n where 1=1";
    if(intval($idcat)>0){
        $query1.=" And FIND_IN_SET('".$idcat."',n.new_cat_id)";
    }  
    if(intval($idpro)>0){
        $query1.=" and FIND_IN_SET('".$idpro."',n.new_city)";
    }
    if(isset($cookjobedu) && $cookjobedu !='') {
        $query1.=" and n.new_bang_cap in(".$cookjobedu.")";
    }
    if(!empty($cookjobexperion) && $cookjobexperion !='') {
        $query1.=" and n.new_exp='".$cookjobexperion."'";
    }
    if(!empty($cookjoblevel) && $cookjoblevel !='') {
        $query1.=" and n.new_cap_bac ='".$cookjoblevel."'";
    }
    if(!empty($cookjobupdate) && $cookjobupdate!='all' && $cookjobupdate !='') {
        $query1.=" and n.new_han_nop >'".$timenow1."'";
    }  
    $query1.=" order by n.new_id desc";
         //var_dump($query1); 
    $sql1=$this->db->query($query1);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }
    }
    return array('data'=>$row,'total'=>$sql1->row());
}
function GetRelativeJobdetail($catid,$idnew){
    $timenow=date("Y-m-d",time());
    $timenow1 = strtotime($timenow);
    $query="select n.new_id,
    n.new_title,
    n.new_cat_id,
    n.new_city,
    n.new_qh_id,
    n.new_money,
    n.new_cap_bac,
    n.new_exp,
    n.new_bang_cap,
    n.new_gioi_tinh,
    n.new_so_luong,
    n.new_hinh_thuc,
    n.new_user_id,
    n.new_do_tuoi,
    n.new_type,
    n.new_over,
    n.new_view_count,
    n.new_han_nop,
    n.new_post,
    n.new_renew,
    n.new_hot,
    n.new_do,
    n.new_gap,
    n.new_cao,
    n.new_thuc,
    n.new_order,
    n.source,u.usc_company 
    from new as n left join user_company as u on n.new_user_id=u.usc_id 
    where n.new_han_nop > '".$timenow1."'";
    $arr=explode(',',$catid);
    for($i=0;$i< count($arr);$i++){
        $query.=" And FIND_IN_SET(".$arr[$i].",n.new_cat_id)";
    }
    $query .=" and n.new_id <>'".$idnew."'";
    $query.=" order by n.new_id desc limit 0,6";
                    //var_dump($query);
    $sql=$this->db->query($query);
    $row="";
    if($sql->num_rows()> 0)
    {
        foreach($sql->result() as $item){
            $row[]=$item;
        }



    }
    return $row;
}
function getconfig()
{
    $this->db->where('id',1);
    $this->db->order_by('id','desc');
    $sql=$this->db->get('tbl_footer');
    if($sql->num_rows() > 0)
    {
          $row = $sql->row();//mysql_fetch_assoc($db_qr->result);
          return $row;
      }
  }

  function active($id)
  {
    $sql = "SELECT Active FROM users WHERE UserID = '".$id."'";
    $query = $this->db->query($sql);
    if($query->num_rows()>0)
    {
        $row = $query->row();
        return $row;
    }

}
function check_users_point($userid) 
{
    $data   = ['kq' => false, 'message' => ''];
    $sql    = "SELECT id FROM users_point WHERE userid ='".$userid."'";
    $query  = $this->db->query($sql);
    if ($query->num_rows() > 0) {
        $data = ['kq' => true, 'message' => '1'];
    }
    return $data;
}
function check_users_point_log($userid, $teacherid) 
{
    $data   = ['kq' => false, 'message' => ''];
    $sql    = "SELECT id FROM users_point_log WHERE userid ='".$userid."' AND teacherid ='".$teacherid."'";
    $query  = $this->db->query($sql);
    if ($query->num_rows() > 0) {
        $data = ['kq' => true, 'message' => '1'];
    }
    return $data;
}
function check_users_point_log_by($userid, $teacherid, $type1, $type2) 
{
    $data   = ['kq' => false, 'message' => ''];
    $sql    = "SELECT id FROM users_point_log WHERE userid ='".$userid."' AND teacherid ='".$teacherid."' AND type='".$type1."' OR type = '".$type2."'";
    $query  = $this->db->query($sql);
    if ($query->num_rows() > 0) {
        $data = ['kq' => true, 'message' => '1'];
    }
    return $data;
}
function get_point($userid) 
{
    $sql = "SELECT * FROM users_point where userid='".$userid."'";
    return $query = $this->db->query($sql)->result();

}   
function insert_point($userid, $reset_day) 
{
    $sql    = "INSERT INTO users_point(userid, point_free, point_pay, point_return, reset_day) VALUES('".$userid."', '5', '0', '0','".$reset_day."')";
    return  $query  = $this->db->query($sql); 
}
function insert_point_log($userid, $teacherid, $type, $date_viewed) 
{
    $sql    = "INSERT INTO users_point_log(userid, teacherid, type, date_viewed) VALUES('".$userid."', '".$teacherid."', '".$type."','".$date_viewed."')";
    return  $query  = $this->db->query($sql); 
}
function update_point($userid, $reset_day)
{ 
    $sql = "UPDATE `users_point` SET `point_free` = '5' , `reset_day` = '".$reset_day."' WHERE userid = '".$userid."'";
    return $query = $this->db->query($sql);
}
function update_point_fp($userid, $point_type, $point)
{ 
    $sql = "UPDATE `users_point` SET `".$point_type."` = '".$point."'  WHERE userid = '".$userid."'";
    return $query = $this->db->query($sql);
}
function update_point_log_fp($userid, $teacherid, $type, $date_viewed)
{ 
    $sql = "UPDATE `users_point_log` SET `type` = '".$type."', `date_viewed` ='".$date_viewed."'  WHERE userid = '".$userid."' AND teacherid ='".$teacherid."'";
    return $query = $this->db->query($sql);
}
function checknews($id)
{
    $sql = "SELECT * FROM teacherclass WHERE UserID = '".$id."'";
    $query = $this->db->query($sql);
    $row = $query->num_rows();
    return $row;

}

function create_token($userid,$ip,$type)
{
       //if (function_exists('com_create_guid') === true)
       //{
       //  return trim(com_create_guid(), '{}');
       //}
   $timecreate = date("Y-m-d H:i:s",time());
   $timexpired = strtotime('+90 minutes',time());
   $timexpired = date("Y-m-d H:i:s",$timexpired);
       $token = $this->v4_guid();//sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
       $db_token =$this->db->query("INSERT INTO tokens(UserId,AuthToken,IssuedOn,ExpiresOn,IP,Type)
           VALUES('".$userid."','".$token."','".$timecreate."','".$timexpired."','".$ip."','".$type."')");
       //var_dump($db_token);die();
       //unset($db_token);
       return $token;
   }
   function v4_guid() {
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

          // 32 bits for "time_low"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff),

          // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

          // 16 bits for "time_hi_and_version",
          // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

          // 16 bits, 8 bits for "clk_seq_hi_res",
          // 8 bits for "clk_seq_low",
          // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

          // 48 bits for "node"
      mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
  );
}
function Checktoken($token,$userid)
{
   $now = 0;
   $db_qr = $this->db->query("SELECT * FROM tokens WHERE AuthToken = '".$token."' AND userid = '".$userid."' LIMIT 1");
   if($db_qr->num_rows() > 0)
   {
          $row = $db_qr->row();//mysql_fetch_assoc($db_qr->mysql_fetch_row);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = 0;
         }
         else
         {
             $now = 1;
         }
     }
     return $now;
 }
 function GetTokenByUserID($userid)
 {
   $now = "";
   $db_qr = $this->db->query("SELECT * FROM tokens WHERE UserId = '".$userid."' ORDER By TokenId DESC LIMIT 1");
   if($db_qr->num_rows() > 0)
   {
          $row =$db_qr->row();// mysql_fetch_assoc($db_qr->result);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = "";
         }
         else
         {
             $now = $row['AuthToken'];
         }
     }
     return $now;
 }
 function ChecktokenExpired($token)
 {
   $now = 0;
   $db_qr = $this->db->query("SELECT * FROM tokens WHERE 	AuthToken = '".$token."' ORDER BY TokenId DESC LIMIT 1");
   if($db_qr->num_rows() > 0)
   {
          $row = $db_qr->row();// mysql_fetch_assoc($db_qr->result);
          $expired = $row['ExpiresOn'];
          $expired = strtotime($expired);
          if($expired < time())
          {
             $now = 0;
         }
         else
         {
             $now = $row['UserId'];
         }
     }
     return $now;
 } 
 function deltokenbyuserid($userid)
 {
    $db_qr = $this->db->query("delete FROM tokens WHERE UserId = '".$userid."'");
    return 1;
}
function GetWordtime()
{
    $query="select * from worktime order by worktimeID ASC";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $tg1="";
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;    
        }
    }
    return $tg1;
} 
function GetSex()
{
    $query="select * from sex order by SexID ASC";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $tg1="";
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;    
        }
    }
    return $tg1;
}

function EmailNofity($findkey)
{
    $query="Select Email from EmailNotify where Email like'%".$findkey."%'";
    $dbcompany = $this->db->query($query);
    if($dbcompany->num_rows() > 0)
    {
        $data=array('kq'=>false,'msg'=>'Bạn đã đăng ký nhận thông tin trước đó');
    }else{
        $timecreate = date("Y-m-d H:i:s",time());            
        $query ="INSERT INTO EmailNotify(Email,CreateDate,`Order`)VALUES('".strtolower($findkey)."','".$timecreate."',0)";
            //var_dump($query);die();
        $db_token =$this->db->query($query);
        $data=array('kq'=>true,'msg'=>'Bạn đã đăng ký nhận thông tin thành công');
    }
    return $data;
}
function GetCategoryWithLink()
{
        //$query="select c.cat_id,c.cat_name from category as c limit 64";
    $query="select c.cat_id,c.cat_name,COUNT(n.new_id)as tinconhan from category as c, new as n where FIND_IN_SET(c.cat_id,n.new_cat_id) and n.new_han_nop >'".time()."' GROUP BY c.cat_id ORDER BY tinconhan desc limit 64";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $tg1="";
        foreach($db_qr->result() as $itemcat)
        {
                //viec-lam-viec-lam-ban-hang-c10p0.html
            $item['id']=$itemcat->cat_id;
            $item['soluongbai']=$itemcat->tinconhan;
            $item['name']=$itemcat->cat_name;
            $item['url']=base_url()."viec-lam-".vn_str_filter($itemcat->cat_name)."-c".$itemcat->cat_id."p0.html";
            $tg1[]=$item;    
        }
    }
    return $tg1;
}
function GetProvinceWithLink()
{
    $query="select c.cit_id,c.cit_name from city as c";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $tg1="";
        foreach($db_qr->result() as $itemcat)
        {
                //viec-lam-viec-lam-ban-hang-c10p0.html
            $item['name']=$itemcat->cit_name;
            $item['url']=base_url()."viec-lam-tai-".vn_str_filter($itemcat->cit_name)."-c0p".$itemcat->cit_id.".html";
            $tg1[]=$item;    
        }
    }
    return $tg1;
}
function RegisterCandi($name,$email,$pass,$phone,$city,$ngaysinh,$gioitinh,$honnhan,$cvtitle,$bangcap,$hinhthuclamviec,$capbac,$noilamvieckhac,$nganhnghe,$extrann,$muctieu,$kynang,$diachi,$mucluong,$kinhnghiem,$district,$school,$schooltype,$xeploaihoctap,$languagecandi)
{
    $queryket="select * from `user` where use_email = '".$email."'";
    $db_qr = $this->db->query($queryket);
    if($db_qr->num_rows() > 0)
    {
        return array('userid'=>0,'code'=>'');
    }else{
        $query="Insert into user(use_email,use_first_name,use_pass,use_type,use_create_time,use_update_time,use_phone,use_city,use_authentic,use_gioi_tinh,use_birth_day,use_address,use_hon_nhan)";
        $query.="values('".$email."','".$name."','".md5($pass)."','0','".time()."','".time()."','".$phone."','".intval($city)."','0','".intval($gioitinh)."','".strtotime($ngaysinh)."','".$diachi."','".intval($honnhan)."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $query="INSERT INTO cv(cv_user_id,cv_title,cv_hocvan,cv_loaihinh_id,cv_capbac_id,cv_money_id,cv_exp,cv_kynang,cv_muctieu,cv_cate_id,cate_extra,cv_city_id,city_extra,district,school,schooltype,xeploaihoctap,language)
        VALUES(".$insertid.",'".$cvtitle."','".intval($bangcap)."','".intval($hinhthuclamviec)."','".intval($capbac)."','".intval($mucluong)."','".intval($kinhnghiem)."','".$kynang."','".$muctieu."','".intval($nganhnghe)."','".$extrann."','".intval($city)."','".intval($noilamvieckhac)."','".intval($district)."','".$school."','".$schooltype."','".intval($xeploaihoctap)."','".intval($languagecandi)."')";
        $insert=$this->db->query($query);
        $type=1;
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');      
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$email,$body);    
        $body=str_replace('<%code%>',$code,$body);
        $body=str_replace('<%code%>',$type,$body);   
        $code="candi_".rand(1000000,9999999);
        $Description="Đăng ký tài khoản";
        $data="";
        $CreateDate=date("Y-m-d H:i:s",time());
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
        VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);
        
        $subject='[timviec24h] Kích hoạt tài khoản đăng ký';
        $header='Từ: timviec24h.net.vn';
        require_once('class.phpmailer.php');
        require_once('class.pop3.php');
        define('GUSER','timviec365-noreply@timviec365.vn');
        define('GPWD','Bbz123');
        global $message;
        $this->smtpmailer($email,'timviec365-noreply@timviec365.vn',$header,$subject,$body);
        return array('userid'=>$insertid,'code'=>$code);       

    }                                      
}
function RegisterCompany($tencongty,$phone,$email,$city,$pass,$website,$addresscom)
{
    $queryket="select * from `user_company` where usc_email = '".$email."'";
    $db_qr = $this->db->query($queryket);
    if($db_qr->num_rows() > 0)
    {
        return array('userid'=>0,'code'=>'');
    }else{
        $type=2;
        $query="Insert into user_company(usc_email,usc_name,usc_name_add,usc_name_phone,usc_name_email,usc_pass,usc_company,usc_type,usc_address,usc_phone,usc_website,usc_city,usc_create_time,usc_update_time,usc_authentic)";
        $query.="values('".$email."','".$tencongty."','".$addresscom."','".$phone."','".$email."','".md5($pass)."','".$tencongty."','0','".$addresscom."','".$phone."','".$website."','".$city."','".time()."','".time()."','0')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id();
        $query="INSERT INTO user_company_multi(usc_id)VALUES(".$insertid.")";
        $insert=$this->db->query($query);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');      
        $body=str_replace('<%name%>',$name,$body);
        $body=str_replace('<%email%>',$email,$body);    
        $body=str_replace('<%code%>',$code,$body); 
        $body=str_replace('<%type%>',$type,$body); 
        $code="com_".rand(1000000,9999999);
        $Description="Đăng ký tài khoản công ty";
        $data="";
        $CreateDate=date("Y-m-d H:i:s",time());
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
        VALUES('".$insertid."','".$code."','2','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);
        
        $subject='[timviec24h] Kích hoạt tài khoản đăng ký';
        $header='Từ: timviec24h.net.vn';
        require_once('class.phpmailer.php');
        require_once('class.pop3.php');
        define('GUSER','timviec365-noreply@timviec365.vn');
        define('GPWD','Bbz123');
        global $message;
        $this->smtpmailer($email,'timviec365-noreply@timviec365.vn',$header,$subject,$body);
        return array('userid'=>$insertid,'code'=>$code);       

    }
}
function getconfirmuser($code, $email, $type)
{

    $arr = ['kq' => false];
    if (intval($type) < 2) {
        $query = "select * from `users` where Email ='" . $email . "' and Active = 0";
//var_dump($query);
        $db_qr = $this->db->query($query);

        if ($db_qr->num_rows() > 0) {
            $item = $db_qr->row();
            $query = "select * from comfirmtable where Code='" . $code . "' and Type='" . $type . "' and UserID='" . $item->UserID . "'";
            $db_qr = $this->db->query($query);
            if ($db_qr->num_rows() > 0) {
                $query1 = "UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '" . $item->Id . "'";
                $tg = $this->db->query($query1);
                $query2 = "UPDATE `users` SET `Active` = '1' WHERE UserID = '" . $item->UserID . "'";
                $tg1 = $this->db->query($query2);
                $arr = ['kq' => true];
            }
        }
    } else {
        $query = "select * from `users` where Email ='" . $email . "' and Active = 0";
//var_dump($query);
        $db_qr = $this->db->query($query);
        if ($db_qr->num_rows() > 0) {
            $item = $db_qr->row();
            $query = "select * from comfirmtable where Code='" . $code . "' and Type='" . $type . "' and UserID='" . $item->usc_id . "'";
            $db_qr = $this->db->query($query);
            if ($db_qr->num_rows() > 0) {
                $item2 = $db_qr->row();;
                $query1 = "UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '" . $item2->Id . "'";
                $tg = $this->db->query($query1);
                $query1 = "UPDATE `users` SET `Active` = '1' WHERE UserID = '" . $item->usc_id . "'";
                $tg1 = $this->db->query($query1);
                $arr = ['kq' => true];
            }
        }
    }
    return $arr;
}
function getconfirmuserbycode($newpass,$email)
{
   $arr=['kq'=>false]; 
   $query="select * from users where (UserName ='".$email."' or Email ='".$email."') and `Active`=1";
   $db_qr = $this->db->query($query);
   if($db_qr->num_rows() > 0)
   {
    $item=$db_qr->row();
    $query="select * from comfirmtable where Type='0' and UserID='".$item->UserID."' and `Status`=0 order by CreateDate desc";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $item2=$db_qr->row();
        $query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
        $tg=$this->db->query($query1);
        $query1="UPDATE `users` SET `Password` = '".md5($newpass)."' WHERE UserID = '".$item->UserID."'";
        $tg1=$this->db->query($query1);
        $arr=['kq'=>true,'mk'=>'Thay đổi mật khẩu thành công'];
    }
}
return $arr;
}
function getconfirmuserregisterbycode($code,$username)
{
   $arr=['kq'=>false]; 
   $query="select * from users where (Name ='".$username."' OR Email ='".$username."')";
   $db_qr = $this->db->query($query);
   if($db_qr->num_rows() > 0)
   {
    $item=$db_qr->row();
    $query="select * from comfirmtable where Code like '%_".$code."' and Type='0' and UserID='".$item->UserID."' and `Status`= 0 order by CreateDate desc";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() > 0)
    {
        $item2=$db_qr->row();
        $query1="UPDATE `comfirmtable` SET `Status` = '1' WHERE Id = '".$item2->Id."'";
        $tg=$this->db->query($query1);

        $query2="UPDATE `users` SET `Active` = '1' WHERE UserID = '".$item->UserID."'";
        $tg1=$this->db->query($query2);
        $arr=['kq'=>true,'mk'=>$code];
    }
}
return $arr;
}
function DemGiaSuTheoMonHoc()
{
    $query="select s.ID,s.SubjectName,COUNT(u.SubjectID) as sogiasu from `subject` as s left JOIN usersubject as u on s.ID=u.SubjectID group by s.ID";
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
function laytieude($id, $cid, $loctieude)
    {

    $sql =
    "SELECT * FROM baiviet AS bv WHERE bv.id != $id AND bv.cid = $cid
    $loctieude
    ORDER BY
    bv.id
    LIMIT 20";

    $query = $this->db->query($sql);
    $result = $query->result();
    return $result;
}
function TimGiaSuTheoMonHoc($key)
{
    $query="select s.ID,s.SubjectName,COUNT(u.SubjectID) as sogiasu from `subject` as s left JOIN usersubject as u on s.ID=u.SubjectID where s.SubjectName like '%".str_replace(' ','%',$key)."%' group by s.ID";
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
function DemGiaSuTheoTinhThanh()
{
    $query="select c1.cit_name,c1.cit_id,IFNULL(SUM(c2.sogiasu),0) as giasutt  from city as c1 left join (select c.cit_id,c.cit_name,COUNT(u.UserID) as sogiasu from city as c left JOIN users as u on c.cit_id=u.CityID where u.Active=1 and u.`Delete`=0 and u.UserType=1 group by c.cit_id) as c2 on c1.cit_id=c2.cit_id GROUP BY c1.cit_id";
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
function timgiasutheotinhthanh($key)
{
    $query="select c1.cit_name,c1.cit_id,IFNULL(SUM(c2.sogiasu),0) as giasutt  from city as c1 left join (select c.cit_id,c.cit_name,COUNT(u.UserID) as sogiasu from city as c left JOIN users as u on c.cit_id=u.CityID where u.Active=1 and u.`Delete`=0 and u.UserType=1 group by c.cit_id) as c2 on c1.cit_id=c2.cit_id where c1.cit_name like '%".str_replace(' ','%',$key)."%' GROUP BY c1.cit_id";
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
function GetListClassHome($number){
    $query="select * from teacherclass ORDER BY ClassID desc limit 0,".$number;
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
function del_userclass_by($id){
    $query="DELETE  from uservsclass where ClassID = '".$id."' and Active=0 or Active = 2";
    $db_qr = $this->db->query($query);
    $record = mysql_affected_rows();
    return $record;
}
    //function GetListClassBySearch($keywork,$subject,$topic,$place,$type,$sex,$page,$perpage)
//    {
//       $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
//        ,u.Email
//        ,u.CityID
//        ,u.CityName,u.`Image`
//        ,u.Address as diachidk
//        ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
//         from teacherclass as t left join users as u on t.UserID=u.UserID
//        	left JOIN (select ClassID,
//        SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
//        SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
//         from uservsclass as uc
//        GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
//        $query.=" where 1=1";
//        if(!empty($keywork) && strtolower($keywork)!='all'){
//            $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";
//        }
//        if(intval($place)>0 ){
//            $query.=" and t.City ='".intval($place)."'";
//        }
//        if(intval($subject) >0){
//            $query.=" and t.SubjectID='".intval($subject)."'";
//        }
//        if(intval($topic)>0){
//            $query.=" and FIND_IN_SET('".intval($topic)."',t.TopicArr)";
//        }
//        if(intval($sex)>0){
//            $query.=" and FIND_IN_SET('".intval($sex)."',t.TeacherSex)";
//        }
//        if(intval($type)>0){
//            $query.=" and FIND_IN_SET('".intval($type)."',t.LearnType)";
//        }
//        $query.=" order by t.ClassID desc";
//        $query.=" limit ".$page.",".$perpage;
//        
//        $db_qr = $this->db->query($query);
//        $tg1="";
//        if($db_qr->num_rows() > 0)
//        {                
//            foreach($db_qr->result() as $itemcat)
//            {
//                $tg1[]=$itemcat;    
//            }
//        }
//        return $tg1;
//    }
function GetListClassbyUserOnline()
{
    $query="select * from teacherclass as t where t.ClassTitle <> '' and t.`Active`=1 and t.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";
    $query.=" order by t.ClassID desc";
    $query.=" limit 0,20";
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
function GetListClassRelate($subject,$class,$place,$district)
{
    $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
       ,u.Email
       ,u.CityID
       ,u.CityName,u.`Image`
       ,u.Address as diachidk
       ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
       from teacherclass as t left join users as u on t.UserID=u.UserID
       left JOIN (select ClassID,
       SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
       SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
       from uservsclass as uc
       GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
       $query.=" where t.ClassTitle <> '' and t.`Active`=1 and u.UserType = 0";
       
    if(!empty($class)){
        $query.=" OR t.ClassTitle like '%".str_replace(' ','%',$classname)."%'";
    }
    if(intval($place)>0 ){
        $query.=" OR t.City ='".intval($place)."'";
    }
    if(intval($subject) >0){
        $query.=" OR t.SubjectID='".intval($subject)."'";
    }
    if(intval($district) > 0){
     $query.=" OR u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
     $query.=")";
    }
    $query.=" order by t.ClassID desc";
    $query.=" limit 0,19";
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
function SearchClassbyUserOnline($key,$city)
{
    $query="select * from teacherclass as t where t.ClassTitle <> '' and t.`Active`=1 and t.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";
    if(!empty($key)){
        $query.=" and t.ClassTitle like '%".str_replace(' ','%',$key)."%'";

    }
    if(intval($city)>0){
       $query.=" and t.City='".intval($city)."'"; 
   }
   $query.=" order by t.ClassID desc";
   $query.=" limit 0,20";
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
function GetListTeacher($number)
{
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
    where u.`Delete`=0 and u.Email <>'' and u.Active=1 and u.UserType=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3,4,5,6,7,8,10,11,12,13,14,15,16))
    ORDER BY u.CreateDate desc LIMIT 0,".$number;
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
function GetTeacherOnline($number)
{
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
    where  u.Email <>'' and ut.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW()) limit 0, ".$number;
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
function GetTeacherOnlinebySearch($city,$tag)
{
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
    where  u.Email <>'' and ut.UserID in (SELECT UserId FROM tokens as tk where tk.ExpiresOn > NOW())";

    if(!empty($tag)){
        $query.="  and (ut.TitleView like '%".str_replace(' ','%',$tag)."%' or u.`Name` like '%".str_replace(' ','%',$tag)."%')";
    }      
    if(intval($city)>0){
        $query.=" and u.CityID='".intval($city)."'";
    }  
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
function GetTeacherFeature()
{
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

    from users as u JOIN userteacher as ut on u.UserID=ut.UserID where u.Email <>''
    ORDER BY ut.Free DESC
    limit 0, 7";
    $db_qr = $this->db->query($query);
    // var_dump($db_qr);
    // die();
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
function GetTeacherRelate($subject,$class,$city,$topic,$district)
{
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
    if(intval($district) > 0){
     $query.=" OR u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
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
return array('total'=>$total,'data'=>$tg1);
}
function GetTeacherMore($id)
{
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
    from users as u JOIN userteacher as ut on u.UserID=ut.UserID where u.Email <>'' and ut.UserID <>'".intval($id)."' 
    ORDER BY ut.Free DESC
    limit 0, 5";
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
    //function GetListTeacherBySearch($keywork,$subject,$topic,$place,$type,$sex,$order,$page,$perpage)
//    {
//        $query="select ut.*,u.`Name`
//        ,u.UserName
//        ,u.Phone
//        ,u.Email
//        ,u.CityID
//        ,u.CityName
//        ,u.Address
//        ,u.Description
//        ,u.UserType
//        ,u.CreateDate
//        ,u.CreateBy
//        ,u.Image
//        ,u.Latitude
//        ,u.Longitude        
//         from users as u JOIN userteacher as ut on u.UserID=ut.UserID
//        where u.`Delete`=0 and u.Active=1 and u.UserType=1";
//        if(!empty($keywork) && strtolower($keywork)!='all'){
//            $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keywork)."%' or u.`Name` like '%".str_replace(' ','%',$keywork)."%')";
//        }
//        if(intval($place) > 0){
//            $query.=" and u.CityID='".intval($place)."'";
//        }  
//        if(intval($type) > 0){
//            $query.=" and ut.WorkID='".intval($type)."'";
//        }
//        if(intval($sex)>0){
//            $query.=" and u.sex ='".intval($sex)."'";
//        }
//        if(intval($subject)>0){
//            $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."'";
//            if(intval($topic)>0){
//                $query.=" and TopicID='".intval($topic)."'";
//            }
//             $query.=")";
//        }
//        if(strtolower($order)=='last'){
//            $query.=" ORDER BY u.CreateDate desc";
//        }else if(strtolower($order)=='pricelow'){
//            $query.=" ORDER BY ut.Free asc";
//        }else if(strtolower($order)=='pricehigh'){
//            $query.=" ORDER BY ut.Free desc";
//        }
//        //var_dump($query);die();
//        $total=$this->db->query($query)->num_rows();
//        $query.=" LIMIT ".$page.",".$perpage;
//        $db_qr = $this->db->query($query);
//        $tg1="";
//        if($db_qr->num_rows() > 0)
//        {                
//            foreach($db_qr->result() as $itemcat)
//            {
//                $tg1[]=$itemcat;    
//            }
//        }
//        return array('total'=>$total,'data'=>$tg1);
//    }
function CountTeacherbyCity()
{
    $query="select c1.cit_id,c1.cit_name,IFNULL(c2.sogiaovien,0) as tongsogiaovien from city as c1 left JOIN (select c.cit_id,c.cit_name,COUNT(u.CityID)as sogiaovien from city as c left JOIN users as u on c.cit_id=u.CityID where u.UserType=1 GROUP BY c.cit_id) c2 on c1.cit_id=c2.cit_id group by c1.cit_id";
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
function GetListTeacherTLH($number){
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
    where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.UserType=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3))
    ORDER BY u.CreateDate desc LIMIT 0,".$number;
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
function GetListTeacherVSD($number){
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
    where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.UserType=1 and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID in(1,2,3))
    ORDER BY u.CreateDate desc LIMIT 0,".$number;
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
function GetFirstUserTeacher($userid)
{
    $query="select ut.*,u.`Name`
    ,u.UserName
    ,u.Phone
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.Address
    ,u.Description
    ,u.UserType,IFNULL(t.solopdaday,0) as solopday
    from userteacher as ut left JOIN users as u on ut.UserID=u.UserID
    left join (select UserID,COUNT(ClassID)as solopdaday from uservsclass where Active=1) as t on t.UserID=ut.UserID
    where u.Active=1 and u.`Delete`=0 and u.UserID='".$userid."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                

        $tg1=$db_qr->row();    

    }
    return $tg1;
}
function GetFirstClass($id)
{
    $query="select tc.*,t.denghiday,t.dongyday,tm.MetaTitle,tm.MetaDesc,tm.MetaKeywork
    ,u.`Name`
    ,u.Phone as Phoneu
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.Address as Addressu
    ,u.Description
    ,u.UserType
    ,u.Image
    from teacherclass as tc left JOIN (select ClassID,
    SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
    SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
    from uservsclass as uc
    GROUP BY ClassID) t on tc.ClassID=t.ClassID
    LEFT JOIN teacherclassmeta as tm on tc.ClassID=tm.ClassID left join users as u on tc.UserID=u.UserID
    where tc.ClassID='".$id."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;
}
function GetFirstClassByUserClassID($id,$userid)
{
    $query="select t.*,t1.MetaDesc,
    t1.MetaTitle,
    t1.MetaKeywork,
    t1.Latitude,
    t1.Longitude
    from teacherclass as t LEFT JOIN teacherclassmeta as t1 on t1.ClassID=t.ClassID where t.UserID='".$userid."' and t.ClassID='".$id."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;
}
function GetFirstTeacher($id)
{
    $query="select ut.*,u.`Name`
    ,u.Phone as phoneu
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.CityID2
    ,u.CityName2
    ,u.Address as Addressu
    ,u.Description
    ,u.CreateDate
    ,u.Image
    ,u.Latitude
    ,u.Longitude
    ,u.Sex
    ,u.Exp
    ,u.Bonus
    ,u.Birth
    from userteacher as ut LEFT JOIN users as u on ut.UserID=u.UserID
    where  u.UserType=1 and ut.UserID='".intval($id)."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {                
        $tg1=$db_qr->row();
    }
    return $tg1;        
}
function GetTopicbyUserID($id)
{
    $query="select u.TopicID,u.TopicName,u.UserID from usersubject as u WHERE u.UserID='".$id."'";
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
function GetListClassRelative($idclass,$idSubject){
    $query="select tc.*,u.`Name`
    ,u.Phone as Phoneu
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.Address as Addressu
    ,u.Description
    ,u.UserType
    ,u.Image
    from teacherclass as tc left join users as u on tc.UserID=u.UserID
    where tc.`Active`=1 and tc.SubjectID='".intval($idSubject)."' and tc.ClassID <>'".$idclass."' order by tc.ClassID desc limit 0,12";
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
function GetTopClassByMoney($number)
{
    $query="select t.*,u.`Name`,u.Phone as sodienthoaidk
    ,u.Email
    ,u.CityID
    ,u.CityName,u.`Image`
    ,u.Address as diachidk
    ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
    from teacherclass as t left join users as u on t.UserID=u.UserID
    left JOIN (select ClassID,
    SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
    SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
    from uservsclass as uc
    GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
    $query.=" where t.ClassTitle <>'' and t.`Active`=1 and u.IsSearch=1 order by t.Money desc limit 0,".$number;
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
function GetClassTop($number)
{
    $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
    ,u.Email
    ,u.CityID
    ,u.CityName,u.`Image`
    ,u.Address as diachidk
    ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
    from teacherclass as t left join users as u on t.UserID=u.UserID
    left JOIN (select ClassID,
    SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
    SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
    from uservsclass as uc
    GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
    $query.=" where t.ClassTitle <>'' and 1=1 and t.`Active`=1 and u.IsSearch=1 order by t.ClassID desc limit 0,".$number;
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
function CountClassByCity()
{
    $query="select c1.cit_id,c1.cit_name,IFNULL(t1.sobaiviet,0) as tongsobai from city as c1 left join (select c.cit_id,c.cit_name,COUNT(t.ClassID) as sobaiviet 
    from city as c left JOIN teacherclass as t on c.cit_id=t.City
    where t.ClassID not in(select DISTINCT u.ClassID  from uservsclass as u where u.Active=1)	
    GROUP BY c.cit_id) as t1 on c1.cit_id=t1.cit_id	";
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
function GetTeacherType()
{
    $query="select ID,NameType from teachtype as t order by ID asc";
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
function GetTeacherTypeBy($id)
{
    $query="select ID,NameType from teachtype where ID ='".$id."' order by ID asc";
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
function GetListSubject($userid)
{
    $row='';
    $tg1="";
    $sql="SELECT IdTitle FROM userteacher WHERE UserID = '".$userid."'";
    $query= $this->db->query($sql)->result();

    foreach ($query as $key ) {
        $tg1=$key->IdTitle;
    }
    $arr_cate = explode(',',$tg1);
    foreach ($arr_cate as $key => $v){
        $sql1 = "SELECT * FROM subject WHERE ID = '".$v."'";
        $que = $this->db->query($sql1)->result();
        return $que;
    }
        // foreach ($arr_cate as $key => $value_item){
        //     $row = GetSubject($value_item);
        //     return $row;
        // }
        // var_dump($row);die;

}

    //  function NameClass($class)
    // {
    //     $sql="select * from class where id =" ."'.$class.'"  ;
    //    $query = $this->db->query($sql); 
    //    $result =  $query->row()->classname;
    //    return $result;
    // }


function Danhsachloptheomonhoc()
{
    $query="select s2.ID,s2.SubjectName,IFNULL(s1.sobanghi,0) as tongbanghi from `subject` as s2 left JOIN(select s.ID,s.SubjectName,COUNT(t.SubjectID) as sobanghi from `subject` as s left JOIN teacherclass as t on s.ID=t.SubjectID
    where t.ClassID not in (select u.ClassID from uservsclass as u where u.Active=1)
    group by s.ID) as s1 on s1.ID=s2.ID";
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
function ListSubject($subject)
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
function ListClass($class)
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
function ListCity($city){
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
function ListDistrict($city2){
    $query = "SELECT cit_id, cit_name from city2 where cit_parent = '".$city2."' ";
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

function ListSubjectByKey($key)
{
    $query="select * from `subject` where SubjectName like '%".$key."%'";
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

function GetNameSubjectByKey($key)
{
    $query="select * from `subject` where ID='".$key."%'";
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
function ListTopic()
{
    $query="select * from topic";
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
function ListTopicBySubject($idsub)
{
    $query="select * from topic where SubjectID='".intval($idsub)."'";
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
function Listtopicbysubjectandidtopic($idsub,$idtopic){
    $query="select * from topic where SubjectID='".intval($idsub)."' and FIND_IN_SET(id,'".$idtopic."')";
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
function InsertUser($Name,$username,$Phone,$Email,$CityID,$CityName,$Address,$Description,$UserType,$Password,$CreateBy,$Image,$Latitude,$Longitude,$Sex,$Exp,$Bonus,$Birth)
{
    $queryket="select * from users where Email='".$Email."'";
    $db_qr = $this->db->query($queryket);
    if($db_qr->num_rows() > 0)
    {
        return array('userid'=>0,'code'=>'');
    }
    else
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth)";
        $query.="values('".$Name."','".trim($username)."','".trim($Phone)."','".$Email."','".$CityID."','".$CityName."','".$Address."','".$Description."','".$UserType."','".md5($Password)."','".$CreateDate."','".$CreateBy."','".$Image."','0','0','".$Latitude."','".$Longitude."','".intval($Sex)."','".$Exp."','".$Bonus."','".$Birth."')";
        $insert=$this->db->query($query);

        $insertid=$this->db->insert_id();
        $query="INSERT INTO user_company_multi(usc_id)VALUES(".$insertid.")";
        $insert=$this->db->query($query);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
        $code="com_".rand(1000000,9999999);    
        $body=str_replace('<%name%>',$Name,$body);
        $body=str_replace('<%email%>',$Email,$body);    
        $body=str_replace('<%code%>',$code,$body);
        $body=str_replace('<%type%>',$UserType,$body);

        $Description="Đăng ký tài khoản gia sư";
        $data="";
        $CreateDate=date("Y-m-d H:i:s",time());
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
        VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);
        $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
        $header='Từ: GiaSu365';
        $body = base64_encode($body);
        $this->CreateSendMail('timviec365-noreply@timviec365.vn',$Email, "", "", $subject, $body);
        $result=['kq'=>true,'data'=>$insertid,'code'=>$code];
        return $result;
    }
}
function InsertUserTeacher($Name,$username,$Phone,$Email,$CityID,$CityName,$CityID2,$CityName2,$Address,$Description,$UserType,$Password,$CreateBy,$Image,$Latitude,$Longitude,$Sex,$Exp,$Bonus,$Birth)
{
    $queryket="select * from users where Email='".$Email."' AND UserType = 1";
    $db_qr = $this->db->query($queryket);
    if($db_qr->num_rows() > 0)
    {
        return array('userid'=>0,'code'=>'');
    }
    else
    {
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="Insert into users(`Name`,UserName,Phone,Email,CityID,CityName,CityID2,CityName2,Address,Description,UserType,`Password`,CreateDate,CreateBy,Image,Active,`Delete`,Latitude,Longitude,Sex,Exp,Bonus,Birth)";
        $query.="values('".$Name."','".trim($username)."','".trim($Phone)."','".$Email."','".$CityID."','".$CityName."','".trim($CityID2)."','".trim($CityName2)."','".$Address."','".$Description."','".$UserType."','".md5($Password)."','".$CreateDate."','".$CreateBy."','".$Image."','0','0','".$Latitude."','".$Longitude."','".intval($Sex)."','".$Exp."','".$Bonus."','".$Birth."')";
        $insert=$this->db->query($query);

        $insertid=$this->db->insert_id();
        $query="INSERT INTO user_company_multi(usc_id)VALUES(".$insertid.")";
        $insert=$this->db->query($query);
        $body=file_get_contents(base_url().'EmailTemplate/XacThucEmail.htm');  
        $code="com_".rand(1000000,9999999);    
        $body=str_replace('<%name%>',$Name,$body);
        $body=str_replace('<%email%>',$Email,$body);    
        $body=str_replace('<%code%>',$code,$body);
        $body=str_replace('<%type%>',$UserType,$body);

        $Description="Đăng ký tài khoản gia sư";
        $data="";
        $CreateDate=date("Y-m-d H:i:s",time());
        $queryconfrim="INSERT INTO comfirmtable(UserID,Code,Type,Status,Data,Description,CreateDate,UpdateDate) 
        VALUES('".$insertid."','".$code."','1','0','".$body."','".$Description."','".$CreateDate."','".$CreateDate."')";
        $insert=$this->db->query($queryconfrim);
        $subject='[GiaSu365] Kích hoạt tài khoản đăng ký';
        $header='Từ: GiaSu365';
        $body = base64_encode($body);
        $this->CreateSendMail('timviec365-noreply@timviec365.vn',$Email, "", "", $subject, $body);
        $result=['kq'=>true,'data'=>$insertid,'code'=>$code];
        return $result;
    }
}
function UpdateUsersT($userid,$hoten,$khuvucday,$tenkhuvucday,$quanhuyen,$DistrictView,
$noiohientai,$descusers,$imguser,$gioitinh,$kinhnghiem,$thanhtich,$birth){
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    
    $result=['kq'=>false,'data'=>0];
    $date = date("Y-m-d H:i:s");
    $CreateDate=date("Y-m-d H:i:s",time());
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if(empty($imguser)){
            $imguser=$tg->Image;
        }
        $query="UPDATE users set `Name`='".$hoten."',CityID='".$khuvucday."',CityName='".$tenkhuvucday."',
        CityID2='".trim($quanhuyen)."',CityName2='".trim($DistrictView)."'
        ,Address='".$noiohientai."',Description='".$descusers."',
        Image='".$imguser."',Sex='".intval($gioitinh)."',Exp='".$kinhnghiem."',Bonus='".$thanhtich."',
        Birth='".$birth."',UpdateDate='".$CreateDate."' where UserID='".$userid."'";
        $update=$this->db->query($query); 
        $result=['kq'=>true,'data'=>''];
        return $result;
        
    }
}
function UpdateUsers($userid,$Name,$CityID,$CityName,$Address,$Description,$Image,$Sex,$Exp,$Bonus,$Birth)
{   
    
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    $result=['kq'=>false,'data'=>0];
    $date = date("Y-m-d H:i:s");
    $CreateDate=date("Y-m-d H:i:s",time());
    // var_dump($Image);
    //      die();
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if(empty($Image)){
            $Image=$tg->Image;
        }
        if((!empty($tg->UpdateDate) && (strtotime($tg->UpdateDate . "+30 minutes") < time()))||(empty($tg->UpdateDate))){
            $query="UPDATE users set `Name`='".$Name."',CityID='".$CityID."',CityName='".$CityName."'
            ,Address='".$Address."',Description='".$Description."',
            Image='".$Image."',Sex='".intval($Sex)."',Exp='".$Exp."',Bonus='".$Bonus."',
            Birth='".$Birth."',UpdateDate='".$CreateDate."' where UserID='".$userid."'";
            $update=$this->db->query($query); 
            $result=['kq'=>true,'data'=>''];
            return $result;
        }else{
            return $result;
        }
    }
}
function UpdateUsers2($userid,$Name,$CityID,$CityName,$Address,$Description,$Image,$Sex,$Exp,$Bonus,$Birth)
{
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    $result=['kq'=>false,'data'=>''];
    $date = date("Y-m-d H:i:s");
    $CreateDate=date("Y-m-d H:i:s",time());
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if(empty($Image)){
            $Image=$tg->Image;
        }
        $query="UPDATE users set `Name`='".$Name."',CityID='".$CityID."',
        CityName='".$CityName."',Address='".$Address."',Description='".$Description."'
        ,Image='".$Image."',Sex='".intval($Sex)."',Exp='".$Exp."',Bonus='".$Bonus."',Birth='".$Birth."',
        UpdateDate='".$CreateDate."' where UserID='".$userid."'";
        $update=$this->db->query($query); 
        $result=['kq'=>true,'data'=>''];
        return $result;            
    }
}
function Checkimage($userid,$fileimage)
{
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    if ($db_qr->Image == $fileimage ){
        $query="ALTER TABLE users DROP Image='".$fileimage."' where  UserID='".$userid."'";
        $this->db->query($query); 
    }
    else {
        $queryket="select * from users where UserID='".$userid."'";
        $db_qr = $this->db->query($queryket);
        $result=['kq'=>false,'data'=>''];
        $date = date("Y-m-d H:i:s");
        $CreateDate=date("Y-m-d H:i:s",time());
        if($db_qr->num_rows() > 0)
        {
            $query="UPDATE users set Image='".$fileimage."' where UserID='".$userid."'";
            $this->db->query($query); 
            $result=['kq1'=>true,'data'=>''];
            return $result;            
        }
    }
}
function Updateimage2($userid,$fileimage)
{
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    $result=['kq'=>false,'data'=>''];
    $date = date("Y-m-d H:i:s");
    $CreateDate=date("Y-m-d H:i:s",time());
    if($db_qr->num_rows() > 0)
    {
        $query="UPDATE users set Image='".$fileimage."' where UserID='".$userid."'";
        $update=$this->db->query($query); 
        $result=['kq1'=>true,'data'=>''];
        return $result;
    }
}

function InsertTeacherTopic($SubjectID,$SubjectName,$TopicID,$TopicName,$UserID)
{
    $CreateDate=date("Y-m-d H:i:s",time());
    $query="Insert into usersubject(SubjectID,SubjectName,TopicID,TopicName,UserID,CreateDate)
    VALUES('".$SubjectID."','".$SubjectName."','".$TopicID."','".$TopicName."','".$UserID."','".$CreateDate."')";
    $insert=$this->db->query($query);


    return $insert;
}
function InsertTeacherDisctrict($cit_id,$cit_name,$UserID)
{
    $query="Insert into userdistrict(cit_id,cit_name,UserID) VALUES('".$cit_id."','".$cit_name."','".$UserID."')";
    $insert=$this->db->query($query);
    return $insert;
}
function DeleteTeacherTopic($UserID)
{
    $query="delete from usersubject where UserID='".$UserID."'";
    $insert=$this->db->query($query);
    return $insert;
}
function UpdateTeacher($UserID,$WorkID,$WorkingName,$TeachType,$Free,$MonMorning,$MonAfter,$MonNight,$TueMorning,$TueAfter,$TueNight,
    $WeMorning,$WeAfter,$WeNight,$ThuMorning,$ThuAfter,$ThuNight,$FriMorning,$FriAfter,$FriNight,$SatMorning,$SatAfter
    ,$SatNight,$SunMorning,$SunAfter,$SunNight,$ImgPassport,$TitleView,$IdTitle,$Orther,$School,$Major,$Graduationyear,$Workplace)
{
    $result=['kq'=>false,'data'=>''];
    $query1="select * from userteacher where UserID='".$UserID."'";
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if(empty($ImgPassport)){
            $ImgPassport=$tg->ImgPassport;
        }
        $CreateDate=date("Y-m-d H:i:s",time());
        $query="UPDATE userteacher set WorkID='".$WorkID."',WorkingName='".$WorkingName."',TeachType='".$TeachType."',Free='".$Free."'
        ,MonMorning='".$MonMorning."',MonAfter='".$MonAfter."',MonNight='".$MonNight."',TueMorning='".$TueMorning."',TueAfter='".$TueAfter."'
        ,TueNight='".$TueNight."',WeMorning='".$WeMorning."',WeAfter='".$WeAfter."',WeNight='".$WeNight."',ThuMorning='".$ThuMorning."',ThuAfter='".$ThuAfter."'
        ,ThuNight='".$ThuNight."',FriMorning='".$FriMorning."',FriAfter='".$FriAfter."',FriNight='".$FriNight."',SatMorning='".$SatMorning."'
        ,SatAfter='".$SatAfter."' ,SatNight='".$SatNight."',SunMorning='".$SunMorning."',SunAfter='".$SunAfter."',SunNight='".$SunNight."'
        ,ImgPassport='".$ImgPassport."',TitleView='".$TitleView."',IdTitle='".$IdTitle."',UpdateDate='".$CreateDate."'
        ,Orther='".$Orther."',School='".$School."',Major='".$Major."',Graduationyear='".$Graduationyear."',Workplace='".$Workplace."' where ID='".$tg->ID."'";
        $insert=$this->db->query($query);
        $result=['kq'=>true];
    }

    return $result;
}
function InsertTeacher($UserID,$WorkID,$WorkingName,$TeachType,$Free,$MonMorning,$MonAfter,$MonNight,$TueMorning,$TueAfter,$TueNight,
    $WeMorning,$WeAfter,$WeNight,$ThuMorning,$ThuAfter,$ThuNight,$FriMorning,$FriAfter,$FriNight,$SatMorning,$SatAfter
    ,$SatNight,$SunMorning,$SunAfter,$SunNight,$ImgEdu,$ImgPassport,$Vip,$IdTitle,$Idlopday,$TitleView,$Orther,$School,$Major,$Graduationyear,$Workplace)
{   
    // var_dump($TitleView);
    // die();
    $result=['kq'=>false,'data'=>''];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query="Insert into userteacher(UserID,WorkID,WorkingName,TeachType,Free,MonMorning,MonAfter,MonNight,TueMorning,TueAfter,TueNight,
    WeMorning,WeAfter,WeNight,ThuMorning,ThuAfter,ThuNight,FriMorning,FriAfter,FriNight,SatMorning,SatAfter,SatNight,SunMorning,SunAfter,SunNight,
    ImgEdu,ImgPassport,Vip,IdTitle,IdLopday,TitleView,UpdateDate,Orther,School,Major,Graduationyear,Workplace)VALUES('".$UserID."','".$WorkID."','".$WorkingName."',
    '".$TeachType."','".$Free."','".$MonMorning."','".$MonAfter."','".$MonNight."','".$TueMorning."','".$TueAfter."','".$TueNight."',
    '".$WeMorning."','".$WeAfter."','".$WeNight."','".$ThuMorning."','".$ThuAfter."','".$ThuNight."','".$FriMorning."','".$FriAfter."','".$FriNight."',
    '".$SatMorning."','".$SatAfter."','".$SatNight."','".$SunMorning."','".$SunAfter."','".$SunNight."','".$ImgEdu."','".$ImgPassport."'
    ,'".$Vip."','".$IdTitle."','".$Idlopday."','Gia sư ".$TitleView."','".$CreateDate."','".$Orther."','".$School."','".$Major."','".$Graduationyear."','".$Workplace."')";
    $insert=$this->db->query($query);
    $insertid=$this->db->insert_id(); 
    if($insertid > 0){
       $result=['kq'=>true,'data'=>$insertid]; 
   }  
   return $result;
}
function UpdateClass($classid,$ClassTitle,$SubjectID,$SubjectName,$TopicArr,$Money,$Hours,$LearnType,$Phone,$City,$Address,$CMonMorning,$CMonAfter,$CMonNight
    ,$CTueMorning,$CTueAfter,$CTueNight,$CWeMorning,$CWeAfter,$CWeNight,$CThuMorning,$CThuAfter,$CThuNight,$CFriMorning,$CFriAfter,$CFriNight,$CSatMorning
    ,$CSatAfter,$CSatNight,$CSunMorning,$CSunAfter,$CSunNight,$DescClass,$InWeek,$Student,$TeacherSex,$ExpectedDate,$TeachType,$IdLopDay,$District)
{
    $CreateDate=date("Y-m-d H:i:s",time());
    $result=['kq'=>false,'data'=>0];
    $query="UPDATE teacherclass set ClassTitle='".$ClassTitle."',SubjectID='".$SubjectID."',SubjectName='".$SubjectName."',TopicArr='".$TopicArr."',Money='".$Money."',Hours='".$Hours."'
    ,LearnType='".$LearnType."',Phone='".$Phone."',City='".$City."',Address='".$Address."',CMonMorning='".$CMonMorning."',CMonAfter='".$CMonAfter."',
    CMonNight='".$CMonNight."',CTueMorning='".$CTueMorning."',CTueAfter='".$CTueAfter."',CTueNight='".$CTueNight."',CWeMorning='".$CWeMorning."',CWeAfter='".$CWeAfter."',
    CWeNight='".$CWeNight."',CThuMorning='".$CThuMorning."',CThuAfter='".$CThuAfter."',CThuNight='".$CThuNight."',CFriMorning='".$CFriMorning."',CFriAfter='".$CFriAfter."',CFriNight='".$CFriNight."',CSatMorning='".$CSatMorning."',
    CSatAfter='".$CSatAfter."',CSatNight='".$CSatNight."',CSunMorning='".$CSunMorning."',CSunAfter='".$CSunAfter."',CSunNight='".$CSunNight."',UpdateDate='".$CreateDate."',DescClass='".$DescClass."',InWeek='".$InWeek."',Student='".$Student."',TeacherSex='".$TeacherSex."',
    TeachType='".$TeachType."',IdLopDay='".$IdLopDay."',District='".$District."' Where ClassID='".$classid."'";
    $insert=$this->db->query($query);

    if($insert){
       $result=['kq'=>true,'data'=>$insertid]; 
   }         
   return $result;
}
function refreshclass($userid)
{
    $queryket="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($queryket);
    $result=['kq'=>false,'data'=>0];
    $date = date("Y-m-d H:i:s");
    $CreateDate=date("Y-m-d H:i:s",time());
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if((!empty($tg->UpdateDate) || (strtotime($tg->UpdateDate . "+1440 minutes") < time()))||(empty($tg->UpdateDate))){
            $query="UPDATE users set UpdateDate='".$CreateDate."' where UserID='".$userid."'";
            $update=$this->db->query($query);
            $result= ['kq' => true, 'data'=>0]; 
            return $result;
        }else{
            return $result;
        }
    }
}
function InsertClass($ClassTitle,$SubjectID,$SubjectName,$TopicArr,$Money,$Hours,$LearnType,$Phone,$City,$Address,$CMonMorning,$CMonAfter,$CMonNight
    ,$CTueMorning,$CTueAfter,$CTueNight,$CWeMorning,$CWeAfter,$CWeNight,$CThuMorning,$CThuAfter,$CThuNight,$CFriMorning,$CFriAfter,$CFriNight,$CSatMorning
    ,$CSatAfter,$CSatNight,$CSunMorning,$CSunAfter,$CSunNight,$CreateBy,$DescClass,$InWeek,$Student,$TeacherSex,$ExpectedDate,$UserID,$TeachType,$IdLopDay,$quanhuyen)
{
    $CreateDate=date("Y-m-d H:i:s",time());
    $result=['kq'=>false,'data'=>0];
    $query="insert into teacherclass(ClassTitle,SubjectID,SubjectName,TopicArr,Money,Hours,LearnType,Phone,City,Address,CMonMorning,CMonAfter,
    CMonNight,CTueMorning,CTueAfter,CTueNight,CWeMorning,CWeAfter,CWeNight,CThuMorning,CThuAfter,CThuNight,CFriMorning,CFriAfter,CFriNight,CSatMorning,
    CSatAfter,CSatNight,CSunMorning,CSunAfter,CSunNight,Active,Hot,Vip,CreateDate,UpdateDate,CreateBy,DescClass,InWeek,Student,TeacherSex,ExpectedDate,UserID,
    TeachType,IdLopDay,District)VALUES('".$ClassTitle."','".$SubjectID."','".$SubjectName."','".$TopicArr."','".$Money."','".$Hours."','".$LearnType."'
    ,'".$Phone."','".$City."','".$Address."','".$CMonMorning."','".$CMonAfter."','".$CMonNight."','".$CTueMorning."'
    ,'".$CTueAfter."','".$CTueNight."','".$CWeMorning."','".$CWeAfter."','".$CWeNight."','".$CThuMorning."','".$CThuAfter."','".$CThuNight."'
    ,'".$CFriMorning."','".$CFriAfter."','".$CFriNight."','".$CSatMorning."','".$CSatAfter."','".$CSatNight."','".$CSunMorning."','".$CSunAfter."'
    ,'".$CSunNight."','1','0','0','".$CreateDate."','".$CreateDate."','".$CreateBy."','".$DescClass."','".$InWeek."','".$Student."','".$TeacherSex."'
    ,'".$CreateDate."','".$UserID."','".$TeachType."','".$IdLopDay."','".$quanhuyen."')";
    $insert=$this->db->query($query);
    $insertid=$this->db->insert_id(); 
    if($insertid > 0){
       $result=['kq'=>true,'data'=>$insertid]; 
   }         
   return $result;
}
function InsertClassMeta($ClassID,$MetaDesc,$MetaTitle,$MetaKeywork,$Latitude,$Longitude)
{
    $result=['kq'=>false,'data'=>0];
    $query="insert into teacherclassmeta(ClassID,MetaDesc,MetaTitle,MetaKeywork,Latitude,Longitude)
    VALUES('".$ClassID."','".$MetaDesc."','".$MetaTitle."','".$MetaKeywork."','".$Latitude."','".$Longitude."')";
    $insert=$this->db->query($query);
    $insertid=$this->db->insert_id(); 
    if($insertid > 0){
       $result=['kq'=>true,'data'=>$insertid]; 
   }         
   return $result;
}
function insertsendnotifymoney($UserID,$TransferType,$TransferBank,$CustomerName,$CustomerBN,$TransferDate,$ReceiveBank,$Amount,$Note)
{
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query="insert into sendnotifymonney(UserID,TransferType,TransferBank,CustomerName,CustomerBN,TransferDate,ReceiveBank,Amount,CreateDate,Status,Note)
    VALUES('".$UserID."','".$TransferType."','".$TransferBank."','".$CustomerName."','".$CustomerBN."','".$TransferDate."','".$ReceiveBank."','".floatval($Amount)."','".$CreateDate."','0','".$Note."')";
    $insert=$this->db->query($query);
    $insertid=$this->db->insert_id(); 
    if($insertid > 0){
       $result=['kq'=>true,'data'=>'']; 
   }         
   return $result;
}
function InsertLogSms($Code,$Statuscode,$Type)
{
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query="insert into smslog(Code,Statuscode,CreateDate,Type)VALUES('".$Code."','".$Statuscode."','".$CreateDate."','".$Type."')";
    $insert=$this->db->query($query);
    $insertid=$this->db->insert_id(); 
    if($insertid > 0){
       $result=['kq'=>true,'data'=>$insertid]; 
   }  
   return $result;
}
function GetListdistrictbycity()
{
    $query="select * from city2 where cit_parent <>0";
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
function GetBankUsed()
{
    $query="select * from banktable where `Active` =1";
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
function GetListBank()
{
    $query="select * from banktable";
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
function getbalace($userid)
{
    $query="select * from balance where UserId='".$userid."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $tg1=$db_qr->row();           
    }
    return $tg1;
}
function getcountclassvsuser($userid)
{
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ
    $query="select UserID,
    SUM(CASE WHEN c1.Active = 1 THEN 1 ELSE 0 END) as lopdaday,
    SUM(CASE WHEN c1.Active = 0 THEN 1 ELSE 0 END) as lopdenghiday
    from uservsclass as c1 where c1.UserID='".$userid."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $tg1=$db_qr->row();           
    }
    return $tg1;
}
function getcountclasssave($userid)
{
    $query="select COUNT(ClassID) as solopdaluu,UserID from usersaveclass where UserID='".$userid."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $tg1=$db_qr->row();           
    }
    return $tg1;
}
function getcountclassinvite($user){
    $query="select COUNT(ClassID) as solopdamoi,UserID from classvsuser where UserID='".$user."'";
    $db_qr = $this->db->query($query); 
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $tg1=$db_qr->row();           
    }
        //var_dump($tg1);die();
    return $tg1;
}
function adduservsclass($userid,$classid,$active){
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."'";
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() <= 0)
    {
        $query="insert into uservsclass(UserID,ClassID,Active)VALUES('".$userid."','".$classid."','".$active."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id(); 
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid]; 
       }  
   }
   return $result;
}
function adduservsusers($userid,$saveuser,$active){
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$saveuser."'";
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() <= 0)
    {
        $query="insert into usersaveuser(UserID,SaveUserID,Active,Createdate)VALUES('".$userid."','".$saveuser."','".$active."','".$CreateDate."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id(); 
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid]; 
       }  
   }
   return $result;
}
function addclassvsuser($userid,$classid,$active){
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query1="select * from classvsuser where UserID ='".$userid."' and ClassID='".$classid."'";
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() <= 0)
    {
        $query="insert into classvsuser(UserID,ClassID,CreateDate,Active)VALUES('".$userid."','".$classid."','".$CreateDate."','".$active."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id(); 
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid]; 
       }  
   }
   return $result;
}
function addlogpoint($UserID,$Type,$price,$CreateBy,$Trace)
{
    $result=['kq'=>false,'data'=>0];                
    $CreateDate=date("Y-m-d H:i:s",time());
    $query="insert into logpoint(UserID,Type,Status,Price,CreateDate,UpdateDate,CreateBy,Trace)VALUES('".$UserID."','".$Type."','1','".$price."','".$CreateDate."','".$CreateDate."','1','".$Trace."')";
    $insert=$this->db->query($query);
    if($insert){
        $result=['kq'=>true]; 
    }
    return $result;
}
function getlogpoint($userid,$trace)
{
    $query="select * from logpoint where UserID='".$userid."' and Trace='".$trace."' and Type=2";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
            //foreach($db_qr->result() as $itemcat)
            //{
        $tg1=1;    
            //}  
    }
    return $tg1;
}
function getpointconfig()
{
    $query="SELECT * from configpoint";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
            //foreach($db_qr->result() as $itemcat)
            //{
        $tg1=$db_qr->row();    
            //}  
    }
    return $tg1;
}
function addviewuserid($userid)
{
    $query="select * from viewuser where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1=0;
    if($db_qr->num_rows() > 0)
    {
        $result=$db_qr->row();
        $query1="update viewuser set View=(View+ 1) where ID='".$result->ID."'";
        $insert=$this->db->query($query1);
        if($insert){
            $tg1=$result->View + 1;
        }    

    }else{
        $query1="insert viewuser(UserID,View)values('".$userid."','1')";
        $insert=$this->db->query($query1);
        $tg1=1;
    }
    return $tg1;
}
function getviewuserid($userid)
{
    $query="select * from viewuser where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1=0;
    if($db_qr->num_rows() > 0)
    {
        $result=$db_qr->row();
        $tg1=$result->View;
    }
    return $tg1;
}
function addviewclass($userid)
{
    $query="select * from viewclass where ClassID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1=0;
    if($db_qr->num_rows() > 0)
    {
        $result=$db_qr->row();
        $query1="update viewclass set View=(View+ 1) where ID='".$result->ID."'";
        $insert=$this->db->query($query1);
        if($insert){
            $tg1=$result->View + 1;
        }    

    }else{
        $query1="insert viewclass(ClassID,View)values('".$userid."','1')";
        $insert=$this->db->query($query1);
        $tg1=1;
    }
    return $tg1;
}
function getviewclassid($userid)
{
    $query="select * from viewclass where ClassID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1=0;
    if($db_qr->num_rows() > 0)
    {
        $result=$db_qr->row();
        $tg1=$result->View;
    }
    return $tg1;
}
function countteacherfitclass($userid)
{
    $query="SELECT COUNT(*) as sogiaovien from users where UserType=1 and UserID in(select DISTINCT UserID from usersubject as u where u.SubjectID in(select SubjectID from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)))";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
            //foreach($db_qr->result() as $itemcat)
            //{
        $tg1=$db_qr->row();    
            //}  
    }
    return $tg1;
}
function countteachersave($userid)
{
    $query="select COUNT(*) as sogcluu from usersaveuser where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
            //foreach($db_qr->result() as $itemcat)
            //{
        $tg1=$db_qr->row();    
            //}  
    }
    return $tg1;
}
function countteacheinvite($userid)
{
    $query="select COUNT(*) as giasumoiday from classvsuser where ClassID in (select ClassID from teacherclass where UserID='".$userid."')";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
            //foreach($db_qr->result() as $itemcat)
            //{
        $tg1=$db_qr->row();    
            //}  
    }
    return $tg1;
}
function countclassnotteacherbyuserid($userid)
{
    $query="select count(*) as solophoc from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $itemcat=$db_qr->row();
        $tg1=$itemcat->solophoc;    

    }
    return $tg1;
}

function getlistteachersavebyuserid($userid)
{
    $query="select u.*,t.*,t1.CreateDate as ngaymoi from users as u JOIN userteacher as t on u.UserID=t.UserID 
    join (select * from classvsuser where ClassID in (select ClassID from teacherclass where UserID='".$userid."')) as t1 on t1.UserID=u.UserID
    order by ngaymoi desc limit 0,5";
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
function getpageteachersuggestbyuserid($userid,$page)
{
    $query="select u.*,t.*,t1.Active,t1.Note,t1.ClassID from users as u join userteacher as t on t.UserID=u.UserID
    join uservsclass as t1 on t1.UserID=u.UserID where t1.ClassID in (select ClassID from teacherclass where UserID='".$userid."') and t1.Type=0
    order by u.CreateDate desc";
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
function getpageteachersavebyuserid($userid,$page)
{
    $perpage=6;
    $startrow=($page-1)*$perpage;
    $query="select u.*,t.*,t1.CreateDate as ngaymoi,t1.Note from users as u join userteacher as t on u.UserID=t.UserID join (select * from usersaveuser where UserID='".$userid."') as t1 on u.UserID=t1.SaveUserID
    order by ngaymoi desc limit $startrow,$perpage";

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
function getpageteacherinvitebyuserid($userid,$page)
{
    $perpage=6;
    $startrow=($page-1)*$perpage;
    $query="select u.*,t.*,t1.CreateDate as ngaymoi,t1.Active from users as u JOIN userteacher as t on u.UserID=t.UserID 
    join (select * from classvsuser where ClassID in (select ClassID from teacherclass where UserID='".$userid."')) as t1 on t1.UserID=u.UserID
    order by ngaymoi desc limit $startrow,$perpage";
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
function getpageteacherfitbyuserid($userid,$page)
{
    $perpage=6;
    $startrow=($page-1)*$perpage;
    $query="SELECT t.*,u.* from users as t join userteacher as u on t.UserID=u.UserID where t.UserType=1 and t.UserID in(select DISTINCT UserID from usersubject as u where u.SubjectID in(select SubjectID from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)))
    order by t.CreateDate desc limit $startrow,$perpage";
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
function getlistteacherinvitebyuserid($userid)
{
    $query="select u.*,t.*,t1.CreateDate as ngayluu from users as u join userteacher as t on u.UserID=t.UserID join (select * from usersaveuser where UserID='".$userid."') as t1 on u.UserID=t1.SaveUserID
    limit 0,5";
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
function Getlistclassnotteacherbyuserid($userid)
{
    $query="select * from teacherclass as t where t.UserID='".$userid."' and t.ClassID not in (select u.ClassID from uservsclass as u where u.Active>0)";
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
function Getclassbyuserid($classid)
{
    $query="select ClassTitle from teacherclass where ClassID = '".$classid."'";
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
function gettopclassbyuser($user){

    $query1="select t.ClassTitle,t.ClassID,t.LearnType,c.UserId as giaovien,c.CreateDate as ngaynhan from teacherclass as t LEFT JOIN classvsuser as c on t.ClassID=c.ClassID where c.UserID ='".$user."' order by c.CreateDate desc limit 5";
    $db_qr = $this->db->query($query1);
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
function getpoint($user){

    $query1="SELECT Price FROM logpoint WHERE UserID = '".$user."'";
    $db_qr = $this->db->query($query1);
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
function addusersaveclass($userid,$classid){
    $result=['kq'=>false,'data'=>0];
    $CreateDate=date("Y-m-d H:i:s",time());
    $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() <= 0)
    {
        $query="insert into usersaveclass(UserID,ClassID,CreateDate)VALUES('".$userid."','".$classid."','".$CreateDate."')";
        $insert=$this->db->query($query);
        $insertid=$this->db->insert_id(); 
        if($insertid > 0){
           $result=['kq'=>true,'data'=>$insertid]; 
       }  
   }
   return $result;
}
function getusersubject($userid)
{
    $query="select DISTINCT UserID,SubjectID,SubjectName from usersubject where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1="";
    $tg2="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat->SubjectID;
            $tg2[]=$itemcat->SubjectName;    
        }  
    }
    return ['id'=>$tg1,'name'=>$tg2];
}
function getusertopic($userid)
{

    $query="select DISTINCT UserID,TopicID,TopicName from usersubject where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1="";

    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat->TopicID;

        }  
    }
    return $tg1;
}
function updateuservsclass($userid,$classid,$active,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
    $result=['kq'=>false,'data'=>''];
    $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        if($tg->Type==0){
            $query="UPDATE uservsclass set `Active`='".intval($active)."', `Note`='".$note."' where IDReg='".$tg->IDReg."'";
            $insert=$this->db->query($query);
            
            $result=['kq'=>true,'data'=>''];
        }else{
            $result=['kq'=>false,'data'=>true];
        }

    }
    return $result;
}
function updateusersaveuser($userid,$usersave,$note){
    $result=['kq'=>false,'data'=>''];
    $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$usersave."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        $query="UPDATE usersaveuser set `Note`='".$note."' where IDuser='".$tg->IDuser."'";
        $insert=$this->db->query($query);
        $result=['kq'=>true,'data'=>''];                          
    }
    return $result;
}
function updateuserssaveclass($userid,$classid,$note){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
    $result=['kq'=>false,'data'=>''];
    $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        $query="UPDATE usersaveclass set `Note`='".$note."' where IDSave='".$tg->IDSave."'";
        $insert=$this->db->query($query);
        $result=['kq'=>true,'data'=>''];                          
    }
    return $result;
}
function deleteuserssaveclass($userid,$classid){
        //0 de nghi day,1 dang day,2 đã dừng,3 tạm nghỉ, 4 hoan thanh
    $result=['kq'=>false,'data'=>''];
    $query1="select * from usersaveclass where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        $query="delete from usersaveclass where IDSave='".$tg->IDSave."'";
        $insert=$this->db->query($query);
        $result=['kq'=>true,'data'=>''];                          
    }
    return $result;
}
function deleteusersaveuser($userid,$usersaveid){
    $result=['kq'=>false,'data'=>''];
    $query1="select * from usersaveuser where UserID ='".$userid."' and SaveUserID='".$usersaveid."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        $query="delete from usersaveuser where IDuser='".$tg->IDuser."'";
        $insert=$this->db->query($query);
        $result=['kq'=>true,'data'=>''];                          
    }
    return $result;
}
function deleteteacherclass($ClassID){
    $result=['kq'=>false,'data'=>''];
    $query1="DELETE FROM teacherclass where ClassID = '".$ClassID."'";
    $db_qr = $this->db->query($query1);
    if($db_qr)
    {
        $result=['kq'=>true,'data'=>''];                          
    }
    return $result;
}
function updateclassvsusers($userid,$classid,$active,$note){
        //0 mời dạy,1 đồng ý,2 không đồng ý
    $result=['kq'=>false,'data'=>''];
    $query1="select * from classvsuser where UserID ='".$userid."' and ClassID='".$classid."'";
        //var_dump($query1);die();
    $db_qr = $this->db->query($query1);
    if($db_qr->num_rows() > 0)
    {
        $tg=$db_qr->row();
        $query1="select * from uservsclass where UserID ='".$userid."' and ClassID='".$classid."' and `Type`=1";
            //var_dump($query1);die();
        $db_qr = $this->db->query($query1); 
        if($db_qr->num_rows() > 0)
        {
            $tg1=$db_qr->row();
            $query="UPDATE uservsclass set `Active`='".intval($active)."', `Note`='".$note."' where IDReg='".$tg1->IDReg."'";
            $insert=$this->db->query($query);
        }else{
            if($active==1){
                $query="insert into uservsclass(UserID,ClassID,Active,Note,Type)VALUES('".$userid."','".$classid."','".intval($active)."','".$note."',1)";
                $insert=$this->db->query($query);
            }
        }           
        $query="UPDATE classvsuser set `Active`='".intval($active)."', `Note`='".$note."' where IDSave='".$tg->IDSave."'";
        $insert=$this->db->query($query);            
        $result=['kq'=>true,'data'=>$insertid];               
    }
    return $result;
}
function updatenewpass($userid,$oldpass,$newpass){
    $query="select * from users where UserID='".$userid."' and `Password`='".md5($oldpass)."'";
    $db_qr = $this->db->query($query);
    if($db_qr->num_rows() == 0)
    {
        $flag=false;
    }
    else if($db_qr->num_rows() > 0)
    {
        $query1="UPDATE `users` SET `Password` = '".md5($newpass)."' WHERE UserID = '".$userid."'";
        $tg1=$this->db->query($query1);
        $flag=true;
    }
    return $flag;
}
function updateissearchuser($userid,$issearch)
{
    $query="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $flag=false;
    if($db_qr->num_rows() > 0)
    {
        $query1="UPDATE `users` SET `IsSearch` = '".intval($issearch)."' WHERE UserID = '".$userid."'";
        $tg1=$this->db->query($query1);
        $flag=true;
    }
    return $flag;
}
function GetUserInfoByUserID($userid)
{
    $query="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $flag="";
    if($db_qr->num_rows() > 0)
    {
        $flag=$db_qr->row();
    }
    return $flag;
}
function updatenofityuser($userid,$notify)
{
    $query="select * from users where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $flag=false;
    if($db_qr->num_rows() > 0)
    {
        $query1="UPDATE `users` SET `Notify` = '".intval($notify)."' WHERE UserID = '".$userid."'";
        $tg1=$this->db->query($query1);
        $flag=true;
    }
    return $flag;
}
function getfulluservsclass($userid)
{
    $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from uservsclass) t1 on t1.ClassID=t.ClassID
    where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
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
function getfullclassvsuser($userid)
{
    $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from classvsuser) t1 on t1.ClassID=t.ClassID
    where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
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
function getlistclassbyuser($userid,$page)
{
    $perpage=6;
    $startrow=($page-1)*$perpage;
    $query="select t.*,t1.MetaDesc,t1.MetaTitle,t1.MetaKeywork,t1.Latitude,t1.Longitude
    from teacherclass as t LEFT JOIN teacherclassmeta as t1 on t1.ClassID=t.ClassID where t.UserID='".$userid."' order by t.CreateDate desc
    limit $startrow,$perpage";
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
function getcountclassbyuser($userid)
{
    $query="select COUNT(*) as solophoc from teacherclass where UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        $tg1=$db_qr->row();              
    }
    return $tg1;
}
function getfulluservsclassactive($userid)
{
    $query="select t.*,u.`Name`,t1.Active as daday from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from uservsclass where Active=1 or active=2) t1 on t1.ClassID=t.ClassID
    where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
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
function getfullteachersaveclass($userid)
{
    $query="select t.*,u.`Name`,t1.Note as ghichu from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from usersaveclass) t1 on t1.ClassID=t.ClassID
    where t1.UserID='".$userid."' ORDER BY t.CreateDate desc";
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
function getfilterteachersaveclass($userid,$monhoc,$findkey,$ngaythang)
{

    $query="select t.*,u.`Name`,t1.Note as ghichu from teacherclass as t LEFT JOIN users as u on t.UserID=u.UserID left join (select * from usersaveclass) t1 on t1.ClassID=t.ClassID
    where t1.UserID='".$userid."'";
    if(intval($monhoc)>0 ){
        $query .=" and t.SubjectID ='".intval($monhoc)."'";
    }
    if($findkey !=''){
        $query .=" and t.ClassTitle like '%".str_replace(' ','%',$findkey)."%'";
    }
    if($ngaythang != ''){
        $tg=explode('-',$ngaythang);
        $strngaythang=$tg[2]."-".$tg[1]."-".$tg[0];
        $query .=" and t.CreateDate > '".$strngaythang."'";
    }
    $query .=" ORDER BY t.CreateDate desc";
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
function GetInfoTeacher($userid)
{
    $query="select * from users as u left join userteacher as ut on u.UserID=ut.UserID where u.UserID='".$userid."'";
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
     $tg1=$db_qr->row();
 }
 return $tg1;
}
function getprovincebykey($key){
   $query1="select t.cit_id,t.cit_name from city as t";
   if($key !=''){
    $query1.=" where t.cit_name like '%".$key."%'";
}
$db_qr = $this->db->query($query1);
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
function CreateSendMail($toFrom,$toAddress,$ccAddress,$bccAddress,$subject,$body) {	
 $int_type = 16;
    	//16 kich hoat tai khoan ung vien CV
 $MailContent = $body;
 $SendFrom = $toFrom;
 $SendTo = $toAddress;
 $Status = 0;
 $Subject = $subject;
 $Type = $type;
 $timesend = date("Y-m-d H:i:s",time());
    	//send mail to hunghabay
 $this->SendmailHunghapay("D66","C97A94C1A7992D87B0B141170DBBAB7A",$toAddress,$subject,$body,$int_type);
}
function SendmailHunghapay($partner,$pass,$toAddress,$subject,$body,$int_type)
{
	   $soapUrl = "http://quanlymails.timviec365.vn/SendMail.asmx?op=CreateMail"; // asmx URL of WSDL
	   // xml post structure
	   $xml_post_string = '<?xml version="1.0" encoding="utf-8"?>
	   <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
      <soap:Body>
      <CreateMail xmlns="http://tempuri.org/">
      <partner>'.$partner.'</partner>
      <pass>'.$pass.'</pass>
      <fromAddress>no-reply@timviec365.com.vn</fromAddress>
      <toAddress>'.$toAddress.'</toAddress>
      <subject>'.$subject.'</subject>
      <body>'.$body.'</body>
      <type>'.$int_type.'</type>
      </CreateMail>
      </soap:Body>
	   </soap:Envelope>';   // data from the form, e.g. some ID number
	   $headers = array(
        "Content-Type: text/xml; charset=utf-8",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "Content-length: ".strlen($xml_post_string),
	   ); //SOAPAction: your op URL
	   $url = $soapUrl;
	   // PHP cURL  for https connection with auth
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	   curl_setopt($ch, CURLOPT_URL, $url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
	   curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	   curl_setopt($ch, CURLOPT_POST, true);
	   curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string); // the SOAP request
	   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	   // converting
	   $response = curl_exec($ch);
	   curl_close($ch);
	}
    function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->CharSet = "UTF-8";
        $mail->SMTPSecure = 'tls';                
        $mail->Host = 'mail.24hpay.net';         
        $mail->Port = 587;                         
        $mail->Username = GUSER;  
        $mail->Password = GPWD;           
        $mail->SetFrom($from, $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
        if(!$mail->Send())
        {
            $message = 'Gửi mail bị lỗi: '.$mail->ErrorInfo; 
            return false;
        } 
        else 
        {
            $message = 'Thư của bạn đã được gửi đi ';
            return true;
        }
    }


    function ListTopKeywork(){
        $query = "SELECT * FROM keywork ORDER BY RAND() LIMIT 20";
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
    function GetListClassBySearch($keywork,$subject,$class,$topic,$place,$type,$sex,$page,$perpage)
    {
       $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
       ,u.Email
       ,u.CityID
       ,u.CityName,u.`Image`
       ,u.Address as diachidk
       ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
       from teacherclass as t left join users as u on t.UserID=u.UserID
       left JOIN (select ClassID,
       SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
       SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
       from uservsclass as uc
       GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
       $query.=" where t.ClassTitle <> '' and u.IsSearch=1 and t.`Active`=1 and u.UserType = 0";
       if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";
    }
    if(!empty($class)){
       $query.=" and FIND_IN_SET('".intval($class)."',t.IdLopDay)";
    }
    if(intval($place)>0 ){
        $query.=" and t.City ='".intval($place)."'";
    }
    if(intval($subject) >0){
        $query.=" and t.SubjectID='".intval($subject)."'";
    }
    // if(intval($topic)>0){
    //     $query.=" and FIND_IN_SET('".intval($topic)."',t.TopicArr)";
    // }
    // if(intval($sex)>0){
    //     $query.=" and FIND_IN_SET('".intval($sex)."',t.TeacherSex)";
    // }
    // if(intval($type)>0){
    //     $query.=" and FIND_IN_SET('".intval($type)."',t.LearnType)";
    // }
    $query.=" order by t.ClassID desc";
    $query.=" limit ".$page.",".$perpage;
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
function ListClassBySearchHeader($keywork,$subject,$class,$place,$district,$order,$page,$perpage)
    {
       $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
       ,u.Email
       ,u.CityID
       ,u.CityName,u.`Image`
       ,u.Address as diachidk
       ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
       from teacherclass as t left join users as u on t.UserID=u.UserID
       left JOIN (select ClassID,
       SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
       SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
       from uservsclass as uc
       GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
       $query.=" where t.ClassTitle <> '' and u.IsSearch=1 and t.`Active`=1 and u.UserType = 0";
       if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";

    }
    if(!empty($class)){
        $query.=" and FIND_IN_SET('".intval($class)."',t.IdLopDay)";
    }
    if(intval($subject) >0){
        $query.=" and t.SubjectID='".intval($subject)."'";
    }
    if(intval($place)>0 ){
        $query.=" and t.City ='".intval($place)."'";
    }
    if(intval($district) > 0){
        $query.=" and t.District ='".intval($district)."'";
     // $query.=" and u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
     // $query.=")";
    }
    $query.=" order by t.ClassID desc";
    $query.=" limit ".$page.",".$perpage;
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
function ListClassBySearchHeader1($keywork,$subject,$class,$place,$district,$order,$page,$perpage)
    {
       $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
       ,u.Email
       ,u.CityID
       ,u.CityName,u.`Image`
       ,u.Address as diachidk
       ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
       from teacherclass as t left join users as u on t.UserID=u.UserID
       left JOIN (select ClassID,
       SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
       SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
       from uservsclass as uc
       GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
       $query.=" where t.ClassTitle <> '' and u.IsSearch=1 and t.`Active`=1 and u.UserType = 0";
       if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";

    }
    if(!empty($class)){
        $query.=" and FIND_IN_SET('".intval($class)."',t.IdLopDay)";
    }
    if(intval($subject) >0){
        $query.=" and t.SubjectID='".intval($subject)."'";
    }
    if(!empty($place)){
        $query.=" and t.Address like '%".$place."%'";
    }
    if(intval($district) > 0){
        $query.=" and t.District ='".intval($district)."'";
     // $query.=" and u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
     // $query.=")";
    }
    $query.=" order by t.ClassID desc";
    $query.=" limit ".$page.",".$perpage;
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
function GetListClassBySearchTotal($keywork,$subject,$class,$topic,$place,$type,$sex)
{
   $query="SELECT t.*,u.`Name`,u.Phone as sodienthoaidk
   ,u.Email
   ,u.CityID
   ,u.CityName,u.`Image`
   ,u.Address as diachidk
   ,u.Description,IFNULL(t1.denghiday,0) as denghiday,IFNULL(t1.dongyday,0) as dongyday
   from teacherclass as t left join users as u on t.UserID=u.UserID
   left JOIN (select ClassID,
   SUM(CASE WHEN uc.Active = 0 THEN 1 ELSE 0 END) AS denghiday,
   SUM(CASE WHEN uc.Active = 1 THEN 1 ELSE 0 END) AS dongyday
   from uservsclass as uc
   GROUP BY ClassID) t1 on t1.ClassID=t.ClassID";
   $query.=" where t.ClassTitle <> '' and t.`Active`=1";
   if(!empty($keywork) && strtolower($keywork)!='all'){
    $query.=" and t.ClassTitle like '%".str_replace(' ','%',$keywork)."%'";
}
if(!empty($class)){
    $query.=" and FIND_IN_SET('".intval($class)."',t.IdLopDay)";
}
if(intval($place)>0 ){
    $query.=" and t.City ='".intval($place)."'";
}
if(intval($subject) >0){
    $query.=" and t.SubjectID='".intval($subject)."'";
}
if(intval($topic)>0){
    $query.=" and FIND_IN_SET('".intval($topic)."',t.TopicArr)";
}
if(intval($sex)>0){
    $query.=" and FIND_IN_SET('".intval($sex)."',t.TeacherSex)";
}
if(intval($type)>0){
    $query.=" and FIND_IN_SET('".intval($type)."',t.LearnType)";
}
$db_qr = $this->db->query($query);
// echo $this->db->last_query();
// die();
$tg1=0;
if($db_qr->num_rows() > 0)
{
    $tg1=$db_qr->num_rows();
}
return $tg1;
}

function GetListTeacherBySearchIndex($keywork,$subject,$class,$topic,$place,$district,$type,$sex,$page,$perpage)
{

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
    where u.Email <>'' and u.`Delete`=0 and u.Active=1 and u.UserType=1";
    if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keywork)."%' or u.`Name` like '%".str_replace(' ','%',$keywork)."%')";
    }
    if(!empty($class)){
        $query.=" and (ut.TitleView like '%".str_replace(' ','%',$class)."%' or u.`Name` like '%".str_replace(' ','%',$class)."%')";
    }
    if(intval($place) > 0){
        $query.=" and u.CityID='".intval($place)."'";
    }
    if(intval($type) > 0){
        $query.=" and ut.WorkID='".intval($type)."'";
    }
    if(intval($sex)>0){
        $query.=" and u.sex ='".intval($sex)."'";
    }
    if(intval($subject)>0){
        $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."'";
        if(intval($topic)>0){
            $query.=" and TopicID='".intval($topic)."'";
        }
        $query.=")";
    }
        //var_dump($query);die();
    $total=$this->db->query($query)->num_rows();
    $query.=" LIMIT ".$page.",".$perpage;
    $db_qr = $this->db->query($query);
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;
        }
    }
    return array('total'=>$total,'data'=>$tg1);
}   

function GetListTeacherBySearch($keywork,$subject,$classname,$topic,$place,$district,$type,$sex,$order,$page,$perpage)
{   

    $query="SELECT ut.*,u.`Name`
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
    if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" AND (ut.TitleView like '%".str_replace(' ','%',$keywork)."%' or u.`Name` like '%".str_replace(' ','%',$keywork)."%')";
        
    }
    if(!empty($classname)){
        $query.=" AND u.UserID in ( select DISTINCT UserID from usersubject where TopicName like '%".$classname."%'";
        $query.=")";
        
    }
    if(intval($place) > 0){
        $query.=" AND u.CityID='".intval($place)."'";
    }

    if(intval($type) > 0){
        $query.=" AND ut.WorkID='".intval($type)."'";
    }
    if(intval($sex)>0){
        $query.=" AND u.sex ='".intval($sex)."'";
    }
    if(intval($district) > 0){
     $query.=" AND u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
     $query.=")";
     
    }

    
    if(!empty($subject)){
        $query.=" AND u.UserID in ( select DISTINCT UserID from userteacher where TitleView like '%".$subject."%' or  FIND_IN_SET('".intval($subject)."',IdTitle)";
        if(intval($topic)>0){
            $query.=" AND TopicID='".intval($topic)."'";
        }
        $query.=")";
    }
    // if(!empty($subject) && !empty($classname)){
    //     // $query.=" AND   SubjectID = '".intval($subject)."'";
    //     $query.=")";
    //     var_dump($query);
    //     die();
    // }

    if($order == 'pricelow'){
        $query.=" ORDER BY ut.Free asc";
    }else if($order == 'pricehigh'){
        $query.=" ORDER BY ut.Free desc";
    }else if($order == 'last'){
        $query.=" ORDER BY ut.UserID desc";
    }
    else if($order == '' || $order == 0){
         // $query.=" ORDER BY u.UserID desc";
        $query.=" ORDER BY u.CreateDate desc";
    }
    
    $total=$this->db->query($query)->num_rows();
    $query.=" LIMIT ".$page."".$perpage;
    // $query.=" LIMIT ".$page.",".$perpage;
    $db_qr = $this->db->query($query);
    
   

    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;
        }
    }
return array('total'=>$total,'data'=>$tg1);

} 


function ListTeacherBySearchHeader($keywork,$subject,$class,$place,$district,$order,$page,$perpage)
{   
    
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
     
    if(!empty($keywork) && strtolower($keywork)!='all'){
        $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keywork)."%')";
    }
    if(!empty($class)){
        $query.=" and (ut.TitleView like '%".str_replace(' ','%',$class)."%') or ut.IdTitle like '%".$class."%'";
    }
    if(intval($place) > 0){
        $query.=" and u.CityID='".intval($place)."'";
    }
    if(intval($district) > 0){
        $query.=" and FIND_IN_SET('".intval($district)."',CityID2)";
    }
    if(intval($subject)>0){
        $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."'";
        $query.=")";
    }
    if(strtolower($order)=='last'){
        $query.=" ORDER BY u.CreateDate desc";
    }else if(strtolower($order)=='pricelow'){
        $query.=" ORDER BY ut.Free asc";
    }else if(strtolower($order)=='pricehigh'){
        $query.=" ORDER BY ut.Free desc";
    }

    $total=$this->db->query($query)->num_rows();
    $query.=" LIMIT ".$page.",".$perpage;
    $db_qr = $this->db->query($query);
    // echo $this->db->last_query();
    // die();
    
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;
            
        }
    }
    
    return array('total'=>$total,'data'=>$tg1);

} 


function ListTeacherBySearchHeader1($keywork,$subject,$class,$place,$district,$order,$page,$perpage)
{   
    
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

    // if(!empty($keywork) && strtolower($keywork)!='all'){
    //     $query.=" and (ut.TitleView like '%".str_replace(' ','%',$keywork)."%')";
    // }
    // if(!empty($class)){
    //     $query.=" and (ut.TitleView like '%".str_replace(' ','%',$class)."%') or ut.IdTitle like '%".$class."%'";
    // }
    if(!empty($place)){
        $query.=" and u.CityName like '%".$place."%'";
    }
    if(intval($district) > 0){
        $query.=" and FIND_IN_SET('".intval($district)."',CityID2)";
    }
    if(intval($subject)>0){
        $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."'";
        $query.=")";
    }
    if(strtolower($order)=='last'){
        $query.=" ORDER BY u.CreateDate desc";
    }else if(strtolower($order)=='pricelow'){
        $query.=" ORDER BY ut.Free asc";
    }else if(strtolower($order)=='pricehigh'){
        $query.=" ORDER BY ut.Free desc";
    }

    $total=$this->db->query($query)->num_rows();
    $query.=" LIMIT ".$page.",".$perpage;
    $db_qr = $this->db->query($query);
   
    // echo $this->db->last_query();
    // die();
    
    $tg1="";
    if($db_qr->num_rows() > 0)
    {
        foreach($db_qr->result() as $itemcat)
        {
            $tg1[]=$itemcat;
            
        }
    }
    
    return array('total'=>$total,'data'=>$tg1);

} 

function SearchTeacherByHeader($subject,$class,$place,$district,$order,$page,$perpage)
{
    $query="select ut.*,u.`Name`
    ,u.UserName
    ,u.Phone
    ,u.Email
    ,u.CityID
    ,u.CityName
    ,u.Address
    ,u.Description
    ,u.UserType
    ,u.Image
    from users as u JOIN userteacher as ut on u.UserID=ut.UserID
    where u.Email <>'' and u.Active=1 and u.UserType=1";
    if(!empty($class)){
        $query.=" and (ut.TitleView like '%".str_replace(' ','%',$class)."%')";
    }
    if(intval($place) > 0){
        $query.=" and u.CityID='".intval($place)."'";
    }
    if(intval($district) > 0){
     $query.=" and u.UserID in ( select DISTINCT UserID from userdistrict where cit_id ='".intval($district)."'";
     $query.=")";
    }
    if(intval($subject)>0){
    $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where SubjectID ='".intval($subject)."')";
    
}

        // if(intval($class)>0){
        //     $query.=" and u.UserID in ( select DISTINCT UserID from usersubject where IdClass ='".intval($class)."'";
        //     if(intval($topic)>0){
        //         $query.=" and TopicID='".intval($topic)."'";
        //     }
        //      $query.=")";
        // }
if(strtolower($order)=='last'){
    $query.=" ORDER BY u.CreateDate desc";
}else if(strtolower($order)=='pricelow'){
    $query.=" ORDER BY ut.Free asc";
}else if(strtolower($order)=='pricehigh'){
    $query.=" ORDER BY ut.Free desc";
}
$total=$this->db->query($query)->num_rows();
$query.=" LIMIT ".$page.",".$perpage;
$db_qr = $this->db->query($query);

$tg1="";
if($db_qr->num_rows() > 0)
{
    foreach($db_qr->result() as $itemcat)
    {
        $tg1[]=$itemcat;
    }
}

return array('total'=>$total,'data'=>$tg1);

} 
// 
function BaiVietTimGiaSu(){
    $query = "SELECT * FROM baiviettimgiasu";
    $news_cat = $this->db->query($query);
    $tg="";
    if($news_cat->num_rows()> 0)
    {
        $tg=$news_cat->row();
    }
    return $tg;
}
function BaiVietTimLop(){
    $query = "SELECT * FROM baiviettimlop";
    $news_cat = $this->db->query($query);
    $tg="";
    if($news_cat->num_rows()> 0)
    {
        $tg=$news_cat->row();
    }
    return $tg;
}
function getitemlinkseobuysearch($sub,$city,$type)
{
    $query="select * from linkseo where cityid='".intval($city)."' and subjectid='".intval($sub)."' and `type`='".intval($type)."'";

    $news_cat = $this->db->query($query);
    $tg="";
    if($news_cat->num_rows()> 0)
    {
        $tg=$news_cat->row();
    }
    return $tg;
}

    function get_subject()
    {
        $sql="SELECT * FROM `subject`";
        $query=$this->db->query($sql)->result();

        return $query;
    }

    function get_city()
    {
        $sql="SELECT * FROM `city`";
        $query=$this->db->query($sql)->result();
        
        return $query;
    }

    function get_class(){
        $sql = "SELECT * FROM `class`";

        $query=$this->db->query($sql)->result();
        
        return $query;
    }

    function get_qh(){
        $sql="SELECT * FROM `city2` WHERE cit_parent = 45";
        $query=$this->db->query($sql)->result();
        
        return $query;
    }
     function get_subject_class($idsub,$sub){

        $link = '';
        $sql = "SELECT * FROM class_subject WHERE IdSubject = ".$idsub;
        $query=$this->db->query($sql)->result();
        foreach ($query as $result) {
            $sql1 = "SELECT * FROM class WHERE id = ".$result->IdClass;
            $query1=$this->db->query($sql1)->row();

            $link .= base_url().'mon-'.vn_str_filter($sub).'/'.vn_str_filter($query1->classname).'-s'.intval($idsub).'r'.intval($query1->id).'c0.html'.',';
        }

        return $link;
     }
      function get_subject_class1($idsub,$sub){
        
        $link = '';
        $sql = "SELECT * FROM class_subject WHERE IdSubject = ".$idsub;
        $query=$this->db->query($sql)->result();
        foreach ($query as $result) {
            $sql1 = "SELECT * FROM class WHERE id = ".$result->IdClass;
            $query1=$this->db->query($sql1)->row();

            $link .= base_url().'viec-lam-gia-su-mon-'.vn_str_filter($sub).'/'.vn_str_filter($query1->classname).'-m'.intval($idsub).'c'.intval($query1->id).'p0.html'.',';
        }

        return $link;
     }
     function insert_user(){
        $sql ="INSERT INTO `users`( `Name`, `UserName`, `Phone`, `Email`, `CityID`, `CityName`, `CityID2`, `CityName2`, `Address`, `Description`, `UserType`, `Password`, `CreateDate`, `CreateBy`, `Image`, `Active`, `Delete`, `Latitude`, `Longitude`, `Sex`, `Exp`, `Bonus`, `Birth`, `UpdateDate`, `IsSearch`, `Notify`, `Accounttype`, `HonNhan`, `IP`) VALUES ('nguyễn trọng hải','','0353032201','nguyentronghai1912@gmail.com','0','',
        '','','','','0','539df08bcf63d24782f8c58ebbdae3a3','2020-08-03 14:01:46','','','1','','','','','','','',
        '','','','','','')";
        $query=$this->db->query($sql);
     }
     function fetch_data($query)
        {
        $this->db->select("*");
        $this->db->from("users");
        if($query != '')
        {
        $this->db->like('Name', $query);
        $this->db->or_like('Address', $query);
        $this->db->or_like('CityName2', $query);
        // $this->db->or_like('CityName2', $query);
        // $this->db->or_like('CityName2', $query);
        // $this->db->or_like('PostalCode', $query);
        // $this->db->or_like('Country', $query);
        }
        $this->db->order_by('UserID', 'DESC');
        return $this->db->get();
        }

    //search ở đây

    function search($keyword)
    {
        $sql= "SELECT * FROM users where Name like '%$keywork$'";
        $query=$this->db->query($sql);
        return $query->result_array();
    }
}
?>
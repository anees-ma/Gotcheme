<?php
function array_flatten($array,$mkey) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value,$mkey)); 
    } 
    else { 
      if($key==$mkey){
        $result[] = $value; 
      }
    } 
  } 
  return $result; 
}
function albumpermission($id,$uid){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT album_visibility as output from zindagi where id='$id'";
    $req="SELECT a.* from album_request a where a.from='$uid' and a.to='$id' and a.status='Y'";
    $res=$db1->query($req);
    $query=$db1->query($sql);
    $plan= userplan($uid);
    if($query->row()->output==54){
        return 1;
    }elseif($query->row()->output==55){
        if($plan->pid>2){
            return 1;
        }elseif ($res->num_rows()>0) {
            return 1;
        }else{
            return 0;
        }
    }else{
        if ($res->num_rows()>0) {
            return 1;
        }else{
            return 0;
        }
    }
}
function userdata($id,$key){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT $key as output from zindagi where id='$id'";
     $query=$db1->query($sql);
     return $query->row()->output;
}
function profile_settings($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $uid=$ci->session->userdata('id');
    if($id=='promo'):
        $sql="SELECT email_subscribe as output from zindagi where id='$uid'";
    elseif($id=='album'):
        $sql="SELECT album_visibility as output from zindagi where id='$uid'";
    endif;
     $query=$db1->query($sql);
     return $query->row()->output;
}
function lastlogin($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT max(y.created) as last_login from log y where y.uid='$id' and y.op='login'";
     $query=$db1->query($sql);
     return $query->row()->last_login;
}
function getusername($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT y.name  from zindagi y where y.id='$id'";
     $query=$db1->query($sql);
     return $query->row()->name;
}
function getcontactdistrict(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT distinct district from contactus";
     $query=$db1->query($sql);
     return $query->result();
}
function plan(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr5=$db1->query("select * from plan a where a.status='Y'");
    if($qr5->num_rows()>0):
        return $qr5->result();
    endif;
}
function adminnote($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT y.note  from adm_note y where y.uid='$id'";
    
     $query=$db1->query($sql);
     if($query->num_rows()>0){
     return $query->row()->note;
     }else{
         return '';
     }
}
function cname_with_prefix($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT y.name from country y where y.prefix_code='$id'";
     $query=$db1->query($sql);
     return $query->row()->name;
}
function register_status($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
            $sql="select * from registration_status";// from zindagi b where b.id='$id'
            $res="select b.* from zindagi b where b.id='$id'";
            $psql="select b.* from user_partner_preference b where b.uid='$id' order by b.created desc limit 1";
            $qres=$db1->query($res)->row_array();
            $row=$db1->query($sql)->result();
            $pqr=$db1->query($psql)->row_array();
            $cmp=0;
            $total=0;
            foreach($row as $val):
               $total+= $val->mark;
               if(isset($qres[$val->item]) && $qres[$val->item]!='' && $qres[$val->item]!='0'):
                   $cmp+=$val->mark;
               elseif(isset($pqr[ltrim($val->item,'partner_')]) && $pqr[ltrim($val->item,'partner_')]!='' && $pqr[ltrim($val->item,'partner_')]!='0'):
                   $cmp+=$val->mark;
               endif;
            endforeach;
            
            //echo $total;
            return floor(($cmp/$total)*100);
        }
function userplan($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT 
        a.id,b.id as piid,
        b.pid,c.name as planname,
        c.duration,
        (c.read_contact-(select count(*) from user_sharing where to_id='$id' and piid=b.id)) as balancecontact,
        c.read_contact as contacts_allowed,
        from_unixtime(b.created,'%d-%m-%Y') as pdate,
        case when (c.duration-datediff(curdate(),from_unixtime(b.created,'%Y-%m-%d')))<0 then 0 else (c.duration-datediff(curdate(),from_unixtime(b.created,'%Y-%m-%d'))) end  as balancedays
        FROM zindagi a
        left join `user_plan` b on b.uid='$id' and b.created=(select max(d.created) from user_plan d where d.uid='$id')
        left join plan c on c.id=b.pid  
        where a.id='$id'";
     $query=$db1->query($sql);
     return $query->row();
}
function planname($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT a.name from plan a where a.id='$id'";
    $query=$db1->query($sql);
    return $query->row()->name;
}
function idstatus($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $sql="SELECT a.status from verify_id a where a.uid='$id'";
    $query=$db1->query($sql);
    if($query->num_rows()>0){
        return $query->row()->status;
    }else{
        return 0;
    }   
}
function allegiance($rel=5){
    if($rel==5):
    $all=array('NO ALLEGIANCE','SUNNI(EK)','SUNNI(AP)','JAMAAT-E-ISLAMI','MUJAHID','THABLEEG','SUFI','THAREEQATH');
    return $all;
    else:
        return false;
    endif;
}
function gender(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='gender'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}

function listvalue($id){
    if($id > 0):
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from list_value a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
    else:
        return '';
    endif;
   //$ci->session->userdata('user');
}

function caste($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from caste a where a.pid='$id'")->result();
    $db1->close();
    
    return $qr;
}
function getuserstatus($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
        $qr=$db1->query(" select a.created from user_login a where a.uid='$id' order by id desc");
        if($qr->num_rows()>0):
        $time=$qr->row()->created;
        
        if((time()-$time)>60){
           return 'Last login '. ago($time);
        }else{
           return "Online"; 
        }
        else:
            return '';
        endif;
    }
function getcastename($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from caste a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
   //$ci->session->userdata('user');
}
function getqualificationname($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from qualification a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
   //$ci->session->userdata('user');
}
function getoccupationname($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from occupation a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
   //$ci->session->userdata('user');
}
function city(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from city a where a.parent_id='104'")->result();
    $db1->close();
    
    return $qr;
   //$ci->session->userdata('user');
}
function getplacename($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from place a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
   //$ci->session->userdata('user');
}
function getcountry_livingname($id){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.name from country a where a.id='$id'")->row();
    $db1->close();
    
    return $qr->name;
   //$ci->session->userdata('user');
}
function current_user(){
    $ci= & get_instance();
    return $ci->session->userdata('id');
}
function getIP(){
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function cropuploads($fileName,$path,$wt,$ht){
        $jpeg_quality = 90;
        $sr=$fileName;
        $srr=UPLOAD_PATH.'uploads/face_orig/';
        $src = $srr.$sr;
        $s=getimagesize($src);
        $width=$s[0];
        $height=$s[1];
        $newwidth  =$wt;
        $newheight =$ht;
        $widthProportion  = $width / $newwidth;
        $heightProportion = $height / $newheight;
        if ($widthProportion > $heightProportion) {
            $y=0;
            $x=($width-($heightProportion*$newwidth))/(2*$heightProportion);
            $width=$newwidth*$heightProportion;
        } elseif($widthProportion< $heightProportion) {
            $x=0;
            $y=($height-($widthProportion*$newheight))/(2*$widthProportion);
            $height=$newheight*$widthProportion;
        }
        $dest=UPLOAD_PATH.$path.$fileName;
        $img_r = imagecreatefromjpeg($src);
        $dst_r = ImageCreateTrueColor($wt,$ht);
        imagecopyresampled($dst_r, $img_r, 0, 0, ceil($x), ceil($y), $newwidth, $newheight, ceil($width), ceil($height));
        //watermark
        $black = imagecolorallocate($dst_r,220,220,222);//rgb(136,146,191)
        $font = FCPATH.'fonts/times.ttf';
        $font_size = array(0=>10,100=>12,200=>15,300=>20,400=>25,500=>30);
        $f_size=isset($font_size[round($wt,-2)])?$font_size[round($wt,-2)]:30;
        $wtext=' www.zindagimatrimony.com          ';
        for($i=0;$i<10;$i++){
            $wtext.=' www.zindagimatrimony.com          ' ;
        }
        $angle=round(rad2deg(atan($ht/$wt)),2);
        imagettftext($dst_r, $f_size,0, 0, $newheight/2, $black, $font,$wtext);
        //imagettftext($dst_r, $font_size, -$angle, 0, 0, $black, $font,$wtext);
        imagejpeg($dst_r, $dest, $jpeg_quality);    
    }
    
 function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile) { 
   list($width, $height) = getimagesize($SourceFile);
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($SourceFile);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
   $black = imagecolorallocate($image_p, 0, 0, 0);
   $font = 'arial.ttf';
   $font_size = 10; 
   imagettftext($image_p, $font_size, 0, 10, 20, $black, $font, $WaterMarkText);
   if ($DestinationFile<>'') {
      imagejpeg ($image_p, $DestinationFile, 100); 
   } else {
      header('Content-Type: image/jpeg');
      imagejpeg($image_p, null, 100);
   };
   imagedestroy($image); 
   imagedestroy($image_p); 
}
function ago($time){
   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "ago";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "s";
   }

   return "$difference $periods[$j] ago ";
}
function email_exist($email){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from zindagi a where a.email='$email'");
    $db1->close();
    if($qr->num_rows()>0):
        return true;
    else:
        return false;
    endif;
        
   //$ci->session->userdata('user');
}
function cm2feet($cm)
{
     $inches = $cm/2.54;
     $feet = intval($inches/12);
     $inches = $inches%12;
     return sprintf('%d ft %d ins', $feet, $inches);
}
function mobile_exist($mobile){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from zindagi a where a.phone='$mobile'");
    $db1->close();
    if($qr->num_rows()>0):
        return true;
    else:
        return false;
    endif;
        
   //$ci->session->userdata('user');
}
function age_limit($dob,$gender){
        $diff=date('Y-m-d',strtotime($dob));
        $age=date_diff(date_create($diff), date_create(date('Y-m-d')))->y;
        $lmt=($gender=='Male')?21:18;
        if($age < $lmt){
            return true;
        }else{
            return false;
        }
}
function mymail($myemail,$subj,$emess){
    $femail='help@zindagimatrimony.com';
    $ehead = "From: ".$femail."\r\n";
    $ehead.= "Content-type:text/html;charset=UTF-8" . "\r\n";
    mail("$myemail","$subj","$emess","$ehead");
}
function amazonmail($to,$subject,$message,$bcc='',$cc=''){
    $ci= & get_instance();
    $ci->load->library('aws_sdk');
		// Sending Mail structure

              $mail = array(
	        // Destination Mail ID.
		'Destination' => array(
		  'ToAddresses' => array($to),
		),
		// Message Body.
		'Message' => array(
		  'Body' => array(
		    'Html' => array(
		      'Charset' => 'UTF-8',
                      'Data' => $message,
		    ),
		  ),
		  'Subject' => array(
		    'Charset' => 'UTF-8',
		    'Data' => $subject,
		  ),
		), 
		 // Source
		 'Source' => 'help@zindagimatrimony.com',
	       );
		try{
		    $promise = $ci->aws_sdk->sendEmail($mail);
                    return true;    
		//var_dump($promise);
		}catch (Exception $e){
		    //d($e);
		}
}
function attachmail($email,$subject,$content,$body){
    $ci= & get_instance();
    $ci->load->library('aws_sdk');
         $msg = "To: $email\n";
        $msg .="From: help@zindagimatrimony.com\n";
        //in case you have funny characters in the subject
        //$subject = mb_encode_mimeheader('NRI FEST TICKET', 'UTF-8');
        $msg .="Subject: $subject\n";
        $msg .="MIME-Version: 1.0\n";
        $msg .="Content-Type: multipart/alternative;\n";
        $boundary = uniqid("_Part_".time(), true); //random unique string
        $msg .=" boundary=\"$boundary\"\n";
        $msg .="\n";
        //now the actual message
        $msg .="--$boundary\n";
        //first, the plain text
        $msg .="Content-Type: text/plain; charset=utf-8\n";
        $msg .="Content-Transfer-Encoding: 7bit\n";
        $msg .="\n";
        $msg .=strip_tags($body);
        $msg .="\n";
        //now, the html text
        $msg .="--$boundary\n";
        $msg .="Content-Type: text/html; charset=utf-8\n";
        $msg .="Content-Transfer-Encoding: 7bit\n";
        $msg .="\n";
        $msg .=$body;
        $msg .="\n";
        $msg .="--$boundary\n";
        $msg .="Content-Transfer-Encoding: base64\n";
        $clean_filename = mb_substr('myattach.jpg', 0, 60);
        $msg .="Content-Type: Image/jpg; name=$clean_filename;\n";
        $msg .="Content-Disposition: attachment; filename=$clean_filename;\n";
        $msg .="\n";
        $msg .=base64_encode($content);
        $msg .="--\n";

         $sendMsg['RawMessage']['Data']         = (string)base64_encode($msg);
         $sendMsg['RawMessage']['Source']       = "developer@madhyamam.in";
         $sendMsg['RawMessage']['Destinations'] = $email;


                try{
                    $promise = $ci->aws_sdk->sendRawEmail($sendMsg);
                return true;
     // d($promise);
                }catch (Exception $e){
                    //var_dump($e);
                }

}
function bodytype(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='body_type'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function physical(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='physical_status'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function complexion(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='complexion'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function bgroup(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='blood_group'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function countrylist(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from country a order by a.priority,a.name");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function dialcode(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from country_with_dial_code a order by country");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function qualification(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from qualification a order by a.name");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function course(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from course a order by a.name");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function occupation(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from occupation a order by a.name");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function sector(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='job_sector'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function income(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.*,a.income as name from income a");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function familystatus(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='family_status'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function familytype(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='family_type'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function religion(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from religion a");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function diet(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='diet'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function mastatus(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='marital_status'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function phstatus(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='physical_status'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function hobby(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='hobby'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function mtongue(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='mother_tongue'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function created_by(){
    $ci= & get_instance();
    $db1=$ci->load->database('default',true);
    $qr=$db1->query("select a.* from list_value a where a.type='profile_created_by'");
    $db1->close();
    
    return $qr->result();
   //$ci->session->userdata('user');
}
function alpha_check($string){
    return preg_match('/^[a-zA-Z ]+$/',$string);
}
function candidate_status($id){
    $status=Array();
    $status[46]='Email not verified';
    $status[43]='Active';
    $status[45]='Admin Deleted';
    $status[44]='User Deleted';
    $status[47]='Reported';
    $status[48]='freezed';
    if(array_key_exists($id, $status)){
        return $status[$id];
    }else{
        return '';
    }
}
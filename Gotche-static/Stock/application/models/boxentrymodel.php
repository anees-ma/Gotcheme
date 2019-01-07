<?php

class Boxentrymodel extends CI_Model {
    public function __construct() {
     parent::__construct();
     $this->load->database();
    }
    
    //add box
    public function addbox($data){
        $addbox=array(
            'box_no'=>$data['boxno'],
            'ins_date'=>$data['instdate'],
            'shop_addr'=>$data['addr'],
            'addr2'=>$data['addr2'],
            'addr3'=>$data['addr3'],
            'addr4'=>$data['addr4'],
            'phone'=>$data['phone'],
            'exec_name'=>$data['exe_name'],
            'remarks'=>$data['remarks'],
            'exe_id'=>$data['exe_id'],
            'date'=>$data['date'],
            'emcode'=>$data['empcode'],
            'District'=>$data['district'],
            'unit'=>$data['unit']
        );
        $insert=$this->db->insert('boxentry',$addbox);
        if($insert){
            return "<h4>Box Number ". $data['boxno']." Added!!</h4>";
        }
    }
   
    function getexe_name($q){
    $this->db->select('name');
    $this->db->like('name', $q);
    $query = $this->db->get('executivemaster');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row){
        $row_set[] = htmlentities(stripslashes($row['name'])); //build an array
      }
      echo json_encode($row_set); //format the array into json data
    }
  }
  
  function get_exe_id($name){
      $this->db->select('id');
      $this->db->from('executivemaster');
      $this->db->where(array('name'=>$name));
      $query=$this->db->get();
      if($query->num_rows()==0){
        return 0;  
      }else{
        return $query->row();
      }
  }
  
  public function boxnumber_check($num){
      if($num==''){$number='0';}else{$number=$num;}
      $this->db->select('box_no');
      $this->db->from('boxentry');
      $this->db->where('box_no',$number);
      $query=$this->db->get();
      if($query->num_rows()==0){
          return "add";
      }else{
          return "Box Number already exist.";
      }
  }
  
   public function box_report($data){
       
      $this->db->select('*');
      $this->db->from('boxentry');
      if($data['unit'] !='CORPORATE'){
          $this->db->where(array('unit'=>$data['unit']));
      }
      $this->db->order_by('id','desc');
      $query=$this->db->get();
      return $query->result_array();
  }
  
  public function edit_box($number){
      $this->db->select('*')
                       ->from('boxentry')
                        ->where('box_no',$number);
      $query=$this->db->get();
      return $query->result_array();
  }
  public function update_box($data){
      if(isset($data['boxreplace'])){
            $editbox=array(
                  'box_no'=>$data['rpl_boxno'],
                  'ins_date'=>date('Y-m-d',strtotime($data['rpl_date'])),
                  'shop_addr'=>$data['addr'],
                  'addr2'=>$data['addr2'],
                  'addr3'=>$data['addr3'],
                  'addr4'=>$data['addr4'],
                  'phone'=>$data['phone'],
                  'exec_name'=>$data['exe_name'],
                  'remarks'=>$data['remarks'],
                  'exe_id'=>$data['exe_id'],
                  'date'=>$data['date'],
                  'emcode'=>$data['empcode'],
                  'unit'=>$data['unit']
                );
                $insert=$this->db->insert('boxentry',$editbox);
                if($insert){
                    $update=$this->db->where(array('box_no'=>$data['boxno']))
                ->update('boxentry',array('replaced'=>$data['boxreplace'], 'replace_date'=>date('Y-m-d',strtotime($data['rpl_date'])),'replace_number'=>$data['boxno'], 'reason'=>$data['boxreason']));
                    return "<h4>Box Number ".$data['boxno']." replaced!!</h4>";
                }
      }else{
            $editbox=array(
                  'box_no'=>$data['boxno'],
                  'ins_date'=>$data['instdate'],
                  'shop_addr'=>$data['addr'],
                  'addr2'=>$data['addr2'],
                  'addr3'=>$data['addr3'],
                  'addr4'=>$data['addr4'],
                  'phone'=>$data['phone'],
                  'exec_name'=>$data['exe_name'],
                  'remarks'=>$data['remarks'],
                  'exe_id'=>$data['exe_id'],
                  'date'=>$data['date']

            );
      }
                $update=$this->db->where(array('box_no'=>$data['boxno']))
                ->update('boxentry',$editbox);
                if($update){
                    return "<h4>Box Number ".$data['boxno']." updated!!</h4>";
                }
 
  }
  
  public function box_number_check($number){
      $this->db->select('box_no');
      $this->db->from('boxentry');
      $this->db->where("(box_no=".$number." or replace_number=".$number.")");
      $query=$this->db->get();
      if($query->num_rows()==0){
          return "0";
      }else{
          return "1";
      }
  }
  public function box_report_filter($data){
      $district=$data['district'];
      $unit=$data['unit'];
      $s_unit=$data['s_unit'];
      if($data['start_date']=='00-00-0000'){
          $s_date='0000-00-00';
      }else{
          $s_date=date('Y-m-d',strtotime($data['start_date']));
      }
      
      $f_date=date('Y-m-d',strtotime($data['final_date']));
      $s_type=$data['type'];
      $this->db->select('*');
      $this->db->from('boxentry');
      if($data['unit'] !='CORPORATE'){
          if($district=="ALL"){
            if($s_type=='ALL'){
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date));
            }elseif($s_type=='CURRENT'){
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no'));
            }else{
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes'));
            } 
          }else{
            if($s_type=='ALL'){
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date,'District'=>$district));
            }elseif($s_type=='CURRENT'){
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no','District'=>$district));
            }else{
              $this->db->where(array('unit'=>$data['unit'],'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes','District'=>$district));
            }  
          }
      }else{
        if($district=="ALL"){
            if($s_unit=='ALL'){
              if($s_type=='ALL'){
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date));
              }elseif($s_type=='CURRENT'){
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no'));
              }else{
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes'));
              }
            }else{
              if($s_type=='ALL'){
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date));
              }elseif($s_type=='CURRENT'){
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no'));
              }else{
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes'));
              }
            }
        }else{
            if($s_unit=='ALL'){
              if($s_type=='ALL'){
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date,'District'=>$district));
              }elseif($s_type=='CURRENT'){
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no','District'=>$district));
              }else{
                $this->db->where(array('ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes','District'=>$district));
              }
            }else{
              if($s_type=='ALL'){
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date,'District'=>$district));
              }elseif($s_type=='CURRENT'){
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'no','District'=>$district));
              }else{
                $this->db->where(array('unit'=>$s_unit,'ins_date >='=>$s_date,'ins_date <='=>$f_date,'replaced'=>'yes','District'=>$district));
              }
            }
        }
      }
      $this->db->order_by('id','desc');
      $query=$this->db->get();
      return $query->result_array();
  }
  public function expiry_report($data){// Author - Anees M A - For box expiry report
     // $cur_date=date('Y-m-d');
      $date=date("Y-m-d",strtotime($data['date']));
      $days=$data['days'];
      $unit=$data['unit'];
      
//      $query=$this->db->query('select *, DATEDIFF("'.$date.'",a.ins_date) as expiry_days from boxentry a where DATEDIFF("'.$date.'",a.ins_date)>='.$days.' and unit="'.$unit.'" and a.ins_date>="2017-04-01" group by a.box_no');
      
     // $query=$this->db->query('select c.box_no, DATEDIFF("2017-07-04",(select case when a.box_no in (select b.boxno from boxrenew b group by b.boxno) then (select b.renew_date from boxrenew b where a.box_no=b.boxno) else a.ins_date end as date from boxentry a where c.box_no=a.box_no group by a.box_no)) as expiry_days from boxentry c where DATEDIFF("2017-07-04",(select case when a.box_no in (select b.boxno from boxrenew b group by b.boxno) then (select b.renew_date from boxrenew b where a.box_no=b.boxno) else a.ins_date end as date from boxentry a where c.box_no=a.box_no group by a.box_no))>=74 and unit="CALICUT"');
      
      
//      $query=$this->db->query('select *, DATEDIFF("2017-07-04",(select case when a.box_no in
//(select b.boxno from boxrenew b group by b.boxno) then (select
//b.renew_date from boxrenew b where b.boxno="KD010") else a.ins_date
//end as date from boxentry a where a.box_no="180" group by
//a.box_no)) as expiry_days from boxentry c where
//DATEDIFF("2017-07-04",(select case when a.box_no in (select b.boxno
//from boxrenew b group by b.boxno) then (select b.renew_date from
//boxrenew b where b.boxno="KD010") else a.ins_date end as date from
//boxentry a where a.box_no="180" group by a.box_no))>=74 and
//unit="CALICUT" and (select case when a.box_no in
//(select b.boxno from boxrenew b group by b.boxno) then (select
//b.renew_date from boxrenew b where b.boxno="KD010") else a.ins_date
//end as date from boxentry a where a.box_no="180" group by
//a.box_no)<="2017-04-01"');
      
      $query=$this->db->query('select *, (select case 

when a.box_no in
(select b.boxno from boxrenew b group by 

b.boxno) then (select
max(b.renew_date) from boxrenew b where 

b.boxno=a.box_no) else a.ins_date
end as date from boxentry a where 

a.box_no=c.box_no group by
a.box_no) as installed_date, DATEDIFF("'.$date.'",(select case 

when a.box_no in
(select b.boxno from boxrenew b group by 

b.boxno) then (select
max(b.renew_date) from boxrenew b where 

b.boxno=a.box_no) else a.ins_date
end as date from boxentry a where 

a.box_no=c.box_no group by
a.box_no)) as expiry_days from boxentry c

where (DATEDIFF("'.$date.'",(select case 

when a.box_no in
(select b.boxno from boxrenew b group by 

b.boxno) then (select
max(b.renew_date) from boxrenew b where 

b.boxno=a.box_no) else a.ins_date
end as date from boxentry a where 

a.box_no=c.box_no group by
a.box_no))>='.$days.') 

and (select case when a.box_no in
(select b.boxno from boxrenew b group by 

b.boxno) then (select max(b.renew_date) from 

boxrenew b where b.boxno=a.box_no) else 

a.ins_date
end from boxentry a where 

a.box_no=c.box_no group by a.box_no)<="2017-

04-01" and c.unit="'.$unit.'"');
      $result=$query->result_array();
       
      if(empty($result)){
          return 0;
      }else{
         return $result;
      }

  }
  public function boxrenew($data){
      $date=date("Y-m-d");
      
      $renew=array(
                  'boxno'=>$data['bno'],
                  'renew_date'=>$date,
                  
                );
                $insert=$this->db->insert('boxrenew',$renew);
                if($insert){
                    //
                    return 'Box NO. '.$data['bno'].' renewed successfully';
                    
                }
  }
}

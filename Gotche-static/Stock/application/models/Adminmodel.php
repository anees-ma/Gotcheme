<?php

	class Adminmodel extends CI_Model{
		function __construct() {
			parent::__construct();
			$this->load->database();
		}
		public function addstock($data){
			$itemname=$data['itemname'];
			$quantity=$data['quantity'];
			$file=$data['file'];
			
			$data = array(
				'id'=>'',
				'item_name'=>$itemname,
				'quantity'=>$quantity,
				'file'=>$file,
			);

			if($this->db->insert('stock',$data)){
				return true; 
			}else{
				return false; 
			}
		}
		public function viewstock(){
			$query=$this->db->get('stock');
			$result=$query->result_array();
			return $result;
			
		}
		public function deletestock($id){
			$this->db->where('id', $id);
			$this->db->delete('stock'); 
			return 'deleted';
			
		}
		public function login($login){ 
			
			$options = [
				'cost' => 11,
				'salt' => '$abY^kJh9&*H#-JnR%oW!<',
			];
			
			$hash=password_hash($login['password'], PASSWORD_BCRYPT, $options);
			$query=$this->db->query('select `password` from `login` where `username`="'.$login['username'].'"');
			$ret=$query->row();
			$password=$ret->password;
			
			if(password_verify($login['password'],$password)){
				return true;
			}else{
				return false;
			}
		}
		public function editprofile(){
			
			$options = [
				'cost' => 11,
				'salt' => '$abY^kJh9&*H#-JnR%oW!<',
			];
			
			$hash=password_hash($this->input->post('newpword'), PASSWORD_BCRYPT, $options);
			$query=$this->db->query('update `login` set `username`="'.$this->input->post('newuname').'", `password`="'.$hash.'"');
			if($query){
				return true;
			}else return false;
			
		}
	}
	
	?>
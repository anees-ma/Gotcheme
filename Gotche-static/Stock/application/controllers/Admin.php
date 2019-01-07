<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->helper( array('url', 'form'));
		$this->load->model('adminmodel'); 
		$this->load->library('session');
		$this->load->library('form_validation');
		
    }

    public function index(){
		if($this->session->userdata("Admin")){
			redirect(site_url("admin/view_stock"));
		}else $this->load->view('Admin/signin');
    }
	public function login(){
		
		if($this->session->userdata("Admin")){
			redirect(site_url("admin/view_stock"));
		}
		
	    $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/signin');
		} else {
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password')
		);
		
		$result = $this->adminmodel->login($data);
		
		if ($result){
			$this->session->set_userdata("Admin",$this->input->post('username'));
			redirect(site_url("admin/view_stock"));
		} else echo $this->load->view('Admin/signin');
    }
		
		
	}
	public function add_stock(){
		if($this->session->userdata("Admin")){
			if($this->input->post()){
				$data_f['itemname'] = $this->input->post("itemname");
				$data_f['quantity']=$this->input->post("quantity");
				
				$config['upload_path']          = './uploads/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				//$config['max_size']             = 100;
				//$config['max_width']            = 1024;
				//$config['max_height']           = 768;
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('image'))
				{
						$error = array('error' => $this->upload->display_errors());
						
						
				}
				else
				{	
					$data = array('upload_data' => $this->upload->data());
					$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$data_f['file'] = $upload_data['full_path'];
					$entry=$this->adminmodel->addstock($data_f);
					if($entry){
						$data='<p style="color:green;font-weight:bold">New stock added successfully!</p>';
						$this->session->set_userdata("notification", $data);
						redirect(current_url());
					}
					else{
						$data='<p style="color:red;font-weight:bold">Failed to add new stock entry, try again!</p>';
						$this->session->set_userdata("notification", $data);
						redirect(current_url());
					}
				}
			}else{
				$this->template->write_view('content','Admin/pages/forms/add-stock');
				$this->template->render();
			}
		}else redirect(site_url("admin/index"));
		
	}
	public function view_stock(){
		
		if($this->session->userdata("Admin")){
			$res['result']=$this->adminmodel->viewstock();
			$this->template->write_view('content','Admin/pages/tables/viewstock',$res);
			$this->template->render();
		
		}else redirect(site_url("admin/index"));
    }
	
	public function delete_stock(){
		$id=$this->input->post('id');
		$res=$this->adminmodel->deletestock($id);
		echo $res;
    }
	public function signout(){
		$this->session->sess_destroy();
		$this->load->view('Admin/signin');
	}
	public function edit_profile(){
		if($this->session->userdata("Admin")){
			if($this->input->post()){
				$res=$this->adminmodel->editprofile();
				if($res){
						$data='<p style="color:green;font-weight:bold">Profile updated successfully!</p>';
						$this->session->set_userdata("profile", $data);
						redirect(site_url("admin/view_stock"));
				}else{
					
					$data='<p style="color:red;font-weight:bold">Failed to update profile, Try again!</p>';
					$this->session->set_userdata("profile", $data);
					redirect(site_url("admin/updation_error"));
				}
			}else{
				$this->template->write_view('content','Admin/pages/forms/edit_profile');
				$this->template->render();
			}
		}else redirect(site_url("admin/index"));
		
	}
	public function updation_error(){
		$this->template->write_view('content','Admin/pages/forms/edit_profile');
		$this->template->render();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
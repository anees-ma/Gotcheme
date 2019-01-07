<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->helper( array('url', 'form'));
		$this->load->model('adminmodel'); 
		$this->load->library('session');
		$this->load->library('form_validation');
		
    }

    public function index(){
		$stock['data']=$this->adminmodel->viewstock();
		If($stock){
			$this->load->view('stock',$stock);
		}else echo 'stock fetching failed';
		
		
	//echo 'hii';
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
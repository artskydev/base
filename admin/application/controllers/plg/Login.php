<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		 parent::__construct();
		 
	}
	public function index()
	{
		//echo $this->encryption->encrypt('seller');
		//exit;
		$in['title'] = "Logins";
		$this->load->view('customer/login',$in);
		return; 
	}
	public function check()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$username = $this->input->post('email',true);
			$pass = $this->input->post('password',true);
			$this->db
			 
			->where("status=1")
			->where("( email = '".$username."')");
			$arr =  $this->db->get('customer')->result_array();
			
			for($i=0;$i<count($arr);$i++)
			{
				 
				 $arr[$i]['password'] = $this->encryption->decrypt($arr[$i]['passwords']);
                  
				 if($arr[$i]['password']==$pass)
                 {
					$c = $arr[$i];
					 
					$this->session->set_userdata('customermeong_login',$c);
					json(array('error'=>false,'message'=>'Proses User','security'=>token(),'data'=>$arr[$i]));
					return;
				}
			}
			json(array('error'=>true,'message'=>'User not found','security'=>token()));
			return;	
		}
		show_404();
	}
	public function logout()
	{
		$this->session->unset_userdata('customermeong_login');
		//$this->session->sess_destroy();
		redirect('plg/login');
	}
	public function forgot()
	{
		//echo $this->encryption->encrypt('seller');
		//exit;
		$in['title'] = "Logins";
		$this->load->view('customer/forgot',$in);
		return; 
	}
	public function token()
	{
		json(array('error'=>false,'message'=>'token generate','security'=>token()));
		return;
	}
	 
	 
}


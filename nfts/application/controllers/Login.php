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
		//$this->load->view('manager/login',$in);
		$in['tpl'] = "login";
		$this->load->view('manager/layout',$in);
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
			$arr =  $this->db->get('nft_customer')->result_array();
			
			for($i=0;$i<count($arr);$i++)
			{
				 
				 $arr[$i]['password'] = $this->encryption->decrypt($arr[$i]['password']);
                 if($arr[$i]['password']==$pass)
                 {
					$c = $arr[$i];
					 
					$this->session->set_userdata('artsky_nft_login',$c);
					json(array('error'=>false,'message'=>'Proses User','security'=>token(),'data'=>$arr[$i],"links"=>site_url("profile/author")));
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
		$this->session->unset_userdata('artsky_nft_login');
		//$this->session->unset_userdata('artsky_nft_wallet');
		//$this->session->sess_destroy();
		redirect('login');
	}
	public function token()
	{
		json(array('error'=>false,'message'=>'token generate','security'=>token()));
		return;
	}
	 
	 
}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
		$in = array();
		 
		 
			
		$in['bread']['#'] = 'Register';
		
		$in['title'] = ""; 
		$in['tpl'] = "register";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('nft_customer');
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Your Akun Has been Registered','security'=>token()));
				return;	
			}
			$checkb = $this->db->where('name',$in['brand_name'])->get('nft_brand');
			if($checkb->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Brand Name Has been Registered','security'=>token()));
				return;	
			}
			$brand = array();
			if(isset($in['brand_name']))
			{
				$brand['name'] = $in['brand_name'];
				unset($in['brand_name']);
			}
			if(isset($in['brand_fax']))
			{
				$brand['fax'] = $in['brand_fax'];
				unset($in['brand_fax']);
			}
			
			if(isset($brand['name']))
			{
				//if(isset($in['refferal']))
				//$in['refferal'] = str_replace("V-","",$in['refferal']);
				
				$in['uuid'] = get_profile_id();
				$in['created_on'] = $time;
				$in['name'] = $brand['name'];
				$in['updated_on'] = $time;
				$in['activation_code'] = get_unique_customer_code();
				$in['password'] =  $this->encryption->encrypt($in['password']);
				 
				 
				
			
				$this->db->insert("nft_customer",$in);
				$id = $this->db->insert_id(); 
				//brand
				$brand['id_nft_users'] = $id;
				$this->db->insert("nft_brand",$brand);
				
				$in['urls'] = site_url("stats/status/".$in['activation_code']);
				$this->session->set_userdata('artsky_nft_login',$in);
				send_mail_link($in);
				json(array('error'=>false,'message'=>"Check your email inbox or spam, for confirmation email  </h5><br/> <a href='javascript:void(0);' class='resends btn btn-small btn-sm btn-xs btn-danger' style='float:right;' onclick='javascript:resendclick();'>Resend</a><br/>",'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;	
		}
		show_404();
	}
	public function resend()
	{
		$in = $this->session->userdata('artsky_nft_login');
		send_mail_link($in);
	}
	 
}


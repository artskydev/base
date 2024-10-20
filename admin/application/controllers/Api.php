<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	 
	public function login()
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
	
	public function register()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()>0)
			{
				json(array('error'=>true,'message'=>'Email Exist','security'=>token()));
				return;	
			}
			
			
			$in['refferal'] = str_replace("R-","",$in['refferal']);
			$in['created_on'] = $time;
			$in['updated_on'] = $time;
			$in['activation_code'] = get_unique_customer_code();
			$in['passwords'] =  $this->encryption->encrypt($in['password']);
			 
			unset($in['password']);
			
		
			$this->db->insert("customer",$in);
			$in['urls'] = site_url("plg/stats/status/".$in['activation_code']);
			$this->session->set_userdata('customermeong_session',$in);
			send_mail_link($in);
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resend()
	{
		$in = $this->session->userdata('customermeong_session');
		send_mail_link($in);
	}
	//forgot
	public function forgot()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Email Not Exist','security'=>token()));
				return;	
			}
			$c = $check->row_array();
			$in['urls'] = site_url("plg/stats/forgot/".$c['activation_code']);
			$this->session->set_userdata('customermeong_forgot',$in);	
			 send_mail_forgot($in);
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function forgotsave()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$time = time();
			$check = $this->db->where('email',$in['email'])->get('customer');
			if($check->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Email Not Exist','security'=>token()));
				return;	
			}
			$this->db->where('id',$in['id'])->update("customer",array('passwords'=>$this->encryption->encrypt($in['password']))); 
			$this->session->set_userdata('customermeong_login',$check->row_array());
			json(array('error'=>false,'message'=>'Proses','security'=>token()));
			return;
		}
		show_404();
	}
	public function resendforgot()
	{
		$in = $this->session->userdata('customermeong_forgot');
		send_mail_forgot($in);
	}
	 
}
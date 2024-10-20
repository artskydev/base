<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in = array();
		$in['data'] = $this->db->get('setting')->row_array();
		$in['use_hedaer'] = true;
		$in['title'] = 'Master ';
		$in['desc'] = 'you can manage your  here';
		$in['tpl'] = 'setting/form';
		$this->load->view('manager/layout',$in);
		return;
	} 
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			 
				$this->db->where('id',$in['id']);
				$old = $this->db->get('setting');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					 
					$this->db->where('id',$in['id']);
					$this->db->update('setting',$in);
				}
				else
				{
					json(array('error'=>true,'message'=>'Data not found','security'=>token()));
					return;
				}
			 
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				$arr = $this->db->where('id',user_front('id'))->get('customer')->row_array();
				$this->session->set_userdata('customermeong_login',$arr);
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	
	 
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master tier';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/tier')] = 'City';
		$in['tpl'] = 'customer/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_customer.id';
			$columns    = array(
			array('db'=>'m_customer.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			 
			array('db'=>"m_customer.name",'dt'=>1,'alias'=>'infos'),
			array('db'=>"m_customer.telp",'dt'=>2,'alias'=>'telp'),
			array('db'=>"m_customer.email",'dt'=>3,'alias'=>'email'),
			array('db'=>"m_customer.wallet_address",'dt'=>4,'alias'=>'wallet_address'),
			 
			array('db'=>"m_customer.status",'dt'=>5,'alias'=>'status','formatter'=>function($d,$row){
				 if($d==1)
				 {
					 return "active";
				 }
				 return "Non active";
			}),
			 
			
			array('db'=>"DATE_FORMAT(FROM_UNIXTIME(m_customer.created_on),'%d-%m-%Y')",'dt'=>6,'alias'=>'created_on'),
			array('db'=>'m_customer.id','dt'=>7,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<span class="input-group-btn">
							<button class="btn btn-xs btn-sm btn-default btn-reset-users" type="button" data-toggle="tooltip" title="" data-original-title="Reset password user" data-ref="'.$row->ids.'"><i class="fa fa-asterisk"></i></button>
							 
							<button class="btn btn-xs btn-sm btn-danger btn-delete-users" type="button" data-toggle="tooltip" title="" data-original-title="Remove User" data-ref="'.$row->ids.'"><i class="fa fa-times"></i></button>
						</span>	
						 ';
			}),
			);
			$table = 'm_customer ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	 
	public function delete()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			if(is_array($id))
				$this->db->where_in('id',$id);
			else
				$this->db->where('id',$id);
			$this->db->delete('customer');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	public function reset_password()
	{
		if($this->input->post() && $this->input->is_ajax_request())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$this->db->where('id',$in['id']);
			$this->db->update('customer',array('passwords'=>$this->encryption->encrypt($in['pass'])));
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	 
}
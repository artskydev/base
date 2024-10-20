<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends Front_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master order';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/order')] = 'City';
		$in['tpl'] = 'order/main';
		 
		$this->load->view('customer/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_order.id';
			$columns    = array(
			array('db'=>'m_order.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_order.pid",'dt'=>1,'alias'=>'no_order'),
			 
			 
			array('db'=>"m_tier.presale_token",'dt'=>2,'alias'=>'presale_token','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_tier.bonus",'dt'=>3,'alias'=>'bonus','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_order.wallet_address",'dt'=>4,'alias'=>'wallet_address','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_order.transaction_hash",'dt'=>5,'alias'=>'transaction_hash','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_order.status",'dt'=>6,'alias'=>'status','formatter'=>function($d,$row){
				 $x = "<i class='fa fa-ban'></i>";
				 if($d==1)
				 {
					$x = "<i class='fa fa-check'></i>";	 
				 }
				 if($d==2)
				 {
					 $x =   "<i class='fa fa-times'></i>";
				 }
				 return $x;
			}),
			array('db'=>"m_order.tanggal",'dt'=>7,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			 
			);
			$table = 'm_order inner join m_tier on(m_tier.id=m_order.id_tier) ';
			$whereResult = NULL;
			$whereAll = "m_order.id_customer='".user_front("id")."'";
			
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add()
	{
		///============
		show_404();
		return;
		//=========
		$in['use_hedaer'] = true;
		$in['tier'] = $this->db->get('tier')->result_array();
		$in['title'] = 'Master order';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/order')] = 'customer';
		$in['tpl'] = 'order/form';
		 
		$this->load->view('customer/layout',$in);
	}
	public function edit($id)
	{
		///============
		show_404();
		return;
		//=========
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('order');
			if($rec->num_rows()==1)
			{
				$in['data'] = $rec->row_array();
				$in['use_hedaer'] = true;
				$in['title'] = 'Master order';
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/order')] = 'City';
				$in['tpl'] = 'order/form';
				 
				$this->load->view('manager/layout',$in);
				return;
			}
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
			$this->db->delete('order');
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
	public function match()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true);
			$this->db->where('id',$id);
			$data = $this->db->get('order');
			if($data->num_rows()==1)
			{
				json(array('error'=>false,'message'=>'one data found','data'=>$data->row_array(),'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'data not found','security'=>token()));
			return;
		}
		show_404();
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$cust = $this->db->where('id',user_front("id"))->get("customer")->row_array();
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			if(!isset($cust['id']))
			{
				json(array('error'=>true,'message'=>'Data not found','security'=>token()));
				return;
			}
			if(empty($cust['wallet_address']))
			{
				json(array('error'=>true,'message'=>'insert wallet address on profile','security'=>token()));
				return;
			}
			$in['presale_token'] = str_replace(",","",$in['presale_token']);
			$in['bonus'] = str_replace(",","",$in['bonus']);
			$in['usdt'] = str_replace(",","",$in['usdt']);
			
			$in['wallet_address'] = user_front("wallet_address");
			$in['id_customer'] = user_front("id");
			$in['tier_info'] = json_encode($this->db->where('id',$in['id_tier'])->get("tier")->row_array());
			$in['customer_info'] = json_encode($cust);
			$in['pid'] = get_unique_order(); 
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('order',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('order');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('order',$in);
				}
				else
				{
					json(array('error'=>true,'message'=>'Data not found','security'=>token()));
					return;
				}
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
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	 
}
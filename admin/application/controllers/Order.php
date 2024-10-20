<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends Smart_Controller
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
		 
		$this->load->view('manager/layout',$in);
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
			array('db'=>"CONCAT(m_customer.name,'<br/>(',m_customer.email,')<br>',if((m_customer.telegram_id is null),'',m_customer.telegram_id))",'dt'=>2,'alias'=>'custs'),
			 
			array('db'=>"m_tier.presale_token",'dt'=>3,'alias'=>'presale_token','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_tier.bonus",'dt'=>4,'alias'=>'bonus','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_order.usdt",'dt'=>5,'alias'=>'usdt','formatter'=>function($d,$row){
				 return number_format($d,0);
			}),
			array('db'=>"m_order.wallet_address",'dt'=>6,'alias'=>'wallet_address','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_order.transaction_hash",'dt'=>7,'alias'=>'transaction_hash','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_order.status",'dt'=>8,'alias'=>'status','formatter'=>function($d,$row){
				 $x = "<i class='fa fa-ban'></i>";
				 if($d==1)
				 {
					 $x =   "<i class='fa fa-check'></i>";
					 return $x;
				 }
				 if($d==2)
				 {
					 $x =   "<i class='fa fa-times'></i>";
				 }
				 
				 return "<button class='btn btn-info btn-sm btn-status' data-ref='".$row->ids."'>".$x."</button>";
			}),
			array('db'=>"m_order.tanggal",'dt'=>9,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			 array('db'=>'m_order.id','dt'=>10,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<span class="input-group-btn">
							<a class="btn btn-xs btn-sm btn-warning btn-edit-sites" type="button" data-toggle="tooltip" title="" data-original-title="Edit User" href="'.site_url('order/edit/'.$row->ids).'"><i class="fa fa-pen"></i></a>
						</span>	
						 ';
			}),
			);
			$table = 'm_order inner join m_tier on(m_tier.id=m_order.id_tier) inner join m_customer on(m_customer.id=m_order.id_customer)';
			$whereResult = NULL;
			$whereAll = "1=1";
			if(isset($_GET['status']))
			{
				if($_GET['status']!=-1)
				{
					$whereAll = "m_order.status='".$_GET['status']."'";
				}
			}
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('order');
			if($rec->num_rows()==1)
			{
				$in['data'] = $rec->row_array();
				$in['tier'] = $this->db->get('tier')->result_array();
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
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			 
			$in['presale_token'] = str_replace(",","",$in['presale_token']);
			$in['bonus'] = str_replace(",","",$in['bonus']);
			$in['usdt'] = str_replace(",","",$in['usdt']);
			
			//$in['wallet_address'] = user_front("wallet_address");
			/*$in['id_customer'] = user_front("id");
			$in['tier_info'] = json_encode($this->db->where('id',$in['id_tier'])->get("tier")->row_array());
			$in['customer_info'] = json_encode($cust);
			$in['pid'] = get_unique_order(); 
			*/
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
	public function status()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$check = $this->db->where('id',$in['id'])->get('order')->row_array();
			if(!isset($check['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$customer =  $this->db->where('id',$check['id_customer'])->get('customer')->row_array();
			if(!isset($customer['id']))
			{
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			$ref =  $this->db->where('id',$customer['refferal'])->get('customer')->row_array();
			
			// update order
			$this->db->where('id',$in['id'])->update('order',array("status"=>$in['status']));
			
			// update customer
			if($in['status']==1)
			{ 
				$total = $check['presale_token']+$check['bonus'];
				$customer['tokens'] += $total;
				 
				$this->db->where('id',$customer['id'])->update('customer',array("tokens"=>$customer['tokens']));
				
				//refferal
				if(isset($ref['id']))
				{
					
					//$total_users = $this->db->where('refferal',$ref['id'])->get("customer")->num_rows(); 
					
					$total_ref = settings("refferal");//doubleval(settings("refferal"))*$total_users;//(settings("refferal")/100)*$total;
					 
					$ref['tokens'] += $total_ref; 
					 
					$this->db->where('id',$ref['id'])->update('customer',array("tokens"=>$ref['tokens']));
				}
			}
			$this->db->trans_begin();
			
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wheel_number extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Wheel number';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/skor')] = 'City';
		$in['tpl'] = 'wheel/wheel_number/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_wheel_number.id';
			$columns    = array(
			array('db'=>'m_wheel_number.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_wheel_number.numbers",'dt'=>1,'alias'=>'numbers','formatter'=>function($d,$row){
				return $d;
			}),
			array('db'=>"m_wheel_number.address_wallet",'dt'=>2,'alias'=>'address_wallet','formatter'=>function($d,$row){
				  /*
				  $s = json_decode($d,true);
				  if(isset($s['email']))
				  {
					$p = $s['email']."<br/>";
					$p .= $s['telp']."<br/>";
					$p .= $s['wallet_address']."<br/>";
					return $p;	  
				  }
				  return;
				  */
				 /* $p = $row->email."<br/>";
				  $p .= $row->telp."<br/>";
				  $p .= $row->wallet_address."<br/>";
				  return $p;
				  */
				  return $d;
			}),
			array('db'=>"m_wheel_number.tanggal",'dt'=>3,'alias'=>'tanggal','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_wheel_number.winner",'dt'=>4,'alias'=>'winner','formatter'=>function($d,$row){
				  if($d==1)
				  {
					return "<i class='fa fa-check'></i>";	  
				  }
				  return "<i class='fa fa-ban'></i>";
			}),
			array('db'=>"m_wheel_number.paying_url",'dt'=>5,'alias'=>'paying_url','formatter'=>function($d,$row){
				 return $d;
			}),
			 
			array('db'=>'m_wheel_number.id','dt'=>6,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('wheel/wheel_number/edit/'.$d).' class="btn btn-xs btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							<button class="btn btn-xs btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			 
			
			/*array('db'=>"m_customer.email",'dt'=>10,'alias'=>'email'),
			array('db'=>"m_customer.telp",'dt'=>11,'alias'=>'telp'),
			array('db'=>"m_customer.wallet_address",'dt'=>12,'alias'=>'wallet_address'),
			*/
			
			);
			//$table = 'm_wheel_number inner join m_customer on(m_wheel_number.id_customer=m_customer.id) ';
			$table = 'm_wheel_number';
			$whereResult = NULL;
			$whereAll = '1=1';
			 
			if(isset($_GET['tanggal']))
			{
				if(!empty($_GET['tanggal']))
				{
					$whereAll .= " and m_wheel_number.tanggal='".$_GET['tanggal']."'";
				}
			}
			if(isset($_GET['winner']))
			{
				if($_GET['winner']!=-1)
				{
					$whereAll .= " and m_wheel_number.winner='".$_GET['winner']."'";
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
			$rec = $this->db->where('id',$id)->get('wheel_number');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$customer = json_decode($data['customer_info'],true);
				$in['data'] = $data;
				$in['customer'] = $customer;
				$in['use_hedaer'] = true;
				$in['title'] = 'Master skor';
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/skor')] = 'City';
				$in['tpl'] = 'wheel/wheel_number/form';
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
			$this->db->delete('wheel_number');
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
			$data = $this->db->get('wheel_number');
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
			$in = $this->input->post();
			$this->db->trans_begin();
			$time = time();
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('wheel_number',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('wheel_number');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('wheel_number',$in);
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
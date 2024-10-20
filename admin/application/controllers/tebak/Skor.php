<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Skor extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['tournament'] = $this->db->get('tournament')->result_array();
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Skor';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/skor')] = 'City';
		$in['tpl'] = 'tebak/skor/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_skor.id';
			$columns    = array(
			array('db'=>'m_skor.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_match.id",'dt'=>1,'alias'=>'matchs','formatter'=>function($d,$row){
				 $team1 = $this->db->where('id',$row->id_team1)->get('team')->row_array();
				 $team2 = $this->db->where('id',$row->id_team2)->get('team')->row_array();
				 if(isset($team2['name']) && isset($team1['name']))
				 {
					$c = $team1['name']."(".$row->skor_team1.") vs ";
					$c .= $team2['name']."(".$row->skor_team2.") vs ";
					return $c; 
				 }
				 return "";
			}),
			array('db'=>"m_skor.address_wallet",'dt'=>2,'alias'=>'address_wallet','formatter'=>function($d,$row){
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
			array('db'=>"m_skor.winner",'dt'=>3,'alias'=>'winner','formatter'=>function($d,$row){
				  if($d==1)
				  {
					return "<i class='fa fa-check'></i>";	  
				  }
				  return "<i class='fa fa-ban'></i>";
			}),
			array('db'=>"m_skor.paying_url",'dt'=>4,'alias'=>'paying_url','formatter'=>function($d,$row){
				 return $d;
			}),
			 
			array('db'=>'m_skor.id','dt'=>5,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('tebak/skor/edit/'.$d).' class="btn btn-xs btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							<button class="btn btn-xs btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			array('db'=>"m_match.id_team1",'dt'=>6,'alias'=>'id_team1'),
			array('db'=>"m_match.id_team2",'dt'=>7,'alias'=>'id_team2'),
			array('db'=>"m_skor.skor_team1",'dt'=>8,'alias'=>'skor_team1'),
			array('db'=>"m_skor.skor_team2",'dt'=>9,'alias'=>'skor_team2'),
			/*
			array('db'=>"m_customer.email",'dt'=>10,'alias'=>'email'),
			array('db'=>"m_customer.telp",'dt'=>11,'alias'=>'telp'),
			array('db'=>"m_customer.wallet_address",'dt'=>12,'alias'=>'wallet_address'),
			*/
			
			);
			$table = 'm_skor inner join m_match on(m_match.id=m_skor.id_match) ';
			//$table = 'm_skor inner join m_match on(m_match.id=m_skor.id_match) inner join m_customer on(m_skor.id_customer=m_customer.id) ';
			$whereResult = NULL;
			$whereAll = '1=1';
			if(isset($_GET['id_tournament']))
			{
				if($_GET['id_tournament']!="")
				{
					$whereAll .= " and m_match.id_tournament='".$_GET['id_tournament']."'";
				}
				if($_GET['id_team1']!="")
				{
					$whereAll .= " and m_match.id_team1='".$_GET['id_team1']."'";
				}
				if($_GET['id_team2']!="")
				{
					$whereAll .= " and m_match.id_team2='".$_GET['id_team2']."'";
				}
			}
			if(isset($_GET['winner']))
			{
				if($_GET['winner']!=-1)
				{
					$whereAll .= " and m_skor.winner='".$_GET['winner']."'";
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
			$rec = $this->db->where('id',$id)->get('skor');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$customer = json_decode($data['customer_info'],true);
				
				$match = $this->db->where('id',$data['id_match'])->get('match')->row_array();
				//if(isset($match['id']) && isset($customer['email']))
				if(isset($match['id']))
				
				{
					$team1 = $this->db->where('id',$match['id_team1'])->get('team')->row_array();
					$team2 = $this->db->where('id',$match['id_team2'])->get('team')->row_array();
					
					if(isset($team1['id']) && isset($team2['id']))
					{
						$match['team1'] = $team1['name'];
						$match['team2'] = $team2['name'];
						 
						$in['data'] = $data;
						$in['match'] = $match;
						$in['customer'] = $customer;
						$in['use_hedaer'] = true;
						$in['title'] = 'Master skor';
						$in['tournament'] = $this->db->get('tournament')->result_array();
						$in['desc'] = 'you can manage your province here';
						$in['bread']['#'] = 'Settings';
						$in['bread'][site_url('manager/skor')] = 'City';
						$in['tpl'] = 'tebak/skor/form';
						 
						$this->load->view('manager/layout',$in);
						return;
					}
				}
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
			$this->db->delete('skor');
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
			$data = $this->db->get('skor');
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
				$this->db->insert('skor',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('skor');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('skor',$in);
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Match extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['tournament'] = $this->db->get('tournament')->result_array();
		$in['title'] = ' Match';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/match')] = 'City';
		$in['tpl'] = 'tebak/match/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_match.id';
			$columns    = array(
			array('db'=>'m_match.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_tournament.name",'dt'=>1,'alias'=>'tournament'),
			array('db'=>"m_event.name",'dt'=>2,'alias'=>'events'),
			array('db'=>"(select name from m_team a where a.id=m_match.id_team1 limit 1)",'dt'=>3,'alias'=>'team1','formatter'=>function($d,$row){
				return $d."(".$row->skor1.")";
			}),
			array('db'=>"(select name from m_team a where a.id=m_match.id_team2 limit 1)",'dt'=>4,'alias'=>'team2','formatter'=>function($d,$row){
				return $d."(".$row->skor2.")";
			}),
			array('db'=>"concat(m_match.start_date,' - ',m_match.end_date)",'dt'=>5,'alias'=>'tgl'), 
			array('db'=>'m_match.id','dt'=>6,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('tebak/match/edit/'.$d).' class="btn btn-xs btn-sm btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							<button class="btn btn-xs btn-sm btn-warning btn-sm btn-winner" type="button" data-toggle="tooltip" title="" data-original-title="Winner " data-ref="'.$d.'"><i class="fa fa-star"></i></button> 
							
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			array('db'=>"m_match.skor_team1",'dt'=>7,'alias'=>'skor1'),
			array('db'=>"m_match.skor_team2",'dt'=>8,'alias'=>'skor2'),
			
			);
			$table = 'm_match inner join m_event on(m_event.id=m_match.id_event) inner join m_tournament on(m_tournament.id=m_event.id_tournament) ';
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
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function add()
	{
		$in['tournament'] = $this->db->get('tournament')->result_array();
		$in['use_hedaer'] = true;
		$in['title'] = ' match';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/match')] = 'City';
		$in['tpl'] = 'tebak/match/form';
		 
		$this->load->view('manager/layout',$in);
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('match');
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();
				$in['data'] = $data;
				$in['use_hedaer'] = true;
				$in['title'] = ' match';
				$in['tournament'] = $this->db->get('tournament')->result_array();
				$in['event'] = $this->db->where('id_tournament',$data['id_tournament'])->get('event')->result_array();
				$in['team'] = $this->db->where('id_tournament',$data['id_tournament'])->get('team')->result_array();
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/match')] = 'City';
				$in['tpl'] = 'tebak/match/form';
				 
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
			$this->db->delete('match');
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
	public function winner()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			$match = $this->db->where('id',$id)->get('match')->row_array();
			if(isset($match['id']))
			{
				$skor = $this->db
				->where('id_match',$id)
				->where('skor_team1',$match['skor_team1'])
				->where('skor_team2',$match['skor_team2'])
				->get('skor');
				
				if($skor->num_rows()>0)
				{
					$arr = $skor->result_array();
					for($i=0;$i<count($arr);$i++)
					{
						$this->db->where('id',$arr[$i]['id'])->update('skor',array('winner'=>1));
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
				}
				
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
			$data = $this->db->get('match');
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
			$in['tournament_info'] = json_encode($this->db->where('id',$in['id_tournament'])->get('tournament')->row_array()); 
			$in['event_info'] = json_encode($this->db->where('id',$in['id_event'])->get('event')->row_array()); 
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('match',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('match');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('match',$in);
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
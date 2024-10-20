<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Event extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master Event';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/event')] = 'City';
		$in['tpl'] = 'tebak/event/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_event.id';
			$columns    = array(
			array('db'=>'m_event.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"t_tournament.name",'dt'=>1,'alias'=>'tournament'),
			array('db'=>"m_event.name",'dt'=>2,'alias'=>'name'),
			 
			array('db'=>'m_event.id','dt'=>3,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							<a href='.site_url('tebak/event/edit/'.$d).' class="btn btn-xs btn-warning btn-sm " type="button" data-toggle="tooltip" title="" data-original-title="Edit" data-ref="'.$d.'"><i class="fa fa-pencil-alt"></i></a>
							<button class="btn btn-xs btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
						 ';
			}),
			);
			$table = 'm_event inner join t_tournament on(t_tournament.id=m_event.id_tournament) ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
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
		$in['title'] = 'Master event';
		$in['desc'] = 'you can manage your province here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/event')] = 'City';
		$in['tpl'] = 'tebak/event/form';
		 
		$this->load->view('manager/layout',$in);
	}
	public function edit($id)
	{
		if(!empty($id))
		{
			$rec = $this->db->where('id',$id)->get('event');
			if($rec->num_rows()==1)
			{
				$in['data'] = $rec->row_array();
				$in['use_hedaer'] = true;
				$in['title'] = 'Master event';
				$in['tournament'] = $this->db->get('tournament')->result_array();
				$in['desc'] = 'you can manage your province here';
				$in['bread']['#'] = 'Settings';
				$in['bread'][site_url('manager/event')] = 'City';
				$in['tpl'] = 'tebak/event/form';
				 
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
			$this->db->delete('event');
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
			$data = $this->db->get('event');
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
			if(empty($in['id']))
			{
				$in['created_by'] = user_info('id');
				$in['updated_by'] = user_info('id');
				$in['created_on'] = $time;
				$in['updated_on'] = $time;
				$this->db->insert('event',$in);
			}
			else
			{
				$this->db->where('id',$in['id']);
				$old = $this->db->get('event');
				if($old->num_rows()==1)
				{
					$arr = $old->row_array();
					$in['updated_by'] = user_info('id');
					$in['updated_on'] = $time;
					$this->db->where('id',$in['id']);
					$this->db->update('event',$in);
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
	public function gettour()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true);
			$data = $this->db->where('id_tournament',$id)->get('event');
			$team =  $this->db->where('id_tournament',$id)->get('team'); 
			if($data->num_rows()>0 && $team->num_rows()>0)
			{
				
				json(array('error'=>false,'message'=>'data found','data'=>$data->result_array(),'team'=>$team->result_array(),'security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'data not found','security'=>token()));
			return;
		}
		show_404();
	}
	 
}
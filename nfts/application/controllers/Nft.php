<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nft extends Front_Controller {

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
	public function create()
	{
		$in = array();
		//$this->session->unset_userdata('velocity_nft_wallet'); 
		$in['items'] = $this->db
						  ->where('id_nftcustomer',user_info('id'))
						  ->order_by('id desc')->get('v_nft_liked')->row_array();	
						
						/*$this->db
						->select("m_nft_supply.*,coalesce((select count(m_nft_heart.id) as total from m_nft_heart where   m_nft_heart.id_nft_supply = m_nft_supply.id and m_nft_heart.id_nftcustomer='".user_info('id')."' limit 1),0) as hearts, day(end_date) AS day_limit, MONTH(end_date) AS bulan_limit,YEAR(end_date) AS tahun_limit")
						->order_by('id desc')
						->where('id_nftcustomer',user_info('id'))->get("nft_supply")->row_array(); 
						*/
		
		$in['collections'] = $this->db
						  ->select('collection')
						  ->where('id_nftcustomer',user_info('id'))
						  ->group_by('collection')
						   ->get('nft_supply')->result_array();	
		 
		$in['hearts'] =  0;
		if(isset($in['items']['id']))
		{
			$in['hearts'] = gethearts($in['items']['id']);	
		}
		$in['data'] = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
		 
			
		$in['bread']['#'] = 'create';
		
		$in['nftcreate'] = 'create';
		$in['scripts'] = "nft/scripts/create"; 
		$in['title'] = ""; 
		$in['tpl'] = "nft/create";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			 
			  if(isset($_FILES['image']))
			 {
				if($_FILES['image']['error']==0)
				{
					$name = get_unique_file($_FILES['image']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['image']['tmp_name'],config_item('upload_path').$name))
					{
						$in['image'] = $name;
					}
				}
			 }
			$time = time();
			$in['id_nftcustomer'] = user_info("id");
			
			$network = get_function_network('bsc_testnet');
			$in['network'] = isset($network['network'])?$network['network']:"";
			$in['network_tipe'] = isset($network['network_tipe'])?$network['network_tipe']:"";
			$in['network_url'] = isset($network['network_url'])?$network['network_url']:"";
			$in['contract_address'] = isset($network['contract_address'])?$network['contract_address']:"";
			
			$in['tipe'] = 0;
			if(!empty($in['minimum_bid']))
			$in['tipe'] = 1;
			if(!empty($in['start_date']))
			$in['tipe'] = 2;
			
			if(!empty($in['start_date']))
			$in['start_date'] = date('Y-m-d',strtotime($in['start_date']));
			if(!empty($in['end_date']))
			$in['end_date'] = date('Y-m-d',strtotime($in['end_date']));
			 
			$sub = array();
			if(isset($in['sub']))
			{
				$sub = $in['sub'];	
				unset($in['sub']);
			}
			$this->db->trans_begin();
			
;
		 
			$this->db->insert('nft_supply',$in);
			$id = $this->db->insert_id(); 
			if(count($sub)>0)
			{
				for($i=0;$i<count($sub);$i++)
				{
					$vv = array();
					$vv['sub'] = $sub[$i];
					$vv['id_nft_supply'] = $id;
					$vv['id_brand'] = $in['id_brand'];
					$this->db->insert('nft_supplysub',$vv);
					
				}
			}
			if($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				$c = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
				if(isset($c['id']))
				$this->session->set_userdata('velocity_nft_login',$c);
				
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	}
	 
	public function author()
	{
		$in = array();
		 
		$in['data'] = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
			
		$in['bread']['#'] = 'author';
		
		$in['title'] = ""; 
		$in['tpl'] = "users/author";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function hearts()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true); 
			$in = array();
			$in['tgl'] = date('Y-m-d h:i:s');
			$data = $this->db
			->where('id_nft_supply',$id)
			->where('id_nftcustomer',user_info('id'))
			->get('nft_heart');
			$this->db->trans_begin(); 
			$status = false;
			if($data->num_rows()>0)
			{
				$this->db
				->where('id_nft_supply',$id)
				->where('id_nftcustomer',user_info('id'))->delete('nft_heart');
				$status = false;
				
			}else
			{
				
				$in['id_nftcustomer'] = user_info('id');
				$in['nftcustomer_info'] = json_encode($this->db->where('id',user_info('id'))->get("nft_customer")->row_array());
				$in['id_nft_supply'] = $id;
				$in['nft_supply_info'] = json_encode($this->db->where('id',$id)->get("nft_supply")->row_array());
				
				$this->db->insert('nft_heart',$in);
				$status = true;
			}
			if($this->db->trans_status() === FALSE)
			{
					$this->db->trans_rollback();
					json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
					return;
			}
			else
			{
					
					$this->db->trans_commit();	
					json(array('error'=>false,'message'=>'one data found','status'=>$status,"heart"=>gethearts($id),'security'=>token()));
					return;
					
			}
			
		}
		show_404();
	}
	//saveimage
	public function saveimage()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			//$in = $this->input->post();
			$in['image'] = ""; 
			  if(isset($_FILES['image']))
			 {
				if($_FILES['image']['error']==0)
				{
					$name = get_unique_file($_FILES['image']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['image']['tmp_name'],config_item('upload_path').$name))
					{
						$in['image'] = $name;
					}
				}
			 }
			json(array('error'=>false,'message'=>'one data found','data'=>$in,'security'=>token()));
			return;
		}
		json(array('error'=>true,'message'=>'one data found','data'=>array(),'security'=>token()));
			return;
	}
	
	 
}


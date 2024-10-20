<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Front_Controller {

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
	 
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			 
			  
			$time = time();
			 
			
			$network = get_function_network('bsc_testnet');
			$in['network'] = isset($network['network'])?$network['network']:"";
			$in['network_tipe'] = isset($network['network_tipe'])?$network['network_tipe']:"";
			$in['network_url'] = isset($network['network_url'])?$network['network_url']:"";
			$in['contract_address'] = isset($network['contract_address'])?$network['contract_address']:"";
			
			$in['customer_by'] = user_info('id');
			$in['tgl'] = date('Y-m-d h:i:s');
			$this->db->trans_begin();
			
;
		 
			 $this->db->insert('nft_order',$in);
			 
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
	
	
	 
}


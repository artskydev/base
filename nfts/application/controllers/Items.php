<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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
	public function view($params = "")
	{
		if(!empty($params))
		{
			$rec = $this->db->where('tokenid',$params)->get("v_nft_liked");
			if($rec->num_rows()==1)
			{
				$data = $rec->row_array();

				$in = array();
				 
				$in['data'] = $data;
				$in['items'] = $data; 
				$in['customers'] = $this->db->where('id',$data['id_nftcustomer'])->get('nft_customer')->row_array();
				
				$in['order_bid'] = $this->db->where('type',1)->where('tokenid',$params)->get('nft_order')->result_array();
				
				$in['order_all'] = $this->db
									->select('m_nft_customer.*,m_nft_order.tgl,m_nft_order.price,m_nft_order.fee_price')
									->join('m_nft_customer','m_nft_customer.id=m_nft_order.customer_by','inner')
									->order_by('tgl DESC')
									->limit(5)
									->where('tokenid',$params)->get('nft_order')->result_array();
				
				$in['transaksi'] = 1;
				$in['scripts'] = "nft/scripts/transaksi";
				
				$in['bread']['#'] = 'author';
				
				$in['title'] = ""; 
				$in['tpl'] = "nft/items";
				$this->load->view('manager/layout',$in);
				return; 
			}
		}
		redirect("404");
		return;
	}
	public function getowner()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			
			$check =  $this->db
						->select('m_nft_customer.*')
						->join('m_nft_customer','m_nft_customer.id=m_nft_order.customer_by','inner')
						->where('wallet_to',$in['wallet_address'])
						->order_by('tgl DESC')
						->limit(1)
						->get('nft_order');
			
			if($check->num_rows()==0)
			{
				$check = $this->db->where('wallet_address',$in['wallet_address'])->get('nft_customer');
				
			}
			if($check->num_rows()==0)
			{
				json(array('error'=>true,'message'=>'Owner Not Exist','security'=>token()));
				return;	
			}
			$in['data'] = $check->row_array();
			$temps = $this->load->view('manager/nft/temps/owner',$in,true); 
			json(array('error'=>false,'message'=>'Proses','temp'=>$temps,'security'=>token()));
			return;
		}
		show_404();
	}
	 
}


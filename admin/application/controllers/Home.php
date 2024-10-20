<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Smart_Controller {

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
	public function index()
	{
		redirect("home/nft");
		return;
		//
		
		$in = array(); 
		$in['users'] = $this->db->get("customer")->num_rows(); 
		$in['order'] = $this->db->get("order")->num_rows(); 
		$in['arr'] = $this->db
						->select("m_order.*, m_customer.name as customer,m_tier.name as tiers")
						->join("m_customer","m_order.id_customer=m_customer.id","inner")
						->join("m_tier","m_order.id_tier=m_tier.id","inner")
						->order_by("created_on","desc")
						
						->limit(10)->get("order")->result_array(); 
		$in['total_token'] = $this->db->select("sum(tokens) as total")
							 ->get("customer")->row_array(); 
		$in['total_usdt'] = $this->db->select("sum(usdt) as total")
							 ->where("status",1)
							 ->get("order")->row_array();				
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function presale()
	{
		 
		
		$in = array(); 
		$in['users'] = $this->db->get("customer")->num_rows(); 
		$in['order'] = $this->db->get("order_presale")->num_rows(); 
		$in['arr'] = $this->db
						->select("order_presale.*, m_customer.name as customer,m_tier.name as tiers")
						->join("m_customer","m_order_presale.id_customer=m_customer.id","inner")
						->join("m_tier","m_order_presale.id_tier=m_tier.id","inner")
						->order_by("created_on","desc")
						
						->limit(10)->get("order_presale")->result_array(); 
		$in['total_token'] = $this->db->select("sum(tokens) as total")
							 ->get("customer")->row_array(); 
		$in['total_usdt'] = $this->db->select("sum(usdt) as total")
							 ->where("status",1)
							 ->get("order_presale")->row_array();				
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard_presale";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function games()
	{
		$in['wheel'] = $this->db->get('wheel_number')->num_rows();
		$in['skor'] = $this->db->get('skor')->num_rows();
		$in['arr'] = $this->db->order_by('id desc')->limit(10)->get('wheel_number')->result_array();
		$match = $this->db->query("select m_skor.*,m_match.id_team1,m_match.id_team2 from m_skor inner join m_match on(m_match.id=m_skor.id_match)  order by id desc limit 10")->result_array();
		for($i=0;$i<count($match);$i++)
		{
			$match[$i]['team1'] = $this->db->where('id',$match[$i]['id_team1'])->get('team')->row_array();
			$match[$i]['team2'] = $this->db->where('id',$match[$i]['id_team2'])->get('team')->row_array();
				
		}
		$in['match'] = $match;
		$in['title'] = ""; 
		$in['tpl'] = "home/games";
		$this->load->view('manager/layout',$in);
		return; 
	}
	
	public function nft()
	{
		 
		
		$in = array(); 
		$in['users'] = $this->db->get("nft_customer")->num_rows(); 
		$in['order'] = $this->db->get("nft_order")->num_rows(); 
		$in['arr'] = $this->db
						->select("m_nft_order.*, m_nft_customer.name as customer,m_nft_supply.name as nftname")
						->join("m_nft_customer","m_nft_order.customer_by=m_nft_customer.id","inner")
						->join("m_nft_supply","m_nft_supply.id=m_nft_order.id_nft_supply","inner") 
						->order_by("created_on","desc")
						
						->limit(10)->get("nft_order")->result_array(); 
		$in['fee_price'] = $this->db->select("sum(fee_price) as total")
							 ->get("nft_order")->row_array(); 
		$in['pricesx'] = $this->db->select("sum(price) as total")
							 ->get("nft_order")->row_array(); 
		$in['setting'] = $this->db
							 ->get("setting")->row_array();					 				
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard_nft";
		$this->load->view('manager/layout',$in);
		return; 
	}
}


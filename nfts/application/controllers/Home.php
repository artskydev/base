<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		 
		$in = array();
		 
		$in['cats'] = get_property();			
		
		$in['banners'] = $this->db
					->select("m_v_nft_liked.*,m_nft_customer.image as customers,m_nft_customer.uuid")
					->join("m_nft_customer","m_nft_customer.id=v_nft_liked.id_nftcustomer","inner")
					->where('m_v_nft_liked.homes=1')
					->order_by("total_liked desc")
					 
					->get('v_nft_liked')->result_array();
		 			
		$in['nft'] = $this->db
					->select("m_v_nft_liked.*,m_nft_customer.image as customers,m_nft_customer.uuid")
					->join("m_nft_customer","m_nft_customer.id=v_nft_liked.id_nftcustomer","inner")
					->order_by("total_liked desc")
					->limit(8)
					->get('v_nft_liked')->result_array();
					
		$in['news'] = $this->db
					->select("m_v_nft_liked.*,m_nft_customer.image as customers,m_nft_customer.uuid")
					->join("m_nft_customer","m_nft_customer.id=v_nft_liked.id_nftcustomer","inner")
					->order_by("id desc")
					->limit(12)
					->get('v_nft_liked')->result_array();
		$in['hot'] = $this->db
					  ->select("m_nft_customer.*,m_nft_brand.name as brand,m_nft_brand.image as image_brand,(select sum(if(m_v_nft_liked.price=0,m_v_nft_liked.minimum_bid,m_v_nft_liked.price)) as total from m_v_nft_liked where m_v_nft_liked.id_nftcustomer = m_nft_customer.id limit 1) as toped")
					  ->join("m_nft_customer","m_nft_customer.id=m_nft_brand.id_nft_users","inner")
					  ->where("(select sum(if(m_v_nft_liked.price=0,m_v_nft_liked.minimum_bid,m_v_nft_liked.price)) as total from m_v_nft_liked where m_v_nft_liked.id_nftcustomer = m_nft_customer.id limit 1) >0 ")
					  ->order_by("toped desc")
					  ->limit(12)
					  ->get("nft_brand")->result_array();
		 			  
		$in['tops'] = $this->db
					  ->select("m_nft_customer.*,(select sum(if(m_v_nft_liked.price=0,m_v_nft_liked.minimum_bid,m_v_nft_liked.price)) as total from m_v_nft_liked where m_v_nft_liked.id_nftcustomer = m_nft_customer.id limit 1) as toped")
					  ->where("(select sum(if(m_v_nft_liked.price=0,m_v_nft_liked.minimum_bid,m_v_nft_liked.price)) as total from m_v_nft_liked where m_v_nft_liked.id_nftcustomer = m_nft_customer.id limit 1) >0 ")
					  ->order_by("toped desc")
					  ->limit(12)
					  ->get("nft_customer")->result_array();									
		
		
		$in['bread']['#'] = 'Dashboard';
		$in['title'] = ""; 
		$in['tpl'] = "home/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	
	 
}


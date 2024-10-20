<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front_Controller {

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
		$in['users'] = $this->db->get("customer")->num_rows(); 
		$in['order'] = $this->db->where('id_customer',user_front('id'))->get("order")->num_rows(); 
		$in['arr'] = $this->db
						->select("m_order.*, m_customer.name as customer,m_tier.name as tiers")
						->join("m_customer","m_order.id_customer=m_customer.id","inner")
						->join("m_tier","m_order.id_tier=m_tier.id","inner")
						->order_by("created_on","desc")
						->where('id_customer',user_front('id'))
						->limit(10)->get("order")->result_array(); 
		$in['refferal'] = $this->db->where('refferal',user_front('id'))->get("customer")->num_rows(); 
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "home/dashboard";
		$this->load->view('customer/layout',$in);
		return; 
	}
	
}


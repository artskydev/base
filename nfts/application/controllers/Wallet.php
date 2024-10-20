<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallet extends CI_Controller {

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
		 
		 
			
		$in['bread']['#'] = 'Dashboard';
		
		$in['title'] = ""; 
		$in['tpl'] = "wallet/main";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			if(isset($in['wallet_address']))
			{
				$this->db->trans_begin(); 
		 		$this->db->where('id',user_info('id'))->update('m_nft_customer',array("wallet_address"=>$in['wallet_address'],'token_balance'=>$in['token_balance']));
				$this->db->trans_commit();
				$c = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
				if(isset($c['id']))
				$this->session->set_userdata('artsky_nft_login',$c);
			}
			$this->session->set_userdata('artsky_nft_wallet',$in);
			 
		}
	}
	 
}


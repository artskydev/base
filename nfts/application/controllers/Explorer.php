<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Explorer extends CI_Controller {

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
		
		$items =  array(); //$this->db->query($sql)->result_array();
		$in = array();
		$data = $this->db->where('id',$params)->get("nft_category")->row_array();
		$in['catname'] = isset($data['name'])?$data['name']:"";
		$in['qq'] = isset($_GET['qq'])?$_GET['qq']:"";
		$in['arr'] = $items;
		$in['params'] = $params;
		$in['cats'] = get_property();
		$in['brand'] = $this->db->get('nft_brand')->result_array();
		$in['bread']['#'] = 'author';
		$in['title'] = ""; 
		$in['tpl'] = "nft/explorer";
		$this->load->view('manager/layout',$in);
		return; 
		
	}
	public function exs()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			$cats = "";
			$tipe = "";
			/*if(!empty($params))
			{
				$cats = "and id_nftcategory='".$params."'";
			}*/
			/*if(isset($in['id']))
			{
				$cats = "and m_v_nft_liked.id_nftcategory in('".implode("','",$in['id'])."')";	
			}
			$tipe = "";
			if(isset($in['tipe']))
			{
				$tipe = "and m_v_nft_liked.tipe in('".implode("','",$in['tipe'])."')";	
			}*/
			if(isset($in['category']))
			{
				if($in['category'] != "All categories")
				$cats = "and m_v_nft_liked.id_nftcategory in(select id from m_nft_category where name='".$in['category']."')";
			}
			if(isset($in['brand']))
			{
				if($in['brand'] != "All Brand")
				$cats = "and m_v_nft_liked.brand='".$in['brand']."'";
			}
			if(isset($in['q']))
			{
				if(!empty($in['q']))
				{
					$cats = "and (m_v_nft_liked.name like '%".$in['q']."%' or m_v_nft_liked.brand like '%".$in['q']."%' or m_v_nft_liked.collection like '%".$in['q']."%')";
				}
			}
			$page = $in['page'];
			$limit = 9;
			$numpage = $limit * $page;
			$sql = "select m_v_nft_liked.*,m_nft_customer.image as customers,m_nft_customer.name as name_cus,m_nft_customer.uuid from m_v_nft_liked inner join m_nft_customer on (m_nft_customer.id=m_v_nft_liked.id_nftcustomer) where 1=1 ".$cats." ".$tipe." order by m_v_nft_liked.id limit ".$limit." offset ".$numpage." ";
			$items =  $this->db->query($sql)->result_array();
			$in['arr'] = $items;
			 
			$temps = $this->load->view('manager/nft/itemexplore_arr',$in,true); 
			json(array('error'=>false,'message'=>'Proses','data'=>$items,'security'=>token(),"temps"=>$temps));
			return;
		}
	}
	public function live_action($params = "")
	{
		
		 
		$in = array();
		$sql = "select m_v_nft_liked.*,m_nft_customer.image as customers,m_nft_customer.name as name_cus,m_nft_customer.uuid from m_v_nft_liked inner join m_nft_customer on (m_nft_customer.id=m_v_nft_liked.id_nftcustomer) where 1=1 and tipe=2 and  ((NOW()>=start_date AND NOW()<=end_date))  order by m_v_nft_liked.id  ";
		$items =  $this->db->query($sql)->result_array();
		 
		$in['arr'] = $items;
		$in['params'] = $params;
		$in['cats'] = get_property();
		$in['bread']['#'] = 'Live Action';
		$in['title'] = ""; 
		$in['tpl'] = "nft/live_action";
		$this->load->view('manager/layout',$in);
		return; 
		
	}
	 
}


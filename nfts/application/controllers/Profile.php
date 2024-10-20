<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends Front_Controller {

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
		//$this->session->unset_userdata('velocity_nft_wallet'); 
		$in['brand'] = $this->db->where('id_nft_users',user_info('id'))->get("nft_brand")->row_array();
		$in['data'] = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
			
		$in['bread']['#'] = 'profile';
		
		$in['title'] = ""; 
		$in['tpl'] = "users/profile";
		$this->load->view('manager/layout',$in);
		return; 
	}
	public function save()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			if(!isset($in['notif_item_sold']))
			{
				$in['notif_item_sold'] = 0;
			}
			if(!isset($in['notif_auction']))
			{
				$in['notif_auction'] = 0;
			}
			$brand = array();
			if(isset($in['brand']))
			{
				$brand = $in['brand'];	
				unset($in['brand']);
			}
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
			  if(isset($_FILES['banner']))
			 {
				if($_FILES['banner']['error']==0)
				{
					$name = get_unique_file($_FILES['banner']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['banner']['tmp_name'],config_item('upload_path').$name))
					{
						$in['banner'] = $name;
					}
				}
			 }
			 if(isset($_FILES['brand_image']))
			 {
				if($_FILES['brand_image']['error']==0)
				{
					$name = get_unique_file($_FILES['brand_image']['name']);
					if(!file_exists(config_item('upload_path').$name) && move_uploaded_file($_FILES['brand_image']['tmp_name'],config_item('upload_path').$name))
					{
						$brand['image'] = $name;
					}
				}
			 }
			$time = time();
			 
			$this->db->trans_begin();
			$uu = "";
			foreach($in as $p => $key)
			{
					$uu .= $p."='".$key."',";
					
			}
			 $this->db->where('id',user_info('id'));
		 
			 $this->db->update('m_nft_customer',$in);
			 
			 if(isset($brand['name']))
			 $this->db->where('id_nft_users',user_info('id'))->update('nft_brand',$brand);
			 
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
		redirect("author/view/".user_info('uuid'));
		return;
		$in = array();
		 
		$in['data'] = $this->db->where('id',user_info('id'))->get("nft_customer")->row_array();
			
		$in['bread']['#'] = 'author';
		
		$in['title'] = ""; 
		$in['tpl'] = "users/author";
		$this->load->view('manager/layout',$in);
		return; 
	}
	
	
	 
}


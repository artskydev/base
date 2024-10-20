<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notif extends Front_Controller {

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
			 
			
			$network = get_function_network('bsc');
			$desc['message'] = "NFT have been transfer successfully!";
			$desc['network'] = $network;
			$in['description'] = json_encode($desc);
			$in['tgl'] = date('Y-m-d h:i:s');
			set_notif($in);
			json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
			return;
		}
		show_404();
	}
	public function readed($params)
	{
		$rec = $this->db->where('id',$params)->get("nft_notif");
		if($rec->num_rows()==1)
		{
			$this->db->trans_begin();
			$this->db->where('id',$params)->update('nft_notif',array('readed'=>1));
			$this->db->trans_commit();
			
		}
		redirect("home");
		return;
	}
	 
	
	
	 
}


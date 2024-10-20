<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller {

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
			$rec = $this->db->where('uuid',$params)->get("nft_customer");
			if($rec->num_rows()==1)
			{
			 
				$data = $rec->row_array();
				$in = array();
				$in['cauthors'] = true; 
				$in['author_data'] = $data;
				
				$in['scripts'] = "users/scripts/items"; 
				$in['data'] = $data;
				$in['price'] = $this->db
						  ->where('id_nftcustomer',$data['id'])
						  ->where('tipe',0)->get('v_nft_liked')->result_array();	
				$in['auction'] = $this->db
						  ->where('id_nftcustomer',$data['id'])
						  ->where('tipe',2)->get('v_nft_liked')->result_array();	
				 		  
				$in['likes'] = $this->db
						  ->where('id_nftcustomer',$data['id'])
						  ->where("total_liked>0")
						  ->order_by("total_liked desc")
						  ->get('v_nft_liked')->result_array();			  
				$in['follow'] = $this->db
								->where('nftcustomer_from',user_info('id'))
								->where('nftcustomer_to',$data['id'])->get('nft_follow')->num_rows();
				$in['bread']['#'] = 'author';
				
				$in['title'] = ""; 
				$in['tpl'] = "users/author";
				$this->load->view('manager/layout',$in);
				return; 
			}
		}
		redirect("404");
		return;
	}
	public function gettemp()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$in = $this->input->post();
			if(is_array($in['tokenid']) && isset($in['tokenid']))
			{
				$arr = array();
				for($i=0;$i<count($in['tokenid']);$i++)
				{
					$check =  $this->db
								->select('m_v_nft_liked.*')
								->join('m_nft_order','m_nft_order.id_nft_supply=m_v_nft_liked.id','inner')
								->join('m_nft_customer','m_nft_customer.id=m_nft_order.customer_by','inner')
								->where('m_v_nft_liked.tokenid',$in['tokenid'][$i])
								->where('wallet_to',$in['wallet_address'])								 
								->get('v_nft_liked')->row_array();
					if(isset($check['id']))
					$arr[] = $check; 			
								
				}
				
				if(count($arr)>0)
				{ 
					$in['data'] = $arr;
					$in['dont_show'] = true;
					$temps = $this->load->view('manager/users/isi_auth/arrayitems',$in,true); 
					json(array('error'=>false,'message'=>'Proses','data'=>$arr,'temp'=>$temps,'security'=>token()));
					return;
				}
				
			}
			json(array('error'=>true,'message'=>'failed','security'=>token()));
			return;
		}
		show_404();
	}
	public function follows()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			$id = $this->input->post('id',true); 
			$data = $this->db
			->where('nftcustomer_from',user_info('id'))
			->where('nftcustomer_to',$id)
			->get('nft_follow');
			$this->db->trans_begin(); 
			$status = false;
			if($data->num_rows()>0)
			{
				$this->db
				->where('nftcustomer_from',user_info('id'))
				->where('nftcustomer_to',$id)->delete('nft_follow');
				$status = false;
				$c = array();
				 
				
			}else
			{
				
				$in['nftcustomer_from'] = user_info('id');
				 
				$in['nftcustomer_to'] = $id;
				$in['tgl'] = date('Y-m-d h:i:s');
				/*$c['message'] = "";
				$c['tgl'] = $in['tgl'];
				$c['type'] = 3;
				
				set_notif($c);
				*/
				$this->db->insert('nft_follow',$in);
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
					json(array('error'=>false,'message'=>'one data found','status'=>$status,"follow"=>getfollow($id),'security'=>token()));
					return;
					
			}
		}
		show_404();
	}
}


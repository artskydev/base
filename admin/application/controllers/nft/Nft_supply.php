<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 

class Nft_supply extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		
		$in['title'] = ' Nft Item';
		$in['desc'] = 'you can manage your Nft Item here';
		$in['bread']['#'] = 'Nft Item';
		$in['bread'][site_url('manager/nft/nft_supply')] = 'Nft Item';
		$in['tpl'] = 'nft/item/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_nft_supply.id';
			$columns    = array(
			array('db'=>'m_nft_supply.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>'m_nft_customer.uuid','dt'=>1,'alias'=>'uuid','formatter'=>function($d,$row){
				return $d;
			}),
			array('db'=>'(select a.name from m_nft_category a where a.id= m_nft_supply.id_nftcategory limit 1)','dt'=>2,'cat'=>'cats','formatter'=>function($d,$row){
				return $d;
			}),
			array('db'=>"m_nft_supply.name",'dt'=>3,'alias'=>'name'),
		 	
			 
			array('db'=>'if(m_nft_supply.tipe=2,m_nft_supply.minimum_bid,m_nft_supply.price)','dt'=>4,'alias'=>'price','formatter'=>function($d,$row){
				if($row->tipe==2)
				return "Minimum Bid: <b>".$d."</b>";
				return $d;
			}), 
			array('db'=>'m_nft_supply.tipe','dt'=>5,'alias'=>'tipe','formatter'=>function($d,$row){
				
				return nft_tipe($d);
			}),
			array('db'=>'m_nft_supply.ipfs','dt'=>6,'alias'=>'image','formatter'=>function($d,$row){
				return "<img src='".$d."' width='80' height='80'/>";
			}), 
			array('db'=>'m_nft_supply.homes','dt'=>7,'alias'=>'homes','formatter'=>function($d,$row){
				 $a = '<a class="btn btn-xs btn-danger  btn-checked" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$row->ids.'" data-displays="'.$d.'"><i class="fa fa-ban"></i></a>';
				 if($d==1)
				 {
					 $a = '<button class="btn btn-xs btn-warning btn-sm btn-checked" type="button" data-toggle="tooltip" title="" data-original-title=" " data-ref="'.$row->ids.'" data-displays="'.$d.'"><i class="fa fa-check"></i></button>';
				 }
				 return $a;
			}), 
			array('db'=>'m_nft_supply.tokenid','dt'=>8,'alias'=>'tokenid','formatter'=>function($d,$row){
				return $d;
			}),
			array('db'=>'m_nft_supply.txhash','dt'=>9,'alias'=>'txhash','formatter'=>function($d,$row){
				return "<a href='".$row->network_url."/token/".$row->contract_address."?a=".$d."' target='_blank'>".$d."</a>";
			}), 
			array('db'=>'m_nft_supply.id','dt'=>10,'alias'=>'id','formatter'=>function($d,$row){
				return ' 
							 
							<button class="btn btn-xsbtn-sm btn-danger btn-sm btn-delete-sites" type="button" data-toggle="tooltip" title="" data-original-title="Remove " data-ref="'.$d.'"><i class="fa fa-times"></i></button>
							
						 ';
			}),
			array('db'=>"m_nft_supply.network",'dt'=>11,'alias'=>'network'),
			array('db'=>"m_nft_supply.network_tipe",'dt'=>12,'alias'=>'network_tipe'),
			array('db'=>"m_nft_supply.network_url",'dt'=>13,'alias'=>'network_url'),
			array('db'=>"m_nft_supply.contract_address",'dt'=>14,'alias'=>'contract_address'),
			
			
			);
			$table = 'm_nft_supply inner join m_nft_customer on(m_nft_supply.id_nftcustomer=m_nft_customer.id) ';
			$whereResult = NULL;
			$whereAll = '1=1';
			
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	public function delete()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$id = $this->input->post('id',true);
			$this->db->trans_begin();
			if(is_array($id))
				$this->db->where_in('id',$id);
			else
				$this->db->where('id',$id);
			$this->db->delete('m_nft_supply');
			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
	public function defaults()
	{
		if($this->input->is_ajax_request() && $this->input->post())
		{
			
			$in = $this->input->post(); 
			$this->db->trans_begin();
			
			 
			if($in['homes']==1)
			{
				$in['homes']=0;
			}else
			{
				 
				$in['homes'] = 1;
				
			}
			 
			$this->db->where('id',$in['id'])
			->update('nft_supply',array("homes"=>$in['homes']));
			
			if($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
				json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
				return;
			}
			else
			{
				$this->db->trans_commit();
				json(array('error'=>false,'message'=>'Proccess Done','security'=>token()));
				return;
			}
			json(array('error'=>true,'message'=>'Proccess Failed','security'=>token()));
			return;
		}
		show_404();
	} 
}
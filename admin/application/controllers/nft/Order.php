<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends Smart_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$in['use_hedaer'] = true;
		$in['title'] = 'Master order';
		$in['desc'] = 'you can manage your  here';
		$in['bread']['#'] = 'Settings';
		$in['bread'][site_url('manager/order')] = '';
		$in['tpl'] = 'nft/order/main';
		 
		$this->load->view('manager/layout',$in);
	}
	public function getlist()
	{
		if($this->input->is_ajax_request())
		{
			$this->load->library('ssp');
			$ssp = $this->ssp;
			$primaryKey = 'm_nft_order.id';
			$columns    = array(
			array('db'=>'m_nft_order.id','dt'=>0,'alias'=>'ids','formatter'=>function($d,$row){
				return '<input type="checkbox" class="chk-item" value="'.$d.'">';
			}),
			array('db'=>"m_nft_order.tokenid",'dt'=>1,'alias'=>'no_order'),
			array('db'=>"CONCAT(m_nft_customer.name,'<br/>(',m_nft_customer.email,')')",'dt'=>2,'alias'=>'custs'),
			 
			array('db'=>"m_nft_supply.name",'dt'=>3,'alias'=>'name','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_nft_order.price",'dt'=>4,'alias'=>'prices','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_nft_order.fee_price",'dt'=>5,'alias'=>'fee_price','formatter'=>function($d,$row){
				 return $d;
			}),
			
			array('db'=>"CONCAT((select c.name from m_nft_customer c where c.id=m_nft_order.customer_from limit 1),'<br/>(',(select c.email from m_nft_customer c where c.id=m_nft_order.customer_from limit 1),')')",'dt'=>6,'alias'=>'customer_from','formatter'=>function($d,$row){
				 return $d;
			}),
			array('db'=>"m_nft_order.network_url",'dt'=>7,'alias'=>'network_url','formatter'=>function($d,$row){
				 return "<a href='".$d."tx/".$row->nft_hash."' target='_blank'>detail</a>";
			}), 
			array('db'=>"m_nft_order.nft_hash",'dt'=>8,'alias'=>'nft_hash','formatter'=>function($d,$row){
				 return $d;
			}), 
			);
			$table = 'm_nft_order inner join m_nft_customer on(m_nft_order.customer_by=m_nft_customer.id) inner join m_nft_supply on(m_nft_supply.id=m_nft_order.id_nft_supply)';
			$whereResult = NULL;
			$whereAll = "1=1";
			 
			$arr = $ssp::complex( $_GET, $this, $table, $primaryKey, $columns, $whereResult, $whereAll );
			echo json_encode($arr);
			exit;
		}
		show_404();
	}
	 
	 
}